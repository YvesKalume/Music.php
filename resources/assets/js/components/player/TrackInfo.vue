<template>
    <div>
        <img :src="'/albums/' + player.queue[0].album + '/image'" style="width: 100%;" onerror="this.src='/img/noalbum.svg';"></img>
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
        }
    }
</script>
