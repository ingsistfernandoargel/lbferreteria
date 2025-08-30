<?php

$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$categoria = $_POST['categoria'];
$marca = $_POST['marca'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$fechavencimiento = $_POST['fecha'];

$carpetaimagen = "/lbferreteria/productos/";
$servidorimagen = $_SERVER['DOCUMENT_ROOT'] . $carpetaimagen;
$imagen = $_FILES['imagen']['name'];
//$extension = pathinfo($imagen, PATHINFO_EXTENSION);
$extension = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));
$extensiones_permitidas = ['jpg', 'jpeg', 'png'];

$sqlcantidad = "SELECT COUNT(*) FROM producto WHERE p_codigo = " . $codigo . "";
$query = $pdo->query($sqlcantidad);
$cantidad = $query->fetchColumn();

if ($cantidad != 0) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("Información!", "Producto ya Existe","error");';
    echo '}, 1000);</script>';
}elseif (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] != 0) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("Información!", "Error al subir la imagen","error");';
    echo '}, 1000);</script>';
} elseif (!in_array($extension, $extensiones_permitidas)) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("Información!", "Formato de imagen no valida","error");';
    echo '}, 1000);</script>';
} else {
    $nombre_imagen = "PRO" . $fecha . "COD" . $hora . "." . $extension;
    $destinoimagen = $servidorimagen . $nombre_imagen; //RUTA DONDE SE ALAMCENA IMAGEN 
    $rutaimagen = $_FILES['imagen']['tmp_name'];
    $imagenBD = $carpetaimagen . $nombre_imagen;
    $sql = "INSERT INTO producto(p_codigo, p_nombre, p_categoria, p_marca, p_precio, p_stock, p_foto, p_fecha_vencimiento) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $ejecutar = $pdo->prepare($sql);
    $ejecutar->execute(array($codigo, $nombre, $categoria, $marca, $precio, $stock, $imagenBD, $fechavencimiento));
    copy($rutaimagen, $destinoimagen);
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("Información!", "Producto Registrado","success");';
    echo '}, 1000);</script>';
    Conexion::desconectar();
}
