@props(['name', 'min' => 1, 'step' => 1])

{!! Form::number($name, old($name), $attributes->merge(['class' => $errors->has($name) ? 'is-invalid' : '', 'min' => $min, 'step' => $step])->getAttributes()) !!}
