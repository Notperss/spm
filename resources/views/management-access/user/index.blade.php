@extends('layouts.app')
@section('title', 'User')

@section('breadcrumb')
  <x-breadcrumb page="Access Management" active="Users" route="{{ route('user.index') }}" />
@endsection

@section('content')


  <div class="card border-0 shadow mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="card-title mb-0">Users List</h5>

      <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-form-add-user">
        <i class="bi bi-plus"></i> Add Users
      </a>
      @include('management-access.user.modal-create')
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-flush" id="table-users">
          <thead class="thead-light">
            <tr class="border-b">
              <th scope="row">Users</th>
              <th>Username</th>
              <th>Last Activity</th>
              <th>Status</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr>
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <div class="avatar avatar-lg">
                      @if ($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="img-fluid"
                          class="img-fluid " />
                      @else
                        <img src="{{ asset('img/2.jpg') }}" alt="img-fluid" class="img-fluid " />
                      @endif
                    </div>
                    <a href="javascript:void(0);">
                      <span class="d-block">{{ $user->name }}</span>
                      <span class="fs-12 d-block fw-normal text-muted">{{ $user->email }}</span>
                    </a>
                  </div>
                </td>
                <td>
                  <span class="badge bg-gray-500 ">{{ $user->username }}</span>
                </td>
                <td>
                  {{ $user->last_activity ? \Carbon\Carbon::parse($user->last_activity)->diffForHumans() : 'Never' }}
                </td>
                <td>
                  @if ($user->is_logged_in)
                    <span class="badge bg-soft-success text-success">Online</span>
                  @else
                    <span class="badge bg-soft-danger text-danger">Offline</span>
                  @endif
                </td>
                <td>
                  <div class="d-flex justify-content-end gap-2">

                    <!-- Edit Button -->
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                      data-bs-target="#modal-form-edit-user-{{ $user->id }}" title="edit">
                      <i class="bi bi-pencil "></i>
                    </button>

                    @include('management-access.user.modal-edit')

                    <!-- Delete Button -->
                    <button type="button" onclick="delete_form('{{ $user->id }}')" class="btn btn-sm btn-danger"
                      title="delete">
                      <i class="bi bi-trash-fill text-black"></i>
                    </button>

                    <form id="deleteForm_{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}"
                      method="POST" class="d-none">
                      @method('DELETE')
                      @csrf
                    </form>

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
    $(document).on('shown.bs.modal', '.modal', function() {

      $(this).find("[data-select2-selector='default']").each(function() {

        if (!$(this).hasClass("select2-hidden-accessible")) {

          $(this).select2({
            // theme: "bootstrap-5",
            width: "100%",
            dropdownParent: $(this).closest('.modal')
          });

        }

      });

    });
  </script>



  <script>
    $(document).ready(function() {
      $('#table-users').DataTable();
    });
  </script>
@endpush
