<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ATAA | Apoyo Pares</title>
        <link rel="icon" type="image/x-icon" href="imgs/favicon2.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Sweetalert2 CSS  -->
        <link rel="stylesheet" href="css/sweetalert2.min.css">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">          
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">        

        <style>
            body {
                background-color: rgba(0, 0, 0, 0.05); /* Atenuación del fondo */
                color: #333;
            }
            .bg-image {
                position: relative;
                background-image: url('imgs/ataaimg.png'); 
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                height: 100vh;; /* Altura del div */
            }
            .bg-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 98%;
                height: 98%;               
            }
            .big-radio{
                transform: scale(1.7);  /* Makes radio button bigger */                
            }
            .big-check{
                transform: scale(1.7);  /* Makes radio button bigger */
                margin: 0 5px 15px 0 !important;
            }
            .bi {
                color: #555                
            }
            .navbar-nav .bi{
                color: #ddd; 
            }
            button .bi{
                color: #fff; 
                margin-right:0.5rem;
            }            
            .nav-link:hover {
                color: #777ddd !important;
                cursor: pointer;
            }
            checkbox-group {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                margin-bottom: 20px;                
            }
            .checkbox-group label {
                white-space: nowrap;
                margin-right: 20px; 
            }
            h1 {
                font-size: 2.0em;
                color: darkblue;
                text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7); /* Efecto sombra para destacar */
            }
            .imgpares {
                width:50%;
                margin-left:20%;
                border: 0.5rem solid rgba(10, 54, 109, 0.2);
                border-radius:50%;
            }
            .imgayuda {
              width:70%;  
              text-align: center !important;
            }
            .container {
                text-align: center;                 
                padding-bottom: 20px
            }
            p {
                text-align: justify;
            }
            #myTabContent {
                background: #fff;
                padding: 1rem;
            }
        </style>
    </head>
    <?php
    $trimes = ["TID" => "TID", "2.o" => "2.º", "3.o" => "3.º", "4.o" => "4.º", "5.o" => "5.º", "6.o" => "6.º", "7.o" => "7.º", "8.o" => "8.º", "9.o" => "9.º", "10.o" => "10.º", "11.o" => "11.º", "12.o" => "12.º", "13.o" => "13.º", "14.o" => "14.º", "15.o" => "15.º"];
    ?>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">                     
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none">Jornada Permanente de Apoyo entre Pares</span>
                <span class="d-none d-lg-block" style="margin-top: -100px;"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="imgs/ataalogo.png" alt="..." style="width:70%"/></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">

                <ul class="navbar-nav text-start ms-2" style="font-size: .8rem; ">
                    <li class="nav-item">
                        <a class="mnugral nav-link js-scroll-trigger" href="index.php" id="mnu_inicio" >
                            <i class="bi bi-house-door"></i> Inicio
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="mnugral nav-link js-scroll-trigger" href="#apoyos" id="mnu_apoyos" >
                            <i class="bi bi-person-plus"></i> Registro de Apoyos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="mnugral nav-link js-scroll-trigger" href="#consulta2" id="mnu_consulta2" >
                            <i class="bi bi-calendar-check"></i> Consulta tus citas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="mnugral nav-link js-scroll-trigger" href="#bitacora" id="mnu_bitacora" >
                            <i class="bi bi-pencil-square"></i> Llenar Bitácora
                        </a>
                    </li>                    
                    <li class="nav-item">
                        <a class="mnugral nav-link js-scroll-trigger" href="#ayuda" id="mnu_ayuda" >
                            <i class="bi bi-question-circle"></i> Ayuda
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- Inicio -->            
            <section class="resume-section bg-image" id="inicio">
                <div class="bg-overlay"></div>
                <div class="resume-section-content"> 
                    <img src="imgs/Logo_de_la_UAM-X.png" width="7%" class="float-start ms-5">        
                    <img src="imgs/logo_cde.png" width="11%" class="float-end me-5 mt-3">
                    <h6 class="text-primary mt-3 mb-2" style="width: 100%; text-align: center; opacity:.8;">
                        Acompañamiento de Trayectorias Académicas del Alumnado (ATAA)</h6>
                    <h5 style="width: 100%; text-align: center;color:#333;">JORNADA PERMANENTE DE APOYO ENTRE PARES</h5>
                    <br />
                    <h1 class="mt-4">Alumnos &nbsp;de &nbsp;Apoyo</h1>
                    <img src="imgs/pares1.png" class="imgpares">
                </div>
            </section>
            <hr class="m-0" />
            <section class="resume-section" id="apoyos">
                <div class="resume-section-content">
                    <h1 class="mb-4">Registro de apoyos</h1>
                    <form id="form_apoyos">
                        <!-- Campo: Matrícula -->
                        <div class="row align-items-center mb-3">
                            <label for="matricula" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-person-badge me-2"></i> Matrícula
                            </label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control matri" id="matricula" name="matricula" maxlength="10" placeholder="Ingresa matrícula" pattern="\d{10}" title="La matrícula debe contener 10 dígitos" oninvalid="this.setCustomValidity('Por favor, ingrese una matrícula válida de 10 dígitos.')" oninput="setCustomValidity('')">
                            </div>
                        </div>

                        <!-- Campo: Nombre -->
                        <div class="row align-items-center mb-3">
                            <label for="nombre" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-person me-2"></i> Nombre
                            </label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="nombre" name="nombre" maxlength="255" placeholder="Ingresa nombre completo">
                            </div>
                        </div>

                        <!-- Campo: Teléfono -->
                        <div class="row align-items-center mb-3">
                            <label for="telefono" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-telephone me-2"></i> Teléfono
                            </label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control fone" id="telefono" name="telefono" maxlength="10" placeholder="Ingresa teléfono"  pattern="\d{10}" title="La matrícula debe contener 10 dígitos"  oninvalid="this.setCustomValidity('Por favor, ingrese telefono válido de 10 dígitos.')" oninput="setCustomValidity('')">
                            </div>
                        </div>

                        <!-- Campo: Correo Institucional -->
                        <div class="row align-items-center mb-3">
                            <label for="correoins" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-envelope me-2"></i> Correo Institucional
                            </label>
                            <div class="col-sm-9">
                                <input required type="email" class="form-control correo" id="correoins" name="correoins" maxlength="50" placeholder="Ingresa correo institucional">
                            </div>
                        </div>

                        <!-- Campo: Correo Personal -->
                        <div class="row align-items-center mb-3">
                            <label for="correoper" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-envelope-open me-2"></i> Correo Personal
                            </label>
                            <div class="col-sm-9">
                                <input required type="email" class="form-control correo" id="correoper" name="correoper" maxlength="50" placeholder="Ingresa correo personal">
                            </div>
                        </div>

                        <!-- Campo: División -->
                        <div class="row align-items-center mb-3">
                            <label for="division" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-diagram-3 me-2"></i> División
                            </label>
                            <div class="col-sm-9">                                

                                <div class="form-check form-check-inline mr-5 ">
                                    <input required class="form-check-input mr-5 big-radio" type="radio" name="division2" value="CBS" id="cbs" onclick="mostrarCarreras()"> 
                                    &nbsp; <label class="form-check-label" for="cbs">
                                        CBS
                                    </label>
                                </div>
                                &nbsp; &nbsp; &nbsp; &nbsp; 
                                <div class="form-check form-check-inline mr-5 ">
                                    <input required class="form-check-input mr-5 big-radio" type="radio" name="division2" value="CSH" id="csh" onclick="mostrarCarreras()"> 
                                    &nbsp; <label class="form-check-label" for="csh">
                                        CSH
                                    </label>
                                </div>   
                                &nbsp; &nbsp; &nbsp; &nbsp; 
                                <div class="form-check form-check-inline mr-10 ">
                                    <input required class="form-check-input mr-5 big-radio" type="radio" name="division2" value="CyAD" id="cyad" onclick="mostrarCarreras()"> 
                                    &nbsp; <label class="form-check-label" for="cyad">
                                        CyAD
                                    </label>
                                </div>

                            </div>
                        </div>
                        <!-- Campo: Carrera -->
                        <div class="row align-items-center mb-3">
                            <label for="carreras" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-briefcase me-2"></i> Carrera
                            </label>
                            <div class="col-sm-9">
                                <div id="carreras">
                                    <select required id="listaCarreras2" name="carrera" class="form-select" disabled>
                                        <option value="">Selecciona una división primero</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Campo: grado -->
                        <div class="row align-items-center mb-3">
                            <label for="grado" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-mortarboard me-2"></i> Selecciona los grados que tienes
                            </label>
                            <div class="col-sm-9">
                                <fieldset>                                                                      
                                    <div class="checkbox-group">
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="grado" value="Licenciatura"> Licenciatura</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="grado" value="Especialidad"> Especialidad</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="grado" value="Maestría"> Maestría</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="grado" value="Doctorado"> Doctorado</label>                                        
                                    </div>                                     
                                </fieldset>
                            </div>
                        </div>
                        <!-- Campo: Especialidad -->
                        <div class="row align-items-center mb-3">
                            <label for="especialidad" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-tools me-2"></i> Especialidad
                            </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="especialidad" name="especialidad" maxlength="255" placeholder="Ingresa especialidad">
                            </div>
                        </div>

                        <!-- Campo: Trimestre -->
                        <div class="row align-items-center mb-3">
                            <label for="trimestre" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-calendar me-2"></i> Trimestre
                            </label>
                            <div class="col-sm-9">
                                <select required id="trimestre" name="trimestre" class="form-select">
                                    <option value="">Selecciona trimestre</option>
                                    <?php
                                    foreach ($trimes as $value => $text) {
                                        echo "<option value=\"$value\">$text</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Campo: carreras -->
                        <div class="row align-items-center mb-3">
                            <label for="apoyo_carreras" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-mortarboard me-2"></i> En qué carreras puedes brindar el apoyo
                            </label>
                            <div class="col-sm-9">
                                <fieldset>                                                                        
                                    <div class="checkbox-group">
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Agronomía"> Agronomía</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Biología"> Biología</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Enfermería"> Enfermería</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Estomatología"> Estomatología</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Medicina"> Medicina</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="MVZ"> MVZ</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Nutrición Humana"> Nutrición Humana</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="QFB"> QFB</label>
                                    </div> 
                                    <br />
                                    <div class="checkbox-group">
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Administración"> Administración</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Comunicación Social"> Comunicación Social</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Economía"> Economía</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Política y Gestión Social"> Política y Gestión Social</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Psicología"> Psicología</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Sociología"> Sociología</label>
                                    </div>
                                    <br />
                                    <div class="checkbox-group">
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Arquitectura"> Arquitectura</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Diseño de la Comunicación Gráfica"> Diseño de la Comunicación Gráfica</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Diseño Industrial"> Diseño Industrial</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="apoyo_carreras" value="Planeación Territorial"> Planeación Territorial</label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <!-- Campo: días -->
                        <div class="row align-items-center mb-3">
                            <label for="dias" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-mortarboard me-2"></i> Qué días puedes brindar el apoyo
                            </label>
                            <div class="col-sm-9">
                                <fieldset>                                                                        
                                    <div class="checkbox-group">
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="dias" value="Lunes"> Lunes</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="dias" value="Martes"> Martes</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="dias" value="Miércoles"> Miércoles</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="dias" value="Jueves"> Jueves</label>
                                        <label><input class="form-check-input mr-5 big-check" type="checkbox" name="dias" value="Viernes"> Viernes</label>
                                    </div>                                     
                                </fieldset>
                            </div>
                        </div>
                        <!-- Campo: horario -->
                        <div class="row align-items-center mb-3">
                            <label for="modalidad" class="col-sm-3  col-form-label text-dark">
                                <i class="bi bi-camera-video me-2"></i> Horario
                            </label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline mr-5 ">
                                    <input class="form-check-input mr-5 big-radio" type="checkbox" name="horarios" value="Matutino" id="matutino" > 
                                    &nbsp; <label class="form-check-label" for="matutino">
                                        Matutino (De 8:00 a 12:00 PM)
                                    </label>
                                </div>
                                &nbsp; &nbsp; &nbsp; &nbsp; 
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input mr-5 big-radio" type="checkbox" name="horarios" value="Vespertino" id="vespertino" > 
                                    &nbsp; <label class="form-check-label" for="vespertino">
                                        Vespertino (De 12:00 a 19:00 PM)
                                    </label>
                                </div> 
                            </div>
                        </div>
                        <!-- Campo: observaciones -->
                        <div class="row align-items-center mb-3">
                            <label for="temas" class="col-sm-3  col-form-label text-dark">
                                <i class="bi bi-list-task me-2"></i> Observaciones
                            </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="Ingresa observaciones"></textarea>
                            </div>
                        </div>

                        <!-- Botón de Enviar -->
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button id="btn_apoyos" type="submit" class="btn btn-primary">
                                    <i class="bi bi-send"></i> Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <hr class="m-0" />

            <section class="resume-section" id="bitacora">
                <div class="resume-section-content">
                    <h1 class="mb-4">Llenado de bitácora del apoyador</h1>
                    <form id="form_bitacora">
                        <!-- Matrícula -->
                        <div class="row align-items-center mb-3">
                            <label for="matricula" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-tag"></i> FOLIO <br /> 
                                <i class="bi bi bi-person-badge me-2"></i> Matrícula del apoyador
                            </label>
                            <div class="col-sm-9">
                                <div class="d-flex">
                                    <input required type="text" class="form-control me-2 matri" id="folio_expbit" maxlength="4" placeholder="Folio de la cita" pattern="\d{1,4}" style="width: 150px;">
                                    <input required type="text" class="form-control w-50 me-2 matri" id="matricula_expbit"  maxlength="10" placeholder="Ingresa matrícula del apoyador" pattern="\d{10}" title="La matrícula debe contener 10 dígitos"  oninvalid="this.setCustomValidity('Por favor, ingrese una matrícula válida de 10 dígitos.')" oninput="setCustomValidity('')">
                                    &nbsp; &nbsp; <button type="button" class="btn btn-primary buscarmatnom" style="height:35px;">
                                        <i class="bi bi-search"></i> Buscar
                                    </button>
                                </div>

                                <input required type="hidden" id="folio" name="folio" >
                                <input required type="hidden" id="matricula" name="matricula">
                                <input required disabled type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del apoyador" style="margin-top: 5px;">
                            </div>
                        </div>                                                                        

                        <!-- Campo: Programa académico -->
                        <div class="row align-items-center mb-3">
                            <label for="programa" class="col-sm-3  col-form-label text-dark">
                                <i class="bi bi-book me-2"></i> Programa académico 
                            </label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="programa" name="programa" maxlength="255" placeholder="Ingresa programa académico que cursas">
                            </div>
                        </div>

                        <!-- Campo: Trimestre -->
                        <div class="row align-items-center mb-3">
                            <label for="trimestre" class="col-sm-3  col-form-label text-dark">
                                <i class="bi bi-calendar2-range me-2"></i> Trimestre que cursas
                            </label>
                            <div class="col-sm-9">
                                <select required id="trimestre" name="trimestre" class="form-select">
                                    <option value="">Selecciona trimestre</option>
                                    <?php
                                    foreach ($trimes as $value => $text) {
                                        echo "<option value=\"$value\">$text</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Campo: Nombre de la persona apoyada -->
                        <div class="row align-items-center mb-3">
                            <label for="nombreapoyada" class="col-sm-3  col-form-label text-dark">
                                <i class="bi bi-people me-2"></i> Nombre de la persona que apoyaste
                            </label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="nombreapoyada" name="nombreapoyada" maxlength="255" placeholder="Ingresa nombre de la persona que apoyaste">
                            </div>
                        </div>

                        <!-- Campo: Modalidad -->
                        <div class="row align-items-center mb-3">
                            <label for="modalidad" class="col-sm-3  col-form-label text-dark">
                                <i class="bi bi-camera-video me-2"></i> Modalidad de reunión
                            </label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline mr-5 ">
                                    <input required class="form-check-input mr-5 big-radio" type="radio" name="modalidad" value="Presencial" id="presencial" > 
                                    &nbsp; <label class="form-check-label" for="presencial">
                                        Presencial
                                    </label>
                                </div>
                                &nbsp; &nbsp; &nbsp; &nbsp; 
                                <div class="form-check form-check-inline mr-5">
                                    <input required class="form-check-input mr-5 big-radio" type="radio" name="modalidad" value="Remota" id="remota" > 
                                    &nbsp; <label class="form-check-label" for="remota">
                                        Remota (Vía Zoom)
                                    </label>
                                </div> 
                            </div>
                        </div>

                        <!-- Campo: Fecha de la sesión -->
                        <div class="row align-items-center mb-3">
                            <label for="fechasesion" class="col-sm-3  col-form-label text-dark">
                                <i class="bi bi-calendar me-2"></i> Fecha de la sesión
                            </label>
                            <div class="col-sm-9" id="fecses" style="cursor: pointer;">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-calendar-plus"></i></span>
                                    <input required type="text" class="form-control" id="fechasesion" name="fechasesion" placeholder="Selecciona una fecha">
                                </div>
                            </div>

                        </div>

                        <div class="row align-items-center mb-3">
                            <label for="horainicio" class="col-sm-3  col-form-label text-dark">
                                <i class="bi bi-clock me-2"></i> Hora de inicio
                            </label>
                            <div class="col-sm-9">
                                <div class="d-flex justify-content-between mt-2 fs-6">
                                    <span>&nbsp; 9</span>
                                    <span>10</span>
                                    <span>11</span>
                                    <span>12</span>
                                    <span>13</span>
                                    <span>14</span>
                                    <span>15</span>
                                    <span>16</span>
                                    <span>17</span>
                                    <span>18</span>
                                    <span>19</span>                                    
                                </div>
                                <!-- Control deslizante -->
                                <input required type="range" class="form-range" id="horainicio" name="horainicio" 
                                       min="18" max="38" step="1" value="18" oninput="actualizarHora(this.value)">
                                <!-- Etiqueta para mostrar la hora -->
                                <div class="text-start mt-2">
                                    <span id="horainicioLabel">09:00</span>
                                </div>
                            </div>
                        </div>

                        <!-- Campo: Duración -->
                        <div class="row align-items-center mb-3">
                            <label for="duracion" class="col-sm-3  col-form-label text-dark">
                                <i class="bi bi-stopwatch me-2"></i> Duración de la sesión
                            </label>
                            <div class="col-sm-9">
                                <!-- Mostrar etiquetas de los rangos -->
                                <div class="d-flex justify-content-between mt-2">
                                    <span>30 m</span>
                                    <span>1 h</span>
                                    <span>1:30</span>
                                    <span>2 h</span>
                                    <span>2:30</span>
                                    <span>3 h</span>
                                    <span>3:30</span>
                                    <span>4 h</span>                                     
                                </div>
                                <!-- Control deslizante -->
                                <input required type="range" class="form-range" id="duracion" name="duracion"  
                                       min="30" max="240" step="30" value="120" oninput="actualizarDuracion(this.value)">
                                <!-- Etiqueta para mostrar la duración -->
                                <div class="text-start mt-2">
                                    <span id="duracionLabel">2:00 horas</span>
                                </div>
                            </div>
                        </div>
                        <!-- Campo: lugar-->
                        <div class="row align-items-center mb-3">
                            <label for="lugar" class="col-sm-3  col-form-label text-dark">
                                <i class="bi bi-geo-alt me-2"></i> Lugar de reunión
                            </label>
                            <div class="col-sm-9" style="line-height:30px;">
                                <div class="form-check form-check-inline mr-5 ">
                                    <input required class="form-check-input mr-5 big-radio" type="radio" name="lugar" value="Oficina de ATAA" id="ataa" checked> 
                                    &nbsp; <label class="form-check-label" for="ataa">
                                        Oficina de ATAA
                                    </label>
                                </div>
                                &nbsp; &nbsp; &nbsp; &nbsp; 
                                <div class="form-check form-check-inline mr-5">
                                    <input required class="form-check-input mr-5 big-radio" type="radio" name="lugar" value="Sala de la CDE" id="cde" > 
                                    &nbsp; <label class="form-check-label" for="cde">
                                        Sala de la CDE
                                    </label>
                                </div> 
                                &nbsp; &nbsp; &nbsp; &nbsp; 
                                <div class="form-check form-check-inline mr-5" >
                                    <input required class="form-check-input mr-5 big-radio" type="radio" name="lugar" value="Salón de la UAM" id="salon" > 
                                    &nbsp; <label class="form-check-label" for="salon">
                                        Salón de la UAM
                                    </label>
                                </div> 
                                &nbsp; &nbsp; &nbsp; &nbsp; 
                                <div class="form-check form-check-inline mr-5">
                                    <input required class="form-check-input mr-5 big-radio" type="radio" name="lugar" value="Espacio abierto" id="espacio" > 
                                    &nbsp; <label class="form-check-label" for="espacio">
                                        Espacio abierto
                                    </label>
                                </div> 
                                &nbsp; &nbsp; &nbsp; &nbsp; 
                                <div class="form-check form-check-inline mr-5">
                                    <input required class="form-check-input mr-5 big-radio" type="radio" name="lugar" value="En línea" id="linea" > 
                                    &nbsp; <label class="form-check-label" for="linea">
                                        En línea
                                    </label>
                                </div> 

                            </div>
                        </div>
                        <!-- Campo: estado sesion -->
                        <input type="hidden" id="estado" name="estado" value="Completada">
                        
                        <!-- Campo: Temas y actividades -->
                        <div class="row align-items-center mb-3">
                            <label for="temas" class="col-sm-3  col-form-label text-dark">
                                <i class="bi bi-list-task me-2"></i> Temas y actividades abordados
                            </label>
                            <div class="col-sm-9">
                                <textarea required class="form-control" id="temas" name="temas" rows="3" placeholder="Ingresa temas y actividades abordados"></textarea>
                            </div>
                        </div>

                        <!-- Campo: Eventualidades -->
                        <div class="row align-items-center mb-3">
                            <label for="eventualidades" class="col-sm-3  col-form-label text-dark">
                                <i class="bi bi-exclamation-circle me-2"></i> Eventualidades durante la sesión
                            </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="eventualidades" name="eventualidades" rows="3" placeholder="Ingresa Eventualidades durante la sesión"></textarea>
                                <p>(Riesgo de deserción, incumplimiento de acuerdos, faltas a la sesión, etc.)</p>
                            </div>
                        </div>

                        <!-- Botón de Enviar -->
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button id="btn_bitacora" type="submit" class="btn btn-primary">
                                    <i class="bi bi-send"></i> Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <hr class="m-0" />
            <section class="resume-section" id="consulta2">
                <div class="resume-section-content">
                    <h1 class="mb-4">Consulta tus citas</h1>                   
                    <form id="form_consulta2">
                        <!-- Matrícula -->
                        <div class="row align-items-center mb-3">
                            <label for="matricula" class="col-sm-3 col-form-label text-dark">
                                <div class="mb-4"><i class="bi bi-person-badge me-2"></i> Matrícula apoyador</div>
                                <div class="mb-4"><i class="bi bi-person me-2"></i> Nombre</div>
                            </label>
                            <div class="col-sm-9">
                                <div class="d-flex">
                                    <input required type="text" class="form-control w-50 mr-10 matri" id="matricula" name="matricula" maxlength="10" placeholder="Ingresa matrícula del apoyador" pattern="\d{10}" title="La matrícula debe contener 10 dígitos"  oninvalid="this.setCustomValidity('Por favor, ingrese una matrícula válida de 10 dígitos.')" oninput="setCustomValidity('')">
                                    &nbsp; &nbsp; <button type="button" class="btn btn-primary buscarmatnom" style="height:35px;">
                                        <i class="bi bi-search"></i> Buscar
                                    </button>
                                </div>
                                <input disabled type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del apoyador" style="margin-top: 5px;">
                            </div>
                            <div class="col-sm-12 mt-2" id="datos_consulta"></div>
                        </div>    
                    </form>
                </div>
            </section>
            <!-- Ayuda -->            
            <section class="resume-section" id="ayuda">                                
                <div class="resume-section-content"> 
                    <h1>Ayuda</h1>
                    <div class="container mt-4">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active text-primary" id="registro-tab" data-bs-toggle="tab" data-bs-target="#xregistro" type="button" role="tab">
                                    <i class="bi bi-person-plus me-1 text-primary"></i> Registro de Apoyos
                                </button>
                            </li>                            
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-primary" id="consulta-tab" data-bs-toggle="tab" data-bs-target="#xconsulta" type="button" role="tab">
                                    <i class="bi bi-calendar-check me-1 text-primary"></i> Consulta tus Citas
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-primary" id="experiencia-tab" data-bs-toggle="tab" data-bs-target="#xbitacora" type="button" role="tab">
                                    <i class="bi bi-pencil-square me-1 text-primary"></i> Llenar Bitácora
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="xregistro" role="tabpanel">
                                <p>En esta sección podrás registrarte para brindar apoyo en la Jornada Permanente de Apoyo entre Pares. Deberás proporcionar la siguiente información: matrícula, nombre completo, teléfono, correo institucional y personal, la división académica, carrera, los grados que tienes, tu especialidad y el trimestre.</p>
                                <img src="imgs/y1.png" class="imgayuda">
                                <p class="mt-3">Además y muy importante, es que debes seleccionar una o varias carreras en la que puedes otorgar apoyo, los días de la semana en los que puedes dar la asesoría, el horario -matutino o vespertino-, así como observaciones que sean utiles para tu labor de apoyo par.</p>
                                <img src="imgs/y2.png" class="imgayuda">
                                <p>Cuando finalices, solo tienes que hacer clic en el botón de <b>Enviar</b> para que quedes registrado.</p>

                            </div>                           
                            <div class="tab-pane fade" id="xconsulta" role="tabpanel">
                                <p>Siempre podrás consultar las citas de alumnos que solicitan tu apoyo para que las tengas presentes. Lo único que tienes que hacer es proporcionar tu matrícula y hacer clic en el botón de <b>Buscar</b>.</p>
                                <img src="imgs/y3.png" class="imgayuda">
                                <p class="mt-3">En la parte posterior aparecerá el listado de las citas que apareces. Si lo deseas, puedes mandar un mensaje por WhatsApp haciendo clic en la liga que dice: <strong>Mensaje ATAA</strong>.</p>
                                <img src="imgs/y4.png" class="imgayuda">
                                <p class="mt-3">Si haces clic en la liga que dice: <strong>Mensaje ATAA</strong> se abrirá una nueva ventana para que mandes un mensaje a ATAA por WhatsApp Web, y tú y el alumno apoyado se puedan poner en contacto.</p>
                                <img src="imgs/y5.png" class="imgayuda">
                                <p class="mt-3">Haz clic en el botón de Ir al chat y se abrirá WhatsApp. Solo haz clic en el botón de enviar el mensaje.</p>
                                <img src="imgs/y6.png" class="imgayuda">
                            </div>
                            <div class="tab-pane fade" id="xbitacora" role="tabpanel">
                                <p>Por último, una vez realizado el apoyo a tu compañero par, podrás llenar el formulario de reporte de bitácora de cómo les fue en la experiencia.</p>
                                <p class="mt-3">Proporciona el FOLIO de lu cita, tu matrícula y luego haz clic en el botón de <b>Buscar</b>. Aparecerá en automático tu nombre y el nombre de la persona que apoyaste. Proporciona el programa académico que cursas y trimestre.</p>
                                <img src="imgs/y7.png" class="imgayuda">
                                <p class="mt-3">Proporciona modalidad de la reunión, fecha de la sesión, hora de inicio, duración y ligar dónde se llevo a cabo la reunión.</p>
                                <img src="imgs/y8.png" class="imgayuda">
                                <p class="mt-3">Por último debes proporcionar los temas abordados y actividades realizadas, además de las eventualidades ocurridas durante la sesión que reflejen cómo les fue en la experiencia de apoyo.</p>
                                <img src="imgs/y9.png" class="imgayuda">
                                <p class="mt-3">Al final, haz clic en el botón de <b> Enviar</b> para guardar la información.</p>
                            </div>
                        </div>
                    </div>                           
                </div>
            </section>
        </div>     
        <!-- jQuery, Sweetalert2 JS -->
        <script src="js/jquery.min.js"></script>  
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script> <!-- Cargar idioma español -->

        <script src="js/sweetalert2.all.min.js"></script>
        <script src="js/default.js"></script>  
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>       
    </body>
</html>
