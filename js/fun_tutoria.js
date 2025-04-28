  $(document).ready(function(){ 
    $('#formulario1').hide();
    $('#div0').hide();
    $('#div1').hide();
    $('#div2').hide();
    $('#div3').hide();
  });

  function s_otro(op){
    $('#div'+op).show(700);
  }

  function h_otro(op){
    $('#div'+op).hide(700);
  }


  function asiste(op){ 
    if((op==3) || (op==4)){
      $('#div0').hide(700);
    }else{
      $('#div0').show(700);
    }
  }

  function check_otro(chk,divs){  
    if( $('#check'+chk).is(':checked') ) {
      $('#div'+divs).show(700);
    }else{
      $('#div'+divs).hide(700);
    } 
  }


  function enviarTutoria1(){

    /// 1 = Texto | 2=Radio | 1 =lista | 4 = checkbox
    const etiquetas = ["1-Pregunta 1", "1-Pregunta 2", "2-Pregunta 3", "1-Pregunta 4", "2-Pregunta 5", "2-Pregunta 6", "4-Pregunta 7", "1-Pregunta 7. Especifique que otro tema se le dificulta más al/la estudiante", "2-Pregunta 8","1-Pregunta 8. ¿En qué otro aspecto orientó al/la estudiante?", "2-Pregunta 9","1-Pregunta 9. Especifique su respuesta", "1-Pregunta 10", "1-Pregunta 11", "1-Pregunta 12"];
    //const etiquetas = ["2-1Etapa de la trayectoria que está cursando", "2-2Evalúe el desempeño del/de la estudiante", "1-3Justifique su respuesta en la pregunta 3", "2-4Número de días que brindó orientación al/la estudiante durante el trimestre", "2-5Tiempo destinado en cada sesión", "4-6Temas que se le dificultan más al/la estudiante", "1-6otro Especifique que otro tema se le dificulta más al/la estudiante", "2-7¿En qué aspectos orientó al/la estudiante?","1-7otro¿Qué otro aspecto orientó al/la estudiante?", "2-8¿Canalizó o recomendó al/la estudiante para atender alguna inquietud?","1-8Especifique su respuesta de la pregunta 8", "1-9¿Qué estrategias implementó para la mejoría del/de la estudiante?","1-10¿Cuáles son los acuerdos y compromisos que se establecieron con el/la estudiante?", "1-11 Logro obtenido durante el trimestre:"];
    var num = 1;
    var dVacio = "";
    ///var trim = "";

    const url = new URL(location);
    const params = url.searchParams; 
    const trim_inf = params.get("x");

    if (!$('input[name="asistencia"]').is(":checked")) {
      dVacio = dVacio +"\n"+"¿Se logró contactar al estudiante para realizar las sesiones de tutoría?  ";
    }else{
      var asistencia_alu = ($('input[name="asistencia"]:checked').val());
      if ((asistencia_alu == 3) || (asistencia_alu == 4) ) {
        dVacio = "";
      }else{

        for (let value of etiquetas) {
          var tipo = "";
          var info = "";
          const cadena = value;
          const arrayCadenas = cadena.split('-', 2);

          tipo = arrayCadenas[0];
          info = arrayCadenas[1];

          if(tipo == "1"){

            if((  $('#txt'+num).val() == "") && (num != "8") && (num != "10") && (num != "12") ){
              dVacio = dVacio +"\n"+info;
            }
            
            if( (num == "8") && ( $('#check7-9').is(':checked') ) && ($('#txt'+num).val() == "" )  ){
              dVacio = dVacio +"\n"+info;
            }

            if( (num == "10") && ($('input[name="radio9"]:checked').val() == "otro") && (  $('#txt'+num).val() == "" )  ){
              dVacio = dVacio +"\n"+info;
            }

            if( (num == "12") && ($('input[name="radio11"]:checked').val() == "Si") && (  $('#txt'+num).val() == "" )  ){
              dVacio = dVacio +"\n"+info;
            }
          }

          if(tipo == "2"){
            if ( $('input[name="radio'+num+'"]:checked').val() == undefined){
              dVacio = dVacio +"\n"+info;
            }
          }

          if(tipo == "4"){

            if (!$('input[type=checkbox]').is(":checked")) {
              dVacio = dVacio +"\n"+info;
            }
          }

          num += 1;
          value += 1;

        } ///for

      }


    }

    if(dVacio!=""){
      swal({
        title: "Falta completar la siguiente información:",
        text: dVacio,
        icon: "warning",
      });
    }else{
      
      var formData = $('#formulario').serialize();
 
      $.ajax({
        type: 'POST',
        url: '../../php/pro_tutoria_ind.php',
        data: formData,
        success: function(response){
          if(response == 1){
            $('#formulario').hide();
            $('#formulario1').show();
            $('#formulario1').html("<br>¡Gracias por participar en el proyecto de tutorías!<br>Los datos se almacenaron correctamente.<br> haz clic <a class='text-info' href='../tutor/index_trim.php?x="+trim_inf+"'>aquí</a> para continuar.");
          }else{
            swal("Problemas al guardar", "verifica ingresar correctamente tus datos", "warning");
          }
        }
      }); 
      
    }
  }