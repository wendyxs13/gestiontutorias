/*!
* Start Bootstrap - Resume v7.0.6 (https://startbootstrap.com/theme/resume)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-resume/blob/master/LICENSE)
*/
// Scripts
// 
// Listas de carreras por división
        const carreras = {
            CBS: [
                "Agronomía",
                "Biología",
                "Enfermería",
                "Estomatología",
                "Medicina",
                "MVZ",
                "Nutrición Humana",
                "QFB",
                "M. Ciencias Agropecuarias",
                "M. Ciencias Farmaceúticas",
                "M. Ciencias en Salud de los Trabajadores",
                "M. Ciencias Odontológicas",
                "M. Ecología Aplicada",
                "M. Medicina Social",
                "M. Patología y Medicina Bucal",
                "M. Población y Salud",
                "M. Rehabilitación Neurológica",
                "M. Enfermería de Práctica Avanzada",
                "D. Ciencias Biológicas y de la Salud",
                "D. Ciencias en Salud Colectiva",
                "D. Ciencias Agropecuarias",
                "D. Ciencias Farmacéuticas"
            ],
            CSH: [
                "Administración",
                "Comunicación Social",
                "Economía",
                "Política y Gestión Social",
                "Psicología",
                "Sociología",
                "P. Desarrollo Rural",
                "P. Ciencias Administrativas",
                "M. Ciencias Económicas",
                "M. Comunicación y Política",
                "M. Desarrollo y Planeación de la Educación",
                "M. Economía, Gestión y Políticas de Innovación",
                "M. Estudios de la Mujer",
                "M. Relaciones Internacionales",
                "M. Psicología Social de Grupos e Instituciones",
                "M. Políticas Públicas",
                "M. Sociedades Sustentables",
                "D. Ciencias Sociales",
                "D. Ciencias Económicas",
                "D. Economía, Gestión y Políticas de Innovación",
                "D. Estudios Feministas",
                "D. Humanidades"
            ],
            CyAD: [
                "Arquitectura",
                "Diseño de la Comunicación Gráfica",
                "Diseño Industrial",
                "Planeación Territorial",
                "M. Ciencias y Artes para el Diseño",
                "M. Diseño y Producción Editorial",
                "M. Reutilización del Patrimonio Edificado",
                "D. Ciencias y Artes para el Diseño"
            ]
        };
        const carreras2 = {
            CBS: [
                "Agronomía",
                "Biología",
                "Enfermería",
                "Estomatología",
                "Medicina",
                "MVZ",
                "Nutrición Humana",
                "QFB"                
            ],
            CSH: [
                "Administración",
                "Comunicación Social",
                "Economía",
                "Política y Gestión Social",
                "Psicología",
                "Sociología"
            ],
            CyAD: [
                "Arquitectura",
                "Diseño de la Comunicación Gráfica",
                "Diseño Industrial",
                "Planeación Territorial"
            ]
        };
        
        // Función para mostrar las carreras de la división seleccionada
        function mostrarCarreras() {
            const divisionSeleccionada = document.querySelector('input[name="division2"]:checked')?.value;
            const selectCarreras = document.getElementById("listaCarreras2");
            selectCarreras.innerHTML = ""; // Limpiar el select actual

            // Si hay una división seleccionada, habilitamos el select y agregamos las opciones
            if (divisionSeleccionada && carreras[divisionSeleccionada]) {
                const optionDefault = document.createElement("option");
                optionDefault.value = "";
                optionDefault.textContent = "Selecciona una carrera...";
                selectCarreras.appendChild(optionDefault);

                carreras[divisionSeleccionada].forEach(carrera => {
                    const option = document.createElement("option");
                    option.value = carrera;
                    option.textContent = carrera;
                    selectCarreras.appendChild(option);
                });
                // Habilitar el select
                selectCarreras.disabled = false;
            } else {
                // Si no hay división seleccionada, deshabilitar el select
                selectCarreras.disabled = true;
            }
        }
        
        // Función para mostrar las carreras de la división seleccionada
        function mostrarCarreras2() {
            const divisionSeleccionada = document.querySelector('input[name="division1"]:checked')?.value;
            const selectCarreras = document.getElementById("listaCarreras1");
            selectCarreras.innerHTML = ""; // Limpiar el select actual

            // Si hay una división seleccionada, habilitamos el select y agregamos las opciones
            if (divisionSeleccionada && carreras[divisionSeleccionada]) {
                const optionDefault = document.createElement("option");
                optionDefault.value = "";
                optionDefault.textContent = "Selecciona una carrera...";
                selectCarreras.appendChild(optionDefault);

                carreras2[divisionSeleccionada].forEach(carrera => {
                    const option = document.createElement("option");
                    option.value = carrera;
                    option.textContent = carrera;
                    selectCarreras.appendChild(option);
                });
                // Habilitar el select
                selectCarreras.disabled = false;
            } else {
                // Si no hay división seleccionada, deshabilitar el select
                selectCarreras.disabled = true;
            }
        }
        
 // Función para actualizar la hora en formato HH:MM
    function actualizarHora(valor) {
        // Cada paso del deslizador representa 15 minutos
        let minutosTotales = valor * 30; // Minutos totales desde las 00:00
        let horas = Math.floor(minutosTotales / 60);
        let minutos = minutosTotales % 60;
        // Actualizar la etiqueta con la hora en formato HH:MM
        document.getElementById('horainicioLabel').innerText = 
            `${horas.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}`;
    }
    // Inicialización del control (opcional)
    if ($('#horainicio').length) {
        actualizarHora(document.getElementById('horainicio').value);
    }
    
     // Función para actualizar la duración en formato Xh Ym
     function actualizarDuracion(valor) {
        // Convertir minutos totales (valor del deslizador) a horas y minutos
        let horas = Math.floor(valor / 60);
        let minutos = valor % 60;
        let ampm = horas >= 12 ? 'Horas' : 'horas';
        // Ajustar el formato de la hora (de 24 a 12 horas)
        if (horas > 12) horas -= 12;
        if (horas === 0) horas = 0;
        // Actualizar la etiqueta con la hora formateada
        document.getElementById('duracionLabel').innerText = `${horas}:${minutos.toString().padStart(2, '0')} ${ampm}`;
    }
    // Inicialización del control
    if ($('#duracion').length) {
        actualizarDuracion(document.getElementById('duracion').value);
    }
    
