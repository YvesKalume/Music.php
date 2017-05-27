@extends('ajax')
<div class="container" id="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="column">
            <div class="panel panel-default">
                <div class="panel-heading">{{$album->artist->name}} - {{$album->name}}</div>
                <div class="panel-body" id="formpanel">
                    <div class="row">
                        <div class="col-md-3">
                            {{ $image }}
                        </div>
                        <div class="col-md-9">Insert placeholder for description of album.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
