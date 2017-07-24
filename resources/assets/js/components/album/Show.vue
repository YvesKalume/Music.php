<template>
    <div class="container" id="container" onload="$('#table').DataTable()">
        <div class="row">
            <div class="col-md-12" id="column">
                <div class="panel panel-default">
                    <div class="panel-heading" v-if="album && album.artist">{{ album.artist.name }} - {{ album.name }}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img :src="'/albums/' + this.$store.state.album + '/image'" style="width:100%;">
                            </div>
                            <div class="col-md-9">
                                Insert placeholder for description of album.<br>
                                <button class="btn btn-primary" v-on:click="queue">Queue</button>
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
                                        <td style="cursor: pointer; text-align: center;" v-on:click="play(track.id)">
                                            <span></span>
                                            <span>{{ track.id }}</span>
                                        </td>
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
    tbody > tr:hover {
        background-color: DarkGray;
    }
    tbody > tr td span:first-child {

    }
</style>

<script>
    import player from '../../player.js';

    export default {
        data: () => {
            return {
                // If set to null, the application will complain about not finding tracks of null. Leave as empty object.
                album: {}
            }
        },
        methods: {
            play: id => {
                player.play(id);
            },
            queue: function() {
                console.log("Adding tracks to queue");
                for (let i = 0; i < this.album.tracks.length; i++) {
                    player.queue.push(this.album.tracks[i]);
                }
                if (!player.playing) {
                    console.log("Player is not currently playing. Starting playback");
                    player.playFromQueue();
                }
            }
        },
        mounted() {
            $.get({
                url: document.location.origin + "/albums/" + this.$store.state.album,
                error: err => {
                    let newWindow = window.open("", "_blank");
                    newWindow.document.write(err.responseText);
                    newWindow.stop();
                },
                success: data => {
                    this.album = data;
                    // $('#table').DataTable();
                }
            });
            $('tbody').on('mouseenter', 'tr > td:first-child', event => {
                $(event.target).find("span:first-child").addClass("glyphicon glyphicon-play");
                $(event.target).find("span:nth-child(2)").hide();
            });
            $('tbody').on('mouseleave', 'tr > td:first-child', event => {
                $(event.target).find("span:first-child").removeClass("glyphicon glyphicon-play");
                $(event.target).find("span:nth-child(2)").show();
            });
            console.log('Component mounted.')
        }
    }
</script>
