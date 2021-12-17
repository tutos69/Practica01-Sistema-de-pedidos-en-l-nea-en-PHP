<?php include("../../../Practica01-Sistema-de-pedidos-en-l-nea-en-PHP/template/cabecera.php"); ?>

<?php include('../../administrador/config/conexion.php');
$codigoUsu = $_GET["codigo"];
$sentenciaSQL = "SELECT * FROM app_producto WHERE pro_res = $codigoUsu";
$listado = $coon->query($sentenciaSQL);

?>

<?php foreach ($listado as $restaurantes) { ?>
    <div class="col-md-4">
        <div class="card">
            <img class="card-img-top" src="../../img/<?php echo $restaurantes['pro_imagen']; ?>" alt="">
            <div class="card-body">
                <h4 class="card-title"><?php echo $restaurantes['pro_nombre']; ?></h4>
            </div>
        </div>
    </div>
<?php } ?>

<?php include("../../../Practica01-Sistema-de-pedidos-en-l-nea-en-PHP/template/footer.php"); ?>