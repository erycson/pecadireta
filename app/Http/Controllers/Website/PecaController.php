<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Painel\Controller;
use App\Models\Peca;
use Illuminate\Http\Request;

class PecaController extends Controller
{
    public function index(Request $request, $fornecedor, Peca $peca, $nome)
    {
        abort_if($request->fullUrl() != $peca->url, 404);

        $peca->loadMissing(['fornecedor', 'fornecedor.media', 'fornecedor.tipo', 'fornecedor.cep', 'fornecedor.contatos']);

        return view('website.pecas.index', compact('peca'));
    }
}
