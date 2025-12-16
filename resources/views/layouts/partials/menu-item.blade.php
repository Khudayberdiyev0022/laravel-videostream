<tr class="menu-level-{{ $level }}" data-id="{{ $menu->id }}">
  <td>
    <span class="badge bg-secondary">{{ $menu->order }}</span>
  </td>
  <td>
    @if($menu->icon)
    <i class="{{ $menu->icon }}"></i>
    @endif
    {{ $menu->name }}
    @if($menu->children->isNotEmpty())
    <span class="badge bg-info ms-2">{{ $menu->children->count() }}</span>
    @endif
  </td>
  <td>
    @if($menu->external_link)
    <a href="{{ $menu->external_link }}" target="_blank" class="text-primary">
      <i class="fas fa-external-link-alt"></i> {{ Str::limit($menu->external_link, 40) }}
    </a>
    @elseif($menu->url)
    <span class="text-muted">{{ $menu->url }}</span>
    @else
    <span class="text-muted">-</span>
    @endif
  </td>
  <td>
    @if($menu->locations)
    @foreach($menu->locations as $loc)
    <span class="badge bg-primary location-badge me-1">{{ $loc }}</span>
    @endforeach
    @else
    <span class="text-muted">-</span>
    @endif
  </td>
  <td>
    @if($menu->is_active)
    <span class="badge bg-success">Faol</span>
    @else
    <span class="badge bg-danger">Nofaol</span>
    @endif
  </td>
  <td class="text-end">
    <div class="btn-group btn-group-sm">
      <a href="{{ route('admin.menus.edit', $menu) }}"
         class="btn btn-outline-primary"
         title="Tahrirlash">
        <i class="fas fa-edit"></i>
      </a>
      <form action="{{ route('admin.menus.destroy', $menu) }}"
            method="POST"
            class="d-inline"
            onsubmit="return confirm('Ishonchingiz komilmi?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger" title="O'chirish">
          <i class="fas fa-trash"></i>
        </button>
      </form>
    </div>
  </td>
</tr>

@if($menu->children->isNotEmpty())
@foreach($menu->children as $child)
@include('admin.menus.partials.menu-item', ['menu' => $child, 'level' => $level + 1])
@endforeach
@endif
