@extends('layouts.app')

@section('content')
<div class="container" id="container" style="margin-top: 8vh;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="column">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $album->name }}</div>
                <div class="panel-body" id="formpanel">
                    <form class="form-horizontal" id="updateform" role="form" method="POST" v-on:submit="cancel">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">New Image</label>

                            <div class="col-md-6">
                                <input id="file" type="file"></input>
                            </div>
                        </div>

                        <text-input label="name" name="name" value="{{$album->name}}"></text-input>
                        <select-input label="Artist" name="artist" type="artists"></select-input>

                        <submit-button btnStyle="btn-success" form="updateform" label="Update" method="PUT" url="/albums/1"></submit-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
