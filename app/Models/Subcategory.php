<?php

namespace App\Models;

use App\Http\Traits\LocalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory, LocalScope, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable=[
        'category_id',
        'name',
        'user_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    // public function scopeSelf($query)
    // {
    //     return $query->where('user_id', Auth()->user()->id);
    // }
}
