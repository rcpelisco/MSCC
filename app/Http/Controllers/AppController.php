<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AppController extends Controller
{
    public function update() {
        Artisan::call('app:update');
        return back();
    }
}
