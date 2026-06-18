@extends('layouts.app')

@section('title', 'Menu')

@section('breadcrumb')
  <x-breadcrumb page="Access Management" active="Menu Groups" route="{{ route('menu.index') }}" />
@endsection

@section('content')


  <div class="card border-0 shadow mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="card-title mb-0">Menu Groups List</h5>
      @can('menu.store')
      @endcan
      <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-form-add-menu">
        <i class="bi bi-plus"></i> Add Menu Group
      </a>
      @include('management-access.menu.modal-create')
    </div>
    <div class="card-body">
      <!-- end cardheader -->
      <!-- Hoverable Rows -->
      <table class="table table-hover table-nowrap mb-0" id="table1">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Permission</th>
            <th scope="col">Has Sub Menu</th>
            <th scope="col">Sub Menu</th>
            <th scope="col">Status</th>
            <th scope="col" class="col-1"></th>
          </tr>
        </thead>
        <tbody>
          @forelse ($menuGroups as $menuGroup)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>
                <i class="bi {{ $menuGroup->icon }}"></i>
                {{ $menuGroup->name }}
              </td>
              <td>{{ $menuGroup->permission_name }}</td>
              <td>
                @if ($menuGroup->child_menu)
                  <span class="badge bg-success">Yes</span>
                @else
                  <span class="badge bg-danger" title="{{ $menuGroup->route }}">No</span>
                @endif
              </td>

              <td> <span class="badge bg-secondary text-black">{{ $menuGroup->items->count() }}</span></td>

              <td>
                @if ($menuGroup->status)
                  <span class="badge bg-success">Show</span>
                @else
                  <span class="badge bg-danger">Hide</span>
                @endif
              </td>

              <td style="width: 200px;">
                {{-- @if ($menuGroup->child_menu)
                @endif --}}
                <a href="{{ route('menu.item.index', $menuGroup->id) }}" class="btn btn-sm btn-info"
                  title="Add Management Menu Item">
                  <i class="bi bi-plus"></i>
                </a>
                <a data-bs-toggle="modal" data-bs-target="#modal-form-edit-menu-{{ $menuGroup->id }}"
                  class="btn btn-sm btn-primary" title="Edit">
                  <i class="bi bi-pencil"></i>
                </a>
                @include('management-access.menu.modal-edit')

                <a onclick="delete_form('{{ $menuGroup->id }}')" title="Delete" class="btn btn-sm btn-danger">
                  <i class="bi bi-x"></i>
                  <form action="{{ route('menu.destroy', $menuGroup->id) }}" method="POST"
                    id="modal-form-delete-menu-{{ $menuGroup->id }}">
                    @csrf
                    @method('DELETE')
                  </form>
                </a>


              </td>
            </tr>
          @empty
            <tr>
              <th colspan="5" class="text-center">No data to display</th>
            </tr>
          @endforelse
        </tbody>
      </table>

    </div>
  </div>

  {{-- <script>
    $(document).ready(function() {

      $('.select2').select2({
        dropdownParent: $('#modal-form-add-menu'),
        width: '100%',
        placeholder: 'Select Permission ...',
        allowClear: true,
        // theme: 'bootstrap-5',
        // class: 'form-select',

      });

    });
  </script>
 --}}

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
    $(document).ready(function() {

      function toggleRoute() {

        if ($('#child_menu').is(':checked')) {

          $('#route-wrapper').hide();

          $('#route').val('').trigger('change');

        } else {

          $('#route-wrapper').show();

        }
      }

      // Jalankan saat halaman/modal pertama kali dibuka
      toggleRoute();

      // Jalankan saat switch diubah
      $('#child_menu').on('change', function() {
        toggleRoute();
      });

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
          document.getElementById('modal-form-delete-menu-' + menuId).submit();
        }
      });
    }
  </script>
@endsection
