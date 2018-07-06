<div class="container">    
   <div class="row">

	  @foreach($dimension as $row)
	 

	     <div class="col-sm-3" style="width:30%;margin-left:-20px;">
	       <div class="panel panel-primary">
	        <div class="panel-heading">{{ $row->nombre }}</div>
	         <div class="panel-body resumen_grafica" id="chart_graph_{{$row->id}}" alt="Resumen Grafica de {{ $row->nombre }}">
	         </div>
	           <div class="panel-body resumen_grafica_0" id="chart_graph_0" alt="Resumen Grafica de {{ $row->nombre }}">
	          </div>
	        </div>
	     </div>

	    
	   @endforeach

    </div>
</div>

