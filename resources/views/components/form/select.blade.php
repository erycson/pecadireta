@props(['disabled' => false, 'name', 'list'])

{!! Form::select($name, $list, old($name), $attributes->merge(['class' => $errors->has($name) ? 'is-invalid' : ''])->getAttributes()) !!}
