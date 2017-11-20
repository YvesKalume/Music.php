@extends('layouts.form')

@section('content')
<div class="container" id="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Settings</div>
                <div class="panel-body" id="formpanel">
                    <form class="form-horizontal" id="userform" role="form" method="POST" v-on:submit="cancel">
                        {{ csrf_field() }}

                        <input name="id" type="text" value="{{ $user->id }}" style="display: none;"></input>
                        <text-input name="email" label="Email" value="{{ $user->email }}"></text-input>
                        <password-input name="password" label="Password" hint="Leave blank to remain unchanged"></password-input>
                        <submit-button btn-style="btn-success" method="PUT" form="userform" url="{{ route('user.update', $user->id) }}" label="Update"><submit-button>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Application Settings</div>
                <div class="panel-body">
                    @if (Session::get('status') == '200-settings')
                        <div class="alert alert-success">
                            Settings updated successfully!
                        </div>
                    @endisset
                    <p>These are the settings used for what every user sees on the website.</p>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('settings.update') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <text-input label="Format" name="format" required value="{{ $errors->has('format') ? old('format') : $format }}"></text-input>
                        </text-input>
                        <text-input label="Bitrate" name="bitrate" required value="{{ $errors->has('bitrate') ? old('bitrate') : $bitrate }}"></text-input>
                        <submit-button btn-style="btn-primary" label="Update"></submit-button>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">API Authentication</div>
                <div class="panel-body">
                    <passport-clients></passport-clients>
                    <passport-authorized-clients></passport-authorized-clients>
                    <passport-personal-access-tokens></passport-personal-access-tokens>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
