<?php


class ShowPostTest extends FeatureTestCase
{

	function test_a_user_can_see_the_post_details(){
		
		$user = $this->defaultUser([
			'name' => 'Jose Bidegain'
		]);

		$post = $this->createPost([
			'title' => 'Como instalar laravel',
			'content' => 'Este es el contenido del post',
			'user_id' => $user->id
		]);

		$this->visit($post->url)
		->seeInElement('h1', $post->title)
		->see($post->content)
		->see($user->name);

	}

	function test_wrong_slug_in_url_to_post(){

		$post = $this->createPost([
			'title' => 'Old Title',
		]);

		$url = $post->url;

		$post->update(["title"=>"New Title"]);

		$this->visit($url)
		->assertResponseStatus(200)
		->see("New Title");
	}

	function test_old_urls_are_redirected(){

		$post = $this->createPost([
			'title' => "Old Title"
		]);

		$url = $post->url;

		$post->update([ "title"=> "New Post"]);

		$this->visit($url)
		->seePageIs($post->url);

	}
}
