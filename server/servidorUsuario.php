<?php
require_once "../DAL/empleadoDAL.php";
require_once "../include/functions/recoge.php";
require_once "../DAL/usuarioDAL.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === "insertar") {
        // Llama a la función "insertarCliente"
        insertarUsuario();
    } else if (isset($_POST['accion']) && $_POST['accion'] === "actualizar") {
        actualizaUsuario();
    } else if (isset($_POST['accion']) && $_POST['accion'] === "actualizarContrasena") {
        actualizaContrasena();
    } else if (isset($_POST['accion']) && $_POST['accion'] === "eliminar") {
        eliminar();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] === "devuelveUsuarios") {
        devuelveUsuarios();
    } else if (isset($_GET["accion"]) && $_GET["accion"] === "ObtenerUsuario") {
        devuelveUsuario();
    }
}


function insertarUsuario()
{
    $usuario = recogePost("Usuario");
    $contrasena = recogePost("Contrasena");
    $concontrasena = recogePost("conContrasena");
    $empleado = recogePost("Empleado");
    $rol = recogePost("Rol");


    $usuarioOK = false;
    $contrasenaOK = false;
    $conContrasenaOK = false;
    $empleadoOK = false;
    $rolOK = false;

    if ($usuario == "") {
        print "No se ha ingresado el usuario.";
    } elseif (strlen($usuario) < 5) {
        print "El usuario debe contener al menos 5 caracteres.";
    } else {
        $usuarioOK = true;
    }

    if ($contrasena == "") {
        print "No se ha insertado una contraseña.";
    } elseif (strlen($contrasena) < 8) {
        print "La contraseña debe contener al menos 8 caracteres.";
    } elseif (!(preg_match_all('/[A-Za-z]/', $contrasena) >= 4 && preg_match_all('/[0-9]/', $contrasena) >= 4)) {
        print "La contraseña debe tener al menos 4 letras y 4 números.";
    } else {
        $contrasenaOK = true;
    }

    if ($contrasenaOK) {
        if ($concontrasena == "") {
            print "Debe confirmar la contraseña";
        } elseif ($concontrasena != $contrasena) {
            print "Las contraseñas no coinciden.";
        } else {
            $conContrasenaOK = true;
        }
    }

    if ($empleado == "") {
        print "No se ha seleccionado un empleado.";
    } else {
        $empleadoOK = true;
    }

    if ($rol == "") {
        print "No ha seleccionado el rol.";
    } else {
        $rolOK = true;
    }

    if ($usuarioOK && $contrasenaOK && $empleadoOK && $rolOK && $conContrasenaOK) {
        $contrasenaEncriptada = password_hash($contrasena, PASSWORD_DEFAULT);
        $respuesta = IngresoUsuario($usuario, $contrasenaEncriptada, $empleado, $rol);
        if ($respuesta == "No se pudo ingresar el usuario ") {
            print "No se pudo ingresar el usuario.";
        } else {
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }


}


function devuelveUsuario()
{
    $ID = $_GET['id'];
    $sql = "Select Usuario, Rol, Id_Empleado, Estado  from usuario where Usuario = '{$ID}'";
    $usuario = ObtenerUsuario($sql);
    $usuario['ID'] = $ID;
    echo json_encode($usuario, JSON_UNESCAPED_UNICODE);
}


function devuelveUsuarios()
{

    $sql = "Select Usuario, Contrasena, Rol, Id_Empleado from usuario";
    $usuario = ObtenerUsuarios($sql);
    echo json_encode($usuario, JSON_UNESCAPED_UNICODE);

}





function actualizaUsuario()
{
    $ID = recogePost("ID");
    $usuario = recogePost("Usuario");
    $Rol = recogePost("Rol");
    $Estado = recogePost("Estado");


    $usuarioOK = false;
    $RolOK = false;
    $EstadoOK = false;


    if ($usuario == "") {
        print "No se ha insertado un usuario.";
    } else {
        $usuarioOK = true;
    }


    if ($Rol == "") {
        print "No se ha ingresado el rol";
    } else {
        $RolOK = true;
    }

    if ($Estado == "") {
        print "No se ha ingresado el estado";
    } else {
        $EstadoOK = true;
    }


    if ($usuarioOK && $EstadoOK && $RolOK) {
        $respuesta = actualizarUsuario($usuario, $Estado, $Rol, $ID);

        if ($respuesta == "Error al actualizar el usuario ") {
            print "No se pudo actualizar el Usuario";
        } else {
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }
}


function eliminar()
{
    $idEliminar = recogePost("ID");
    $respuesta = eliminarUsuario($idEliminar);
    if ($respuesta == "Error al eliminar el usuario ") {
        print "No se pudo eliminar el usuario.";
    } else {
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

}

function actualizaContrasena()
{
    $ID = recogePost("ID");
    $contrasena = recogePost("Contrasena");
    $conContrasena = recogePost("conContrasena");

    $contrasenaOK = false;
    $conContrasenaOK = false;


    if ($contrasena == "") {
        print "No se ha insertado la contraseña.";
    } elseif (strlen($contrasena) < 8) {
        print "La contraseña debe contener al menos 8 caracteres.";
    } elseif (!(preg_match_all('/[A-Za-z]/', $contrasena) >= 4 && preg_match_all('/[0-9]/', $contrasena) >= 4)) {
        print "La contraseña debe tener al menos 4 letras y 4 números.";
    } else {
        $contrasenaOK = true;
    }


    if ($contrasenaOK) {
        if ($conContrasena == "") {
            print "Debe confirmar la contraseña.";
        } elseif($conContrasena != $contrasena){
            print "Las contraseñas no coinciden.";
        } 
        else {
            $conContrasenaOK = true;
        }
    }

    if ($contrasenaOK && $conContrasenaOK) {
        $contrasena = trim($contrasena);
        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        $respuesta = actualizarUsuarioContrasena($contrasena, $ID);

        if ($respuesta == "Error al actualizar la contraseña ") {
            print "No se pudo actualizar la contraseña";
        } else {
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }
}











?>