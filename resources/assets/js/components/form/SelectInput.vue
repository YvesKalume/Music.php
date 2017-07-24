<template>
    <div class="form-group">
        <label :for="name" class="col-md-4 control-label">{{label}}</label>

        <div class="col-md-6">
            <select class="artists form-control" :id="name" :name="name" style="width: 100%" :multiple="multiple" required>
                <option selected disabled value="select" v-if="!multiple">Select...</option>
                <option v-for="item in array" v-on:mousedown="toggle" :value="item.id">{{ item.name }}</option>
                <option id="addartist" value="addartist" v-on:click="addItem">+ Add {{ type.charAt(0).toUpperCase() + type.slice(1) }}</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => {
            return {
                array: null
            }
        },
        methods: {
            addItem: function(event) {
                $(event.target).prop("selected", false);
                let artist = prompt("Please enter the name of the item you would like to add.");
                if (!artist) {
                    return alert("Please enter a name for the item.");
                }
                let formData = new FormData();
                formData.append("name", artist);
                formData.append("quicksave", true);
                $.post({
                    url: document.location.origin + "/" + this.type,
                    data: formData,
                    contentType: false,
                    processData: false,
                    error: (e) => {
                        console.log(e.responseText);
                        alert("Error on adding item...")
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        if(data.status === "success") {
                            alert("Item added successfully!");
                            $(event.target).parent().prepend($('<option>', {
                                value: data.id,
                                text: artist
                            }));
                        }
                    }
                });
            },
            toggle: function(e) {
                if (!this.multiple) return;
                e.preventDefault();
                $(e.target).prop("selected", !$(e.target).prop("selected"));
            }
        },
        mounted() {
            $.ajax({
                url: document.location.origin + "/" + this.type,
                error: err => {
                    console.log(err);
                },
                success: data => {
                    this.array = data;
                }
            });

            console.log("SelectInput mounted successfully");
        },
        props: ["name", "label", "multiple", "type"]
    }
</script>
