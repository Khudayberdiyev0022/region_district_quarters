<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
  protected $fillable = ['region_id', 'soato_id', 'name_uz', 'name_oz', 'name_ru', 'order'];

  public function region(): BelongsTo
  {
    return $this->belongsTo(Region::class);
  }

  public function quarters(): HasMany
  {
    return $this->hasMany(Quarter::class);
  }

  public function getName()
  {
    return $this->{"name_".app()->getLocale()};
  }
}
