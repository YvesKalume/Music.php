@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
@endsection

@section('content')
<div class="container" id="content" style="width: 100%;">
    <div class="row" style="width: 100%;">
        <div class="col-md-2" style="margin-left: 0px; height: 100%;">
            <column v-on:view="setView"></column>
        </div>
        <div class="col-md-10">
            <component v-bind:is="getView()"></component>
        </div>
    </div>
</div>
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
