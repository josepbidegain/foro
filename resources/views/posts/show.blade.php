@extends('layouts.app')

@section('content')
<h1>{{ $post->title }}<h1>
<p>{{ $post->content }}</p>
<p>{{ $post->user->name }}</p>


<h1>Comments</h1>
{!! Form::open(['route'=>['comments.store', $post],'method'=>'POST' ]) !!}

	{!! Field::textarea('comment') !!}

	<button type="submit">
		Publicar Comentario
	</button>

{!! Form::close() !!}
@endsection