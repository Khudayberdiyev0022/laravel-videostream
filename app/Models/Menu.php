<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
  protected $fillable = [
    'name',
    'slug',
    'url',
    'external_link',
    'parent_id',
    'order',
    'is_active',
    'icon',
    'target',
    'locations'
  ];

  protected $casts = [
    'is_active' => 'boolean',
    'locations' => 'array',
  ];

  // Relationships
  public function parent(): BelongsTo
  {
    return $this->belongsTo(Menu::class, 'parent_id');
  }

  public function children(): HasMany
  {
    return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
  }

  public function childrenRecursive(): HasMany
  {
    return $this->hasMany(Menu::class, 'parent_id')
      ->with('childrenRecursive')
      ->orderBy('order');
  }

  // Scopes
  public function scopeParents($query)
  {
    return $query->whereNull('parent_id')->orderBy('order');
  }

  public function scopeActive($query)
  {
    return $query->where('is_active', true);
  }

  public function scopeForLocation($query, string $location)
  {
    return $query->whereJsonContains('locations', $location);
  }

  // Accessors
  public function getFullUrlAttribute(): string
  {
    if ($this->external_link) {
      return $this->external_link;
    }
    return $this->url ?? '#';
  }

  // Helper methods
  public function hasLocation(string $location): bool
  {
    return in_array($location, $this->locations ?? []);
  }

  public function isInHeader(): bool
  {
    return $this->hasLocation('header');
  }

  public function isInFooter(): bool
  {
    return $this->hasLocation('footer');
  }

  public function isInMobile(): bool
  {
    return $this->hasLocation('mobile');
  }

  // Get all parent menus (for breadcrumb)
  public function getParents()
  {
    $parents = collect();
    $current = $this;

    while ($current->parent) {
      $parents->push($current->parent);
      $current = $current->parent;
    }

    return $parents->reverse();
  }
}
