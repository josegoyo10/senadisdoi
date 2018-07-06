/**********************************************/
/*********************************************/
/*********************************************/
 $(document).ready(function(){ 
    var estado_encuesta = $('#estado_encuesta').val();
    var id_dimension_inicial = $('#dimension_inicial').val();
    var cont = 0;

   $.globalEval( 'var valor_cargar_inicio = ' + cont );
        // Este ciclo me suma todos los factores por dimension

   $("input[type=radio][class!=RadioAprobacion]").click(function() { 
    var iniciar = 1;
    $.globalEval( 'var valor_cargar_inicio = ' + iniciar );  
    var estado_encuesta = $('#estado_encuesta').val();
     calcularFactores($(this));
    if((estado_encuesta == 1) || (estado_encuesta == 3)){
       calcularBarraProgreso();
       calculo_ponderacion_grafico();
    }
    
     calculo_factores_dimension();
     //calculo_ponderacion_grafico();
    });
   
   
    $('input:radio:checked[class=radio_preg_si][data-dimension="'+id_dimension_inicial+'"]').each(function() { // loop through each radio button
        cont++;

     });

       //console.log( cont);
      if(cont ===0){
        drawChartTorta(0,100, id_dimension_inicial);

      }else{
        
      //$('#frm input[type=radio][data-dimension="'+id_dimension_inicial+'"]:checked').each(function(){
      $('#frm input[type=radio][class=radio_preg_si]:checked').each(function(){
          calcularFactores($(this));
          recorrer_radio_no();
                  
        });

      }

    var id = 1;
    calcularBarraProgreso();
    calculo_ponderacion_grafico();
    mostrar_nombre_archivo(id_dimension_inicial);
    radios_medio_verificacion_rechazado(id);
    recorrer_radio_no();
    if((estado_encuesta == 5)){
      mostrar_lista_preg_rechazadas();
    }

     var id_fecha = id_dimension_inicial;
          
           Calendar.setup({ 
           inputField : "fecha_responde["+id_fecha+"]", // id del campo de texto 
           ifFormat : "%d-%m-%Y", // formato de la fecha que se escriba en el campo de texto 
           button : "lanzador_"+id_fecha // el id del botón que lanzará el calendario 
      }); 

  
  //pestañas
    $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
            var tab       = $(e.target);
            var contentId = tab.attr("id");
            var id_graph  = contentId.substring(10,20);
            var cant_si   = 0;
            var tab_ant   = 0;
            var total_dimension       = $('#total_dimension').val();
             
             $.globalEval( 'var id_identificacion = ' + id_graph );
             
             var estado_encuesta = $('#estado_encuesta').val();

            if (tab.parent().hasClass('active')) {
  
                var suma_total_factores = 0;
                               
               // Este ciclo me suma todos los factores por dimension
                 $('#frm input[type=radio][data-dimension="'+id_graph+'"]:checked').each(function(index, el) {
                      calcularFactores($(this));
                    });
                                               
                               
                recorrer_radio_no();
                calculo_factores_dimension(id_graph);
                radios_medio_verificacion_rechazado(id_graph);
                //validar_adjuntos();
                 if((estado_encuesta != 5) || ((estado_encuesta == 2)))
                 {
                   validar_adjuntos();
                 }

                mostrar_nombre_archivo(id_graph);
                validar_campos_identicacion();
                //calculo_grafico(suma_total_factores,id_graph);
                calculo_ponderacion_grafico();

               if(id_graph == parseInt(total_dimension) + 1){
       
                   recorrer_pestanas();

               }else{
              
                 Calendar.setup({ 
                  inputField : "fecha_responde["+id_graph+"]", // id del campo de texto 
                  ifFormat : "%d-%m-%Y", // formato de la fecha que se escriba en el campo de texto 
                  button : "lanzador_"+id_graph // el id del botón que lanzará el calendario 
                }); 

              }

               $('.radio_preg_si[data-dimension="'+ id_graph +'"]:checked').each(function(){
                       cant_si++;

                  });

                if((cant_si == 0)){
                 drawChartTorta(0,100, id_graph);
                }

                 
            }
            
                     
      })


  //boton validar informacion

    var cantidad = 0;
    var cantidad_total = 0;
    //id_identificacion = 10;  
     $('#validar_encuesta_1').click(function(){
      

      validar_campos_identicacion();
   
       cantidad_total = $('#total_preguntas').val();
       var estado_encuesta = $('#estado_encuesta').val();
       var cantidad_contestada      = 0;
       var cantidad_no_contestada   = 0;
   
      $('input:checked').each(function(i){
               
         cantidad_contestada = parseInt(cantidad_contestada)+ 1;

       });
      

        cantidad_no_contestada =  cantidad_total-cantidad_contestada;
        
          if ($('#estado_encuesta').val() != 5){ 
              
              $('#msj_adjunto_preg_rechazo').hide();

             if(cantidad_no_contestada > 0){
                $('#btn_guardar_enviar').addClass('disabled');
                $('#msj_error_preg_sin_contestar').show();

             }else {
                 // $('#btn_guardar_enviar').removeClass('disabled');
                  $('#msj_error_preg_sin_contestar').hide();
                  
             }

             $('#cant_contestada').html(cantidad_contestada);
             $('#no_contestada').html(cantidad_no_contestada);

           }else{
                  $('#btn_guardar_enviar').addClass('disabled');
                  $('#msj_error_preg_sin_contestar').hide();
                  $('#cant_contestada').html(cantidad_contestada);
                  $('#btn_guardar_borrador').addClass('disabled');
           }
            
            // Se recorre los input con clase file-loading para obtener el valor y chequear si tiene valor 
            //para luego ir metiendo esos valores en un array 
            if (($('#estado_encuesta').val() != 5) || ($('#estado_encuesta').val() != 2))
            {
                validar_adjuntos();
             }else{
                 $('#msj_error_img').hide();
                 recorrer_adjuntos_rechazados();

             }
        

       })//fin validar_encuesta1
   
});

