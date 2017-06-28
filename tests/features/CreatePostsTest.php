<?php

class CreatePostsTest extends FeatureTestCase{

	function test_a_user_create_a_post(){

		//Having
		$this->actingAs( $user = $this->defaultUser() );

		//When
		$this->visit(route('posts.create'))
		->type('Esta es una pregunta', 'title')
		->type('Este es el contenido', 'content')
		->press('Publicar');

		//Then
		$this->seeInDatabase('posts', [
			'title' => 'Esta es una pregunta',
			'content' => 'Este es el contenido',
			'pending' => true,			
			'user_id' => $user->id
			]);

		//Test a user is redirected to the page post after created it.
		$this->see('Esta es una pregunta');

	}

	function test_a_guest_user_tries_to_create_a_post(){

		//When
		$this->visit(route('posts.create'))
		->seePageIs(route('login'));

	}

	function test_create_post_form_validation(){

		$this->actingAs($this->defaultUser())
		->visit(route('posts.create'))
		->press('Publicar')
		->seePageIs(route('posts.create'))		
		->seeErrors([
				'title' => 'El campo título es obligatorio.', 
				'content' => 'El campo contenido es obligatorio.'
		]);


	}
}

?>