<nav class="navbar navbar-expand-lg sticky-top" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> <img src="imag/Logo3.PNG" alt="logo belleza" style="width: 10%; height: 10%;">
            LB Ferreteria</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="admin.php">Inicio</a>
                </li>
                <?php if ($tipoadmin == 1) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="producto.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="nomina.php">Nomina</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inventario.php">Inventario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="clientes.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ventas.php">Ventas</a>
                    </li>

                <?php } 
                if ($tipoadmin == 3){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="producto.php">Productos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="inventario.php">Inventario</a>
                    </li>
                <?php } ?>


                <li class="nav-item">
                    <a class="nav-link" href="perfiladmin.php">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="salir.php" class="logout">Salir</a>
                </li>
            </ul>
        </div>
    </div>
</nav>