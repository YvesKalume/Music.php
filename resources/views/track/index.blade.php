<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Actions</div>
            <div class="panel-body">
                <a class="btn btn-primary" href="{{ route('tracks.create') }}">Upload Tracks</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Tracks</div>
            <div class="panel-body">
                <table id="tracks" style="width: 100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Path</th>
                            <th>Play</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tracks as $track)
                            <tr>
                                <td>{{$track->id}}</td>
                                <td>{{$track->title}}</td>
                                <td>{{$track->path}}</td>
                                <td><button class="btn btn-primary" onclick="play('/tracks/{{ $track->id }}')">Play</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $('#tracks').DataTable();
</script>
