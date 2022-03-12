<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class PlayController extends Controller
{
    public function index()
    {
        return Admin::all();
    }
}
