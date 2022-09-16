<?php

namespace App\Http\Controllers\Painel;

use App\DataTables\Painel\FornecedoresTipos;
use App\Http\Controllers\Painel\Controller;
use App\Models\FornecedorTipo;
use App\Http\Requests\Painel\FornecedorTipo\FornecedorTipoStoreRequest;
use App\Http\Requests\Painel\FornecedorTipo\FornecedorTipoUpdateRequest;

class FornecedorTipoController extends Controller
{
    public function index(FornecedoresTipos $dataTable)
    {
        return $dataTable->render('painel.fornecedores-tipos.index');
    }

    public function create()
    {
        return view('painel.fornecedores-tipos.create');
    }

    public function store(FornecedorTipoStoreRequest $request)
    {
        $fornecedorTipo = FornecedorTipo::create($request->only([
            'nome'
        ]));

        activity()
            ->event('painel.fornecedor-tipo')
            ->by($request->user())
            ->on($fornecedorTipo)
            ->log('Criou o tipo de fornecedor');

        return redirect()->route('painel.fornecedores-tipos.edit', [$fornecedorTipo]);
    }

    public function edit(FornecedorTipo $fornecedorTipo)
    {
        return view('painel.fornecedores-tipos.edit', compact('fornecedorTipo'));
    }

    public function update(FornecedorTipo $fornecedorTipo, FornecedorTipoUpdateRequest $request)
    {
        $fornecedorTipo->update($request->only([
            'nome'
        ]));

        activity()
            ->event('painel.fornecedor-tipo')
            ->by($request->user())
            ->on($fornecedorTipo)
            ->tap(auditor($fornecedorTipo))
            ->log('Atualizou o tipo de fornecedor');

        return redirect()->route('painel.fornecedores-tipos.edit', [$fornecedorTipo]);
    }

    public function destroy(FornecedorTipo $fornecedorTipo)
    {
        $fornecedorTipo->delete();

        activity()
            ->event('painel.fornecedor-tipo')
            ->by(request()->user())
            ->on($fornecedorTipo)
            ->tap(auditor($fornecedorTipo))
            ->log('Desabilitou o tipo de fornecedor');

        return redirect()->route('painel.fornecedores-tipos.index');
    }
}
