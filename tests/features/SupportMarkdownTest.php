<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

class SupportMarkdownTest extends FeatureTestCase
{

	//use WithoutMiddleware;
	
	function test_the_post_content_support_markdown()
    {
        $importantText = 'Un texto muy importante';

        $post = $this->createPost([
        	'content' => "La primera parte. **$importantText** .La ultima parte del texto"
        ]);

        $this->visit($post->url)
        	->seeInElement('strong', $importantText);
    }

    function test_the_code_in_the_post_is_escaped()
    {
        $xssAttack = "<script>alert('Sharing code')</script>";


        $post = $this->createPost([
        	'content' => "`$xssAttack` texto normal."
        ]);

        $this->visit($post->url)
        	->dontSee($xssAttack)
        	->seeText("texto normal")
        	->seeText($xssAttack);
    }

    function test_xss_attack()
    {
        $xssAttack = "<script>alert('Malicious JS!')</script>";

        $post = $this->createPost([
        	'content' => "$xssAttack. Texto normal"
        ]);

        $this->visit($post->url)
        	->dontSee($xssAttack);
        	//->seeText("Texto normal"); @todo:fix
    }

    function test_xss_attack_with_html()
    {
        $xssAttack = "<img src='img.jpg'>";

        $post = $this->createPost([
        	'content' => "$xssAttack. Texto normal"
        ]);

        $this->visit($post->url)
        	->dontSee($xssAttack);
    }
}
