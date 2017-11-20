<template>
    <!-- container-fluid is used in place of container so that the size of the
    container doesn't expand beyond the page. -->
    <div class="container-fluid" id="container" onload="$('#table').DataTable()">
        <div class="row">
            <div class="col-md-12" id="column">
                <div class="panel panel-default">
                    <div class="panel-heading" v-if="album && album.artist">{{ album.artist.name }} - {{ album.name }}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img :src="'/albums/' + this.$store.state.album + '/image'" onerror="this.src='/img/noalbum.svg'" style="width:100%;">
                            </div>
                            <div class="col-md-9" style="height: 100%;">
                                <p>Insert placeholder for description of album.</p>
                                <button class="btn btn-primary" v-on:click="push(album.tracks)">Queue</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Tracks</div>
                    <div class="panel-body">
                        <table class="img-rounded media-listing table">
                            <thead>
                                <tr class="media-row">
                                    <th style="text-align: center; width: 5%;">#</th>
                                    <th style="width: 50%;">Title</th>
                                    <th style="width: 40%;">Artists</th>
                                    <th style="width: 5%;">More</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr class="media-row" v-for="track in album.tracks" style="width: 100%;" v-on:dblclick="play(track)">
                                        <td style="cursor: pointer; text-align: center;" v-on:click="play(track)">
                                            <span></span>
                                            <span>{{ track.id }}</span>
                                        </td>
                                        <td class="ellipsis">{{ track.title }}</td>
                                        <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; display: inline-block; width: 100%;">
                                            <a v-for="(artist, key) in track.artists" href="#">
                                                {{ artist.name }}<span v-if="key < track.artists.length - 1">, </span>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <span class="glyphicon glyphicon-option-horizontal dropdown-toggle" data-toggle="dropdown" style="cursor: pointer;"></span>
                                                <track-dropdown :album="album" :track="track"></track-dropdown>
                                            </div>
                                        </td>
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
    import player from '../../player.js';

    export default {
        data: () => {
            return {
                // If set to null, the application will complain about not finding tracks of null. Leave as empty object.
                album: {},
                player: player
            }
        },
        methods: {
            play: function(track) {
                let parsedTrack = track;
                parsedTrack.album = this.album.id;
                player.play(parsedTrack);
            },
            push: function(tracks) {
                let parsedTracks = tracks;
                for (let i = 0; i < parsedTracks.length; i++) {
                    parsedTracks[i].album = this.album.id;
                }
                player.push(parsedTracks);
            }
        },
        mounted() {
            $.get({
                url: document.location.origin + "/albums/" + this.$route.params.id,
                error: err => {
                    let newWindow = window.open("", "_blank");
                    newWindow.document.write(err.responseText);
                    newWindow.stop();
                },
                success: data => {
                    this.album = data;
                    this.$nextTick(() => {
                        $('.media-listing').DataTable();
                    });
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
            console.log('Component mounted for album ' + this.$route.params.id + '.')
        }
    }
</script>
