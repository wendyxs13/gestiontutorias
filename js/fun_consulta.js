
$(document).ready(function() {
  $('#div1').hide();
  $('#div2').hide();
  $('#div3').hide();

  $('#secc_2').hide();
  $('#secc_3').hide();
  $('#secc_4').hide();
  ///$('#div_tabla').hide();

  if ($('input[name="falta"]:checked').val() == "si") {
    $('#div3').show();
  }

  if ($('input[name="tuto_ind"]:checked').val() == "si") {
    $('#div1').show();
  }

  if ($('input[name="participa"]:checked').val() == "6") {
    $('#div2').show();
  }



});


////// $('#gSesion').on('click', function () {

function guardarSesion(){

    const fs_1 = $('#fs_1').val();
    const ds_1 = $('#ds_1').val();
    const ts_1 = $('#ts_1').val();
    const ms_1 = $('#ms_1').val();
    const url = new URL(location);
    const params = url.searchParams; 
    const trim_inf = params.get("x");

    if (!fs_1 || !ds_1 || !ts_1 || !ms_1) {
        swal("", "Faltan datos por ingresar", "warning");
        return;
    } 

    $.ajax({
        type: 'POST', 
        url: '../../php/pro_tutoria_g2.php', 
        data: {
            fs_1: fs_1,
            ds_1: ds_1,
            ts_1: ts_1,
            ms_1: ms_1,
            trim_inf: trim_inf
        },
        success: function (response) {
          if(response == 1){
            console.log(response);
            t_sesiones(); 
            swal("", "Los datos de las sesiones de tutoría se agregaron correctamente", "success");
            $('#mod_sesiones2').modal('hide');
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            
            // Aquí puedes actualizar la tabla o la vista si es necesario
          }else{
            swal("Problemas al guardar", "verifica ingresar correctamente tus datos", "warning");
          }

            
        }
    });
  }

  function actSesion(){
    const fs_1 = $('#fs').val();
    const ds_1 = $('#ds').val();
    const ts_1 = $('#ts').val();
    const ms_1 = $('#ms').val();
    const dato = $('#dato').val();
    
    if (!fs_1 || !ds_1 || !ts_1 || !ms_1) {
        swal("", "Faltan datos por ingresar", "warning");
        return;
    } 

    $.ajax({
        type: 'POST', 
        url: '../../php/pro_tutoria_act2.php', 
        data: {
            fs_1: fs_1,
            ds_1: ds_1,
            ts_1: ts_1,
            ms_1: ms_1,
            dato: dato
        },
        success: function (response) {
          if(response == 1){
            console.log(response);
            t_sesiones(); 
            swal("", "Los datos de las sesiones de tutoría se actualizaron correctamente", "success");
            $('#mod_sesiones').modal('hide');
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            
            // Aquí puedes actualizar la tabla o la vista si es necesario
          }else{
            swal("Problemas al guardar", "verifica ingresar correctamente tus datos", "warning");
          }

            
        }
    });
  }

function secc_g01(){
  var total = $('#est_asig').val();
  var formData = $('#formulario_secc1').serialize();
  var ban = 0;
  var dVacio = "";

  for (let i = 1; i <= total; i++) {
    if( $('#trim_'+i).val() == "" ){
      ban = ban +1;
      dVacio = dVacio +"\n"+"Fila "+i;
    }
  }

  $.ajax({
    type: 'POST',
    url: '../../php/pro_tutoria_g1.php',
    data: formData,
    success: function(response){
      //console.log(response);
      if(response == 1){
        $('#secc_2').show(700);
        $('#secc_1').hide();
        $('#secc_3').hide();
        $('#secc_4').hide();
      }else{
        swal("Problemas al guardar", "verifica ingresar correctamente tus datos", "warning");
      }
    }
  });   
}


