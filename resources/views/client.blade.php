@extends('layouts.app')

@section('content')
<style>
    .toggle {
        height: 87.5%;
        line-height: 87.5%;
        width: 7vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: transparent;
        border-radius: 100%;
        text-align: center;
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

    #play::after {
        content: '';
        display: inline-block;
        position: relative;
        border-style: solid;
        border-width: 2vh 0 2vh 3vh;
        border-color: transparent transparent transparent black;
    }

    #pause::after {
        position: absolute;
        content: '';
        width: 3.5vh;
        height: 50%;
        background: black;
        border-left: 1.05vh solid black;
        box-shadow: inset 1.4vh 0 0 0 #008080;
    }

    #progressbar {
        background: gray;
        border-radius: 1vw;
        height: 1vh;
        border: 2px solid black;
    }

    #progressbar > div {
        background: #008080;
        width: 0%;
        height: 100%;
        border-radius: 1vw;
    }

    .vertical-center {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
</style>

<div class="container" id="content"></div>
<footer class="navbar navbar-default navbar-fixed-bottom" style="height: 8vh; background-color: #008080; width: 100%;">
    <audio id="player" style="visibility: hidden;">
        <source id="source" type="audio/mp3"></source>
    </audio>
    <div class="container" id="playercontent" style="height: 100%; width: 100%;">
        <div class="row" style="height: 100%;">
            <div class="col-md-2" style="height: 100%; display: flex; flex-direction: column; justify-content: center;">
                <button class="toggle" id="play" onclick="toggle()"></button>
            </div>
            <div class="col-md-2" style="height: 100%; display: flex; flex-direction: column; justify-content: center;">
                <p id="trackdata">No track playing</p>
            </div>
            <div class="col-md-8 vertical-center">
                <div id="progressbar">
                    <div></div>
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
    });
    var load = url => {
        $.get({
            url: url,
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

    // Player client instantiation.
    var play = id => {
        $.get({
            url: document.location.origin + "/tracks/" + id,
            success: data => {
                $('#source').attr('src', document.location.origin + "/tracks/audio/" + id);
                let artists = "";
                $.each(data.artists, index => {
                    artists += `${data.artists[index].name} `;
                });
                $('#trackdata').html(`${artists}- ${data.title}`);
                $(".toggle").attr("id", "pause");
                $('#player')[0].load();
                $('#player')[0].play();
            }
        });
    };
    var toggle = () => {
        if ($('#player')[0].paused) {
            $(".toggle").attr("id", "pause");
            return $('#player')[0].play();
        }
        $(".toggle").attr("id", "play");
        $('#player')[0].pause();
    };
    $('#player').on('timeupdate', event => {
        if (!event.target.duration) {
            return;
        }
        $('#progressbar > div').width(`${event.target.currentTime / event.target.duration * 100}%`);
    });
    $('#player').on('ended', event => {
        if ("tracks" === $('meta[name=queue]').attr("content")) {
            alert("Should pull from tracks");
        }
    });
</script>
@endsection
