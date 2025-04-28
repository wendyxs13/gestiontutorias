
  function s_otro(op){
    $('#div'+op).show(700);
  }

  function h_otro(op){
    $('#div'+op).hide(700);
  }

  function select_otro(lis,divs,op){
    var lista = $("#txt"+lis).val();
    if(lista == op){
      $('#div'+divs).show(700);
    }else{
      $('#div'+divs).hide(700);
    }
  }

  function lista_duda1(){
    var lista = $("#txt25").val();
    if(lista == "5"){
      $('#div7').show(700);
      $('#div8').hide();
    }else if(lista == "6"){
      $('#div7').hide();
      $('#div8').show(700);
    }else{
      $('#div7').hide();
      $('#div8').hide();
    }
  }

  function lista_duda2(){
    var lista = $("#txt28").val();
    if(lista == "4"){
      $('#div9').show(700);
      $('#div10').hide();
    }else if(lista == "5"){
      $('#div9').hide();
      $('#div10').show(700);
    }else{
      $('#div9').hide();
      $('#div10').hide();
    }
  }

  function lista_sesion(){
    var lista = $("#txt40").val();
    if(lista == "6"){
      $('#div15').show(700);
    }else{
      $('#div15').hide();
    }
  }

  function check_otro(chk,divs){
    if( $('#check'+chk).is(':checked') ) {
      $('#div'+divs).show(700);
    }else{
      $('#div'+divs).hide(700);
    } 
  }

  function s_otro1(op1,op2){
    $('#div'+op1).show(700);
    $('#div'+op2).hide(700);
  }

$(document).ready(function() {
  $('#div1').hide();
  $('#div2').hide();
  $('#div3').hide();
  $('#div4').hide();
  $('#div5').hide();
  $('#div6').hide();
  $('#div7').hide();
  $('#div8').hide();
  $('#div9').hide();
  $('#div10').hide();
  $('#div11').hide();
  $('#div12').hide();
  $('#div13').hide();
  $('#div14').hide();
  $('#div15').hide();
  $('#formulario1').hide();

  // $(document).on('submit', '#formulario', function(event) {
  //   event.preventDefault();
  //   });
});

