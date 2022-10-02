<?php

namespace App\DataTables\Website;

use App\Models\Fornecedor;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

use App\Models\Peca as Model;

class Procurar extends DataTable
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
            ->editColumn('fornecedor.nome', fn ($peca) => sprintf('
                <a href="%s" class="fw-bold link-dark stretched-link d-block">%s</a>
                %s, %s - %s
            ', '#', $peca->fornecedor->nome_fantasia, $peca->fornecedor->cep->bairro, $peca->fornecedor->cep->municipio, $peca->fornecedor->cep->uf))
            ->editColumn('nome', fn ($peca) => sprintf('<strong class="d-block">%s</strong> %s', $peca->sku, $peca->nome))
            ->editColumn('preco', fn ($peca) => $this->getPrecoContents($peca))
            ->editColumn('estoque', fn ($peca) => fmt_integer($peca->estoque))
            ->editColumn('tipo_peca', fn ($peca) => $peca->tipo_peca->label())
            ->editColumn('fornecedor.estoque_atualizado_em', fn ($peca) => sprintf('
                %s
                <span class="%s d-flex align-items-center">
                    <i class="bx bx-info-circle bx-xs me-1"></i>
                    %s
                </span>
            ', $peca->fornecedor->estoque_atualizado_em->format('d/m/Y'), $peca->fornecedor->atualizacaoCss, $peca->fornecedor->atualizacaoLabel))
            ->addColumn('contato', fn ($peca) => $this->getContatoContents($peca->fornecedor))
            ->rawColumns([
                'contato',
                'preco',
                'fornecedor.nome',
                'nome',
                'fornecedor.estoque_atualizado_em'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Model $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Model $model)
    {
        return $model->newQuery()
            ->with([
                'fornecedor' => fn($query) => $query->whereNotNull('estoque_atualizado_em'),
                'fornecedor.cep',
                'fornecedor.contatos'
            ]);
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
                    ->parameters([
                        'searching' => false,
                        'lengthChange' => false,
                        'responsive' => false,
                        'paging' => true,
                        'info' => false,
                        'drawCallback' => $this->onDrawCallback(),
                        'initComplete' => $this->initComplete()
                    ])
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
            Column::make('fornecedor.nome_fantasia')->addClass('fw-normal pe-1')->title($this->getFornecedorTitle())->titleAttr('Fornecedor'),
            Column::make('nome')->addClass('fw-normal pe-1')->title($this->getNomeTitle())->titleAttr('Código / Descrição'),
            Column::make('tipo_peca')->addClass('fw-normal pe-1')->title($this->getTipoTitle())->titleAttr('Tipo'),
            Column::make('estoque')->addClass('fw-normal pe-1')->title($this->getEstoqueTitle())->titleAttr('Estoque'),
            Column::make('preco')->addClass('fw-normal pe-1')->title($this->getPrecoTitle())->titleAttr('Preço'),
            Column::make('fornecedor.estoque_atualizado_em')->addClass('fw-normal pe-1')->title($this->getAtualizacaoTitle())->titleAttr('Atualização'),
            Column::computed('contato')
                ->addClass('fw-normal px-0')
                ->title($this->getContatoTitle())
                ->sortable(false)
                ->titleAttr('Contato'),
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

    protected function getFornecedorTitle(): string
    {
        return <<<HTML
            <div class="row gx-1 flex-nowrap">
                <div class="col">
                    <div class="dropdown px-0">
                        <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                            Fornecedor
                        </button>
                        <div class="dropdown-menu py-2 px-3 fw-normal border-light shadow-sm" data-popper-placement="bottom-start">
                            <form class="row flex-column">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked="">
                                        <label class="form-check-label small" for="flexRadioDefault1">
                                            Todos
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label small" for="flexRadioDefault1">
                                            Concessionária
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label small" for="flexRadioDefault1">
                                            Autopeça
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button">
                        A / Z
                    </button>
                </div>
            </div>
        HTML;
    }

    protected function getNomeTitle(): string
    {
        return <<<HTML
            <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button">
                Código / Descrição
            </button>
        HTML;
    }

    protected function getTipoTitle(): string
    {
        return <<<HTML
            <div class="dropdown px-0">
                <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                    Tipo
                </button>
                <div class="dropdown-menu py-2 px-3 fw-normal border-light shadow-sm" data-popper-placement="bottom-start">
                    <form class="row flex-column">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked="">
                                <label class="form-check-label small" for="flexRadioDefault1">
                                    Todos
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label small" for="flexRadioDefault1">
                                    Genuína
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label small" for="flexRadioDefault1">
                                    Alternativa
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label small" for="flexRadioDefault1">
                                    Reuso
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        HTML;
    }

    protected function getEstoqueTitle(): string
    {
        return <<<HTML
            <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button">
                Estoque
            </button>
        HTML;
    }

    protected function getPrecoTitle(): string
    {
        return <<<HTML
            <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button">
                Preço
            </button>
        HTML;
    }

    protected function getAtualizacaoTitle(): string
    {
        return <<<HTML
            <div class="dropdown px-0">
                <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                    Atualização
                </button>
                <div class="dropdown-menu py-2 px-3 fw-normal border-light shadow-sm" data-popper-placement="bottom-start">
                    <form class="row flex-column">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                <label class="form-check-label small" for="flexRadioDefault1">
                                    Todos
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label small text-success" for="flexRadioDefault1">
                                    Atualizada
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label small text-warning" for="flexRadioDefault1">
                                    Vencendo
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label small text-danger" for="flexRadioDefault1">
                                    Desatualizada
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        HTML;
    }

    protected function getContatoTitle(): string
    {
        return <<<HTML
            <span class="btn btn-sm btn-dark d-flex justify-content-center align-items-center w-100" role="none">Contato</span>
        HTML;
    }

    protected function getPrecoContents(Model $peca): string
    {
        $preço = fmt_money($peca->preco);

        return <<<HTML
            R$ {$preço}
            <span class="d-flex align-items-center">
                <i class="bx bx-timer bx-xs me-1"></i>
                Obsoleta
            </span>
        HTML;
    }

    protected function getContatoContents(Fornecedor $fornecedor): string
    {
        if ($fornecedor->contatos->isEmpty()) {
            return '';
        }

        $contatos = $fornecedor->contatos->map(fn ($contato) => <<<HTML
            <div class="col">
                <a href="#" class="btn btn-sm {$contato->iconeCor} d-inline-flex justify-content-center align-items-center w-100 text-nowrap">
                    <i class="bx {$contato->iconeCss} bx-xs me-1"></i>
                    {$contato->contato}
                </a>
            </div>
        HTML)->join('');

        return <<<HTML
            <div class="row gy-1 flex-column">
                {$contatos}
            </div>
        HTML;
    }

    protected function onDrawCallback(): string
    {
        return <<<JS
            function () {
                const el = $(this);
                el.find('th i').remove();

                el.find('th.sorting_asc button:last-child').append('<i class="bx bx-up-arrow-alt bx-xs ms-1"></i>');
                el.find('th.sorting_desc button:last-child').append('<i class="bx bx-down-arrow-alt bx-xs ms-1"></i>');
            }
        JS;
    }
    protected function initComplete(): string
    {
        return <<<JS
            function () {
                const el = $(this);
                const table = el.DataTable();


                el.find('th:nth-child(1)').unbind(); // Fornecedor
                el.find('th:nth-child(3)').unbind(); // Tipo
                el.find('th:nth-child(6)').unbind(); // Atualização

                el.find('th:nth-child(1) button:last').on('click', function() {
                    const order = $(this).find('i').hasClass('bx-up-arrow-alt') ? 'desc' : 'asc';
                    table.order([[0, order]]).draw();
                });

            }
        JS;
    }
}
