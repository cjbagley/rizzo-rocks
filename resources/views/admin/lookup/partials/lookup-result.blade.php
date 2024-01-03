@forelse(session('data') as $data)
@if(!empty($data))
<x-admin-card>

    <div class="flex flex-col items-start md:flex-row hover:bg-gray-100">
        @if(!empty($data['cover']['url']))
        <img width="160" src="{{ 'https:' . $data['cover']['url'] }}" alt="">
        @endif
        @if(!empty($data['name']))
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $data['name'] }}</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Details here...</p>
        </div>
        @endif
    </div>

</x-admin-card>
@endif
@empty

<x-admin-card>
    No results found
</x-admin-card>
@endforelse
