<?php include_once 'headprivado.php' ?>
<?php include_once 'error.php' ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    date_default_timezone_set('America/Bogota');
    $hora = date("His");
    $fecha = date("Ymd");
    $accion = $_POST['accion'];
    if ($accion == 1) {
        include_once 'usuarioregistrar.php';
    } else if ($accion == 2) {
        include_once 'usuarioactualizar.php';
    } else if ($accion == 3) {
        $id = $_POST['id'];
        $sqlcarrito = "SELECT COUNT(*) FROM carrito WHERE c_idproductofk  = '$id'";
        $querycarrito2 = $pdo->query($sqlcarrito);
        $cantidadcarrito = $querycarrito2->fetchColumn();

        if ($cantidadcarrito != 0) {
            echo '<script language="javascript">alert("El producto esta en carrito por algun cliente");</script>';
        } else {
            $eliminar = "DELETE FROM usuario WHERE p_id = ?";
            $ejecutar = $pdo->prepare($eliminar);
            $ejecutar->execute(array($id));
            echo '<script language="javascript">alert("Eliminacion Exitosa");</script>';
            Conexion::desconectar();
        }
    }
}
?>

<body>
    <?php include_once 'navadmin.php' ?>
    <main>
        <div class="card-header bg-warning" style="color: black;">
            <strong>MODULO DE NOMINA</strong>
        </div>
        <br />

        <div class="container">

            <div class="modal fade" id="exampleModalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form ROLE="FORM" METHOD="POST" ACTION="">
                                <input type="hidden" class="form-control" id="accion" name="accion" value="1">

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
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Tipo de Usuario</label>

                                            <select class="form-select form-select" name="tipo" id="tipo">
                                                <option value="1" selected>Administrador</option>
                                                <option value="3">Bodega</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-warning">Guardar</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="card">
                <div class="card-header" style="background-color: black; color: orange;">
                    <h6> Tabla de Nomina</h6>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalRegistrar">
                        <i class='bx bxs-add-to-queue'></i>&nbsp;&nbsp;Registrar
                    </button>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatablesSimple" class="display table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <center>Cedula</center>
                                    </th>
                                    <th scope="col">
                                        <center>Nombre y Apellidos</center>
                                    </th>
                                    <th scope="col">
                                        <center>Email</center>
                                    </th>
                                    <th scope="col">
                                        <center>Ciudad</center>
                                    </th>
                                    <th scope="col">
                                        <center>Celular</center>
                                    </th>
                                    <th scope="col">
                                        <center>Tipo</center>
                                    </th>
                                    <th scope="col">
                                        <center>Actualizar</center>
                                    </th>
                                    <th scope="col">
                                        <center>Eliminar</center>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $clientes = 'SELECT * FROM usuario WHERE u_tipo != 2 ORDER BY u_id DESC;';
                                foreach ($pdo->query($clientes) as $dato) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $dato['u_identificacion'] ?></th>
                                        <td><?php echo $dato['u_nombres'] . " " . $dato['u_apellidos'] ?></td>
                                        <td><?php echo $dato['u_email'] ?></td>
                                        <td><?php echo $dato['u_ciudad'] ?></td>
                                        <td><?php echo $dato['u_celular'] ?></td>
                                        <?php
                                        if ($dato['u_tipo'] == 1) {
                                        ?>
                                            <td>Administrador</td>
                                        <?php

                                        } else {
                                        ?>
                                            <td>Bodega</td>
                                        <?php
                                        }
                                        ?>
                                        <!-- ACTUALIZAR CLIENTE -->
                                        <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModalVer<?php echo $dato['u_id'] ?>">
                                                <i class='bx bxs-check-circle'></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalVer<?php echo $dato['u_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalVer<?php echo $dato['u_id'] ?>">Informacion del Cliente</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <form ROLE="FORM" METHOD="POST" ENCTYPE="MULTIPART/FORM-DATA" ACTION="">
                                                                <input type="hidden" class="form-control" id="accion" name="accion" value="2">
                                                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo !empty($dato['u_id']) ? $dato['u_id'] : ''; ?>" required>
                                                                <div class="row">
                                                                    <div class="col-md-6">

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Cedula</label>
                                                                            <input type="number" class="form-control" id="cedula" name="cedula" value="<?php echo !empty($dato['u_identificacion']) ? $dato['u_identificacion'] : ''; ?>" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Nombres</label>
                                                                            <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo !empty($dato['u_nombres']) ? $dato['u_nombres'] : ''; ?>" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Apellidos</label>
                                                                            <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo !empty($dato['u_apellidos']) ? $dato['u_apellidos'] : ''; ?>" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Correo Electronico</label>
                                                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo !empty($dato['u_email']) ? $dato['u_email'] : ''; ?>" required>
                                                                            <input type="hidden" class="form-control" id="emailviejo" name="emailviejo" value="<?php echo !empty($dato['u_email']) ? $dato['u_email'] : ''; ?>" required>

                                                                        </div>



                                                                    </div>
                                                                    <div class="col-md-6">

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Celular</label>
                                                                            <input type="number" class="form-control" id="celular" name="celular" value="<?php echo !empty($dato['u_celular']) ? $dato['u_celular'] : ''; ?>" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Ciudad</label>
                                                                            <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo !empty($dato['u_ciudad']) ? $dato['u_ciudad'] : ''; ?>" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Dirección</label>
                                                                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo !empty($dato['u_direccion']) ? $dato['u_direccion'] : ''; ?>" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Contraseña</label>
                                                                            <input type="password" class="form-control" id="contrasena" name="contrasena" value="<?php echo !empty($dato['u_contrasena']) ? $dato['u_contrasena'] : ''; ?>" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Tipo de Usuario</label>
                                                                            <select class="form-select form-select" name="tipo" id="tipo">
                                                                                <?php
                                                                                if ($dato['u_tipo'] == 1) {
                                                                                ?>
                                                                                    <option value="1" selected>Administrador</option>
                                                                                    <option value="3">Bodega</option>
                                                                                <?php

                                                                                } else {
                                                                                ?>
                                                                                    <option value="1">Administrador</option>
                                                                                    <option value="3" selected>Bodega</option>
                                                                                <?php
                                                                                }
                                                                                ?>

                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <center> <button type="submit" class="btn btn-warning">Actualizar</button></center>
                                                            </form>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>

                                        <td>
                                            <center><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalEliminar<?php echo $dato['u_id'] ?>">
                                                    <i class='bx bxs-trash'></i>
                                                </button></center>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalEliminar<?php echo $dato['u_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalEliminar<?php echo $dato['u_id'] ?>">Eliminar Nomina</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form ROLE="FORM" METHOD="POST" ACTION="">
                                                                <input type="hidden" class="form-control" id="accion" name="accion" value="3" />
                                                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo !empty($dato['u_id']) ? $dato['u_id'] : ''; ?>" />

                                                                <h4>¿Desea eliminar la información de: <?php echo $dato['u_nombres'] ?>?</h4>
                                                                <br />
                                                                <div class=" form__button__container">
                                                                    <button type="submit" class="btn btn-warning">Eliminar</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                        </td>

                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </main>

    <?php include_once 'footer.php' ?>

</body>
<script src="js/simple-datatables.js" crossorigin="anonymous"></script>

</html>