<?php
/* if(!isset($_SESSION["user_id"])){ Core::redir("./");}
  $user= UserData::getById($_SESSION["user_id"]);
  // si el id  del usuario no existe.

  if($user==null){ Core::redir("./");}
 */
if (isset($_GET["opt"]) && $_GET["opt"] == "all"):
///////////////
    $base = new Database();
    $con = $base->connect();
    date_default_timezone_set("America/Mexico_City");
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");
    $sql2 = "INSERT INTO accesos (fecha, hora, usuario, ip, script, tipo,comentarios) Values 
    ('" . date("Y-m-d") . "','" . date("H:i:s") . "','" . strtoupper($_SESSION['user']) . "','','TODOS LOS USUARIOS','" . $_SESSION['tipo'] . "',
    'TODOS LOS USUARIOS')";
    $con->query($sql2);
    ////////////
    ?>

    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h2 class="page-title">
                        TODOS LOS USUARIOS
                    </h2>
                </div>
                <!-- Page title actions -->

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-12">

                    <a href="./?view=usuarios&opt=new" class="btn btn-secondary"><i class='bi-person'></i> Nuevo Usuario</a>
                    <br><br>
                    <?php
                    $users = UsuariosIntData::getAll();
                    if (count($users) > 0) {
                        ?>
                        <div class="card">
                            <div class="">
                                <table class="table datatable table-bordered datatable table-hover">
                                    <thead>
                                    <th>Nombre completo</th>
                                    <th>Nombre Usuario</th>
                                    <th>Email</th>
                                    <th>Puesto</th>
                                    <th></th>
                                    </thead>
                                    <?php
                                    foreach ($users as $user):
                                        ?>
                                        <tr>
                                            <td><?php echo $user->name; ?></td>
                                            <td><?php echo $user->User; ?></td>
                                            <td><?php echo $user->email; ?></td>
                                            <td><?php
                                                if ($user->tipo == 1) {
                                                    echo "ADMIN";
                                                } else if ($user->tipo == 2) {
                                                    echo "RECTORIA";
                                                } else if ($user->tipo == 3) {
                                                    echo "DIRECTOR";
                                                }
                                                ?></td>
                                            <td style="width:200px;">
                                                <a href="index.php?view=usuarios&opt=edit&id=<?php echo $user->id; ?>" class="btn btn-warning btn-sm">EDITAR</a>
                                                <a href="index.php?action=usuarios&opt=del&id=<?php echo $user->id; ?>" class="btn btn-danger btn-sm">ELIMINAR</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>

                    <?php } else {
                        ?>
                        <p class="alert alert-warning">No hay usuarios.</p>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php elseif (isset($_GET["opt"]) && $_GET["opt"] == "new"): ?>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h2 class="page-title">
                        NUEVO USUARIO
                    </h2>
                </div>
                <!-- Page title actions -->

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal" method="post" id="addproduct" action="index.php?action=usuarios&opt=add" role="form">
                                <div class="form-group">
                                    <label for="name" class="col-lg-2 control-label">Nombre y apellido*</label>
                                    <div class="col-md-6">
                                        <input type="text" name="name" required class="form-control" id="name" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="prefijo" class="col-lg-2 control-label">Prefijo*</label>
                                    <div class="col-md-6">
                                        <input type="text" name="prefijo"  class="form-control" id="prefijo" value="Dr." placeholder="Prefijo">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tipo" class="col-lg-2 control-label">Puesto</label>
                                    <div class="col-md-6">

                                        <select name="tipo" class="form-control" required>
                                            <option value="">-- SELECCIONE --</option>
                                            <option value="1">ADMIN</option>
                                            <option value="2">RECTORIA</option>
                                            <option value="3">DIRECTOR</option>
                                            <option value="4">JEFE DEPARTAMENTO</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="adscripcion" class="col-lg-2 control-label">Adscripcion*</label>
                                    <div class="col-md-6">
                                        <input type="text" name="adscripcion"  class="form-control" id="adscripcion" value="" placeholder="Adscripcion">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="division" class="col-lg-2 control-label">Division</label>
                                    <div class="col-md-6">
                                        <select id="division" name="division" class="form-control" required>
                                            <option value="">-- SELECCIONE --</option>
                                            <?php foreach (AlumnosData::getDivisiones() as $div): ?>
                                                <option value="<?php echo $div->DIV2; ?>"><?php echo $div->division; ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user" class="col-lg-2 control-label">Nombre de usuario*</label>
                                    <div class="col-md-6">
                                        <input type="text" required name="User" class="form-control" id="user" placeholder="Nombre de usuario">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-lg-2 control-label">Email*</label>
                                    <div class="col-md-6">
                                        <input type="text" required name="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Contrase&ntilde;a</label>
                                    <div class="col-md-6">
                                        <input type="password" required name="Password" class="form-control" id="inputEmail1" placeholder="Contrase&ntilde;a">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php elseif (isset($_GET["opt"]) && $_GET["opt"] == "edit"): ?>
    <?php $user = UsuariosIntData::getById($_GET["id"]); ?>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h2 class="page-title">
                        EDITAR USUARIO
                    </h2>
                </div>
                <!-- Page title actions -->

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal" method="post" id="addproduct" action="index.php?action=usuarios&opt=update" role="form">
                                <input type="hidden" name="id" value="<?php echo $user->id; ?>">
                                <div class="form-group">
                                    <label for="name" class="col-lg-2 control-label">Nombre y apellido*</label>
                                    <div class="col-md-6">
                                        <input type="text" name="name" value="<?php echo $user->name; ?>" required class="form-control" id="name" placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="prefijo" class="col-lg-2 control-label">Prefijo*</label>
                                    <div class="col-md-6">
                                        <input type="text" name="prefijo"  class="form-control" id="prefijo"  value="<?php echo $user->prefijo; ?>"placeholder="Prefijo">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tipo" class="col-lg-2 control-label">Puesto</label>
                                    <div class="col-md-6">

                                        <select id="tipo" name="tipo" class="form-control" required>
                                            <option value="">-- SELECCIONE --</option>
                                            <option value="1" <?php
                                            if ("1" == $user->tipo) {
                                                echo "selected";
                                            }
                                            ?>>ADMIN</option>
                                            <option value="2" <?php
                                            if ("2" == $user->tipo) {
                                                echo "selected";
                                            }
                                            ?>>RECTORIA</option>
                                            <option value="3" <?php
                                            if ("3" == $user->tipo) {
                                                echo "selected";
                                            }
                                            ?>>DIRECTOR</option>
                                            <option value="4" <?php
                                            if ("4" == $user->tipo) {
                                                echo "selected";
                                            }
                                            ?>>JEFE DEPARTAMENTO</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="adscripcion" class="col-lg-2 control-label">Adscripcion*</label>
                                    <div class="col-md-6">
                                        <input type="text" name="adscripcion"  class="form-control" id="adscripcion"  value="<?php echo $user->adscripcion; ?>" placeholder="Adscripcion">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="division" class="col-lg-2 control-label">Division</label>
                                    <div class="col-md-6">
                                        <select name="division" class="form-control" required id="division">
                                            <option value="">-- SELECCIONE --</option>
                                            <?php foreach (AlumnosData::getDivisiones() as $div): ?>
                                                <option value="<?php echo $div->DIV2; ?>" <?php
                                                if ($div->DIV2 == $user->division) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo $div->division; ?></option>
                                                    <?php endforeach; ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="User" class="col-lg-2 control-label">Nombre de usuario*</label>
                                    <div class="col-md-6">
                                        <input type="text" required name="User" id="User" class="form-control"  value="<?php echo $user->User; ?>" placeholder="Nombre de usuario">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-lg-2 control-label">Email*</label>
                                    <div class="col-md-6">
                                        <input type="text" required name="email" class="form-control"  value="<?php echo $user->email; ?>" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="clvpass" class="col-lg-2 control-label">Contrase&ntilde;a</label>
                                    <div class="col-md-6">
                                        <input type="password" required name="Password" class="form-control"  value="<?php echo $user->Password; ?>" id="clvpass" placeholder="Contrase&ntilde;a">
                                    </div>
                                </div>

                                <br>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>