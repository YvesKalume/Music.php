<template>
    <div class="img-rounded">
        <img :src="baseUrl + album.id + '/image'"></img><br>
        <div class="title-div">
            <a href="#" v-on:click="setView('album-show', ['setAlbum', album.id])"><b>{{ album.name }}</b></a>
            <div class="dropdown">
                <span class="glyphicon glyphicon-option-vertical dropdown-toggle" data-toggle="dropdown"></span>
                <ul class="dropdown-menu">
                    <li><a href="#">Play Album</a></li>
                </ul>
            </div>
        </div>
        <a href="#">{{ album.artist.name }}</a>
    </div>
</template>

<style scoped>
    a {
        color: black;
    }
    img {
        width: 12vw;
        height: 12vw;
    }
    div.img-rounded {
        background-color: Teal;
        color: black;
        display: inline-block;
        margin: .5vw;
        padding: .5vw;
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
            return {
                baseUrl: document.location.origin + '/albums/'
            }
        },
        mounted() {
            console.log("Display holding album " + this.album.id + " loaded.");
        },
        props: ['album']
    }
</script>
