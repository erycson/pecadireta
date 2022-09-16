<?php

namespace App\Http\Controllers\Painel;

use App\DataTables\Painel\Agrupamentos;
use App\Http\Controllers\Painel\Controller;
use App\Http\Requests\Painel\Agrupamento\AgrupamentoStoreRequest;
use App\Http\Requests\Painel\Agrupamento\AgrupamentoUpdateRequest;
use App\Models\Agrupamento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AgrupamentoController extends Controller
{
    public function index(Agrupamentos $dataTable)
    {
        return $dataTable->render('painel.agrupamentos.index');
    }

    public function create()
    {
        return view('painel.agrupamentos.create');
    }

    public function store(AgrupamentoStoreRequest $request)
    {
        DB::beginTransaction();
        $form = $request->only([
            'nome'
        ]);
        $form['slug'] = Str::slug($form['nome']);
        $agrupamento = Agrupamento::create($form);

        if ($request->hasFile('arquivo')) {
            $file_ext = $request->arquivo->extension();
            $file_md5 = md5_file($request->arquivo->path());
            $file_name = "{$file_md5}.{$file_ext}";
            $agrupamento->addMediaFromRequest('arquivo')->usingName($file_name)->usingFileName($file_name)->toMediaCollection('cover');
        }

        activity()
            ->event('painel.agrupamento')
            ->by($request->user())
            ->on($agrupamento)
            ->log('Criou o agrupamento');

        DB::commit();

        return redirect()->route('painel.agrupamentos.edit', [$agrupamento]);
    }

    public function edit(Agrupamento $agrupamento)
    {
        return view('painel.agrupamentos.edit', compact('agrupamento'));
    }

    public function update(AgrupamentoUpdateRequest $request, Agrupamento $agrupamento)
    {
        DB::beginTransaction();
        $form = $request->only([
            'nome'
        ]);
        $form['slug'] = Str::slug($form['nome']);
        $agrupamento->update($form);

        if ($request->hasFile('arquivo')) {
            if ($agrupamento->logo) {
                $agrupamento->logo->delete();
            }

            $file_ext = $request->arquivo->extension();
            $file_md5 = md5_file($request->arquivo->path());
            $file_name = "{$file_md5}.{$file_ext}";
            $agrupamento->addMediaFromRequest('arquivo')->usingName($file_name)->usingFileName($file_name)->toMediaCollection('logo');
        }

        activity()
            ->event('painel.agrupamento')
            ->by($request->user())
            ->on($agrupamento)
            ->tap(auditor($agrupamento))
            ->log('Atualizou o agrupamento');

        DB::commit();

        return redirect()->route('painel.agrupamentos.edit', [$agrupamento]);
    }

    public function destroy(Agrupamento $agrupamento)
    {
        $agrupamento->delete();

        activity()
            ->event('painel.agrupamento')
            ->by(request()->user())
            ->on($agrupamento)
            ->tap(auditor($agrupamento))
            ->log('Desabilitou o agrupamento');

        return redirect()->route('painel.agrupamentos.index');
    }

    public function restore(Agrupamento $agrupamento)
    {
        $agrupamento->restore();

        activity()
            ->event('painel.agrupamento')
            ->by(request()->user())
            ->on($agrupamento)
            ->tap(auditor($agrupamento))
            ->log('Reabilitou o agrupamento');

        return redirect()->route('painel.agrupamentos.index');
    }
}
