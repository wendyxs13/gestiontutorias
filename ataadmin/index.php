<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/favicon2.ico">
        <title>CDE | ATAAdmin</title>
        <!-- Bootstrap CSS AND sweetalert2-->
        <link rel="stylesheet" href="assets/bootstrap.min.css" >               
        <link rel="stylesheet" href="assets/sweetalert2.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        
        <!-- CSS personalizado -->
        <link rel="stylesheet" href="assets/login.css">
        <!-- Script personalizado -->            
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-dark bg-dark fixed-top" >
            <div class="container-fluid text-center">
                <a class="navbar-brand" href="#" style="width:100%">  
                     <h4 class="text-center d-inline-block align-top">Administrador de Apoyo entre Pares</h4>
                    <img src="images/logo.png" alt="Logo" width="10%" class="float-end d-inline-block align-top">
                </a>  
            </div>  
        </nav>
        <!-- Contenido principal -->
        <div class="container">
            <div class="row"><!-- row 1 -->
                <div class=" col-lg-7 col-md-7 mt-4"> 
                    <img class="rounded-pill img-fluid mt-1 mb-3 pb-3" src="images/ataaimg2.png" alt="">                  
                </div>
                <div class="col-lg-1 col-md-1 mt-5"></div>                
                <div class="col-lg-4 col-md-4 col-sm-11 mt-5">
                    <div class="card col-12 card_login">
                        <img class="img-fluid mt-1 mb-3 pb-3" src="images/inicio_sesion.png" alt="Iniciar sesion" style="max-width: 300px;">
                        <div>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend01">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input type="text" class="form-control" id="usutest" aria-describedby="inputGroupPrepend1" required placeholder="Usuario " >
                                <div class="invalid-feedback">
                                    Ingresa tu usuario
                                </div>
                            </div>
                            <div class=" mt-2 input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend02">
                                    <i class="bi bi-key"></i>
                                </span>
                                <input type="password" class="form-control" id="prueba" aria-describedby="inputGroupPrepend2" required placeholder="Contraseña" >
                                <div class="invalid-feedback">
                                    Ingresa tu contraseña
                                </div>
                            </div>
                            <div class="ml-5 mt-3">
                                &nbsp; &nbsp; &nbsp;<button id="inicio" class="text-center btn btn-success">Enviar</button>
                            </div>      

                        </div>                     
                    </div>
                </div>           
                
            </div><!-- row 1 -->          
        </div>
        <!-- Footer -->
        <footer>
            &copy; UAM-X,  Coordinación de Desarrollo Educativo
        </footer>

        <!-- jQuery y Bootstrap JS -->
        <!-- jQuery, Bootstrap and Sweetalert2 JS -->
        <script src="assets/jquery-3.7.0.min.js"></script>
        <script src="assets/bootstrap.bundle.min.js"></script>
        <script src="assets/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function () {
                $("#inicio").click(function () {
                    var ban = 1;
                    var usutest = $("#usutest").val();
                    var prueba = $("#prueba").val();

                    if (usutest == "") {
                        swal('w', 'Ingresa tu usuario');
                        ban = 0;
                        return false;
                    }
                    if (prueba == "") {
                        swal('w', 'Ingresa tu contraseña');
                        ban = 0;
                        return false;
                    }
                   
                    if (ban == 1) {
                        $.ajax({
                            url: 'php/pro_login.php',
                            type: 'POST',
                            data: {usutest:usutest,prueba:prueba},
                            success: function (r) {                             
                                if (r == 'Ok') {
                                    location.href = 'inicio.php?';
                                } else {
                                    swal('w', r);
                                }
                            },
                            error: function (xhr, status, error) {
                                //alert(xhr + "=>" + status + "=>" + error)
                            }
                        });//                       
                    }
                });

                function swal(type, msg) {
                    var title = '¡Éxito!';
                    var icon = 'success';
                    if (type == 'w') {
                        title = '¡Alerta¡';
                        icon = 'warning';
                    }
                    if (type == 'e') {
                        title = '¡Error¡';
                        icon = 'error';
                    }
                    Swal.fire({
                        title: title,
                        text: msg,
                        icon: icon,
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        </script>
    </body>
</html>
