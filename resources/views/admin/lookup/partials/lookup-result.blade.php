@foreach(session('data') as $data)
@if(!empty($data))
<x-admin-card>
    @if(!empty($data['name']))
    <p>{{ $data['name'] }}</p>
    @endif

    @if(!empty($data['cover']['url']))
    <img src="{{ 'https:' . $data['cover']['url'] }}">
    @endif
</x-admin-card>
@endif
@endforeach
