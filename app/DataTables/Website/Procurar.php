<?php

namespace App\DataTables\Website;

use App\DataTables\Painel\FornecedoresTipos;
use App\Libraries\DataTables\ScoutDataTable;
use App\Models\Fornecedor;
use App\Models\FornecedorTipo;
use App\Models\Peca as Model;
use MeiliSearch\Endpoints\Indexes;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class Procurar extends DataTable
{
    protected int $pageLength = 10;
    protected ScoutDataTable $scout;

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->scout = new ScoutDataTable(new Model, $query, $this->getScoutOptions());

        return ($this->scout)
            ->setRowClass('position-relative')
            ->editColumn('fornecedor_nome', fn ($peca) => sprintf('
                <a href="%s" target="_blank" class="fw-bold link-dark stretched-link d-block">%s</a>
                %s, %s - %s
            ', $peca->url, $peca->fornecedor->nome_fantasia, $peca->fornecedor->cep->bairro, $peca->fornecedor->cep->municipio, $peca->fornecedor->cep->uf))
            ->editColumn('nome', fn ($peca) => sprintf('<strong class="d-block">%s</strong> %s', $peca->sku, $peca->nome))
            ->editColumn('preco', fn ($peca) => $this->getPrecoContents($peca))
            ->editColumn('estoque', fn ($peca) => fmt_integer($peca->estoque))
            ->editColumn('tipo_peca', fn ($peca) => $peca->tipo_peca->label())
            ->editColumn('atualizado_em', fn ($peca) =>
                $peca->fornecedor->estoque_atualizado_em
                    ? sprintf('
                        %s
                        <span class="%s d-flex align-items-center">
                            <i class="bx bx-info-circle bx-xs me-1"></i>
                            %s
                        </span>
                    ', $peca->fornecedor->estoque_atualizado_em->format('d/m/Y'), $peca->fornecedor->atualizacaoCss, $peca->fornecedor->atualizacaoLabel)
                    : ''
            )
            ->addColumn('contato', fn ($peca) => $this->getContatoContents($peca->fornecedor))
            ->rawColumns([
                'contato',
                'preco',
                'fornecedor_nome',
                'nome',
                'atualizado_em'
            ]);
    }

    protected function getScoutOptions()
    {
        return function (Indexes $meilisearch, $query, $options) {
            $filtros = collect($this->scout->getFilters())
                ->only([
                    'tipos_veiculos',
                    'montadoras',
                    'modelos',
                    'atualizado_dias',

                    'uf',
                    'municipio',
                    'cep',

                    'fornecedor_tipo',
                    'tipo_peca',
                ])
                ->map(function ($valor, $filtro) {
                    if ($filtro == 'atualizado_dias') {
                        return match ($valor) {
                            'todos'         => null,
                            'atualizada'    => '(atualizado_dias = 0 OR atualizado_dias = 1)',
                            'vencendo'      => '(atualizado_dias = 2 OR atualizado_dias = 3)',
                            'desatualziada' => 'atualizado_dias > 4',
                        };
                    } elseif ($filtro == 'cep') {
                        $valor = str_pad(preg_replace('/[^0-9]+/', '', $valor), 8, '0', STR_PAD_LEFT);
                        return sprintf("%s = '%s'", $filtro, $valor);
                    } else {
                        return sprintf("%s = '%s'", $filtro, $valor);
                    }
                })
                ->filter()
                ->join(' AND ');

            $options['sort'] = $this->scout->getSort();
            $options['filter'] = $filtros;
            $options['limit'] = $this->pageLength;
            return $meilisearch->search($query ?? '', $options);
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
                    ->minifiedAjax(ajaxParameters: ['data' => $this->getAjaxParams()])
                    ->parameters([
                        'searching' => false,
                        'lengthChange' => false,
                        'responsive' => false,
                        'pageLength' => $this->pageLength,
                        'paging' => true,
                        'info' => false,
                        'drawCallback' => $this->onDrawCallback(),
                        'initComplete' => $this->initComplete()
                    ])
                    ->orderBy(4, 'asc');
    }

    protected function getAjaxParams(): string
    {
        return <<<JS
            function (data) {
                const {q, ...filtros} = FILTROS;
                data.search.value = q || '';
                data.filtros = filtros;
            }
        JS;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('fornecedor_nome')->addClass('ps-lg-3')->title($this->getFornecedorTitle())->titleAttr('Fornecedor'),
            Column::make('nome')->title($this->getNomeTitle())->titleAttr('Código / Descrição'),
            Column::make('tipo_peca')->addClass('text-nowrap')->title($this->getTipoTitle())->titleAttr('Tipo'),
            Column::make('estoque')->title($this->getEstoqueTitle())->titleAttr('Estoque'),
            Column::make('preco')->addClass('text-nowrap')->title($this->getPrecoTitle())->titleAttr('Preço'),
            Column::make('atualizado_em')->addClass('text-nowrap')->title($this->getAtualizacaoTitle())->titleAttr('Atualização'),
            Column::computed('contato')
                ->addClass('position-relative')
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
        $tipos = FornecedorTipo::all()->map(fn($tipo) => <<<HTML
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="fornecedor_tipo" value="{$tipo->id}">
                    <label class="form-check-label small">
                        {$tipo->nome}
                    </label>
                </div>
            </div>
        HTML)->join('');

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
                                        <input class="form-check-input" type="radio" name="fornecedor_tipo" value="">
                                        <label class="form-check-label small">Todos</label>
                                    </div>
                                </div>
                                {$tipos}
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
                                <input class="form-check-input" type="radio" name="tipo_peca" value="todos" checked />
                                <label class="form-check-label small">Todos</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_peca" value="alternativa" />
                                <label class="form-check-label small">Alternativa</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_peca" value="genuina" />
                                <label class="form-check-label small">Genuína</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_peca" value="original" />
                                <label class="form-check-label small">Original</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_peca" value="after" />
                                <label class="form-check-label small">After</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_peca" value="reuso" />
                                <label class="form-check-label small">Reuso</label>
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
                                <input class="form-check-input" type="radio" name="atualizacao" value="todos" checked />
                                <label class="form-check-label small">
                                    Todos
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="atualizacao" value="atualizada" />
                                <label class="form-check-label small text-success">
                                    Atualizada
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="atualizacao" value="vencendo" />
                                <label class="form-check-label small text-warning">
                                    Vencendo
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="atualizacao" value="desatualziada" />
                                <label class="form-check-label small text-danger">
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
        $preço    = fmt_money($peca->preco);
        $absoleta = $peca->absoleta ? '<span class="d-flex align-items-center"><i class="bx bx-timer bx-xs me-1"></i> Obsoleta</span>' : '';

        return <<<HTML
            R$ {$preço}
            {$absoleta}
        HTML;
    }

    protected function getContatoContents(Fornecedor $fornecedor): string
    {
        if ($fornecedor->contatos->isEmpty()) {
            return '';
        }

        $contatos = $fornecedor->contatos->map(fn ($contato) => <<<HTML
            <div class="col">
                <a href="{$contato->uri}" class="btn btn-sm {$contato->iconeCor} d-inline-flex justify-content-center align-items-center w-100 text-nowrap">
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
                TABLE = el.DataTable();

                $('th').attr('aria-label', '').removeClass('ps-lg-3 position-relative text-nowrap');
                $('th:not(:last-child)').addClass('fw-normal pe-1');
                $('th:last-child').addClass('fw-normal px-0');

                $('input[name="atualizacao"]').change(function() {
                    FILTROS.atualizado_dias = $(this).val();
                    TABLE.ajax.reload();
                });

                $('input[name="tipo_peca"]').change(function() {
                    FILTROS.tipo_peca = $(this).val();
                    TABLE.ajax.reload();
                });

                $('input[name="fornecedor_tipo"]').change(function() {
                    FILTROS.fornecedor_tipo = +$(this).val();
                    TABLE.ajax.reload();
                });

                el.find('th:nth-child(1)').unbind(); // Fornecedor
                el.find('th:nth-child(3)').unbind(); // Tipo
                el.find('th:nth-child(6)').unbind(); // Atualização

                el.find('th:nth-child(1) button:last').on('click', function() {
                    const order = $(this).find('i').hasClass('bx-up-arrow-alt') ? 'desc' : 'asc';
                    TABLE.order([[0, order]]).draw();
                });

            }
        JS;
    }
}
