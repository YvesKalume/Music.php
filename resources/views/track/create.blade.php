<script src="{{ asset('js/jsmediatags.min.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="column">
            <div class="panel panel-default" id="upload">
                <div class="panel-heading">Add Tracks</div>
                <div class="panel-body"><input id="trackfiles" multiple type="file"></input></div>
            </div>
            <script>
                var blob = window.URL || window.webkitURL;
                var jsmediatags = window.jsmediatags;
                var files;
                $('#trackfiles').change(function() {
                    files = document.getElementById('trackfiles').files;
                    for (let i = 0; i < files.length; i++) {
                        var file = files[i];
                        jsmediatags.read(file, {
                            onSuccess: tag => {
                                $('#column').append(
                                    `<div class="panel panel-default">
                                        <div class="panel-heading">${tag.tags.title}</div>
                                        <div class="panel-body" id="${i}div">

                                            <form class="form-horizontal" id="${i}form" role="form" method="POST" action="{{ route('tracks.store') }}">
                                                {{ csrf_field() }}

                                                <div class="form-group">
                                                    <label for="Track" class="col-md-4 control-label">Track</label>

                                                    <div class="col-md-6">
                                                        <audio controls src="${blob.createObjectURL(file)}"></audio>
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                                    <label for="title" class="col-md-4 control-label">Title</label>

                                                    <div class="col-md-6">
                                                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}${tag.tags.title}" required autofocus>

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
                                                            Upload
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <script>
                                                $('#${i}form').submit(function(event) {
                                                    event.preventDefault();
                                                    var formData = new FormData($("#${i}form")[0]);
                                                    formData.append("file", files[${i}], "file.mp3");
                                                    $.post({
                                                        url: "{{ route('tracks.store') }}",
                                                        data: formData,
                                                        contentType: false,
                                                        processData: false,
                                                        success: (data) => {
                                                            if(data.status === "success") {
                                                                $('#${i}div').html("Successfully uploaded track!");
                                                            }
                                                        }
                                                    });
                                                });
                                            <\/script>
                                        </div>
                                    </div>`);
                            },
                        });
                    }
                    $('#upload').remove();
                });
            </script>
        </div>
    </div>
</div>
