<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

@if ($errors->any() || session()->has('error'))
  <!-- Toast with Placements -->
  <script>
    @foreach ($errors->all() as $error)
      const toast = Toastify({
        text: `<div style="position: relative;padding-right: 24px;"">
                <span>{{ $error }}</span>
                 <!-- Tombol close di sisi kanan -->
                    <button
                        type="button"
                        onclick="toast.hideToast()"
                        style="
                            position: absolute;
                            top: 0;
                            right: 0;
                            background: transparent;
                            border: none;
                            color: white;
                            font-size: 18px;
                            font-weight: bold;
                            cursor: pointer;
                            line-height: 1;
                            padding: 0;
                        ">
                        &times;
                    </button>
                </div>
              <div class="toast-progress"></div>
            `,
        duration: 9000, // Duration of the toast
        close: false, // Option to close the toast manually
        gravity: "top", // Toast appears at the top
        position: "right", // Align toast to the right
        backgroundColor: "linear-gradient(to right, #d32f2f, #f44336)",
        escapeMarkup: false,
      }).showToast();
    @endforeach

    // Handle session error message
    @if (session()->has('error'))
      const toast = Toastify({
        text: `<div style="position: relative; padding-right: 24px;"">
                <span>{{ session('error') }}</span>
                 <!-- Tombol close di sisi kanan -->
                    <button
                        type="button"
                        onclick="toast.hideToast()"
                        style="
                            position: absolute;
                            top: 0;
                            right: 0;
                            background: transparent;
                            border: none;
                            color: white;
                            font-size: 18px;
                            font-weight: bold;
                            cursor: pointer;
                            line-height: 1;
                            padding: 0;
                        ">
                        &times;
                    </button>
                </div>
              <div class="toast-progress"></div>
            `,
        duration: 9000, // Duration of the toast
        close: false, // Option to close the toast manually
        gravity: "top", // Toast appears at the top
        position: "right", // Align toast to the right
        backgroundColor: "linear-gradient(to right, #d32f2f, #f44336)",
        escapeMarkup: false,
      }).showToast();
    @endif
  </script>
@endif


@if (session()->has('success'))
  <script>
    const toast = Toastify({
      text: `
                <div style="position: relative; padding-right: 24px;">
                    <span>{{ session('success') }}</span>

                    <!-- Tombol close di sisi kanan -->
                    <button
                        type="button"
                        onclick="toast.hideToast()"
                        style="
                            position: absolute;
                            top: 0;
                            right: 0;
                            background: transparent;
                            border: none;
                            color: white;
                            font-size: 18px;
                            font-weight: bold;
                            cursor: pointer;
                            line-height: 1;
                            padding: 0;
                        ">
                        &times;
                    </button>
                </div>

                <div class="toast-progress"></div>
            `,
      duration: 7000,
      close: false, // Tombol close custom digunakan
      gravity: "top",
      position: "right",
      backgroundColor: "#00c853",
      escapeMarkup: false
    });

    toast.showToast();
  </script>
@endif

<style>
  .toastify .toast-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 4px;
    width: 100%;
    background-color: #443c3c92;
    /* Progress bar color */
    animation: shrink-progress 7s linear forwards;
    animation-play-state: running;
    /* Initial state: running */
  }

  .toastify:hover .toast-progress {
    animation-play-state: paused;

    animation: none;
    /* Pause on hover */
  }

  @keyframes shrink-progress {
    from {
      width: 100%;
    }

    to {
      width: 0;
    }
  }
</style>
