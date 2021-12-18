

 <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('webassets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('webassets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('webassets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- hijri -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script> --}}
    {{-- <script src="{{ asset('webassets/plugins/bootstrap-hijri-datetimepickermin.js')}}"></script> --}}


    <script src="{{ asset('webassets/plugins/bootstrap-hijri-datetimepicker.js')}}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script> --}}
    <script src="{{ asset('webassets/dist/js/bootstrap-hijri-datepicker.js')}}"></script>
    <script src="{{ asset('webassets/dist/js/bootstrap-hijri-datepicker.min.js')}}"></script>
    <script src="{{ asset('webassets/dist/js/bootstrap-hijri-datetimepicker.js?v2')}}"></script>
    {{-- <script src="{{ asset('webassets/dist/js/bootstrap-hijri-datetimepicker.min.js')}}"></script> --}}
   <!-- tiny text -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.11/tinymce.min.js"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('webassets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="{{ asset('webassets/dist/js/adminlte.js')}}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('webassets/dist/js/demo.js')}}"></script>

    <script src="{{ asset('webassets/plugins/select2/js/select2.full.min.js')}}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <!-- PAGE SCRIPTS -->
    {{-- <script src="{{ asset('webassets/dist/js/pages/dashboard2.js')}}"></script> --}}
    <script>
        $(function() {
            //Initialize Select2 Elements
            // $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        })
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
    @yield('scripts')

</body>

</html>
