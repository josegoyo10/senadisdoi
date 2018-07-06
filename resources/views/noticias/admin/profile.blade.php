@extends('noticias.app')

@section('title')
Administrador, {{ $user->name }}
@endsection

@section('content')
<div>
	<ul class="list-group">
		<li class="list-group-item">
			Ingresado en {{$user->created_at->format('Y-m-d H:i:s') }}
		</li>
		<li class="list-group-item panel-body">
			<table class="table-padding">
				<style>
					.table-padding td{
						padding: 3px 8px;
					}
				</style>
				<tr>
					<td>Total Pulicaciones </td>
					<td><span class="badge">{{$posts_count}}</span> </td>
					@if($author && $posts_count)
					<td> <a id="mostrar-noticias-privadas" class="btn btn-default btn-xs" style="float: right" href="{{ url('/noticias-privadas')}}">  Mostrar Todos</a></td>
					@endif
				</tr>
				<tr>
					<td>Noticias Publicadas </td>
					<td><span class="badge">{{$posts_active_count}}</span></td>
					@if($posts_active_count)
					<td><a id="mostrar-publicaciones" class="btn btn-default btn-xs" href="{{ url('/user/'.$user->id.'/posts')}}"> Mostrar Todas</a></td>
					@endif
				</tr>
				<tr>
					<td>Borradores </td>
					<td><span class="badge">{{$posts_draft_count}}</span></td>
					@if($author && $posts_draft_count)
					<td><a id="mostrar-borradores" class="btn btn-default btn-xs" href="{{ url('borradores')}}">Mostar Todos</a></td>
					@endif
				</tr>
			</table>
		</li>
		<li class="list-group-item">
			Total Comentarios <span class="badge">{{$comments_count}}</span>
		</li>
	</ul>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><h3>&Uacute;ltimas Publicaciones</h3></div>
	<div class="panel-body">
		@if(!empty($latest_posts[0]))
		@foreach($latest_posts as $latest_post)
			<p>
				<strong><a href="{{ url('/noticias/'.$latest_post->slug) }}">{{ $latest_post->title }}</a></strong>
				<span class="well-sm">El {{ $latest_post->created_at->format('Y-m-d H:i:s') }}</span>
			</p>
		@endforeach
		@else
		<p>You have not written any post till now.</p>
		@endif
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><h3>&Uacute;ltimos comentarios</h3></div>
	<div class="list-group">
		@if(!empty($latest_comments[0]))
		@foreach($latest_comments as $latest_comment)
			<div class="list-group-item">
				<p>{{ $latest_comment->body }}</p>
				<p>El {{ $latest_comment->created_at->format('Y-m-d H:i:s') }}</p>
				<p>La publicaci&oacute;n <a href="{{ url('/noticias/'.$latest_comment->post->slug) }}">{{ $latest_comment->post->title }}</a></p>
			</div>
		@endforeach
		@else
		<div class="list-group-item">
			<p>You have not commented till now. Your latest 5 comments will be displayed here</p>
		</div>
		@endif
	</div>
</div>
@endsection
