<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Helpers\BreadcrumbHelper;
use Illuminate\Http\Request;

class PageController extends Controller
{
  public function home()
  {
    return view('pages.home');
  }

  public function about()
  {
    // URL orqali breadcrumb
    $breadcrumbs = BreadcrumbHelper::fromUrl('/about');

    return view('pages.about', compact('breadcrumbs'));
  }

  public function contact()
  {
    // Manual breadcrumb
    $breadcrumbs = BreadcrumbHelper::custom([
      ['title' => 'Bog\'lanish', 'url' => null]
    ]);

    return view('pages.contact', compact('breadcrumbs'));
  }

  public function services()
  {
    // Menu orqali breadcrumb
    $menu = Menu::where('slug', 'services')->first();
    $breadcrumbs = BreadcrumbHelper::generate($menu);

    return view('pages.services', compact('breadcrumbs'));
  }

  public function serviceDetail($slug)
  {
    // Hierarchy breadcrumb
    $menu = Menu::where('slug', $slug)->first();

    if (!$menu) {
      abort(404);
    }

    $breadcrumbs = BreadcrumbHelper::generate($menu);

    return view('pages.service-detail', compact('menu', 'breadcrumbs'));
  }

  public function dynamicPage($slug)
  {
    // Dinamik sahifa uchun
    $menu = Menu::where('slug', $slug)
      ->orWhere('url', '/' . $slug)
      ->first();

    if (!$menu) {
      abort(404);
    }

    $breadcrumbs = BreadcrumbHelper::generate($menu);

    return view('pages.dynamic', compact('menu', 'breadcrumbs'));
  }
  public function books()
  {
    // URL orqali breadcrumb
    $breadcrumbs = BreadcrumbHelper::fromUrl('/books');

    return view('pages.books', compact('breadcrumbs'));
  }

  public function booksShow($filename)
  {
    $path = storage_path('books/' . $filename);

    if (!file_exists($path)) {
      abort(404);
    }

    return response()->file($path, [
      'Content-Type' => 'application/pdf',
    ]);
  }
}
