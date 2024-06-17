<section>
    <form method="post" action="{{ $form_route }}">
        @csrf
        @if(!empty($is_update))
            @method('put')
        @endif

        <div>
            <x-input-label for="title" :value="__('Title')"/>
            <x-text-input id="title" :value="$title" name="title" type="text"/>
            <x-input-error :messages="$errors->get('title')"/>
        </div>

        <div class="flex">
            <x-input-label for="is_sensitive" :value="__('is_sensitive')"/>
            <x-checkbox-input id="is_sensitive" :value="$is_sensitive" name="is_sensitive"/>
            <x-input-error :messages="$errors->get('is_sensitive')"/>
        </div>

        <div>
            <x-input-label for="igdb_id" :value="__('IGDB ID')"/>
            <x-text-input id="igdb_id" :value="$igdb_id" name="igdb_id" type="number" min="0"/>
            <x-input-error :messages="$errors->get('igdb_id')"/>
        </div>

        <div>
            <x-input-label for="igdb_cover_id" :value="__('igdb_cover_id')"/>
            <x-text-input id="igdb_cover_id" :value="$igdb_cover_id" name="igdb_cover_id" type="text"/>
            <x-input-error :messages="$errors->get('igdb_cover_id')"/>
        </div>

        <div>
            <x-input-label for="igdb_url" :value="__('igdb_url')"/>
            <x-text-input id="igdb_url" :value="$igdb_url" name="igdb_url" type="text"/>
            <x-input-error :messages="$errors->get('igdb_url')"/>
        </div>

        <div>
            <x-input-label for="played_years" :value="__('Played Years')"/>
            <x-text-input id="played_years" :value="$played_years" name="played_years" type="text"/>
            <x-input-error :messages="$errors->get('played_years')"/>
        </div>

        <div>
            <x-input-label for="comments" :value="__('Comments')"/>
            <x-textarea-input id="comments" rows="5" name="comments">{{ $comments }}</x-textarea-input>
            <x-input-error :messages="$errors->get('comments')"/>
        </div>

        <div class="btn-container">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
