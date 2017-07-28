<template>
    <div>
        <img :src="getLink()" style="width: 100%;"></img>
        <div style="height: 8vh; border-right: 1px solid;">
            <track-span></track-span>
        </div>
    </div>
</template>

<script>
    import player from '../../player.js';

    export default {
        data: function() {
            return {
                player: player
            }
        },
        methods: {
            getLink() {
                if (this.player.queue[0]) {
                    return '/albums/' + this.player.queue[0].album + '/image';
                }
                return '/img/noalbum.svg';
            }
        }
    }
</script>
