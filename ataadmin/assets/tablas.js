/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// ya se creo la variable ****  usuario y rol **** desde el inicio.php
var modalX;
$(document).ready(function () {
    // Mostrar el overlay al iniciar una petición AJAX
    $(document).ajaxStart(function () {
        $('#overlay').fadeIn();
    });

    // Ocultar el overlay al finalizar una petición AJAX
    $(document).ajaxStop(function () {
        $('#overlay').fadeOut();
    });

    scroltop();
    $('#contenidoModal').html('');
    $('#modalLabelForm').html('');
    $('.modal:visible').modal('hide');
    
    $("#inicio").click(function (e) {
        location.reload();
    });
    $(".getbl").click(function (e) {
        e.preventDefault();
        var tbl = $(this).attr('data-tbl');
        $('#contenidoModal').html('');
        $('#modalLabelForm').html('');
        $('.modal:visible').modal('hide');
        $.ajax({
            type: 'POST',
            url: 'php/pro_traedatos.php',
            data: {tabla: "at_" + tbl},
            success: function (r) {
                var array = r.split('#');
                var status = array[0];
                if (status == "1") {
                    var datos = JSON.parse(array[1]);
                    var lista = array[2];
                    var columnas = lista.split(",");                    
//                    console.log(columnas)
//                    console.log(datos)                   
                    var listaHtml = '<table id="mydatable" class="table table-bordered table-striped"><thead class="table-warning"><tr>';
                    if (tbl == 'agenda'){
                        listaHtml += '<th></th>';
                    }
                    
                    var icongraf = '<i class="bi bi-bar-chart" ></i></div>';
                    var myicon = '';
                    for (var c = 0; c < columnas.length; c++) {
                        if (fields[columnas[c]] == 'División' ||
                                fields[columnas[c]] == 'Carrera' ||
                                fields[columnas[c]] == 'Trimestre' ||
                                fields[columnas[c]] == 'Modalidad de reunión' ||
                                fields[columnas[c]] == 'Resolución de dudas' ||
                                fields[columnas[c]] == 'Hora de inicio' ||
                                fields[columnas[c]] == 'Duración de la sesión' ||
                                fields[columnas[c]] == 'Licenciatura' ||
                                fields[columnas[c]] == 'Estado de la sesión' ||
                                fields[columnas[c]] == 'Apoyo integración' ||
                                fields[columnas[c]] == 'Retribución social' ||
                                fields[columnas[c]] == 'Bitácora apoyo' ||
                                fields[columnas[c]] == 'Bitácora apoyado' ||
                                fields[columnas[c]] == 'Lista de espera' ||
                                fields[columnas[c]] == 'Estado' ) {
                            myicon = '<div style="cursor:pointer;text-align:center;" class="creaXgrafica" data-col="' + columnas[c] + '" data-urlx="1">' + icongraf;
                        } else if (fields[columnas[c]] == 'Medios de comunicación' ||
                                fields[columnas[c]] == 'Apoyo a carreras' ||
                                fields[columnas[c]] == 'Días de apoyo' ||
                                fields[columnas[c]] == 'Horarios') {
                            myicon = '<div style="cursor:pointer;text-align:center;" class="creaXgrafica" data-col="' + columnas[c] + '" data-urlx="2">' + icongraf;
                        } else {
                            myicon = '';
                        }                        
                        listaHtml += '<th>' + myicon + '</th>';
                       
                    }
                    listaHtml += '</tr><tr><th> ... </th>';
                    for (var d = 0; d < columnas.length; d++) { 
                         if (tbl != 'agenda' && columnas[d] == 'id') {
                            //nada 
                         } else {
                            listaHtml += '<th>' + fields[columnas[d]] + '</th>';  
                         }
                    }
                    listaHtml += '</tr></thead><tbody>';
                    for (var i = 0; i < datos.length; i++) {
                        var indice = 0;
                        if (tbl == "experiencia" || tbl == "bitacora" || tbl == "agenda") {
                            indice = datos[i]['id'];
                        } else {
                            indice = datos[i]['matricula'];
                        }
                        listaHtml += '<tr>';   ///<a href="#" title="Borrar"><i class="bi bi-trash"></i></a>
                        listaHtml += '<td class="iconos"> <a class="editar" href="#" title="Editar" data-id_mat="' + indice + '"><i class="bi bi-pencil-square"></i></a> </td>'; 
                        //        ' <a class="estado" href="#" title="Deshabilitar" data-id_mat="' + indice + '"><i class="bi bi-slash-circle"></i></a> ';
                        for (var j = 0; j < columnas.length; j++) { 
                            if (datos[i][columnas[j]] === null || datos[i][columnas[j]] === undefined ||
                                 datos[i][columnas[j]] == 0   ) {
                                datos[i][columnas[j]] = '';
                            }
                            if (tbl != 'agenda' && columnas[j] == 'id') {
                            //nada 
                            } else {
                                listaHtml += '<td style="word-wrap: break-word;">' + datos[i][columnas[j]] + '</td>';                           
                            }                                                                                   
                        }
                        listaHtml += '</tr>';
                    }
                    listaHtml += '</tbody></table><div class="mt-3"></div>';
                    $('#tblcontent').html(listaHtml);
                    $('#title').html(tbl.toUpperCase()); // + '<button class="btn btn-success float-end me-4" onclick="exportarExcel(\'' + tbl + '\')"><i class="bi bi-file-excel"></i> Exportar a Excel</button>');
                    $('#mydatable').DataTable({
                        dom: '<"top"Bfl>rt<"bottom"ip>', // Añade los botones de exportación
                        buttons: [
                            {
                                extend: 'excelHtml5',
                                text: 'Exportar a Excel',
                                className: 'btn btn-success'
                            }
                        ],
                        language: {
                            url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
                        },
                        pageLength: 25, // Número de registros por página por defecto
                        lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "Todos"]], // Opciones de paginación
                        columnDefs: [
                            {orderable: false, targets: 0} // Deshabilitar orden en la primera columna (índice 0)
                        ],
                        drawCallback: function () {
                            $('#tblcontent #mydatable_wrapper .dt-buttons').addClass('float-end ms-3 mt-1 mb-2');
                            $('#tblcontent #mydatable_wrapper #mydatable_filter').addClass('float-end ms-3 mt-1 mb-1');
                        }
                    });
                    scroltop();
                    // Evento para resaltar la fila seleccionada
                    $('#mydatable tbody').on('click', 'tr', function () {
                        // Si la fila ya está seleccionada, la deselecciona y restaura su color
                        if ($(this).hasClass('selected')) {
                            $(this).removeClass('selected');
                         } else {
                            // Si no está seleccionada, añadir la clase 'selected' y cambiar el color
                            $(this).addClass('selected').css('background-color', '#c8e6c9'); // Verde claro (selección)
                        }
                    });
                    $("#mydatable .editar").click(function (e) {
                        e.preventDefault();
                        var xind = $(this).data('id_mat');
                        var xpag = '';
                        xpag = 'php/edita_'+tbl+'.php?indice=' + xind;                        
                        // Cargar la página PHP con parámetros
                        $('#contenidoModal').load(xpag, function () {
                            modalX = new bootstrap.Modal(document.getElementById('modalForm'));
                            $('#modalLabelForm').html(" Modificar registro de " + tbl.toUpperCase());
                            modalX.show();                       
                        });
                    });
                    $("#mydatable .estado").click(function (e) {
                        e.preventDefault();
                        var xind = $(this).data('id_mat')
                        alert('estado ' + xind);
                    });
                    $("#mydatable .creaXgrafica").click(function () {
                        var colum = $(this).data('col');
                        var urlx = $(this).data('urlx');
                        var myurl = '';
                        if (urlx == 1) {
                            myurl = 'php/pro_frecuencia.php';
                        } else if (urlx == 2) {
                            myurl = 'php/pro_frecuenciachk.php';
                        }
                        $.ajax({
                            type: 'POST',
                            url: myurl,
                            data: {tabla: "at_" + tbl, columna: colum},
                            success: function (xr) {
//                                alert(xr);
//                                return false;
                                var xarray = xr.split('#');
                                var xstatus = xarray[0];
                                if (xstatus == "1") {
                                    var xdatos = JSON.parse(xarray[1]);
                                    var miModal = new bootstrap.Modal(document.getElementById('miModal'));
                                    miModal.show();
                                    $('#miModalLabel').html(" Registro de " + tbl.toUpperCase());
                                    $('#contenedorGrafica').html('');
                                    $('#contenedorGrafica').html('<canvas id="graficas"></canvas>');
                                    creaGrafica(tbl, xdatos, fields[colum]);
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: '¡Alerta!',
                                        text: array[1] || 'Error al traer los datos.',
                                        confirmButtonText: 'Aceptar'
                                    });
                                }
                            }
                        });
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: '¡Alerta!',
                        text: array[1] || 'Error al traer los datos.',
                        confirmButtonText: 'Aceptar'
                    });
                }
            }
        });
    });
        
    $(document).on('submit', 'form', function (e) {
        e.preventDefault();
        var xforma = $(this).data('xforma'); // Atributo data-xforma        
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
           
        // Agrega información adicional como el nombre de la tabla
        formData["tabla"] = "at_" + xforma;
        // Mostrar los datos en la consola o en un modal antes de enviarlos
        // console.log("Datos recopilados:", formData);
        // alert("Datos recopilados:\n" + JSON.stringify(formData, null, 2));        
 
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Estás a punto de enviar los datos.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, enviar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "php/actualiza_datos.php", 
                    type: "POST",
                    data: JSON.stringify(formData),
                    contentType: "application/json",
                    success: function (r) {                       
                        var response = JSON.parse(r);                        
                        if (response.status === "success") {                            
                            Swal.fire({
                                title: '¡Éxito!', //response.mensaje || 
                                text: 'Datos actualizados correctamente. ',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            }).then(() => {                                                                
                                $('#contenidoModal').html('');
                                $('#modalLabelForm').html('');
                                modalX.hide();
                                $('#mnu_' + xforma).trigger('click');
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: '¡Alerta!',
                                text: response.mensaje || 'Error al guardar los datos.',
                                confirmButtonText: 'Aceptar'                            
                            }).then(() => {
                                $('#contenidoModal').html('');
                                $('#modalLabelForm').html('');
                                modalX.hide();
                                $('#mnu_' + xforma).trigger('click');
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'warning',
                            title: '¡Alerta!',
                            text: "Error al enviar los datos. (" + xforma + ")",
                            confirmButtonText: 'Aceptar'                            
                        }).then(() => {
                            $('#contenidoModal').html('');
                            $('#modalLabelForm').html('');
                            modalX.hide();
                            $('#mnu_' + xforma).trigger('click');
                        });
                    }
                });
            }
        });
       
    });
});

