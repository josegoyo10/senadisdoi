<ul class="nav nav-tabs">
	<?php
	    $pestana_activa = true;
	    $cont_dimensiones = 0;
	?>

    @foreach($dimension as $row)

		<?php
			$cont_dimensiones++;
		    if ($pestana_activa) {
		        $clase_activa = "active";
		        $pestana_activa = false;
		    }else{

		        $clase_activa = "";
		    }
		?>

        @if($row->nombre != "")
                <li class="{{$clase_activa}}">
                 <a data-toggle="tab" aria-controls="home2" id="#dimension{{$row->id}}" href="#dimension{{$row->id}}" alt="{{ $row->nombre }}">{{ $row->nombre }}</a>
                </li>
        @endif

    @endforeach

    <?php 
		$cont_dimensiones++;
    ?>
	<li class="{{$clase_activa}}">
		<a data-toggle="tab" aria-controls="home2" id="#dimension{{$cont_dimensiones}}" href="#dimension{{$cont_dimensiones}}" >
			{{ trans('traduction.summary') }}
		</a>
	</li>
</ul>
