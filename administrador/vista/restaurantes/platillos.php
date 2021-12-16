<?php include('cabRestaurante.php'); ?>

<?php
include('../../config/conexion.php');
$txtCodigo = (isset($_POST['txtCodigo'])) ? $_POST['txtCodigo'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtDescripcion = (isset($_POST['txtDescripcion'])) ? $_POST['txtDescripcion'] : "";
$txtPresio = (isset($_POST['txtPresio'])) ? $_POST['txtPresio'] : "";
$txtImagne = (isset($_FILES['txtImagne']['name'])) ? $_FILES['txtImagne']['name'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
$precio = doubleval($txtPresio);

switch ($accion) {
    case 'Agregar':
        #INSERT INTO app_producto (pro_nombre, pro_descripcion,pro_precio, pro_imagen) VALUES (:nombre,:descripcion,:precio,:imagen);
        $sentenciaSQL = "INSERT INTO app_producto VALUES (0,'$txtNombre','$txtDescripcion','$precio','$txtImagne')";
        if ($coon->query($sentenciaSQL) == true) {
        } else {
            echo "No Vale" . mysqli_error($coon);
        }
        break;
    case 'Modificar':
        # code...
        break;
    case 'Cancelar':
        # code...
        break;
    case 'Selecionar':
        $sentenciaSQL = "SELECT * FROM app_producto WHERE pro_id=$txtCodigo ";
        $Seleccionado = $coon->query($sentenciaSQL);
        $txtNombre=$Seleccionado['pro_nombre'];
        $txtDescripcion=$Seleccionado['pro_descripcion'];
        $txtPresio=$Seleccionado['pro_precio'];
        $txtImagne=$Seleccionado['pro_imagen'];
        break;
    case 'Borrar':
        # code...
        break;
}

$sentenciaSQL = "SELECT * FROM app_producto ";
$listado = $coon->query($sentenciaSQL);
?>

<div class="col-md-5">

    <div class="card">
        <div class="card-body">
            <h1>Ingrese el Platillo</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <fieldset>
                        <label class="form-label mt-4" for="readOnlyInput">Codigo</label>
                        <input class="form-control" name="txtCodigo" id="readOnlyInput" type="number" placeholder="Codigo" readonly="">
                    </fieldset>
                </div>
                <div class="form-group">
                    <label class="form-label mt-4">Ingrese el nombre del Platillo</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtNombre" placeholder="nombrePlatillo">
                        <label for="floatingInput">Nombre Platillo</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleTextarea" class="form-label mt-4">Descripcion</label>
                    <textarea class="form-control" name="txtDescripcion" id="exampleTextarea" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label mt-4">Presio</label>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="txtPresio" placeholder="Presio">
                        <label for="floatingInput">Presio</label>
                    </div>
                    <label class="form-label mt-4">Imagen</label>
                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" name="txtImagne" placeholder="Presio">
                        <label for="floatingInput">Imagen</label>
                    </div>
                </div>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Canccelar</button>
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
                    <td><?php echo $producto['pro_imagen']; ?></td>
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