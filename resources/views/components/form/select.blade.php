@props(['disabled' => false, 'name', 'list', 'valor' => null])

@php ($valor = old($name) ?? $valor)
@if (enum_exists($valor))
    @php ($valor = $valor->value)
@endif

{!! Form::select($name, $list, $valor ?? '', $attributes->merge(['class' => $errors->has($name) ? 'is-invalid' : ''])->getAttributes()) !!}
