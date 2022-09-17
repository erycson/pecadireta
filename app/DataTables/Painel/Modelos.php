<?php

namespace App\DataTables\Painel;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

use App\Models\Modelo as Model;

class Modelos extends DataTable
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
                'modelos.id',
                'modelos.montadora_id',
                'modelos.nome',
            ]))
            ->only([
                'id',
                'montadora',
                'montadora_id',
                'nome',
                'acoes',
            ])
            ->editColumn('montadora.nome', fn ($modelo) => sprintf('<a href="%s">%s</a>', route('painel.montadoras.edit', [$modelo->montadora]), $modelo->montadora->nome))
            ->addColumn('acoes', fn ($modelo) => sprintf('
                    <div class="row gx-1 justify-content-end flex-nowrap">
                        <div class="col-auto">
                            <a href="%s" class="btn btn-sm btn-secondary rounded-pill px-3">Editar</a>
                        </div>
                    </div>
                ', route('painel.modelos.edit', [$modelo]))
            )
            ->rawColumns(['acoes', 'montadora.nome']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Model $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Model $model)
    {
        return $model->with('montadora')->newQuery()->has('montadora');
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
                    ->parameters(['responsive' => true])
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
            Column::make('montadora.nome')->title('Montadora'),
            Column::make('nome')->title('Nome'),
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
