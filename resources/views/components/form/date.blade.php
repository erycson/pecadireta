@props(['name'])

{!! Form::date($name, null, $attributes->merge(['class' => $errors->has($name) ? 'is-invalid' : ''])->getAttributes()) !!}
