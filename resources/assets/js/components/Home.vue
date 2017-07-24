<template>
    <div class="container" id="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Welcome back.</div>
                    <div class="panel-body">
                        Here's what we have prepared for you.
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Albums</div>
                    <div class="panel-body">
                        <div style="display: flex; flex-wrap: wrap; align-content: space-between; justify-content: space-evenly;">
                            <album-display v-for="album in albums" :album="album" :key="album.id" v-on:dblclick.native="setView('album-show', ['setAlbum', album.id])">
                            </album-display>
                        </div>
                        <br>
                        <button class="btn btn-primary" v-on:click="setView('album-index')">More Albums</button>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Tracks</div>
                    <div class="panel-body">
                        <button class="btn btn-primary" v-on:click="setView('track-index')">More Tracks</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => {
            return {
                albums: null
            }
        },
        mounted() {
            $.get({
                url: document.location.origin + "/albums",
                error: err => {
                    $('#content').html(err.responseText);
                },
                success: data => {
                    this.albums = data;
                }
            });
            console.log('Component mounted.');
        }
    }
</script>
