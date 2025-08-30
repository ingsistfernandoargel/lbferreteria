<?php include_once 'headprivado.php' ?>

<body>
    <?php include_once 'navadmin.php' ?>
    <main>
        <div class="card-header bg-warning" style="color: black;">
            <strong>MODULO DE CLIENTES</strong>
        </div>
        <br />

        <div class="container">
            <div class="card">
                <div class="card-header" style="background-color: black; color: orange;">
                    <h6> Tabla de clientes</h6>
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
                                        <center>Ver</center>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $clientes = 'SELECT * FROM usuario WHERE u_tipo = 2 ORDER BY u_id DESC;';
                                foreach ($pdo->query($clientes) as $dato) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $dato['u_identificacion'] ?></th>
                                        <td><?php echo $dato['u_nombres'] . " " . $dato['u_apellidos'] ?></td>
                                        <td><?php echo $dato['u_email'] ?></td>
                                        <td><?php echo $dato['u_ciudad'] ?></td>
                                        <td><?php echo $dato['u_celular'] ?></td>

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

                                                            <form ROLE="FORM" METHOD="POST" ACTION="">
                                                                <div class="row">
                                                                    <div class="col-md-6">

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Cedula</label>
                                                                            <input type="number" class="form-control" id="cedula" name="cedula" value="<?php echo !empty($dato['u_identificacion']) ? $dato['u_identificacion'] : ''; ?>" disabled>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Nombres</label>
                                                                            <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo !empty($dato['u_nombres']) ? $dato['u_nombres'] : ''; ?>" disabled>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Apellidos</label>
                                                                            <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo !empty($dato['u_apellidos']) ? $dato['u_apellidos'] : ''; ?>" disabled>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Correo Electronico</label>
                                                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo !empty($dato['u_email']) ? $dato['u_email'] : ''; ?>" disabled>
                                                                        </div>



                                                                    </div>
                                                                    <div class="col-md-6">

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Celular</label>
                                                                            <input type="number" class="form-control" id="celular" name="celular" value="<?php echo !empty($dato['u_celular']) ? $dato['u_celular'] : ''; ?>" disabled>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Ciudad</label>
                                                                            <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo !empty($dato['u_ciudad']) ? $dato['u_ciudad'] : ''; ?>" disabled>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Dirección</label>
                                                                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo !empty($dato['u_direccion']) ? $dato['u_direccion'] : ''; ?>" disabled>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Fecha de nacimiento</label>
                                                                            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo !empty($dato['u_fecha_nacimiento']) ? $dato['u_fecha_nacimiento'] : ''; ?>" disabled>
                                                                        </div>



                                                                    </div>
                                                                </div>

                                                            </form>




                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        </div>
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