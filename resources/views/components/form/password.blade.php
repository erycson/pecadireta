@props(['disabled' => false, 'name'])

{!! Form::password($name, $attributes->except('value')->merge(['class' => $errors->has($name) ? 'is-invalid' : ''])->getAttributes()) !!}
