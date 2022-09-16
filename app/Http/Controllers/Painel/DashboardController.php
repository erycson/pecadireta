<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;

use App\Http\Controllers\Painel\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('painel.dashboard.index');
    }
}
