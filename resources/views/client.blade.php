@extends('layouts.app')

@section('styles')
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

    .trackdata {
        margin: 0;
        color: black;

    }

    .trackdata:hover {
        /* Starting position */
        -moz-transform:translateX(100%);
        -webkit-transform:translateX(100%);
        transform:translateX(100%);
        /* Apply animation to this element */
        -moz-animation: scroll-left 8s linear infinite;
        -webkit-animation: scroll-left 8s linear infinite;
        animation: scroll-left 8s linear infinite;
    }

    /* Move it (define the animation) */
    @-moz-keyframes scroll-left {
        0%   { -moz-transform: translateX(100%); }
        100% { -moz-transform: translateX(-100%); }
    }
    @-webkit-keyframes scroll-left {
        0%   { -webkit-transform: translateX(100%); }
        100% { -webkit-transform: translateX(-100%); }
    }
    @keyframes scroll-left {
        0%   {
            -moz-transform: translateX(100%); /* Browser bug fix */
            -webkit-transform: translateX(100%); /* Browser bug fix */
            transform: translateX(100%);
        }
        100% {
            -moz-transform: translateX(-100%); /* Browser bug fix */
            -webkit-transform: translateX(-100%); /* Browser bug fix */
            transform: translateX(-100%);
        }
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
<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
@endsection

@section('content')
<div class="container" id="content"><component v-bind:is="currentView" v-on:view="setView"></component></div>
<bar-player></bar-player>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
<script>
    // AJAX client instantiation.
    // $(document).ready(() => {
    //     load(document.location.origin + '/');
    //     $('#content').on('click', "a", event => {
    //         event.preventDefault();
    //         let pageurl = event.target.href;
    //         load(pageurl);
    //     });
    //     $('.navbar-brand').on('click', e => {
    //         e.preventDefault();
    //         let pageurl = e.target.href;
    //         load(pageurl);
    //     });
    // });
    // var load = url => {
    //     $.get({
    //         url: url,
    //         error: err => {
    //             $('#content').html(err.responseText);
    //         },
    //         success: data => {
    //             $('#content').html(data);
    //         }
    //     });
    //     if (url !== window.location) {
    //         window.history.pushState({path:url},'',url);
    //     }
    //     $(window).bind('popstate', () => {
    //         $.get({
    //             url:location.pathname,
    //             success: data => {
    //                 $('#content').html(data);
    //             }
    //         });
    //     });
    // };
</script>
@endsection
