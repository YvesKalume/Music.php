<template>
    <div class="container" id="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">User Dashboard</div>
                    <div class="panel-body">

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Albums</div>
                    <div class="panel-body">
                        <button class="btn btn-primary" v-on:click="setView('album-index')">More Albums</button>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Tracks</div>
                    <div class="panel-body">
                        <button class="btn btn-primary" v-on:click="setView('track-index')">More Tracks</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => {
            return {

            }
        },
        methods: {
            setView: function(view) {
                this.$store.commit('setView', view);
                this.$emit('view');
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
