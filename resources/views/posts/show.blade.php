@extends('layouts.app')

@section('content')
<h1>{{ $post->title }}<h1>
{!! Markdown::convertToHtml( e($post->content) ) !!}
<p>{{ $post->user->name }}</p>

@if ( auth()->check() && !auth()->user()->isSubscribedTo($post) )
{!! Form::open([ 'route' => ['posts.subscribe', $post], 'method' => 'POST']) !!}
	<button type="submit">Suscribirse al post</button>
{!! Form::close() !!}
@endif

<h1>Comments</h1>
{!! Form::open(['route'=>['comments.store', $post],'method'=>'POST' ]) !!}

	{!! Field::textarea('comment') !!}

	<button type="submit">
		Publicar Comentario
	</button>

{!! Form::close() !!}


@foreach ($post->latestComments as $comment)
<article class="{{ $comment->answer ? 'answer' : '' }}">
	{{ $comment->comment }}
	{{ $comment->user_id }}
	
	@if( Gate::allows('accept',$comment) && !$comment->answer )
		{!! Form::open(['route'=>['comments.accept', $comment], 'method'=>'POST']) !!}
			<button type="submit">Aceptar como respuesta</button>
		{!! Form::close() !!}
	@endif
</article>	
@endforeach


@endsection

