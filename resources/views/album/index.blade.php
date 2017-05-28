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
            <td>{{$album->name}}</td>
            <td>{{$album->artist->name}}</td>
            <td><a class="btn btn-success" href="{{ route('albums.show', $album->id) }}">View</a></td>
            <td><a class="btn btn-primary" href="{{ route('albums.edit', $album->id) }}">Edit</a></td>
        </tr>
    @endforeach
@endsection
