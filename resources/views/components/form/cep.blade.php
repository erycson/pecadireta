@props(['id' => null, 'name', 'value'])

<div {!! $attributes->merge([
    'class' => $errors->has($name) ? 'is-invalid' : '',
    'id' => $id ?? $name,
    'data-name' => $name,
    'data-value' => old($name) ?? $value ?? ''
])->toHtml()!!}></div>
