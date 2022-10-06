<?php

namespace App\Http\Controllers\Website;

use App\DataTables\Website\Estoque;
use App\Http\Controllers\Painel\Controller;
use App\Models\Peca;
use Illuminate\Http\Request;

class PecaController extends Controller
{
    public function index(Request $request, Estoque $dataTable, $fornecedor, Peca $peca, $nome)
    {
        abort_if($request->url() != $peca->url, 404);

        $peca->loadMissing(['fornecedor', 'fornecedor.media', 'fornecedor.tipo', 'fornecedor.cep', 'fornecedor.contatos']);

        return $dataTable->render('website.pecas.index', compact('peca'));
    }
}
