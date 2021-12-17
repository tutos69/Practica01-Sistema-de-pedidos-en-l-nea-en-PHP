<?php
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";
switch ($accion) {
    case 'Cancelar':
        header('Location:../../index.html');
        break;
    case 'Entrar':
        include '../../administrador/config/conexion.php';
        $usuario = isset($_POST["correo"]) ? trim($_POST["correo"]) : null;
        $contracenia = isset($_POST["contracenia"]) ? trim($_POST["contracenia"]) : null;
        $sql = "SELECT * FROM app_usuario";
        $resultado = $coon->query($sql);
        foreach ($resultado as $usuarios){
            if( ($usuarios['usu_correo']==$usuario) && ($usuarios['usu_contracenia'] == md5($contracenia)) && ($usuarios['usu_rol']=='U')  ){
                session_start();
                $_SESSION['usu_correo']='ok';
                $_SESSION['nombreUsuario']=$usuario;
                header('Location:../../administrador/vista/usuario/clientes.php');
            }elseif(($usuarios['usu_correo']==$usuario) && ($usuarios['usu_contracenia'] == md5($contracenia)) && ($usuarios['usu_rol']=='R') ){
                header('Location:../../administrador/vista/restaurantes/platillos.php');
            }elseif(($usuarios['usu_correo']==$usuario) && ($usuarios['usu_contracenia'] == md5($contracenia)) && ($usuarios['usu_rol']=='C') ){
                header('Location:../../administrador/vista/restaurantes/platillos.php');
            }
            
        }
        
        break;
    case 'CrearCuenta':
        header('Location:../vista/CrearCuenta.html');
        break;
}
?>