    $(document).ready(function(){
      
      $('[data-toggle="tooltip"]').tooltip();

    });

    function cancelar(){
        location.reload();
    }

    function busca_estudiante(){
      var matri = document.getElementById("matri").value;

      if(matri != ""){
        $.ajax({
          type:"POST",
          url:"../../php/admin/buscaEst.php",
          data:{matri:matri,opc:1},
          success:function(r){
            $('#respuesta_matri').html(r);
          }
        });
      }
    }

    function datos_estudiante(){
      var matri = document.getElementById("matri").value;

      if(matri != ""){
        $.ajax({
          type:"POST",
          url:"../../php/admin/buscaEst.php",
          data:{matri:matri,opc:3},
          success:function(r){
            $('#modal_datos_est').modal('show'); 
            $('#datos_x_est').html(r);
          }
        });
      }
    }

    function actual_estudiante(){
      var matri = document.getElementById("matri").value;
      var nom = document.getElementById("nom").value;
      var ap = document.getElementById("ap").value;
      var am = document.getElementById("am").value;

      if (matri === "" || nom === "" || ap === "" ) {
        swal("Datos incompletos", "Por favor completa todos los datos antes de continuar", "warning");
        return;
      }

      swal({
        title: "¿Estás seguro?",
        text: "Verifica que todos los datos sean correctos antes de enviar.",
        icon: "info",
        buttons: ["Cancelar", "Sí, continuar"],
        dangerMode: false,
      }).then((willSave) => {
          if (willSave) {
  
              $.ajax({
                type:"POST",
                url:"../../php/admin/buscaEst.php",
                data:{matri:matri,nom:nom,ap:ap,am:am,opc:4},
                dataType: "json",
                /* success:function(r){
                  $('#modal_datos_est').modal('hide'); 
                  swal("Datos actualizados correctamente", {
                        icon: "success",
                    });
                  $('#datos_x_est').html(r);
                  
                } */
                success: function(response) {

                  if (response.success) {

                   swal({
                      title: "",
                      text: response.message,
                      icon: "success",
                      button: "Aceptar"
                    }).then(() => {
                      $('#modal_datos_est').modal('hide'); 
                      busca_estudiante();
                      // Opcional: recargar datos de la tabla
                      // cargarDatosEstudiantes();
                    });
                  } else {
                    swal("Error", response.message, "error");
                  }
                },
                error: function() {
                  swal("Error", "Hubo un problema al enviar los datos.", "error");
                }

              });
          }
      });
         



      
    } ///fin funcion





/////busca_estudiante
/*  ANTEIROR */ 

/* 
    function busca_trim(){
      var trim = document.getElementById("trim").value;

      if(trim != ""){
        $.ajax({
          type:"POST",
          url:"../../php/pro_edit_trimestre.php",
          data:{trim:trim,opc:1},
          success:function(r){
            $('#respuesta_trim').html(r);
          }
        });
      }
    }

    function edit_trim(){

      var trim = document.getElementById("trim").value;
      var inicio = document.getElementById("inicio").value;
      var fin = document.getElementById("fin").value;
      var habilita = "0";
  
      if ($('#habilita').is(":checked")) {
          habilita = "1";
      }

      var ban=1;

      if(ban==1){
        $.ajax({
          type:"POST",
          url:"../../php/pro_edit_trimestre.php",
          data:{trim:trim,inicio:inicio,fin:fin,habilita:habilita,opc:2},
          success:function(r){
            $('#respuesta').html(r);
          }
        });
      }
      
    }





    function add_trim(){
      var ban=1;
      var sig = document.getElementById("sig").value;
      var inicio = document.getElementById("inicio").value;
      var fin = document.getElementById("fin").value;
      var actual = document.getElementById("actual").value;

      if (sig=="") {
       swal("Falta ingresar datos en el formulario","Por favor, selecciona el trimestre", "warning");
       ban=0;
      }
      if (inicio=="") {
       swal("Falta ingresar datos en el formulario","Por favor, ingresa la fecha de inicio", "warning");
       ban=0;
      }
      if (fin=="") {
       swal("Falta ingresar datos en el formulario","Por favor, ingresa la fecha de finalización", "warning");
       ban=0;
      }

      if(ban==1){
        $.ajax({
          type:"POST",
          url:"../../php/pro_add_trimestre.php",
          data:{sig:sig,inicio:inicio,fin:fin,actual:actual},
          success:function(r){
            $('#respuesta').html(r);
          }
        });
      }
    } */