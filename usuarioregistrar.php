<?php

$cedula = $_POST['cedula'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$celular = $_POST['celular'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$contrasena = $_POST['contrasena'];
$contrasena2 = $_POST['contrasena2'];
$tipo = $_POST['tipo'];

$sqlcantidad = "SELECT COUNT(*) FROM usuario WHERE u_email = '$email' ";
$query = $pdo->query($sqlcantidad);
$cantidad = $query->fetchColumn();

if ($contrasena != $contrasena2) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("Información!", "Contraseñas no coinciden","error");';
    echo '}, 1000);</script>';
} elseif ($cantidad != 0) {
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("Información!", "Usuario esta registrado","error");';
    echo '}, 1000);</script>';
} else {

    $sql = "INSERT INTO usuario(u_nombres, u_apellidos, u_identificacion, u_email, u_ciudad, u_direccion, u_celular, u_tipo, u_contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $ejecutar = $pdo->prepare($sql);
    $ejecutar->execute(array($nombres, $apellidos, $cedula, $email, $ciudad, $direccion, $celular, $tipo, $contrasena));
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("Información!", "Registro Exitoso","success");';
    echo '}, 1000);</script>';
    Conexion::desconectar();
}
