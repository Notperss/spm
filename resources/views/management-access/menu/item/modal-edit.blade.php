<!-- Modals add menu -->
<div id="modal-form-edit-menu-item-{{ $item->id }}" class="modal fade" tabindex="-1"
  aria-labelledby="modal-form-edit-menu-item-{{ $item->id }}-label" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('menu.item.update', [$menu, $item]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title" id="modal-form-edit-menu-item-{{ $item->id }}-label">Edit Menu Item
            ({{ $item->name }})</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Menu Name" name="name"
              value="{{ $item->name }}">
            {{-- <x-form.validation.error name="name" /> --}}
          </div>

          {{-- <div class="mb-3">
            <label for="icon" class="form-label">Icon</label>
            <input type="text" class="form-control" id="icon" placeholder="Bootstrap Icon (eg: bi-home)"
              name="icon" value="{{ $item->icon }}">
          </div> --}}

          <div class="row mb-3">
            <label for="route" class="form-label">Route</label>
            <select class="form-control select2" id="route" name="route" data-choices data-choices-removeItem>
              @foreach ($routes as $route)
                @if (!blank($route->getName()))
                  <option @selected($item->route == $route->getName()) value="{{ $route->getName() }}">{{ $route->getName() }}</option>
                @endif
              @endforeach
            </select>
            {{-- <x-form.validation.error name="route" /> --}}
          </div>

          <div class="row mb-3">
            <label for="permission_name" class="form-label">Permission Name</label>
            <select class="form-control select2" id="permission_name" name="permission_name" data-choices
              data-choices-removeItem>
              @foreach ($permissions as $permission)
                <option @selected($item->permission_name == $permission->name) value="{{ $permission->name }}">{{ $permission->name }}</option>
              @endforeach
            </select>
            {{-- <x-form.validation.error name="permission_name" /> --}}
          </div>

          {{-- order --}}
          <div class="mb-3">
            <label for="order" class="form-label">Order</label>
            <input type="number" class="form-control" id="order" placeholder="Menu Order" name="order"
              value="{{ $item->order }}" min="1" max="{{ $menu->items->count() }}"
              onkeydown="return ['ArrowUp','ArrowDown','Tab'].includes(event.key);" onpaste="return false;">
            {{-- <x-form.validation.error name="order" /> --}}
          </div>

          <div class="mb-3">
            <div class="form-check form-switch form-switch-right form-switch-md">
              <label for="status" class="form-label">Status</label>
              <input class="form-check-input code-switcher" type="checkbox" id="tables-small-showcode" name="status"
                value="1" @checked($item->status)>
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