function exportarExcel(xtbl) {
    var tabla = document.getElementById("mydatable");
    var wb = XLSX.utils.table_to_book(tabla, {sheet: xtbl});
    var fecActual = new Date();
    var fecha = fecActual.toISOString().split('T')[0];
    XLSX.writeFile(wb, xtbl + fecha + ".xlsx");
}

function creaGrafica(tbl, datos, fld) {
    // Preparar datos para la gráfica
    var etiquetas = Object.keys(datos);
    var valores = Object.values(datos);
    // Configurar la gráfica con Chart.js
    ctx = document.getElementById('graficas').getContext('2d');
    new Chart(ctx, {
        type: 'bar', // bar, line, pie, doughnut,horizontalBar,radar,polarArea,scatter,bubble ('line' con fill: true)
        //fill:true,
        data: {
            labels: etiquetas,
            datasets: [{
                    label: "Gráfica de " + fld, //titulo de gráfica
                    data: valores,
                    backgroundColor: [
                        '#304FFE', '#2196F3', '#FF5722', '#9C27B0', '#FFC107',
                        '#E91E63', '#00BCD4', '#8BC34A', '#FF9800', '#795548',
                        '#673AB7', '#3F51B5', '#F44336', '#009688', '#CDDC39',
                        '#607D8B', '#FFEB3B', '#03A9F4', '#FF4081', '#00E676',
                        '#FF1744', '#651FFF', '#AEEA00', '#D500F9', '#4CAF50'],
                    borderColor: '#777',
                    borderWidth: 1
                }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {position: 'top'},
                tooltip: {enabled: true}
            },
            scales: {
                y: {beginAtZero: true}
            }
        }
    });
}

