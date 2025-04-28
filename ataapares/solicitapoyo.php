<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ATAA | Apoyo Pares</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav" >                     
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
                        <a class="mnugral nav-link js-scroll-trigger" href="#apoyados" id="mnu_apoyados" >
                            <i class="bi bi-person-plus"></i> Registro de apoyados
                        </a>
                    </li>                    
                    <li class="nav-item">
                        <a class="mnugral nav-link js-scroll-trigger" href="#agenda" id="mnu_agenda" >
                            <i class="bi bi-search"></i> Selecciona tu apoyo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="mnugral nav-link js-scroll-trigger" href="#consulta" id="mnu_consulta" >
                            <i class="bi bi-calendar-check"></i> Consulta tus citas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="mnugral nav-link js-scroll-trigger" href="#experiencia" id="mnu_experiencia" >
                            <i class="bi bi-pencil-square"></i> Llenar Experiencia
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
                    <h6 class="text-primary mt-3 mb-2" style="width: 100%; text-align: center; opacity:.7;">
                        Acompañamiento de Trayectorias Académicas del Alumnado (ATAA)</h6>
                    <h5 style="width: 100%; text-align: center;color:#333;">JORNADA PERMANENTE DE APOYO ENTRE PARES</h5>
                    <br />
                    <h1 class="mt-4">Alumnos &nbsp;Apoyados </h1>    
                    <img src="imgs/pares1.png" class="imgpares">
                </div>
            </section>

            <section class="resume-section" id="apoyados">
                <div class="resume-section-content">
                    <h1 class="mb-4">Registro de apoyados</h1>
                    <form id="form_apoyados">
                        <!-- Campo: Matrícula -->
                        <div class="row align-items-center mb-3">
                            <label for="matricula" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-person-badge me-2"></i> Matrícula
                            </label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control matri" id="matricula" name="matricula" maxlength="10" placeholder="Ingresa matrícula" pattern="\d{10}" title="La matrícula debe contener 10 dígitos"  oninvalid="this.setCustomValidity('Por favor, ingrese una matrícula válida de 10 dígitos.')" oninput="setCustomValidity('')">
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
                                <input required type="text" class="form-control fone" id="telefono" name="telefono" maxlength="10" placeholder="Ingresa teléfono" pattern="\d{10}" title="La matrícula debe contener 10 dígitos"  oninvalid="this.setCustomValidity('Por favor, ingrese telefono válido de 10 dígitos.')" oninput="setCustomValidity('')">
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
                                    <input required class="form-check-input mr-5 big-radio" type="radio" name="division1" value="CBS" id="cbs" onclick="mostrarCarreras2()"> 
                                    &nbsp; <label class="form-check-label" for="cbs">
                                        CBS
                                    </label>
                                </div>
                                &nbsp; &nbsp; &nbsp; &nbsp; 
                                <div class="form-check form-check-inline mr-5 ">
                                    <input required class="form-check-input mr-5 big-radio" type="radio" name="division1" value="CSH" id="csh" onclick="mostrarCarreras2()"> 
                                    &nbsp; <label class="form-check-label" for="csh">
                                        CSH
                                    </label>
                                </div>   
                                &nbsp; &nbsp; &nbsp; &nbsp; 
                                <div class="form-check form-check-inline mr-10 ">
                                    <input required class="form-check-input mr-5 big-radio" type="radio" name="division1" value="CyAD" id="cyad" onclick="mostrarCarreras2()"> 
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
                                <div id="carreras" class="carreras">
                                    <select required id="listaCarreras1" name="carrera" class="form-select" disabled>
                                        <option value="">Selecciona una división primero</option>
                                    </select>
                                </div>
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

                        <!-- Campo: temas -->
                        <div class="row align-items-center mb-3">
                            <label for="temas" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-journal-text me-2"></i> Especifica en qué temas requieres el apoyo
                            </label>
                            <div class="col-sm-9">
                                <textarea required class="form-control" id="temas" name="temas" rows="4" placeholder="Especifica en qué temas requieres el apoyo"></textarea>
                            </div>
                        </div>

                        <!-- Botón de Enviar -->
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button id="btn_apoyados" type="submit" class="btn btn-primary">
                                    <i class="bi bi-send"></i> Enviar
                                </button>
                            </div>
                        </div>
                    </form>                   

                </div>
            </section>

            <section class="resume-section" id="experiencia">
                <div class="resume-section-content">
                    <h1 class="mb-4">Llenado de Experiencia de quién recibió el apoyo</h1>
                    <form id="form_experiencia">

                        <!-- Matrícula -->
                        <div class="row align-items-center mb-3">
                            <label for="matricula" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-tag"></i> FOLIO y 
                                <i class="bi bi bi-person-badge me-2"></i> Matrícula del apoyado
                            </label>
                            <div class="col-sm-9">
                                <div class="d-flex">
                                    <input required type="text" class="form-control me-2 matri" id="folio_expbit" maxlength="4" placeholder="Folio de la cita" pattern="\d{1,4}" style="width: 150px;">
                                    <input required type="text" class="form-control w-50 me-2 matri" id="matricula_expbit"  maxlength="10" placeholder="Ingresa matrícula del apoyado" pattern="\d{10}" title="La matrícula debe contener 10 dígitos"  oninvalid="this.setCustomValidity('Por favor, ingrese una matrícula válida de 10 dígitos.')" oninput="setCustomValidity('')">
                                    &nbsp; &nbsp; <button type="button" class="btn btn-primary buscarmatnom" style="height:35px;">
                                        <i class="bi bi-search"></i> Buscar
                                    </button>
                                </div>

                                <input required type="hidden" id="folio" name="folio" >
                                <input required type="hidden" id="matricula" name="matricula">
                                <input required disabled type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del apoyado" style="margin-top: 5px;">
                            </div>
                        </div>                        
                        <!-- Programa académico -->
                        <div class="row align-items-center mb-3">
                            <label for="programa" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-book me-2"></i> Programa académico
                            </label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="programa" name="programa" placeholder="Ingresa programa académico">
                            </div>
                        </div>

                        <!-- Trimestre -->
                        <div class="row align-items-center mb-3">
                            <label for="trimestre" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-calendar3 me-2"></i> Trimestre
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

                        <!-- Nombre del Apoyo Par -->
                        <div class="row align-items-center mb-3">
                            <label for="nombreapoyo" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-people me-2"></i> Nombre de la persona que te apoyó
                            </label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="nombreapoyo" name="nombreapoyo" placeholder="Ingresa nombre de la persona que te apoyó">
                            </div>
                        </div>

                        <!-- Modalidad (Presencial o Remota) -->
                        <div class="row align-items-center mb-3">
                            <label for="modalidad" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-camera-video me-2"></i> Modalidad de reunión
                            </label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input required class="form-check-input big-radio" type="radio" name="modalidad" value="Presencial" id="presencial"> 
                                    <label class="form-check-label" for="presencial">Presencial</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input required class="form-check-input big-radio" type="radio" name="modalidad" value="Remota" id="remota"> 
                                    <label class="form-check-label" for="remota">Remota (Vía Zoom)</label>
                                </div> 
                            </div>
                        </div>

                        <!-- Medios de comunicación (checkbox) -->
                        <div class="row align-items-center mb-3">
                            <label for="medios" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-chat me-2"></i> Medios de comunicación
                            </label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input  class="form-check-input big-radio" type="checkbox" id="correo" name="medios" value="Correo electrónico">
                                    <label class="form-check-label" for="correo">Correo electrónico</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input  class="form-check-input big-radio" type="checkbox" id="oficina" name="medios" value="Oficina de ATAA">
                                    <label class="form-check-label" for="oficina">Oficina de ATAA</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input  class="form-check-input big-radio" type="checkbox" id="celular" name="medios" value="Celular">
                                    <label class="form-check-label" for="celular">Celular</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input  class="form-check-input big-radio" type="checkbox" id="videoconferencia" name="medios" value="Videoconferencia">
                                    <label class="form-check-label" for="videoconferencia">Videoconferencia</label>
                                </div>
                            </div>
                        </div>

                        <!-- Resolución de dudas (radio) -->
                        <div class="row align-items-center mb-3">
                            <label for="resolucion" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-question-circle me-2"></i> Resolución de dudas
                            </label>

                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input required class="form-check-input big-radio" type="radio" name="resolucion" value="Ninguna" id="ninguna"> 
                                    <label class="form-check-label" for="ninguna">Ninguna</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input required class="form-check-input big-radio" type="radio" name="resolucion" value="Casi ninguna" id="algunas"> 
                                    <label class="form-check-label" for="casi_ninguna">Casi ninguna</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input required class="form-check-input big-radio" type="radio" name="resolucion" value="Algunas" id="algunas"> 
                                    <label class="form-check-label" for="algunas">Algunas</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input required class="form-check-input big-radio" type="radio" name="resolucion" value="Casi todas" id="algunas"> 
                                    <label class="form-check-label" for="casi_todas">Casi todas</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input required class="form-check-input big-radio" type="radio" name="resolucion" value="Todas" id="todas"> 
                                    <label class="form-check-label" for="todas">Todas</label>
                                </div>
                            </div>
                        </div>

                        <!-- Comentarios -->
                        <div class="row align-items-center mb-3">
                            <label for="comentarios" class="col-sm-3 col-form-label text-dark">
                                <i class="bi bi-chat-dots me-2"></i> Comentarios
                            </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="comentarios" name="comentarios" rows="3"></textarea>
                            </div>
                        </div>

                        <!-- Botón de Enviar -->
                        <div class="row mb-3">
                            <div class="col-sm-9 offset-sm-3">
                                <button id="btn_experiencia" type="submit" class="btn btn-primary">
                                    <i class="bi bi-send"></i> Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <section class="resume-section" id="agenda">
                <div class="resume-section-content">
                    <h1 class="mb-4">Selecciona tu apoyo para agendar tus citas</h1>
                    <form id="form_agenda">
                        <!-- Matrícula -->
                        <div class="row align-items-center">
                            <label for="matricula" class="col-sm-3 col-form-label text-dark">
                                <div class="mb-4"><i class="bi bi-person-badge me-2"></i> Matrícula solicitante de apoyo</div>
                                <div class="mb-4"><i class="bi bi-person me-2"></i> Nombre</div>
                                <div class="mb-4"><i class="bi bi-mortarboard me-2"></i> Licenciatura</div>
                                <div class="mb-4"><i class="bi bi-calendar3 me-2"></i> Trimestre</div>
                                <div class="mb-4"><i class="bi bi-journal-text me-2"></i> Temas de apoyo</div>
                            </label>
                            <div class="col-sm-9">
                                <div class="d-flex">
                                    <input required type="text" class="form-control mb-2 w-50 mr-10" id="matricula_selecciona" name="matricula_selecciona" maxlength="12" placeholder="Ingresa matrícula de quién solicita el apoyo" pattern="\d{10}" title="La matrícula debe contener 10 dígitos" oninvalid="this.setCustomValidity('Por favor, ingrese una matrícula válida de hasta 10 dígitos.')" oninput="setCustomValidity('')">
                                    &nbsp; &nbsp; <button id="buscarmat" type="button" class="btn btn-primary " style="height:35px;">
                                        <i class="bi bi-search"></i> Buscar
                                    </button>
                                </div>
                                <input type="hidden" id="matricula_apoyado" name="matricula_apoyado">
                                <input disabled type="text" class="form-control mb-2" id="nombre_apoyado" name="nombre_apoyado" >
                                <input disabled type="text" class="form-control mb-2" id="licenciatura" name="licenciatura">
                                <input disabled type="text" class="form-control mb-2" id="trimestre" name="trimestre">
                                <textarea  class="form-control" id="temas_apoyo" name="temas_apoyo"></textarea>
                            </div>
                        </div>                                                                        

                        <!-- Apoyo Par -->
                        <div class="row align-items-center mb-3">
                            <label for="apoyo_par" class="col-form-label text-dark">
                                <i class="bi bi-people me-2"></i> Selecciona a un Apoyo Par 
                                <span class="float-end">Horarios: Matutino de 8:00 a 12:00 PM &nbsp;y&nbsp; Vespertino de 12:00 a 19:00 PM</span>
                        </div>   
                        <div class="row align-items-center mb-3">
                            <div id="select_apoyos"></div>
                        </div>
                        <!-- Botón de Enviar -->
                        <div class="row">
                            <div class="col-sm-9 offset-sm-3">
                                <button disabled id="btn_agenda" type="submit" class="btn btn-primary">
                                    <i class="bi bi-send"></i> Enviar
                                </button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </section>

            <section class="resume-section" id="consulta">
                <div class="resume-section-content">
                    <h1 class="mb-4">Consulta tus citas</h1>                    
                    <form id="form_consulta">
                        <!-- Matrícula -->
                        <div class="row align-items-center mb-3">
                            <label for="matricula" class="col-sm-3 col-form-label text-dark">
                                <div class="mb-4"><i class="bi bi-person-badge me-2"></i> Matrícula del apoyado</div>
                                <div class="mb-4"><i class="bi bi-person me-2"></i> Nombre</div>                                
                            </label>
                            <div class="col-sm-9">
                                <div class="d-flex">
                                    <input required type="text" class="form-control w-50 mr-10 matri" id="matricula" maxlength="10" placeholder="Ingresa matrícula de quién recibe el apoyo" pattern="\d{10}" title="La matrícula debe contener 10 dígitos"  oninvalid="this.setCustomValidity('Por favor, ingrese una matrícula válida de 10 dígitos.')" oninput="setCustomValidity('')">                                
                                    &nbsp; &nbsp; <button type="button" class="btn btn-primary buscarmatnom" style="height:35px;">
                                        <i class="bi bi-search"></i> Buscar
                                    </button>
                                </div>
                                <input disabled type="text" class="form-control" id="nombre" style="margin-top: 5px;">                                
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
                                    <i class="bi bi-person-plus me-1 text-primary"></i> Registro de Apoyados
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-primary" id="selecciona-tab" data-bs-toggle="tab" data-bs-target="#xselecciona" type="button" role="tab">
                                    <i class="bi bi-search me-1 text-primary"></i> Selecciona tu Apoyo
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-primary" id="consulta-tab" data-bs-toggle="tab" data-bs-target="#xconsulta" type="button" role="tab">
                                    <i class="bi bi-calendar-check me-1 text-primary"></i> Consulta tus Citas
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-primary" id="experiencia-tab" data-bs-toggle="tab" data-bs-target="#xexperiencia" type="button" role="tab">
                                    <i class="bi bi-pencil-square me-1 text-primary"></i> Llenar Experiencia
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent" >
                            <div class="tab-pane fade show active" id="xregistro" role="tabpanel">
                                <p>En esta sección podrás registrarte para recibir apoyo en la Jornada Permanente de Apoyo entre Pares. Deberás proporcionar la siguiente información: matrícula, nombre completo, teléfono, correo institucional y personal, la división académica, carrera, trimestre y en qué temas requieres el apoyo.</p>
                                <img src="imgs/x1.png" class="imgayuda">
                                <p class="mt-2">Cuando finalices, solo tienes que hacer clic en el botón de <b>Enviar</b> para que quedes registrado.</p>

                            </div>
                            <div class="tab-pane fade" id="xselecciona" role="tabpanel">
                                <p>En este apartado podrás seleccionar tu apoyo par. Primero tienes que ingresar tu matrícula y hacer clic en el botón de <b>Buscar</b>.</p>
                                <p>De inmediato aparecerá en la parte inferior tu nombre, licenciatura, trimestre y los temas de apoyo de tu solicitud de registro. Puedes agregar o quitar temas según tus dudas a resolver.</p>
                                <img src="imgs/x2.png" class="imgayuda">
                                <p class="mt-3">Una vez que se te presenten tus datos, también en la parte inferior aparecerán varios alumnos de apoyo, de los cuales podrás seleccionar uno dependiendo de quien se ajuste a tus necesidades, según el horario y la licenciatura del alumno que te brindará el apoyo.</p>
                                <img src="imgs/x3.png" class="imgayuda">
                                <p class="mt-3">Selecciona uno de los alumnos de apoyo y luego haz clic en el botón de <b> Enviar</b> para que se guarde la información del contacto. Se te enviará un mensaje con el FOLIO que te corresponde de la cita. No olvides guardar tu folio.</p>
                                <img src="imgs/x4.png" style="width: 50%">
                                <p class="mt-3">Se enviará un mensaje al correo del solicitante de apoyo y al correo del alumno apoyador. También se abrirá una nueva ventana para que mandes un mensaje a ATAA por WhatsApp Web, y tú y el alumno de apoyo se puedan poner en contacto.</p>
                                <img src="imgs/x5.png" class="imgayuda">
                                <p class="mt-3">Haz clic en el botón de Ir al chat y se abrirá WhatsApp. Solo haz clic en el botón de enviar el mensaje.</p>
                                <img src="imgs/x6.png" class="imgayuda">
                            </div>
                            <div class="tab-pane fade" id="xconsulta" role="tabpanel">
                                <p>Siempre podrás consultar tus citas para que las tengas presentes. Lo único que tienes que hacer es proporcionar tu matrícula y hacer clic en el botón de <b>Buscar</b>.</p>
                                <img src="imgs/x7.png" class="imgayuda">
                                <p class="mt-3">En la parte posterior aparecerá el listado de las citas que registraste. Si lo deseas, puedes volver a mandar el mensaje por WhatsApp haciendo clic en la liga que dice: <strong>Mensaje ATAA</strong>.</p>
                                <img src="imgs/x8.png" class="imgayuda">
                            </div>
                            <div class="tab-pane fade" id="xexperiencia" role="tabpanel">
                                <p>Por último, una vez que hayas recibido el apoyo por parte de tu compañero par, podrás llenar el formulario de cómo te fue en la experiencia.</p>
                                <p>Proporciona el FOLIO de tu cita, tu matrícula y luego haz clic en el botón de <b>Buscar</b>. Aparecerá en automático tu nombre y el nombre de la persona que te apoyó.</p>
                                <img src="imgs/x9.png" class="imgayuda">
                                <p>Proporciona el programa académico que cursas, trimestre, modalidad de la reunión, medio de comunicación por el cual hicieron contacto, si se resolvieron las dudas o no, y podrás agregar comentarios adicionales que reflejen cómo les fue en la experiencia de apoyo.</p>
                                <p>Al final, haz clic en el botón de <b> Enviar</b> para guardar la información.</p>
                            </div>
                        </div>
                    </div>                           
                </div>
            </section>

        </div>     
        <!-- jQuery, Sweetalert2 JS -->
        <script src="js/jquery.min.js"></script>       
        <script src="js/sweetalert2.all.min.js"></script>
        <script src="js/default.js"></script>  
        <!-- Bootstrap core JS-->       
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->  
        <script src="js/scripts.js"></script>   
    </body>
</html>
