<?php include_once 'headprivado.php' ?>


<body>
    <?php include_once 'navadmin.php' ?>
    <main>
        <div class="card-header bg-warning" style="color: black;">
            <strong>MODULO DE VENTAS GENERALES</strong>
        </div>
        <br />

        <div class="container">
            <div class="card">
                <div class="card-header" style="background-color: black; color: orange;">
                    <h6> Tabla de ventas</h6>
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
                                        <center>Factura</center>
                                    </th>
                                    <th scope="col">
                                        <center>Total</center>
                                    </th>
                                    <th scope="col">
                                        <center>Identificacion</center>
                                    </th>
                                    <th scope="col">
                                        <center>Cliente</center>
                                    </th>

                                    <th scope="col">
                                        <center>Fecha facturacion</center>
                                    </th>

                                    <th scope="col">
                                        <center>Ver</center>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $producto = 'SELECT SUM(v_total) AS total, v_factura, v_fecha, v_identificacion, v_nombresapellidos FROM venta GROUP BY v_factura;';
                                $contador = 1;
                                foreach ($pdo->query($producto) as $dato) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $contador; ?></th>
                                        <td><?php echo $dato['v_factura'] ?></td>
                                        <td><?php echo $dato['total'] ?></td>
                                        <td><?php echo $dato['v_identificacion'] ?></td>
                                        <td><?php echo $dato['v_nombresapellidos'] ?></td>
                                        <td><?php echo $dato['v_fecha'] ?></td>

                                        <td><a href="facturacliente.php?fac=<?php echo $dato['v_factura'] ?>" class="btn btn-warning"> <i class='bx bxs-file'></i></a></td>

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

</html>
<script src=" js/simple-datatables.js" crossorigin="anonymous"></script>