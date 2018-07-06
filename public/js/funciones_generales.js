 function validateEmail(el,id) 
    {
      // FUNCIÓN PARA VALIDAR QUE EL VALOR INGRESADO EN UN INPUT TENGA UN FORMATO DE EMAIL VÁLIDO 
     
      var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      var test_result = re.test($(el).val());
      
      if($(el).val().length == 0)
      {
        $(el).removeAttr('style');
        $(el).parent().find('.required-field-modal-product').hide();
        return true;
      }
        
      if(!test_result)
      {
        $(el).css({"border-color": "#FF0000"});
        $(el).css({"margin-bottom": "20px"});
        $(el).parent().find('.required-field-modal-product').show();
        $('.email_errors_'+id).show();
        return false;
      }
      else
      {
        $(el).removeAttr('style');
        $(el).parent().find('.required-field-modal-product').hide();
        $('.email_errors_'+id).hide();
        return true;
      }
  }

     function validarDecimal(el) 
    {
      // FUNCION PARA VALIDAR QUE EL VALOR INGRESADO EN UN INPUT SEA SOLO NÚMEROS ENTEROS O DECIMALES
      if (event.shiftKey == true) {
        event.preventDefault();
      }
      
      if ((event.keyCode >= 48 && event.keyCode <= 57) || 
        (event.keyCode >= 96 && event.keyCode <= 105) || 
        event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
        event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {
      } else {
        event.preventDefault();
      }

      if($(el).val().indexOf('.') !== -1 && event.keyCode == 190)
      {
        event.preventDefault();
      }
    }