<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Quarter extends Model
{
  protected $fillable = ['district_id', 'soato_id', 'name_uz', 'name_oz', 'name_ru', 'order'];

  public function district(): BelongsTo
  {
    return $this->belongsTo(District::class);
  }
  public function getName()
  {
    return $this->{"name_".app()->getLocale()};
  }
}
