@extends('layouts.app')

@section('content')
<div class="container" id="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="column">
            <div class="panel panel-default">
                <div class="panel-heading">New Album</div>
                <div class="panel-body" id="formpanel">
                    <form class="form-horizontal" id="updateform" role="form" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input id="image" type="file"></input>
                            </div>
                        </div>

                        <text-input name="name" label="Name"></text-input>

<!--                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <div class="form-group{{ $errors->has('artist') ? ' has-error' : '' }}">
                            <label for="artist" class="col-md-4 control-label">Artist</label>

                            <div class="col-md-6">
                                <select class="artists" id="artists" class="form-control" name="artist" style="width: 100%" required>
                                    @foreach ($artists as $artist)
                                        <option id="artist{{$artist->id}}" value="{{ $artist->id }}">{{ $artist->name }}</option>
                                    @endforeach
                                    <option id="addartist" value="addartist">+ Add Artist</option>
                                </select>

                                @if ($errors->has('artist'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('artist') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                    <script>
                        $('#formpanel').submit(function(event) {
                            event.preventDefault();
                            var formData = new FormData($("#updateform")[0]);
                            formData.append("file", document.getElementById('image').files[0], "album.png");
                            $.post({
                                url: "{{ route('albums.store') }}",
                                data: formData,
                                error: err => {
                                    $('#content').html(err.responseText);
                                },
                                contentType: false,
                                processData: false,
                                success: (data) => {
                                    if(data.status === "success") {
                                        $('#formpanel').html("Successfully added new album!");
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
                $('#container').on('change', "#artists", event => {
                    if ($(event.target).val() !== "addartist") return;
                    $('#artist1').prop("selected", true);
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
@endsection
