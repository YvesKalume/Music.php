@if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
@else
    <script>
        window.location = "{{ url('client/' . Request::path()) }}";
    </script>
@endif
