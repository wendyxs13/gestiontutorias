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
                "Licenciatura en Agronomía",
                "Licenciatura en Biología",
                "Licenciatura en Enfermería",
                "Licenciatura en Estomatología",
                "Licenciatura en Medicina",
                "Licenciatura en Medicina Veterinaria y Zootecnia",
                "Licenciatura en Nutrición Humana",
                "Licenciatura en Química Farmacéutica Biológica",
                "Maestría en Ciencias Agropecuarias",
                "Maestría en Ciencias Farmaceúticas",
                "Maestría en Ciencias en Salud de los Trabajadores",
                "Maestría en Ciencias Odontológicas",
                "Maestría en Ecología Aplicada",
                "Maestría en Medicina Social",
                "Maestría en Patología y Medicina Bucal",
                "Maestría y Especialización en Población y Salud",
                "Maestría en Rehabilitación Neurológica",
                "Maestría en Enfermería de Práctica Avanzada",
                "Doctorado en Ciencias Biológicas y de la Salud",
                "Doctorado en Ciencias en Salud Colectiva",
                "Doctorado en Ciencias Agropecuarias",
                "Doctorado en Ciencias Farmacéuticas"
            ],
            CSH: [
                "Licenciatura en Administración",
                "Licenciatura en Comunicación Social",
                "Licenciatura en Economía",
                "Licenciatura en Política y Gestión Social",
                "Licenciatura en Psicología",
                "Licenciatura en Sociología",
                "Posgrado en Desarrollo Rural",
                "Posgrado Integral en Ciencias Administrativas",
                "Maestría en Ciencias Económicas",
                "Maestría en Comunicación y Política",
                "Maestría en Desarrollo y Planeación de la Educación",
                "Maestría en Economía, Gestión y Políticas de Innovación",
                "Maestría en Estudios de la Mujer",
                "Maestría en Relaciones Internacionales",
                "Maestría en Psicología Social de Grupos e Instituciones",
                "Maestría en Políticas Públicas",
                "Maestría en Sociedades Sustentables",
                "Doctorado en Ciencias Sociales",
                "Doctorado en Ciencias Económicas",
                "Doctorado en Economía, Gestión y Políticas de Innovación",
                "Doctorado en Estudios Feministas",
                "Doctorado en Humanidades"
            ],
            CyAD: [
                "Licenciatura en Arquitectura",
                "Licenciatura en Diseño de la Comunicación Gráfica",
                "Licenciatura en Diseño Industrial",
                "Licenciatura en Planeación Territorial",
                "Maestría en Ciencias y Artes para el Diseño",
                "Maestría en Diseño y Producción Editorial",
                "Maestría en Reutilización del Patrimonio Edificado",
                "Doctorado en Ciencias y Artes para el Diseño"
            ]
        };
        const carreras2 = {
            CBS: [
                "Agronomía",
                "Biología",
                "Enfermería",
                "Estomatología",
                "Medicina",
                "Medicina Veterinaria y Zootecnia",
                "Nutrición Humana",
                "Química Farmacéutica Biológica"                
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
        let minutosTotales = valor * 30; // Minutos totales desde las 00:00
        let horas = Math.floor(minutosTotales / 60);
        let minutos = minutosTotales % 60;
        // Actualizar la etiqueta con la hora en formato HH:MM
        document.getElementById('horainicioLabel').innerText = 
            `${horas.toString().padStart(2, '0')}:${minutos.toString().padStart(2, '0')}`;
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
    
    function horaAToRange(hora) {
        var [horas, minutos] = hora.split(":").map(Number);
                var valor = 18 + ((horas - 9) * 2);
        if (minutos >= 30) {
            valor += 1;
        }
        return valor;
    }
    
    function duracionAToRange(dura) {
        var duraciones = {
            "0:30 horas": 30,
            "1:00 horas": 60,
            "1:30 horas": 90,
            "2:00 horas": 120,
            "2:30 horas": 150,
            "3:00 horas": 180,
            "3:30 horas": 210,
            "4:00 horas": 240
        };
        return duraciones[dura];
    }
