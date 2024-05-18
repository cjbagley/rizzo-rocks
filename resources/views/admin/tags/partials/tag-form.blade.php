<section>
    <form method="post" action="{{ $form_route }}">
        @csrf
        @if(!empty($is_update))
            @method('put')
        @endif

        <div>
            <x-input-label for="tag" :value="__('tag')"/>
            <x-text-input id="tag" :value="$tag" name="tag"/>
            <x-input-error :messages="$errors->get('tag')"/>
        </div>

        <div>
            <x-input-label for="colour" :value="__('colour')"/>
            <x-colour-input id="colour" :value="$colour" name="colour"/>
            <x-input-error :messages="$errors->get('colour')"/>
        </div>
        <div class="flex">
            <x-input-label for="is_sensitive" :value="__('is_sensitive')"/>
            <x-checkbox-input id="is_sensitive" :value="$is_sensitive" name="is_sensitive"/>
            <x-input-error :messages="$errors->get('is_sensitive')"/>
        </div>

        <div class="btn-container">
            <x-primary-button>{{ __('button.save') }}</x-primary-button>
        </div>
    </form>
</section>
