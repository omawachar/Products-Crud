<?php

namespace App\Models;

use App\Http\Traits\ModelScopes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
  use HasFactory;
 
  protected $fillable = [
    'name',
    'image',
    'category_id',
    'is_active',
    'user_id'
  ];

  public function subcategories()
  {
    return $this->belongsToMany(Subcategory::class);
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function variants()
  {
    return $this->hasMany(Variant::class);
  }
  // public function categories()
  // {
  //   return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'category_id')->withTimestamps();
  // }

  public function setNameAttribute($value)
  {
    $this->attributes['name'] = ucfirst($value);
  }

  public function getCreatedAtAttribute($value)
  {
    $carbondate = new Carbon($value);
    return $carbondate->diffForHumans();
  }

  public function getUpdatedAtAttribute($value)
  {
    $carbondate = new Carbon($value);
    return $carbondate->diffForHumans();
  }

  public function scopeSelf($query)
  {
    return $query->where('user_id',Auth()->user()->id);
  }
}