function secc_g02(){
  var total = $('#n_sesion').val();
  var formData = $('#formulario_secc2').serialize();
  var ban = 0;
  var dVacio = "";

  for (let i = 1; i <= total; i++) {
    if( ($('#fs_'+i).val() == "") || ($('#ds_'+i).val() == "") || ($('#ts_'+i).val() == "") || ($('#ms_'+i).val() == "") ) {
      ban = ban +1;
      dVacio = dVacio +"\n"+"Sesión "+i;
    }
  }

  if(ban == 0){
    $.ajax({
      type: 'POST',
      url: '../../php/pro_tutoria_g2.php',
      data: formData,
      success: function(response){
        //console.log(response);
        if(response == 1){
          //swal("ok", "ok", "success");
          $('#secc_3').show(700);
          $('#secc_1').hide();
          $('#secc_2').hide();
          $('#secc_4').hide();

        }else{
          swal("Problemas al guardar", "verifica ingresar correctamente tus datos", "warning");
        }
      }
    }); 

  }else{
    swal({
      title: "Faltan datos por ingresar",
      text: dVacio,
      icon: "warning",
    });

  } 
}

function secc_g03(){
  var formData = $('#formulario_secc3').serialize();
  var ban = 0;
  var dVacio = "";
  var dVacio2 = "";
  var req_tutoria = 0;
  var fal_tutoria = 0;
  req_tutoria = $("input[type=radio][name=tuto_ind]:checked").val();
  fal_tutoria = $("input[type=radio][name=falta]:checked").val();

  if (!fal_tutoria){ 
    dVacio = dVacio +"\n"+"¿Algún alumno o alumna faltó a las sesiones de tutoría?";
   /// dVacio2 = "¿Algún alumno o alumna faltó a las sesiones de tutoría?";
  }

  if(fal_tutoria == "si"){
    /////if (!$('input[type=checkbox]').is(":checked")) {
    if (!$("input[type=checkbox][name='falta_est[]']:checked").val()){ 
      dVacio = dVacio +"\n"+"- Nombre o nombres del estudiantado que faltó";
    }
  }   

  if (!req_tutoria){ 
    dVacio = dVacio +"\n"+"¿Considera que alguna de las personas tutoradas requiere tutoría individualizada?";
  }

  if(req_tutoria == "si"){
    if (!$("input[type=checkbox][name='req_est[]']:checked").val()){ 
      dVacio = dVacio +"\n"+"- Nombre o nombres del estudiantado que requiere la tutoría individualizada";
    }

    if ($('#req_pq').val() == ""){
       dVacio = dVacio +"\n"+"- ¿Por qué considera que los estudiantes seleccionados requieren tutoría individualizada?";
    }

    if (!$("input[type=radio][name=tuto_rea]:checked").val()){ 
      dVacio = dVacio +"\n"+"¿Usted podría brindar la tutoría personalizada?";
    }
  }

  if(dVacio == ""){
    $.ajax({  //ajax
      type: 'POST',
      url: '../../php/pro_tutoria_g3.php',
      data: formData,
      success: function(response){
        if(response == 1){
          $('#secc_4').show(700);
          $('#secc_1').hide();
          $('#secc_2').hide();
          $('#secc_3').hide();

        }else{
          swal("Problemas al guardar", "verifica ingresar correctamente tus datos", "warning");
        }
      }
    }); //ajax
    
  }else{
    swal({
      title: "Faltan datos por ingresar",
      text: dVacio,
      icon: "warning",
    });
  }
}


function secc_g04(){
  const url = new URL(location);
  const params = url.searchParams; 
  const trim_inf = params.get("x");

  var formData = $('#formulario_secc4').serialize();
  var ban = 0;
  var dVacio = "";
  var participa = 0;
  participa = $("input[type=radio][name=participa]:checked").val();

  if (!participa){ 
    dVacio = dVacio +"\n"+"- Participación en el Programa Institucional de Tutoría ";
  }

  if(participa == "6"){

    dVacio = "";
    if ($('#txtOtro').val() == ""){
       dVacio = dVacio +"\n"+"- Otro tipo de participación";
    }

  }

  if(dVacio == ""){
    $.ajax({  //ajax
      type: 'POST',
      url: '../../php/pro_tutoria_g4.php',
      data: formData,
      success: function(response){
        console.log(response);
        if(response == 1){
          //// swal("¡Gracias!", "Informe completado", "success");
          swal({
              title: "¡Gracias por su interés en el Programa Institucional de Tutorías!",
              text: "El informe grupal ha sido completado.",
              icon: "success",
              type: "success"
          }).then(function() {
              window.location = "index_trim.php?x="+trim_inf+"'";
          });

        }else{
          swal("Problemas al guardar", "verifica ingresar correctamente tus datos", "warning");
          $('#secc_3').show(700);
          $('#secc_1').hide();
          $('#secc_2').hide();
          $('#secc_4').hide();
          //location.reload();
        }
      }
    }); //ajax
    
  }else{
    swal({
      title: "Faltan datos por ingresar",
      text: dVacio,
      icon: "warning",
    });
  }
}

