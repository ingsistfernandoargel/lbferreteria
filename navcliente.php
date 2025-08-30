
<nav class="navbar navbar-expand-lg  sticky-top"   style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> <img src="imag/Logo3.PNG" alt="logo belleza" style="width: 10%; height: 10%;">
            LB Ferreteria</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="cliente.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="catalogo.php">Catalogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="historia_venta.php">Historial Ventas</a>
                </li>     
                <li class="nav-item">
                    <a class="nav-link" href="perfil.php">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="carrito.php">Carrito &nbsp; <strong><?php echo $cantidadcarrito; ?></strong></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="salir.php" class="logout">Salir</a>
                </li>
            </ul>
        </div>
    </div>
</nav>