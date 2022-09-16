<?php

namespace App\Http\Controllers\Painel;

use App\DataTables\Painel\Montadoras;
use App\Http\Controllers\Painel\Controller;
use App\Http\Requests\Painel\Montadora\MontadoraStoreRequest;
use App\Http\Requests\Painel\Montadora\MontadoraUpdateRequest;
use App\Models\Montadora;

class MontadoraController extends Controller
{
    public function index(Montadoras $dataTable)
    {
        return $dataTable->render('painel.montadoras.index');
    }

    public function create()
    {
        return view('painel.montadoras.create');
    }

    public function store(MontadoraStoreRequest $request)
    {
        $montadora = Montadora::create($request->only([
            'nome'
        ]));

        activity()
            ->event('painel.montadora')
            ->by($request->user())
            ->on($montadora)
            ->log('Criou a montadora');

        return redirect()->route('painel.montadoras.edit', [$montadora]);
    }

    public function edit(Montadora $montadora)
    {
        return view('painel.montadoras.edit', compact('montadora'));
    }

    public function update(MontadoraUpdateRequest $request, Montadora $montadora)
    {
        $montadora->update($request->only([
            'nome'
        ]));

        activity()
            ->event('painel.montadora')
            ->by($request->user())
            ->on($montadora)
            ->tap(auditor($montadora))
            ->log('Atualizou a montadora');

        return redirect()->route('painel.montadoras.edit', [$montadora]);
    }

    public function destroy(Montadora $montadora)
    {
        $montadora->delete();

        activity()
            ->event('painel.montadora')
            ->by(request()->user())
            ->on($montadora)
            ->tap(auditor($montadora))
            ->log('Desabilitou a montadora');

        return redirect()->route('painel.montadoras.index');
    }

    public function restore(Montadora $montadora)
    {
        $montadora->restore();

        activity()
            ->event('painel.montadora')
            ->by(request()->user())
            ->on($montadora)
            ->tap(auditor($montadora))
            ->log('Reabilitou a montadora');

        return redirect()->route('painel.montadoras.index');
    }
}
