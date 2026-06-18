@extends('layouts.app')
@section('title', 'Activity Log')
{{-- @section('page-title', 'Activity Logs')
@section('breadcrumb', 'Activity Logs') --}}
@section('content')
  <div class="main-content">
    <div class="row">
      <div class="container">
        <h4 class="mb-4 d-flex justify-content-between align-items-center">
          System Error Logs
          <button class="btn btn-sm btn-primary" onclick="copyAllLogs(this)">
            Copy All
          </button>
        </h4>

        <div class="card">
          <div class="card-body" id="logContainer" style="max-height:600px; overflow:auto; background:#111; color:#0f0;">

            @forelse($lines as $index => $line)
              <div class="d-flex justify-content-between align-items-start border-bottom pb-1 mb-1">

                <pre id="log-{{ $index }}" style="margin:0; white-space:pre-wrap;">
                {{ $line }}
                </pre>

                <button class="btn btn-sm btn-outline-light ms-2"
                  onclick="copySingleLog('log-{{ $index }}', this)">
                  Copy
                </button>
              </div>
            @empty
              <p class="text-muted">Tidak ada error.</p>
            @endforelse

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('after-script')
  <script>
    function copyAllLogs(button) {
      const text = document.getElementById('logContainer').innerText;
      fallbackCopy(text, button, 'Copy All');
    }

    function copySingleLog(id, button) {
      const text = document.getElementById(id).innerText;
      fallbackCopy(text, button, 'Copy');
    }

    function fallbackCopy(text, button, defaultText) {
      const textarea = document.createElement("textarea");
      textarea.value = text;
      document.body.appendChild(textarea);
      textarea.select();
      textarea.setSelectionRange(0, 99999);

      try {
        document.execCommand("copy");

        button.innerText = "Copied!";
        button.classList.remove("btn-primary", "btn-outline-light");
        button.classList.add("btn-success");

        setTimeout(() => {
          button.innerText = defaultText;
          button.classList.remove("btn-success");
          button.classList.add(
            defaultText === 'Copy All' ? "btn-primary" : "btn-outline-light"
          );
        }, 1500);

      } catch (err) {
        alert("Gagal menyalin log");
      }

      document.body.removeChild(textarea);
    }
  </script>
@endpush
