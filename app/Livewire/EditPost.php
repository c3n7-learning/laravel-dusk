<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class EditPost extends Component
{
    public ?string $title;
    public ?string $content;
    public ?Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
    }
    public array $rules = [
        'title' => 'required|string',
        'content' => 'required|string',
    ];

    public function render()
    {
        return view('livewire.edit-post');
    }

    public function submit()
    {
        $this->validate();

        $this->post->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        return redirect()->route('post.index')->with('success_message', 'Post was successfully created.');
    }
}
