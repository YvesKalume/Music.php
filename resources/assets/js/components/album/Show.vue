<template>
    <div class="container" id="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" id="column">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ album }} - {{ album }}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="/albums/image/" style="width:100%;">
                            </div>
                            <div class="col-md-9">
                                Insert placeholder for description of album.<br>
                                <button class="btn btn-primary" onclick="add('')">Queue</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Tracks</div>
                    <div class="panel-body">
                        <table id="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Artists</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                        </td>
                                        <td><button class="btn btn-success" onclick="play('')">Play</button></td>
                                        <td><a class="btn btn-primary" href="/tracks/edit">Edit</a></td>
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
    export default {
        data: () => {
            return {
                album: null
            }
        },
        methods: {

        },
        mounted() {
            $('#table').DataTable();
            this.$on('album-show', arg => {
                console.log('caughtevent');
                $.get({
                    url: document.location.origin + "/albums/" + arg,
                    error: err => {
                        $('#content').html(err.responseText);
                    },
                    success: data => {
                        this.album = data;
                    }
                });
            });
            console.log('Component mounted.')
        }
    }
</script>
