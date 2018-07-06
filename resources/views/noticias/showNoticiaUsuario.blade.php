<div class="panel panel-default">

	<div class="panel-heading"><h2>Noticias SENADIS </h2></div>

	<div class="panel-body">
        <div class="">
			@if ( !$posts->count() )
				        No hay Noticias!!!
				    @else
				            @foreach( $posts as $post )
				                <div class="list-group">
				                    <div class="list-group-item">
			                    			@if($post->active == 0)
			                            		<h3>{{ $post->title }}
			                                @else
			                                    <h3>{{ $post->title }}
			                                @endif
				                            
				                            @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
				                                @if($post->active == '1')
				                                    <a id="editar-publicacion" class="btn btn-default" style="float: right" href="{{ url('edit/'.$post->slug)}}" alt="Editar Publicaci&oacute;n">Editar Publicaci&oacute;n</a>
				                                @else
				                                    <a id="editar-borrador" class="btn btn-default" style="float: right" href="{{ url('edit/'.$post->slug)}}" alt="Editar Borrador">Editar Borrador</a>
				                                @endif
				                            @endif
				                        </h3>
				                        <p>{{ $post->created_at->format('d/m/Y H:i:s') }} </p>

				                    </div>
				                    <div class="list-group-item">
				                        <article>
				                            {!! str_limit($post->body, $limit = 1500, $end = '....... <a href=' . url("noticias/".$post->slug).' class="btn btn-default btn-xs">Leer M&aacute;s</a>') !!}
				                        </article>
				                    </div>
				                </div>
				            @endforeach
            			{!! $posts->render() !!}
			@endif
        </div>
    </div>
</div>