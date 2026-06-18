<!-- Modals add menu -->
<div id="modal-form-add-user" class="modal fade modal-form-user" tabindex="-1" aria-labelledby="modal-form-add-user-label"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form id="modal-form" action="{{ route('user.store') }}" method="post">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title" id="modal-form-add-user-label">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
              placeholder="User Name" name="name">
            @error('name')
              <a style="color: red">
                <small>
                  {{ $message }}
                </small>
              </a>
            @enderror
            {{--  --}}
          </div>

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
              placeholder="Username" name="username">
            @error('username')
              <a style="color: red">
                <small>
                  {{ $message }}
                </small>
              </a>
            @enderror
            {{--  --}}
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
              placeholder="Email" name="email">
            @error('email')
              <a style="color: red">
                <small>
                  {{ $message }}
                </small>
              </a>
            @enderror
            {{-- <x-form.validation.error name="email" /> --}}
          </div>

          <div class="row mb-3">
            <label for="company_id" class="form-label">Perusahaan</label>
            <select class="form-select select-2" data-select2-selector='default' id="company_id" name="company_id">
              <option value="" selected disabled>Choose</option>
              @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
              @endforeach
            </select>
            @error('company_id')
              <a style="color: red">
                <small>
                  {{ $message }}
                </small>
              </a>
            @enderror
          </div>

          {{-- <div class="mb-3">
            <label for="division" class="form-label">Divisi</label>
            <select class="form-control" id="division" style="width:100%" placeholder="Guard Name" name="division_id">
              <option value="" selected disabled>Choose</option>
              {{-- @foreach ($divisions as $division)
                <option value="{{ $division->id }}">{{ $division->name }}</option>
              @endforeach
            </select>
            <x-form.validation.error name="division" />
          </div> --}}

          <div class="row mb-3">
            <label for="role" class="form-label">Role Name</label>
            <select class="form-select select-2 @error('role') is-invalid @enderror" data-select2-selector='default'
              id="role" name="role">
              <option value=""disabled selected>Choose</option>
              @foreach ($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
              @endforeach
            </select>
            @error('role')
              <a style="color: red">
                <small>
                  {{ $message }}
                </small>
              </a>
            @enderror
            {{-- <x-form.validation.error name="role" /> --}}
          </div>

          <div class="mb-3">
            <div class="form-check form-switch form-switch-right form-switch-md">
              <label for="verified" class="form-label">Verified</label>
              <input class="form-check-input code-switcher" type="checkbox" id="tables-small-showcode" name="verified"
                value="1">
            </div>
            {{-- <x-form.validation.error name="verified" /> --}}
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary ">Save</button>
        </div>
      </form>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
