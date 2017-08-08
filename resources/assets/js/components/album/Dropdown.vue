<template>
    <ul class="dropdown-menu">
        <li><a href="#" v-on:click="setView('album-show', ['setAlbum', album.id])">View</a></li>
        <li><a href="#" v-on:click="player.play(albumData.tracks)">Play</a></li>
        <li><a href="#" v-if="checkAdmin()" :href="'/albums/' + album.id + '/edit'" target="_blank">Edit</a></li>
        <li><a href="#" v-on:click="player.push(albumData.tracks, album.id)">Queue</a></li>
        <li><a href="#" v-if="checkAdmin()" v-on:click="deleteResource('albums', album.id)">Delete</a></li>
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
        props: ['album']
    }
</script>
