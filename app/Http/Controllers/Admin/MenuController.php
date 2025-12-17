<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
  private $availableLocations = [
    'header' => 'Header Menu',
    'footer' => 'Footer Menu',
    'mobile' => 'Mobile Menu',
    'sidebar' => 'Sidebar Menu',
  ];

  public function index(Request $request)
  {
    $location = $request->get('location', 'all');

    $query = Menu::with('childrenRecursive');

    if ($location !== 'all') {
      $query->forLocation($location);
    }

    $menus = $query->parents()->get();

    return view('admin.menus.index', [
      'menus' => $menus,
      'location' => $location,
      'locations' => $this->availableLocations
    ]);
  }

  public function create()
  {
    // Barcha parent menuларni childrenлари bilan olish
    $parentMenus = Menu::with('childrenRecursive')
      ->parents()
      ->orderBy('order')
      ->get();

    $locations = $this->availableLocations;

    return view('admin.menus.create', compact('parentMenus', 'locations'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'slug' => 'required|string|unique:menus|max:255',
      'url' => 'nullable|string|max:255',
      'external_link' => 'nullable|url|max:255',
      'parent_id' => 'nullable|exists:menus,id',
      'order' => 'required|integer|min:0',
      'is_active' => 'boolean',
      'icon' => 'nullable|string|max:100',
      'target' => 'required|in:_self,_blank',
      'locations' => 'nullable|array',
      'locations.*' => 'in:header,footer,mobile,sidebar',
    ]);

    $validated['is_active'] = $request->has('is_active');

    Menu::create($validated);

    return redirect()
      ->route('admin.menus.index')
      ->with('success', 'Menu muvaffaqiyatli yaratildi!');
  }

  public function edit(Menu $menu)
  {
    // Hozirgi menu va uning childrenlarini exclude qilish
    $parentMenus = Menu::with('childrenRecursive')
      ->where('id', '!=', $menu->id)
      ->whereNotIn('id', $this->getMenuAndDescendants($menu))
      ->parents()
      ->orderBy('order')
      ->get();

    $locations = $this->availableLocations;

    return view('admin.menus.edit', compact('menu', 'parentMenus', 'locations'));
  }

  public function update(Request $request, Menu $menu)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'slug' => 'required|string|max:255|unique:menus,slug,' . $menu->id,
      'url' => 'nullable|string|max:255',
      'external_link' => 'nullable|url|max:255',
      'parent_id' => 'nullable|exists:menus,id',
      'order' => 'required|integer|min:0',
      'is_active' => 'boolean',
      'icon' => 'nullable|string|max:100',
      'target' => 'required|in:_self,_blank',
      'locations' => 'nullable|array',
      'locations.*' => 'in:header,footer,mobile,sidebar',
    ]);

    $validated['is_active'] = $request->has('is_active');

    $menu->update($validated);

    return redirect()
      ->route('admin.menus.index')
      ->with('success', 'Menu yangilandi!');
  }

  public function destroy(Menu $menu)
  {
    $menu->delete();
    return response()->json(['success' => true]);
  }

  public function updateOrder(Request $request)
  {
    $validated = $request->validate([
      'items' => 'required|array',
      'items.*.id' => 'required|exists:menus,id',
      'items.*.order' => 'required|integer|min:0',
    ]);

    foreach ($validated['items'] as $item) {
      Menu::where('id', $item['id'])->update(['order' => $item['order']]);
    }

    return response()->json(['success' => true, 'message' => 'Tartib yangilandi!']);
  }

  /**
   * Menyu va uning barcha childrenlarining ID'larini olish
   */
  private function getMenuAndDescendants(Menu $menu)
  {
    $ids = [$menu->id];

    $menu->load('childrenRecursive');

    $this->collectChildrenIds($menu->childrenRecursive, $ids);

    return $ids;
  }

  /**
   * Rekursiv ravishda barcha children ID'larni to'plash
   */
  private function collectChildrenIds($children, &$ids)
  {
    foreach ($children as $child) {
      $ids[] = $child->id;

      if ($child->childrenRecursive && $child->childrenRecursive->isNotEmpty()) {
        $this->collectChildrenIds($child->childrenRecursive, $ids);
      }
    }
  }
}
