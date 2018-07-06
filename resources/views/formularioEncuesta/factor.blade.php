
<div class="col-md-8">
   {!! $factor->nombre !!}
</div>

{{-- Eliminar factor --}}
<div class="col-md-1 pull-right">
   {!!Form::open(['route'=>['factores-encuesta.destroy',$factor->id. '/' .$dimension->encuentas_id], 'method' => 'DELETE'])!!}
      <button type="submit" class="btn btn-danger btn-xs" 
         onclick='return confirm("¿Desea eliminar el registro?")'; title="Eliminar factor" alt="Eliminar factor">
         <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
      </button>
   {!!Form::close()!!}                                                
</div>

{{-- Editar factor --}}
<div class="col-md-1 pull-right">
   <a id="editar" href="{!! url('factores-encuesta/edit/'.$factor->id.'/'.$dimension->encuentas_id) !!} "  alt="Editar factor" class="btn btn-primary btn-xs" title="Editar factor">
      <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
   </a>                                              
</div>

{{-- Ver factor --}}
<div class="col-md-1 pull-right">
   <a id="ver" href="{!! url('factores-encuesta/show/'.$factor->id.'/'.$dimension->encuentas_id) !!} " class="btn btn-primary btn-xs" alt="Ver" title="Ver">
      <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
   </a>
</div>