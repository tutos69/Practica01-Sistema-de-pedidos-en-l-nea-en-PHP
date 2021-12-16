<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <?php $url = 'http://' . $_SERVER['HTTP_HOST'] . "/Practica01-Sistema-de-pedidos-en-l-nea-en-PHP" ?>
    <nav class="navbar navbar-expand navbar-light bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="#">Administrador</a>
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $url?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="platillos.php">Platillos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Cerrar</a>
                </li>
            </ul>

        </div>
    </nav>
    <div class="container">
        <br>
        <div class="row">