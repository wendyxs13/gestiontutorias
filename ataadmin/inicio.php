<?php
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['at_usuario']) || !isset($_SESSION['at_rol'])) {
    header("location:index.php");
}
$usuario = ($_SESSION['at_usuario']);
$rol = ($_SESSION['at_rol']);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="images/favicon2.ico" />
        <title>CDE | ATAA</title>
        <!-- CSS de Bootstrap 5 -->
        <link href="assets/bootstrap.min.css" rel="stylesheet">
        <link href="assets/sweetalert2.min.css" rel="stylesheet" >
        <link href="assets/css2popins.css" rel="stylesheet">        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        
        <!-- CSS de DataTables -->
        <link href="assets/dataTables.bootstrap5.min.css" rel="stylesheet">
        <!-- DataTables Buttons CSS (para exportar) -->
        <link href="assets/buttons.bootstrap5.min.css" rel="stylesheet">
        <!-- CSS personalizado -->
        <link rel="stylesheet" href="assets/estilos.css">           
    </head>
    <body>
        <!-- Bloqueo de pantalla -->
        <div id="overlay">
            <img id="loading-icon" src="images/load.gif" alt="Procesando..." width="200">
        </div>
        <!-- Navbar -->
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid text-center" style="padding: 5px 0 0 0 !important">
                <img src="images/logo.png" width="15%" class="cpoint float-start d-inline-block align-top ms-3" id="inicio">
                <h4>Administrador de Apoyo entre Pares</h4>
                <div class="dropdown me-3" onmouseover="openSubMenu()" onmouseout="closeSubMenu()">
                    <a class="dropdown-toggle float-end fs-5 me-3" href="#" role="button" id="dropdownMenuLink" aria-expanded="false" style="text-decoration: none!important;">
                        <i class="bi bi-person" style="color:#fff;"></i> <span style="text-transform: capitalize; color:#fff; text-decoration: none; ">
                            <?php echo (ucfirst(strtolower($usuario))); ?></span>
                    </a>
                    <span id="mnuCerrar" class="dropdown-menu text-center" aria-labelledby="dropdownMenuLink">
                        <a id="closes" class="dropdown-item fs-6" href="salir.php" style="color: #ddd;">Cerrar</a>
                    </span>
                </div>
            </div>
        </nav>
        <!-- Menú lateral izquierdo -->
        <div class="sidebar">
            <a class="" data-tbl="apoyos" href="">
                <i class="bi bi-house"></i> Inicio
            </a>
            <hr class="mt-1 mb-1"/>
            <a class="getbl" data-tbl="apoyos" href="" id="mnu_apoyos">
                <i class="bi bi-hand-thumbs-up"></i> Apoyos
            </a>
            <a class="getbl" data-tbl="bitacora" href="" id="mnu_bitacora">
                <i class="bi bi-journal-text"></i> Bitácora
            </a>
            <hr class="mt-1 mb-1"/>
            <a class="getbl" data-tbl="apoyados" href="" id="mnu_apoyados">
                <i class="bi bi-person-check"></i> Apoyados
            </a>
            <a class="getbl" data-tbl="experiencia" href="" id="mnu_experiencia">
                <i class="bi bi-chat-left-quote"></i> Experiencias
            </a>
            <hr class="mt-1 mb-1"/>
            <a class="getbl" data-tbl="agenda" href="" id="mnu_agenda">
                <i class="bi bi-calendar-check"></i> Agenda
            </a>             
            <a class="getrep" href="" id="mnu_reportes">
                <i class="bi bi-clipboard-data"></i> Reportes
            </a>                        
        </div>

        <!-- Contenido principal -->
        <div class="content">
            <h3 id="title"></h3>
            <div id="tblcontent">
                <img id="imgat" src="images/ataaimg2.png" alt="">                  
            </div>            
        </div>
        <div class="modal fade modal-lg" id="miModal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="miModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row" id="contenedorGrafica">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>                        
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-lg" id="modalForm" tabindex="-1" aria-labelledby="modalLabelForm" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="modalLabelForm">Editar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>                   
                    <div class="modal-body" id="contenidoModal"></div>
                    <!--                    <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>                        
                                        </div>-->

                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="text-center mt-5">
            &copy; UAM-X, Coordinación de Desarrollo Educativo
        </footer>

        <!-- JS de Bootstrap 5 -->
        <script src="assets/bootstrap.bundle.min.js"></script>
        <script src="assets/jquery-3.7.0.min.js"></script>
        <!-- JS de DataTables -->
        <script src="assets/jquery.dataTables.min.js"></script>
        <script src="assets/dataTables.bootstrap5.min.js"></script>
        <!-- JS de DataTables Buttons (para exportar) -->
        <script src="assets/dataTables.buttons.min.js"></script>
        <script src="assets/buttons.bootstrap5.min.js"></script>
        <!-- Plugins para exportar a Excel, CSV, PDF -->
        <script src="assets/jszip.min.js"></script>
        <script src="assets/buttons.html5.min.js"></script>
        <script src="assets/chart.js"></script>
        <script src="assets/sweetalert2.all.min.js"></script>
        <!-- Script personalizado -->
        <script src="assets/tablas.js"></script>    
        <script src="assets/scripts.js"></script> 
        <script>
                    var usuario = '<?php echo $usuario; ?>';
                    var rol = '<?php echo $rol; ?>';
        </script>
    </body>
</html>
