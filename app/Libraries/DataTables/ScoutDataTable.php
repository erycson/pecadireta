<?php

namespace App\Libraries\DataTables;

use Yajra\DataTables\DataTableAbstract;
use Laravel\Scout\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class ScoutDataTable extends DataTableAbstract
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var EloquentBuilder
     */
    protected $query;

    /**
     * @var Collection
     */
    protected $collection;

    public array $sort = [];

    /**
     * ScoutDataTable constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model, EloquentBuilder $query = null, $callback = null)
    {
        $this->model   = $model;
        $this->query   = $query;
        $this->request = resolve('datatables.request');
        $this->config  = resolve('datatables.config');
        $this->builder = new Builder($this->model, $this->request->input('search.value', null), $callback);
    }

    /**
     * Get results.
     *
     * @return mixed
     */
    public function results(): \Illuminate\Support\Collection
    {
        // Intentionally left blank.
    }

    /**
     * Count results.
     *
     * @return integer
     */
    public function count(): int
    {
        // Intentionally left blank.
    }

    /**
     * Count total items.
     *
     * @return integer
     */
    public function totalCount(): int
    {
        // Intentionally left blank.
    }

    /**
     * Perform column search.
     *
     * @return void
     */
    public function columnSearch(): void
    {
        // Intentionally left blank.
    }

    /**
     * Perform pagination.
     *
     * @return void
     */
    public function paging(): void
    {
        // Intentionally left blank.
    }

    /**
     * Organizes works.
     *
     * @param bool $mDataSupport
     * @return \Illuminate\Http\JsonResponse
     */
    public function make($mDataSupport = true): \Illuminate\Http\JsonResponse
    {
        try {
            $limit   = $this->request->get('length', 10);
            $start   = $this->request->get('start', 0);
            $page    = ($start / $limit) + 1;

            $this->ordering();
            $results = $this->builder->paginate($limit, 'page', $page);

            $this->totalRecords    = $results->total();
            $this->filteredRecords = $this->totalRecords;

            $processed = $this->processResults($results->items(), $mDataSupport);
            $output    = $this->transform($results, $processed);

            $this->collection = collect($output);

            return $this->render($this->collection->values()->all());
        } catch (\Exception $exception) {
            return $this->errorResponse($exception);
        }
    }

    public function orderBy($column, $direction = 'asc')
    {
        $this->builder->orderBy($column, $direction);
        return $this;
    }

    /**
     * @param string $keyword
     */
    protected function globalSearch($keyword): void
    {
        // Intentionally left blank.
    }

    /**
     * Append debug parameters on output.
     *
     * @param  array $output
     * @return array
     */
    protected function showDebugger(array $output): array
    {
        $output['input'] = $this->request->all();

        return $output;
    }

    /**
     * Resolve callback parameter instance.
     *
     * @return mixed
     */
    protected function resolveCallbackParameter()
    {
        return $this->builder;
    }

    /**
     * Perform default query orderBy clause.
     */
    protected function defaultOrdering(): void
    {
        $criteria = $this->request->orderableColumns();
        if (!empty($criteria)) {
            $this->sort = collect($criteria)
                ->map(fn($orderable) => sprintf(
                    '%s:%s',
                    $this->getColumnName($orderable['column']),
                    $orderable['direction']
                ))
                ->toArray();
        }
    }

    public function getSort(): ?array
    {
        return empty($this->sort) ? null : $this->sort;
    }

    public function getFilters(): array
    {
        return $this->request->input('filtros', []);
    }

    /**
     * Converte os dados da pesquisa em dados do banco de dados a
     * partir da consulta do usuário
     *
     * @param mixed $results
     * @param bool $object
     * @return array
     * @throws InvalidArgumentException
     */
    protected function processResults($results, $object = false): array
    {
        if (count($results) > 0 && !is_null($this->query)) {
            $collection = collect($results);
            $primaryKey = $collection->first()->getScoutKeyName();
            $idsTable = $collection->pluck($primaryKey)->toArray();
            $results    = $this->query
                ->with(array_keys($this->query->getEagerLoads()))
                ->find($idsTable)
                // Mantem a ordem vinda do resultado da busca
                ->sortBy(fn ($model) => array_search($model->getKey(), $idsTable))
                ->all();
        }

        return parent::processResults($results, $object);
    }
}
