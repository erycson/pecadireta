<?php

namespace App\Http\Controllers\Website;

use App\DataTables\Website\Procurar;
use App\Http\Controllers\Painel\Controller;
use Illuminate\Http\Request;

class ProcurarController extends Controller
{
    public function index(Procurar $dataTable, Request $request)
    {
        return $dataTable->render('website.procurar.index');
    }
}
