@extends('layouts.app')
@section('title', 'Location')
@section('content')

@section('breadcrumb')
  <x-breadcrumb page="Master Data" active="Locations" route="{{ route('location.index') }}" />
@endsection

<div class="card border-0 shadow">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="card-title">Locations List</h5>

    @can('location.store')
    @endcan
    <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#modal-form-add-location">
      <i class="bi bi-plus-lg"></i>
      Add Location
    </button>
    @include('pages.master-data.location.modal-create')

  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-sm table-striped " id="table-locations">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Direction</th>
            <th>Position</th>
            <th>Segment</th>
            <th>Section</th>
            <th>HM 1</th>
            <th>HM 2</th>
            <th>KM 1</th>
            <th>KM 2</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">


        </tbody>
      </table>
    </div>
  </div>

</div>

@endsection

@push('after-script')
<script>
  function confirmDelete(id) {
    Swal.fire({
      title: 'Yakin ingin menghapus?',
      text: "Data lokasi akan dihapus permanen!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('deleteForm_' + id).submit();
      }
    });
  }
</script>

<script>
  $('#table-locations').DataTable({
    processing: true,
    serverSide: true,
    ordering: true,
    pageLength: 10, // Show all records by default
    order: [
      [0, 'asc']
    ], // Order by the first column (index 0) in ascending order
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, 'All']
    ], // Add 'All' option to the length menu
    ajax: {
      url: "{{ route('location.index') }}",
    },
    columns: [{
        data: 'order',
        name: 'order',
        // orderable: false,
        searchable: false,
        width: '5%',
      },
      {
        data: 'name',
        name: 'name',
      },
      {
        data: 'direction',
        name: 'direction',
      },
      {
        data: 'position',
        name: 'position',
      },
      {
        data: 'segment',
        name: 'segment',
      },
      {
        data: 'section',
        name: 'section',
      },
      {
        data: 'hm1',
        name: 'hm1',
      },
      {
        data: 'hm2',
        name: 'hm2',
      },
      {
        data: 'km1',
        name: 'km1',
      },
      {
        data: 'km2',
        name: 'km2',
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
      // targets: '_all'
      targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
    }, ],
  });
</script>
@endpush
