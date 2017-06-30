<?php

use App\Comment;

class AcceptAnswerTest extends FeatureTestCase
{

    public function test_the_posts_author_can_accept_a_comment_as_the_posts_answer()
    {
       $comment = factory(Comment::class)->create([
       		'comment' => 'Esta va a ser la respuesta del post'
       	]);

       $this->actingAs($comment->post->user);

       $this->visit($comment->post->url)
       		->press('Aceptar como respuesta');


       	$this->seeInDatabase('posts', [
       		'id' => $comment->post_id,
       		'pending' => false,
       		'answer_id' => $comment->id
       	]);

       	$this->seePageIs($comment->post->url)
       		->seeInElement('.answer', $comment->comment);

    }

    public function test_non_the_posts_author_cannot_accept_a_comment_as_the_posts_answer(){

        $comment = factory(Comment::class)->create([
            'comment' => 'Esta va a ser la respuesta del post'
          ]);

          $this->actingAs(factory(App\User::class)->create());


         $this->visit($comment->post->url)
            ->dontSee('Aceptar como respuesta');


          $this->seeInDatabase('posts', [
            'id' => $comment->post_id,
            'pending' => true
          ]);

    }

    public function test_non_the_posts_author_dont_see_the_accept_answer_button()
    {
       $comment = factory(Comment::class)->create([
       		'comment' => 'Esta va a ser la respuesta del post'
       	]);

       $this->actingAs(factory(App\User::class)->create());


       $this->visit($comment->post->url)
       		->dontsee('Aceptar como respuesta');

    }


    public function test_non_the_posts_author_cannot_send_post_to_accept_answer()
    {
       $comment = factory(Comment::class)->create([
       		'comment' => 'Esta va a ser la respuesta del post'
       	]);

       $this->actingAs(factory(App\User::class)->create());

       $this->post(route('comments.accept',$comment));

       $this->dontSeeInDatabase('posts', [
       		'id' => $comment->post_id,
       		'pending' => false,       
       	]);

    }


    public function test_the_accept_button_is_hidden_when_the_comment_is_already_the_post_answer()
    {
       $comment = factory(Comment::class)->create([
       		'comment' => 'Esta va a ser la respuesta del post'
       	]);

       $this->actingAs($comment->post->user);

       $comment->markAsAnswer();

       $this->visit($comment->post->url)
       		->dontSee('Aceptar como respuesta');


    }


}
