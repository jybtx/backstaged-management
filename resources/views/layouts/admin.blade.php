<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendor/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendor/css/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/owl.theme.default.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    @stack('styles')
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('vendor/css/style.css') }}">
    <!-- End layout styles -->
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        @include('layouts.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper" style="min-height: 100vh;">
        <!-- partial:partials/_navbar.html -->
            @include('layouts.navbar')
        <!-- partial -->
        <div class="main-panel">
          @yield('content')
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          @include('layouts.footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('vendor/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('vendor/js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/js/progressbar.min.js') }}"></script>
    <script src="{{ asset('vendor/js/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('vendor/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('vendor/js/owl.carousel.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('vendor/js/off-canvas.js') }}"></script>
    <script src="{{ asset('vendor/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('vendor/js/misc.js') }}"></script>
    <script src="{{ asset('vendor/js/settings.js') }}"></script>
    <script src="{{ asset('vendor/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('vendor/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->
    <script type="text/javascript" src="{{ asset('vendor/layer/layer.js') }}"></script>
    @stack('scripts')
  </body>
</html>