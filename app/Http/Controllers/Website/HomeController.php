<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Painel\Controller;
use App\Models\Agrupamento;
use App\Models\Fornecedor;

class HomeController extends Controller
{
    public function index()
    {
        $agrupamentos = Agrupamento::with('media')->has('media')->inRandomOrder()->limit(3 * 9)->get();
        $parceiros = Fornecedor::with('media')->has('media')->inRandomOrder()->limit(8)->get();
        return view('website.home.index', compact('agrupamentos', 'parceiros'));
    }
}
