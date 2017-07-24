<template>
    <div class="list-group">
        <a class="list-group-item" href="#" v-on:click="setView('home')" :class="getView() === 'home' ? 'active' : ''">Home</a>
        <a class="list-group-item" href="#" v-on:click="setView('queue')" :class="getView() === 'queue' ? 'active' : ''">Queue</a>
        <li class="dropdown-header">Media</li>
        <a class="list-group-item" href="#" v-on:click="setView('album-index')" :class="getView() === 'album-index' ? 'active' : ''">Albums</a>
        <a class="list-group-item" href="#" v-on:click="setView('track-index')" :class="getView() === 'track-index' ? 'active' : ''">Tracks</a>
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
        }
    }
</script>
