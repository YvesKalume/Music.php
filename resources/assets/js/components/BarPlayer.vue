<template>
    <footer class="navbar navbar-default navbar-fixed-bottom" id="barplayer" style="height: 8vh; background-color: #008080; width: 100%;">
        <audio id="audio" style="visibility: hidden;" ref="player" v-on:ended="playFromQueue" v-on:timeupdate="updateDuration">
            <source id="source" type="audio/mp3"></source>
        </audio>
        <div class="container" id="playercontent" style="height: 100%; width: 100%;">
            <div class="row" style="height: 100%;">
                <div class="col-md-1" style="height: 100%; display:flex; align-items:center;">
                    <button id="back" style="background:transparent; border:none;" onclick="alert('Back has not yet been implemented')">
                        <span class="glyphicon glyphicon-step-backward" style="color: black; font-size:2vh;"></span>
                    </button>
                    <button class="toggle" id="play" v-on:click="toggle()" style="margin: 1vh;">
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
                    <div class="bar" id="progressbar" style="width: 100%;" v-on:click="setProgress">
                        <div class="barvalue" id="progress" v-bind:style="{ width: percent + '%' }"></div>
                    </div>
                    <span class="glyphicon glyphicon-volume-up" id="volicon" style="color:black; margin-left: 2vw; margin-right: .5vw; font-size: 2vh;" v-on:click="mute"></span>
                    <div class="bar" id="volumebar" style="width: 10%;" v-on:click="setVolume">
                        <div class="barvalue" id="volume" v-bind:style="{ width: volume * 100 + '%' }"></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>
    .toggle {
        height: 75%;
        line-height: 87.5%;
        width: 7vh;
        display: flex;
        justify-content: center;
        background: transparent;
        border-radius: 100%;
        border-color: black;
        align-items: center;
    }

    .trackdata {
        margin: 0;
        color: black;

    }

    .trackdata:hover {
        /* Starting position */
        -moz-transform:translateX(100%);
        -webkit-transform:translateX(100%);
        transform:translateX(100%);
        /* Apply animation to this element */
        -moz-animation: scroll-left 8s linear infinite;
        -webkit-animation: scroll-left 8s linear infinite;
        animation: scroll-left 8s linear infinite;
    }

    /* Move it (define the animation) */
    @-moz-keyframes scroll-left {
        0%   { -moz-transform: translateX(100%); }
        100% { -moz-transform: translateX(-100%); }
    }
    @-webkit-keyframes scroll-left {
        0%   { -webkit-transform: translateX(100%); }
        100% { -webkit-transform: translateX(-100%); }
    }
    @keyframes scroll-left {
        0%   {
            -moz-transform: translateX(100%); /* Browser bug fix */
            -webkit-transform: translateX(100%); /* Browser bug fix */
            transform: translateX(100%);
        }
        100% {
            -moz-transform: translateX(-100%); /* Browser bug fix */
            -webkit-transform: translateX(-100%); /* Browser bug fix */
            transform: translateX(-100%);
        }
    }

    .bar {
        background: gray;
        border-radius: 1vw;
        height: 1vh;
        border: 2px solid black;
    }

    .bar > div {
        background: #008080;
        height: 100%;
        border-radius: 1vw;
    }

    .vertical-center {
        height: 100%;
        display: flex;
        align-items: center;
    }
</style>

<script>
    import player from '../player.js';

    export default {
        data: function() {
            return {
                artist: "-",
                duration: "-:--/-:--",
                percent: 0,
                title: "No track playing",
                volume: 1
            }
        },
        methods: {
            mute: e => {
                if ($('#audio')[0].muted) {
                    $('#audio')[0].muted = false;
                    if ($('#audio')[0].volume < 0.5) $(event.target).attr("class", "glyphicon glyphicon-volume-down");
                    else $("#volicon").attr("class", "glyphicon glyphicon-volume-up");
                } else {
                    $('#audio')[0].muted = true;
                    $(e.target).attr("class", "glyphicon glyphicon-volume-off");
                }
            },
            playFromQueue: () => {
                player.playFromQueue();
            },
            toggle: () => {
                player.toggle();
            },
            setProgress: e => {
                if (audio.paused) return;
                $('#audio')[0].currentTime = $('#audio')[0].duration * e.offsetX / $('#progressbar')[0].offsetWidth;
            },
            setVolume: function(e) {
                let volume = e.offsetX / $('#volumebar')[0].offsetWidth;
                if (volume < 0.5) $("#volicon").attr("class", "glyphicon glyphicon-volume-down");
                else $("#volicon").attr("class", "glyphicon glyphicon-volume-up");
                audio.volume = volume;
                this.volume = volume;
            },
            updateDuration: function(e) {
                /**
                 * Checks if there is no duration to cancel the function and prevent overflow errors.
                 */
                if (!e.target.duration) {
                    return;
                }

                let durationString = player.parseTime(e.target.duration);
                let progress = player.parseTime(e.target.currentTime);
                this.duration = progress + "/" + durationString;
                this.percent = e.target.currentTime / e.target.duration * 100;
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    };
</script>
