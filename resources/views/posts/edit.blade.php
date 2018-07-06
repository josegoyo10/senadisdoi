@extends('noticias.app')

@section('title')
Editar Noticias
@endsection

@section('content')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>
		var editor_config = {
			path_absolute : "/",
			menubar: false,
			selector: "textarea.my-editor",
			plugins: [
				"advlist autolink lists link image charmap print preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars code fullscreen",
				"insertdatetime media nonbreaking save table contextmenu directionality",
				"emoticons template paste textcolor colorpicker textpattern"
			],
			toolbar: "insertfile  | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code",
			relative_urls: false,
			file_browser_callback : function(field_name, url, type, win) {
				var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
				var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

				var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
				if (type == 'image') {
					cmsURL = cmsURL + "&type=Images";
				} else {
					cmsURL = cmsURL + "&type=Files";
				}

				tinyMCE.activeEditor.windowManager.open({
					file : cmsURL,
					title : 'Filemanager',
					width : x * 0.8,
					height : y * 0.8,
					resizable : "yes",
					close_previous : "no"
				});
			}
		};

		tinymce.init(editor_config);
	</script>



	<form method="post" action='{{ url("/update") }}'>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
	<div class="form-group">
		<input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}"/>
	</div>
	<div class="form-group">
		<textarea name='body'class="form-control my-editor">
			@if(!old('body'))
			{!! $post->body !!}
			@endif
			{!! old('body') !!}
		</textarea>
	</div>
	@if($post->active == '1')
	<input type="submit" name='publish' class="btn btn-primary" value = "Guardar"/>
	@else
	<input type="submit" name='publish' class="btn btn-primary" value = "Publicar"/>
	@endif
	<input type="submit" name='save' class="btn btn-default" value = "Guardar como Borrador" />
	<a id="borrar-publicacion" href="{{  url('delete/'.$post->id.'?_token='.csrf_token()) }}" class="btn btn-default">Borrar Publicaci&oacute;n</a>
</form>
@endsection
