<?php

namespace Tests\Browser;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PostTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_can_view_index_of_posts()
    {
        $this->browse(function (Browser $browser) {

            User::factory(2)->create();

            $postA = Post::factory()->create();
            $postB = Post::factory()->create();

            $browser->visit('/')
                ->assertSee('Posts')
                ->assertSee($postA->title)
                ->assertSee('by ' . $postA->user->name)
                ->assertSee($postB->title)
                ->assertSee('by ' . $postB->user->name)
            ;
        });
    }

    public function test_can_view_a_single_post()
    {
        $this->browse(function (Browser $browser) {

            User::factory(1)->create();

            $post = Post::factory()->create();

            $browser->visit(route('post.show', $post))
                ->assertSee('Post')
                ->assertSee($post->title)
                ->assertSee($post->content)
                ->assertSee($post->user->name . ' - ');
        });
    }

    public function test_can_create_a_post()
    {
        $this->browse(function (Browser $browser) {

            User::factory(1)->create();

            $browser->loginAs(User::first())
                ->visit(route('post.index'))
                ->clickLink('Create Post')
                ->waitForText('Create Post', 5)
                ->assertSee('Create Post')
                ->type('title', 'My first post')
                ->type('content', 'My first post content')
                // ->click('button[type="submit"]')
                ->click('@create-post')
                ->waitForText('Post was successfully created.', 5)
                ->assertSee('My first post')
                ->assertPathIs('/');
        });
    }

    public function test_can_edit_a_post()
    {
        $this->browse(function (Browser $browser) {

            User::factory(1)->create();
            $post = Post::factory()->create();

            $browser->loginAs(User::first())
                ->visit(route('post.index'))
                ->clickLink($post->title)
                ->waitForText('EDIT POST', 5)
                ->clickLink($post->title)
                ->waitForText('Edit Post', 5)
                ->type('title', 'My first post')
                ->type('content', 'My first post content')
                ->click('@edit-post')
                ->waitForText('Post was successfully edited.', 5)
                ->assertSee('My first post')
                ->assertPathIs('/')
            ;
        });
    }

    public function test_can_delete_a_post()
    {
        $this->browse(function (Browser $browser) {

            User::factory(1)->create();
            $post = Post::factory()->create();

            $browser->loginAs(User::first())
                ->visit(route('post.index'))
                ->clickLink($post->title)
                ->waitForText('DELETE POST', 5)
                ->click('@delete-post')
                ->waitForText('Post was successfully deleted.', 5)
                ->assertDontSee($post->title)
                ->assertPathIs('/')
            ;
        });
    }
}
