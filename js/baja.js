$(document).ready(function(){
  
  $('[data-toggle="tooltip"]').tooltip();
  busca_trim();
});

      function cancelar(){
          location.reload();
      }

      function busca_trim(){
          $.ajax({
            type:"POST",
            url:"../../php/pro_busca_trim.php",
            ///data:{matri:matri,trimestre:trimestre},
            success:function(r){
              $('#trimestre_res').html(r);
            }
          });
      }

      function buscaEstudiante(){
        var ban=1;
        var matri = document.getElementById("matri").value;
        var trimestre = document.getElementById("trimestre").value;
        if (matri=="") {
         swal("Falta ingresar datos en el formulario","Por favor, ingresa la matrícula a buscar", "warning");
         ban=0;
        }
        if (trimestre=="") {
         swal("Falta ingresar datos en el formulario","Por favor, selecciona el trimestre", "warning");
         ban=0;
        }

        if(ban==1){
          $.ajax({
            type:"POST",
            url:"../../php/pro_busca01.php",
            data:{matri:matri,trimestre:trimestre},
            success:function(r){
              $('#respuesta').html(r);
            }
          });
        }
      }

      
      function actEstudiante(){
        var ban=1;
        var matri = document.getElementById("matri_01").value;
        var edo = $('input[name="estatus"]:checked').val(); 
        var trimestre = document.getElementById("trimestre").value;

        if (matri=="") {
         swal("Falta ingresar datos en el formulario","Por favor, ingresa la matrícula", "warning");
         ban=0;
        }

        if ( $('input[name="estatus"]:checked').length == 0){
          swal("Falta ingresar datos en el formulario","Por favor, ingresa el estatus del estudiante", "warning");
          ban=0;
        }

        if (trimestre=="") {
         swal("Falta ingresar datos en el formulario","Por favor, selecciona el trimestre", "warning");
         ban=0;
        }

        if(ban==1){
          swal({
            title: "¿Son correctos los datos?",
            text: "Por favor, asegúrate de que esté correcto el estatus del estudiante. Haz clic en 'Ok' para actualizar el estatus o en 'Cancelar' para corregir la información.",
            icon: "warning",
            buttons: ["Cancelar", true],
         
          })
          .then((enviarDato) => { 
            if (enviarDato) {  ////// if enviarDato
              $.ajax({
                type:"POST",
                url:"../../php/pro_actEst.php",
                data:{matri:matri,edo:edo,trimestre:trimestre},
                success:function(r){
                  $('#respuesta').html(r);
                }
              });

            }else {
              return false;
            } //// if enviarDato

          });

        } //// if ban 1

      } 