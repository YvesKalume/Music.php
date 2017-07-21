<template>
    <div class="list-group">
        <a class="list-group-item" href="#" v-on:click="setView('home')" :class="getView() === 'home' ? 'active' : ''">Home</a>
        <a class="list-group-item" href="#" v-on:click="setView('album-index')" :class="getView() === 'album-index' ? 'active' : ''">Albums</a>
    </div>
</template>

<style scoped>
    div {
        margin: 0;
    }
</style>

<script>
    export default {
        data: function() {
            return {
                active: this.$store.state.view
            }
        },
        methods: {
            setView: function(view) {
                this.$store.commit('setView', view);
                this.$emit('view');
            }
        },
    }
</script>
