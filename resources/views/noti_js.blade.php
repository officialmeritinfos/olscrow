<script>
    @if(session('success'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.success("{{ session('success') }}");
    @endif

    @if($message = session('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.error("{{ $message }}");
    @endif

    @if($message = session('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.info("{{ $message }}");
    @endif

    @if($message = session('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.warning("{{ $message }}");
    @endif

{{--    @if ($errors->any())--}}
{{--        toastr.options =--}}
{{--        {--}}
{{--            "closeButton" : true,--}}
{{--            "progressBar" : true--}}
{{--        }--}}
{{--        toastr.warning("{{ $errors->all() }}");--}}
{{--    @endif--}}

    @if($message = session('errors'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.error("{{ $message }}");
    @endif
</script>
