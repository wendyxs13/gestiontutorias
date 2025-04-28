
  $(document).ready(function() {
    $('#formulario1').hide();
  });



  function div_dpto(){
    var division = $('#division').val();
    //var division = document.getElementById("division").value;

    $('#d_dpto').html('Cargando lista de departamentos...');
    $.ajax({
      type:"POST",
      url:"../php/pro_divi_dpto.php",
      data:{division:division,con:1},
      success:function(r){
        $('#d_dpto').html(r);
      }
    });
  }


  function reg_tutor(){
    var ban = 1;
    var ap = document.getElementById("ap").value;
    var am = document.getElementById("am").value;
    var nombre = document.getElementById("nom").value;
    var economico = document.getElementById("economico").value;
    var estudios = document.getElementById("estudios").value;
    var division = document.getElementById("division").value;
    var dpto = document.getElementById("dpto").value;
    var imparte = document.getElementById("imparte").value;
    var correo = document.getElementById("correo").value;
    var num_tutoria = document.getElementById("num_tutoria").value;
    var sexo = $("input[type=radio][name=radio5]:checked").val();

    if (ap=="") {
       swal("Faltan datos en el formulario","Por favor, ingrese su primer apellido", "warning");
       ban=0;
    }

    if (am=="") {
       swal("Faltan datos en el formulario","Por favor, ingrese su segundo apellido", "warning");
       ban=0;
    }

    if (nombre=="") {
       swal("Faltan datos en el formulario","Por favor, ingrese su nombre", "warning");
       ban=0;
    }

    if (!sexo){ 
       swal("Faltan datos en el formulario","Por favor, ingrese su sexo asignado al nacer", "warning");
       ban=0;
    }

    if (economico=="") {
       swal("Faltan datos en el formulario","Por favor, ingrese su número económico", "warning");
       ban=0;
    }
    if (estudios=="") {
       swal("Faltan datos en el formulario","Por favor, ingrese sus estudios que tiene a nivel licenciatura", "warning");
       ban=0;
    }

    if (division=="") {
       swal("Faltan datos en el formulario","Por favor, ingrese su división Académica", "warning");
       ban=0;
    }

    if (dpto=="") {
       swal("Faltan datos en el formulario","Por favor, ingrese su departamento de adscripción", "warning");
       ban=0;
    }

    if (imparte=="") {
       swal("Faltan datos en el formulario","Por favor, ingrese la licenciatura en que imparte docencia", "warning");
       ban=0;
    }

    if (correo=="") {
       swal("Faltan datos en el formulario","Por favor, ingrese su correo electrónico", "warning");
       ban=0;
    }
    if (num_tutoria=="") {
       swal("Faltan datos en el formulario","Por favor, ingrese el número de tutoradas y tutorados que puede atender por trimestre", "warning");
       ban=0;
    }

    var response = grecaptcha.getResponse();
    if(response.length == 0) 
    { 
      //reCaptcha not verified
      swal("Faltan datos en el formulario","Para continuar, verifica el captcha.", "warning");
      //evt.preventDefault();
      ban=0;
    }
    
    if(ban==1){
      var formData = $('#formlogin').serialize();
      $('#formlogin').hide();
      $('#formulario1').html('<br><br><img src="../img/procesando.gif" alt="Enviando información"><br>Enviando información');
 
      $.ajax({
        type: 'post',
        url: '../php/pro_reg_tutor.php',
        //data: {matricula:matricula,ap:ap,am:am,nom:nombre,correo:correo,response: grecaptcha.getResponse()},
        data: formData,
        success: function(r){
          $('#formlogin').hide();
          $('#formulario1').show();
          $('#formulario1').html(r);
        }
      }); 

    }else{
       return false;
    }

  }