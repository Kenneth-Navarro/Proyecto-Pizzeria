<?php
require_once "Conexion.php";

function IngresoUsuario($usuario, $contrasena, $idEmpleado, $Rol)
{
    $retorno = "";

    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            $estado = true;
            $stmt = $conexion->prepare("Insert into Usuario (Usuario, Contrasena, Id_Empleado, Rol, Estado) values (?,?,?,?,?)");
            $stmt->bind_Param("ssiii", $usuario, $contrasena, $idEmpleado, $Rol, $estado);

            if ($stmt->execute()) {
                $retorno = "Se almaceno el usuario satisfactoriamente.";
            }
        }

    } catch (\Throwable $th) {
        $retorno = "No se pudo ingresar el usuario ";
    } finally {
        Desconecta($conexion);
    }

    return $retorno;
}

function ObtenerUsuarios($sql)
{

    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {

            if (!$result = mysqli_query($conexion, $sql))
                die();

            $retorno = array();
            while ($row = mysqli_fetch_array($result)) {
                $usuario = $row;

                $sql2 = "Select Nombre, PrimerApellido from Empleado where Cedula = " . $row['Id_Empleado'];
                if (!$empleadoRetornado = mysqli_query($conexion, $sql2))
                    die();

                if ($empleado = mysqli_fetch_array($empleadoRetornado)) {
                    $usuario['NombreEmpleado'] = $empleado['Nombre'];
                    $usuario['PrimerApellidoEmpleado'] = $empleado['PrimerApellido'];
                }

                $retorno[] = $usuario;
            }


        }

    } catch (\Throwable $th) {
        echo "No se pudo obtener los usuarios." . mysqli_connect_error();
    } finally {
        Desconecta($conexion);
    }

    return $retorno;
}

function ObtenerUsuario($sql)
{
    $retorno = null;
    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            if (!$result = mysqli_query($conexion, $sql))
                die();

            while ($row = mysqli_fetch_array($result)) {
                $usuario = $row;

                $sql2 = "Select Nombre, PrimerApellido from Empleado where Cedula = " . $row['Id_Empleado'];
                if (!$empleadoRetornado = mysqli_query($conexion, $sql2))
                    die();

                if ($empleado = mysqli_fetch_array($empleadoRetornado)) {
                    $usuario['NombreEmpleado'] = $empleado['Nombre'];
                    $usuario['PrimerApellidoEmpleado'] = $empleado['PrimerApellido'];
                }

                $retorno = $usuario;
            }



        }
    } catch (\Throwable $th) {
        echo "Ocurrio un error al obtener el usuario " . mysqli_connect_error();
    } finally {
        Desconecta($conexion);
    }

    return $retorno;
}

function ObtenerSesion($usuario)
{
    $retorno = null;
    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            $stmt = $conexion->prepare("Select Usuario, Contrasena, Rol, Estado, Id_Empleado from usuario where Usuario = ?");
            $stmt->bind_Param("s", $usuario);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                while ($row = mysqli_fetch_array($result)) {
                    $usuario = $row;

                    $sql2 = "Select Nombre, PrimerApellido, ID_Puesto from Empleado where Cedula = " . $row['Id_Empleado'];
                    if (!$empleadoRetornado = mysqli_query($conexion, $sql2))
                        die();

                    if ($empleado = mysqli_fetch_array($empleadoRetornado)) {
                        $usuario['NombreEmpleado'] = $empleado['Nombre'];
                        $usuario['PrimerApellidoEmpleado'] = $empleado['PrimerApellido'];
                        $usuario['ID_Puesto'] = $empleado['ID_Puesto'];

                    }

                    $retorno = $usuario;
                }
                
            }



        }
    } catch (\Throwable $th) {
        echo "Ocurrio un error al obtener el usuario ";
    } finally {
        Desconecta($conexion);
    }

    return $retorno;
}

function actualizarUsuario($usuario, $estado, $Rol, $idUsuario)
{
    $retorno = "";

    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            $stmt = $conexion->prepare("Update Usuario set Usuario = ?, Estado = ?, Rol = ? where Usuario = ?");
            $stmt->bind_Param("siis", $usuario, $estado, $Rol, $idUsuario);

            if ($stmt->execute()) {
                $retorno = "Usuario actualizado con exito";
            }
        }

        return $retorno;
    } catch (\Throwable $th) {
        $retorno = "Error al actualizar el usuario ";
    } finally {
        Desconecta($conexion);
    }
    return $retorno;
}

function actualizarUsuarioContrasena($contrasena, $idUsuario)
{
    $retorno = "";

    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            $stmt = $conexion->prepare("Update Usuario set Contrasena = ? where Usuario = ?");
            $stmt->bind_Param("ss", $contrasena, $idUsuario);

            if ($stmt->execute()) {
                $retorno = "Contraseña del Usuario actualizada con exito";
            }
        }

        return $retorno;
    } catch (\Throwable $th) {
        $retorno = "Error al actualizar la contraseña ";
    } finally {
        Desconecta($conexion);
    }
    return $retorno;
}

function eliminarUsuario($Id)
{
    $retorno = "";

    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            $stmt = $conexion->prepare("Delete from Usuario where Usuario = ?");
            $stmt->bind_Param("s", $Id);

            if ($stmt->execute()) {
                $retorno = "Usuario eliminado correctamente";
            }
        }

        return $retorno;
    } catch (\Throwable $th) {
        $retorno = "Error al eliminar el usuario ";
    } finally {
        Desconecta($conexion);
    }

    return $retorno;
}




?>