//
function calcularFactores(v) {
      var test                = v.val();
      var factor_id           = v.attr("data-factor-id");
      var ponderar            = v.attr("data-ponderacion");
      var cantidad_preg       = v.attr("data-cant-preg");
      var id_dimension        = v.attr("data-dimension");
      var id_image            = 0;
      var total_x_factor      = 0;
      var contador            = 0;
      var suma_total_factores = 0;
      var l = v.is(':focus');

      id_image = v.attr("id").substring(11,20); 
      //alert(v.attr("id"));
      if(test == 1 && v.attr("class") == 'radio_preg_si' ){
        
            $("#span_image_" + id_image).show();
            $("#medio_" + id_image).show();
            $("#file_name_" + id_image).hide();
            $('#msj_opcion_'+id_image).hide();
      } else {  
          if (v.attr("class") == 'radio_preg_no' && l == true) {
               
                $("#span_image_" + id_image).hide();
                $("#medio_" + id_image).hide();
                $("#file_name_" + id_image).hide();
                $('#file_error_' +id_image).hide();
                $('#msj_opcion_'+id_image).hide();
           
            }  
     }

     // Este ciclo me suma todos los factores por dimension
     var tabla_factores = $('#tbl_factores tbody').find('tr.dimension_'+id_dimension);
     // Este ciclo me suma todos los factores por dimension
      tabla_factores.each(function(){
          suma_total_factores += parseInt($(this).find('td').eq(3).text()||0,10)
       })
      //console.log("suma_total_factores:"+suma_total_factores);
             
      
      var myRadioSi =  $('#frm input[type=radio][class="radio_preg_si"][data-dimension='+id_dimension+']');
        myRadioSi.each(function(){ 
          // if ((this.checked) && (($(this).attr("data-valor")==factor_id)) && (($(this).attr("data-dimension")==id_dimension)))
             if ((this.checked) && (($(this).attr("data-valor")==factor_id)))
             {
           
                
                total_x_factor += parseInt($(this).attr('data-valor-pond'));//me arroja el valor de las columnas con el radio button Si seleccionado
               
              }
 
              //alert("total_x_factor:"+ total_x_factor);
           //console.log("total_x_factor:" + total_x_factor);
      }); 
     calculo_factores(test,ponderar,id_dimension,total_x_factor,factor_id);
     calculo_grafico(suma_total_factores,id_dimension);
     calculo_factores_dimension(id_dimension);

}//fin function

