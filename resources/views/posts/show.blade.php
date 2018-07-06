@extends('noticias.app')

@section('title')
	@if($post)
		{{ $post->title }}
		@if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
			<a class="btn btn-default" style="float: right" href="{{ url('edit/'.$post->slug)}}">Editar Publicaci&oacute;n</a>
		@endif
	@else
		P&aacute;gina no existe
	@endif
@endsection

@section('title-meta')
<p>{{ $post->created_at->format('Y-m-d H:i:s') }} Creado por <a href="#">{{ $post->author->name }}</a></p>
@endsection

@section('content')

@if($post)
	<div>
		{!! $post->body !!}
	</div>	
	<div>
		<h2>Dejanos t&uacute; Comentario</h2>
	</div>
	@if(Auth::guest())
		<p>Login to Comment</p>
	@else
		<div class="panel-body">
			<form method="post" action="/comment/add">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="on_post" value="{{ $post->id }}">
				<input type="hidden" name="slug" value="{{ $post->slug }}">
				<div class="form-group">
					<textarea required="required" placeholder="Deja t&uacute; comemtario" name = "body" class="form-control"></textarea>
				</div>
				<input id="guardar_comentario" type="submit" name='post_comment' class="btn btn-primary" value = "Guardar Comentario"/>
			</form>
		</div>
	@endif
	
	<div>
		@if($comments)
		<ul style="list-style: none; padding: 0">
			@foreach($comments as $comment)
				<li class="panel-body">
					<div class="list-group">
						<div class="list-group-item">
							<h3>{{ $comment->author->name }}</h3>
							<p>{{ $comment->created_at->format('Y-m-d H:i:s') }}</p>
						</div>
						<div class="list-group-item">
							<p>{{ $comment->body }}</p>
						</div>
					</div>
				</li>
			@endforeach
		</ul>
		@endif
	</div>
@else
404 error
@endif

@endsection
