<template>
    <ul class="nav nav-pills nav-stacked" style="overflow-y: scroll;">
        <li :class="getView() === 'home' ? 'active' : ''"><a href="#" v-on:click="setView('home')">Home</a></li>
        <li :class="getView() === 'queue' ? 'active' : ''"><a href="#" v-on:click="setView('queue')">Queue</a></li>
        <li class="dropdown-header" style="padding-left: .5vw;"><b>Media</b></li>
        <li class="divider"></li>
        <li :class="getView() === 'album-index' ? 'active' : ''"><a href="#" v-on:click="setView('album-index')">Albums</a></li>
        <li :class="getView() === 'track-index' ? 'active' : ''"><a href="#" v-on:click="setView('track-index')">Tracks</a></li>
    </ul>
</template>

<style scoped>
    ul {
        border-right: 1px solid;
        height: 100%;
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
