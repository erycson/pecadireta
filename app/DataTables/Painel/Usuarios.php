<?php

namespace App\DataTables\Painel;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

use App\Models\Usuario as Model;

class Usuarios extends DataTable
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
            ->only(['id', 'fornecedor', 'nome', 'email', 'criado_em', 'acoes'])
            ->editColumn('fornecedor.nome_fantasia', fn ($usuario) => $usuario->fornecedor ? sprintf('<a href="%s">%s</a>', route('painel.fornecedores.edit', [$usuario->fornecedor]), $usuario->fornecedor->nome_fantasia) : '')
            ->editColumn('criado_em', fn ($usuario) => $usuario->criado_em->format('d/m/Y'))
            ->addColumn('acoes', fn ($usuario) => sprintf('
                    <div class="row gx-1 justify-content-end flex-nowrap">
                        <div class="col-auto">
                            <a href="%s" class="btn btn-sm btn-secondary rounded-pill px-3">Editar</a>
                        </div>
                    </div>
                ', route('painel.usuarios.edit', [$usuario]))
            )
            ->rawColumns(['acoes', 'fornecedor.nome_fantasia']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Model $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Model $model)
    {
        return $model->with('fornecedor')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('usuarios-table')
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
            Column::make('fornecedor.nome_fantasia')->title('Fornecedor'),
            Column::make('email')->title('E-mail'),
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
