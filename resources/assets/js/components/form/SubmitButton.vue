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
                } else if ($('input[type=file]').length > 0) {
                    console.log("File input detected. Appending file input to form data...")
                    formData.append("file", $('input[type=file]')[0].files[0], "file");
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
        /**
         * Side note: I was going to have mounted() handle canceling the event,
         * but it didn't work. Oh well.
         *
         * Properties used to define the submit button logic.
         * @param {string} btnStyle - The name of the bootstrap class used to style the button. Btn is not necessary.
         * @param {File} file - The file object to be submitted with the form.
         * @param {string} form - The ID of the form element to submit. Required.
         * @param {string} label - The text that will appear on the button as a label.
         * @param {string} method - The HTTP method used to submit the form. Required.
         * @param {string} url - The location to submit the form to. Required.
         */
        props: ['btnStyle', 'form', 'label', 'url', 'method', 'file']
    }
</script>
