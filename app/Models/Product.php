<?php

namespace App\Models;

use Carbon\Carbon;
use App\Http\Traits\LocalScope;
use App\Http\Traits\ModelScopes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
  use HasFactory , LocalScope, SoftDeletes;
  //protected $dates = ['deleted_at'];
 
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

}
