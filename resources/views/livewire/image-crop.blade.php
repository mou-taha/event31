<form wire:submit.prevent="save">
  @if($avatar)
      <div
          class="d-flex flex-column justify-content-center"
          wire:ignore
          x-data="{
              setUp() {
                  const cropper = new Cropper(document.getElementById('avatar'), {
                      aspectRatio: NaN,
                      autoCropArea: 1,
                      viewMode: 1,
                      crop (event) {
                          @this.set('x', event.detail.x)
                          @this.set('y', event.detail.y)
                          @this.set('width', event.detail.width)
                          @this.set('height', event.detail.height)
                      }
                  })
              }
          }"
          x-init="setUp"
      >
          <div class="mb-2">
              <img id="avatar" src="{{ $avatar->temporaryUrl() }}" style="width: 500px;">
          </div>

          <button type="submit" class="btn btn-link">
              Done
          </button>
      </div>
  @else
      <label for="avatar" style="width: 100%;">
          <img src="" style="width: 100%; max-width: 100%;">
      </label>

      <input type="file" name="avatar" id="avatar"wire:model="avatar">
  @endif
</form>