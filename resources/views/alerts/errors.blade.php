@if(count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@elseif (session('errors_validacion'))
	<div class="alert alert-danger">
		<ul>
			<li>{{ session('errors_validacion') }}</li>
		</ul>
	</div>
@endif