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
                        <table id="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Artists</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr v-for="track in album.tracks">
                                        <td>{{ track.id }}</td>
                                        <td>{{ track.title }}</td>
                                        <td>
                                            <a v-for="artist in track.artists">{{ artist.name }}</a>
                                        </td>
                                        <td><button class="btn btn-success" v-on:click="play(track.id)">Play</button></td>
                                        <td><a class="btn btn-primary" href="/tracks/edit">Edit</a></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import default from '../../player.js';

    export default {
        data: () => {
            return {
                album: {}
            }
        },
        methods: {
            play: id => {
                console.log(player);
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
