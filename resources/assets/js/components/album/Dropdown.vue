<template>
    <ul class="dropdown-menu">
        <li><a href="#" v-on:click="setView('album-show', ['setAlbum', album.id])">View</a></li>
        <li><a href="#" v-on:click="play(track)">Play</a></li>
        <li><a href="#" v-if="checkAdmin()" :href="edit(album.id)" target="_blank">Edit</a></li>
        <li><a href="#" v-on:click="push([track])">Queue</a></li>
        <li><a href="#" v-on:click="deleteResource('albums', album.id)">Delete</a></li>
    </ul>
</template>

<script>
    export default {
        props: ['album']
    }
</script>
