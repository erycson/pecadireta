<?php

namespace App\Http\Controllers\Website;

use App\DataTables\Website\Estoque;
use App\Http\Controllers\Painel\Controller;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FornecedorController extends Controller
{
    public function index(Request $request, Estoque $dataTable, Fornecedor $fornecedor, $nome)
    {
        $url = route('website.fornecedores.index', [$fornecedor->id, Str::slug($fornecedor->nome_fantasia)]);
        abort_if($request->url() != $url, 404);

        $fornecedor->loadMissing(['media', 'tipo', 'cep', 'contatos']);

        return $dataTable->render('website.fornecedores.index', compact('fornecedor'));
    }
}
