<?php include_once 'headprivado.php' ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    date_default_timezone_set('America/Bogota');
    $hora = date("His");
    $fecha = date("Ymd");
    $accion = $_POST['accion'];
    if ($accion == 1) {
        include_once 'productoagregar.php';
    } else if ($accion == 2) {
        include_once 'productoactualizar.php';
    } else if ($accion == 3) {
        $id = $_POST['id'];
        $imageneliminar = $_POST['imageneliminar'];
        $borrarimageneliminar = $_SERVER['DOCUMENT_ROOT'] . $imageneliminar;

        $sqlcarrito = "SELECT COUNT(*) FROM carrito WHERE c_idproductofk  = '$id'";
        $querycarrito2 = $pdo->query($sqlcarrito);
        $cantidadcarrito = $querycarrito2->fetchColumn();
        if ($cantidadcarrito != 0) {
            echo '<script language="javascript">alert("El producto esta en carrito por algun cliente");</script>';
        } else {
            $eliminar = "DELETE FROM producto WHERE p_id = ?";
            $ejecutar = $pdo->prepare($eliminar);
            $ejecutar->execute(array($id));
            unlink($borrarimageneliminar);
            echo '<script language="javascript">alert("Eliminacion Exitosa");</script>';
            Conexion::desconectar();
        }
    }
}
?>


