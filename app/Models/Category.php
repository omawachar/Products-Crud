<?php

namespace App\Models;

use App\Http\Traits\LocalScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, LocalScope;
    protected $fillable = [
        'category_name', 'user_id'
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    // public function scopeSelf($query){
    //     return $query->where('user_id',Auth()->user()->id);
    // }

}
