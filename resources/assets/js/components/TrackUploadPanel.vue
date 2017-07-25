<template>
    <div class="panel panel-default">
        <div class="panel-heading">{{ upload.name }}</div>
        <div class="panel-body">
            <form class="form-horizontal" :id="index+'form'" role="form" method="POST" v-on:submit="cancel">
                <div class="form-group">
                    <label for="Track" class="col-md-4 control-label">Track</label>

                    <div class="col-md-6">
                        <audio controls :src="upload.src"></audio>
                    </div>
                </div>
                <text-input name="title" label="Title" :value="upload.title"></text-input>
                <select-input name="artists[]" label="Artists" multiple="true" type="artists"></select-input>
                <select-input name="albums[]" label="Albums" multiple="true" type="albums"></select-input>
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
        mounted() {
        },
        props: ['upload', 'index']
    }
</script>
