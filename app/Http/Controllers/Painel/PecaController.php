<?php

namespace App\Http\Controllers\Painel;

use App\DataTables\Painel\Pecas;
use App\Http\Controllers\Painel\Controller;
use App\Http\Requests\Painel\Peca\PecaStoreRequest;
use App\Http\Requests\Painel\Peca\PecaUpdateRequest;
use App\Models\Fornecedor;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Montadora;
use App\Models\Peca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PecaController extends Controller
{
    public function index(Pecas $dataTable)
    {
        return $dataTable->render('painel.pecas.index');
    }

    public function create()
    {
        return view('painel.pecas.create');
    }

    public function store(PecaStoreRequest $request)
    {
        DB::beginTransaction();

        $peca = Peca::create($request->only([
            'marca_id',
            'fornecedor_id',
            'sku',
            'nome',
            'estoque',
            'preco',
            'tipo_peca',
            'absoleta',
        ]));

        $aplicacoes = $request->validated('aplicacoes', []);
        $peca->aplicacoes()->createMany($aplicacoes);

        DB::commit();

        activity()
            ->event('painel.peca')
            ->by($request->user())
            ->on($peca)
            ->log('Criou a Peça');

        return redirect()->route('painel.pecas.edit', [$peca]);
    }

    public function edit(Peca $peca)
    {
        $peca->loadMissing(['fornecedor', 'marca', 'aplicacoes', 'aplicacoes.modelo', 'aplicacoes.modelo.montadora']);
        return view('painel.pecas.edit', compact('peca'));
    }

    public function update(PecaUpdateRequest $request, Peca $peca)
    {
        DB::beginTransaction();

        $peca->update($request->only([
            'marca_id',
            'fornecedor_id',
            'sku',
            'nome',
            'estoque',
            'preco',
            'tipo_peca',
            'absoleta',
        ]));

        $aplicacoes = $request->validated('aplicacoes', []);
        $peca->aplicacoes()->delete();
        $peca->aplicacoes()->createMany($aplicacoes);

        DB::commit();

        activity()
            ->event('painel.peca')
            ->by($request->user())
            ->on($peca)
            ->tap(auditor($peca))
            ->log('Atualizou a Peça');

        return redirect()->route('painel.pecas.edit', [$peca]);
    }

    public function destroy(Peca $peca)
    {
        $peca->delete();

        activity()
            ->event('painel.peca')
            ->by(request()->user())
            ->on($peca)
            ->tap(auditor($peca))
            ->log('Removeu Peca');

        return redirect()->route('painel.pecas.index');
    }

    public function fornecedores()
    {
        return Fornecedor::handleAsyncSelectRequest();
    }

    public function marcas()
    {
        return Marca::handleAsyncSelectRequest();
    }

    public function montadoras()
    {
        return Montadora::handleAsyncSelectRequest();
    }

    public function modelos(Request $request)
    {
        $validated = $this->validate($request, [
            'montadora' => 'required|exists:montadoras,id',
            'q' => 'nullable|string'
        ]);

        $query = Modelo::select([
            "id AS value",
            "nome AS label"
        ])
            ->where('montadora_id', 'LIKE', $validated['montadora'])
            ->limit(20);

        if ($request->filled('q')) {
            $query->where('nome', 'LIKE', "%{$validated['q']}%");
        }

        return response()->json($query->get());
    }
}
