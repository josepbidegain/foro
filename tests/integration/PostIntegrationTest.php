<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;


class PostIntegrationTest extends TestCase
{

	use DatabaseTransactions;

    function test_a_slug_generated_and_saved_in_database()
    {

        $post = $this->createPost([
    		'title' => 'Como instalar laravel'
    	]);

    	$this->seeInDatabase('posts',[
    		'slug' => 'como-instalar-laravel'
    	]);

    	$this->assertSame('como-instalar-laravel', $post->slug);

    	$this->assertSame('como-instalar-laravel', $post->fresh()->slug);
    }
}
