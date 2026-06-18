<!-- Modals add menu -->
<div id="modal-form-edit-menu-{{ $menuGroup->id }}" class="modal fade" tabindex="-1"
  aria-labelledby="modal-form-edit-menu-{{ $menuGroup->id }}-label" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('menu.update', $menuGroup->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title" id="modal-form-edit-menu-{{ $menuGroup->id }}-label">Edit Menu Group
            ({{ $menuGroup->name }})</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Menu Name" name="name"
              value="{{ $menuGroup->name }}">
            {{-- <x-form.validation.error name="name" /> --}}
          </div>

          <div class="mb-3">
            <label for="icon" class="form-label">Icon</label>
            <input type="text" class="form-control" id="icon" placeholder="Bootstrap Icon (eg: bi-home)"
              name="icon" value="{{ $menuGroup->icon }}">
          </div>

          <div class="row mb-3">
            <label for="permission_name_{{ $menuGroup->id }}" class="form-label">Permission Name</label>
            <select class="form-select select2" id="permission_name_{{ $menuGroup->id }}" name="permission_name">
              <option disabled selected> Select Permission ... </option>
              @foreach ($permissions as $permission)
                <option @selected($menuGroup->permission_name == $permission->name) value="{{ $permission->name }}">
                  {{ $permission->name }}
                </option>
              @endforeach
            </select>
            {{-- <x-form.validation.error name="permission_name" /> --}}
          </div>

          <div class="mb-3">
            <label for="order" class="form-label">Order</label>
            <input type="number" class="form-control" id="order" placeholder="Menu Order" name="order"
              value="{{ $menuGroup->order }}" min="1" max="{{ $menuGroup->count() }}"
              onkeydown="return ['ArrowUp','ArrowDown','Tab'].includes(event.key);" onpaste="return false;">
            {{-- <x-form.validation.error name="order" /> --}}
          </div>

          <div class="row mb-3" id="route-wrapper_{{ $menuGroup->id }}">
            <label for="route_{{ $menuGroup->id }}" class="form-label">Route</label>
            <select class="form-control select2" id="route_{{ $menuGroup->id }}" name="route" style="width: 100%">
              @foreach ($routes as $route)
                @if (!blank($route->getName()))
                  <option @selected($menuGroup->route == $route->getName()) value="{{ $route->getName() }}">{{ $route->getName() }}
                  </option>
                @endif
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <div class="form-check form-switch form-switch-right form-switch-md">
              <label for="child_menu_{{ $menuGroup->id }}" class="form-label">Has Sub Menu</label>
              <input class="form-check-input code-switcher" type="checkbox" id="child_menu_{{ $menuGroup->id }}"
                name="child_menu" value="1" @checked($menuGroup->child_menu)>
            </div>
          </div>

          <div class="mb-3">
            <div class="form-check form-switch form-switch-right form-switch-md">
              <label for="status" class="form-label">Status</label>
              <input class="form-check-input code-switcher" type="checkbox" id="tables-small-showcode" name="status"
                value="1" @checked($menuGroup->status)>
            </div>
            {{-- <x-form.validation.error name="status" /> --}}
          </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary ">Update</button>
        </div>
      </form>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
  $(document).ready(function() {

    function toggleRoute() {

      if ($('#child_menu_{{ $menuGroup->id }}').is(':checked')) {

        $('#route-wrapper_{{ $menuGroup->id }}').hide();

        $('#route_{{ $menuGroup->id }}').val('').trigger('change');

      } else {

        $('#route-wrapper_{{ $menuGroup->id }}').show();

      }
    }

    // Jalankan saat halaman/modal pertama kali dibuka
    toggleRoute();

    // Jalankan saat switch diubah
    $('#child_menu_{{ $menuGroup->id }}').on('change', function() {
      toggleRoute();
    });

  });
</script>
