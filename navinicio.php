<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    date_default_timezone_set('America/Bogota');
    $hora = date("His");
    $fecha = date("Ymd");
    $accion = $_POST['accion'];
    if ($accion == 10) {
        include_once 'usuarioregistrar.php';
    } elseif ($accion == 11) {
        session_start(); // allows us to retrieve our key form the session
        include_once('configuracion/conexion.php');
        $pdo = Conexion::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['usuario'];
            $contrasena = $_POST['contrasena'];

            $sql = "SELECT COUNT(*) FROM usuario WHERE u_email = '$usuario' AND u_contrasena  = '$contrasena'";
            $query = $pdo->query($sql);
            $cantidad = $query->fetchColumn();

            if ($cantidad == 0) {
                echo '<script type="text/javascript">';
                echo 'setTimeout(function () { swal("Información!", "Usuario y/o contrasena no registrado","error");';
                echo '}, 1000);</script>';
            } else {

                $sql = "SELECT * FROM usuario WHERE u_email = ? AND u_contrasena = ? ";
                $ejecutar = $pdo->prepare($sql);
                $ejecutar->execute(array($usuario, $contrasena));
                $dato = $ejecutar->fetch(PDO::FETCH_ASSOC);
                $tipo = $dato['u_tipo'];
                if ($tipo == 1 || $tipo == 3) { // ADMINSTRADOR
                    $_SESSION['permitido'] = 'SI';
                    $_SESSION['usuario'] = $dato['u_id'];
                    header("Location: admin.php");
                    Conexion::desconectar();
                } elseif ($tipo == 2) { // CLIENTE
                    $_SESSION['permitido'] = 'SI';
                    $_SESSION['usuario'] = $dato['u_id'];
                    header("Location: cliente.php");
                    Conexion::desconectar();
                }  else {
                }
            }
        }
    }
}
?>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> <img src="imag/Logo3.PNG" alt="logo belleza" style="width: 10%; height: 10%;">
            LB Ferreteria</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php/..">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="presentacion.php">Catálogo</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModalUsuario">Registrarme</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModalsesion">Iniciar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" id="exampleModalUsuario" tabindex="-1" aria-labelledby="exampleModalUsuario" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalUsuario">Registrarme</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form ROLE="FORM" METHOD="POST" ACTION="">
                    <input type="hidden" class="form-control" id="accion" name="accion" value="10">

                    <div class="row">
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Cedula</label>
                                <input type="number" class="form-control" id="cedula" name="cedula" placeholder="Ingrese su numero de Cedula" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese sus Nombres" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingrese sus Apellidos" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Correo Electronico</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su Correo Electronico" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Celular</label>
                                <input type="number" class="form-control" id="celular" name="celular" placeholder="Ingrese su numero de Celular" required>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Ciudad</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ingrese su Ciudad" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese su Direccion" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingrese su Contraseña" required>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="contrasena2" name="contrasena2" placeholder="Confirmar su Contraseña" required>
                            </div>

                        </div>
                    </div>




                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--INICIAR SESION-->


<div class="modal fade" id="exampleModalsesion" tabindex="-1" aria-labelledby="exampleModalsesion" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalsesion">Iniciar sesión</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form ROLE="FORM" METHOD="POST" ACTION="">
                    <input type="hidden" class="form-control" id="accion" name="accion" value="11">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su Correo Electronico" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingrese sus Contraseña" required>
                    </div>

                    <center><button type="submit" class="btn btn-primary">Aceptar</button></center>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>