@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
    @foreach($attributes->get('options') as $option)
    <option value="{{ $option['value'] }}">{{ $option['text'] }}</option>
    @endforeach
</select>
