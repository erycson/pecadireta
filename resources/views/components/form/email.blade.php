@props(['disabled' => false, 'name'])

{!! Form::email($name, null, $attributes->merge(['class' => $errors->has($name) ? 'is-invalid' : ''])->getAttributes()) !!}
