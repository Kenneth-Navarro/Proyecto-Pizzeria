<?php
    require_once "Conexion.php";

    function IngresoClientes($cedula, $nombre, $primerApellido, $segundoApellido, $direccion, $telefono, $correo){
        $retorno = "";

        try {
            $conexion = Conecta();

            if (mysqli_set_charset($conexion,"utf8")) {
                $stmt = $conexion->prepare("Insert into cliente (Cedula, Nombre, PrimerApellido, SegundoApellido, Direccion, NumeroTelefono, Correo) values (?,?,?,?,?,?,?)");
                $stmt->bind_Param("issssss", $cedula, $nombre, $primerApellido, $segundoApellido, $direccion, $telefono, $correo);

                if($stmt->execute()){
                    $retorno="Se almaceno el cliente satisfactoriamente.";
                }
            }


        } catch (\Throwable $th) {
            $retorno = "No se pudo ingresar el cliente ". mysqli_connect_error();
        }finally{
            $stmt->close();
            Desconecta($conexion);
        }

        return $retorno;
    }

    function ObtenerClientes($sql){
        try {
            $conexion = Conecta();

            if(mysqli_set_charset($conexion, "utf8")){
                
                if(!$result = mysqli_query($conexion, $sql)) die();

                $retorno = array();

                while($row = mysqli_fetch_array($result)) {
                    $retorno[] = $row;
                }

            }

        
        } catch (\Throwable $th) {
            echo "No se pudo obtener los clientes.". mysqli_connect_error();
        }finally{
            Desconecta($conexion);
        }

        return $retorno;
    }

    function ObtenerCliente($sql){
        try {
            $conexion = Conecta();

            if(mysqli_set_charset($conexion,"utf8")){
                if(!$result = mysqli_query($conexion, $sql)) die();

                $retorno = null;

                while($row = mysqli_fetch_array($result)){
                    $retorno = $row;
                }

            }
        } catch (\Throwable $th) {
            echo "Ocurrio un error al obtener el cliente ". mysqli_connect_error();
        }finally{
            Desconecta($conexion);
        }

        return $retorno;
    }

    function actualizarCliente($cedula, $nombre, $primerApellido, $segundoApellido, $direccion, $telefono, $correo, $cedulaID){
        $retorno = "";
        
        try {
            $conexion = Conecta();

            if(mysqli_set_charset($conexion,"utf8")){
                $stmt = $conexion->prepare("Update Cliente set Cedula = ?, Nombre = ?, PrimerApellido = ?, SegundoApellido = ?, Direccion = ?, NumeroTelefono = ?, Correo = ? where Cedula = ?");
                $stmt->bind_Param("issssisi", $cedula, $nombre, $primerApellido, $segundoApellido, $direccion, $telefono, $correo, $cedulaID);
            
                if($stmt->execute()){
                    $retorno = "Cliente actualizado con exito";
                }
            }

            return $retorno;
        } catch (\Throwable $th) {
            $retorno = "Error al actualizar el cliente ";
        }
        finally{
            $stmt ->close();
            Desconecta($conexion);
        }

        return  $retorno;
    }

    function eliminarCliente($Id){
        $retorno = "";
        
        try {
            $conexion = Conecta();

            if(mysqli_set_charset($conexion,"utf8")){
                $stmt = $conexion->prepare("Delete from Cliente where Cedula = ?");
                $stmt->bind_Param("i", $Id);
            
                if($stmt->execute()){
                    $retorno = "Cliente eliminado correctamente.";
                }
            }

            return $retorno;
        } catch (\Throwable $th) {
            $retorno = "Error al eliminar el cliente ";
        }
        finally{
            $stmt ->close();
            Desconecta($conexion);
        }

        return $retorno;
    }


?>