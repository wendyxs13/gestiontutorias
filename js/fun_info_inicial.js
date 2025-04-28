function ver_info_ini(matri){

    
    $('#resp_inf_inicial').html('<br>Buscando información');
      $.ajax({
        type: 'POST',
        url: '../../php/pro_info_inicial.php',
        data: {con:1, matri:matri},
        success: function(r){
          $('#resp_inf_inicial').html(r);
        }
    });


}