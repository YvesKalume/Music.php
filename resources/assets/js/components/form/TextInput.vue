<template>
    <div class="form-group">
        <label :for="name" class="col-md-4 control-label">{{ label }}</label>

        <div class="col-md-6">
            <input :id="name" type="text" class="form-control" :name="name" :value="value" required autofocus>
        </div>
    </div>
</template>

<script>
    export default {
        /**
         * Properties used to define the text input.
         * @param {string} label - The label for the input that will appear on the form. Required.
         * @param {string} name - The name of the input that the server will receive. Required.
         * @param {string} value - The initial value of the text input.
         */
        props: ['name', 'label', 'value']
    }
</script>
