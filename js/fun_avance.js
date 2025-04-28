function avance_ind(matri) {
    const url = new URL(location);
    const params = url.searchParams; 
    const trim_inf = params.get("x");

    $('#resp_avance').html('<h5>&nbsp;&nbsp;&nbsp;Buscando información...</h5>');
    $.ajax({
        type: 'POST',
        url: '../../php/pro_avance.php',
        data: {con: 1, matri: matri, trim_inf: trim_inf},
        success: function (r) {
            //alert(r)
            if (r == 'new') {
                location.href = "form_inf_ind.php?x="+trim_inf;
            } else {
                location.href = "form_inf_ind_edit.php?x="+trim_inf;
            }
        }
    });
}

function descargar_ind(matri) {
    
    const url = new URL(location);
    const params = url.searchParams; 
    const trim_inf = params.get("x");

    $('#resp_avance').html('<h5>&nbsp;&nbsp;&nbsp;Buscando información...</h5>');
    $.ajax({
        type: 'POST',
        url: '../../php/pro_avance.php',
        data: {con: 1, matri: matri, trim_inf: trim_inf},
        success: function (r) {
            //alert(r)
            if (r == 'new') {
                ///location.href = "form_inf_ind.php?x="+trim_inf;
                swal("Informe individual no encontrado","Antes de descargar, es necesario generar el informe correspondiente.", "warning");
            } else {
                $.ajax({
                    type: 'POST',
                    url: '../../modulo/tutor/form_inf_ind_all.php?x='+trim_inf,
                    data: {matri: matri},
                    success: function (r2) {
                        //alert(r2);
                        $('#avance_01').modal('show'); 
                        $('#resp_avance').html(r2);
                        $('#resp_avance').scrollTop(0);
                    }
                });
            }
        }
    });
}

function avance_grupal() {
    const url = new URL(location);
    const params = url.searchParams; 
    const trim_inf = params.get("x");
    //$('#resp_avance').html('<h5>&nbsp;&nbsp;&nbsp;Buscando información...</h5>');
    $.ajax({
        type: 'POST',
        url: '../../php/pro_agrupal.php',
        data: {trim_inf:trim_inf},
        success: function (r) {
            //alert(r)
            if (r == 'new') {
                ///location.href = "form_grupal_secc.php?x="+trim_inf;
                swal("Informe grupal no encontrado","Antes de descargar, es necesario generar el informe correspondiente.", "warning");
            } else {
                $.ajax({
                    type: 'POST',
                    url: '../../modulo/tutor/form_grupal_view.php',
                    data: {trim_inf:trim_inf},
                    success: function (r2) {
                        //alert(r2); 
                        $('#avance_01').modal('show');
                        $('#resp_avance').html(r2);
                        $('#resp_avance').scrollTop(0);
                    }
                });
            }
        }
    });
}

function busca_constancia() {
    const url = new URL(location);
    const params = url.searchParams; 
    const trim_inf = params.get("x");
    $('#resp_avance').html('<h5>&nbsp;&nbsp;&nbsp;Buscando información...</h5>');
    $.ajax({
        type: 'POST',
        url: '../../php/pro_constancia.php',
        data: {trim_inf:trim_inf},
        success: function (r) {
            ///alert(r);
            if (r == '1') {
                $('#resp_constancia').load('constancia_trimestral_1.php?x='+trim_inf);
            }else if((r == '2') || (r == '3') ){ 
                $('#resp_constancia').load('datos_constancia.php?x='+trim_inf);
                $('#constancia').modal('show');
            } else{
                $('#resp_constancia').html("<h5 class='mt-4 mb-5'>Para descargar tu constancia, primero debes completar el informe trimestral grupal o individual de los estudiantes que te han sido asignados. Una vez que hayas finalizado el informe o los informes correspondientes, podrás acceder a la descarga de tu constancia.</h5>");
                $('#constancia').modal('show');
            }
        }
    });
}


