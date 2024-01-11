<section>
    <form method="post" action="{{ !empty($isUpdate) ? route('games.update') : route('games.store') }}" class="mt-6 space-y-6">
        @csrf
        @if(!empty($isUpdate))
        @method('put')
        @endif

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="igdb_id" :value="__('IGDB ID')" />
            <x-text-input id="igdb_id" name="igdb_id" type="number" min="0" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('igdb_id')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="played_years" :value="__('Played Years')" />
            <x-text-input id="played_years" name="played_years" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('played_years')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="comments" :value="__('Comments')" />
            <x-textarea-input id="comments" rows=10 name="comments" class="mt-1 block w-full">
            </x-textarea-input>
            <x-input-error :messages="$errors->get('comments')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 justify-end">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
