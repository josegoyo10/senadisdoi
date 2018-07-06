<div class="box box-primary">
   <div class="box-header with-border">
      <h3 class="box-title pull-left  ">Resultados por dimensión - {{ $row_dimensiones->nombre }}</h3>
      <br>
      <div class="row">
         <div class="col-md-4"><br>
        
            <table class="table" style="width:350px;" id="table_factor">
               <thead>
                  <th>Factores</th>
                  <th style="width: 30px">%</th>
               </thead>
               <tbody>
                  @foreach($factores as $row)
                  <?php 
                     $nombre = ucfirst(strtolower($row->nombre));
                     ?>
                  <tr class="dato_{{$row_dimensiones->id}}">
                     <td class="texto_negrita">{{$nombre}}</td>
                     <td class="texto_negrita">
                        <span id="indicador{{$row->id}}" name="col{{$row->id}}" 
                           data-indicador="{{$row_dimensiones->id}}" value="">0%
                       </span>
                        <input type="hidden" name="col_reporte[{{$row->id}}]"  id="factor_ind_{{$row->id}}" data-dimension="{{$row_dimensiones->id}}" value="">
                     </td>
                  </tr>
                  @endforeach 
                  <tr>
                     <td class="texto_negrita">PONDERACIÓN TOTAL:</td>
                     <td class="texto_negrita">
                        <span id="total_pond_{{ $row_dimensiones->id }}" name="total_pond_{{ $row_dimensiones->id }}" value=""  class="pond_total" style="font-size:15px;"></span>
                                               
                        <input type="hidden" name="total_pond_reporte[{{$row_dimensiones->id}}]"  id="total_pond_reporte{{$row_dimensiones->id}}" data-dimension="{{$row_dimensiones->id}}" value="">
                        
                     </td>
                     <input type="hidden" name="cant_factores"  id="cant_factores" value="{{$row->id}}">
                  </tr>
               </tbody>
            </table>
  
         </div>
         <!--col-md-4 !-->
         <div class="col-md-4">
            <div id="chart_div_0"
               style="height:300px;margin:0 auto;min-width:300px;max-width:600px; display:none;"  class="pull-left">
            </div>
            <div id="chart_div_{{ $row_dimensiones->id }}" 
               style="height:300px;min-width:300px;max-width:600px;margin-left:80px" class="pull-left" alt="Grafica_{{ $row_dimensiones->nombre }}">
            </div>
         </div>
         <!--col-md-4 !-->
         <br>
         <div class="col-md-4">
            <table class="table"  style="width:165px;margin-top:20px;margin:0 auto;">
               <tr>
                  <th colspan="2" class="text-center">Rangos</th>
               </tr>
               <tr>
                  <td class="texto_negrita">%</td>
                  <td class="texto_negrita">ESCALA</td>
               </tr>
               <tr>
                  <td class="texto_negrita">0 - 20</td>
                  <td class="texto_negrita">Muy Bajo</td>
               </tr>
               <tr>
                  <td class="texto_negrita">20.1 - 40</td>
                  <td class="texto_negrita">Bajo</td>
               </tr>
               <tr>
                  <td class="texto_negrita">40.1 - 60 </td>
                  <td class="texto_negrita">Medio</td>
               </tr>
               <tr>
                  <td class="texto_negrita">60.1 - 80</td>
                  <td class="texto_negrita">Alto</td>
               </tr>
               <tr>
                  <td class="texto_negrita">80.1 - 100</td>
                  <td class="texto_negrita">Muy Alto</td>
               </tr>
            </table>
         </div>
      </div>
    </div>
   <!--box-header with-border!-->
</div>
<!--box -box-primary!-->
