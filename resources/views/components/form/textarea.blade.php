@props(['disabled' => false, 'name'])

{!! Form::textarea($name, null, $attributes->merge(['class' => $errors->has($name) ? 'is-invalid' : ''])->getAttributes()) !!}
