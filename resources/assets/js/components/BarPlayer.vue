<template>
    <footer class="navbar navbar-default navbar-fixed-bottom" id="barplayer">
        <audio id="audio" style="visibility: hidden;" ref="player" v-on:ended="player.next()" v-on:timeupdate="updateDuration">
            <source id="source" type="audio/mp3"></source>
        </audio>
        <div class="container" id="playercontent" style="height: 100%; width: 100%;">
            <div class="row" style="height: 100%;">
                <div class="col-md-2" style="height: 100%; display:flex; align-items:center;">
                    <button id="back" style="background:transparent; border:none;" onclick="alert('Back has not yet been implemented')">
                        <span class="glyphicon glyphicon-step-backward backspan"></span>
                    </button>
                    <button class="toggle" id="play" v-on:click="player.toggle()" style="margin: 1vh;">
                        <span id="icon" class="glyphicon glyphicon-play"></span>
                    </button>
                    <!-- Typically I would remove the parenthesis for readability,
                    but this would mess up the "this" reference. -->
                    <button id="forward" style="background:transparent; border:none;" v-on:click="player.next()">
                        <span class="glyphicon glyphicon-step-forward backspan"></span>
                    </button>
                </div>
                <div class="col-md-1" style="height: 100%; display: flex; align-items: center;">
                    <!-- <span id="spancontent" style="flex-grow: 1; white-space: nowrap; overflow: hidden; vertical-align: middle;"
                        v-on:mouseenter="startScroll" v-on:mouseleave="endScroll">
                        <p class="trackdata" style="font-weight: bold;">{{ player.status.getData().title }}</p>
                        <p class="trackdata">{{ player.status.getData().artists }}</p>
                    </span> -->
                    <span id="duration">{{ duration }}</span>
                </div>
                <div class="col-md-9 vertical-center">
                    <div class="bar" id="progressbar" style="width: 100%;" v-on:click="setProgress">
                        <div class="barvalue" id="progress" v-bind:style="{ width: percent + '%' }"></div>
                    </div>
                    <span class="glyphicon" id="volicon" :class="getVolumeStatus()" v-on:click="mute()"></span>
                    <div class="bar" id="volumebar" style="width: 10%;" v-on:click="setVolume">
                        <div class="barvalue" id="volume" v-bind:style="{ width: volume * 100 + '%' }"></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>

    #icon {
        font-size:4vh;
        /*color: black;*/
    }
    .backspan {
        /*color: black; */
        font-size:2vh;
    }

    #duration {
        /*color: black;*/
        margin-left: 1vw;
    }
    .toggle {
        height: 75%;
        line-height: 87.5%;
        width: 7vh;
        display: flex;
        justify-content: center;
        background: transparent;
        border: none;
        /*border-radius: 100%;*/
        /*border-color: black;*/
        align-items: center;
    }

    .trackdata {
        margin: 0;
        /*color: black;*/
    }

    .scroll {
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
        /*border: 2px solid black;*/
        border: 2px solid;
    }

    .bar > div {
        /*background: #008080;*/
        background: #2a9fd6;
        height: 100%;
        border-radius: 1vw;
    }

    .vertical-center {
        height: 100%;
        display: flex;
        align-items: center;
    }

    #barplayer {
        height: 8vh;
        /*background-color: #008080;*/
        width: 100%;
    }

    #volicon {
        /*color: black;*/
        margin-left: 2vw;
        margin-right: .5vw;
        font-size: 2vh;
    }
</style>

<script>
    import player from '../player.js';

    export default {
        data: function() {
            return {
                duration: "-:--/-:--",
                percent: 0,
                muted: false,
                volume: 1,
                player: player
            }
        },
        methods: {
            endScroll: e => {
                console.log("Ending text scrolling...");
                $(e.target).children().removeClass("scroll");
            },
            getVolumeStatus: function() {
                if (this.muted) {
                    return "glyphicon-volume-off";
                } else if (this.volume < 0.5) {
                    return "glyphicon-volume-down";
                } else {
                    return "glyphicon-volume-up";
                }
            },
            mute: function() {
                // But why isn't this binded?! Well, HTML's muted attribute is only initial and is not a constant bind. :/
                if ($('#audio')[0].muted) {
                    $('#audio')[0].muted = false;
                    this.muted = false;
                } else {
                    $('#audio')[0].muted = true;
                    this.muted = true;
                }
            },
            playFromQueue: () => {
                player.queue.splice(0, 1);
                player.playFromQueue();
            },
            setProgress: e => {
                if (audio.paused) return;
                $('#audio')[0].currentTime = $('#audio')[0].duration * e.offsetX / $('#progressbar')[0].offsetWidth;
            },
            setVolume: function(e) {
                let volume = e.offsetX / $('#volumebar')[0].offsetWidth;
                audio.volume = volume;
                this.volume = volume;
            },
            startScroll: function(e) {
                console.log("Triggering text scrolling...");
                $(e.target).children().addClass("scroll");
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
            console.log('BarPlayer mounted.')
        }
    };
</script>
