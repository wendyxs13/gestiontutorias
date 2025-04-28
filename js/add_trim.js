    $(document).ready(function(){
      
      ///$('[data-toggle="tooltip"]').tooltip();

    });

    function cancelar(){
        location.reload();
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
    }