<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Painel\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('website.home.index');
    }
}
