<template>
    <div class="form-group">
        <div class="col-md-offset-4 col-md-8">
            <button class="btn" :class="style" v-on:click="submit">{{label}}</button>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                form: null
            }
        },
        methods: {
            submit: function() {
                var formData = new FormData(this.form);
                formData.append('_method', this.method);
                if (document.getElementById('file') !== null) {
                    formData.append("file", document.getElementById('file').files[0], "album.png");
                }
                $.ajax({
                    url: this.url,
                    data: formData,
                    error: err => {
                        console.error('Error updating user');
                        console.log(err.responseText);
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        $('#formpanel').html("Submitted!");
                    }
                });
            }
        },
        mounted() {
            $('#formpanel').submit(function(e) {
                e.preventDefault();
            });
            this.form = $('#userform')[0];
        },
        props: ['style','label','url','method']
    }
</script>
