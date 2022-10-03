<?php

namespace App\Http\Controllers\Website;

use App\DataTables\Website\Procurar;
use App\Http\Controllers\Painel\Controller;
use App\Models\Cep;
use App\Models\Modelo;
use App\Models\Montadora;
use Illuminate\Http\Request;

class ProcurarController extends Controller
{
    public function index(Procurar $dataTable, Request $request)
    {
        $this->validate($request, [
            'q' => 'nullable|string',
            'filtros.estado' => 'nullable|uf',
            'filtros.montadora' => 'nullable|exists:montadoras,id',
            'filtros.tipo_veiculo' => 'nullable|in:caminhao,carro,moto',
            'filtros.modelo' => 'nullable|exists:modelos,id',
            'filtros.municipio' => 'nullable|exists:ceps,municipio',
            'filtros.cep' => 'nullable|formato_cep',
        ]);

        return $dataTable->render('website.procurar.index');
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

    public function municipios(Request $request)
    {
        $validated = $this->validate($request, [
            'estado' => 'required|uf',
            'q' => 'nullable|string'
        ]);

        $query = Cep::select([
            "municipio AS value",
            "municipio AS label"
        ])
            ->where('uf', $validated['estado'])
            ->groupBy('municipio')
            ->limit(20);

        if ($request->filled('q')) {
            $query->where('municipio', 'LIKE', "%{$validated['q']}%");
        }

        return response()->json($query->get());
    }
}
