<!doctype html>
<html lang="id">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!-- Primary Meta Tags -->
  <title>{{ env('APP_NAME') }} | Sign-in</title>
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
  {{-- <meta name="title" content="Volt - Free Bootstrap 5 Dashboard" /> --}}
  {{-- <meta name="author" content="Themesberg" />
  <meta name="description"
    content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS." />
  <meta name="keywords"
    content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, themesberg, themesberg dashboard, themesberg admin dashboard" />
  <link rel="canonical" href="https://themesberg.com/product/admin-dashboard/volt-premium-bootstrap-5-dashboard" /> --}}

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('dist/assets/img/favicon/apple-touch-icon.png') }}" />
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('dist/assets/img/favicon/favicon-32x32.png') }}" />
  <link rel="icon" type="image/png" sizes="16x16"
    href="{{ asset('dist/assets/img/favicon/favicon-16x16.png') }}" />
  <link rel="manifest" href="{{ asset('dist/assets/img/favicon/site.webmanifest') }}" />
  <link rel="mask-icon" href="{{ asset('dist/assets/img/favicon/safari-pinned-tab.svg') }}" color="#ffffff" />
  <meta name="msapplication-TileColor" content="#ffffff" />
  <meta name="theme-color" content="#ffffff" />

  <!-- Sweet Alert -->
  <link type="text/css" href="{{ asset('dist/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />
  <!-- Notyf -->
  {{-- <link type="text/css" href="{{ asset('dist/vendor/notyf/notyf.min.css') }}" rel="stylesheet" /> --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
  <!-- Volt CSS -->
  <link type="text/css" href="{{ asset('dist/css/volt.css') }}" rel="stylesheet" />
</head>

<body>

  @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <div class="d-flex align-items-center justify-content-center">
        <i class="feather-alert-circle me-2"></i>
        <div>
          @foreach ($errors->all() as $error)
            {{ $error }}
          @endforeach
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  @endif

  <main>
    <!-- Section -->
    <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center"
      style="background-image: url({{ asset('img/background-1.png') }});">
      <div class="container">
        <div>
          {{-- <div class="row justify-content-center form-bg-image"
          data-background-lg="{{ asset('dist/assets/img/illustrations/signin.svg') }}"> --}}
          <div class="row justify-content-center">
            <div class="col-12 d-flex align-items-center justify-content-center">
              <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                <div class="text-center text-md-center mb-4 mt-md-0">
                  <img src="{{ asset('img/logo-full-citra.png') }}" alt="" class="img-fluid">
                </div>
                <hr>
                <div class="text-center text-md-center mb-4 mt-md-0">
                  <h1 class="mb-0 h5">
                    Sign in to your account
                  </h1>
                </div>
                <form action="{{ route('login') }}" method="POST" class="w-100 mt-4 pt-2">
                  @csrf
                  <!-- Form -->
                  <div class="form-group mb-4">
                    <label for="username">Your Username</label>
                    <div class="input-group">
                      <span class="input-group-text" id="basic-addon1">
                        <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                          xmlns="http://www.w3.org/2000/svg">
                          <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                          <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                      </span>
                      <input type="text" class="form-control" placeholder="Username" name="username" id="username"
                        autofocus required />
                    </div>
                  </div>
                  <!-- End of Form -->
                  <div class="form-group">
                    <!-- Form -->
                    <div class="form-group mb-4">
                      <label for="password">Your Password</label>
                      <div class="input-group">
                        <span class="input-group-text" id="basic-addon2">
                          <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                              d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                              clip-rule="evenodd"></path>
                          </svg>
                        </span>
                        <input type="password" placeholder="Password" name="password" id="password"
                          class="form-control" required />
                      </div>
                    </div>

                  </div>
                  <div class="d-grid">
                    <button type="submit" class="btn btn-gray-800">
                      Sign in
                    </button>
                  </div>
                </form>

                <div class="col-12">
                  <hr class="my-4">
                </div>

              </div>
            </div>
          </div>
        </div>
    </section>
  </main>
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
</body>

</html>
