<template>
    <div class="form-group">
        <label :for="name" class="col-md-4 control-label">{{ label }}</label>

        <div class="col-md-6">
            <input :id="name" type="text" class="form-control" :name="name" required autofocus>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['name', 'label']
    }
</script>
