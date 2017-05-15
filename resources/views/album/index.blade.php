@extends('layouts.index')

<meta name="queue" content="tracks">

@section('actions')
    <a class="btn btn-primary" href="{{ route('albums.create') }}">Add Album</a>
@endsection

@section('heading')
    Albums
@endsection

@section('columns')
    <th>ID</th>
    <th>Name</th>
    <th>Artist</th>
    <th>View</th>
    <th>Edit</th>
@endsection

@section('rows')
    @foreach ($albums as $album)
        <tr>
            <td>{{$album->id}}</td>
            <td>{{$album->title}}</td>
            <td>{{$album->artist}}</td>
            <td><button class="btn btn-success" onclick="/albums/{{ $album->id }}">View</button></td>
            <td><button class="btn btn-primary" onclick="/albums/{{ $album->id }}/edit">Edit</button></td>
        </tr>
    @endforeach
@endsection
