<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{
    public ?Post $post;

    public function mount(Post $post)
    {
        $post->load('user');
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.show-post');
    }

    public function delete()
    {
        $this->post->delete();

        return redirect()->route('post.index')->with('success_message', 'Post was successfully deleted.');
    }
}
