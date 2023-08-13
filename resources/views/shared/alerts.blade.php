<script>
    @if (session('success'))
     toastr.success("{{ session('success') }}", "{{ __('common.done') }}");
    @endif

    @if (session('message'))
    toastr.success("{{ session('message') }}", "{{ __('common.done') }}");
    @endif

    @if(session('info'))
    toastr.info("{{ session('info') }}", "{{ __('common.info') }}");
    @endif

    @if(session('warning'))
    toastr.warning("{{ session('warning') }}", "{{ __('common.warning') }}");
    @endif

    @if ($errors->any())
          @if($errors->get('error'))
            @foreach($errors->get('error') as $error)
            toastr.error("{{$error}}", "{{__('common.error')}}");
           @endforeach
        @else
            @foreach($errors->all() as $error)
            toastr.error("{{$error}}", "{{__('common.error')}}");
            @endforeach
        @endif
    @endif

    function commonError(){
        toastr.error(" {{ __('common.something_went_wrong') }}", "{{__('common.error')}}");
    }


</script>
