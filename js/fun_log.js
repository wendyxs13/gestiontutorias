$(document).ready(function() {
  $('#formulario1').hide();
});

function enviarl(){
    var ban = 1;
    var email = document.getElementById("email").value;
    var pass = document.getElementById("pass").value;
   

    if (email=="") {
       swal("Faltan datos en el formulario","Por favor, ingresa tu cuenta de correo electrónico", "warning");
       ban=0;
    }
    if (pass=="") {
       swal("Faltan datos en el formulario","Por favor, ingresa tu contraseña", "warning");
       ban=0;
    }

    if(ban==1){
      $('#formlogin').hide();
      $('#formulario1').html('<br><br><img src="img/procesando.gif" alt="Enviando información"><br>Enviando información');
      $.ajax({
        type: 'POST',
        url: 'php/pro_login.php',
        data: {email:email,pass:pass},
        success: function(r){
          $('#formlogin').show();
          $('#formulario1').html(r);
        }
      });

    }else{
       return false;
    }

  }