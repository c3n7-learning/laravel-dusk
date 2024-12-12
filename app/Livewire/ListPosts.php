<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class ListPosts extends Component
{
    public function render()
    {
        $posts = Post::all();

        return view('livewire.list-posts', compact('posts'));
    }
}
