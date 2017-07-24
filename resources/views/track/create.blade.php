@extends('layouts.app')
<script src="{{ asset('js/jsmediatags.min.js') }}"></script>

@section('content')
<div class="container" id="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="column">
            <file-handler></file-handler>
        </div>
    </div>
</div>
@endsection
