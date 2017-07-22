<template>
    <div class="form-group">
        <label :for="name" class="col-md-4 control-label">{{label}}</label>

        <div class="col-md-6">
            <select class="artists form-control" :id="name" :name="name" style="width: 100%" required>
                <option selected disabled value="select">Select Artist</option>
                <option v-for="artist in artists" :value="artist.id">{{ artist.name }}</option>
                <option id="addartist" value="addartist">+ Add Artist</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => {
            return {
                artists: null
            }
        },
        mounted() {
            $.ajax({
                url: document.location.origin + "/artists",
                error: err => {
                    console.log(err);
                },
                success: data => {
                    this.artists = data;
                }
            });
            $('select').on('change', event => {
                if ($(event.target).val() !== "addartist") return;
                $(event.target).prop("selected", true);
                let artist = prompt("Please enter the name of the artist you would like to add.");
                if (!artist) {
                    return alert("Please enter a name for the artist.");
                }
                let formData = new FormData();
                formData.append("name", artist);
                formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                $.post({
                   url: document.location.origin + "/artists",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        if(data.status === "success") {
                            alert("Artist added successfully!");
                            $('.artists').prepend($('<option>', {
                                value: data.id,
                                text: artist
                            }));
                        }
                    }
                });
                $("select").val("select");
            });
            console.log("SelectInput mounted successfully");
        },
        props: ["name", "label"]
    }
</script>
