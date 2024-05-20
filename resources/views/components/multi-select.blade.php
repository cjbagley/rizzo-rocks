@props(['disabled' => false])

<select name="{{ $name }}[]" id="{{ $name }}" {{ $disabled ? 'disabled' : '' }} class="{{$class}}" multiple>
    @foreach($options as $option)
        <option
            {{ in_array($option['value'], $selected) ? 'selected' : '' }} value="{{ $option['value'] }}">{{ $option['text'] }}</option>
    @endforeach
</select>
