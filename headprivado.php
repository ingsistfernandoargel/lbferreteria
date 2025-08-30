<?php
include_once 'configuracion/conexion.php';
include_once('configuracion/sesion.php');
$pdo = Conexion::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id_admin = $_SESSION["usuario"];
$buscaradmin = "SELECT * FROM usuario where u_id = ? ";
$q = $pdo->prepare($buscaradmin);
$q->execute(array($id_admin));
$datoadmin = $q->fetch(PDO::FETCH_ASSOC);
$idadmin = $datoadmin['u_id'];
$cedulaadmin = $datoadmin['u_identificacion'];
$nombresadmin = $datoadmin['u_nombres'];
$apellidosadmin = $datoadmin['u_apellidos'];
$emailadmin = $datoadmin['u_email'];
$celularadmin = $datoadmin['u_celular'];
$ciudadadmin = $datoadmin['u_ciudad'];
$direccionadmin = $datoadmin['u_direccion'];
$fechanacimientoadmin = $datoadmin['u_fecha_nacimiento'];
$contrasenaadmin = $datoadmin['u_contrasena'];
$tipoadmin = $datoadmin['u_tipo'];


$sqlcantidadcarrito = "SELECT COUNT(*) FROM carrito WHERE c_idusuariofk = '$idadmin' ";
$querycarrito = $pdo->query($sqlcantidadcarrito);
$cantidadcarrito = $querycarrito->fetchColumn();


$host = 'http://' . $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <link rel="shortcut icon" href="imag/Logo3.PNG">
    <script src="jquery/jquery-ui.js" type="text/javascript"></script>
    <link href="jquery/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href='boxicons/css/boxicons.min.css' rel='stylesheet'>
    <link href='css/estilos.css' rel='stylesheet'>
    <link href='css/styles.css' rel='stylesheet'>
    <script src="js/sweetalert.min.js" type="text/javascript"></script>
    <title>LB Ferreteria</title>
</head>