function enviarDatos1(){
    /// 1 = Texto | 2=Radio | 1 =lista | 4 = checkbox
    ///---const etiquetas = ["1-Nombre", "1-Primer Apellido", "1-Segundo Apellido", "1-Matrícula", "1-Correo electrónico", "1-Estado Civil", "2-Sexo", "1-Edad", "2-Dependientes económicos", "1-Número de dependientes económicos", "2-¿Actualmente trabajas?", "1-¿En qué trabajas?", "1-Asegúrate de ingresar tu promedio académico en escala del 1 al 10", "1-¿Cuál es la escolaridad que tiene tu madre?", "1-¿Cuál es la escolaridad que tiene tu padre?", "1-¿Qué te motivó a estudiar en la UAM Xochimilco?", "1-Especifica, ¿qué te  motivó a estudiar en la UAM Xochimilco?", "1-¿Qué licenciatura cursas?", "1-¿Cuántas horas al día después de la escuela dedicas a estudiar y hacer tareas?", "1-¿De qué manera resuelves tus dudas?", "1-Especifica en qué medios investigas", "1-¿Por qué no haces nada respecto a tus dudas?", "1-¿De qué manera resuelves tus dudas sobre los trámites escolares ?", "1-Especifica en qué medios investigas sobre los trámites escolares ", "1-¿Por qué no haces nada respecto a tus dudas sobre los trámites escolares ?", "4-Recursos con los que cuentas para tu estudio", "1-Específica otros recursos con los que cuentas para tu estudio", "4-¿Qué espacio de tu hogar destinas para hacer tus tareas?", "1-Especifica qué otro espacio de tu hogar destinas para hacer tus tareas:", "4-¿Qué espacio externo a tu hogar destinas para hacer tus tareas?",  "1-Especifica qué espacio externo a tu hogar destinas para hacer tus tareas:", "2-¿Practicas alguna actividad extra escolar?", "1-¿Qué esperas de las sesiones de tutoría?", "1-Especifica qué esperas de las sesiones de tutoría"];
    
    const etiquetas = ["1-Nombre", "1-Matrícula", "1-Correo electrónico", "1-Estado Civil", "2-Sexo", "1-Edad", "2-Hijos", "2-Dependientes económicos", "1-Número de dependientes económicos", "2-¿Actualmente trabajas?", "1-¿En qué trabajas?", "1-Asegúrate de ingresar tu promedio académico en escala del 1 al 10", "2-¿Eres beneficiario(a) de alguna beca?", "1-¿Cuál es la beca con la que cuentas?", "1-¿Cuál es la escolaridad que tiene tu madre?", "1-¿Cuál es la escolaridad que tiene tu padre?", "1-¿Qué te motivó a estudiar en la UAM Xochimilco?", "1-Especifica, ¿qué te  motivó a estudiar en la UAM Xochimilco?", "1-¿Qué licenciatura cursas?", "1-¿Por qué elegiste esa licenciatura?", "1-Específica, ¿por qué elegiste esa licenciatura?", "2-¿Conoces el campo laboral de tu carrera?", "1-Menciona el campo laboral de tu carrera", "1-¿Cuántas horas al día fuera de tus clases dedicas a estudiar y a realizar tareas?", "1-¿De qué manera resuelves tus dudas?", "1-Especifica en qué medios investigas", "1-¿Por qué no haces nada respecto a tus dudas?", "1-¿De qué manera resuelves tus dudas sobre los trámites escolares ?", "1-Especifica en qué medios investigas sobre los trámites escolares", "1-¿Por qué no haces nada respecto a tus dudas sobre los trámites escolares?", "4-Recursos con los que cuentas para tu estudio", "1-Específica otros recursos con los que cuentas para tu estudio", "4-¿Qué espacio de tu hogar destinas para hacer tus tareas?", "1-Especifica qué otro espacio de tu hogar destinas para hacer tus tareas:", "4-¿Qué espacio externo a tu hogar destinas para hacer tus tareas?",  "1-Especifica qué espacio externo a tu hogar destinas para hacer tus tareas:", "2-¿Practicas alguna actividad extra escolar?", "1-¿Cuál actividad extra escolar practicas?", "2-¿Dónde practicas tu actividad extra escolar?", "1-¿Qué esperas de las sesiones de tutoría?", "1-Especifica qué esperas de las sesiones de tutoría", "1-¿En qué turno estás inscrito?"];


    //const etiquetas = ["1-Nombre", "1-Matrícula", "1-Correo electrónico", "1-Estado Civil", "2-Sexo", "1-Edad", "2-Dependientes económicos", "1-Número de dependientes económicos", "2-¿Actualmente trabajas?", "1-¿En qué trabajas?", "1-Asegúrate de ingresar tu promedio académico en escala del 1 al 10", "1-¿Cuál es la escolaridad que tiene tu madre?", "1-¿Cuál es la escolaridad que tiene tu padre?", "1-¿Qué te motivó a estudiar en la UAM Xochimilco?", "1-Especifica, ¿qué te  motivó a estudiar en la UAM Xochimilco?", "1-¿Qué licenciatura cursas?", "1-¿Cuántas horas al día después de la escuela dedicas a estudiar y hacer tareas?", "1-¿De qué manera resuelves tus dudas?", "1-Especifica en qué medios investigas", "1-¿Por qué no haces nada respecto a tus dudas?", "1-¿De qué manera resuelves tus dudas sobre los trámites escolares ?", "1-Especifica en qué medios investigas sobre los trámites escolares ", "1-¿Por qué no haces nada respecto a tus dudas sobre los trámites escolares ?", "4-Recursos con los que cuentas para tu estudio", "1-Específica otros recursos con los que cuentas para tu estudio", "4-¿Qué espacio de tu hogar destinas para hacer tus tareas?", "1-Especifica qué otro espacio de tu hogar destinas para hacer tus tareas:", "4-¿Qué espacio externo a tu hogar destinas para hacer tus tareas?",  "1-Especifica qué espacio externo a tu hogar destinas para hacer tus tareas:", "2-¿Practicas alguna actividad extra escolar?", "1-¿Qué esperas de las sesiones de tutoría?", "1-Especifica qué esperas de las sesiones de tutoría"];
    var num = 1;
    var dVacio = "";
    
    for (let value of etiquetas) {
      var tipo = "";
      var info = "";
      const cadena = value;
      const arrayCadenas = cadena.split('-', 2);

      tipo = arrayCadenas[0];
      info = arrayCadenas[1];

      if(tipo == "1"){

        /* if((  $('#txt'+num).val() == "") && (num != "9") && (num != "11") && (num != "12") && (num != "14") && (num != "18") && (num != "21") && (num != "23") && (num != "26") && (num != "27")  && (num != "29") && (num != "30") && (num != "32") && (num != "34") && (num != "36")  && (num != "38") && (num != "39")  && (num != "41") ){
          dVacio = dVacio +"\n"+info;
        } */
        if((  $('#txt'+num).val() == "") && (num != "9") && (num != "11") && (num != "14") && (num != "18") && (num != "21") && (num != "23") && (num != "26") && (num != "27")  && (num != "29") && (num != "30") && (num != "32") && (num != "34") && (num != "36")  && (num != "38") && (num != "39")  && (num != "41") ){
          dVacio = dVacio +"\n"+info;
        }
 
        if( (num == "9") && ($('input[name="radio8"]:checked').val() == "si") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "11") && ($('input[name="radio10"]:checked').val() == "si") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

       /* if(num == "12"){
          var prom = ($('#txt12').val());
          promedio = Math.ceil(prom, 1);
          if( ($('#txt'+num).val() == "") || (  (promedio > 10) || (promedio < 1) ) ){
            dVacio = dVacio +"\n"+info;
          }
        } */

        if( (num == "14") && ($('input[name="radio13"]:checked').val() == "si") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        
        if( (num == "18") && ($('#txt17').val() == "Otro") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "21") && ($('#txt20').val() == "Otro") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "23") && ($('input[name="radio22"]:checked').val() == "si") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "26") && ($('#txt25').val() == "5") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "27") && ($('#txt25').val() == "6") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "29") && ($('#txt28').val() == "4") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "30") && ($('#txt28').val() == "5") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "32") && ( $('#check31-10').is(':checked') ) && ($('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "34") && ( $('#check33-14').is(':checked') ) && ($('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "36") && ( $('#check35-5').is(':checked') ) && ($('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "38") && ($('input[name="radio37"]:checked').val() == "si") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "39") && ($('input[name="radio37"]:checked').val() == "si") && ( $('input[name="radio'+num+'"]:checked').val() == undefined ) ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "41") && ($('#txt40').val() == "6") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }


        /*
        if( (num == "22") && ($('#txt20').val() == "6") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "24") && ($('#txt23').val() == "4") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "25") && ($('#txt23').val() == "5") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "27") && ( $('#check26-10').is(':checked') ) && ($('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "29") && ( $('#check28-14').is(':checked') ) && ($('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "31") && ( $('#check30-7').is(':checked') ) && ($('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "34") && ($('#txt33').val() == "6") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;          
        }*/



        if( (num == "2") && ( ($('#txt2').val() < 200000000) || ($('#txt2').val().length < 9) || (isNaN($('#txt2').val() ) ) ) ){
          dVacio = dVacio +"\n"+"Asegúrate de ingresar correctamente tu matrícula";
        }

        if ( (num == "3") && ( ($("#txt3").val().indexOf('@', 0) == -1 ) || ($("#txt3").val().indexOf('.', 0) == -1) ) ) {
           dVacio = dVacio +"\n"+"Asegúrate de ingresar correctamente tu correo electrónico";
        }
      
      }

      if( (tipo == "2") && (num != "39") ){
        if ( $('input[name="radio'+num+'"]:checked').val() == undefined){
          dVacio = dVacio +"\n"+info;
        }
      }

      if( (num == "39") && ( $('input[name="radio37"]:checked').val() == "si" ) && ( $('input[name="radio'+num+'"]:checked').val() == undefined )  ){
        dVacio = dVacio +"\n"+info;
      }

      if(tipo == "4"){
        if ( $('input[name="check'+num+'[]"]:checked').length == 0){
          dVacio = dVacio +"\n"+info;
        }
      }

      num += 1;
      value += 1;

    } ///for
    if (dVacio!="") {
      swal({
        title: "Es necesario ingresar los siguientes datos:",
        text: dVacio,
        icon: "warning",
      });
    }else{
      
      swal({
        title: "¿Son correctos tus datos?",
        text: "Es importante que ingreses correctamente tus datos, por favor verifica que estén bien. Presiona OK para continuar o Cancelar para corregir tus datos.",
        icon: "warning",
        buttons: ["Cancelar", true],
     
      })
      .then((enviarDato) => {
        if (enviarDato) {

          var formData = $('#formulario').serialize();
          /* console.log(values2); */
          $.ajax({    ///////  ajax
            type: 'POST',
            url: '../php/pro_entrevista.php',
            data: formData,
            success: function(response){
              
              console.log(response)
              if(response == 1){
                $('#formulario').hide();
                $('#formulario1').show();
                $('#formulario1').html("<br>¡Gracias!<br>Datos almacenados correctamente.");
              }else{
                swal("Problemas al guardar", "verifica ingresar correctamente tus datos", "warning");
              }
            }
          });         ////// fin ajax

        }else {
          return false;
        }

      });
      
    }

  }



