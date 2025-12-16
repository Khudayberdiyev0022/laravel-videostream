<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
  public function run()
  {
    // Bosh sahifa
    Menu::create([
      'name' => 'Bosh sahifa',
      'slug' => 'home',
      'url' => '/',
      'order' => 1,
      'is_active' => true,
      'icon' => 'fas fa-home',
      'target' => '_self',
      'locations' => ['header', 'mobile']
    ]);

    // Biz haqimizda
    $about = Menu::create([
      'name' => 'Biz haqimizda',
      'slug' => 'about',
      'url' => '/about',
      'order' => 2,
      'is_active' => true,
      'icon' => 'fas fa-info-circle',
      'target' => '_self',
      'locations' => ['header', 'footer', 'mobile']
    ]);

    // Xizmatlar (with children)
    $services = Menu::create([
      'name' => 'Xizmatlar',
      'slug' => 'services',
      'url' => '/services',
      'order' => 3,
      'is_active' => true,
      'icon' => 'fas fa-briefcase',
      'target' => '_self',
      'locations' => ['header', 'mobile']
    ]);

    // Xizmatlar children
    Menu::create([
      'name' => 'Web Development',
      'slug' => 'web-development',
      'url' => '/services/web-development',
      'parent_id' => $services->id,
      'order' => 1,
      'is_active' => true,
      'target' => '_self',
      'locations' => ['header', 'mobile']
    ]);

    Menu::create([
      'name' => 'Mobile Development',
      'slug' => 'mobile-development',
      'url' => '/services/mobile-development',
      'parent_id' => $services->id,
      'order' => 2,
      'is_active' => true,
      'target' => '_self',
      'locations' => ['header', 'mobile']
    ]);

    $design = Menu::create([
      'name' => 'Design',
      'slug' => 'design',
      'url' => '/services/design',
      'parent_id' => $services->id,
      'order' => 3,
      'is_active' => true,
      'target' => '_self',
      'locations' => ['header', 'mobile']
    ]);

    // Design sub-children
    Menu::create([
      'name' => 'UI/UX Design',
      'slug' => 'ui-ux-design',
      'url' => '/services/design/ui-ux',
      'parent_id' => $design->id,
      'order' => 1,
      'is_active' => true,
      'target' => '_self',
      'locations' => ['header']
    ]);

    Menu::create([
      'name' => 'Graphic Design',
      'slug' => 'graphic-design',
      'url' => '/services/design/graphic',
      'parent_id' => $design->id,
      'order' => 2,
      'is_active' => true,
      'target' => '_self',
      'locations' => ['header']
    ]);

    // Portfolio
    Menu::create([
      'name' => 'Portfolio',
      'slug' => 'portfolio',
      'url' => '/portfolio',
      'order' => 4,
      'is_active' => true,
      'icon' => 'fas fa-images',
      'target' => '_self',
      'locations' => ['header', 'mobile']
    ]);

    // Blog
    Menu::create([
      'name' => 'Blog',
      'slug' => 'blog',
      'url' => '/blog',
      'order' => 5,
      'is_active' => true,
      'icon' => 'fas fa-blog',
      'target' => '_self',
      'locations' => ['header', 'footer', 'mobile']
    ]);

    // Bog'lanish
    Menu::create([
      'name' => 'Bog\'lanish',
      'slug' => 'contact',
      'url' => '/contact',
      'order' => 6,
      'is_active' => true,
      'icon' => 'fas fa-envelope',
      'target' => '_self',
      'locations' => ['header', 'footer', 'mobile']
    ]);

    // Footer uchun qo'shimcha menubar
    Menu::create([
      'name' => 'Maxfiylik siyosati',
      'slug' => 'privacy-policy',
      'url' => '/privacy-policy',
      'order' => 7,
      'is_active' => true,
      'target' => '_self',
      'locations' => ['footer']
    ]);

    Menu::create([
      'name' => 'Foydalanish shartlari',
      'slug' => 'terms-of-service',
      'url' => '/terms',
      'order' => 8,
      'is_active' => true,
      'target' => '_self',
      'locations' => ['footer']
    ]);

    // External link misoli
    Menu::create([
      'name' => 'GitHub',
      'slug' => 'github',
      'external_link' => 'https://github.com',
      'order' => 9,
      'is_active' => true,
      'icon' => 'fab fa-github',
      'target' => '_blank',
      'locations' => ['footer']
    ]);
  }
}
