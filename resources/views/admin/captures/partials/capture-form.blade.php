<section>
    <form method="post" action="{{ $form_route }}" class="mt-6 space-y-6">
        @csrf
        @if(!empty($is_update))
        @method('put')
        @endif

        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input id="title" :value="$title" name="title" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="href" :value="__('Href')" />
            <x-text-input id="href" :value="$href" name="href" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('href')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="type" :value="__('Type')" />
            <x-select-input id="type" :options="$types" :value="$type" name="type" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="comments" :value="__('Comments')" />
            <x-textarea-input id="comments" rows="10" name="comments" class="mt-1 block w-full">{{ $comments }}</x-textarea-input>
            <x-input-error :messages="$errors->get('comments')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 justify-end">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
