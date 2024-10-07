<?php
    require_once "Conexion.php";

    function IngresoProveedor($nombre, $encargado, $Telefono, $correo){
        $retorno = "";

        try {
            $conexion = Conecta();

            if (mysqli_set_charset($conexion,"utf8")) {
                $stmt = $conexion->prepare("Insert into proveedor (Nombre, Encargado, Telefono, Correo) values (?,?,?,?)");
                $stmt->bind_Param("ssis", $nombre, $encargado, $Telefono, $correo);

                if($stmt->execute()){
                    $retorno="Se almaceno el proveedor satisfactoriamente";
                }
            }
        } catch (\Throwable $th) {
            $retorno= "No se pudo ingresar el usuario".mysqli_connect_error();
        }finally{
            Desconecta($conexion);
            $stmt ->close();
        }
        return $retorno;
    }

    function ObtenerProveedores2(){
        try {
            $conexion = Conecta();
    
            if (mysqli_set_charset($conexion, "utf8")) {
            $sql = "Select ID_Proveedor, Nombre from Proveedor";
                if (!$result = mysqli_query($conexion, $sql))
                    die();
    
                $retorno = array();
    
                while ($row = mysqli_fetch_array($result)) {
                    $tipo = $row;
    
                    $retorno[] = $tipo;
    
                }
    
            }
    
    
        } catch (\Throwable $th) {
            echo "No se pudo obtener los puestos." . mysqli_connect_error();
        } finally {
            Desconecta($conexion);
        }
    
        return $retorno;
       
    }
    

    function ObtenerProveedores($sql){
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
            echo "No se pudo obtener los proveedores.". mysqli_connect_error();
        }finally{
            Desconecta($conexion);
        }

        return $retorno;
    }

    function ObtenerProveedor($sql){
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
            echo "Ocurrio un error al obtener el proveedor ". mysqli_connect_error();
        }finally{
       Desconecta($conexion);
        }
        return $retorno;
    }

    function actualizarProveedor($nombre, $encargado, $Telefono, $correo, $ID){
        $retorno = "";
        
        try {
            $conexion = Conecta();

            if(mysqli_set_charset($conexion,"utf8")){
                $stmt = $conexion->prepare("update proveedor set Nombre = ?, Encargado = ?, Telefono = ?, Correo = ? WHERE ID_Proveedor = ?");
                $stmt->bind_param("ssisi", $nombre, $encargado, $Telefono, $correo, $ID);                
            
                if($stmt->execute()){
                    $retorno = "Proveedor actualizado con exito";
                }
            }

            return $retorno;
        } catch (\Throwable $th) {
            $retorno= "Error al actualizar el Proveedor ".$th;
        }
        finally{
            Desconecta($conexion);
            $stmt ->close();
        }
        return $retorno;
    }

    function eliminarProveedor($Id){
        $retorno = "";
        
        try {
            $conexion = Conecta();

            if(mysqli_set_charset($conexion,"utf8")){
                $stmt = $conexion->prepare("Delete from proveedor where ID_Proveedor= ?");
                $stmt->bind_Param("i", $Id);
            
                if($stmt->execute()){
                    $retorno = "Proveedor eliminado correctamente";
                }
            }

            return $retorno;
        } catch (\Throwable $th) {
            $retorno= "Error al eliminar el Proveedor. ";
        }
        finally{
            Desconecta($conexion);
            $stmt ->close();
        }
        return $retorno;
    }


?>