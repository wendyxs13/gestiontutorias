/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    var xforma = 'inicio';
    var linkataa = '';
    toggle_box();
    $("#inicio").show();
    $("#mnu_inicio").css("color","white");
    $(".mnugral").click(function () {
        xforma = $(this).attr("href").substring(1); 
        toggle_box();
        $("#" + xforma).show();
        $("#mnu_" + xforma).css("color","white");   
        resetForm(xforma); 
        if (xforma == "agenda") {
            $('#form_agenda #btn_agenda').prop('disabled', true);
        }
        if (xforma == "bitacora") { 
             // Iniciar Flatpickr en el input
            var picker = $("#fechasesion").flatpickr({
                dateFormat: "Y-m-d", // Formato de fecha (YYYY-MM-DD)
                locale: flatpickr.l10ns.es, // Establecer el idioma en español
                allowInput: false // Permite escribir manualmente
            });

            $("#form_bitacora #fecses").click(function () {
                picker.open();
            });
            $("#form_bitacora #presencial").prop('checked', true);
            $("#form_bitacora #ataa").prop('checked', true);
        }
    });
   
    // Solo números y máximo 12 caracteres
    $('.matri, .fone').on('input', function() {
       var valor = $(this).val();
            $(this).val(valor.replace(/\D/g, '').slice(0, 10)); 
    });
    
    $('#form_consulta .buscarmatnom, #form_consulta2 .buscarmatnom').on('click', function() {                
        var mat = $("#" + xforma + ' #matricula').val();                
        if (mat == ''){
            Swal.fire({
                icon: 'warning',
                title: '¡Alerta!',
                text: 'Proporciona matrícula.',
                confirmButtonText: 'Aceptar'                            
            });
            $('#form_' + xforma + ' #nombre').val('');
            return false;
        } else {           
            $.ajax({
                url: "php/traer_nombre_consulta.php", 
                type: "POST",
                data: { mat: mat, xforma: xforma},  // Envía el valor de 'mat' y 'xforma'                    
                success: function (r) {
                    var tmp = r.split(',')
                    var status = tmp[0];
                    var nom = (tmp[1]);     
//                   alert(status +"=>"+nom)
//                   return false;
                    if (status == "1") {
   //                   coloca el nombre en la caja correspondiente
                        $('#form_' + xforma + ' #nombre').val(nom);  
                        
                        // **********************************************************
                        if (xforma == 'consulta' || xforma == 'consulta2') {
                            //traer datos de las citas
                             $.ajax({
                                url: "php/traer_datos_consulta.php", 
                                type: "POST", 
                                data: { mat: mat,  xforma: xforma}, 
                                success: function (r) {                                     
                                    var array = r.split('#');
                                    var status = array[0]
//                                    alert(xforma+"=>"+status +"=>"+array[1])
//                                    return false
                                    if (status == "1") {
                                        var msg = '';
                                        var datos = JSON.parse(array[1]);  
                                                                               
                                        var listaHtml = '<table class="table table-bordered table-striped" style="width:100%">'; 
                                        listaHtml += '<thead><tr><th>Matrícula y<br />Nombre Apoyado</th><th>Carrera<br />Trimestre</th><th>Temas de apoyo</th><th>Matrícula y<br />Nombre del Apoyo</th><th>Fecha de<br/>solicitud</th><th><br />Estado sesión<br />Enviar Whatsapp</th></tr></thead><tbody>';
                                        for (var i = 0; i < datos.length; i++) {  
                                            msg = 'El alumno ' + datos[i]['nom'] + ' (' + datos[i]['mat'] + '@alumnos.xoc.uam.mx) desea tener una asesoría de apoyo con ' + datos[i]['nombre'] + '(' + datos[i]['matric'] + '@alumnos.xoc.uam.mx)';
                                            msg = msg.replace(/ /g, "%20");
                                            listaHtml += '<tr>';
                                            listaHtml += '<td>' + datos[i]['mat'] + '<hr />' + datos[i]['nom'] + '</td>';
                                            listaHtml += '<td>' + datos[i]['car'] + '<hr />' + datos[i]['tri'] + '</td>';
                                            listaHtml += '<td style="word-wrap: break-word; max-width: 150px;">' + datos[i]['tem'] + '</td>';                            
                                            listaHtml += '<td>' + datos[i]['matric'] + '<hr />' + datos[i]['nombre'] + '</td>';
                                            listaHtml += '<td>' + datos[i]['fec'] + '</td>';
                                            listaHtml += '<td>' + datos[i]['edoses'] + '<hr />';
                                            if (datos[i]['edoses'] == 'Reagendada' || datos[i]['edoses'] == 'Pendiente') {
                                                listaHtml += '<a target="_blank" href="https://api.whatsapp.com/send?phone=525516562171&text=' + msg + '">Mensaje a ATAA</a></td>';
                                            } else {
                                                listaHtml += '</td>';
                                            }
                                            listaHtml += '</tr>';
                                        } 
                                        listaHtml += '</tbody></table>';
                                        $('#form_' + xforma + ' #datos_consulta').html(listaHtml);  
                                       
                                    } else {
                                        $('#form_' + xforma + ' #matricula').val('');
                                        $('#form_' + xforma + ' #matricula').focus();
                                        $('#form_' + xforma + ' #nombre').val('');                                        
                                        $('#form_' + xforma + ' #datos_consulta').html('');
                                        Swal.fire({
                                            icon: 'warning',
                                            title: '¡Alerta!',
                                            text: array[1] || 'No se encontraron datos.',
                                            confirmButtonText: 'Aceptar'                            
                                        });                                        
                                    }
                                },
                                error: function () {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: '¡Alerta!',
                                        text: 'Error al enviar los datos. traer_datos_consulta.',
                                        confirmButtonText: 'Aceptar'                            
                                    });                                    
                                }
                            });                                                        
                        }                        
                        // ***********************************************
                    } else {
                        $('#form_' + xforma + ' #matricula').val('');
                        $('#form_' + xforma + ' #matricula').focus();
                        $('#form_' + xforma + ' #nombre').val('');
                        Swal.fire({
                            icon: 'warning',
                            title: '¡Alerta!',
                            text: 'Error al traer nombre.',
                            confirmButtonText: 'Aceptar'                            
                        });
                        
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'warning',
                        title: '¡Alerta!',
                        text: 'Error al enviar los datos. traer_nombre.',
                        confirmButtonText: 'Aceptar'                            
                    });
                }
           });
        }           
    });
    
    $('#form_experiencia .buscarmatnom, #form_bitacora .buscarmatnom').on('click', function() {                
        var matexpbit = $("#" + xforma + ' #matricula_expbit').val(); 
        var fol = $("#" + xforma + ' #folio_expbit').val(); 
        if (fol == ''){
            Swal.fire({
                icon: 'warning',
                title: '¡Alerta!',
                text: 'Proporciona Folio (' + xforma + ')',
                confirmButtonText: 'Aceptar'                            
            });
            $('#form_' + xforma + ' #nombre').val('');
            return false;
        }        
        if (matexpbit == ''){
            Swal.fire({
                icon: 'warning',
                title: '¡Alerta!',
                text: 'Proporciona matrícula (' + xforma + ')',
                confirmButtonText: 'Aceptar'                            
            });
            $('#form_' + xforma + ' #nombre').val('');
            return false;
        }
        $("#" + xforma + ' #folio').val(fol); 
        $("#" + xforma + ' #matricula').val(matexpbit);
                                                                           
        $("#" + xforma + ' #folio_expbit').prop('disabled', true);  
        $("#" + xforma + ' #matricula_expbit').prop('disabled', true); 
        $.ajax({
            url: "php/traer_nombre_expbit.php", 
            type: "POST",
            data: { mat: matexpbit, xforma: xforma, folio:fol},                     
            success: function (r) {
                var tmp = r.split(',')
                var status = tmp[0];
                var nomapoyado = (tmp[1]); 
                var nomapoyo = (tmp[2]);
                if (status == "1") {
                    if (xforma == 'experiencia') {
                        $('#form_' + xforma + ' #nombre').val(nomapoyado);
                        $('#form_' + xforma + ' #nombreapoyo').val(nomapoyo);
                    } else if (xforma == 'bitacora') {
                        $('#form_' + xforma + ' #nombre').val(nomapoyo);                        
                        $('#form_' + xforma + ' #nombreapoyada').val(nomapoyado); 
                    }
                } else {
                    $('#form_' + xforma + ' #folio_expbit').prop('disabled', false);  
                    $('#form_' + xforma + ' #matricula_expbit').prop('disabled', false);
                    Swal.fire({
                        icon: 'warning',
                        title: '¡Alerta!',
                        text: tmp[1] || 'No se encontraron datos.',
                        confirmButtonText: 'Aceptar'                            
                    });
                } 
            } 
        });  
    });

    $('#form_agenda #buscarmat').on('click', function() {
        var mat = $('#form_agenda #matricula_selecciona').val(); 
        //alert(mat);
        if (mat == ''){
            Swal.fire({
                icon: 'warning',
                title: '¡Alerta!',
                text: 'Proporciona matrícula para solicitar apoyo.',
                confirmButtonText: 'Aceptar'                            
            });
        } else {            
            $.ajax({
                url: "php/traer_datos_apoyo.php", 
                type: "POST", 
                data: { mat: mat }, 
                success: function (r) {                 
                    var array = r.split('#');
                    var status = array[0]
                    if (status == "1") {
                        var apoyado = JSON.parse(array[1]);
                        var apoyos = JSON.parse(array[2]);
                        var nom = (apoyado['nom']);                        
                        var lic = (apoyado['car']); 
                        var tri = (apoyado['tri']); 
                        var tem = (apoyado['tem']);   
                        $('#form_agenda #matricula_selecciona').prop('disabled', true); 
                        $('#form_agenda #matricula_apoyado').val(mat); 
                        $('#form_agenda #nombre_apoyado').val(nom);
                        $('#form_agenda #licenciatura').val(lic);
                        $('#form_agenda #trimestre').val(tri);
                        $('#form_agenda #temas_apoyo').val(tem); 
                        
                        var listaHtml = '<table class="table table-bordered table-striped">'; 
                        listaHtml += '<thead><tr><th></th><th>Nombre</th><th>Correo</th><th>Días</th><th>Horario</th><th>Carrera</th><th>Apoyo carreras</th></tr></thead><tbody>'; //<th>Whatsapp</th>
                        for (var i = 0; i < apoyos.length; i++) { 
                            //msg += apoyos[i]['nom'] + '(' + apoyos[i]['mat'] + '@alumnos.xoc.uam.mx)';                                            
                            listaHtml += '<tr>';
                            listaHtml += '<td><input required type="radio" class="form-check-input big-radio xopcr" name="matri_nombre_apoyo" data-opc="' + i + '" id="matri_nombre_apoyo_' + i + '" value="' +  (apoyos[i]['mat']) + "-" + (apoyos[i]['nom']) + '"></td>';
                            listaHtml += '<td>' + (apoyos[i]['nom']) + '</td>';                            
                            listaHtml += '<td style="word-wrap: break-word; max-width: 150px;">' + (apoyos[i]['coi']) + '</td>';
                            listaHtml += '<td>' + (apoyos[i]['dia']) + '</td>';
                            listaHtml += '<td>' + (apoyos[i]['hor']) + '</td>';
                            listaHtml += '<td>' + (apoyos[i]['car']) + '</td>';
                            listaHtml += '<td>' + (apoyos[i]['aca']) + '</td>';
                            //listaHtml += '<td><a id="msgataa' + i + '" target="_blank" href="https://api.whatsapp.com/send?phone=525516562171&text=' + msg + '">Mensaje a ATAA</a></td>';
                            listaHtml += '</tr>';
                        } 
                        listaHtml += '</tbody></table>';
                        $('#form_agenda #select_apoyos').html(listaHtml);  
                        $('#form_agenda #btn_agenda').prop('disabled', false);                                               
                        
                        $(".xopcr").click(function () {
                            var tmp = $(this).val().split('-');
                            var correoapoyo = tmp[0] + '@alumnos.xoc.uam.mx';
                            var nombreapoyo = tmp[1];                            
                            var msg = 'El alumno ' + nom + ' (' + mat + '@alumnos.xoc.uam.mx) desea tener una asesoría de apoyo con ' + nombreapoyo + ' (' + correoapoyo + '). Se envia este mensaje al correo del solicitante de apoyo y al correo del alumno apoyador.';                        
                            msg = msg.replace(/ /g, "%20");
                            linkataa = 'https://api.whatsapp.com/send?phone=525516562171&text=' + msg ;                           
                        });
                      
                    } else {
                        $('#form_agenda #matricula').val('');
                        $('#form_agenda #matricula').focus();
                        $('#form_agenda #nombre_apoyado').val('');
                        $('#form_agenda #licenciatura').val('');
                        $('#form_agenda #trimestre').val('');
                        $('#form_agenda #temas_apoyo').val('');
                        $('#form_agenda #select_apoyos').html('');
                        Swal.fire({
                            icon: 'warning',
                            title: '¡Alerta!',
                            text: array[1] || 'No se encontraron datos.',
                            confirmButtonText: 'Aceptar'                            
                        });
                        $('#form_agenda #btn_agenda').prop('disabled', true);                        
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'warning',
                        title: '¡Alerta!',
                        text: 'Error al enviar los datos. traer_datos_apoyo.',
                        confirmButtonText: 'Aceptar'                            
                    });
                    $('#form_agenda #btn_agenda').prop('disabled', true);
                }
           });
        }
    });

    $(document).on('submit', function (e) {
        e.preventDefault();         
        
        // Recopila los datos del formulario como un objeto JSON
        var formData = {};
        $("#form_" + xforma).serializeArray().forEach(field => { 
            formData[field.name] = field.value; 
        });
        if (xforma == 'bitacora' || xforma == 'experiencia') {
            formData['nombre'] = $('#form_' + xforma + ' #nombre').val();
        }
        if (xforma == 'agenda') {
            formData['nombre_apoyado'] = $('#form_' + xforma + ' #nombre_apoyado').val();
            formData['licenciatura'] = $('#form_' + xforma + ' #licenciatura').val();
            formData['trimestre'] = $('#form_' + xforma + ' #trimestre').val();
            formData['temas_apoyo'] = $('#form_' + xforma + ' #temas_apoyo').val();
        }
        if (xforma == "bitacora") {
            formData['horainicio'] = $("#horainicioLabel").text();
            formData['duracion'] = $("#duracionLabel").text();  
            var fsesion = $("#fechasesion").val();
            var factual = new Date().toISOString().split("T")[0]; // Obtiene la fecha actual en formato "yyyy-MM-dd"
            if (fsesion > factual) {
                Swal.fire({
                    icon: 'warning',
                    title: '¡Alerta!',
                    text: 'La fecha de sesión no puede ser posterior a la fecha actual.',
                    confirmButtonText: 'Aceptar'
                });
                return false; // Indicar error
            }
            var fsiguiente = $("#fechasiguiente").val();
            if (fsesion >= fsiguiente) {
                Swal.fire({
                    icon: 'warning',
                    title: '¡Alerta!',
                    text: 'La fecha de sesión debe ser anterior a la fecha de la siguiente sesión.',
                    confirmButtonText: 'Aceptar'
                });
                return false; // Indicar error
            }            
        }
        if (xforma == "experiencia") {
            var medios = '';
            $('input[name="medios"]:checked').each(function () {
                if (medios !== '') {
                    medios += ','; 
                }
                medios += $(this).val(); 
            });
            if (medios === '') {
                e.preventDefault(); 
                Swal.fire({
                    icon: 'warning',
                    title: '¡Alerta!',
                    text: 'Por favor selecciona al menos un medio de comunicación.',
                    confirmButtonText: 'Aceptar'
                });
                return false; // Indicar error
            } else {
                formData['medios'] = medios;
            }
        }
        if (xforma == "apoyos") {
            var apoyo_carreras = '';
            $('input[name="apoyo_carreras"]:checked').each(function () {
                if (apoyo_carreras !== '') {
                    apoyo_carreras += ','; 
                }
                apoyo_carreras += $(this).val(); 
            });
            if (apoyo_carreras === '') {
                e.preventDefault(); 
                Swal.fire({
                    icon: 'warning',
                    title: '¡Alerta!',
                    text: 'Por favor selecciona al menos una carrera para apoyar.',
                    confirmButtonText: 'Aceptar'
                });
                return false; 
            } else {
               formData['apoyo_carreras'] = apoyo_carreras;
            }
            
            var dias = '';
            $('input[name="dias"]:checked').each(function () {
                if (dias !== '') {
                    dias += ','; 
                }
                dias += $(this).val(); 
            });
            if (dias === '') {
                e.preventDefault(); 
                Swal.fire({
                    icon: 'warning',
                    title: '¡Alerta!',
                    text: 'Por favor selecciona al menos un día.',
                    confirmButtonText: 'Aceptar'
                });
                return false; 
            } else {
                     formData['dias'] = dias;
            }
            var horarios = '';
            $('input[name="horarios"]:checked').each(function () {
                if (horarios !== '') {
                    horarios += ','; 
                }
                horarios += $(this).val(); 
            });
            if (horarios === '') {
                e.preventDefault(); 
                Swal.fire({
                    icon: 'warning',
                    title: '¡Alerta!',
                    text: 'Por favor selecciona al menos un horario.',
                    confirmButtonText: 'Aceptar'
                });
                return false; 
            } else {
                     formData['horarios'] = horarios;
            }
        }
        
        if (xforma == "apoyos" || xforma == "apoyados"){           
            var tel = $('#telefono').val();
            if (tel.length !== 10) {
                e.preventDefault(); 
                $('#telefono').focus();
                Swal.fire({
                    icon: 'warning',
                    title: '¡Alerta!',
                    text: 'El teléfono debe ser exactamente de 10 dígitos.',
                    confirmButtonText: 'Aceptar'
                });
                return false;                
            }           
        }
           
        // Agrega información adicional como el nombre de la tabla
        formData["tabla"] = "at_" + xforma;
        // Mostrar los datos en la consola o en un modal antes de enviarlos
        //console.log("Datos recopilados:", formData);
        //alert("Datos recopilados:\n" + JSON.stringify(formData, null, 2));        
        
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Estás a punto de enviar los datos. (" + xforma + ")",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, enviar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "php/guardar_datos.php", 
                    type: "POST",
                    data: JSON.stringify(formData),
                    contentType: "application/json",
                    success: function (r) {                        
                        var response = JSON.parse(r);                        
                        if (response.status === "success") {
                            var msgexito = "Datos guardados correctamente. "
                            var msgextra = "";
                            if (xforma == 'agenda') {
                                msgexito = "";
                                msgextra = "FOLIO: " + response.folio + ". . . Se envia este mensaje al correo del solicitante de apoyo y al correo del alumno apoyador. Manda un mensaje de Whatsapp a ATAA para registrar tu petición de apoyo. Se abrirá una nueva ventana para que mandes un mensaje por Whatsapp web. ";
                            }
                            Swal.fire({
                                title: '¡Éxito!', //response.mensaje || 
                                text: msgexito + msgextra,
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                if (xforma == 'agenda') {
                                    // ENVIAR CORREOS A AMBOS ALUMNOS APOYO Y APOYADO
                                    // POR MEDIO DE AJAX correos.php
                                    msg_folio= "FOLIO:%20" + response.folio + "%20=>%20";
                                    linkataa = linkataa.replace("&text=", "&text=" + msg_folio + ".%0A");
                                    window.open(linkataa, "_blank");
                                }
                                location.reload(); 
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: '¡Alerta!',
                                text: response.mensaje || 'Error al guardar los datos.',
                                confirmButtonText: 'Aceptar'                            
                            }).then(() => {
                                location.reload(); 
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'warning',
                            title: '¡Alerta!',
                            text: 'Error al enviar los datos. guardar_datos.',
                            confirmButtonText: 'Aceptar'                            
                        }).then(() => {
                            location.reload(); 
                        });
                    }
                });
            }
        });
   });
    
});
function resetForm(form) {
    var $myform = $("#form_" + form);
    // Limpiar campos de texto email date
    $myform.find("input[type='text'], input[type='number'], input[type='tel'], input[type='email'], input[type='date'], textarea, select").val(""); 
    $myform.find("select").prop("selectedIndex", 0);
    // Desmarcar radios y checkboxes
    $myform.find("input[type='radio'], input[type='checkbox']").prop("checked", false); 
    // controles RANGE
    $myform.find("#horainicio").val("18"); 
    $myform.find("#horainicioLabel").html("9:00");
    $myform.find("#duracion").val("120"); 
    $myform.find("#duracionLabel").html("2:00 horas"); 
    $myform.find("#select_apoyos").html('');
    $myform.find("#datos_consulta").html('');
    $myform.find('#folio_expbit').prop('disabled', false);  
    $myform.find('#matricula_expbit').prop('disabled', false);
           
}
    
function scroltop() {
    $('html, body').animate({scrollTop: 0}, 800);
}
function toggle_box() {
    $(".mnugral").css("color","#FFFFFF8C");
    $('.resume-section').hide();
}


