@extends('layouts.app')
@section('title', 'Activity Log')
{{-- @section('page-title', 'Activity Logs')
@section('breadcrumb', 'Activity Logs') --}}
@section('content')
  <div class="main-content">
    <div class="row">
      <div class="col-12">
        <div class="card stretch stretch-full">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <h4 class="mb-0">Activity Logs</h4>

              @role('super-admin')
                <a href="{{ route('system-logs') }}" class="btn btn-info">
                  <i class="feather-file-text"></i> View System Logs
                </a>
              @endrole

            </div>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="log-table" style="font-size: 75%">
                <thead>
                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Log Name</th>
                    <th class="text-center">User</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Created At</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection

@push('after-script')
  <script>
    $('#log-table').DataTable({
      processing: true,
      serverSide: true,
      ordering: true,
      pageLength: 10, // Show all records by default
      lengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, 'All']
      ], // Add 'All' option to the length menu
      ajax: {
        url: "{{ route('activity-log.index') }}",
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false,
          width: '5%',
        },
        {
          data: 'log_name',
          name: 'log_name',
        },
        {
          data: 'causer',
          name: 'causer.name',
        },
        {
          data: 'event',
          name: 'event',
        },
        {
          data: 'created_at',
          name: 'created_at',
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false,
          className: 'no-print' // Add this class to exclude the column from printing
        },
      ],
      columnDefs: [{
        className: 'text-center',
        targets: '_all'
      }, ],
    });
  </script>
@endpush
