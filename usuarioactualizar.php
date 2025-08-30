<?php
$id = $_POST['id'];
$cedula = $_POST['cedula'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$emailviejo = $_POST['emailviejo'];
$celular = $_POST['celular'];
$ciudad = $_POST['ciudad'];
$direccion = $_POST['direccion'];
$contrasena = $_POST['contrasena'];
$tipo = $_POST['tipo'];

if ($email != $emailviejo) {
    // Validar si el nuevo email ya está registrado
    $sqlcantidad = "SELECT COUNT(*) FROM usuario WHERE u_email = ?";
    $query = $pdo->prepare($sqlcantidad);
    $query->execute([$email]);
    $cantidad = $query->fetchColumn();

    if ($cantidad != 0) {
        // El nuevo email ya está en uso
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Información!", "El correo electrónico ya está registrado.","error");';
        echo '}, 1000);</script>';
        exit();
    }
}

// Actualizar datos del usuario
$sql = "UPDATE usuario SET 
            u_nombres = ?, 
            u_apellidos = ?, 
            u_identificacion = ?, 
            u_email = ?, 
            u_ciudad = ?, 
            u_direccion = ?, 
            u_celular = ?, 
            u_tipo = ?, 
            u_contrasena = ?
        WHERE u_id = ?";
$ejecutar = $pdo->prepare($sql);
$ejecutar->execute([
    $nombres,
    $apellidos,
    $cedula,
    $email,
    $ciudad,
    $direccion,
    $celular,
    $tipo,
    $contrasena,
    $id
]);

echo '<script type="text/javascript">';
echo 'setTimeout(function () { swal("Información!", "Actualización Exitosa","success");';
echo '}, 1000);</script>';

Conexion::desconectar();
