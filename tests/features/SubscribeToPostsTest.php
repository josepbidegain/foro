<?php

use App\User;

class SubscribeToPostsTest extends TestCase
{

    function test_a_user_can_subscribe_to_a_post()
    {
        $post = $this->createPost();

        $user = factory(User::class)->create();

        $this->actingAs($user);
        
        $this->visit(route('posts.show',[$post->id,"sddads"]))
        	 ->press('Suscribirse al post');

        $this->seeInDatabase('subscriptions', [
        	'user_id' => $user->id,
        	'post_id' => $post->id
        ]);

        $this->seePageIs($post->url)
        	 ->dontSee('Suscribirse al post');
    }
}
