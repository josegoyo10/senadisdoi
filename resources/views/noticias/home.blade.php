@extends('noticias.app')

@section('title')
    {{$title}}
@endsection

@section('content')

    @if ( !$posts->count() )
        No hay Noticias!!!
    @else
        <div class="">
            @foreach( $posts as $post )
                <div class="list-group">
                    <div class="list-group-item">@if($post->active == 0)
                            <h3><a id="titulo_noticia" href="#">{{ $post->title }}</a>
                                @else
                                    <h3><a id="titulo_noticia" href="{{ url('/noticias/'.$post->slug) }}" alt="Titulo Noticia">{{ $post->title }}</a>
                                        @endif
                            @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
                                @if($post->active == '1')
                                    <a id="editar-publicacion" class="btn btn-default" style="float: right" href="{{ url('edit/'.$post->slug)}}" alt="Editar Publicación">Editar Publicaci&oacute;n</a>
                                @else
                                    <a id="editar-borrador" class="btn btn-default" style="float: right" href="{{ url('edit/'.$post->slug)}}" alt="Editar Borrador">Editar Borrador</a>
                                @endif
                            @endif
                        </h3>
                        <p>{{ $post->created_at->format('Y-m-d H:i:s') }} </p>

                    </div>
                    <div class="list-group-item">
                        <article>
                            {!! str_limit($post->body, $limit = 1500, $end = '....... <a href=' . url("noticias/".$post->slug).' class="btn btn-default btn-xs">Leer M&aacute;s</a>') !!}
                        </article>
                    </div>
                </div>
            @endforeach
            {!! $posts->render() !!}
        </div>
    @endif

@endsection
