<?php

namespace App\Http\Controllers\Painel;

use App\DataTables\Painel\Fornecedores;
use App\Http\Controllers\Painel\Controller;
use App\Http\Requests\Painel\Fornecedor\FornecedorStoreRequest;
use App\Http\Requests\Painel\Fornecedor\FornecedorUpdateRequest;
use App\Models\Agrupamento;
use App\Models\Cep;
use App\Models\Fornecedor;
use App\Models\FornecedorTipo;
use Illuminate\Support\Facades\DB;

class FornecedorController extends Controller
{
    public function index(Fornecedores $dataTable)
    {
        return $dataTable->render('painel.fornecedores.index');
    }

    public function create()
    {
        return view('painel.fornecedores.create');
    }

    public function store(FornecedorStoreRequest $request)
    {
        DB::beginTransaction();

        $fornecedor = Fornecedor::create($request->only([
            'cnpj',
            'url',
            'agrupamento_id',
            'fornecedor_tipo_id',
            'razao_social',
            'nome_fantasia',
            'cep',
            'numero',
            'complemento',
            'geolocalizacao',
            'avaliacao_ate',
            'pago_ate'
        ]));

        if ($request->hasFile('arquivo')) {
            $file_ext = $request->arquivo->extension();
            $file_md5 = md5_file($request->arquivo->path());
            $file_name = "{$file_md5}.{$file_ext}";
            $fornecedor->addMediaFromRequest('arquivo')->usingName($file_name)->usingFileName($file_name)->toMediaCollection('logo');
        }

        $contatos = $request->input('contatos', []);
        $fornecedor->contatos()->createMany($contatos);

        DB::commit();

        activity()
            ->event('painel.fornecedor')
            ->by($request->user())
            ->on($fornecedor)
            ->log('Criou o fornecedor');

        return redirect()->route('painel.fornecedores.edit', [$fornecedor]);
    }

    public function edit(Fornecedor $fornecedor)
    {
        $fornecedor->loadMissing(['contatos', 'tipo', 'agrupamento']);
        return view('painel.fornecedores.edit', compact('fornecedor'));
    }

    public function update(Fornecedor $fornecedor, FornecedorUpdateRequest $request)
    {
        DB::beginTransaction();

        $fornecedor->fill($request->only([
            'cnpj',
            'url',
            'agrupamento_id',
            'fornecedor_tipo_id',
            'razao_social',
            'nome_fantasia',
            'cep',
            'numero',
            'complemento',
            'geolocalizacao',
            'avaliacao_ate',
            'pago_ate'
        ]));
        $fornecedor->save();

        if ($request->hasFile('arquivo')) {
            if ($fornecedor->logo) {
                $fornecedor->logo->delete();
            }

            $file_ext = $request->arquivo->extension();
            $file_md5 = md5_file($request->arquivo->path());
            $file_name = "{$file_md5}.{$file_ext}";
            $fornecedor->addMediaFromRequest('arquivo')->usingName($file_name)->usingFileName($file_name)->toMediaCollection('logo');
        }

        $contatos = $request->input('contatos', []);
        $fornecedor->contatos()->delete();
        $fornecedor->contatos()->createMany($contatos);

        DB::commit();

        activity()
            ->event('painel.fornecedor')
            ->by($request->user())
            ->on($fornecedor)
            ->tap(auditor($fornecedor))
            ->log('Atualizou o fornecedor');

        return redirect()->route('painel.fornecedores.edit', [$fornecedor]);
    }

    public function destroy(Fornecedor $fornecedor)
    {
        $fornecedor->delete();

        activity()
            ->event('painel.fornecedor')
            ->by(request()->user())
            ->on($fornecedor)
            ->tap(auditor($fornecedor))
            ->log('Desabilitou o fornecedor');

        return redirect()->route('painel.fornecedores.index');
    }

    public function agrupamentos()
    {
        return Agrupamento::handleAsyncSelectRequest();
    }

    public function tipos()
    {
        return FornecedorTipo::handleAsyncSelectRequest();
    }

    public function ceps()
    {
        return Cep::handleAsyncSelectRequest();
    }
}