function quita_est_modal(element) {
    const url = new URL(location);
    const params = url.searchParams; 
    const trim_inf = params.get("x");
    const nombre = $(element).data('nom_est');
    const matri = $(element).data('matri');

    $('#nombreEstudiante').text(nombre);
    $('#confirmarQuitar').data('matri', matri);
    $('#modal_quita').modal('show');
}

$('#confirmarQuitar').on('click', function () {
    const url = new URL(location);
    const params = url.searchParams; 
    const trim_inf = params.get("x");
    const matri = $(this).data('matri');
    $.ajax({
        type: 'POST',
        url: '../../php/pro_quita_est_tutor.php',
        data: {matri: matri, trim_inf: trim_inf},
        success:function(r){
            if(r == 1 ){
                swal({
                  title: '',
                  text: "El estudiante seleccionado ha sido quitado de la lista correctamente.",
                  type: 'success',
                  confirmButtonColor: '#17a2b8',
                  confirmButtonText: 'Continuar'
                }).then(function() {
                  $('#modal_quita').modal('hide');
                  location.reload();
                })

            }else{
                swal("Error", "Hubo un problema al intentar quitar al estudiante de la lista.", "error");
                $('#modal_quita').modal('hide');
                location.reload();
            }
        }
    });
});



function div_dpto(){
    var division = $('#division').val();
    //var division = document.getElementById("division").value;

    $('#d_dpto').html('Cargando lista de departamentos...');
    $.ajax({
      type:"POST",
      url:"../../php/pro_divi_dpto_bd.php",
      data:{division:division,con:1},
      success:function(r){
        $('#d_dpto').html(r);
      }
    });
  }


  function act_tutor(){
    var ban = 1;
    var ap = document.getElementById("ap").value;
    var am = document.getElementById("am").value;
    var nombre = document.getElementById("nom").value;
    ///var estudios = document.getElementById("estudios").value;
    var division = document.getElementById("division").value;
    var dpto = document.getElementById("dpto").value;
    //var imparte = document.getElementById("imparte").value;
    var sexo = $("input[type=radio][name=radio5]:checked").val();
    var continuar = $("input[type=radio][name=continuar]:checked").val();
    var otro = document.getElementById("otro_con").value;

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

    // if (estudios=="") {
    //    swal("Faltan datos en el formulario","Por favor, ingrese sus estudios que tiene a nivel licenciatura", "warning");
    //    ban=0;
    // }

    if (division=="") {
       swal("Faltan datos en el formulario","Por favor, ingrese su división Académica", "warning");
       ban=0;
    }

    if (dpto=="") {
       swal("Faltan datos en el formulario","Por favor, ingrese su departamento de adscripción", "warning");
       ban=0;
    }

    // if (imparte=="") {
    //    swal("Faltan datos en el formulario","Por favor, ingrese la licenciatura en que imparte docencia", "warning");
    //    ban=0;
    // }

    if (continuar=="") {
       swal("Faltan datos en el formulario","Por favor, responda su participacipación en el programa de tutoría", "warning");
       ban=0;
    }

    
    if(ban==1){
      var formData = $('#form_datos_tutor').serialize();
      $('#form_datos_tutor').hide();
      $('#resp_constancia').html('<br><br><img src="../img/procesando.gif" alt="Enviando información"><br>Enviando información');
 
      $.ajax({
        type: 'post',
        url: '../../php/pro_datos_tutor.php',
        //data: {matricula:matricula,ap:ap,am:am,nom:nombre,correo:correo,response: grecaptcha.getResponse()},
        data: formData,
        success: function(r){
          $('#form_datos_tutor').hide();
          ///$('#resp_constancia').show();
          $('#resp_constancia').html(r);
        }
      }); 

    }else{
       return false;
    }

  }


  function des_constancia(){
    const url = new URL(location);
    const params = url.searchParams; 
    const trim_inf = params.get("x");
    $('#constancia').modal('hide');
    location.href = "constancia_trimestral_1.php?x="+trim_inf;
  } 