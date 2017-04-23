@extends('ajax')

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
