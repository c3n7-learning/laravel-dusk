<x-card>
    <section class="flex flex-col gap-2">
        <div class="font-bold">
            <a href="{{ route('post.edit', $post) }}" wire:navigate>
                {{ $post->title }}
            </a>
        </div>
        <div class="">
            {{ $post->content }}
        </div>
        <div class="italic text-xs">
            {{ $post->user->name }} - {{ $post->created_at->toDayDateTimeString() }}
        </div>

        <div class="flex gap-2">
            <a href="{{ route('post.edit', $post) }}" wire:navigate>
                <x-primary-button>
                    {{ __('Edit Post') }}
                </x-primary-button>

                <x-danger-button wire:click='delete' dusk="delete-post">
                    {{ __('Delete Post') }}
                </x-danger-button>
            </a>
        </div>
    </section>
</x-card>
