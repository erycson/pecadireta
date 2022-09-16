@props(['disabled' => false, 'name'])

{!! Form::file($name, $attributes->merge(['class' => $errors->has($name) ? 'is-invalid' : ''])->getAttributes()) !!}
