<?php

namespace App\Http\Controllers\Painel;

use App\DataTables\Painel\Agrupamentos;
use App\Http\Controllers\Painel\Controller;
use Illuminate\Http\Request;

class AgrupamentoController extends Controller
{
    public function index(Agrupamentos $dataTable)
    {
        return $dataTable->render('painel.agrupamentos.index');
    }
}
