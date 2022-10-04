<?php

namespace App\Http\Controllers\Painel;

use App\DataTables\Painel\Marcas;
use App\Http\Controllers\Painel\Controller;
use App\Http\Requests\Painel\Marca\MarcaStoreRequest;
use App\Http\Requests\Painel\Marca\MarcaUpdateRequest;
use App\Models\Marca;

class MarcaController extends Controller
{
    public function index(Marcas $dataTable)
    {
        return $dataTable->render('painel.marcas.index');
    }

    public function create()
    {
        return view('painel.marcas.create');
    }

    public function store(MarcaStoreRequest $request)
    {
        $marca = Marca::create($request->only([
            'nome'
        ]));

        activity()
            ->event('painel.marca')
            ->by($request->user())
            ->on($marca)
            ->log('Criou a marca');

        return redirect()->route('painel.marcas.edit', [$marca]);
    }

    public function edit(Marca $marca)
    {
        return view('painel.marcas.edit', compact('marca'));
    }

    public function update(MarcaUpdateRequest $request, Marca $marca)
    {
        $marca->update($request->only([
            'nome'
        ]));

        activity()
            ->event('painel.marca')
            ->by($request->user())
            ->on($marca)
            ->tap(auditor($marca))
            ->log('Atualizou a marca');

        return redirect()->route('painel.marcas.edit', [$marca]);
    }

    public function destroy(Marca $marca)
    {
        $marca->delete();

        activity()
            ->event('painel.marca')
            ->by(request()->user())
            ->on($marca)
            ->tap(auditor($marca))
            ->log('Desabilitou a marca');

        return redirect()->route('painel.marcas.index');
    }

    public function restore(Marca $marca)
    {
        $marca->restore();

        activity()
            ->event('painel.marca')
            ->by(request()->user())
            ->on($marca)
            ->tap(auditor($marca))
            ->log('Reabilitou a marca');

        return redirect()->route('painel.marcas.index');
    }
}
