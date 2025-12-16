<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
  public function register()
  {
    //
  }

  public function boot()
  {
    // Header Menu
    View::composer(['layouts.app', 'layouts.partials.header', 'partials.header'], function ($view) {
      $headerMenu = Menu::with('childrenRecursive')
        ->active()
        ->forLocation('header')
        ->parents()
        ->get();

      $view->with('headerMenu', $headerMenu);
    });

    // Footer Menu
    View::composer(['layouts.app', 'layouts.partials.footer', 'partials.footer'], function ($view) {
      $footerMenu = Menu::with('childrenRecursive')
        ->active()
        ->forLocation('footer')
        ->parents()
        ->get();

      $view->with('footerMenu', $footerMenu);
    });

    // Mobile Menu
    View::composer(['layouts.app', 'layouts.partials.mobile-menu', 'partials.mobile-menu'], function ($view) {
      $mobileMenu = Menu::with('childrenRecursive')
        ->active()
        ->forLocation('mobile')
        ->parents()
        ->get();

      $view->with('mobileMenu', $mobileMenu);
    });

    // Sidebar Menu (agar kerak bo'lsa)
    View::composer(['layouts.app', 'layouts.partials.sidebar', 'partials.sidebar'], function ($view) {
      $sidebarMenu = Menu::with('childrenRecursive')
        ->active()
        ->forLocation('sidebar')
        ->parents()
        ->get();

      $view->with('sidebarMenu', $sidebarMenu);
    });
  }
}
