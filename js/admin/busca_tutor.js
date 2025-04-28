    
    $(document).ready(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

    function cancelar(){
        location.reload();
    }

    function busca_tutor(){
      var num_eco = document.getElementById("num_eco").value;

      if(num_eco != ""){
        $.ajax({
          type:"POST",
          url:"../../php/admin/buscaTutor.php",
          data:{num_eco:num_eco,opc:1},
          success:function(r){
            $('#respuesta_no_eco').html(r);
          }
        });
      }
    }


    function ver_lista(trim_bus){
      var num_eco = document.getElementById("num_eco").value;
      var trim = trim_bus;
      if(num_eco != ""){
        $.ajax({
          type:"POST",
          url:"../../php/admin/buscaTutor.php",
          data:{num_eco:num_eco,trim:trim,opc:2},
          success:function(r){
            $('#modal_lista').modal('show'); 
            $('#lista_est').html(r);
          }
        });
      }
    }

    function busca_ri(trim_bus,matri){
      var num_eco = document.getElementById("num_eco").value;
      var trim = trim_bus;
      var matri = matri;
      let newTab = window.open('', '_blank');

      if(num_eco != ""){
        $.ajax({
          type:"POST",
          url:"../../php/admin/buscaTutor.php",
          data:{num_eco:num_eco,trim:trim,matri:matri,opc:3},
          dataType: 'json',
          success:function(response){
            if (response.existe > 0) {
              newTab.location.href = response.url;
              ///window.open(response.url, '_blank');
            }else{
              newTab.close();
              alert("No se encontró algún informe para esta matrícula y trimestre.");
            }
            
          }
        });
      }
    }


