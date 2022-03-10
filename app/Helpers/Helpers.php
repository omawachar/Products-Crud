<?php

use Illuminate\Support\Facades\Storage;

function upload($file, $path)
{
    $image = Storage::disk('public')->put($path, $file);
    return  Storage::url($image);
}



