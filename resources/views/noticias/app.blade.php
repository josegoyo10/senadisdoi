@extends('adminlte::layouts.app')

@section('main-content')

	<div class="container-fluid spark-screen">
		<div class="row">

			<div class="col-md-10 col-md-offset-1">

				<div class="panel panel-default">

						<div class="panel-heading"><h2>Noticias SENADIS </h2></div>

					<div class="panel-body">
						<!-- Direct Chat -->
						<div class="row">
							<div class="col-md-12">
								<!-- DIRECT CHAT PRIMARY -->
								<div class="box box-primary direct-chat direct-chat-primary">
									<div class="box-header with-border">

										@if (Session::has('message'))
										<div class="flash alert-info">
											<p class="panel-body">
												{{ Session::get('message') }}
											</p>
										</div>
										@endif
										@if ($errors->any())
										<div class='flash alert-danger'>
											<ul class="panel-body">
												@foreach ( $errors->all() as $error )
												<li>
													{{ $error }}
												</li>
												@endforeach
											</ul>
										</div>
										@endif
										<div class="row">
											<div class="col-md-10 col-md-offset-1">
												<div class="panel panel-default">
													<div class="panel-heading">
														<h2>@yield('title')</h2>
														@yield('title-meta')
													</div>
													<div class="panel-body">
														@yield('content')
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-10 col-md-offset-1">
											</div>
										</div>
								</div>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection