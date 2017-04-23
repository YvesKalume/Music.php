@extends('ajax')

<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}"/>
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Actions</div>
            <div class="panel-body">
                @yield('actions')
            </div>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                @yield('heading')
            </div>
            <div class="panel-body">
                <table id="table" style="width: 100%">
                    <thead>
                        <tr>
                            @yield('columns')
                        </tr>
                    </thead>
                    <tbody>
                        @yield('rows')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    var callDelete = url => {
        let formData = new FormData();
        formData.append("_method", "DELETE");
        formData.append('_token', '{{ csrf_token() }}');
        $.post({
            url: document.location.origin + url,
            data: formData,
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.status === "success") {
                    alert("Track deleted successfully!");
                }
            }
        });
    };

    $('#table').DataTable();
</script>
