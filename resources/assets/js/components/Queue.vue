<template>
    <div class="container" id="container" onload="$('#table').DataTable()">
        <div class="row">
            <div class="col-md-12" id="column">
                <div class="panel panel-default">
                    <div class="panel-heading">Queue</div>
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
                                    <tr v-for="(track, key) in player.queue" style="line-height: 2vw;" v-on:dblclick="play(track)">
                                        <td style="cursor: pointer; text-align: center;" v-on:click="play(track)">{{ key }}</td>
                                        <td>{{ track.title }}</td>
                                        <td>
                                            <a v-for="artist in track.artists">{{ artist.name }}</a>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <span class="glyphicon glyphicon-option-horizontal dropdown-toggle" data-toggle="dropdown" style="cursor: pointer;"></span>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#" v-on:click="play(track)">Play</a></li>
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
</style>

<script>
    import player from '../player.js';

    export default {
        data: () => {
            return {
                player: player
            }
        },
        methods: {
            play: id => {
                player.play(id);
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
