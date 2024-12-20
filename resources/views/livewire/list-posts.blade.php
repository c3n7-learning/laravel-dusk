<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12 text-gray-900 dark:text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if (session('success_message'))
                    <div class="p-6 mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ session('success_message') }}
                    </div>
                @endif

                <ul class="px-10 p-6 text-gray-900 dark:text-gray-100">
                    @forelse ($posts as $post)
                        <li class="list-disc">
                            <a class="underline" href="{{ route('post.show', $post) }}"
                                wire:navigate>{{ $post->title }}</a>
                            <span class="font-bold italic"> by {{ $post->user->name }}</span>
                        </li>
                    @empty
                        <li>No posts found</li>
                    @endforelse
                </ul>

                @auth
                    <div class="px-6 mt-4">
                        <a href="{{ route('post.create') }}" wire:navigate>
                            <x-primary-button>
                                {{ __('Create Post') }}
                            </x-primary-button>
                        </a>
                    </div>
                @endauth

                <div class="px-6 my-5" x-data="{
                    dadJoke: null
                }">
                    <x-primary-button class="mt-3" dusk="dad-joke"
                        x-on:click="
                            console.log('Hallo');
                            axios.get('https://api.chucknorris.io/jokes/random', {
                                headers: {
                                    'Accept': 'application/json'
                                }
                            })
                                .then(response => {
                                    setTimeout(() => {
                                        console.log(response.data);
                                        dadJoke = response.data.value
                                    }, 1000)
                                })
                        ">
                        Get Dad Joke
                    </x-primary-button>

                    <div class="text-gray-900 dark:text-gray-100">
                        <p id="dadJokeContainer" class="p-6" x-show="dadJoke" x-text="dadJoke"></p>
                    </div>
                </div>

                <hr>

                <div class="px-6 my-5 text-gray-900 dark:text-gray-100" x-data="{
                    isVisible: false
                }">

                    <x-primary-button class="mt-3" x-on:dblclick="isVisible = !isVisible" dusk="double-click">
                        Double click me
                    </x-primary-button>

                    <div class="text-gray-900 dark:text-gray-100 mt-3" x-show="isVisible">
                        Double clicked!
                    </div>
                </div>

                <hr>

                <div class="p-6" x-data="{
                    isVisible: false
                }">

                    <x-primary-button class="mt-3" dusk="right-click"
                        x-on:contextmenu.prevent="isVisible = !isVisible">
                        Right click me
                    </x-primary-button>

                    <div class="text-gray-900 dark:text-gray-100 mt-3" x-show="isVisible">
                        Right clicked!
                    </div>
                </div>

                <hr>

                <div class="p-6 my-5" x-data="{
                    isVisible: false
                }">

                    <x-text-input dusk="multiple-keys" type="text"
                        x-on:keydown="
                            if (event.ctrlKey && event.which === 66) {
                                isVisible = !isVisible
                            }
                        " />
                    <div x-show="isVisible" class="mt-4">
                        Ctrl + B pressed
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
