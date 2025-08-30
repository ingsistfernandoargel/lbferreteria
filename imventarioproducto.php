<?php include_once 'headprivado.php' ?>
<?php include_once 'error.php' ?>

<?php $inventario = null;
if (!empty($_GET['inv'])) {
    $inventario = $_REQUEST['inv'];
}
if (null == $inventario) {
    header("Location: index.php/..");
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $accion = $_POST['accion'];
    date_default_timezone_set('America/Bogota');
    $hora = date("His");
    $fecha = date("Ymd");

    $horasistema = date("H:i:s");
    $fechasistema = date("Y-m-d");

    if ($accion == 1) { // eliminar producto
        $idproducto = $_POST['i_idproductofk'];
        $idusuario = $_POST['i_idusuariofk'];
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


        $sqlinsertarinv = "INSERT INTO inventario(i_idproductofk, i_cantidad, i_idusuariofk, i_estado, i_fecha, i_hora) VALUES (?, ?, ?, ?, ?, ?)";
        $ejecutarinsertarinv = $pdo->prepare($sqlinsertarinv);
        $ejecutarinsertarinv->execute(array($idproducto, $cantidad, $idusuario, '1', $fechasistema, $hora));
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Información!", "Invetario del Producto Agregado","success");';
        echo '}, 1000);</script>';
        Conexion::desconectar();
    } elseif ($accion == 2) { // eliminar
        $idproducto = $_POST['idproducto'];
        $idinventario = $_POST['idinventario'];
        $cantidad = $_POST['cantidad'];

        $buscarproducto = "SELECT * FROM producto where p_id = ? ";
        $qp = $pdo->prepare($buscarproducto);
        $qp->execute(array($idproducto));
        $datop = $qp->fetch(PDO::FETCH_ASSOC);
        $stock = $datop['p_stock'];

        $disponible = $stock - $cantidad;

        $sqlactualizar = "UPDATE producto SET p_stock = ? WHERE p_id = ?";
        $ejecutaractualizar = $pdo->prepare($sqlactualizar);
        $ejecutaractualizar->execute(array($disponible, $idproducto));

        $eliminar = "DELETE FROM inventario WHERE i_id = ?";
        $ejecutareliminar = $pdo->prepare($eliminar);
        $ejecutareliminar->execute(array($idinventario));
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Información!", "Invetario del Producto Eliminado, se descuenta del Stock","success");';
        echo '}, 1000);</script>';
        Conexion::desconectar();
    }
}


?>


<body>
    <?php include_once 'navadmin.php' ?>
    <main>
        <div class="card-header bg-warning" style="color: black;">
            <strong>MODULO DE INVENTARIO DEL PRODUCTO</strong>
        </div>
        <br />
        <div class="container">

            <div class="modal fade" id="exampleModalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar nueva cantidad</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form ROLE="FORM" METHOD="POST" ENCTYPE="MULTIPART/FORM-DATA" ACTION="">
                                <input type="hidden" class="form-control" id="accion" name="accion" value="1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" class="form-control" id="i_idproductofk" name="i_idproductofk" value="<?php echo $inventario; ?>">
                                        <input type="hidden" class="form-control" id="i_idusuariofk" name="i_idusuariofk" value="<?php echo $idadmin; ?>">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nueva Cantidad</label>
                                            <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Nueva Cantidad del producto" required>
                                        </div>


                                    </div>
                                </div>
                                <center> <button type="submit" class="btn btn-warning">Guardar</button></center>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <strong> Inventario del producto </strong>
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
                                    <th scope="col">
                                        <center>Eliminar</center>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $carrito = "SELECT * FROM inventario, producto, usuario WHERE (i_idproductofk  = '$inventario'AND p_id = '$inventario') AND i_idusuariofk = u_id  ORDER BY i_id DESC;";
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

                                        <?php
                                        if ($dato['i_estado'] == 1) {
                                        ?>
                                            <td>
                                                <center><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalEliminar<?php echo $dato['i_id'] ?>">
                                                        <i class='bx bxs-trash'></i>
                                                    </button></center>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalEliminar<?php echo $dato['i_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalEliminar<?php echo $dato['i_id'] ?>">Eliminar Producto Inventario</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form ROLE="FORM" METHOD="POST" ACTION="">
                                                                    <input type="hidden" class="form-control" id="accion" name="accion" value="2" />
                                                                    <input type="hidden" class="form-control" id="idinventario" name="idinventario" value="<?php echo !empty($dato['i_id']) ? $dato['i_id'] : ''; ?>" />
                                                                    <input type="hidden" class="form-control" id="idproducto" name="idproducto" value="<?php echo !empty($dato['i_idproductofk']) ? $dato['i_idproductofk'] : ''; ?>" />
                                                                    <input type="hidden" class="form-control" id="cantidad" name="cantidad" value="<?php echo !empty($dato['i_cantidad']) ? $dato['i_cantidad'] : ''; ?>" />
                                                                    <h4>¿Desea eliminar el producto del inventario, esta se disminuye del Stock: <?php echo $dato['p_nombre'] ?>?</h4>
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
                                        <?php

                                        } else {
                                        ?>
                                            <td style="background-color: coral ">No se puede eliminar</td>
                                        <?php
                                        }
                                        ?>

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