//
function calculo_grafico(sum_total_factores,id_dimension){

          var porcentaje_total    = 0;
          var radio_sel           = 0;
          var total_chequeados    = 0;
          var cantidad            = 0;
          var edo_encuesta        = $('#estado_encuesta').val();

         $('.radio_preg_si[data-dimension="'+ id_dimension +'"]:checked').each(function(index, el){
                               
              cantidad++;
              total_chequeados += parseInt($(this).attr('data-valor-pond'));
                     
          });

         //console.log("grafico_total_chequeado:"+total_chequeados);
         //se corrigio calculo con decimales. 31/10/2017 - JG     
          radio_sel        = ((total_chequeados/sum_total_factores)*100);
          porcentaje_total = (100-(radio_sel));

         drawChartTorta(radio_sel,porcentaje_total, id_dimension);
         drawChartTortaResumen(radio_sel,porcentaje_total, id_dimension);
                
         $('.highcharts-credits').hide();
          
         if(cantidad == 0){
         
            drawChartTorta(0,100, id_dimension);
            drawChartTortaResumen(0,100, id_dimension);
         }
      
      //recorrer_pestanas();
   $('input[type=radio][class=radio_preg_si][data-dimension='+id_dimension+']:checked').click(function() {
          var suma_total_factores_resumen  = 0;
          total_chequeados_resumen         = 0;
          radio_sel                        = 0;
          porcentaje_total                 = 0;
          radio_sel                        = 0;
          porcentaje_total                 = 0;

          var tabla_factores_resumen = $('#tbl_factores tbody').find('tr.dimension_'+id_dimension);
          tabla_factores_resumen.each(function(){
              suma_total_factores_resumen += parseInt($(this).find('td').eq(3).text()||0,10)
          })


         $('.radio_preg_si[data-dimension="'+ id_dimension +'"]:checked').each(function(index, el){
                               
             if ((this.checked)){
                        
                 total_chequeados_resumen += parseInt($(this).attr('data-valor-pond'));
             }
                     
          });


          radio_sel        = ((total_chequeados_resumen/suma_total_factores_resumen)*100);
          porcentaje_total = (100-parseInt(radio_sel));
          
         drawChartTortaResumen(radio_sel,porcentaje_total, id_dimension);
   });
}


//*********************************************//
function recorrer_pestanas(id_dimension){

          var porcentaje_total            = 0;
          var radio_sel                   = 0;
          var total_chequeados_resumen    = 0;
          var id_dimension_inicial        = $('#dimension_inicial').val();
          var dimension_final             = $('#dimension_final').val();
          var inicio                      = 0; 
          inicio = parseInt(id_dimension_inicial)+1;
           //console.log("inicio:"+inicio);

      for(i=id_dimension_inicial;i<=dimension_final;i++){
          id_dimension = i;
          var suma_total_factores_resumen = 0;
          total_chequeados_resumen        = 0;
          radio_sel                       = 0;
          porcentaje_total                = 0;
          radio_sel                       = 0;
          porcentaje_total                = 0;

          var tabla_factores_resumen = $('#tbl_factores tbody').find('tr.dimension_'+id_dimension);
          tabla_factores_resumen.each(function(){
              suma_total_factores_resumen += parseInt($(this).find('td').eq(3).text()||0,10)
          })
          
          //console.log("pestana_suma_total_factores_resumen:" + suma_total_factores_resumen);

         $('.radio_preg_si[data-dimension="'+ id_dimension +'"]:checked').each(function(index, el){
                               
                     if ((this.checked)){
                        
                        total_chequeados_resumen += parseInt($(this).attr('data-valor-pond'));
                       }
                     
          });

          radio_sel        = ((total_chequeados_resumen/suma_total_factores_resumen)*100);
          porcentaje_total = (100-parseInt(radio_sel));
     
          drawChartTorta(radio_sel,porcentaje_total, id_dimension);
          drawChartTortaResumen(radio_sel,porcentaje_total, id_dimension);
        
     }    
         
}

/**********************************************/
/*********************************************/
/*********************************************/
function enviar_formulario() {
     
     frm.submit();
   
  }


