<!-- Modals add menu -->
<div id="modal-form-edit-location-{{ $location->id }}" class="modal fade modal-form-location-edit" tabindex="-1"
  aria-labelledby="modal-form-edit-location-{{ $location->id }}-label" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('location.update', $location->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title" id="modal-form-edit-location-{{ $location->id }}-label">Edit Location
            ({{ $location->name }})
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
        </div>
        <div class="modal-body">

          <div class="row mb-2">
            <div class="col-md-12">
              <label for="name" class="form-label">Name</label>
              <input type="text" value="{{ $location->name }}"
                class="form-control @error('name') is-invalid @enderror" id="name" name="name">
              @error('name')
                <a style="color: red">
                  <small>
                    {{ $message }}
                  </small>
                </a>
              @enderror
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-6">
              <label for="position" class="form-label">Position</label>
              <input type="text" value="{{ $location->position }}"
                class="form-control @error('position') is-invalid @enderror" id="position" name="position">
              @error('position')
                <a style="color: red">
                  <small>
                    {{ $message }}
                  </small>
                </a>
              @enderror
            </div>

            <div class="col-md-3">
              <label for="direction" class="form-label">Direction</label>
              <select class="form-select @error('direction') is-invalid @enderror" id="direction" name="direction">
                {{-- <option value="">Select Direction</option> --}}
                <option value="A">A</option>
                <option value="B">B</option>
              </select>
              @error('direction')
                <a style="color: red">
                  <small>
                    {{ $message }}
                  </small>
                </a>
              @enderror
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-6">
              <label for="segment" class="form-label">Segment</label>
              <input type="text" value="{{ $location->segment }}"
                class="form-control @error('segment') is-invalid @enderror" id="segment" name="segment">
              @error('segment')
                <a style="color: red">
                  <small>
                    {{ $message }}
                  </small>
                </a>
              @enderror
            </div>

            <div class="col-md-3">
              <label for="section" class="form-label">Section</label>
              <input type="text" value="{{ $location->section }}"
                class="form-control @error('section') is-invalid @enderror" id="section" name="section">
              @error('section')
                <a style="color: red">
                  <small>
                    {{ $message }}
                  </small>
                </a>
              @enderror
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-3">
              <label for="hm1" class="form-label">HM 1</label>
              <input type="number" value="{{ $location->hm1 }}"
                class="form-control @error('hm1') is-invalid @enderror" id="hm1" name="hm1">
              @error('hm1')
                <a style="color: red">
                  <small>
                    {{ $message }}
                  </small>
                </a>
              @enderror
            </div>

            <div class="col-md-3">
              <label for="hm2" class="form-label">HM 2</label>
              <input type="number" value="{{ $location->hm2 }}"
                class="form-control @error('hm2') is-invalid @enderror" id="hm2" name="hm2">
              @error('hm2')
                <a style="color: red">
                  <small>
                    {{ $message }}
                  </small>
                </a>
              @enderror
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-md-3">
              <label for="km1" class="form-label">KM 1</label>
              <input type="number" value="{{ $location->km1 }}"
                class="form-control @error('km1') is-invalid @enderror" id="km1" name="km1">
              @error('km1')
                <a style="color: red">
                  <small>
                    {{ $message }}
                  </small>
                </a>
              @enderror
            </div>

            <div class="col-md-3">
              <label for="km2" class="form-label">KM 2</label>
              <input type="number" value="{{ $location->km2 }}"
                class="form-control @error('km2') is-invalid @enderror" id="km2" name="km2">
              @error('km2')
                <a style="color: red">
                  <small>
                    {{ $message }}
                  </small>
                </a>
              @enderror
            </div>
          </div>

          <div class="col-md-3 mb-3">
            <label for="order" class="form-label">Urutan</label>
            <select name="order" id="order" class="form-select select-2" required>
              @foreach ($orderLocation as $order)
                <option value="{{ $order }}" {{ $location->order == $order ? 'selected' : '' }}>
                  {{ $order }}
                </option>
              @endforeach
            </select>
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
