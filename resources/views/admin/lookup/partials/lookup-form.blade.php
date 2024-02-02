<section>
    <header>
        <h2>{{ __('Enter Game Name') }}</h2>
    </header>

    <form method="post" action="{{ route('lookup.search') }}">
        @csrf
        <div>
            <x-input-label for="search" :value="__('Game Name')" class="sr-only" />
            <x-text-input :value="empty(session('search')) ? old('search') : session('search')" required id="search" name="search" type="text" />
            <x-input-error :messages="$errors->get('search')" />
        </div>

        <div class="btn-container">
            <x-primary-button>{{ __('Search') }}</x-primary-button>
        </div>
    </form>
</section>