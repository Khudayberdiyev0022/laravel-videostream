<div>
    @props(['items' => []])

    @if($items && $items->count() > 1)
        <nav aria-label="breadcrumb" class="breadcrumb-wrapper">
            <div class="container">
                <ol class="breadcrumb mb-0" itemscope itemtype="https://schema.org/BreadcrumbList">
                    @foreach($items as $index => $item)
                        <li class="breadcrumb-item {{ $item['active'] ? 'active' : '' }}"
                            itemprop="itemListElement"
                            itemscope
                            itemtype="https://schema.org/ListItem">

                            @if($item['active'] || !$item['url'])
                                <span itemprop="name">{{ $item['title'] }}</span>
                            @else
                                <a href="{{ $item['url'] }}" itemprop="item">
                                    <span itemprop="name">{{ $item['title'] }}</span>
                                </a>
                            @endif

                            <meta itemprop="position" content="{{ $index + 1 }}" />
                        </li>
                    @endforeach
                </ol>
            </div>
        </nav>
    @endif
</div>
