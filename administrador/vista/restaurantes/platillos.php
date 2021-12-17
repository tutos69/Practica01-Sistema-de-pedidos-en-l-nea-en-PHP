<?php include('cabRestaurante.php'); ?>

<?php

$txtCodigo = (isset($_POST['txtCodigo'])) ? $_POST['txtCodigo'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtDescripcion = (isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";
$txtPresio = (isset($_POST['txtPresio'])) ? $_POST['txtPresio'] : "";
$txtImagne = (isset($_FILES['txtImagne']['name'])) ? $_FILES['txtImagne']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
$precio = doubleval($txtPresio);


$restauranteUsu = "SELECT * FROM app_restaurante WHERE res_usu=$codigoUsu ";
$listadoUsuario = $coon->query($restauranteUsu);
foreach ($listadoUsuario as $Restaurante) {
    $idRestaurante = $Restaurante['res_id'];
}
switch ($accion) {
    case 'Agregar':
        #INSERT INTO app_producto (pro_nombre, pro_descripcion,pro_precio, pro_imagen) VALUES (:nombre,:descripcion,:precio,:imagen);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImagne != "") ? $fecha->getTimestamp() . "_" . $_FILES['txtImagne']['name'] : "imagen.jpg";
        $tmpimagen = $_FILES['txtImagne']['tmp_name'];
        if ($tmpimagen != "") {
            move_uploaded_file($tmpimagen, '../../../img/' . $nombreArchivo);
        }

        $sentenciaSQL = "INSERT INTO app_producto VALUES (0,'$txtNombre','$txtDescripcion','$precio','$nombreArchivo', '$idRestaurante')";
        if ($coon->query($sentenciaSQL) == true) {
        } else {
            echo "No Vale" . mysqli_error($coon);
        }
        header('Locatio:platillos.php');
        break;
    case 'Modificar':

        $sentenciaSQL = "UPDATE app_producto SET pro_nombre='$txtNombre', pro_descripcion='$txtDescripcion', pro_precio='$precio' WHERE pro_id=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);

        if ($txtImagne != "") {
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagne != "") ? $fecha->getTimestamp() . "_" . $_FILES['txtImagne']['name'] : "imagen.jpg";
            $tmpimagen = $_FILES['txtImagne']['tmp_name'];
            move_uploaded_file($tmpimagen, '../../../img/' . $nombreArchivo);

            $sentenciaSQL = "SELECT pro_imagen FROM app_producto WHERE pro_id=$txtCodigo ";
            $Seleccionado = $coon->query($sentenciaSQL);
            foreach ($Seleccionado as $productoss) {
                if (isset($productoss["pro_imagen"]) && ($productoss["pro_imagen"] != "imagen.jpg")) {
                    if (file_exists('../../../img/' . $productoss['pro_imagen'])) {
                        unlink('../../../img/' . $productoss['pro_imagen']);
                    }
                }
            }

            $sentenciaSQL = "UPDATE app_producto SET pro_imagen='$nombreArchivo' WHERE pro_id=$txtCodigo ";
            $Seleccionado = $coon->query($sentenciaSQL);
        }
        header('Locatio:platillos.php');
        break;
    case 'Cancelar':
        header('Locatio:platillos.php');
        break;
    case 'Selecionar':
        $sentenciaSQL = "SELECT * FROM app_producto WHERE pro_id=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        foreach ($Seleccionado as $productoss) {
            $txtNombre = $productoss['pro_nombre'];
            $txtDescripcion = $productoss['pro_descripcion'];
            $txtPresio = $productoss['pro_precio'];
            $txtImagne = $productoss['pro_imagen'];
        }
       
        break;
    case 'Borrar':
        $sentenciaSQL = "SELECT pro_imagen FROM app_producto WHERE pro_id=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        foreach ($Seleccionado as $productoss) {
            if (isset($productoss["pro_imagen"]) && ($productoss["pro_imagen"] != "imagen.jpg")) {
                if (file_exists('../../../img/' . $productoss['pro_imagen'])) {
                    unlink('../../../img/' . $productoss['pro_imagen']);
                }
            }
        }

        $sentenciaSQL = "DELETE FROM app_producto WHERE pro_id=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        header('Locatio:platillos.php');
        break;
}

$sentenciaSQL = "SELECT * FROM app_producto WHERE pro_res=$idRestaurante ";
$listado = $coon->query($sentenciaSQL);
?>

<div class="col-md-5">

    <div class="card">
        <div class="card-body">
            <h1>Ingrese el Platillo</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <fieldset>
                        <label class="form-label mt-4" for="readOnlyInput">Codigo:</label>
                        <input class="form-control" name="txtCodigo" id="readOnlyInput" value="<?php echo $txtCodigo; ?>" type="number" placeholder="Codigo" readonly="">
                    </fieldset>
                </div>
                <div class="form-group">
                    <label class="form-label mt-4">Ingrese el nombre del Platillo:</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtNombre" value="<?php echo $txtNombre; ?>" placeholder="nombrePlatillo">
                        <label for="floatingInput">Nombre Platillo</label>
                    </div>
                    <label class="form-label mt-4">Descripcion:</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtDescripcion" value="<?php echo $txtDescripcion; ?>" placeholder="Descripcion">
                        <label for="floatingInput">Descripcion</label>
                    </div>
                    <label class="form-label mt-4">Presio:</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtPresio" value="<?php echo $txtPresio; ?>" placeholder="Presio">
                        <label for="floatingInput">Presio</label>
                    </div>
                    <label class="form-label mt-4">Imagen:</label> <img src="../../../img/<?php echo $txtImagne; ?>" width="70" alt="">
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" name="txtImagne" placeholder="imagen">
                        <label for="floatingInput">Imagen</label>
                    </div>
                </div>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion=='Selecionar')?'disabled':'';?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion!='Selecionar')?'disabled':'';?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion!='Selecionar')?'disabled':'';?> value="Cancelar" class="btn btn-info">Canccelar</button>
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
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Presio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listado as $producto) { ?>
                <tr>
                    <td><?php echo $producto['pro_id']; ?></td>
                    <td><?php echo $producto['pro_nombre']; ?></td>
                    <td><?php echo $producto['pro_descripcion']; ?></td>
                    <td><?php echo $producto['pro_precio']; ?></td>
                    <td>
                        <img src="../../../img/<?php echo $producto['pro_imagen']; ?>" width="50" alt="">
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="txtCodigo" id="txtCodigo" value="<?php echo $producto['pro_id']; ?>" />
                            <input type="submit" name="accion" value="Selecionar" class="btn btn-success">
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>



</div>


<?php include('fooRestaurante.php'); ?>