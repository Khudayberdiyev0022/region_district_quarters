<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Region extends Model
{
  protected $fillable = ['soato_id', 'name_uz', 'name_oz', 'name_ru', 'order'];

  public function districts(): HasMany
  {
    return $this->hasMany(District::class);
  }

  public function quarters(): HasManyThrough
  {
    return $this->hasManyThrough(Quarter::class, District::class);
  }

  public function getName()
  {
    return $this->{"name_".app()->getLocale()};
  }
}
