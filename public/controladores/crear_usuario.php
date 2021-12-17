<?php 
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
switch ($accion) {
    case 'Cancelar':
        header('Location:../../index.html');
        break;
        
    case 'CrearCuenta':
        include '../../administrador/config/conexion.php';
        $cedula = isset($_POST["txtCedula"]) ? trim($_POST["txtCedula"]):null;
        $nombres = isset($_POST["txtNombre"]) ? mb_strtoupper(trim($_POST["txtNombre"]), 'UTF8'):null;
        $apellidos = isset($_POST["txtApellido"]) ? mb_strtoupper(trim($_POST["txtApellido"]), 'UTF8'):null;
        $telefono = isset($_POST["txtTelefono"]) ? trim($_POST["txtTelefono"]):null;
        $direccion = isset($_POST["txtDireccion"]) ? mb_strtoupper(trim($_POST["txtDireccion"]), 'UTF8'):null;
        $usuario = isset($_POST["correo"]) ? trim($_POST["correo"]):null;
        $contracenia = isset($_POST["contracenia"]) ? trim($_POST["contracenia"]):null;
        $rol =  isset($_POST["rol"]) ? trim($_POST["rol"]):null;
        
        
        
        
        $busCodUsu= "SELECT MAX(usu_id) FROM app_usuario ";
        $row = mysqli_fetch_array($coon->query($busCodUsu));
        $usuId= intval($row[0]);
        echo $usuId;
        #INSERT INTO `app_usuario` (`usu_id`, `usu_correo`, `usu_contracenia`, `usu_rol`, `usu_fecha_creacion`, `usu_fecha_modificacion`, `usu_eliminado`) VALUES (NULL, 'edwinz-2@outlook.com', 'tutu', 'U', current_timestamp(), NULL, 'N');
        
        #$sql="INSERT INTO app_usuario VALUES ('$usuario', md5('$contracenia'), '$rol',NULL, NULL, 'N')";

        #INSERT INTO `app_cliente` (`cli_id`, `cli_cedula`, `cli_nombre`, `cli_apellidos`, `cli_direccion`, `cli_telefono`, `cli_usu`) VALUES (NULL, '0106256027', 'Edwin Adrian ', 'Angamarca Zhicay', 'Gualaceo', '0999862100', '2');

        #echo $cedula."<br/>";
        #echo $nombres."<br/>";
        #echo $apellidos."<br/>";
        #echo $telefono."<br/>";
        #echo $direccion."<br/>";
        #echo $usuario."<br/>";
        #echo $contracenia."<br/>";
        #echo $rol."<br/>";
        break;
}
        
?>