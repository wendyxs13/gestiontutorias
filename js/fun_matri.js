$(document).ready(function() {
  $('#formulario1').hide();
});


function enviarm(){
    var ban = 1;
    var matricula = document.getElementById("matricula").value;

    if (matricula=="") {
       swal("Faltan datos en el formulario","Por favor, ingresa tu matrícula", "warning");
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
      $('#formulario1').html('<br><br><img src="img/procesando.gif" alt="Enviando información"><br>Enviando información');
      $.ajax({
        type: 'POST',
        url: 'php/pro_matri.php',
        //data: {matricula:matricula, response: grecaptcha.getResponse()},
        data: formData,
        success: function(r){
          $('#formlogin').show();
          $('#formulario1').html(r);
          console.log(r);
        }
      });



    }else{
       return false;
    }

  }


  function enviar_ri(){
    var ban = 1;
    var ap = document.getElementById("ap").value;
    var am = document.getElementById("am").value;
    var nombre = document.getElementById("nom").value;
    var matricula = document.getElementById("matricula").value;
    var correo = document.getElementById("correo").value;

    if (ap=="") {
       swal("Faltan datos en el formulario","Por favor, ingresa tu primer apellido", "warning");
       ban=0;
    }

    if (am=="") {
       swal("Faltan datos en el formulario","Por favor, ingresa tu segundo apellido", "warning");
       ban=0;
    }

    if (nombre=="") {
       swal("Faltan datos en el formulario","Por favor, ingresa tu nombre", "warning");
       ban=0;
    }

    if (matricula=="") {
       swal("Faltan datos en el formulario","Por favor, ingresa tu matrícula", "warning");
       ban=0;
    }
    if (correo=="") {
       swal("Faltan datos en el formulario","Por favor, ingresa tu correo electrónico", "warning");
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
        url: '../php/pro_reg_inicial.php',
        data: {matricula:matricula,ap:ap,am:am,nom:nombre,correo:correo,response: grecaptcha.getResponse()},
        //data: formData,
        success: function(r){
          $('#formlogin').hide();
          $('#formulario1').show();
          $('#formulario1').html(r);
          console.log(r);
        }
      }); 

    }else{
       return false;
    }

  }