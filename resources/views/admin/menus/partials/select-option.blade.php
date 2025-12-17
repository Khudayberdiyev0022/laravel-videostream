<option value="{{ $menu->id }}"
    {{ $selected == $menu->id ? 'selected' : '' }}>
  {!! str_repeat('&nbsp;&nbsp;&nbsp;', $level) !!}
  @if($level > 0)└─ @endif
  {{ $menu->name }}
</option>

@if($menu->childrenRecursive && $menu->childrenRecursive->isNotEmpty())
  @foreach($menu->childrenRecursive as $child)
    @include('admin.menus.partials.select-option', [
        'menu' => $child,
        'level' => $level + 1,
        'selected' => $selected
    ])
  @endforeach
@endif
