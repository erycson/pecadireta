<?php

namespace App\Http\Controllers\Painel;

use App\DataTables\Painel\FornecedoresTipos;
use App\Http\Controllers\Painel\Controller;
use Illuminate\Http\Request;

class FornecedorTipoController extends Controller
{
    public function index(FornecedoresTipos $dataTable)
    {
        return $dataTable->render('painel.fornecedores-tipos.index');
    }
}
