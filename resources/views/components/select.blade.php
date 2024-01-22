@props(['disabled' => false])

<select name="{{ $name }}" id="{{ $name }}" {{ $disabled ? 'disabled' : '' }} class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm {{$class}}" ]>
    @foreach($options as $option)
    <option {{ $selected == $option['value'] ? 'selected' :'' }} value="{{ $option['value'] }}">{{ $option['text'] }}</option>
    @endforeach
</select>
