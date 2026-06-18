@extends('layouts.app')
@section('title', 'Role')
@section('content')

@section('breadcrumb')
  <x-breadcrumb page="Roles & Permissions" active="Roles" route="{{ route('role.index') }}" />
@endsection

<p class="my-3">A role provided access to predefined menus and features so that depending on assigned role an
  administrator can have access to what user needs.</p>
<!-- Role cards -->
<div class="row g-3">

  @foreach ($roles as $role)
    <div class="col-md-6 col-xl-4 my-3">
      <div class="card  border-10 shadow">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="fw-normal mb-0 text-body">Total {{ $role->users->count() }} users</h6>
            @can('role.destroy')
              <a onclick="delete_form('{{ $role->id }}')" class="btn btn-sm btn-danger justify-content-end"
                title="delete role">
                <i class="bi bi-x"></i>
              </a>
            @endcan
          </div>
          <form id="deleteForm_{{ $role->id }}" action="{{ route('role.destroy', $role->id) }}" method="POST">
            @method('DELETE')
            @csrf
          </form>

          <div class="d-flex justify-content-between align-items-end">
            <div class="role-heading">
              <h5 class="mb-1">{{ $role->name }}</h5>
              @can('role.update')
                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editRoleModal-{{ $role->id }}"
                  class="role-edit-modal"><span class="text-info">Edit Role</span></a>
                @include('management-access.role.modal-edit')
              @endcan
            </div>
            <a href="javascript:void(0);"><i class="bi bi-people-fill"></i></a>
          </div>
        </div>
      </div>
    </div>
  @endforeach

  @can('role.store')
    <div class="col-xl-4 col-lg-6 col-md-6 my-3">
      <div class="card h-70">
        <div class="row h-100">
          <div class="col-sm-5">
            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-2 ">
              <img src="{{ asset('img/man-with-laptop-light.png') }}" class="img-fluid" alt="img" width="120">
            </div>
          </div>
          <div class="col-sm-7">
            <div class="card-body text-sm-end text-center ps-sm-0">
              <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                class="btn btn-sm btn-primary mb-4 text-nowrap add-new-role">
                <i class="bi bi-plus"></i>Add New Role</button>
              <p class="mb-0"> Add new role, <br> if it doesn't exist.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endcan

  <hr>

  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-normal mb-0 text-body card-title">Users List</h4>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive text-nowrap mx-2">
        <table class="table" id="table-users">
          <thead>
            <tr>
              <th>#</th>
              <th>User</th>
              <th>Username</th>
              <th>Email</th>
              <th>Role</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($users as $user)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  @foreach ($user->roles as $role)
                    <span class="badge bg-light-info me-1">{{ $role->name ?? '-' }}</span>
                  @endforeach
                </td>
                <td>
                  <div class="d-flex justify-content-end gap-1">
                    @can('user.update')
                      <a data-bs-toggle="modal" data-bs-target="#modal-form-edit-user-{{ $user->id }}"
                        class="btn btn-sm btn-icon btn-secondary text-white">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                      @include('management-access.user.modal-edit')
                    @endcan

                    @can('user.destroy')
                      <a onclick="delete_form('{{ $user->id }}')" title="Delete"
                        class="btn btn-sm btn-icon btn-danger text-white">
                        <i class="bi bi-x-square"></i>
                      </a>

                      <form id="deleteForm_{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}"
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
</div>
<!--/ Role cards -->

<!-- Add Role Modal -->
@include('management-access.role.modal-create')
<!--/ Add Role Modal -->

@endsection

@push('after-script')
<script>
  function delete_form(id) {
    Swal.fire({
      title: 'Yakin ingin menghapus?',
      text: "Data akan dihapus permanen!",
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
    $('#table-users').DataTable();
  });
</script>
@endpush
