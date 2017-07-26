<template>
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Actions</div>
                <div class="panel-body">
                    <a class="btn btn-primary" :href="create" v-if="checkAdmin()" target="_blank">Add Album</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Albums</div>
                <div class="panel-body">
                    <table id="table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Artist</th>
                                <th>More</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="album in albums">
                                <td>{{ album.id }}</td>
                                <td>{{ album.name }}</td>
                                <td>{{ album.artist.name }}</td>
                                <td>
                                    <div class="dropdown">
                                        <span class="glyphicon glyphicon-option-horizontal dropdown-toggle" data-toggle="dropdown" style="cursor: pointer;"></span>
                                        <album-dropdown :album="album"></album-dropdown>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => {
            return {
                albums: null,
                create: document.location.origin + "/albums/create"
            }
        },
        methods: {
            edit: id => {
                return "/albums/" + id + "/edit"
            }
        },
        mounted() {
            $.get({
                url: document.location.origin + "/albums",
                error: err => {
                    $('#content').html(err.responseText);
                },
                success: data => {
                    this.albums = data;
                }
            });
            console.log('Component mounted.');
        }
    }
</script>