/**********************************************/
/*********************************************/
/*********************************************/
function calculo_factores(valor,ponderar_val,id_dimension,total_x_factor,factor_id){
     var val_factor          = 0;
     var total               = 0;
     var radio_value         = 0;
     var ponderacion_total   = 0;
     var valor_dimension     = 0;
   
        
     radio_value     = factor_id;
     valor_dimension = id_dimension;

     // Este ciclo me saca el total por cada factor
      var table_total_factor = $('#tbl_factores tbody tr').find('td:eq(2) input[data-valor=' + radio_value + '][data-dimension='+valor_dimension+']');

      table_total_factor.each(function (i) {
            // valor = $(this).val();
             total += parseInt($(this).attr('data-valor-pond'))
             
       })
          //console.log("total_dimension:"+total);           
                       
        if(total_x_factor != 0){

           val_factor        = Math.round(parseInt(total_x_factor)/parseInt(total)*100);
 
            var span_col = $('span[name=col'+radio_value+']');

            span_col.each(function() {

               $("#indicador"+radio_value).html(val_factor + "%");
               $("#indicador"+radio_value).attr("value",val_factor);
              // $('input[name=col_reporte'+radio_value+']').attr('value',val_factor);          
               //$("input[type='hidden'][name='col_reporte9[]']").attr('value',val_factor);
               $("input[type='hidden'][name='col_reporte["+radio_value+"]']").attr('value',val_factor);
            })
      
        
          }else{
            //PONDERACION TOTAL SE SACA SUMANDO EL VALOR DE CADA FACTOR Y SE DIVIDE ENTRE 9 * 100 ,PARA EL CASO DE
            //OFICINA DE DISCAPACIDAD

             val_factor= Math.round(parseInt(total_x_factor)/parseInt(total)*100);
                          
                var span_cols  = $('span[name=col'+radio_value+']');   
                  span_cols.each(function() {

                        $("#indicador"+radio_value).html(val_factor + "%");
                        $("#indicador"+radio_value).attr("value",val_factor); 
                        //$('input[name=col_reporte'+radio_value+']').attr('value',val_factor); 
                        $("input[type='hidden'][name='col_reporte["+radio_value+"]']").attr('value',val_factor);
                  })
                  
                  var span_total =  $('span[name=total_pond_'+ valor_dimension+']');
                    
                    span_total.each(function() {

                        $('span[name=total_pond_'+ valor_dimension+']').html(ponderacion_total + "%");
                       
                   })


          }
               
}//fin function

//***************CalcularBarradeProgreso*****************************//

function calcularBarraProgreso () {
    var cantidad = 0;
    var cantidad_total = 0;
    var val = 0;

   $('input:checked[class!=RadioAprobacion]').each(function(i){
         cantidad = parseInt(cantidad)+ 1;
    });
     
         cantidad = parseInt(cantidad)+ 1;
 
     //  console.log("cantidad contestada:" + cantidad);

    cantidad_total = $('#total_preguntas').val();

    valor = Math.round((cantidad*100)/cantidad_total); 
      
    $('.progress-avance').css('width', valor+'%');
    $('#porcentaje_avance').html(valor+'% Completado'); 
}

