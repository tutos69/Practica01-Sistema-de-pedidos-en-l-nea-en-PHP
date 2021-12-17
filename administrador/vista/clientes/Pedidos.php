<?php include('cabCliente.php'); ?>
<?php

$txtCodigo = (isset($_POST['txtCodigo'])) ? $_POST['txtCodigo'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtApellidos = (isset($_POST['txtApellidos'])) ? $_POST['txtApellidos'] : "";
$txtcedula = (isset($_POST['txtcedula'])) ? $_POST['txtcedula'] : "";
$txtDireccion = (isset($_POST['txtDireccion'])) ? $_POST['txtDireccion'] : "";
$txtTelefono = (isset($_POST['txtTelefono'])) ? $_POST['txtTelefono'] : "";
$txtCorreo = (isset($_POST['txtCorreo'])) ? $_POST['txtCorreo'] : "";
$txtImagne = (isset($_FILES['txtImagne']['name'])) ? $_FILES['txtImagne']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
include('../../config/conexion.php');
switch ($accion) {
    case 'Modificar':
        $sentenciaSQL = "UPDATE app_cliente SET cli_nombre='$txtNombre', cli_apellidos='$txtApellidos', cli_direccion='$txtDireccion' , cli_telefono ='$txtTelefono' WHERE cli_id=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);

        if ($txtImagne != "") {
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagne != "") ? $fecha->getTimestamp() . "_" . $_FILES['txtImagne']['name'] : "imagen.jpg";
            $tmpimagen = $_FILES['txtImagne']['tmp_name'];
            move_uploaded_file($tmpimagen, '../../../img/' . $nombreArchivo);

            $sentenciaSQL = "SELECT cli_imagen FROM app_cliente WHERE cli_id=$txtCodigo ";
            $Seleccionado = $coon->query($sentenciaSQL);
            foreach ($Seleccionado as $productoss) {
                if (isset($productoss["cli_imagen"]) && ($productoss["cli_imagen"] != "imagen.jpg")) {
                    if (file_exists('../../../img/' . $productoss['cli_imagen'])) {
                        unlink('../../../img/' . $productoss['cli_imagen']);
                    }
                }
            }

            $sentenciaSQL = "UPDATE app_cliente SET cli_imagen='$nombreArchivo' WHERE cli_id=$txtCodigo ";
            $Seleccionado = $coon->query($sentenciaSQL);
        }
        header('Locatio:clientes.php');
        break;
    case 'Cancelar':
        header('Locatio:clientes.php');
        break;
    case 'Selecionar':
        $sentenciaSQL = "SELECT * FROM app_cliente WHERE cli_id=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        foreach ($Seleccionado as $productoss) {
            $txtNombre = $productoss['cli_nombre'];
            $txtcedula = $productoss['cli_cedula'];
            $txtApellidos = $productoss['cli_apellidos'];
            $txtDireccion = $productoss['cli_direccion'];
            $txtTelefono = $productoss['cli_telefono'];
            $txtImagne = $productoss['cli_imagen'];
            $usuarioID = $productoss['cli_usu'];
        }
        $idusuario = intval($usuarioID);
        $sentenciaUsu = "SELECT * FROM app_usuario WHERE usu_id= $idusuario ";
        $usuarioSQL = $coon->query($sentenciaUsu);
        foreach ($usuarioSQL as $enconTrUsu) {
            $txtCorreo = $enconTrUsu['usu_correo'];
        }

        break;
}

$sentenciaSQL = "SELECT * FROM app_cliente ";
$listado = $coon->query($sentenciaSQL);
?>

<div class="col-md-5">

    <div class="card">
        <div class="card-body">
            <h1>Clientes</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <fieldset>
                        <label class="form-label mt-4" for="readOnlyInput">Codigo:</label>
                        <input class="form-control" name="txtCodigo" id="readOnlyInput" value="<?php echo $txtCodigo; ?>" type="number" placeholder="Codigo" readonly="">
                    </fieldset>
                </div>
                <div class="form-group">
                    <label class="form-label mt-4">Cedula:</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtcedula" value="<?php echo $txtcedula; ?>" placeholder="cedula">
                        <label for="floatingInput">Cedula</label>
                    </div>
                    <label class="form-label mt-4">Nombres:</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtNombre" value="<?php echo $txtNombre; ?>" placeholder="nombre">
                        <label for="floatingInput">Nombre </label>
                    </div>
                    <label class="form-label mt-4">Apellidos:</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtApellidos" value="<?php echo $txtApellidos; ?>" placeholder="apellidos">
                        <label for="floatingInput">Apellidos</label>
                    </div>
                    <label class="form-label mt-4">Direccion:</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtDireccion" value="<?php echo $txtDireccion; ?>" placeholder="direccion">
                        <label for="floatingInput">Direccion</label>
                    </div>
                    <label class="form-label mt-4">Telefono:</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtTelefono" value="<?php echo $txtTelefono; ?>" placeholder="telefono">
                        <label for="floatingInput">Telefono</label>
                    </div>
                    <label class="form-label mt-4">Correo:</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtCorreo" value="<?php echo $txtCorreo; ?>" placeholder="Correo">
                        <label for="floatingInput">Correo</label>
                    </div>
                    <label class="form-label mt-4">Imagen:</label> <img src="../../../img/<?php echo $txtImagne; ?>" width="70" alt="">
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" name="txtImagne" placeholder="Presio">
                        <label for="floatingInput">Imagen</label>
                    </div>
                </div>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion != 'Selecionar') ? 'disabled' : ''; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion != 'Selecionar') ? 'disabled' : ''; ?> value="Cancelar" class="btn btn-info">Canccelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-7">
    <table class="table">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listado as $producto) { ?>
                <tr>
                    <td><?php echo $producto['cli_id']; ?></td>
                    <td><?php echo $producto['cli_cedula']; ?></td>
                    <td><?php echo $producto['cli_nombre']; ?></td>
                    <td><?php echo $producto['cli_apellidos']; ?></td>
                    <td><?php echo $producto['cli_direccion']; ?></td>
                    <td><?php echo $producto['cli_telefono']; ?></td>
                    <?php
                    $usuarioID = $producto['cli_usu'];
                    $sentenciaUsu = "SELECT * FROM app_usuario WHERE usu_id= $usuarioID ";
                    $usuarioSQL = $coon->query($sentenciaUsu);
                    foreach ($usuarioSQL as $enconTrUsu) { ?>
                        <td>
                            <?php echo $enconTrUsu['usu_correo']; ?>
                        </td>
                    <?php } ?>
                    <td>
                        <img src="../../../img/<?php echo $producto['cli_imagen']; ?>" width="50" alt="">
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="txtCodigo" id="txtCodigo" value="<?php echo $producto['cli_id']; ?>" />
                            <input type="submit" name="accion" value="Selecionar" class="btn btn-success">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>



</div>
<?php include('fooCliente.php'); ?>