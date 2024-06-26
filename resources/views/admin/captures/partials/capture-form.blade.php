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

        <div>
            <x-input-label for="filekey" :value="__('Filekey')"/>
            <x-text-input id="filekey" :value="$filekey" name="filekey" type="text"/>
            <x-input-error :messages="$errors->get('filekey')"/>
        </div>

        <div>
            <x-input-label for="type" :value="__('Type')"/>
            <x-select :options="$types" :selected="$type" name="type"/>
            <x-input-error :messages="$errors->get('type')"/>
        </div>

        <div>
            <x-input-label for="comments" :value="__('Comments')"/>
            <x-textarea-input id="comments" rows="5" name="comments">{{ $comments }}</x-textarea-input>
            <x-input-error :messages="$errors->get('comments')"/>
        </div>

        <div>
            <x-input-label for="tags" :value="__('Tags')"/>
            <x-multi-select :options="$tags" :selected="$tags_selected" class="select" name="tags"/>
            <x-input-error :messages="$errors->get('tags')"/>
        </div>

        <div class="btn-container">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
