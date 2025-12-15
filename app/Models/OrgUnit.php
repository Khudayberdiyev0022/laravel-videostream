<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrgUnit extends Model
{
  protected $fillable = ['parent_id', 'title', 'position', 'is_dashed'];

  public function children()
  {
    return $this->hasMany(self::class, 'parent_id')
      ->orderBy('position');
  }
}

