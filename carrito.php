<?php include_once 'headprivado.php' ?>
<?php include_once 'error.php';?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $accion = $_POST['accion'];
    date_default_timezone_set('America/Bogota');
    $hora = date("His");
    $fecha = date("Ymd");

    $horasistema = date("H:i:s");
    $fechasistema = date("Y-m-d");

    if ($accion == 1) { // eliminar producto
        $idproducto = $_POST['idproducto'];
        $idcarrito = $_POST['idcarrito'];
        $cantidad = $_POST['cantidad'];

        $buscarproducto = "SELECT * FROM producto where p_id = ? ";
        $qp = $pdo->prepare($buscarproducto);
        $qp->execute(array($idproducto));
        $datop = $qp->fetch(PDO::FETCH_ASSOC);
        $stock = $datop['p_stock'];

        $disponible = $stock + $cantidad;

        $sqlactualizar = "UPDATE producto SET p_stock = ? WHERE p_id = ?";
        $ejecutaractualizar = $pdo->prepare($sqlactualizar);
        $ejecutaractualizar->execute(array($disponible, $idproducto));

        $eliminar = "DELETE FROM carrito WHERE c_id = ?";
        $ejecutareliminar = $pdo->prepare($eliminar);
        $ejecutareliminar->execute(array($idcarrito));
        Conexion::desconectar();
    } elseif ($accion == 2) { // pagar carrito
        $cedula = $_POST['cedula'];
        $nombresapellidos = $_POST['nombresapellidos'];
        $celular = $_POST['celular'];
        $ciudad = $_POST['ciudad'];
        $direccion = $_POST['direccion'];
        $factura = "LB" . $fecha . "F" . $hora;



        $sqlcantidadc = "SELECT COUNT(*) FROM carrito WHERE c_idusuariofk = " . $idadmin . "";
        $queryc = $pdo->query($sqlcantidadc);
        $cantidadpro = $queryc->fetchColumn();
        if ($cantidadpro == 0) {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Información!", "No dispone de productos en el carrito","error");';
            echo '}, 1000);</script>';
        } else {
            $carritototal = 'SELECT * FROM producto , carrito WHERE c_idusuariofk = ' . $idadmin . ' AND c_idproductofk  = p_id ORDER BY c_id DESC;';
            foreach ($pdo->query($carritototal) as $datoc) {
                $sqlinsertar = "INSERT INTO venta(v_factura, v_nombre, v_marca, v_precio, v_cantidad, v_total, v_fkidusuario, v_identificacion, v_nombresapellidos, v_ciudad, v_direccion, v_celular, v_fecha, v_hora) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";
                $ejecutarinsertar = $pdo->prepare($sqlinsertar);
                $ejecutarinsertar->execute(array($factura, $datoc['c_nombre'], $datoc['c_marca'], $datoc['c_precio'], $datoc['c_cantidad'], $datoc['c_total'], $idadmin, $cedula, $nombresapellidos, $ciudad, $direccion, $celular, $fechasistema, $hora));


                $sqlinsertarinv = "INSERT INTO inventario(i_idproductofk, i_cantidad, i_idusuariofk, i_estado, i_fecha, i_hora) VALUES (?, ?, ?, ?, ?, ?)";
                $ejecutarinsertarinv = $pdo->prepare($sqlinsertarinv);
                $ejecutarinsertarinv->execute(array($datoc['c_idproductofk'], $datoc['c_cantidad'], $idadmin, '2', $fechasistema, $hora));
            }
            $eliminarcarrito = "DELETE FROM carrito WHERE c_idusuariofk= ?";
            $ejecutareliminarcarrito = $pdo->prepare($eliminarcarrito);
            $ejecutareliminarcarrito->execute(array($idadmin));

            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Información!", "Productos comprados, pago contraentrega - Ver Hirstorial de Ventas","success");';
            echo '}, 1000);</script>';

            Conexion::desconectar();
        }
    }
}

$buscarsuma = "SELECT SUM(c_total) AS suma FROM carrito WHERE c_idusuariofk = ?; ";
$qpsuma = $pdo->prepare($buscarsuma);
$qpsuma->execute(array($idadmin));
$datosuma = $qpsuma->fetch(PDO::FETCH_ASSOC);
$sumatoria = $datosuma['suma'];

?>


<body>
    <?php include_once 'navcliente.php' ?>
    <main>
        <div class="card-header bg-warning" style="color: white;">
            <strong>MODULO DE CARRITO DE COMPRAS</strong>
        </div>
        <br />
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <strong> Carrito de compra </strong>
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
                                    <th scope="col">
                                        <center>Eliminar</center>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $carrito = "SELECT * FROM carrito WHERE c_idusuariofk  = '$idadmin' ORDER BY c_id DESC;";
                                $contador = 1;
                                foreach ($pdo->query($carrito) as $dato) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $contador; ?></th>
                                        <td><?php echo $dato['c_nombre'] ?></td>
                                        <td><?php echo $dato['c_marca'] ?></td>
                                        <td><?php echo $dato['c_cantidad'] ?></td>
                                        <td><?php echo $dato['c_precio'] ?></td>
                                        <td><?php echo $dato['c_total'] ?></td>
                                        <!-- ELIMININAR  -->
                                        <td>
                                            <center><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalEliminar<?php echo $dato['c_id'] ?>">
                                                    <i class='bx bxs-trash'></i>
                                                </button></center>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalEliminar<?php echo $dato['c_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalEliminar<?php echo $dato['c_id'] ?>">Eliminar Producto</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form ROLE="FORM" METHOD="POST" ACTION="">
                                                                <input type="hidden" class="form-control" id="accion" name="accion" value="1" />
                                                                <input type="hidden" class="form-control" id="idcarrito" name="idcarrito" value="<?php echo !empty($dato['c_id']) ? $dato['c_id'] : ''; ?>" />
                                                                <input type="hidden" class="form-control" id="idproducto" name="idproducto" value="<?php echo !empty($dato['c_idproductofk']) ? $dato['c_idproductofk'] : ''; ?>" />
                                                                <input type="hidden" class="form-control" id="cantidad" name="cantidad" value="<?php echo !empty($dato['c_cantidad']) ? $dato['c_cantidad'] : ''; ?>" />
                                                                <h4>¿Desea eliminar el producto : <?php echo $dato['c_nombre'] ?>?</h4>
                                                                <br />
                                                                <div class=" form__button__container">
                                                                    <button type="submit" class="btn btn-warning">Eliminar</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>

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
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                        <form ROLE="FORM" METHOD="POST" ACTION="" onSubmit="return confirm('¿Desea realizar la compra?')">
                            <input type="hidden" class="form-control" id="accion" name="accion" value="2">
                            <input type="hidden" class="form-control" id="cedula" name="cedula" value="<?php echo $cedulaadmin; ?>">
                            <input type="hidden" class="form-control" id="nombresapellidos" name="nombresapellidos" value="<?php echo $nombresadmin . " " . $apellidosadmin; ?>">
                            <input type="hidden" class="form-control" id="celular" name="celular" value="<?php echo $celularadmin; ?>" required>
                            <input type="hidden" class="form-control" id="ciudad" name="ciudad" value="<?php echo $ciudadadmin; ?>">
                            <input type="hidden" class="form-control" id="direccion" name="direccion" value="<?php echo $direccionadmin; ?>">
                            <center><button type="submit" style="text-align: right;" class="btn btn-warning">Comprar</button></center>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php include_once 'footer.php' ?>

</body>
<script src="js/simple-datatables.js" crossorigin="anonymous"></script>

</html>