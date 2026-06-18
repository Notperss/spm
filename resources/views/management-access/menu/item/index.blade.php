@extends('layouts.app')

@section('title', 'Menu Items')

@section('breadcrumb')
  <x-breadcrumb page="{{ $menu->name }}" active="Item" route="{{ route('menu.index') }}" />
@endsection

@section('content')
  <div class="card border-0 shadow mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="card-title mb-0">Menu Items List</h5>
      @can('menu.store')
      @endcan
      <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-form-add-menu-item">
        <i class="bi bi-plus"></i> Add Menu Item
      </a>
      @include('management-access.menu.item.modal-create')

    </div>
    <div class="card-body">
      <!-- end cardheader -->
      <!-- Hoverable Rows -->
      <table class="table table-hover table-nowrap mb-0" id="table1">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            {{-- <th scope="col">Icon</th> --}}
            <th scope="col">Route</th>
            <th scope="col">Permission</th>
            <th scope="col">Status</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($menuItems as $item)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $item->name }}</td>
              {{-- <td><i class="bi {{ $item->icon }}"></i></td> --}}
              <td>{{ $item->route }}</td>
              <td>{{ $item->permission_name }}</td>
              <td>
                @if ($item->status)
                  <span class="badge bg-success">Show</span>
                @else
                  <span class="badge bg-danger">Hide</span>
                @endif
              </td>

              <td style="width: 100px">
                <a data-bs-toggle="modal" data-bs-target="#modal-form-edit-menu-item-{{ $item->id }}"
                  class="btn btn-primary btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                <a onclick="delete_form('{{ $item->id }}')" title="Delete" class="btn btn-sm btn-danger">
                  <i class="bi bi-x"></i>
                  <form action="{{ route('menu.item.destroy', [$menu, $item]) }}" method="POST"
                    id="modal-form-delete-menu-item-{{ $item->id }}">
                    @csrf
                    @method('DELETE')
                  </form>
                </a>

                @include('management-access.menu.item.modal-edit')

              </td>
            </tr>
          @empty
            <tr>
              <th colspan="5" class="text-center">No data to display</th>
            </tr>
          @endforelse
        </tbody>
      </table>
      {{-- <div class="card-footer py-4">
          <nav aria-label="..." class="pagination justify-content-end">
            {{ $menuItems->links() }}
          </nav>
        </div> --}}
    </div>
  </div>

  <script>
    //select2 ke modal
    document.addEventListener('shown.bs.modal', function(event) {
      var modal = event.target;
      var select = modal.querySelectorAll('.select2');
      select.forEach(function(s) {
        $(s).select2({
          dropdownParent: $(modal),
          // theme: 'bootstrap-5',
          placeholder: 'Select Permission ...',
          allowClear: true,
        });
      })
    });
  </script>

  <script>
    function delete_form(menuId) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          // If the user clicks "Yes, delete it!", submit the corresponding form
          //   document.getElementById('deleteForm_' + menuId).submit();
          document.getElementById('modal-form-delete-menu-item-' + menuId).submit();
        }
      });
    }
  </script>
@endsection
