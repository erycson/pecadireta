@props(['id' => null, 'name', 'value'])

<?php
$value = old($name) ?? $value ?? '';
if (is_array($value)) {
    if (!empty($value['latitude']) && !empty($value['longitude'])) {
        $value = sprintf('POINT(%f %f)', $value['longitude'], $value['latitude']);
    } elseif (!empty($value['latitude']) && empty($value['longitude'])) {
        $value = sprintf('POINT(%f 0)', $value['longitude']);
    } elseif (empty($value['latitude']) && !empty($value['longitude'])) {
        $value = sprintf('POINT(0 %f)', $value['longitude']);
    }  else {
        $value = '';
    }
}
?>

<div {!! $attributes->merge([
    'class' => $errors->has($name) ? 'is-invalid' : '',
    'id' => $id ?? $name,
    'data-name' => $name,
    'data-value' => $value
])->toHtml()!!}></div>
