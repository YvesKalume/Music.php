<template>
    <div class="img-rounded">
        <img :src="'/albums/' + album.id + '/image'"></img><br>
        <div class="title-div" style="overflow: hidden; white-space: nowrap; width: 100%; margin-top: .5vw;">
            <a href="#" v-on:click="setView('album-show', ['setAlbum', album.id])" style="display: block; overflow: hidden; white-space: nowrap; width: 12vw; text-overflow: ellipsis;"><b>{{ album.name }}</b></a>
        </div>
        <a href="#">{{ album.artist.name }}</a>
        <div class="dropdown">
            <span class="glyphicon glyphicon-option-vertical dropdown-toggle" data-toggle="dropdown"></span>
            <album-dropdown :album="album"></album-dropdown>
        </div>
    </div>
</template>

<style scoped>
    a {
        /*color: black;*/
        color: white;
    }
    img {
        width: 12vw;
        height: 12vw;
    }
    div.img-rounded {
        /*background-color: Teal;*/
        /*color: black;*/
        display: inline-block;
        margin: .5vw;
        padding: .5vw;
        border: 1px solid;
    }
    p {
        margin-bottom: 0px;
    }
    span {
        margin: auto 0px auto auto;
        float: right;
        cursor: pointer;
    }
    .title-div {
        margin-top: 1vw;
    }
</style>

<script>
    export default {
        data: function() {
            return {}
        },
        mounted() {
            console.log("Display holding album " + this.album.id + " loaded.");
        },
        props: ['album']
    }
</script>
