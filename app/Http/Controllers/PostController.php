<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use \App\Post;

class PostController extends Controller
{


	public function index(){
		$posts = Post::latest()->paginate();

		return view('posts.index', compact("posts"));
	}


    public function show(Post $post,$slug){

		if ( $post->url != $slug ){
			
			return redirect($post->url, 301);
			
		}

		return view('posts.show',compact('post'));
	
	}
}
