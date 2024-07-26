<?php
$settings = getSettings();
?>
<!DOCTYPE html>
<html lang="{{isset($settings['default_language']) ? $settings['default_language'] : 'en'}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{isset($settings['site_title']) ? $settings['site_title'] : 'mzo'}} | {{ $pageTitle }}</title>
    <link rel="shortcut icon" href="/{{isset($settings['favicon_icon']) ? $settings['favicon_icon'] : 'mzo'}}">
    <!-- Custom styles for this template-->
    <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/datatables/buttons.dataTables.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/toaster/build/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">

    @stack('styles')
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        {{ $slot }}
    </div>
        <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

      <!-- Bootstrap core JavaScript-->
      <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
      <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

      <!-- Core plugin JavaScript-->
      <script src="{{asset('assets/plugins/jquery-easing/jquery.easing.min.js')}}"></script>
      <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.js') }}"></script>
      <!-- Custom scripts for all pages-->
      <script src="{{ asset('assets/plugins/toaster/build/toastr.min.js') }}"></script>
      <script src="{{ asset('assets/plugins/select2/select2.min.js')}}"></script>
      <script src="{{asset('assets/js/sweetalert2.js')}}"></script>
      <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>
      <script src="{{asset('assets/js/custom.js')}}"></script>
      <x-toastr />
    @stack('scripts')
</body>
</html>
