<?php

namespace App\Http\Traits;

trait ModelScopes{

// public function scopeAddedBy($model){

//     return $model::where('user_id', '=', Auth()->user()->id)->get();
// }

public function scopeCategory($model){

    return $model::where('user_id','=',Auth()->user()->id)->get();
}

public function scopeProduct($model){
    return $model::where('user_id','=',Auth()->user()->id)->get();
}
public function scopeSubcat($model){

    return $model::where('user_id', '=', Auth()->user()->id)->get();
}

}