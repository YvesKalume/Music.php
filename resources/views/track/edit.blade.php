@extends('layouts.form')

@section('content')
<div class="container" id="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="column">
            <div class="panel panel-default">
                <div class="panel-heading">{{$track->title}}</div>
                <div class="panel-body" id="formpanel">

                    <form class="form-horizontal" id="updateform" role="form" method="POST" v-on:submit="cancel">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="Track" class="col-md-4 control-label">Track</label>

                            <div class="col-md-6">
                                <audio controls src="/tracks/{{$track->id}}/audio"></audio>
                            </div>
                        </div>
                        <text-input label="Title" name="title" value="{{$track->title}}"></text-input>

                        <select-input label="Artists" multiple="true" name="artists[]" type="artists" value="{{$track->artists}}"></select-input>
                        <select-input label="Albums" multiple="true" name="albums[]" type="albums" value="{{$track->albums}}"></select-input>

                        <submit-button btn-style="btn-success" form="updateform" label="Update" method="PUT" url="/tracks/{{$track->id}}">
                        </submit-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
