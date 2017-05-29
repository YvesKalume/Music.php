<template>
    <footer class="navbar navbar-default navbar-fixed-bottom" id="barplayer" style="height: 8vh; background-color: #008080; width: 100%;">
        <audio id="player" style="visibility: hidden;" ref="player" v-on:ended="playFromQueue" v-on:timeupdate="updateDuration">
            <source id="source" type="audio/mp3"></source>
        </audio>
        <div class="container" id="playercontent" style="height: 100%; width: 100%;">
            <div class="row" style="height: 100%;">
                <div class="col-md-1" style="height: 100%; display:flex; align-items:center;">
                    <button id="back" style="background:transparent; border:none;">
                        <span class="glyphicon glyphicon-step-backward" style="color: black; font-size:2vh;"></span>
                    </button>
                    <button class="toggle" id="play" onclick="toggle()" style="margin: 1vh;">
                        <span id="icon" class="glyphicon glyphicon-play" style="font-size:4vh; color: black;"></span>
                    </button>
                    <button id="forward" style="background:transparent; border:none;" v-on:click="playFromQueue">
                        <span class="glyphicon glyphicon-step-forward" style="color: black; font-size:2vh;"></span>
                    </button>
                </div>
                <div class="col-md-2" style="height: 100%; display: flex; align-items: center;">
                    <span id="" style="flex-grow: 1; white-space: nowrap; overflow: hidden; vertical-align: middle;">
                        <p class="trackdata" id="tracktitle" style="font-weight: bold;">{{ title }}</p>
                        <p class="trackdata" id="trackartist">{{ artist }}</p>
                    </span>
                    <span id="duration" style="color: black; margin-left: 1vw;">{{ duration }}</span>
                </div>
                <div class="col-md-9 vertical-center">
                    <div class="bar" id="progressbar" style="width: 100%;">
                        <div class="barvalue" id="progress" style="width: 0%;"></div>
                    </div>
                    <span class="glyphicon glyphicon-volume-up" id="volicon" style="color:black; margin-left: 2vw; margin-right: .5vw; font-size: 2vh;"></span>
                    <div class="bar" id="volumebar" style="width: 10%;">
                        <div class="barvalue" id="volume"></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>
</style>

<script>
    import player from '../player.js';

    $('#back').on('click', e => {
        alert('Back has not yet been implemented');
    });
    $('#forward').on('click', e => {
        playFromQueue();
    });
    $('#progressbar').on('click', e => {
        if (player.paused) return;
        $('#player')[0].currentTime = $('#player')[0].duration * e.offsetX / $('#progressbar')[0].offsetWidth;
    });
    $('#volumebar').on('click', e => {
        let volume = e.offsetX / $('#volumebar')[0].offsetWidth;
        if (volume < 0.5) $("#volicon").attr("class", "glyphicon glyphicon-volume-down");
        else $("#volicon").attr("class", "glyphicon glyphicon-volume-up");
        $('#player')[0].volume = volume;
        $('#volume').css('width', e.offsetX + "px");
    });
    $('#volicon').on('click', e => {
        if ($('#player')[0].muted) {
            $('#player')[0].muted = false;
            if ($('#player')[0].volume < 0.5) $(event.target).attr("class", "glyphicon glyphicon-volume-down");
            else $("#volicon").attr("class", "glyphicon glyphicon-volume-up");
        } else {
            $('#player')[0].muted = true;
            $(event.target).attr("class", "glyphicon glyphicon-volume-off");
        }
    });
    export default {
        data: function() {
            return {
                artist: "-",
                duration: "-:--/-:--",
                title: "No track playing"
            }
        },
        methods: {
            playFromQueue: () => {
                player.playFromQueue();
            },
            updateDuration: () => {
                /**
                 * Checks if there is no duration to cancel the function and prevent overflow errors.
                 */
                if (!e.target.duration) {
                    return;
                }

                let durationString = parseTime(e.target.duration);
                let progress = parseTime(e.target.currentTime);
                this.duration = progress + "/" + durationString;
                $('#progressbar > div').width(`${e.target.currentTime / e.target.duration * 100}%`);
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    };
</script>
