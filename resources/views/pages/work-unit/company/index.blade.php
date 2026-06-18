@extends('layouts.app')
@section('title', 'Company Management')
@section('content')

@section('breadcrumb')
  <x-breadcrumb page="Work Unit" active="Companies" route="{{ route('company.index') }}" />
@endsection

<div class="card border-0 shadow mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h5 class="card-title">Companies List</h5>

    @can('company.store')
      <button type="button" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#modal-form-add-company">
        <i class="bi bi-plus-lg"></i>
        Add Company
      </button>
      @include('pages.work-unit.company.modal-create')
    @endcan

  </div>
  <div class="card-body ">
    <div class="table-responssive">
      <table class="table" id="table-companies">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Address</th>
            <th>Description</th>
            <th>Logo</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($companies as $company)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $company->name }}</td>
              <td class="text-wrap">{{ $company->address }}</td>
              <td>{{ $company->description }}</td>
              <td class="text-center">
                @if ($company->logo_path)
                  <img src="{{ Storage::url($company->logo_path) }}" alt="Logo" width="60px">
                @else
                  no image
                @endif
              </td>
              <td>
                <div class="d-flex justify-content-end gap-1">
                  @can('company.update')
                    <a data-bs-toggle="modal" data-bs-target="#modal-form-edit-company-{{ $company->id }}"
                      class="btn btn-sm btn-icon btn-secondary text-white">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    @include('pages.work-unit.company.modal-edit')
                  @endcan

                  @can('company.destroy')
                    <a onclick="delete_form('{{ $company->id }}')" title="Delete"
                      class="btn btn-sm btn-icon btn-danger text-white">
                      <i class="bi bi-x-square"></i>
                    </a>
                    <form id="deleteForm_{{ $company->id }}" action="{{ route('company.destroy', $company->id) }}"
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
      text: "Data company akan dihapus permanen!",
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
    $('#table-companies').DataTable();
  });
</script>
@endpush
