@extends('layouts.index')

@section('actions')
    <a class="btn btn-primary" href="{{ route('tracks.create') }}">Upload Tracks</a>
@endsection

@section('heading')
    Tracks
@endsection

@section('columns')
    <th>ID</th>
    <th>Title</th>
    <th>Path</th>
    <th>Play</th>
@endsection

@section('rows')
    @foreach ($tracks as $track)
        <tr>
            <td>{{$track->id}}</td>
            <td>{{$track->title}}</td>
            <td>{{$track->path}}</td>
            <td><button class="btn btn-primary" onclick="play('/tracks/{{ $track->id }}')">Play</button></td>
        </tr>
    @endforeach
@endsection
