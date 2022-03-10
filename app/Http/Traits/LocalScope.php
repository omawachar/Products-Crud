<?php

namespace App\Http\Traits;


trait LocalScope{

    public function scopeSelf($query){

        return $query->where('user_id',Auth()->user()->id);
    }

}