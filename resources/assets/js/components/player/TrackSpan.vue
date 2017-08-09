<template>
    <!-- Once upon a time, this was a span and not a div. Then the text overflowed because spans aren't block elements. -->
    <div id="spancontent" :title='player.status.getData().title + "\n" + player.status.getData().artists' v-on:mouseenter="startScroll" v-on:mouseleave="endScroll">
        <p class="trackdata" style="font-weight: bold;">{{ player.status.getData().title }}</p>
        <p class="trackdata">{{ player.status.getData().artists }}</p>
    </div>
</template>

<style scoped>
    #spancontent {
        white-space: nowrap;
        overflow: hidden;
        vertical-align: middle;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding-top: .5vh;
        padding-left: .5vw;
    }

    p {
        margin-bottom: 0;
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
</style>

<script>
    import player from '../../player.js';

    export default {
        data: () => {
            return {
                player: player
            };
        },
        methods: {
            endScroll: function(e) {
                console.log("Ending text scrolling...");
                $(e.target).children().removeClass("scroll");
            },
            startScroll: function(e) {
                console.log("Triggering text scrolling...");
                $(e.target).children().addClass("scroll");
            }
        }
    }
</script>
