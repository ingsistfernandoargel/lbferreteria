<?php
$facturas = null;
if (!empty($_GET['fac'])) {
    $facturas = $_REQUEST['fac'];
}
if (null == $facturas) {
    header("Location: index.php/..");
}
$sumatoria = 0;
?>

<?php include_once 'headprivado.php' ?>

<body>
    <?php include_once 'navcliente.php' ?>
    <main>
        <div class="card-header bg-warning" style="color: black;">
            <strong>INFORMACION DE LA FACTURA <?php echo $facturas; ?></strong>
        </div>
        <br />

        <div class="container">
            <div class="card">
                <h5 class="card-header">Información de Factura</h5>
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
                                        <center>Marca</center>
                                    </th>
                                    <th scope="col">
                                        <center>Cantidad</center>
                                    </th>
                                    <th scope="col">
                                        <center>Precio</center>
                                    </th>
                                    <th scope="col">
                                        <center>Total</center>
                                        </center>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $carrito = "SELECT * FROM venta WHERE v_fkidusuario  = '$idadmin' AND v_factura = '" . $facturas . "' ORDER BY v_id DESC;";
                                $contador = 1;
                                foreach ($pdo->query($carrito) as $dato) {
                                    $sumatoria = $sumatoria + $dato['v_total']
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $contador; ?></th>
                                        <td><?php echo $dato['v_nombre'] ?></td>
                                        <td><?php echo $dato['v_marca'] ?></td>
                                        <td><?php echo $dato['v_cantidad'] ?></td>
                                        <td><?php echo $dato['v_precio'] ?></td>
                                        <td><?php echo $dato['v_total'] ?></td>
                                        <!-- ELIMININAR LIBRO -->


                                    </tr>
                                <?php
                                    $contador = $contador + 1;
                                }
                                ?>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>TOTAL</strong></td>
                                    <td><strong><?php echo $sumatoria; ?></strong></td>
                                </tr>
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