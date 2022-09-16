@props(['disabled' => false, 'name'])

{!! Form::text($name, null, $attributes->merge(['class' => $errors->has($name) ? 'is-invalid' : ''])->getAttributes()) !!}
