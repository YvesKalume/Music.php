<template>
    <div class="panel panel-default">
        <div class="panel-heading">{{ upload.name }}</div>
        <div class="panel-body">
            <form class="form-horizontal" :id="index+'form'" role="form" method="POST" v-on:submit="cancel">
                <!-- {{ csrf_field() }} -->

                <div class="form-group">
                    <label for="Track" class="col-md-4 control-label">Track</label>

                    <div class="col-md-6">
                        <audio controls :src="upload.src"></audio>
                    </div>
                </div>

                <text-input name="title" label="Title" :value="upload.title"></text-input>

                <select-input name="artists[]" label="Artists" multiple="true" type="artists"></select-input>
                <select-input name="albums[]" label="Albums" multiple="true" type="albums"></select-input>

                <!-- <div class="form-group{{ $errors->has('Albums') ? ' has-error' : '' }}">
                    <label for="albums" class="col-md-4 control-label">Albums</label>

                    <div class="col-md-6">
                        <select class="albums" id="albums" class="form-control" name="albums[]" style="width: 100%" multiple required>
                            @foreach ($albums as $album)
                                <option value="{{ $album->id }}">{{ $album->name }}</option>
                            @endforeach
                            <option id="addalbum" value="addalbum">+ Add Album</option>
                        </select>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> -->

                <submit-button btn-style="btn-success" method="POST" :url="url" label="Upload" :form="form" :file="upload.file"></submit-button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                form: this.index + "form",
                url: document.location.origin + "/tracks"
            }
        },
        methods: {
            cancel: function(e) {
                console.log("Cancelling default submit behavior");
                e.preventDefault();
            }
        },
        mounted() {
        },
        props: ['upload', 'index']
    }
    //                             <script>
    //                                 $('#${i}form').submit(function(event) {
    //                                     event.preventDefault();
    //                                     var formData = new FormData($("#${i}form")[0]);
    //                                     formData.append("file", files[${i}], "file.mp3");
    //                                     $.post({
    //                                         url: "{{ route('tracks.store') }}",
    //                                         data: formData,
    //                                         contentType: false,
    //                                         processData: false,
    //                                         success: (data) => {
    //                                             if(data.status === "success") {
    //                                                 $('#${i}div').html("Successfully uploaded track!");
    //                                             }
    //                                         }
    //                                     });
    //                                 });
    //                             <\/script>
    //                         </div>
    //                     </div>`);
    //             },
    //         });
    //     }
    //     $('#upload').remove();
    // });
    // $('#container').on('mousedown', 'option', event => {
    //     event.preventDefault();
    //     if ($(event.target).prop("selected")) {
    //         return $(event.target).prop("selected", false);
    //     }
    //     $(event.target).prop("selected", true);
    // });
    // $('#container').on('click', "#addalbum", event => {
    //     $(event.target).prop("selected", false);
    //     let album = prompt("Please enter the name of the album you would like to add.");
    //     if (!album) {
    //         return alert("Please enter a name for the album.");
    //     }
    //     let formData = new FormData();
    //     formData.append("name", album);
    //     formData.append("_token", "{{ csrf_token() }}")
    //     $.post({
    //         url: "{{ route('albums.store') }}",
    //         data: formData,
    //         error: err => {
    //             $('#container').html(err.responseText);
    //         },
    //         contentType: false,
    //         processData: false,
    //         success: (data) => {
    //             if(data.status === "success") {
    //                 alert("Album added successfully!");
    //                 $('.albums').prepend($('<option>', {
    //                     value: data.id,
    //                     text: album
    //                 }));
    //             }
    //         }
    //     });
    // });
    // $('#container').on('click', "#addartist", event => {
    //     $(event.target).prop("selected", false);
    //     let artist = prompt("Please enter the name of the artist you would like to add.");
    //     if (!artist) {
    //         return alert("Please enter a name for the artist.");
    //     }
    //     let formData = new FormData();
    //     formData.append("name", artist);
    //     formData.append("_token", "{{ csrf_token() }}")
    //     $.post({
    //         url: "{{ route('artists.store') }}",
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         success: (data) => {
    //             if(data.status === "success") {
    //                 alert("Artist added successfully!");
    //                 $('.artists').prepend($('<option>', {
    //                     value: data.id,
    //                     text: artist
    //                 }));
    //             }
    //         }
    //     });
    // });
</script>
