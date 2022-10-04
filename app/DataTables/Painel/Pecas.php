<?php

namespace App\DataTables\Painel;

use App\Models\Peca as Model;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class Pecas extends DataTable
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
            ->editColumn('fornecedor.nome_fantasia', fn ($peca) => sprintf('<a href="%s">%s</a>', route('painel.fornecedores.edit', [$peca->fornecedor]), $peca->fornecedor->nome_fantasia))
            ->editColumn('marca.nome', fn ($peca) => sprintf('<a href="%s">%s</a>', route('painel.marcas.edit', [$peca->marca]), $peca->marca->nome))
            ->editColumn('preco', fn ($peca) => 'R$ ' . fmt_money($peca->preco))
            ->addColumn('acoes', fn ($peca) => sprintf('
                    <div class="row gx-1 justify-content-end flex-nowrap">
                        <div class="col-auto">
                            <a href="%s" class="btn btn-sm btn-secondary rounded-pill px-3">Editar</a>
                        </div>
                    </div>
                ', route('painel.pecas.edit', [$peca]))
            )
            ->rawColumns(['fornecedor.nome_fantasia', 'marca.nome', 'acoes']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Model $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Model $model)
    {
        return $model->newQuery()->with(['marca', 'fornecedor']);
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
                    ->orderBy(4, 'asc');
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
            Column::make('fornecedor.nome_fantasia')->title('Fornecedor'),
            Column::make('marca.nome')->title('Marca'),
            Column::make('sku')->title('SKU'),
            Column::make('nome')->title('Nome'),
            Column::make('preco')->title('Preço'),
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
