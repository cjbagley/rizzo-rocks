@props(['disabled' => false])

<input type="hidden" value="0" {!! $attributes->merge(['class' => '']) !!}>
<input type="checkbox" value="1"
       @if($attributes->get('value') ??false) checked @endif {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => '']) !!}>
