<x-card>
    <section class="flex flex-col gap-2">
        <div class="font-bold">
            {{ $post->title }}
        </div>
        <div class="">
            {{ $post->content }}
        </div>
        <div class="italic text-xs">
            {{ $post->user->name }} - {{ $post->created_at->toDayDateTimeString() }}
        </div>

        <a href="{{ route('post.edit', $post) }}" wire:navigate>
            <x-primary-button>
                {{ __('Edit Post') }}
            </x-primary-button>
        </a>
    </section>
</x-card>
