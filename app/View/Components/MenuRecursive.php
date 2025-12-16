<?php

namespace App\View\Components;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class MenuRecursive extends Component
{
  public Collection $items;
  public int $depth;

  public function __construct($items, $depth = 0)
  {
    $this->items = $items instanceof Collection ? $items : collect($items);
    $this->depth = $depth;
  }

  public function render()
  {
    return view('components.menu-recursive');
  }
}
