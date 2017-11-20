<template>
    <!-- container-fluid is used in place of container so that the size of the
    container doesn't expand beyond the page. -->
    <div class="container-fluid">
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
                    <table class="media-listing table">
                        <thead>
                            <tr class="media-row">
                                <th style="width: 5%; text-align: center;">ID</th>
                                <th style="width: 50%;">Name</th>
                                <th style="width: 40%;">Artist</th>
                                <th style="width: 5%;">More</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="media-row" v-for="album in albums">
                                <td class="id-entry">{{ album.id }}</td>
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
