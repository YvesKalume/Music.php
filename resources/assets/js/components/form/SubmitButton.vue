<template>
    <div class="form-group">
        <div class="col-md-offset-4 col-md-8">
            <button class="btn" :class="btnStyle" v-on:click="submit">{{label}}</button>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            submit: function() {
                var formData = new FormData($("#" + this.form)[0]);
                console.log("Running submit function...");
                formData.append('_method', this.method);
                if (this.file) {
                    formData.append("file", this.file, "file");
                }
                $.ajax({
                    url: this.url,
                    data: formData,
                    error: err => {
                        console.error('Error submitting form...');
                        console.log(err.responseText);
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        $("#" + this.form).parent().html("Submitted!");
                    }
                });
            }
        },
        props: ['btnStyle', 'form', 'label', 'url', 'method', 'file']
    }
</script>
