<?php

use \App\Post;

class PostModelTest extends TestCase
{

    function test_adding_title_generate_slug()
    {
    	$post = new Post([
    		'title' => 'Esta es una pregunta'
    	]);

    	$this->assertSame('esta-es-una-pregunta', $post->slug);
    }

    function test_editing_title_change_slug()
    {

    	$post = new Post([
    		'title' => 'Esta es una pregunta'
    	]);

    	$post->title = 'Como Instalar laravel 5.1 LTS';

    	$this->assertSame('como-instalar-laravel-51-lts',$post->slug);

    }
}
