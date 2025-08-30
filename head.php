<?php
include_once 'configuracion/conexion.php';
$pdo = Conexion::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
        <link rel="shortcut icon" href="imag/Logo3.PNG">
        <script src="jquery/jquery-ui.js" type="text/javascript"></script>
        <link href="jquery/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link href='boxicons/css/boxicons.min.css' rel='stylesheet'>
         <link href='css/estilos.css' rel='stylesheet'>
        <script src="js/sweetalert.min.js" type="text/javascript"></script>
        <title>LB Ferreteria</title>
    </head>