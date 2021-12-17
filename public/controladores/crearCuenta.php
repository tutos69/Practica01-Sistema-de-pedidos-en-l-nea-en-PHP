<?php


$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
switch ($accion) {
    case 'Cancelar':
        header('Location:../../index.html');
        break;

    case 'CrearCuenta':
        include '../../administrador/config/conexion.php';
        $cedula = isset($_POST["txtCedula"]) ? trim($_POST["txtCedula"]) : null;
        $nombres = isset($_POST["txtNombre"]) ? mb_strtoupper(trim($_POST["txtNombre"]), 'UTF8') : null;
        $apellidos = isset($_POST["txtApellido"]) ? mb_strtoupper(trim($_POST["txtApellido"]), 'UTF8') : null;
        $telefono = isset($_POST["txtTelefono"]) ? trim($_POST["txtTelefono"]) : null;
        $direccion = isset($_POST["txtDireccion"]) ? mb_strtoupper(trim($_POST["txtDireccion"]), 'UTF8') : null;
        $usuario = isset($_POST["correo"]) ? trim($_POST["correo"]) : null;
        $contracenia = isset($_POST["contracenia"]) ? trim($_POST["contracenia"]) : null;
        $rol =  isset($_POST["rol"]) ? trim($_POST["rol"]) : null;
        $txtImagne = (isset($_FILES['txtImagne']['name'])) ? $_FILES['txtImagne']['name'] : "";
      
        $fecha = new DateTime();
        $nombreArchivo = ($txtImagne != "") ? $fecha->getTimestamp() . "_" . $_FILES['txtImagne']['name'] : "imagen.jpg";
        $tmpimagen = $_FILES['txtImagne']['tmp_name'];
        if ($tmpimagen != "") {
            move_uploaded_file($tmpimagen, '../../img/' . $nombreArchivo);
        }

        $sqlUsuario = "INSERT INTO app_usuario VALUES (0,'$usuario', md5('$contracenia'), '$rol', NULL, NULL, 'N')";
        if ($coon->query($sqlUsuario) == true) {
            
            $busCodUsu = "SELECT MAX(usu_id) FROM app_usuario ";
            $row = mysqli_fetch_array($coon->query($busCodUsu));
            $usuId = intval($row[0]);
            if ($rol == 'R') {
                echo 'holar';
                $sqlRes = "INSERT INTO app_restaurante VALUES (0,'$nombres ', '$direccion', '$telefono', '$usuId', '$nombreArchivo')";
                if ($coon->query($sqlRes) == true) {
                    $sql = "SELECT * FROM app_usuario WHERE usu_id = $usuId";
                    $resultado = $coon->query($sql);
                    foreach ($resultado as $usuarios){
                        $cod = $usuarios['usu_id'];
                    }
                    header("Location:../../administrador/vista/restaurantes/platillos.php?codigo=$cod");
                } else {
                    echo 'holarsBorar';
                    $sentenciaSQL = "DELETE FROM app_usuario WHERE usu_id=$usuId ";
                    $coon->query($sentenciaSQL);
                }
            } elseif ($rol == 'C') {
                echo 'holac';
                $sqlCli = "INSERT INTO app_cliente VALUES (0, '$cedula', '$nombres ', '$apellidos', '$direccion', '$telefono', '$usuId', '$nombreArchivo')";
                if ($coon->query($sqlCli) == true) {
                    $sql = "SELECT * FROM app_usuario WHERE usu_id = $usuId";
                    $resultado = $coon->query($sql);
                    foreach ($resultado as $usuarios){
                        $cod = $usuarios['usu_id'];
                    }
                    header("Location:../../administrador/vista/clientes/Pedido.php?codigo=$cod");
                } else {
                    echo 'holacsError Cliente';
                    $sentenciaSQL = "DELETE FROM app_usuario WHERE usu_id=$usuId ";
                    $coon->query($sentenciaSQL);
                }
            }
        }else{
            echo 'Error';
        }


        # $busCodUsu= "SELECT MAX(usu_id) FROM app_usuario ";
        # $row = mysqli_fetch_array($coon->query($busCodUsu));
        # $usuId= intval($row[0]);
        # echo $usuId;
        #INSERT INTO `app_usuario VALUES (NULL, 'edwinz-2@outlook.com', 'tutu', 'U', current_timestamp(), NULL, 'N');

        #$sql="INSERT INTO app_usuario VALUES ('$usuario', md5('$contracenia'), '$rol',NULL, NULL, 'N')";

        #INSERT INTO app_cliente VALUES (NULL, '0106256027', 'Edwin Adrian ', 'Angamarca Zhicay', 'Gualaceo', '0999862100', '2');

        #echo $cedula."<br/>";
        #echo $nombres."<br/>";
        #echo $apellidos."<br/>";
        #echo $telefono."<br/>";
        #echo $direccion."<br/>";
        #echo $usuario."<br/>";
        #echo $contracenia . "<br/>";
        #echo $txtImagne . "<br/>";
        #echo $rol . "<br/><p>gdfgdg</P>";
        break;
}
?>