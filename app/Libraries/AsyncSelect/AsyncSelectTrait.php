<?php

namespace App\Libraries\AsyncSelect;

trait AsyncSelectTrait
{
    protected array $asyncSelect = [
        'value' => 'id',
        'label' => 'nome',
    ];

    public function setAsyncSelectOptions(array $data): void
    {
        $this->asyncSelect = $data;
    }

    public function toAsyncSelectValue(): array
    {
        return [
            'value' => $this->attributes[$this->asyncSelect['value']],
            'label' => $this->attributes[$this->asyncSelect['label']],
        ];
    }

    public static function handleAsyncSelectRequest(): \Illuminate\Http\JsonResponse
    {
        $model = (new static);
        $query = $model->withoutGlobalScopes()->select([
            "{$model->asyncSelect['value']} AS value",
            "{$model->asyncSelect['label']} AS label"
        ])->limit(20);

        $request = request();
        if ($request->filled('q')) {
            $query->where($model->asyncSelect['label'], 'LIKE', "%{$request->q}%");
        }

        return response()->json($query->get());
    }
}
