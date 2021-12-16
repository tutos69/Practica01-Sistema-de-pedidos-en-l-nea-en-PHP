<?php
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
switch ($accion) {
    case 'Cancelar':
        #echo "Ya valio";
        header('Location:../../index.php');
        break;
    case 'CrearCuenta':
        
        # header('Location:CrearCuenta.php');
        break;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <p class="text-primary">
                    <legend>Crear Cuenta</legend>
                </p>
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label mt-4">Ingrese su Cedula:</label>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtCedula" placeholder="cedula">
                                <label for="floatingInput">Cedula</label>
                            </div>
                            <label class="form-label mt-4">Ingrese sus Apellidos:</label>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtApellido" placeholder="apellido">
                                <label for="floatingInput">Apellidos</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mt-4">Ingrese sus Nombres:</label>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtNombre" placeholder="nombre">
                                <label for="floatingInput">Nombres</label>
                            </div>
                            <label class="form-label mt-4">Ingrese su Telefono:</label>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtTelefono" placeholder="telefono">
                                <label for="floatingInput">Telefono</label>
                            </div>
                        </div>
                    </div>
                    <label class="form-label mt-4">Ingrese su Direccion:</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtDireccion" placeholder="direccion">
                        <label for="floatingInput">Direccion</label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <fieldset class="form-group">
                        <legend class="mt-4">Escoje Tu cargo</legend>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                                Cliente
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
                                Restaurante
                            </label>
                        </div>
                    </fieldset>
                    <br>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn-danger">Cancelar</button>
                    <button type="submit" name="accion" value="CrearCuenta" class="btn btn-dark">Crear Cuenta</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>