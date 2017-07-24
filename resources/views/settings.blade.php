@extends('layouts.app')

@section('content')
<div class="container" id="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Settings</div>
                <div class="panel-body" id="formpanel">
                    <form class="form-horizontal" id="userform" role="form">
                        {{ csrf_field() }}

                        <input name="id" type="text" value="{{ $user->id }}" style="display: none;"></input>
                        <text-input name="email" label="Email" value="{{ $user->email }}"></text-input>
                        <password-input name="password" label="Password" hint="Leave blank to remain unchanged"></password-input>
                        <submit-button btn-style="btn-success" method="PUT" url="{{ route('user.update', $user->id) }}" label="Update"><submit-button>
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