<body>
    <?php include_once 'navadmin.php' ?>
    <main>
        <div class="card-header titulo">
            <strong>MODULO DE PRODUCTOS</strong>
        </div>
        <br />

        <div class="container">

            <!--CREAR -->

            <!-- Modal -->
            <div class="modal fade" id="exampleModalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form ROLE="FORM" METHOD="POST" ENCTYPE="MULTIPART/FORM-DATA" ACTION="">
                                <input type="hidden" class="form-control" id="accion" name="accion" value="1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Codigo</label>
                                            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo del producto" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Nombres</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres del producto" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Categoria</label>
                                            <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoria del producto" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Marca</label>
                                            <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca del producto" required>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Precio</label>
                                            <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio del producto" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Stock</label>
                                            <input type="number" class="form-control" id="stock" name="stock" placeholder="stock del producto" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Imagen</label>
                                            <input type="file" class="form-control" id="imagen" name="imagen" placeholder="stock del producto" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Fecha de vencimiento</label>
                                            <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha de Vencimiento" required>
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
                    <strong>Tabla de productos</strong>
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
                                        <center>Codigo</center>
                                    </th>
                                    <th scope="col">
                                        <center>Nombre</center>
                                    </th>
                                    <th scope="col">
                                        <center>Categoria</center>
                                    </th>
                                    <th scope="col">
                                        <center>Marca</center>
                                    </th>
                                    <th scope="col">
                                        <center>Precio</center>
                                    </th>
                                    <th scope="col">
                                        <center>Stock</center>
                                    </th>
                                    <th scope="col">
                                        <center>Foto</center>
                                        </center>
                                    </th>
                                    <th scope="col">
                                        <center>Fecha Vencimiento</center>
                                    </th>
                                    <th scope="col">
                                        <center>Inventario</center>
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
                                $producto = 'SELECT * FROM producto ORDER BY p_id DESC;';
                                foreach ($pdo->query($producto) as $dato) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $dato['p_codigo'] ?></th>
                                        <td><?php echo $dato['p_nombre'] ?></td>
                                        <td><?php echo $dato['p_categoria'] ?></td>
                                        <td><?php echo $dato['p_marca'] ?></td>
                                        <td><?php echo $dato['p_precio'] ?></td>
                                        <td><?php echo $dato['p_stock'] ?></td>
                                        <td>
                                            <center><img src="http://localhost/<?php echo $dato['p_foto'] ?>" class="card-img" alt="..." style="width: 20%; height: 20%;"></center>
                                        </td>
                                        <td><?php echo $dato['p_fecha_vencimiento'] ?></td>

                                        <td><center><a href="imventarioproducto.php?inv=<?php echo $dato['p_id'] ?>" class="btn btn-warning"> <i class='bx bxs-file'></i></a></center></td>


                                        <!-- ACTUALIZAR LIBRO -->
                                        <td>
                                            <center><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalActualizar<?php echo $dato['p_id'] ?>">
                                                <i class='bx bxs-check-circle'></i>
                                            </button></center>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalActualizar<?php echo $dato['p_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalActualizar<?php echo $dato['p_id'] ?>">Actualizar Producto</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form ROLE="FORM" METHOD="POST" ENCTYPE="MULTIPART/FORM-DATA" ACTION="">
                                                                <input type="hidden" class="form-control" id="accion" name="accion" value="2">
                                                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo !empty($dato['p_id']) ? $dato['p_id'] : ''; ?>" required>
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Codigo</label>
                                                                            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo del producto" value="<?php echo !empty($dato['p_codigo']) ? $dato['p_codigo'] : ''; ?>" required>
                                                                            <input type="hidden" class="form-control" id="codigoviejo" name="codigoviejo" value="<?php echo !empty($dato['p_codigo']) ? $dato['p_codigo'] : ''; ?>" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Nombres</label>
                                                                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres del producto" value="<?php echo !empty($dato['p_nombre']) ? $dato['p_nombre'] : ''; ?>" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Categoria</label>
                                                                            <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Categoria del producto" value="<?php echo !empty($dato['p_categoria']) ? $dato['p_categoria'] : ''; ?>" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Marca</label>
                                                                            <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca del producto" value="<?php echo !empty($dato['p_marca']) ? $dato['p_marca'] : ''; ?>" required>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Precio</label>
                                                                            <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio del producto" value="<?php echo !empty($dato['p_precio']) ? $dato['p_precio'] : ''; ?>" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Stock</label>
                                                                            <input type="number" class="form-control" id="stock" name="stock" placeholder="stock del producto" value="<?php echo !empty($dato['p_stock']) ? $dato['p_stock'] : ''; ?>" required>
                                                                        </div>

                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Imagen</label>
                                                                            <input type="file" class="form-control" id="imagen" name="imagen">
                                                                            <input type="hidden" class="form-control" id="imagenvieja" name="imagenvieja" value="<?php echo !empty($dato['p_foto']) ? $dato['p_foto'] : ''; ?>" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="exampleInputEmail1" class="form-label">Fecha de vencimiento</label>
                                                                            <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha de Vencimiento" value="<?php echo !empty($dato['p_fecha_vencimiento']) ? $dato['p_fecha_vencimiento'] : ''; ?>" required>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="card">
                                                                            <center><img src="http://localhost/<?php echo $dato['p_foto'] ?>" class="card-img" style="width: 100%; height: 100%;" alt="..."></center>
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

                                        <!-- ELIMININAR LIBRO -->
                                        <td>
                                            <center><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalEliminar<?php echo $dato['p_id'] ?>">
                                                <i class='bx bxs-trash'></i>
                                            </button></center>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalEliminar<?php echo $dato['p_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalEliminar<?php echo $dato['p_id'] ?>">Eliminar Producto</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form ROLE="FORM" METHOD="POST" ACTION="">
                                                                <input type="hidden" class="form-control" id="accion" name="accion" value="3" />
                                                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo !empty($dato['p_id']) ? $dato['p_id'] : ''; ?>""  />
                                                <input type="hidden" class="form-control" id="imageneliminar" name="imageneliminar" value="<?php echo !empty($dato['p_foto']) ? $dato['p_foto'] : ''; ?>""  />

                                                <h4>¿Desea eliminar la información de: <?php echo $dato['p_nombre'] ?>?</h4>
                                                <p>La informacion simpre se eliminara, siempre y cuando no se este utilizando en el carrito de compra</p>
                                                <br/>
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

