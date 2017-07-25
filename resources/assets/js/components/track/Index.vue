<template>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Actions</div>
                <div class="panel-body">
                    <a class="btn btn-primary" :href="create" v-if="checkAdmin()" target="_blank">Upload Tracks</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Tracks</div>
                <div class="panel-body">
                    <table id="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Artists</th>
                                <th>More</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="track in tracks" style="line-height: 2vw;">
                                <td>{{ track.id }}</td>
                                <td>{{ track.title }}</td>
                                <td>{{ parseArtists(track.artists) }}</td>
                                <td>
                                    <div class="dropdown">
                                        <span class="glyphicon glyphicon-option-horizontal dropdown-toggle" data-toggle="dropdown" style="cursor: pointer;"></span>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" v-on:click="player.play(track)">Play</a></li>
                                            <li><a href="#">Queue</a></li>
                                            <li v-if="checkAdmin()"><a href="#">Edit</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import player from '../../player.js';

    export default {
        data: () => {
            return {
                tracks: null,
                create: document.location.origin + "/tracks/create",
                player: player
            }
        },
        methods: {
            parseArtists: (artists) => {
                let artistString = "";
                for (let i = 0; i < artists.length; i++) {
                    artistString+=artists[i].name;
                    if (i < artists.length - 1) {
                        artistString+=", ";
                    }
                }
                return artistString;
            }
        },
        mounted() {
            $.get({
                url: document.location.origin + "/tracks",
                error: err => {
                    $('#content').html(err.responseText);
                },
                success: data => {
                    this.tracks = data;
                }
            });
            console.log('Component mounted.');
        }
    }
</script>
