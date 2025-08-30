<?php include_once 'headprivado.php' ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idusuario = $_POST['idusuario'];
    $cedula = $_POST['cedula'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $emailviejo = $_POST['emailviejo'];
    $celular = $_POST['celular'];
    $ciudad = $_POST['ciudad'];
    $direccion = $_POST['direccion'];
    $contrasena = $_POST['contrasena'];

    function validaremail($email, $emailviejo)
    {
        if ($email != $emailviejo) {
            $cantidad = 1;
        } else {
            $cantidad = 0;
        }
        return $cantidad;
    }

    $ValidarC = validaremail($email, $emailviejo);

    $sqlcantidad = "SELECT COUNT(*) FROM usuario WHERE u_email = '$email' ";
    $query = $pdo->query($sqlcantidad);
    $cantidad = $query->fetchColumn();
    if ($ValidarC == 1) {

        if ($cantidad != 0) {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Información!", "El correo electrónico ya está registrado.","error");';
            echo '}, 1000);</script>';
        } else {

            $sql = "UPDATE usuario SET u_nombres = ?,u_apellidos = ?,u_identificacion = ?,u_email = ?,u_ciudad = ?,u_direccion = ?,u_celular = ?,u_contrasena = ? WHERE  u_id = ? ";
            $ejecutar = $pdo->prepare($sql);
            $ejecutar->execute(array($nombres, $apellidos, $cedula, $email, $ciudad, $direccion, $celular, $contrasena, $idusuario));
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Información!", "Actualizacion exitosa con email nuevo","success");';
            echo '}, 1000);</script>';
            Conexion::desconectar();
        }
    } else {

        $sql = "UPDATE usuario SET u_nombres = ?, u_apellidos = ?, u_identificacion = ?,u_email = ?,u_ciudad = ?,u_direccion = ?,u_celular = ? ,u_contrasena = ? WHERE  u_id = ?";
        $ejecutar = $pdo->prepare($sql);
        $ejecutar->execute(array($nombres, $apellidos, $cedula, $emailviejo, $ciudad, $direccion, $celular, $contrasena, $idusuario));
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Información!", "Actualizacion exitos","success");';
        echo '}, 1000);</script>';
        Conexion::desconectar();
    }
}
?>

<body>
    <?php include_once 'navcliente.php' ?>
    <main>
        <div class="card-header bg-warning" style="color: black;">
            <strong>PERFIL DEL USUARIO LB FERRETERIA</strong>
        </div>
        <br />

        <div class="container">
            <div class="card">
                <h5 class="card-header">Información de usuario</h5>
                <div class="card-body">
                    <form ROLE="FORM" METHOD="POST" ACTION="">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Cedula</label>
                                    <input type="hidden" class="form-control" id="idusuario" name="idusuario" value="<?php echo !empty($idadmin) ? $idadmin : ''; ?>">
                                    <input type="number" class="form-control" id="cedula" name="cedula" value="<?php echo !empty($cedulaadmin) ? $cedulaadmin : ''; ?>" placeholder="Ingrese su numero de Cedula" required>

                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nombres</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo !empty($nombresadmin) ? $nombresadmin : ''; ?>" placeholder="Ingrese sus Nombres" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo !empty($apellidosadmin) ? $apellidosadmin : ''; ?>" placeholder="Ingrese sus Apellidos" required>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Correo Electronico</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo !empty($emailadmin) ? $emailadmin : ''; ?>" placeholder="Ingrese su Correo Electronico" required>
                                    <input type="hidden" class="form-control" id="emailviejo" name="emailviejo" value="<?php echo !empty($emailadmin) ? $emailadmin : ''; ?>">

                                </div>



                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Celular</label>
                                    <input type="number" class="form-control" id="celular" name="celular" value="<?php echo !empty($celularadmin) ? $cedulaadmin : ''; ?>" placeholder="Ingrese su numero de Celular" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Ciudad</label>
                                    <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo !empty($ciudadadmin) ? $ciudadadmin : ''; ?>" placeholder="Ingrese su Ciudad" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo !empty($direccionadmin) ? $direccionadmin : ''; ?>" placeholder="Ingrese su Direccion" required>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="contrasena" name="contrasena" value="<?php echo !empty($contrasenaadmin) ? $contrasenaadmin : ''; ?>" placeholder="Ingrese su Contraseña" required>
                                </div>

                            </div>
                        </div>

                        <center><button type="submit" class="btn btn-warning">Actualizar</button></center>
                    </form>
                </div>
            </div>
        </div>

    </main>
    <br>
    <?php include_once 'footer.php' ?>

</body>

</html>