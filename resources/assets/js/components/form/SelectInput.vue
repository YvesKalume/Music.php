<template>
    <div class="form-group">
        <label :for="name" class="col-md-4 control-label">
            <span class="glyphicon glyphicon-refresh" title="Press to reload values."
                v-on:click="loadValues()"></span> {{label}}
        </label>

        <div class="col-md-6">
            <select class="artists form-control" :id="name" :name="name" style="width: 100%" :multiple="multiple" required>
                <option selected disabled value="select" v-if="!multiple && values.length === 0">Select...</option>
                <option v-for="item in array" v-on:mousedown="toggle" :value="item.id" selected v-if="inValues(item.id)">{{ item.name }}</option>
                <option v-for="item in array" v-on:mousedown="toggle" :value="item.id" v-if="!inValues(item.id)">{{ item.name }}</option>
                <option id="addartist" value="addartist" v-on:click="addItem">+ Add {{ type.charAt(0).toUpperCase() + type.slice(1) }}</option>
            </select>
        </div>
    </div>
</template>

<style scoped>
    span {
        cursor: pointer;
    }
</style>

<script>
    export default {
        data: () => {
            return {
                array: null,
                values: []
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
                            this.loadValues();
                            alert("Item added successfully!");
                            // $(event.target).parent().prepend($('<option>', {
                            //     value: data.id,
                            //     text: artist
                            // }));
                        }
                    }
                });
            },
            inValues: function (id) {
                console.log("Value " + id + " returns " + (this.values.indexOf(id) !== -1) + " for inValues");
                return this.values.indexOf(id) !== -1;
            },
            loadValues: function() {
                $.ajax({
                    url: document.location.origin + "/" + this.type,
                    error: err => {
                        console.log(err);
                    },
                    success: data => {
                        console.log("Fetched data values. Now storing...");
                        this.array = data;
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
            this.loadValues();

            if (this.value) {
                let json = JSON.parse(this.value);
                if (Array.isArray(json)) {
                    for (let i = 0; i < json.length; i++) {
                        this.values.push(json[i].id);
                    }
                } else {
                    this.values = [json.id];
                }
            }

            console.log("SelectInput mounted successfully");
        },
        /**
         * Properties used to define the select input.
         * @param {string} label - The label for the input that will appear on the form. Required.
         * @param {boolean} multiple - Whether or not this input can select multiple values.
         * @param {string} name - The name of the input that the server will receive. Required.
         * @param {string} type - The model type that this select input has access to.
         * @param {string|string[]} value - The default value or values for this select input.
         */
        props: ["name", "label", "multiple", "type", "value"]
    }
</script>
