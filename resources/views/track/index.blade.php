@extends('layouts.index')

<meta name="queue" content="tracks">

@section('actions')
    <a class="btn btn-primary" href="{{ route('tracks.create') }}">Upload Tracks</a>
    <a class="btn btn-success queue" href="{{ route('tracks.queue') }}">Queue</a>
@endsection

@section('heading')
    Tracks
@endsection

@section('columns')
    <th>ID</th>
    <th>Title</th>
    <th>Artists</th>
    <th>View</th>
    <th>Edit</th>
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
            <td><button class="btn btn-success" onclick="play('{{ $track->id }}')">Play</button></td>
            <td><a class="btn btn-primary" href="/tracks/{{$track->id}}/edit">Edit</a></td>
        </tr>
    @endforeach
@endsection
