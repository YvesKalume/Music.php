@extends('layouts.app')

@section('styles')
<style>
    .column-left {
        padding-left: 0px;
        margin-left: 0px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /*padding-bottom: 8vh;*/
        /*padding-top: 4vh;*/
    }
</style>
@endsection

@section('content')
<div class="container scrollspy" id="content" style="width: 100%; height: 100%; padding-left: 0px;">
    <!-- <div class="row" style="width: 100%; height: 100%;"> -->
        <div class="col-md-2 scrollspy" style="height: 100%; padding-left: 0px; padding-top: 6vh; padding-bottom: 8vh;">
            <div class="column-left" data-spy="affix" style="width: 16vw; padding-top: 0px; height: 86vh;">
                <column></column>
                <track-info></track-info>
                <!-- <div style="">
                    <img src="/img/noalbum.svg" style="width: 100%;"></img>
                    <div style="height: 8vh; border-right: 1px solid;"></div>
                </div> -->
            </div>
        </div>
        <div class="col-md-10" style="margin-top: 8vh; margin-bottom: 8vh;">
            <!-- <component v-bind:is="getView()"></component> -->
            <router-view></router-view>
        </div>
    <!-- </div> -->
</div>
<bar-player></bar-player>
@endsection
