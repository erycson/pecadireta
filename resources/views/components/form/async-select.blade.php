@props(['id' => null, 'name', 'model', 'route'])

<div data-value='@json($model?->toAsyncSelectValue())' {!! $attributes->merge([
    'class' => $errors->has($name) ? 'is-invalid' : '',
    'id' => $id ?? $name,
    'data-name' => $name,
    'data-url' => route($route),
])->toHtml()!!}></div>
