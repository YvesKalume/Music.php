<template>
    <ul class="nav nav-pills nav-stacked" style="overflow-y: scroll;">
        <router-link to="/" tag="li" active-class="active" exact><a href="#">Home</a></router-link>
        <router-link to="/queue" tag="li" active-class="active"><a href="#">Queue</a></router-link>
        <!-- <li :class="getView() === 'home' ? 'active' : ''"><a href="#" v-on:click="setView('home')">Home</a></li> -->
        <!-- <li :class="getView() === 'queue' ? 'active' : ''"><a href="#" v-on:click="setView('queue')">Queue</a></li> -->
        <li class="dropdown-header" style="padding-left: .5vw;"><b>Media</b></li>
        <li class="divider"></li>
        <router-link to="/albums" active-class="active" tag="li"><a href="#">Albums</a></router-link>
        <router-link to="/tracks" active-class="active" tag="li"><a href="#">Tracks</a></router-link>
        <!-- <li :class="getView() === 'album-index' ? 'active' : ''"><a href="#" v-on:click="setView('album-index')">Albums</a></li> -->
        <!-- <li :class="getView() === 'track-index' ? 'active' : ''"><a href="#" v-on:click="setView('track-index')">Tracks</a></li> -->
    </ul>
</template>

<style scoped>
    ul {
        border-right: 1px solid;
        height: 100%;
        border-radius: 0;
    }
    li {
        border-radius: 0;
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
