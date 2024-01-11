<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Enter Game Name') }}
        </h2>
    </header>

    <form method="post" action="{{ route('lookup.search') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="search" :value="__('Game Name')" class="sr-only" />
            <x-text-input :value="old('search')" required id="search" name="search" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('search')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 justify-end">
            <x-primary-button>{{ __('Search') }}</x-primary-button>
        </div>
    </form>
</section>
