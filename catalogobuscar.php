<?php
$datobuscar = $_GET['dato'];
?>
<?php include_once 'headprivado.php' ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idproducto = $_POST['idproducto'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $cantidad = $_POST['cantidad'];
    $idcliente = $_POST['idcliente'];

    if ($stock <= 0) {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Información!", "Producto no disponibles","error");';
        echo '}, 1000);</script>';
    } elseif ($cantidad > $stock) {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Información!", "La cantidad esta por encima del stock","error");';
        echo '}, 1000);</script>';
    } else {
        $total = $cantidad * $precio;
        $disponible = $stock - $cantidad;
        $sqlinsertar = "INSERT INTO carrito(c_idproductofk, c_nombre, c_marca, c_precio, c_cantidad, c_total, c_idusuariofk) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $ejecutarinsertar = $pdo->prepare($sqlinsertar);
        $ejecutarinsertar->execute(array($idproducto, $nombre, $marca, $precio, $cantidad, $total, $idcliente));
        $sqlactualizar = "UPDATE producto SET p_stock = ? WHERE p_id = ?";
        $ejecutaractualizar = $pdo->prepare($sqlactualizar);
        $ejecutaractualizar->execute(array($disponible, $idproducto));
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Información!", "Producto agregado al carrito","success");';
        echo '}, 1000);</script>';
        Conexion::desconectar();
    }
}
?>

<body>
    <?php include_once 'navcliente.php' ?>
    <main>
        <div class="card-header bg-warning" style="color: black;">
            <strong>CATALOGO DE LB FERRETERIA</strong>
        </div>
        <br />

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h6>Catalogo</h6>
                    <form action="catalogobuscar.php">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control form-control-sm" name="dato" id="dato" placeholder="Buscar por Nombre o Marca">
                            <button type="submit" class="btn btn-secondary btn-sm" btn-ms><i class='bx bx-search'></i></button>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <div class="row">
                        <?php
                        $producto = 'SELECT * FROM producto WHERE  (p_nombre LIKE "%' . $datobuscar . '%" OR p_marca LIKE "%' . $datobuscar . '%") ORDER BY p_id DESC;';
                        foreach ($pdo->query($producto) as $dato) {
                        ?>
                            <div class="col">
                                <div class="card" style="width: 18rem;">
                                    <img src="http://localhost/<?php echo $dato['p_foto'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">

                                        <form ROLE="FORM" METHOD="POST" ACTION="">
                                            <center>
                                                <h5 class="card-title"><?php echo $dato['p_nombre'] ?></h5>
                                            </center>
                                            <p class="card-text">Marca: <strong><?php echo $dato['p_marca'] ?></strong></p>
                                            <p class="card-text">Valor: $ <strong><?php echo $dato['p_precio'] ?></strong> COP</p>
                                            <p class="card-text">Disponible: <strong><?php echo $dato['p_stock'] ?></strong></p>

                                            <div class="mb-3">
                                                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ingresar Cantidad" required>
                                            </div>
                                            <input type="hidden" class="form-control" id="idproducto" name="idproducto" value="<?php echo !empty($dato['p_id']) ? $dato['p_id'] : ''; ?>" required>
                                            <input type="hidden" class="form-control" id="nombre" name="nombre" value="<?php echo !empty($dato['p_nombre']) ? $dato['p_nombre'] : ''; ?>" required>
                                            <input type="hidden" class="form-control" id="marca" name="marca" value="<?php echo !empty($dato['p_marca']) ? $dato['p_marca'] : ''; ?>" required>
                                            <input type="hidden" class="form-control" id="precio" name="precio" value="<?php echo !empty($dato['p_precio']) ? $dato['p_precio'] : ''; ?>" required>
                                            <input type="hidden" class="form-control" id="stock" name="stock" value="<?php echo !empty($dato['p_stock']) ? $dato['p_stock'] : ''; ?>" required>
                                            <input type="hidden" class="form-control" id="idcliente" name="idcliente" value="<?php echo $idadmin; ?>" required>
                                            <center> <button type="submit" class="btn btn-warning btn-sm">Añadir Carrito</button></center>
                                        </form>



                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php include_once 'footer.php' ?>

</body>

</html>
<style>
    .card-img-top {
        width: 100%;
        height: 200px;
        /* Altura fija */
        object-fit: cover;
        /* Mantiene la proporción y recorta si es necesario */
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    .card {
        margin: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: scale(1.02);
        /* Efecto sutil al pasar el mouse */
    }

    .card-body {
        padding: 15px;
    }
</style>