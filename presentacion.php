<?php include_once 'head.php' ?>

<body>
    <?php include_once 'navinicio.php' ?>
    <main>
        <div class="card-header bg-warning" style="color: black;">
            <strong>CATALOGO DE LB FERRETERIA</strong>
        </div>
        <br />

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h6>Catalogo</h6>
                    <form action="presentacionbuscar.php" method="GET">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control form-control-sm" name="dato" id="dato" placeholder="Buscar por Nombre o Marca">
                            <button type="submit" class="btn btn-secondary btn-sm" btn-ms><i class='bx bx-search'></i></button>
                        </div>
                    </form>
                </div>

                <div class="card-body" style="background-color: white">
                    <div class="row">
                        <?php
                        $producto = 'SELECT * FROM producto ORDER BY p_id DESC;';
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