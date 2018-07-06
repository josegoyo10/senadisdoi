$(document).ready(function(){

         
          var valor = 0;
          var cantidad_radio = 0;
          var id_pregunta = 0;

          $(".RadioAprobacion").click(function() {    
                     var cont_aprobado          = 0;
                     var cont_rechazado         = 0;
                     var cantidad_radio         = 0;
                     var no_chequeado           = 0;
                     var arr_preguntas          = [];
                     var arr_descripcion        = [];
                     var descripcion_html       ="";
                     var id_sub_preg            = 0;
                     var descripcion_preg       = "";
                     var descripcion_dimension  = "";
                      cantidad_radio++;
                      id_pregunta               = $(this).attr("data-id");
                      id_dimension              = $(this).attr("data-dimension");
                      var cont_dimension = 0;
                     //$('#frm input[type=radio][class="RadioAprobacion"][data-dimension='+id_dimension+']').each(function(i){
                      $('#frm input[type=radio][class="RadioAprobacion"]').each(function(i){  
                         var cont = 0;
                         var cont_preg = 0;
                     
                         if ((this.checked) && ($(this).val())==1)
                         {
                            cont_aprobado++;
                            valor = $(this).val();
                            //name = $(this).attr('data-id'); 
                            //id_check_si = name.substring(8,15);
                             id_check_si = $(this).attr('data-id');
                          
                          }else{
                               if((this.checked) && ($(this).val())==0)
                                {
                                    
                                  $('#mostrar_preg_rechazadas').show();

                                  id_pregunta           = $(this).attr("data-id");
                                  desc_pregunta         = $(this).attr("data-pregunta");
                                  arr_preguntas.push(desc_pregunta);
                                  cont_rechazado++;
                                  descripcion_html="";

                                  //$('#preguntas_rechazadas').html(descripcion_html);
                                 
                                  descripcion_html = "<ul id=preg_rechazada;style=margin-right:640px; class=test>";
                                       
                                          $.each(arr_preguntas, function(index,value) {
                                                cont_preg++;
                                                descripcion_preg = value.replace(/[0-9]/g, '');
                                                descripcion_html += "<li id=rechazoPreg_"+cont_preg+" class=hr>"+descripcion_preg.trim()+"</li>";
                                           
                                            
                                        });
                          
                       
                                     descripcion_html += "</ul>";

                                       $.globalEval( 'var cantidad_radio_no = ' + cont_rechazado );
                                        $('#preguntas_rechazadas').html(descripcion_html);  

                                    }else{   

                                            //$('#frm input[type=radio][class="inputClass"][id=radio_'+i+']').each(function(i){
                                            //$('#frm input[type=radio][class="RadioAprobacion"]').each(function(i){
                                              name = $(this).attr('name');
                                      
                                              if(! $('input:radio[name="' + name + '"]:checked').length) {
                                                    no_chequeado++;
                                                    //alert('Oops, you missed some input there.. [' + name + ']');
                                                     $('#rechazar_encuesta').prop("disabled", true);
                                                     $('#aprobar_encuesta').prop("disabled", true);
                                                    
                                                    return false;
                                                }

                                             //});

                                         }//else
                                   }//else

                         });//fin #frm
                      
                          if(no_chequeado > 0){
                                    $('#rechazar_encuesta').prop("disabled", true);
                                    $('#aprobar_encuesta').prop("disabled", true);

                          }else{

                              if((cont_rechazado >0))
                              {
                                 $('#rechazar_encuesta').prop("disabled", false);
                                 $('#aprobar_encuesta').prop("disabled", true);
                              }else{
                                   if((cont_aprobado > 0))
                                   {
                                      $('#rechazar_encuesta').prop("disabled", true);
                                      $('#aprobar_encuesta').prop("disabled", false);
                                 
                                    }

                                  }
                               }
                           

   });
    
  
  //Permite desbloquear el campo motivo_rechazo en caso que este lleno sino si esta vacio
//el boton enviar permanecera disabled.

$("#motivo_rechazo").keyup(function(){
        if ($(this).val() != "") {
            $("#btn_enviar_preg_rechazo").removeAttr("disabled");

        } else {
            $("#btn_enviar_preg_rechazo").attr("disabled", "true");
            $("#motivo_rechazo").val('');      
        }
    });    


//Permite limpir los input que tiene el modal 
$('[data-dismiss=modal]').on('click', function (e) {
    var $t = $(this),
    target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];

    $(target).find("input,textarea,select").val('').end();
    $("#btn_enviar_preg_rechazo").attr("disabled", "true");
    
})

//************************Rechazar Encuesta******************************************//

$('#btn_enviar_preg_rechazo').click(function(event) {
          
           //alert("cont_rechazo:"+cantidad_radio_no);
          var formData             = $('#frm').serialize();
          var ruta                 ="/enviar/rechazo_encuesta";
          var motivo_rechazo       = $('#motivo_rechazo').val();
          var array_preg_rechazo   = new Array();
          var preguntas_rechazadas = "";

           for(var i=0;i<=cantidad_radio_no;i++){
              preguntas_rechazadas = $('#rechazoPreg_'+i).html();
                if(preguntas_rechazadas != undefined){
                    array_preg_rechazo.push(preguntas_rechazadas);
                }
                
           }

           var preguntas = JSON.stringify(array_preg_rechazo);

           $('#btn_loading').show();
          $.ajax({                                                
                   url: ruta,
                   data:formData + "&motivo_rechazo="+motivo_rechazo + "&preguntas="+preguntas,
                   method: 'POST',
                   headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  dataType: 'JSON',
                  success: function (data) {
                   
                   $('#btn_loading').hide();
                   if(data.datos == '1'){ 
                    
                     $("#div_rechazo").show().fadeIn(2000).delay(8000).fadeOut(2000);
                    
                      setTimeout(function(){
                      
                        $('#rechazarModal').modal('toggle');

                        }, 2000);

                                               
                      }
                       setTimeout(getAbsolutePath, 3000);
                     
                      $('#btn_enviar_preg_rechazo').prop("disabled",true);
                      $('#rechazar_encuesta').prop("disabled",true);
                                      
                  },
          
                 fail: function(jqXHR, textStatus, errorThrown){ 
                 alert('Error: ' + jqXHR.responseText); 
                 }

            });

    });

//Aprobar Encuesta

 $('#aprobar_encuesta').click(function(event) {

          var formData       = $('#frm').serialize();
          var ruta           ="/enviar/aprobacion_encuesta";
          $('#btn_loading_aprobado').show();  
          
         $.ajax({
                   url: ruta,
                   data:formData,
                   method: 'POST',
                   headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function (data) {
                        
                 $('#btn_loading_aprobado').hide();
                 if(data.datos == '1'){
                   
                    $("#dialog-message").show();
                                                 
                  setTimeout(function(){
                  
                      $("#dialog-message").show().fadeIn(1000).delay(6000).fadeOut(1000);
                      }, 1000);
                       
                   }
                    
                    $('#aprobar_encuesta').prop("disabled",true); 
                    $('#rechazar_encuesta').prop("disabled",true);
                     
                    setTimeout(getAbsolutePath, 2000);
                                         
                  },
          
                 fail: function(jqXHR, textStatus, errorThrown){ 
                 alert('Error: ' + jqXHR.responseText); 
                 }

            });


 });


//Permite que cuando se abra el modal permita asignar el valor de la descripcion que viene
// de base de datos a el campo motivo del modal..
 $("#rechazarModal #motivo_rechazo").val($("#descripcion_motivo").val());

//*****************************************************************************//
   

if ((jQuery('input[type=radio][class=RadioAprobacion]').length) == 0) {
   $('#aprobar_encuesta').prop("disabled", false);
}else{
   $('#aprobar_encuesta').prop("disabled", true);

}
                
});//fin document ready


//permite redireccionar a el home de la aplicacion una vez que rechaze o apruebe la encuesta
function getAbsolutePath() {

    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    var url = loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
    return window.location.href = url + "home";

}