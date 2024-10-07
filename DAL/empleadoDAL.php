<?php
require_once "Conexion.php";

function IngresoEmpleados($cedula, $nombre, $primerApellido, $segundoApellido, $edad, $idPuesto, $salario, $fechaContratacion, $direccion, $telefono, $correo)
{
    $retorno = "";

    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            $stmt = $conexion->prepare("Insert into empleado (Cedula, Nombre, PrimerApellido, SegundoApellido, Edad, ID_Puesto, Salario, FechaContratacion, Direccion, Telefono, Correo) values (?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_Param("isssiidssis", $cedula, $nombre, $primerApellido, $segundoApellido, $edad, $idPuesto, $salario, $fechaContratacion, $direccion, $telefono, $correo);

            if ($stmt->execute()) {
                $retorno = "Empleado ingresado con Exito.";
            }
        }



    } catch (\Throwable $th) {
        $retorno = "No se pudo ingresar el empleado ";
    } finally {
        $stmt ->close();
        Desconecta($conexion);
    }

    return $retorno;
}


function ObtenerEmpleados($sql)
{
    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {

            if (!$result = mysqli_query($conexion, $sql))
                die();

            $retorno = array();

            while ($row = mysqli_fetch_array($result)) {
                $empleado = $row;

                $retorno[] = $empleado;
            }

        }


    } catch (\Throwable $th) {
        echo "No se pudo obtener los empleados." . mysqli_connect_error();
    } finally {
        Desconecta($conexion);
    }

    return $retorno;
}

function ObtenerEmpleado($sql)
{
    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            if (!$result = mysqli_query($conexion, $sql))
                die();

            $retorno = null;

            while ($row = mysqli_fetch_array($result)) {
                $empleado = $row;
                $sql2 = "select ID_PUESTO, NombrePuesto from puesto Puesto where ID_Puesto = " . $row["ID_Puesto"];

                if (!$puestoRetornado = mysqli_query($conexion, $sql2))
                    die();

                if ($puesto = mysqli_fetch_array($puestoRetornado)) {
                    $empleado['Puesto'] = $puesto;

                }

                $retorno = $empleado;

            }

        }
    } catch (\Throwable $th) {
        echo "Ocurrio un error al obtener el empleado " . mysqli_connect_error();
    } finally {
        Desconecta($conexion);
    }

    return $retorno;
}

function actualizarEmpleado($cedula, $nombre, $primerApellido, $segundoApellido, $edad, $idPuesto, $salario, $fechaContratacion, $direccion, $telefono, $correo, $cedulaID)
{
    $retorno = "";

    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            $stmt = $conexion->prepare("Update Empleado set Cedula = ?, Nombre = ?, PrimerApellido = ?, SegundoApellido = ?, Edad = ?, ID_Puesto = ?, Salario = ?, FechaContratacion = ? ,  Direccion = ?, Telefono = ?, Correo = ? where Cedula = ?");
            $stmt->bind_Param("isssiidssssi", $cedula, $nombre, $primerApellido, $segundoApellido, $edad, $idPuesto, $salario, $fechaContratacion, $direccion, $telefono, $correo, $cedulaID);

            if ($stmt->execute()) {
                $retorno = "Empleado actualizado con exito";
            }
        }

        return $retorno;
    } catch (\Throwable $th) {
        $retorno = "No se pudo actualizar el Empleado";
    } finally {
        $stmt -> close();
        Desconecta($conexion);
        
    }

    return $retorno;
}

function eliminarEmpleado($Id)
{
    $retorno = "";

    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            $stmt = $conexion->prepare("Delete from Empleado where Cedula = ?");
            $stmt->bind_Param("i", $Id);

            if ($stmt->execute()) {
                $retorno = "Empleado eliminado correctamente";
            }
        }

        return $retorno;
    } catch (\Throwable $th) {
        $retorno = "Error al eliminar el empleado";
    } finally {
        $stmt->close();
        Desconecta($conexion);
    }

    return $retorno;
}


function obtenerPuestos(){
    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
        $sql = "Select ID_Puesto, NombrePuesto from puesto";
            if (!$result = mysqli_query($conexion, $sql))
                die();

            $retorno = array();

            while ($row = mysqli_fetch_array($result)) {
                $puesto = $row;

                $retorno[] = $puesto;

            }

        }


    } catch (\Throwable $th) {
        echo "No se pudo obtener los puestos." . mysqli_connect_error();
    } finally {
        Desconecta($conexion);
    }

    return $retorno;
}


?>