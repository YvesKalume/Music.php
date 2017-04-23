@extends('layouts.index')

<meta name="queue" content="tracks">

@section('actions')
    <a class="btn btn-primary" href="{{ route('tracks.create') }}">Upload Tracks</a>
@endsection

@section('heading')
    Tracks
@endsection

@section('columns')
    <th>ID</th>
    <th>Title</th>
    <th>Artists</th>
    <th>Play</th>
    <th>Delete</th>
@endsection

@section('rows')
    @foreach ($tracks as $track)
        <tr>
            <td>{{$track->id}}</td>
            <td>{{$track->title}}</td>
            <td>
                @foreach($track->artists as $artist)
                    {{$artist->name}}
                @endforeach
            </td>
            <td><button class="btn btn-primary" onclick="play('{{ $track->id }}')">Play</button></td>
            <td><button class="btn btn-danger" onclick="callDelete('/tracks/{{ $track->id }}')">Delete</button></td>
        </tr>
    @endforeach
@endsection
