<?php

namespace App\Http\Controllers\Painel;

use App\DataTables\Painel\Ceps;
use App\Http\Controllers\Painel\Controller;
use App\Http\Requests\Painel\Cep\CepStoreRequest;
use App\Http\Requests\Painel\Cep\CepUpdateRequest;
use App\Models\Cep;

class CepController extends Controller
{
    public function index(Ceps $dataTable)
    {
        return $dataTable->render('painel.ceps.index');
    }

    public function create()
    {
        return view('painel.ceps.create');
    }

    public function store(CepStoreRequest $request)
    {
        $cep = Cep::create($request->only([
            'cep',
            'uf',
            'municipio',
            'bairro',
            'tipo',
            'logradouro',
        ]));

        activity()
            ->event('painel.cep')
            ->by($request->user())
            ->on($cep)
            ->log('Criou o CEP');

        return redirect()->route('painel.ceps.edit', [$cep]);
    }

    public function edit(Cep $cep)
    {
        return view('painel.ceps.edit', compact('cep'));
    }

    public function update(CepUpdateRequest $request, Cep $cep)
    {
        $cep->update($request->only([
            'cep',
            'uf',
            'municipio',
            'bairro',
            'tipo',
            'logradouro',
        ]));

        activity()
            ->event('painel.cep')
            ->by($request->user())
            ->on($cep)
            ->tap(auditor($cep))
            ->log('Atualizou o CEP');

        return redirect()->route('painel.ceps.edit', [$cep]);
    }

    public function destroy(Cep $cep)
    {
        $cep->delete();

        activity()
            ->event('painel.cep')
            ->by(request()->user())
            ->on($cep)
            ->tap(auditor($cep))
            ->log('Removeu o CEP');

        return redirect()->route('painel.ceps.index');
    }
}
