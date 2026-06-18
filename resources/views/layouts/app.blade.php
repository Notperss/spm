<!doctype html>
<html lang="id">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!-- Primary Meta Tags -->
  <title>{{ env('APP_NAME') }} | @yield('title')</title>
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
  <meta name="title" content="Volt - Free Bootstrap 5 Dashboard" />
  {{-- <meta name="author" content="Themesberg" />
  <meta name="description"
    content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS." />
  <meta name="keywords"
    content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, themesberg, themesberg dashboard, themesberg admin dashboard" />
  <link rel="canonical" href="https://themesberg.com/product/admin-dashboard/volt-premium-bootstrap-5-dashboard" /> --}}

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('dist/assets/img/favicon/apple-touch-icon.png') }}" />
  <link rel="icon" type="image/png" sizes="32x32"
    href="{{ asset('dist/assets/img/favicon/favicon-32x32.png') }}" />
  <link rel="icon" type="image/png" sizes="16x16"
    href="{{ asset('dist/assets/img/favicon/favicon-16x16.png') }}" />
  <link rel="manifest" href="{{ asset('dist/assets/img/favicon/site.webmanifest') }}" />
  <link rel="mask-icon" href="{{ asset('dist/assets/img/favicon/safari-pinned-tab.svg') }}" color="#ffffff" />
  <meta name="msapplication-TileColor" content="#ffffff" />
  <meta name="theme-color" content="#ffffff" />

  @stack('before-style')
  <!-- Sweet Alert -->
  <link type="text/css" href="{{ asset('dist/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />
  <!-- Notyf -->
  {{-- <link type="text/css" href="{{ asset('dist/vendor/notyf/notyf.min.css') }}" rel="stylesheet" /> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.css" />
  <!-- Volt CSS -->
  <link type="text/css" href="{{ asset('dist/css/volt.css') }}" rel="stylesheet" />
  @stack('after-style')
</head>

<body>


  <x-sidebar />

  <x-validation-errors />

  <main class="content">

    <x-header />

    @yield('content')

    <x-footer />
    <!--Footer block-->
  </main>
  @stack('before-script')
  <!-- Core -->
  <script src="{{ asset('dist/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
  <script src="{{ asset('dist/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- Vendor JS -->
  <script src="{{ asset('dist/vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>
  <!-- Slider -->
  {{-- <script src="{{ asset('dist/vendor/nouislider/dist/nouislider.min.js') }}"></script> --}}
  <!-- Smooth scroll -->
  <script src="{{ asset('dist/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
  <!-- Charts -->
  {{-- <script src="{{ asset('dist/vendor/chartist/dist/chartist.min.js') }}"></script>
  <script src="{{ asset('dist/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script> --}}
  {{-- <!-- Datepicker -->
  <script src="{{ asset('dist/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script> --}}
  <!-- Sweet Alerts 2 -->
  <script src="{{ asset('dist/vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
  <!-- Moment JS -->
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script> --}}
  <!-- Vanilla JS Datepicker -->
  {{-- <script src="{{ asset('dist/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script> --}}
  <!-- Simplebar -->
  <script src="{{ asset('dist/vendor/simplebar/dist/simplebar.min.js') }}"></script>

  <!-- Github buttons -->
  {{-- <script async defer="defer" src="https://buttons.github.io/buttons.js"></script> --}}
  <!-- Volt JS -->
  <script src="{{ asset('dist/assets/js/volt.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.datatables.net/2.3.8/js/dataTables.js"></script>

  @stack('after-script')
</body>

</html>
