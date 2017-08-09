<template>
    <ul class="dropdown-menu" style="z-index: 1031;">
        <li><a href="#" v-on:click="player.play(track, album.id)">Play</a></li>
        <li><a v-if="checkAdmin()" :href="'/tracks/' + track.id + '/edit'" target="_blank">Edit</a></li>
        <li><a href="#" v-on:click="player.push([track], album.id)">Queue</a></li>
        <li><a v-if="checkAdmin()" href="#" v-on:click="deleteResource('tracks', track.id)">Delete</a></li>
    </ul>
</template>

<script>
    import player from "../../player.js";

    export default {
        data: function() {
            return {
                albumData: null,
                player: player
            }
        },
        mounted() {
            $.get({
                url: "/albums/" + this.album.id,
                error: err => {
                    // let newWindow = window.open("", "_blank");
                    // newWindow.document.write(err.responseText);
                    // newWindow.stop();
                },
                success: data => {
                    this.albumData = data;
                }
            });
        },
        props: ['album', 'track']
    }
</script>
