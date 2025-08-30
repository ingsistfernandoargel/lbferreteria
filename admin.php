<?php include_once 'headprivado.php' ?>

<body>
    <?php include_once 'navadmin.php' ?>
    <main>
        <br />
        <div class="container">
            <div class="row">
                <div class="col-4">
                </div>
                <div class="col-4">
                    <center>
                        <div class="card" style="width: 18rem;">
                            <img src="imag/Logo3.PNG" class="card-img-top" alt="...">
                            <div class="card-body">

                                <?php if ($tipoadmin == 1) { ?>
                                    <h5 class="card-title">ADMINISTRADOR</h5>

                                <?php } else { ?>
                                    <h5 class="card-title">BODEGA</h5>
                                <?php } ?>

                                <p class="card-text"><?php echo $nombresadmin . " " . $apellidosadmin ?></p>
                            </div>
                        </div>
                    </center>
                </div>
                <div class="col-4">
                </div>
            </div>
        </div>
        <br /><br />
    </main>
    <?php include_once 'footer.php' ?>

</body>

</html>