/**********************************************/
/*********************************************/
/*********************************************/
//
 function  validar_adjuntos(){
    var fila_id_factor           = new Array();
    var value_image              = new Array();
    var id_img                   = 0;
    var image                    = 0;
    var mensaje                  = " ";
    var cont                     = 0;
    var names                    = "";
    var nombre_img               = "";

       $('#frm input[type=file][class="file-loading"]').each(function(){ 
                 id_img  = $(this).attr("data-img");
                 id_fila = $(this).attr("data-img").substring(6,12); 
                 image   = $('#'+id_img).val();
                 value_image.push(image);
                 fila_id_factor.push(id_fila); //en un array almaceno de los ID de cada fila que tiene la opcion de subir archivo
                
        });
             var cont = 0;
           $('input[type=file]').each(function(ind,elem){
              
                 files = $("#image_"+fila_id_factor[ind]).prop("files")
                 var names = $.map(files, function (val) { return val.name; });

                 $("#fila_" + fila_id_factor[ind]).css("border-style", "");
                 $("#fila_" + fila_id_factor[ind]).css("border-color", "");
                 

                 if(($('#btn-inicio_'+ fila_id_factor[ind]).is(':checked')) && $("#medio_"+ fila_id_factor[ind]).attr("value")=="")
                 {
                     cont++;
                     //console.log("fila:"+fila_id_factor[ind]);
                     $('#btn_guardar_enviar').addClass('disabled');
                     $("#fila_" + fila_id_factor[ind]).css("border-style", "solid");
                     $("#fila_" + fila_id_factor[ind]).css("border-color", "#d7191c");
              

                 }else if ($('#btn-inicio_'+ fila_id_factor[ind]).is(':checked') && ($("#medio_"+ fila_id_factor[ind]).attr("value")==undefined) && (names ==""))
                  
                  {  
                    cont ++;
                   //console.log($("#medio_"+ fila_id_factor[ind]).attr("value"));
                   $("#fila_" + fila_id_factor[ind]).css("border-style", "solid");
                   $("#fila_" + fila_id_factor[ind]).css("border-color", "#d7191c");
                   $('#btn_guardar_enviar').addClass('disabled');                                 
                 }else if ($("input[type=radio][id=radio_" + fila_id_factor[ind] + "]").is(':checked')              
                       && ($("input[type=radio][id=radio_" + fila_id_factor[ind] + "]:checked").val() =="0"))

                   {
                        cont ++;
                      //console.log($("#medio_"+ fila_id_factor[ind]).attr("value"));
                       $("#fila_" + fila_id_factor[ind]).css("border-style", "solid");
                       $("#fila_" + fila_id_factor[ind]).css("border-color", "#d7191c");
                       $('#btn_guardar_enviar').addClass('disabled');

                     } 
              
              });//fin input file
              //console.log("cont:"+cont);
               if(cont > 0){
                    $('#msj_error_img').show();
                    $('#lista_imagen').html("Error tiene: "+cont+" Medio de Verificacion por Adjuntar");
                }else{
                    $('#msj_error_img').hide();
                    //$('#btn_guardar_enviar').removeClass('disabled');
                  }

                 var valor = "0";
                 var id    = "0";
          
                $('.radio_preg_si').map(function() {
                     if(!(this.checked)){
                     
                         valor = this.id;
                         id    = valor.substring(11,16);
                         $('#msj_opcion_'+id).show();
                                        
                      }else{
                         
                           valor = this.id;
                           id    = valor.substring(11,16);
                          $('#msj_opcion_'+id).hide();

                      }
                  
                  }).get().join();

         
                $('.radio_preg_no').map(function() {
                     if((this.checked)){
                         valor = this.id;
                         id    = valor.substring(11,16);
                         $('#msj_opcion_'+id).hide();
                         $("#fila_" + id).css("border-style", "");
                         $("#fila_" + id).css("border-color", "");
                      
                      }
                  
                  }).get().join();

        
 }//fin validar_adjuntos


/***********************************************************************************************/
// Esta funcion permite recorrer todos los radio button No seleccionado y al momento de cargar la 
//pagina la pregunta tiene seleccionado el No por default esconde el archivo para adjuntar.

function recorrer_radio_no(){
       var id_button     = 0;
       var id_button_yes = 0;
       var selectedVal   = "";
       var selected      = $("input[type='radio'][class=radio_preg_no]:checked").each(function(){
          selectedVal    = $(this).data('preg');
          id_button      =  selectedVal.substring(10,20); 

          if(selectedVal != " " || id_button == 0){
             $("#span_image_" + id_button).hide();
             
          }else{
             $("#span_image_" + id_button).show();

          }

       });

      //Recorre todos los radio con clase radio pregunta si y verifico que si no estan chequeados cuando 
      // cargue la pagina oculte el boton de adjuntar archivo.
      
     var selected_si          = $("input[type='radio'][class=radio_preg_si]").each(function(){
          
        if(!(this.checked)){

              selectedValradio    = $(this).data('preg');
              id_button_yes       =  selectedValradio.substring(10,20); 

              if(selectedValradio != " " || id_button == 0){
                 $("#span_image_" + id_button_yes).hide();
              }else{
                 $("#span_image_" + id_button_yes).show();

              }
         }


       });

      
  }//fin recorrer_radio_No

 //****************************************************************************************//
//****************************************************************************************//
 function calculo_factores_dimension(id){

   //var i = 1;
     var suma                = 0;
     var ponderacion_total   = 0;
     var id_dimension        = 0;
     var check_seleccionados = 0;
     var valor               = 0;

     id_dimension = ((id == undefined) ? 1 : id);

       $(".dimension_"+id_dimension).each(function(){
         suma+=parseInt($(this).html()) || 0;
        });

        $('.radio_preg_si[data-dimension="'+ id_dimension +'"]').each(function(){
                               
             if ((this.checked)){ 

                  check_seleccionados += parseInt($(this).attr('data-valor-pond'))
             }       
                     
         });
                 
        //se corrigio calculo con decimales. 31/10/2017 - JG         
        ponderacion_total = (parseInt(check_seleccionados)/parseInt(suma)*100).toFixed(1);

      $('span[name=total_pond_'+ id_dimension+']').each(function() {  
         $('span[name=total_pond_'+ id_dimension+']').html(ponderacion_total + "%");
         $('span[name=total_pond_'+ id_dimension+']').attr('value',(ponderacion_total=='' ? "0":ponderacion_total));
         $("input[type='hidden'][name='total_pond_reporte["+id_dimension+"]']").attr('value',ponderacion_total);
      })
  

}

