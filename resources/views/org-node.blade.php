<li>
  <div class="node {{ $node->is_dashed ? 'dashed' : '' }}">
    {{ $node->title }}
  </div>

  @if($node->children->count())
    <ul>
      @foreach($node->children as $child)
        @include('org-node', ['node' => $child])
      @endforeach
    </ul>
  @endif
</li>
