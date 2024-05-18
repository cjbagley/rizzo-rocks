<x-admin-layout :header="$header??''">
    <x-admin-card-holder>
        <div class="card action-card">
            <div>
                {{__('app.tag.index')}}
            </div>
            <div class="btn-container">
                <x-primary-button-link href="{{ route('tags.create') }}">{{__('button.add')}}</x-primary-button-link>
            </div>
        </div>

        @forelse($tags as $tag)
            <x-admin-card>
                <div class="game-info-wrapper">
                    <div class="game-info-details">
                        <h3>{{ $tag->tag }}</h3>
                    </div>
                </div>
                <div class="btn-container">
                    <x-secondary-button-link
                        href="{{ route('tags.edit', $tag) }}">{{__('button.edit')}}</x-secondary-button-link>
                    <x-danger-button x-data=""
                                     x-on:click.prevent="$dispatch('open-modal', 'confirm-tag-deletion-{{$tag->slug}}')"
                    >{{ __('button.delete') }}</x-danger-button>
                </div>
                <x-modal name="confirm-tag-deletion-{{$tag->slug}}" :show="$errors->tagDeletion->isNotEmpty()"
                         focusable>
                    <form method="post" action="{{ route('tags.destroy', $tag) }}">
                        @csrf
                        @method('delete')

                        <h2>{{ __('Are you sure you want to delete this tag?') }}</h2>

                        <div class="btn-container">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('button.cancel') }}
                            </x-secondary-button>

                            <x-danger-button>
                                {{ __('button.delete') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            </x-admin-card>
        @empty
            <x-admin-card>
                {{__('app.tag.empty')}}
            </x-admin-card>
        @endforelse
    </x-admin-card-holder>
</x-admin-layout>