function secc_01(){
    $('#secc_1').show(700);
    $('#secc_2').hide();
    $('#secc_3').hide();
    $('#secc_4').hide();
}


function secc_02(){
    $('#secc_2').show(700);
    $('#secc_1').hide();
    $('#secc_3').hide();
    $('#secc_4').hide();
}


function secc_03(){
    $('#secc_3').show(700);
    $('#secc_1').hide();
    $('#secc_2').hide();
    $('#secc_4').hide();
}

function secc_04(){
    $('#secc_4').show(700);
    $('#secc_1').hide();
    $('#secc_2').hide();
    $('#secc_3').hide();
}

  function addSesion(){
    var num = 0;
    var n_sesion = 0;
    var n_sesion = parseInt($("#n_sesion").val());
    var num = parseInt(n_sesion+1);
    document.getElementById("n_sesion").value = num;
    $('#table_sesion').append('<tr>'+
    '<td class="text-center">'+num+'</td>'+
    '<td class="text-center"><input type="date" class="form-control" id="fs_'+num+'" name="fs_'+num+'" placeholder=""></td>'+
    '<td class="text-center">'+
      '<select name="ds_'+num+'" id="ds_'+num+'" class="custom-select " >'+
        '<option value=""></option>'+
        '<option value="1">1 hora</option>'+
        '<option value="2">2 horas</option>'+
        '<option value="3">3 horas</option>'+
        '<option value="4">4 horas</option>'+
        '<option value="5">5 horas</option>'+
        '<option value="6">6 horas</option>'+
      '</select>'+
    '</td>'+
    '<td class="text-center"><input type="text" class="form-control" id="ts_'+num+'" name="ts_'+num+'" placeholder=""></td>'+
    '<td class="text-center">'+
      '<select name="ms_'+num+'" id="ms_'+num+'" class="custom-select " >'+
        '<option value=""></option>'+
        '<option value="1">Presencial</option>'+
        '<option value="2">Remota</option>'+
      '</select>'+
    '</td>'+
    '</tr>');
  }
  
  function s_otro(op){
    $('#div'+op).show(700);
  }

  function h_otro(op){
    $('#div'+op).hide(700);
  }

  function consulta(tipo){
    var con = 1;
    if(con==1){
      $('#mconsulta').html('<br>Buscando información');
      $.ajax({
        type: 'POST',
        url: '../php/muestra_info.php',
        data: {con:1, tipo:tipo},
        success: function(r){
          
          $('#mconsulta').html(r);
        }
      });

    }else{
       return false;
    }
  }

  function t_sesiones(){
    const url = new URL(location);
    const params = url.searchParams; 
    const trim_inf = params.get("x");

    $.ajax({
      type: 'POST',
      url: '../../php/pro_tsesiones.php',
      data: { trim_inf: trim_inf },
      success: function(r){
        $('#mconsulta').html(r);

        /* if(r == 0){
          $('#div_tabla').show(700);
          $('#btn_seccg2').show(700);
          //$('#btn_secc3').hide();
        }else{
          $('#mconsulta').html(r);
          $('#btn_secc3').show(700);
          ///$('#btn_seccg2').hide(); 
        }*/
      }
    });

  }

  function muestra_sesion(datos){
    const url = new URL(location);
    const params = url.searchParams; 
    const trim_inf = params.get("x");

    $.ajax({
      type: 'POST',
      url: '../../php/pro_tsesiones_editar.php',
      data: { trim_inf: trim_inf,datos:datos},
      success: function(r){
        $('#modal_editar').html(r);

        /* if(r == 0){
          $('#div_tabla').show(700);
          $('#btn_seccg2').show(700);
          //$('#btn_secc3').hide();
        }else{
          $('#mconsulta').html(r);
          $('#btn_secc3').show(700);
          ///$('#btn_seccg2').hide(); 
        }*/
      }
    });

  }



  function muestra_dt(){
    $('#div_tabla').show(700);
    $('#btn_asesion').hide();
  }