//****************************************************************************************//

function calculo_ponderacion_grafico(){

      var total                 = 0;
      var indice_integral       = 0;
      var gestion_mejorar       = 0;
      var id_dimension_inicial  = $('#dimension_inicial').val();
      var dimension_final       = $('#dimension_final').val();
      var total_dimension       = $('#total_dimension').val();
      var calculo_grafico_imdis = $('#valor_gral_imdis').val();

      for(i=parseInt(id_dimension_inicial);i<=parseInt(dimension_final);i++){

        $('span[name=total_pond_' + i).each(function(index,value){
             valor  = (($(this).attr('value') == "" ) ? "0" : $(this).attr('value'));
             total += parseInt(valor);
          
         });
        
        }
        

      indice_integral =  Math.round(parseInt(total)/total_dimension);
      $('input[name=grafico_gral_imdis]').attr('value',indice_integral); 
      
    if (valor_cargar_inicio == 0){
        
       gestion_mejorar =  (100-parseInt(calculo_grafico_imdis));
       drawChartIndiceMunicipal(parseInt(calculo_grafico_imdis),gestion_mejorar);
    }else{
        valor_cargar_inicio = 1;
        gestion_mejorar =  (100-parseInt(indice_integral));
        drawChartIndiceMunicipal(indice_integral,gestion_mejorar);
    }

}

//******************************************************************************************//

function mostrar_nombre_archivo(dimension){
   var fila_id_factores = new Array();
   var id_row = 0;
   var file_size = '';
   var names = "";
   var delete_previous_img = "";

   $('#frm input[type=file][class="file-loading"][data-id-dimension='+dimension+']').each(function(){ 
      id_row = $(this).attr("data-img").substring(6,12);
      fila_id_factores.push(id_row); //en un array almaceno de los ID de cada fila que tiene la opcion de subir archivo
        
    });

 $('input[type=file][data-id-dimension='+dimension+']').each(function(ind,elem){
  
   $("#span_image_"+fila_id_factores[ind]).mouseout(function(){
         files               = "";
         files               = $("#image_"+fila_id_factores[ind]).prop("files")
       
        if(files.length > 0){
         file_size           = $("#image_"+fila_id_factores[ind])[0].files[0].size;

         delete_previous_img = $("#medio_"+fila_id_factores[ind]).text();
         eliminar_image_row($("#medio_"+fila_id_factores[ind]));
         $('#btn-inicio_'+fila_id_factores[ind]).attr("data-medio-verificacion","1"); 

                 $("#file_error").html("");
                 names = "";                   
                //alert('Tamaño:' + file_size);
                 var names = $.map(files, function (val) { return val.name; });
                  $('#file_name_'+fila_id_factores[ind]).html("");
                 if((names != '') && (file_size<2097152)){
                    $('span[id=file_name_'+fila_id_factores[ind]+']').show();
                    $('#file_name_'+fila_id_factores[ind]).html("<p style='color:#2E9AFE'>"+names+"</p>");
                    $('#file_error_' +fila_id_factores[ind]).hide();
                    $('#eliminar_'+fila_id_factores[ind]).show();
                  
                   }else{

                      $('#file_name_'  +fila_id_factores[ind]).hide();
                      $('#file_error_'+fila_id_factores[ind]).show();
                      $('#file_error_' +fila_id_factores[ind]).html("<p style='color:#FF0000'>El tamaño del archivo es mayor de 2MB..Intente Nuevamente</p>");
            
                   }
          
       
         }
       });
        ($('span[id=file_name_'+fila_id_factores[ind]+']').show());//permite mostrar la imagen si nos cambiamos de pestaña


   });
}

