<template>
    <div class="container" id="container" onload="$('#table').DataTable()">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" id="column">
                <div class="panel panel-default">
                    <div class="panel-heading" v-if="album && album.artist">{{ album.artist.name }} - {{ album.name }}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img :src="'/albums/' + this.$store.state.album + '/image'" style="width:100%;">
                            </div>
                            <div class="col-md-9">
                                Insert placeholder for description of album.<br>
                                <button class="btn btn-primary" onclick="add('')">Queue</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Tracks</div>
                    <div class="panel-body">
                        <table id="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th>Title</th>
                                    <th>Artists</th>
                                    <th>More</th>
                                    <th v-if="checkAdmin()">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr v-for="track in album.tracks" style="line-height: 2vw;" v-on:dblclick="play(track.id)">
                                        <td style="cursor: pointer; text-align: center;" v-on:click="play(track.id)">{{ track.id }}</td>
                                        <td>{{ track.title }}</td>
                                        <td>
                                            <a v-for="artist in track.artists">{{ artist.name }}</a>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <span class="glyphicon glyphicon-option-horizontal dropdown-toggle" data-toggle="dropdown" style="cursor: pointer;"></span>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" v-on:click="play(track.id)">Play</a></li>
                                                    <li><a href="#">Queue</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td v-if="checkAdmin()"><a class="btn btn-primary" :href='"/tracks/" + track.id + "/edit"' target="_blank">Edit</a></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    tr:hover {
        background-color: DarkGray;
    }
</style>

<script>
    import player from '../../player.js';

    export default {
        data: () => {
            return {
                album: {}
            }
        },
        methods: {
            play: id => {
                player.play(id);
            }
        },
        mounted() {
            $.get({
                url: document.location.origin + "/albums/" + this.$store.state.album,
                error: err => {
                    $('#content').html(err.responseText);
                },
                success: data => {
                    this.album = data;
                    // $('#table').DataTable();
                }
            });
            console.log('Component mounted.')
        }
    }
</script>
