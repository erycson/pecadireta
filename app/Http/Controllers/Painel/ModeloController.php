<?php

namespace App\Http\Controllers\Painel;

use App\DataTables\Painel\Modelos;
use App\Http\Controllers\Painel\Controller;
use App\Http\Requests\Painel\Modelo\ModeloStoreRequest;
use App\Http\Requests\Painel\Modelo\ModeloUpdateRequest;
use App\Models\Modelo;
use App\Models\Montadora;

class ModeloController extends Controller
{
    public function index(Modelos $dataTable)
    {
        return $dataTable->render('painel.modelos.index');
    }

    public function create()
    {
        return view('painel.modelos.create');
    }

    public function store(ModeloStoreRequest $request)
    {
        $modelo = Modelo::create($request->only([
            'nome'
        ]));

        activity()
            ->event('painel.modelo')
            ->by($request->user())
            ->on($modelo)
            ->log('Criou o modelo');

        return redirect()->route('painel.modelos.edit', [$modelo]);
    }

    public function edit(Modelo $modelo)
    {
        return view('painel.modelos.edit', compact('modelo'));
    }

    public function update(ModeloUpdateRequest $request, Modelo $modelo)
    {
        $modelo->update($request->only([
            'nome'
        ]));

        activity()
            ->event('painel.modelo')
            ->by($request->user())
            ->on($modelo)
            ->tap(auditor($modelo))
            ->log('Atualizou o modelo');

        return redirect()->route('painel.modelos.edit', [$modelo]);
    }

    public function destroy(Modelo $modelo)
    {
        $modelo->delete();

        activity()
            ->event('painel.modelo')
            ->by(request()->user())
            ->on($modelo)
            ->tap(auditor($modelo))
            ->log('Desabilitou o modelo');

        return redirect()->route('painel.modelos.index');
    }

    public function restore(Modelo $modelo)
    {
        $modelo->restore();

        activity()
            ->event('painel.modelo')
            ->by(request()->user())
            ->on($modelo)
            ->tap(auditor($modelo))
            ->log('Reabilitou o modelo');

        return redirect()->route('painel.modelos.index');
    }

    public function montadoras()
    {
        return Montadora::handleAsyncSelectRequest();
    }
}
