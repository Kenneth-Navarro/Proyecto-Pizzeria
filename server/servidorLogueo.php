<?php
require_once "../include/functions/recoge.php";
require_once "../DAL/usuarioDAL.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    iniciarSesion();
}


function iniciarSesion()
{
    $usuario = recogePost('usuario');
    $contrasena = recogePost('contrasena');

    $sql = "Select Usuario, Contrasena, Rol, Estado, Id_Empleado from usuario where Usuario = '$usuario'";
    $usuarioObtenido = ObtenerSesion($usuario);

    if ($usuarioObtenido == null) {
        print "Usuario no encontrado.";
    } else {
        $contrasenaAlmacenada = $usuarioObtenido['Contrasena'];
        if (!password_verify($contrasena, $contrasenaAlmacenada)) {
            print "Contraseña inválida.";
        } elseif ($usuarioObtenido['Estado'] == false) {
            print "Este usuario esta inactivo, consulte con algún administrador";
        } else {
            session_start();
            $_SESSION['Logueado'] = $usuarioObtenido;
            $respuesta = "Iniciando Sesion";

            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

        }
    }
}
?>