@extends('layouts.app')
@section('title', 'Permission')
@section('content')
@section('breadcrumb')
  <x-breadcrumb page="Roles & Permissions" active="Permissions" route="{{ route('permission.index') }}" />
@endsection
<div class="card border-0 shadow mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="card-title">Permissions List</h5>

    @can('permission.store')
      <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#modal-form-add-permission">
        <i class="bi bi-plus"></i> Add permission
      </a>
      @include('management-access.permission.modal-create')
    @endcan

  </div>
  <div class="card-body ">
    <div class="table-responsive">
      <table class="table" id="table-permissions">
        <thead>
          <tr>
            <th>#</th>
            <th>Permission Name</th>
            <th>Guard Name</th>
            <th>Assigned To Roles</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($permissions as $permission)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $permission->name }}</td>
              <td>{{ $permission->guard_name }}</td>
              <td>
                @foreach ($permission->roles as $role)
                  <span class="badge bg-info me-1">{{ $role->name }}</span>
                @endforeach
              </td>
              <td>
                <div class="d-flex justify-content-end gap-1">

                  @can('permission.update')
                    <a data-bs-toggle="modal" data-bs-target="#modal-form-edit-permission-{{ $permission->id }}"
                      class="btn btn-sm btn-icon btn-secondary text-white">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    @include('management-access.permission.modal-edit')
                  @endcan

                  @can('permission.destroy')
                    <a onclick="delete_form('{{ $permission->id }}')" title="Delete"
                      class="btn btn-sm btn-icon btn-danger text-white">
                      <i class="bi bi-x-square"></i>
                    </a>
                    <form id="deleteForm_{{ $permission->id }}"
                      action="{{ route('permission.destroy', $permission->id) }}" method="POST">
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
      text: "Data user akan dihapus permanen!",
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
    $('#table-permissions').DataTable();
  });
</script>
@endpush