var fields = {
    'id': 'Folio',
    'folio': 'Folio de agenda',
    'matricula': 'Matrícula',
    'matricula_apoyado': 'Matrícula apoyado',
    'matricula_apoyo': 'Matrícula apoyo',
    'nombre': 'Nombre',
    'nombreapoyo': 'Nombre apoyo',
    'nombreapoyada': 'Nombre apoyado',
    'nombre_apoyado': 'Nombre apoyado',
    'nombre_apoyo': 'Nombre apoyo',
    'telefono': 'Teléfono',
    'correoins': 'Correo Institucional',
    'correoper': 'Correo Personal',
    'division1': 'División',
    'division2': 'División',
    'licenciatura': 'Licenciatura',
    'carrera': 'Carrera',
    'especialidad': 'Especialidad',
    'trimestre': 'Trimestre',
    'apoyo_carreras': 'Apoyo a carreras',
    'dias': 'Días de apoyo',
    'horarios': 'Horarios',
    'dia': 'Día',
    'horario': 'Horario',
    'lugar': 'Lugar de sesión',
    'observaciones': 'Observaciones',
    'estado': 'Estado',
    'programa': 'Programa académico',
    'modalidad': 'Modalidad de reunión',
    'medios': 'Medios de comunicación',
    'resolucion': 'Resolución de dudas',
    'comentarios': 'Comentarios',
    'fecha': 'Fecha',
    'temas': 'Temas y actividades abordados',
    'fechasesion': 'Fecha de la sesión',
    'horainicio': 'Hora de inicio',
    'duracion': 'Duración de la sesión',
    'eventualidades': 'Eventualidades durante la sesión',
    'retribucion_social': 'Retribución social',    
    'temas_apoyo': 'Temas de apoyo',
    'apoyo_integracion': 'Apoyo integración',
    'estado_sesion': 'Estado de la sesión',
    'bitacora_apoyo': 'Bitácora apoyo',
    'bitacora_apoyado': 'Bitácora apoyado',
    'lista_espera': 'Lista de espera'
};

function scroltop() {
    $('html, body').animate({scrollTop: 0}, 800);
}
function swal(type, msg) {
    var title = '¡Adelante!';
    var icon = 'success';
    if (type == 'ok') {
        title = '¡Gracias!';
        icon = 'warning';
    }
    if (type == 'w') {
        title = '¡Alerta!';
        icon = 'warning';
    }
    if (type == 'e') {
        title = '¡Error!';
        icon = 'error';
    }
    if (type == 'f') {
        title = 'Ya casi terminamos';
        icon = 'success';
    }
    Swal.fire({
        title: title,
        text: msg,
        icon: icon,
        confirmButtonText: 'Aceptar'
    });
}
function openSubMenu() {
    document.querySelector('.dropdown-menu').classList.add('show');
}
function closeSubMenu() {
    document.querySelector('.dropdown-menu').classList.remove('show');
}