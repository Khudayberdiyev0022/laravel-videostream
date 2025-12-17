<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label for="name" class="form-label">Nomi <span class="text-danger">*</span></label>
      <input type="text"
             class="form-control @error('name') is-invalid @enderror"
             id="name"
             name="name"
             value="{{ old('name', $menu->name ?? '') }}"
             required>
      @error('name')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>

  <div class="col-md-6">
    <div class="mb-3">
      <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
      <input type="text"
             class="form-control @error('slug') is-invalid @enderror"
             id="slug"
             name="slug"
             value="{{ old('slug', $menu->slug ?? '') }}"
             required>
      <small class="text-muted">URL uchun yagona identifikator (masalan: about-us)</small>
      @error('slug')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label for="url" class="form-label">URL (Ichki)</label>
      <input type="text"
             class="form-control @error('url') is-invalid @enderror"
             id="url"
             name="url"
             value="{{ old('url', $menu->url ?? '') }}"
             placeholder="/about">
      <small class="text-muted">Ichki sahifa uchun (masalan: /about)</small>
      @error('url')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>

  <div class="col-md-6">
    <div class="mb-3">
      <label for="external_link" class="form-label">Tashqi Havola</label>
      <input type="url"
             class="form-control @error('external_link') is-invalid @enderror"
             id="external_link"
             name="external_link"
             value="{{ old('external_link', $menu->external_link ?? '') }}"
             placeholder="https://example.com">
      <small class="text-muted">Boshqa sayt uchun to'liq URL</small>
      @error('external_link')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label for="parent_id" class="form-label">Parent Menu</label>
      <select name="parent_id"
              id="parent_id"
              class="form-select @error('parent_id') is-invalid @enderror">
        <option value="">Yuqori daraja (Parent)</option>
        @foreach($parentMenus as $parent)
          @include('admin.menus.partials.select-option', [
              'menu' => $parent,
              'level' => 0,
              'selected' => old('parent_id', $menu->parent_id ?? null)
          ])
        @endforeach
      </select>
      @error('parent_id')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>

  <div class="col-md-3">
    <div class="mb-3">
      <label for="order" class="form-label">Tartib Raqami <span class="text-danger">*</span></label>
      <input type="number"
             class="form-control @error('order') is-invalid @enderror"
             id="order"
             name="order"
             value="{{ old('order', $menu->order ?? 0) }}"
             min="0"
             required>
      @error('order')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>

  <div class="col-md-3">
    <div class="mb-3">
      <label for="target" class="form-label">Target <span class="text-danger">*</span></label>
      <select name="target"
              id="target"
              class="form-select @error('target') is-invalid @enderror">
        <option value="_self" {{ (old('target', $menu->target ?? '_self') == '_self') ? 'selected' : '' }}>
          Shu oynada (_self)
        </option>
        <option value="_blank" {{ (old('target', $menu->target ?? '_self') == '_blank') ? 'selected' : '' }}>
          Yangi oynada (_blank)
        </option>
      </select>
      @error('target')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>
</div>

<div class="mb-3">
  <label for="icon" class="form-label">Icon (ixtiyoriy)</label>
  <input type="text"
         class="form-control @error('icon') is-invalid @enderror"
         id="icon"
         name="icon"
         value="{{ old('icon', $menu->icon ?? '') }}"
         placeholder="fas fa-home">
  <small class="text-muted">Font Awesome class (masalan: fas fa-home, fas fa-user)</small>
  @error('icon')
  <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label class="form-label d-block">Menu Joylashuvi</label>
  <div class="row">
    @foreach($locations as $key => $label)
      <div class="col-md-6 mb-2">
        <div class="form-check">
          <input class="form-check-input"
                 type="checkbox"
                 name="locations[]"
                 value="{{ $key }}"
                 id="location_{{ $key }}"
              {{ (isset($menu) && $menu->hasLocation($key)) || (is_array(old('locations')) && in_array($key, old('locations'))) ? 'checked' : '' }}>
          <label class="form-check-label" for="location_{{ $key }}">
            {{ $label }}
          </label>
        </div>
      </div>
    @endforeach
  </div>
  <small class="text-muted">Menu qaysi joylarda ko'rinishini tanlang</small>
  @error('locations')
  <div class="invalid-feedback d-block">{{ $message }}</div>
  @enderror
</div>

<div class="mb-4">
  <div class="form-check form-switch">
    <input class="form-check-input"
           type="checkbox"
           name="is_active"
           id="is_active"
           value="1"
        {{ (old('is_active', $menu->is_active ?? true)) ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">
      Faol
    </label>
  </div>
</div>

@push('scripts')
  <script>
      // Auto-generate slug from name
      document.getElementById('name').addEventListener('input', function() {
          const slug = this.value
              .toLowerCase()
              .replace(/[^a-z0-9\s-]/g, '')
              .replace(/\s+/g, '-')
              .replace(/-+/g, '-');
          document.getElementById('slug').value = slug;
      });
  </script>
@endpush
