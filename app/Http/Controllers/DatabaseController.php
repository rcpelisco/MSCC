<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DatabaseController extends Controller
{
    public function dump() {
        Artisan::call('make:controller', ['name' => 'ContolAnjing']);
        return back();
    }
    
    public function restore() {
        Artisan::call('db:restore');
        return back();
    }
}
