<?php

namespace App\DataTables\Painel;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

use App\Models\Fornecedor as Model;

class Fornecedores extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query->select([
                'fornecedores.id',
                'fornecedores.fornecedor_tipo_id',
                'fornecedores.agrupamento_id',
                'fornecedores.nome_fantasia',
                'fornecedores.pago_ate',
                'fornecedores.avaliacao_ate',
                'fornecedores.criado_em',
            ]))
            ->only([
                'id',
                'agrupamento',
                'tipo',
                'nome_fantasia',
                'pago_ate',
                'avaliacao_ate',
                'criado_em',
                'acoes',
            ])
            ->editColumn('agrupamento.nome', fn ($fornecedor) => $fornecedor->agrupamento ? sprintf('<a href="%s">%s</a>', route('painel.agrupamentos.edit', [$fornecedor->agrupamento]), $fornecedor->agrupamento->nome) : '')
            ->editColumn('tipo.nome', fn ($fornecedor) => $fornecedor->tipo ? sprintf('<a href="%s">%s</a>', route('painel.fornecedores-tipos.edit', [$fornecedor->tipo]), $fornecedor->tipo->nome) : '')
            ->editColumn('pago_ate', fn ($fornecedor) => $fornecedor->pago_ate?->format('d/m/Y'))
            ->editColumn('avaliacao_ate', fn ($fornecedor) => $fornecedor->avaliacao_ate?->format('d/m/Y'))
            ->editColumn('criado_em', fn ($fornecedor) => $fornecedor->criado_em->format('d/m/Y'))
            ->addColumn('acoes', fn ($fornecedor) => sprintf('
                    <div class="row gx-1 justify-content-end flex-nowrap">
                        <div class="col-auto">
                            <a href="%s" class="btn btn-sm btn-secondary rounded-pill px-3">Editar</a>
                        </div>
                    </div>
                ', route('painel.fornecedores.edit', [$fornecedor]))
            )
            ->rawColumns(['acoes', 'agrupamento.nome', 'tipo.nome']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Model $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Model $model)
    {
        return $model->with(['agrupamento', 'tipo'])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('fornecedores-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1, 'asc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('agrupamento.nome')->title('Agrupamento'),
            Column::make('nome_fantasia')->title('Nome Fantasia'),
            Column::make('tipo.nome')->title('Tipo'),
            Column::make('pago_ate')->title('Pago até'),
            Column::make('avaliacao_ate')->title('Avaliação até'),
            Column::make('criado_em')->title('Criado em'),
            Column::computed('acoes')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        $className = (new \ReflectionClass($this))->getShortName();
        return date('Y-m-d') - '-' . strtolower($className);
    }
}
