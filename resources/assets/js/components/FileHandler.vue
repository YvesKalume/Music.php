<template>
    <div>
        <div class="panel panel-default" id="upload">
            <div class="panel-heading">Add Tracks</div>
            <div class="panel-body">
                <input id="trackfiles" multiple type="file" v-on:change="parseFiles"></input>
            </div>
        </div>
        <track-upload v-for="(upload, key) in uploads" :index="key" :key="key" :upload="upload"></track-upload>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                blob: window.URL || window.webkitURL,
                files: null,
                jsmediatags: window.jsmediatags,
                uploads: [],
                url: document.location.origin + "/tracks"
            }
        },
        methods: {
            parseFiles: function(event) {
                this.files = event.target.files;
                for (let i = 0; i < this.files.length; i++) {
                    let file = this.files[i];
                    let fileObj = {};
                    fileObj.file = file;
                    fileObj.name = file.name;
                    fileObj.src = this.blob.createObjectURL(file);
                    this.jsmediatags.read(file, {
                        onSuccess: tag => {
                            fileObj.title = tag.tags.title;
                            this.uploads.push(fileObj);
                        }
                    });
                }
            }
        },
    }
</script>
