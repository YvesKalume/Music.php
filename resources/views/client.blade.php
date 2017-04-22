@extends('layouts.app')

@section('content')

<style>
    #play {
        clip-path: circle(20%);
        cursor: pointer;
        background-color: #000000;
        width: 10%;
        height: 100%;
    }

    #trackdata {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
        color: black;
    }
</style>

<div class="container" id="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Dashboard</div>
                <div class="panel-body">
                    
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Albums</div>
                <div class="panel-body">

                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Tracks</div>
                <div class="panel-body">
                    <a class="btn btn-primary" href="{{ route('tracks.index') }}">More Tracks</a>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer" style="position: absolute; bottom: 0; height: 8vh; background-color: #008080; width: 100%;">
    <audio id="player" style="visibility: hidden;">
        <source id="source" type="audio/mp3"></source>
    </audio>
    <div class="container" id="playercontent" style="height: 100%; width: 100%;">
        <div class="row" style="height: 100%;">
            <div class="col-md-4" id="play" onclick="toggle()"></div>
            <div class="col-md-4" id="trackdata">No track playing</div>
        </div>
    </div>
</footer>
<script>
    var play = url => {
        $('#source').attr('src', url);
        $('#player')[0].load();
        $('#player')[0].play();
    };
    var toggle = () => {
        if ($('#player')[0].paused) {
            return $('#player')[0].play();
        }
        $('#player')[0].pause();
    };
    $('#content').on('click', "a", event => {
        event.preventDefault();
        let pageurl = event.target.href;
        $.get({
            url: pageurl,
            success: data => {
                $('#content').html(data);
            }
        });
        if (pageurl !== window.location) {
            window.history.pushState({path:pageurl},'',pageurl);
        }
        $(window).bind('popstate', () => {
            $.get({
                url:location.pathname,
                success: data => {
                    $('#content').html(data);
                }
            });
        });
    });
</script>
@endsection
