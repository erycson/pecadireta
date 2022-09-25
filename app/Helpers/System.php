<?php

use Illuminate\Database\Eloquent\Model;

use App\Models\LogAtividade;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * Função que obtém automaticamente os campos que foram alterados
 *
 * @param Model $model Model aonde foi realizada a alteração
 * @return Closure
 */
function auditor(Model $model = null): Closure
{
    return function (LogAtividade  $activity) use ($model): void {
        // Se não for passado nenhum model, não procurar o q foi alterado,
        // normalmente acontece quando é um delete
        if (is_null($model)) {
            return;
        }

        $properties = [];
        if ($model->wasRecentlyCreated === true) {
            $properties['original'] = $model->getOriginal();
        } else {
            $properties['original'] = $model->getChanges();
            $properties['changes'] = collect($model->getOriginal())
                ->only(array_keys($properties['original']))
                ->all();
        }

        $activity->properties = $properties;
    };
}


/**
 * Função que obtém automaticamente os campos que foram alterados
 *
 * @param Model $model Model aonde foi realizada a alteração
 * @return Closure
 */
function react_model(Model|array $model = [], $except = []): array
{
    if ($model instanceof Model) {
        $model = $model->toArray();
    }

    $request = request();
    if ($request->hasSession()) {
        $oldInput = Arr::except(
            request()->session()->get('_old_input', []),
            array_merge($except, ['_method', '_token'])
        );
    }

    return array_merge($model, $oldInput);
}

/**
 * Função que obtém automaticamente os campos que foram alterados
 *
 * @param Model $model Model aonde foi realizada a alteração
 * @return Closure
 */
function react_error(string $form = 'default'): array
{
    if (!session('errors') || !session('errors')->hasBag($form)) {
        return [];
    }

    $bag = session('errors')->getBag($form);
    return collect($bag->messages())
        ->map(fn ($err) => $err[0])
        ->toArray();
}

/**
 * Função que obtém automaticamente os campos que foram alterados
 *
 * @param Model $model Model aonde foi realizada a alteração
 * @return Closure
 */
function fmt_money(float $value): string
{
    return number_format($value, 2, ',', '.');
}

/**
 * Função que obtém automaticamente os campos que foram alterados
 *
 * @param Model $model Model aonde foi realizada a alteração
 * @return Closure
 */
function fmt_percentage(float|int $value, int $deciamls = 0): string
{
    return number_format($value * 100, $deciamls);
}
