<x-card>
    <h2 class="text-lg mb-2">Create Post</h2>
    <form wire:submit="submit">
        <!-- Title -->
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model="title" id="title" class="block mt-1 w-full" type="text" name="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Content -->
        <div class="mt-2">
            <x-input-label for="content" :value="__('Content')" />
            <x-text-input wire:model="content" id="content" class="block mt-1 w-full" type="text" name="content" />
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>

        <x-primary-button class="mt-3" dusk="create-post">
            {{ __('Save') }}
        </x-primary-button>
    </form>
</x-card>
