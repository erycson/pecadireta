<?php

namespace App\DataTables\Painel;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

use App\Models\Agrupamento as Model;

class Agrupamentos extends DataTable
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
            ->eloquent($query)
            ->addColumn('fornecedores', fn ($agrupamento) => $agrupamento->fornecedores_count)
            ->editColumn('criado_em', fn ($agrupamento) => $agrupamento->criado_em->format('d/m/Y'))
            ->addColumn('acoes', fn ($agrupamento) => sprintf('
                    <div class="row gx-1 justify-content-end flex-nowrap">
                        <div class="col-auto">
                            <a href="%s" class="btn btn-sm btn-secondary rounded-pill px-3">Editar</a>
                        </div>
                    </div>
                ', route('painel.agrupamentos.edit', [$agrupamento]))
            )
            ->rawColumns(['acoes']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Model $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Model $model)
    {
        return $model->withCount('fornecedores')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $className = strtolower((new \ReflectionClass($this))->getShortName());
        return $this->builder()
                    ->setTableId($className . '-table')
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
            Column::make('nome')->title('Nome'),
            Column::make('fornecedores')->title('Total de Fornecedores'),
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
