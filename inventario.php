<?php include_once 'headprivado.php' ?>

<body>
    <?php include_once 'navadmin.php' ?>
    <main>
        <div class="card-header bg-warning" style="color: black;">
            <strong>MODULO DE INVENTARIO DE PRODUCTOS GENERALES</strong>
        </div>
        <br />
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <strong> Inventario del productos generales </strong>
                </div>

                <div class="card-body">
                    <div class="table-responsive">

                        <table id="datatablesSimple" class="display table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <center>No.</center>
                                    </th>
                                    <th scope="col">
                                        <center>Nombre</center>
                                    </th>

                                    <th scope="col">
                                        <center>Cantidad</center>
                                    </th>
                                    <th scope="col">
                                        <center>Comprador</center>
                                    </th>
                                    <th scope="col">
                                        <center>Tipo</center>
                                    </th>
                                    <th scope="col">
                                        <center>Estado</center>
                                        </center>
                                    </th>
                                    <th scope="col">
                                        <center>Fecha y Hora</center>
                                        </center>
                                    </th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $carrito = "SELECT * FROM inventario, producto, usuario WHERE (i_idproductofk  = p_id ) AND i_idusuariofk = u_id  ORDER BY i_id DESC;";
                                $contador = 1;
                                foreach ($pdo->query($carrito) as $dato) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $contador; ?></th>
                                        <td><?php echo $dato['p_nombre'] ?></td>
                                        <td><?php echo $dato['i_cantidad'] ?></td>
                                        <td><?php echo $dato['u_nombres'] . ' ' . $dato['u_apellidos'] ?></td>
                                        <?php
                                        if ($dato['u_tipo'] == 1) {
                                        ?>
                                            <td>Administrador</td>
                                        <?php
                                        } elseif ($dato['u_tipo'] == 2) {
                                        ?>
                                            <td>Cliente</td>
                                        <?php
                                        } elseif ($dato['u_tipo'] == 3) {
                                        ?>
                                            <td>Bodega</td>
                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if ($dato['i_estado'] == 1) {
                                        ?>
                                            <td style="background-color: aqua;">Entrada</td>
                                        <?php

                                        } else {
                                        ?>
                                            <td style="background-color: coral ">Salida</td>
                                        <?php
                                        }
                                        ?>

                                        <td><?php echo $dato['i_fecha'] . ' ' . $dato['i_hora'] ?></td>

                                       

                                    </tr>
                                <?php
                                    $contador = $contador + 1;
                                }
                                ?>


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