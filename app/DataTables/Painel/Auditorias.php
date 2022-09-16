<?php

namespace App\DataTables\Painel;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

use App\Models\LogAtividade as Model;

class Auditorias extends DataTable
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
            ->editColumn('created_at', fn ($auditoria) => $auditoria->updated_at->format('d/m/Y'))
            ->editColumn('causer_type', fn ($auditoria) => $this->getTipoModel($auditoria->causer))
            ->editColumn('subject_type', fn ($auditoria) => $this->getTipoModel($auditoria->subject));
    }

    protected function getTipoModel(?object $model): string
    {
        return match (!is_null($model) ? get_class($model) : null) {
            \App\Models\Usuario::class    => 'Usuário',
            \App\Models\Fornecedor::class => 'Fornecedor',
            \App\Models\FornecedorTipo::class => 'Tipo de Fornecedor',
            \App\Models\Agrupamento::class => 'Agrupamento',
            default => ''
        };
    }

    /**
     * Get query source of dataTable.
     *
     * @param Model $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Model $model)
    {
        return $model->newQuery();
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
                    ->orderBy(0, 'desc');
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
            Column::make('description')->title('Mensagem'),
            Column::make('causer_type')->title('Tipo Causador'),
            Column::make('causer_id')->title('ID Causador'),
            Column::make('event')->title('Evento'),
            Column::make('subject_type')->title('Tipo Sujeito'),
            Column::make('subject_id')->title('ID Sujeito'),
            Column::make('created_at')->title('Criado em'),
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
