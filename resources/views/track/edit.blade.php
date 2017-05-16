@extends('ajax')
<div class="container" id="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="column">
            <div class="panel panel-default">
                <div class="panel-heading">{{$track->title}}</div>
                <div class="panel-body" id="formpanel">

                    <form class="form-horizontal" id="updateform" role="form" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <label for="Track" class="col-md-4 control-label">Track</label>

                            <div class="col-md-6">
                                <audio controls src="/tracks/audio/{{ $track->id }}"></audio>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $track->title }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('artists') ? ' has-error' : '' }}">
                            <label for="artists" class="col-md-4 control-label">Artists</label>

                            <div class="col-md-6">
                                <select class="artists" id="artists" class="form-control" name="artists[]" style="width: 100%" multiple required>
                                    @foreach ($artists as $artist)
                                        <option id="artist{{$artist->id}}" value="{{ $artist->id }}">{{ $artist->name }}</option>
                                    @endforeach
                                    @foreach($track->artists as $artist)
                                        <script>
                                            $('#artist{{$artist->id}}').prop('selected', true);
                                        </script>
                                    @endforeach
                                    <option id="addartist" value="addartist">+ Add Artist</option>
                                </select>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('Albums') ? ' has-error' : '' }}">
                            <label for="albums" class="col-md-4 control-label">Albums</label>

                            <div class="col-md-6">
                                <select class="albums" id="albums" class="form-control" name="albums[]" style="width: 100%" multiple required>
                                    @foreach ($albums as $album)
                                        <option id="album{{$album->id}}" value="{{ $album->id }}">{{ $album->name }}</option>
                                    @endforeach
                                    @foreach($track->albums as $album)
                                        <script>
                                            $('#album{{$album->id}}').prop('selected', true);
                                        </script>
                                    @endforeach
                                    <option id="addalbum" value="addalbum">+ Add Album</option>
                                </select>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                    <script>
                        $('#formpanel').submit(function(event) {
                            event.preventDefault();
                            var formData = new FormData($("#updateform")[0]);
                            $.post({
                                url: "{{ route('tracks.update', $track->id) }}",
                                data: formData,
                                error: err => {
                                    $('#container').html(err.responseText);
                                },
                                contentType: false,
                                processData: false,
                                success: (data) => {
                                    if(data.status === "success") {
                                        $('#formpanel').html("Successfully updated track data!");
                                    } else {
                                        $('#formpanel').html("Invalid response");
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>
            <script>
                $('#container').on('mousedown', 'option', event => {
                    event.preventDefault();
                    if ($(event.target).prop("selected")) {
                        return $(event.target).prop("selected", false);
                    }
                    $(event.target).prop("selected", true);
                });
                $('#container').on('click', "#addalbum", event => {
                    $(event.target).prop("selected", false);
                    let album = prompt("Please enter the name of the album you would like to add.");
                    if (!album) {
                        return alert("Please enter a name for the album.");
                    }
                    let formData = new FormData();
                    formData.append("name", album);
                    formData.append("_token", "{{ csrf_token() }}")
                    $.post({
                        url: "{{ route('albums.store') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            if(data.status === "success") {
                                alert("Album added successfully!");
                                $('.albums').prepend($('<option>', {
                                    value: data.id,
                                    text: album
                                }));
                            }
                        }
                    });
                });
                $('#container').on('click', "#addartist", event => {
                    $(event.target).prop("selected", false);
                    let artist = prompt("Please enter the name of the artist you would like to add.");
                    if (!artist) {
                        return alert("Please enter a name for the artist.");
                    }
                    let formData = new FormData();
                    formData.append("name", artist);
                    formData.append("_token", "{{ csrf_token() }}")
                    $.post({
                        url: "{{route('artists.store')}}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            if(data.status === "success") {
                                alert("Artist added successfully!");
                                $('.artists').prepend($('<option>', {
                                    value: data.id,
                                    text: artist
                                }));
                            }
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>
