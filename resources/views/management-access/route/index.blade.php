@extends('layouts.app')
@section('title', 'Route')
@section('content')

@section('breadcrumb')
  <x-breadcrumb page="Access Management" active="Routes" route="{{ route('route.index') }}" />
@endsection

<div class="card border-0 shadow mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="card-title">Routes List</h5>

    @can('route.store')
      <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-form-add-route">
        <i class="bi bi-plus"></i> Add Route
      </a>
      @include('management-access.route.modal-create')
    @endcan

  </div>
  <div class="card-body">
    <div class="table-responsive text-nowrap mx-2">
      <table class="table" id="table-routes">
        <thead>
          <tr>
            <th>#</th>
            <th>Route</th>
            <th>Permission</th>
            <th>Description</th>
            <th>Status</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($routes as $route)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $route->route }}</td>
              <td>{{ $route->permission_name }}</td>
              <td>{{ $route->description }}</td>
              <td>
                @if ($route->status)
                  <span class="badge bg-info me-1">Show</span>
                @else
                  <span class="badge bg-danger me-1">Hide</span>
                @endif
              </td>
              <td>
                <div class="d-flex justify-content-end gap-1">
                  @can('route.update')
                    <a data-bs-toggle="modal" data-bs-target="#modal-form-edit-route-{{ $route->id }}"
                      class="btn btn-sm btn-icon btn-secondary text-white">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    @include('management-access.route.modal-edit')
                  @endcan

                  @can('route.destroy')
                    <a onclick="delete_form('{{ $route->id }}')" title="Delete"
                      class="btn btn-sm btn-icon btn-danger text-white">
                      <i class="bi bi-x-square"></i>
                    </a>
                    <form id="deleteForm_{{ $route->id }}" action="{{ route('route.destroy', $route->id) }}"
                      method="POST">
                      @method('DELETE')
                      @csrf
                    </form>
                  @endcan
                </div>

              </td>
            </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection

@push('after-script')
<script>
  function delete_form(id) {
    Swal.fire({
      title: 'Yakin ingin menghapus?',
      text: "Data route akan dihapus permanen!",
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
  $(document).ready(function() {
    $('#table-routes').DataTable();
  });
</script>
@endpush