//*************************************************************************************
function radios_medio_verificacion_rechazado(id){
    var estado_encuesta = $('#estado_encuesta').val();                   
    
    if(estado_encuesta == 5){

      var cant_rechazados = 0;

        $('#frm input[type=radio][class="radio_preg_si"]').each(function(i){ 
             if ((this.checked) && (($(this).attr("data-medio-verificacion")==0))) { 
                   cant_rechazados++;
                   id_fila = $(this).attr("id");
                   id_row = id_fila.substring(11,20);
                   $("#fila_" +id_row).css("border-style", "solid");
                   $("#fila_" +id_row).css("border-color", "#d7191c");
                   $("#image_"+id_row).removeAttr('disabled');
                   $('#btn_guardar_enviar').addClass('disabled');
                   $('#msj_adjunto_preg_rechazo').show(); 
                      
              }
          
          });
    }else{
      if(estado_encuesta == 2){
         $('#frm input[type=radio][class="RadioAprobacion"]').each(function(i){ 
             if ((this.checked) && (($(this).attr("value")==0))) { 
                   id_fila = $(this).attr("data-id");
                   $("#fila_"  + id_fila).css("border-style", "solid");
                   $("#fila_"  + id_fila).css("border-color", "#d7191c");

           }
       });
    }
  }
}
//*****************************************************************************//
 function mostrar_lista_preg_rechazadas(){
    var estado_encuesta        = $('#estado_encuesta').val();
    var arr_preguntas          =  [];
    var descripcion_preg       = "";
    var descripcion_preguntas ="";
    var id_sub_preg      = 0;

   if(estado_encuesta == 5){
           $('#collapse_preguntas').show();
           $('#observacion_div').show();
          
           var observacion        = $('#descripcion_motivo').val(); 

          $('#frm input[type=radio][class="radio_preg_si"]').each(function(i){ 

            if ((this.checked) && (($(this).attr("data-medio-verificacion")==0))) {   
                 id_fila       = $(this).attr("id");
                 id_row        = id_fila.substring(11,20);
                 desc_pregunta = $(this).attr("data-descripc-pregunta");
                 arr_preguntas.push(desc_pregunta);


            }
             
                descripcion_preguntas = "<ul>";
                        $.each(arr_preguntas, function(index,value) {
                               id_sub_preg = value.substring(0,1);
                               descripcion_preg = value.replace(/[0-9]/g, '');
                               descripcion_preguntas += "<li>"+descripcion_preg.trim()+"</li>";
                                   
                        });
                       
               descripcion_preguntas += "</ul>";


               $("#question_list_rechazadas").html(descripcion_preguntas);
                $("#observacion_rechazo").html(observacion); 

           });

       }
 
 }

//Esta funcion me permite eliminar la imagen que trae la pregunta de Base datos, al adjuntar una nueva
//desaparece y muestra la nueva.
 function eliminar_image_row(id){
   if(id != ""){
    $(id).remove();
   }
 }

 //**************************************************************************//
 function recorrer_adjuntos_rechazados(){

    var estado_encuesta = $('#estado_encuesta').val();
    var contador        = 0;

     if(estado_encuesta == 5){
         
            $('#frm input[type=radio][class="radio_preg_si"]').each(function(i){ 
                  if ((this.checked) && (($(this).attr("data-medio-verificacion")==0))) {

                   contador++;

                 }
          });
       
          //console.log("cont:"+contador);
            if(contador == 0){
                $('#btn_guardar_enviar').removeClass('disabled');
                $('#msj_adjunto_preg_rechazo').hide();    

            }else{
                   $('#btn_guardar_enviar').addClass('disabled');
            }
      }

 }