function enviarDatos2(){

  const etiquetas = ["1-Nombre", "1-Matrícula", "1-Correo electrónico", "1-Estado Civil", "2-Sexo", "1-Edad", "2-Hijos", "2-Dependientes económicos", "1-Número de dependientes económicos", "2-¿Actualmente trabajas?", "1-¿En qué trabajas?", "1-Asegúrate de ingresar tu promedio académico en escala del 1 al 10", "2-¿Eres beneficiario(a) de alguna beca?", "1-¿Cuál es la beca con la que cuentas?", "1-¿Cuál es la escolaridad que tiene tu madre?", "1-¿Cuál es la escolaridad que tiene tu padre?", "1-¿Qué te motivó a estudiar en la UAM Xochimilco?", "1-Especifica, ¿qué te  motivó a estudiar en la UAM Xochimilco?", "1-¿Qué licenciatura cursas?", "1-¿Por qué elegiste esa licenciatura?", "1-Específica, ¿por qué elegiste esa licenciatura?", "2-¿Conoces el campo laboral de tu carrera?", "1-Menciona el campo laboral de tu carrera", "1-¿Cuántas horas al día fuera de tus clases dedicas a estudiar y a realizar tareas?", "1-¿De qué manera resuelves tus dudas?", "1-Especifica en qué medios investigas", "1-¿Por qué no haces nada respecto a tus dudas?", "1-¿De qué manera resuelves tus dudas sobre los trámites escolares ?", "1-Especifica en qué medios investigas sobre los trámites escolares", "1-¿Por qué no haces nada respecto a tus dudas sobre los trámites escolares?", "4-Recursos con los que cuentas para tu estudio", "1-Específica otros recursos con los que cuentas para tu estudio", "4-¿Qué espacio de tu hogar destinas para hacer tus tareas?", "1-Especifica qué otro espacio de tu hogar destinas para hacer tus tareas:", "4-¿Qué espacio externo a tu hogar destinas para hacer tus tareas?",  "1-Especifica qué espacio externo a tu hogar destinas para hacer tus tareas:", "2-¿Practicas alguna actividad extra escolar?", "1-¿Cuál actividad extra escolar practicas?", "2-¿Dónde practicas tu actividad extra escolar?", "1-¿Qué esperas de las sesiones de tutoría?", "1-Especifica qué esperas de las sesiones de tutoría", "1-¿En qué turno estás inscrito?"];
  var num = 1;
  var dVacio = "";
    
    for (let value of etiquetas) {
      var tipo = "";
      var info = "";
      const cadena = value;
      const arrayCadenas = cadena.split('-', 2);

      tipo = arrayCadenas[0];
      info = arrayCadenas[1];

      if(tipo == "1"){

        if((  $('#txt'+num).val() == "") && (num != "9") && (num != "11") && (num != "12") && (num != "14") && (num != "18") && (num != "21") && (num != "23") && (num != "26") && (num != "27")  && (num != "29") && (num != "30") && (num != "32") && (num != "34") && (num != "36")  && (num != "38") && (num != "39")  && (num != "41") ){
          dVacio = dVacio +"\n"+info;
        }
 
        if( (num == "9") && ($('input[name="radio8"]:checked').val() == "si") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "11") && ($('input[name="radio10"]:checked').val() == "si") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if(num == "12"){
          var prom = ($('#txt12').val());
          promedio = Math.ceil(prom, 1);
          if( ($('#txt'+num).val() == "") || (  (promedio > 10) || (promedio < 1) ) ){
            dVacio = dVacio +"\n"+info;
          }
        }

        if( (num == "14") && ($('input[name="radio13"]:checked').val() == "si") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        
        if( (num == "18") && ($('#txt17').val() == "Otro") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "21") && ($('#txt20').val() == "Otro") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "23") && ($('input[name="radio22"]:checked').val() == "si") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "26") && ($('#txt25').val() == "5") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "27") && ($('#txt25').val() == "6") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "29") && ($('#txt28').val() == "4") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "30") && ($('#txt28').val() == "5") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "32") && ( $('#check31-10').is(':checked') ) && ($('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "34") && ( $('#check33-14').is(':checked') ) && ($('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "36") && ( $('#check35-5').is(':checked') ) && ($('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "38") && ($('input[name="radio37"]:checked').val() == "si") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "39") && ($('input[name="radio37"]:checked').val() == "si") && ( $('input[name="radio'+num+'"]:checked').val() == undefined ) ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "41") && ($('#txt40').val() == "6") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if( (num == "2") && ( ($('#txt2').val() < 200000000) || ($('#txt2').val().length < 9) || (isNaN($('#txt2').val() ) ) ) ){
          dVacio = dVacio +"\n"+"Asegúrate de ingresar correctamente tu matrícula";
        }

        if ( (num == "3") && ( ($("#txt3").val().indexOf('@', 0) == -1 ) || ($("#txt3").val().indexOf('.', 0) == -1) ) ) {
           dVacio = dVacio +"\n"+"Asegúrate de ingresar correctamente tu correo electrónico";
        }
      
      }

      if( (tipo == "2") && (num != "39") ){
        if ( $('input[name="radio'+num+'"]:checked').val() == undefined){
          dVacio = dVacio +"\n"+info;
        }
      }

      if( (num == "39") && ( $('input[name="radio37"]:checked').val() == "si" ) && ( $('input[name="radio'+num+'"]:checked').val() == undefined )  ){
        dVacio = dVacio +"\n"+info;
      }

      if(tipo == "4"){
        if ( $('input[name="check'+num+'[]"]:checked').length == 0){
          dVacio = dVacio +"\n"+info;
        }
      }

      num += 1;
      value += 1;

    } ///for
    if (dVacio!="") {
      swal({
        title: "Es necesario ingresar los siguientes datos:",
        text: dVacio,
        icon: "warning",
      });

    }else{
      
      swal({
        title: "¿Son correctos tus datos?",
        text: "Es importante que ingreses correctamente tus datos, por favor verifica que estén bien. Presiona OK para continuar o Cancelar para corregir tus datos.",
        icon: "warning",
        buttons: ["Cancelar", true],
     
      })
      .then((enviarDato) => {
        if (enviarDato) {

          var formData = $('#formulario').serialize();
          /* console.log(values2); */
          $.ajax({    ///////  ajax
            type: 'POST',
            url: '../php/pro_entrevista_2.php',
            data: formData,
            success: function(response){
              
              console.log(response)
              if(response == 1){
                $('#formulario').hide();
                $('#formulario1').show();
                $('#formulario1').html("<br>¡Gracias!<br>Datos almacenados correctamente.");
              }else{
                swal("Problemas al guardar", "verifica ingresar correctamente tus datos", "warning");
              }
            }
          });         ////// fin ajax

        }else {
          return false;
        }

      });
      
    }

  }


