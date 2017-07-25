@extends('layouts.app')

@section('content')
<div class="container" id="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="column">
            <div class="panel panel-default">
                <div class="panel-heading">New Album</div>
                <div class="panel-body" id="formpanel">
                    <form class="form-horizontal" id="userform" role="form" method="POST" v-on:submit="cancel">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="file" type="file"></input>
                            </div>
                        </div>

                        <text-input name="name" label="Name"></text-input>
                        <select-input name="artist" label="Artist" type="artists"></select-input>
                        <submit-button btn-style="btn-success" label="Create" url="{{ route('albums.store') }}" method="POST" form="userform" file=""></submit-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
