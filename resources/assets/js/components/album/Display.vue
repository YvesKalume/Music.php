<template>
    <div>
        <img :src="baseUrl + album.id + '/image'"></img>
        <p>{{ album.name }}</p>
        <p>{{ album.artist.name }}</p>
    </div>
</template>

<style scoped>
    img {
        width: 12vw;
        height: 12vw;
    }
    div {
        background-color: Teal;
        color: black;
        cursor: pointer;
        display: inline-block;
        margin: .5vw;
        padding: .5vw;
    }
</style>

<script>
    export default {
        data: function() {
            return {
                baseUrl: document.location.origin + '/albums/'
            }
        },
        props: ['album']
    }
</script>
