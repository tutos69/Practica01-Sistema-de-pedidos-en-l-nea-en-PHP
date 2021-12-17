<?php $codigoUsu = $_GET["codigo"]; ?>

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
    <?php $url = 'http://' . $_SERVER['HTTP_HOST'] . "/Practica01-Sistema-de-pedidos-en-l-nea-en-PHP"; ?>

    <?php 
    include('../../config/conexion.php');
    $restauranteUsu = "SELECT * FROM app_restaurante WHERE res_usu=$codigoUsu ";
    $listadoUsuario = $coon->query($restauranteUsu);
    foreach ($listadoUsuario as $Restaurante) {
        $idRestaurante = $Restaurante['res_nombre'];
    } 
    ?>




    <nav class="navbar navbar-expand navbar-light bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="#"><?php echo $idRestaurante; ?></a>
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $url ?>">Sitio WEB</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="platillos.php?<?php echo 'codigo=' . $codigoUsu; ?>">Platillos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../template/cerrar.php">Cerrar</a>
                </li>
            </ul>

        </div>
    </nav>
    <div class="container">
        <br>
        <div class="row">