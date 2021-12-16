<?php
if ($_POST) {
    header('Location:../vista/restaurantes/inicio.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>

<body>

    <div class="container ">
        <br> <br>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <form method="POST">
                    <legend>Inicie Sesión</legend>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label mt-4">Usuario</label>
                        <input type="email" class="form-control" name="correo" aria-describedby="emailHelp" placeholder="Correo electronico">
                        <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su correo electrónico con nadie más.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="form-label mt-4">Contraceña </label>
                        <input type="password" class="form-control" name="contracenia" placeholder="Contraceña">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-secondary">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>