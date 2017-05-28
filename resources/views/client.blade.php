@extends('layouts.app')

@section('content')
<style>
    .toggle {
        height: 75%;
        line-height: 87.5%;
        width: 7vh;
        display: flex;
        justify-content: center;
        background: transparent;
        border-radius: 100%;
        border-color: black;
        align-items: center;
    }

    #trackdata {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
        color: black;
    }

    .bar {
        background: gray;
        border-radius: 1vw;
        height: 1vh;
        border: 2px solid black;
    }

    .bar > div {
        background: #008080;
        height: 100%;
        border-radius: 1vw;
    }

    .vertical-center {
        height: 100%;
        display: flex;
        align-items: center;
    }
</style>

<div class="container" id="content"></div>
<footer class="navbar navbar-default navbar-fixed-bottom" style="height: 8vh; background-color: #008080; width: 100%;">
    <audio id="player" style="visibility: hidden;">
        <source id="source" type="audio/mp3"></source>
    </audio>
    <div class="container" id="playercontent" style="height: 100%; width: 100%;">
        <div class="row" style="height: 100%;">
            <div class="col-md-1" style="height: 100%; display:flex; align-items:center;">
                <button id="back" style="background:transparent; border:none;">
                    <span class="glyphicon glyphicon-step-backward" style="color: black; font-size:2vh;"></span>
                </button>
                <button class="toggle" id="play" onclick="toggle()" style="margin: 1vh;">
                    <span id="icon" class="glyphicon glyphicon-play" style="font-size:4vh; color: black;"></span>
                </button>
                <button id="forward" style="background:transparent; border:none;">
                    <span class="glyphicon glyphicon-step-forward" style="color: black; font-size:2vh;"></span>
                </button>
            </div>
            <div class="col-md-2" style="height: 100%; display: flex; flex-direction: column; justify-content: center;">
                <p id="trackdata">No track playing</p>
            </div>
            <div class="col-md-9 vertical-center">
                <div class="bar" id="progressbar" style="width: 100%;">
                    <div class="barvalue" id="progress" style="width: 0%;"></div>
                </div>
                <span class="glyphicon glyphicon-volume-up" id="volicon" style="color:black; margin-left: 2vw; margin-right: .5vw; font-size: 2vh;"></span>
                <div class="bar" id="volumebar" style="width: 10%;">
                    <div class="barvalue" id="volume"></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script>
    // AJAX client instantiation.
    $(document).ready(() => {
        load(document.location.origin + '/{{ $url }}');
        $('#content').on('click', "a", event => {
            event.preventDefault();
            let pageurl = event.target.href;
            load(pageurl);
        });
        $('.navbar-brand').on('click', e => {
            e.preventDefault();
            let pageurl = e.target.href;
            load(pageurl);
        });
    });
    var load = url => {
        $.get({
            url: url,
            error: err => {
                $('#content').html(err.responseText);
            },
            success: data => {
                $('#content').html(data);
            }
        });
        if (url !== window.location) {
            window.history.pushState({path:url},'',url);
        }
        $(window).bind('popstate', () => {
            $.get({
                url:location.pathname,
                success: data => {
                    $('#content').html(data);
                }
            });
        });
    };
    var playing = false;
    var queue = [];
    // Player client instantiation.
    var play = id => {
        $.get({
            url: document.location.origin + "/tracks/" + id,
            success: data => {
                $('#source').attr('src', document.location.origin + "/tracks/" + id + "/audio");
                let artists = "";
                $.each(data.artists, index => {
                    artists += `${data.artists[index].name} `;
                });
                $('#trackdata').html(`${artists}- ${data.title}`);
                $("#icon").attr("class", "glyphicon glyphicon-pause");
                $('#player')[0].load();
                $('#player')[0].play();
            }
        });
    };

    var add = ids => {
        if (ids.lastIndexOf(',') === ids.length - 1) ids = ids.substring(0, ids.length - 1);
        let array = ids.split(',');
        array.forEach(id => {
            queue.push(id);
        });
        if (!playing) {
            playFromQueue();
        }
    };

    var playFromQueue = () => {
        play(queue[0]);
        queue.splice(0, 1);
    }
    var toggle = () => {
        if ($('#player')[0].paused) {
            $("#icon").attr("class", "glyphicon glyphicon-pause");
            return $('#player')[0].play();
        }
        $("#icon").attr("class", "glyphicon glyphicon-play");
        $('#player')[0].pause();
    };
    $('#back').on('click', e => {
        alert('Back has not yet been implemented');
    });
    $('#forward').on('click', e => {
        playFromQueue();
    });
    $('#player').on('timeupdate', event => {
        if (!event.target.duration) {
            return;
        }
        $('#progressbar > div').width(`${event.target.currentTime / event.target.duration * 100}%`);
    });
    $('#player').on('ended', () => {
        $("#icon").attr("class", "glyphicon glyphicon-play");
        playFromQueue();
    });
    $('#progressbar').on('click', e => {
        $('#player')[0].currentTime = $('#player')[0].duration * e.offsetX / $('#progressbar')[0].offsetWidth;
        $('#progress').css('width', e.offsetX + "px");
    });
    $('#volumebar').on('click', e => {
        let volume = e.offsetX / $('#volumebar')[0].offsetWidth;
        if (volume < .5) $("#volicon").attr("class", "glyphicon glyphicon-volume-down");
        else $("#volicon").attr("class", "glyphicon glyphicon-volume-up");
        $('#player')[0].volume = volume;
        $('#volume').css('width', e.offsetX + "px");
    });
    $('#volicon').on('click', e => {
        if ($('#player')[0].muted) {
            $('#player')[0].muted = false;
            if ($('#player')[0].volume < .5) $(event.target).attr("class", "glyphicon glyphicon-volume-down");
            else $("#volicon").attr("class", "glyphicon glyphicon-volume-up");
        } else {
            $('#player')[0].muted = true;
            $(event.target).attr("class", "glyphicon glyphicon-volume-off");
        }
    });
</script>
@endsection
