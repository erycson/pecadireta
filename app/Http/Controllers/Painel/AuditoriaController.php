<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;

use App\Http\Controllers\Painel\Controller;
use App\DataTables\Painel\Auditorias;

class AuditoriaController extends Controller
{
    public function index(Auditorias $dataTable)
    {
        return $dataTable->render('painel.auditorias.index');
    }
}
