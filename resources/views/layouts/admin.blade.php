<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('vendor/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/style.css') }}">
    @stack('styles')
    <!-- End layout styles -->
</head>
<body>
<div class="container-scroller">
    @yield('content')
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{ asset('vendor/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('vendor/js/off-canvas.js') }}"></script>
<script src="{{ asset('vendor/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('vendor/js/misc.js') }}"></script>
<script src="{{ asset('vendor/js/settings.js') }}"></script>
<script src="{{ asset('vendor/js/todolist.js') }}"></script>
@stack('scripts')
<!-- endinject -->
</body>
</html>