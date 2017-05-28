@extends('ajax')

<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>

<div class="container" id="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="column">
            <div class="panel panel-default">
                <div class="panel-heading">{{$album->artist->name}} - {{$album->name}}</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="/albums/image/{{$album->id}}" style="width:100%;">
                        </div>
                        <div class="col-md-9">
                            Insert placeholder for description of album.<br>
                            <button class="btn btn-primary" onclick="add('@foreach($album->tracks as $track){{$track->id.','}}@endforeach')">Queue</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Tracks</div>
                <div class="panel-body">
                    <table id="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Artists</th>
                                <th>View</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($album->tracks as $track)
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#table').DataTable();
</script>