//validar campos encabezado de encuesta 
function  validar_campos_identicacion()
{
 
       $('.encabezado').map(function(index, el) { 
          valor = this.id;
          id    = valor.match(/\d+/);  

          var nombre      = $("#nombre_responde_"+id).val();
          var correo      = $("#correo_responde_"+id).val();
          var telefono    = $("#telefono_responde_"+id).val();
          var cargo       = $("#cargo_responde_"+id).val();
          var fecha       = document.getElementById("fecha_responde["+id+"]").value;
          var cont_fecha  = 0;
          var fecha1      = "";
          var fecha2      = "";
          var currentTime = new Date();
          var day = currentTime.getDate();
          var month = currentTime.getMonth() + 1;
          var year = currentTime.getFullYear();

            if (day < 10){
            day = "0" + day;
            }

            if (month < 10){
            month = "0" + month;
            }

          var dia_actual = day + "-" + month + "-" + year;
           var x = fecha.split('-');
           var z = dia_actual.split('-');
          
          fecha1 = x[1] + '-' + x[0] + '-' + x[2];
          fecha2 = z[1] + '-' + z[0] + '-' + z[2];

           var value = $('.encabezado').filter(function () {
               return this.value === '';

            });

          if ((nombre == "") && (correo == "") && (telefono == "") && (cargo == ""))
          {

              $("#error_nombre_"+id).show();
              $("#msj_encabezado").show();
              $('#btn_guardar_enviar').addClass('disabled');
              eliminar_text_field("#nombre_responde_","#error_nombre_",id);

              $("#error_correo_"+id).show();
              $("#msj_encabezado").show();
              $('#btn_guardar_enviar').addClass('disabled');
              eliminar_text_field("#correo_responde_","#error_correo_",id);

              $("#error_telefono_"+id).show();
              $("#msj_encabezado").show();
              $('#btn_guardar_enviar').addClass('disabled');
              eliminar_text_field("#telefono_responde_","#error_telefono_",id);

              $("#error_cargo_"+id).show();
              $("#msj_encabezado").show();
              $('#btn_guardar_enviar').addClass('disabled');
              eliminar_text_field("#cargo_responde_","#error_cargo_",id);

          }else{
              if ((nombre == "") && (correo == ""))
              {
                $("#error_nombre_"+id).show();
                $("#msj_encabezado").show();
                $('#btn_guardar_enviar').addClass('disabled');
                eliminar_text_field("#nombre_responde_","#error_nombre_",id);
               
                $("#error_correo_"+id).show();
                $("#msj_encabezado").show();
                $('#btn_guardar_enviar').addClass('disabled');
                eliminar_text_field("#correo_responde_","#error_correo_",id);

              }else if (nombre == ""){
                $("#error_nombre_"+id).show();
                $("#msj_encabezado").show();
                $('#btn_guardar_enviar').addClass('disabled');
                eliminar_text_field("#nombre_responde_","#error_nombre_",id);

              }else if (correo == ""){
                $("#error_correo_"+id).show();
                $("#msj_encabezado").show();
                $('#btn_guardar_enviar').addClass('disabled');
                eliminar_text_field("#correo_responde_","#error_correo_",id);

              }else if ((telefono == "") && (cargo == "")){
                $("#error_telefono_"+id).show();
                $("#msj_encabezado").show();
                $('#btn_guardar_enviar').addClass('disabled');
                eliminar_text_field("#telefono_responde_","#error_telefono_",id);

                $("#error_cargo_"+id).show();
                $("#msj_encabezado").show();
                $('#btn_guardar_enviar').addClass('disabled');
                eliminar_text_field("#cargo_responde_","#error_cargo_",id);

              }else if (telefono == ""){
                $("#error_telefono_"+id).show();
                $("#msj_encabezado").show();
                $('#btn_guardar_enviar').addClass('disabled');
                eliminar_text_field("#telefono_responde_","#error_telefono_",id);

              }else if (cargo == ""){
                $("#error_cargo_"+id).show();
                $("#msj_encabezado").show();
                $('#btn_guardar_enviar').addClass('disabled');
                eliminar_text_field("#cargo_responde_","#error_cargo_",id);

              }else if (fecha == ""){
                $("#error_fecha_"+id).show();
                $("#msj_fecha_validacion").hide();
                $("#msj_encabezado").show();
                $('#btn_guardar_enviar').addClass('disabled');


              }else if (Date.parse(fecha1) > Date.parse(fecha2)){
                   cont_fecha ++;
                  $("#msj_fecha_validacion").show();
                  $('#btn_guardar_enviar').addClass('disabled');

              }else{
                  $("#error_fecha_"+id).hide();
                  $("#msj_fecha_validacion").hide();
                  $('#btn_guardar_enviar').removeClass('disabled');

              }

          }
          

          if ((value.length == 0) && (cont_fecha == 0))
          {
               $("#msj_encabezado").hide();
               $('#btn_guardar_enviar').removeClass('disabled');
            } else if (value.length > 0) {
                
               $("#msj_encabezado").show();
               $('#btn_guardar_enviar').addClass('disabled');
            }
      
      }).get().join();

   //}
}

//Permite una vez que llenas los input del encabezado se borre la palabra completado
function eliminar_text_field(campo,error,id){

  $(campo+id).keyup(function(){
        if ($(this).val() != "") {
            $(error+id).hide();

        } else {
           $(error+id).show();   
        }
    }); 
}