/* 
function enviarDatos2(){
    /// 1 = Texto | 2=Radio | 1 =lista | 4 = checkbox
    const etiquetas = ["1-Nombre", "1-Primer Apellido", "1-Segundo Apellido", "1-Matrícula", "1-Correo electrónico", "1-Estado Civil", "2-Sexo", "1-Edad", "2-Dependientes económicos", "1-Número de dependientes económicos", "2-¿Actualmente trabajas?", "1-¿En qué trabajas?", "1-Asegúrate de ingresar tu promedio académico en escala del 1 al 10", "1-¿Cuál es la escolaridad que tiene tu madre?", "1-¿Cuál es la escolaridad que tiene tu padre?", "1-¿Qué te motivó a estudiar en la UAM Xochimilco?", "1-Especifica, ¿qué te  motivó a estudiar en la UAM Xochimilco?", "1-¿Qué licenciatura cursas?", "1-¿Cuántas horas al día después de la escuela dedicas a estudiar y hacer tareas?", "1-¿De qué manera resuelves tus dudas?", "1-Especifica en qué medios investigas", "1-¿Por qué no haces nada respecto a tus dudas?", "1-¿De qué manera resuelves tus dudas sobre los trámites escolares ?", "1-Especifica en qué medios investigas sobre los trámites escolares ", "1-¿Por qué no haces nada respecto a tus dudas sobre los trámites escolares ?", "4-Recursos con los que cuentas para tu estudio", "1-Específica otros recursos con los que cuentas para tu estudio", "4-¿Qué espacio de tu hogar destinas para hacer tus tareas?", "1-Especifica qué otro espacio de tu hogar destinas para hacer tus tareas:", "4-¿Qué espacio externo a tu hogar destinas para hacer tus tareas?",  "1-Especifica qué espacio externo a tu hogar destinas para hacer tus tareas:", "2-¿Practicas alguna actividad extra escolar?", "1-¿Qué esperas de las sesiones de tutoría?", "1-Especifica qué esperas de las sesiones de tutoría"];
    var num = 1;
    var dVacio = "";
    
    for (let value of etiquetas) {
      var tipo = "";
      var info = "";
      const cadena = value;
      const arrayCadenas = cadena.split('-', 2);

      tipo = arrayCadenas[0];
      info = arrayCadenas[1];

      if(tipo == "1"){

        if((  $('#txt'+num).val() == "") && (num != "10") && (num != "12") && (num != "13") && (num != "17") && (num != "21") && (num != "22") && (num != "24") && (num != "25")  && (num != "27") && (num != "29") && (num != "31") && (num != "34") ){
          dVacio = dVacio +"\n"+info;
        }
 
        if( (num == "10") && ($('input[name="radio9"]:checked').val() == "si") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "12") && ($('input[name="radio11"]:checked').val() == "si") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }

        if(num == "13"){
          var prom = ($('#txt13').val());
          promedio = Math.ceil(prom, 1);
          if( ($('#txt'+num).val() == "") || (  (promedio > 10) || (promedio < 1) ) ){
            dVacio = dVacio +"\n"+info;
          }
        }
        
        if( (num == "17") && ($('#txt16').val() == "Otro") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "21") && ($('#txt20').val() == "5") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "22") && ($('#txt20').val() == "6") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "24") && ($('#txt23').val() == "4") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "25") && ($('#txt23').val() == "5") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "27") && ( $('#check26-10').is(':checked') ) && ($('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "29") && ( $('#check28-14').is(':checked') ) && ($('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "31") && ( $('#check30-7').is(':checked') ) && ($('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "34") && ($('#txt33').val() == "6") && (  $('#txt'+num).val() == "" )  ){
          dVacio = dVacio +"\n"+info;
        }
        if( (num == "4") && ( ($('#txt4').val() < 200000000) || ($('#txt4').val().length < 9) || (isNaN($('#txt4').val() ) ) ) ){
          dVacio = dVacio +"\n"+"Asegúrate de ingresar correctamente tu matrícula";
        }

        if ( (num == "5") && ( ($("#txt5").val().indexOf('@', 0) == -1 ) || ($("#txt5").val().indexOf('.', 0) == -1) ) ) {
           dVacio = dVacio +"\n"+"Asegúrate de ingresar correctamente tu correo electrónico";
        }
      
      }

      if(tipo == "2"){
        if ( $('input[name="radio'+num+'"]:checked').val() == undefined){
          dVacio = dVacio +"\n"+info;
        }
      }

      if(tipo == "4"){
        if ( $('input[name="check'+num+'[]"]:checked').length == 0){
          dVacio = dVacio +"\n"+info;
        }
      }

      num += 1;
      value += 1;

    } ///for
    if (dVacio!="") {
      swal({
        title: "Es necesario ingresar los siguientes datos:",
        text: dVacio,
        icon: "warning",
      });
    }else{
      
      swal({
        title: "¿Son correctos tus datos?",
        text: "Es importante ingresar correctamente tus datos, ya que serán utilizados para el trámite de la BECA. Presiona OK para continuar o Cancelar para corregir tus datos.",
        icon: "warning",
        buttons: ["Cancelar", true],
     
      })
      .then((enviarDato) => {
        if (enviarDato) {

          var formData = $('#formulario').serialize();
          $.ajax({    ///////  ajax
            type: 'POST',
            url: '../php/pro_entrevista_2.php',
            data: formData,
            success: function(response){
              
              //*console.log(response);
              if(response == 1){
                $('#formulario').hide();
                $('#formulario1').show();
                $('#formulario1').html("<br>¡Gracias!<br>Datos almacenados correctamente.");
              }else{
                swal("Problemas al guardar", "verifica ingresar correctamente tus datos", "warning");
              }
            }
          });         ////// fin ajax

        }else {
          return false;
        }

      });
      
    }
  }

 */