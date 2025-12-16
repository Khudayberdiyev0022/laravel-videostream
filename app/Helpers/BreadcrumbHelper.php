<?php

namespace App\Helpers;

use App\Models\Menu;
use Illuminate\Support\Collection;

class BreadcrumbHelper
{
  /**
   * Generate breadcrumb from menu
   */
  public static function generate(?Menu $currentMenu = null, ?string $currentTitle = null): Collection
  {
    $breadcrumbs = collect([
      [
        'title' => 'Asosiy',
        'url' => url('/'),
        'active' => false
      ]
    ]);

    if ($currentMenu) {
      // Get all parent menus
      $parents = $currentMenu->getParents();

      foreach ($parents as $parent) {
        $breadcrumbs->push([
          'title' => $parent->name,
          'url' => $parent->full_url,
          'active' => false
        ]);
      }

      // Add current menu
      $breadcrumbs->push([
        'title' => $currentMenu->name,
        'url' => $currentMenu->full_url,
        'active' => true
      ]);
    } elseif ($currentTitle) {
      // Add custom title
      $breadcrumbs->push([
        'title' => $currentTitle,
        'url' => null,
        'active' => true
      ]);
    }

    return $breadcrumbs;
  }

  /**
   * Generate breadcrumb from URL
   */
  public static function fromUrl(string $url): Collection
  {
    $menu = Menu::where('url', $url)
      ->orWhere('slug', trim($url, '/'))
      ->with('parent')
      ->first();

    return self::generate($menu);
  }

  /**
   * Generate custom breadcrumb manually
   */
  public static function custom(array $items): Collection
  {
    $breadcrumbs = collect([
      [
        'title' => 'Asosiy',
        'url' => url('/'),
        'active' => false
      ]
    ]);

    foreach ($items as $key => $item) {
      $isLast = $key === array_key_last($items);

      $breadcrumbs->push([
        'title' => is_array($item) ? $item['title'] : $item,
        'url' => $isLast ? null : (is_array($item) ? ($item['url'] ?? null) : null),
        'active' => $isLast
      ]);
    }

    return $breadcrumbs;
  }
}
