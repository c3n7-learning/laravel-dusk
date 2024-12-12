<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    public ?string $title;
    public ?string $content;

    public array $rules = [
        'title' => 'required|string',
        'content' => 'required|string',
    ];

    public function render()
    {
        return view('livewire.create-post');
    }

    public function submit()
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('post.index')->with('success_message', 'Post was successfully created.');
    }
}
