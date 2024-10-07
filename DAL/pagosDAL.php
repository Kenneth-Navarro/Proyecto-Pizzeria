<?php
    require_once "Conexion.php";

    function IngresoPago( $id_pedido, $monto, $id_metodo){
        $retorno = false;

        try {
            $conexion = Conecta();

            if (mysqli_set_charset($conexion,"utf8")) {
                $stmt = $conexion->prepare("Insert into pago ( ID_Pedido, Monto, ID_Metodo) values (?,?,?)");
                $stmt->bind_Param("idi", $id_pedido, $monto, $id_metodo);

                if($stmt->execute()){
                    $retorno=true;
                }
            }
        } catch (\Throwable $th) {
            echo "error".mysqli_connect_error();
        }finally{
            Desconecta($conexion);
        }
        return $retorno;
    }


    

    function ObtenerPagos($sql){
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

    function ObtenerPago($sql){
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
            return $retorno;
        }
    }

    function actualizarPago($id_pedido, $monto, $id_metodo, $ID){
        $retorno = false;
        
        try {
            $conexion = Conecta();

            if(mysqli_set_charset($conexion,"utf8")){
                $stmt = $conexion->prepare("update proveedor set Nombre = ?, Encargado = ?, Telefono = ?, Correo = ? WHERE ID_Proveedor = ?");
                $stmt->bind_param("idii",$id_pedido, $monto, $id_metodo, $ID);                
            
                if($stmt->execute()){
                    $retorno = true;
                }
            }

            return $retorno;
        } catch (\Throwable $th) {
            echo "Error al actualizar el Proveedor ".$th;
        }
        finally{
            Desconecta($conexion);
        }
    }

    function eliminarPago($Id){
        $retorno = false;
        
        try {
            $conexion = Conecta();

            if(mysqli_set_charset($conexion,"utf8")){
                $stmt = $conexion->prepare("Delete from pago where ID_Pago= ?");
                $stmt->bind_Param("i", $Id);
            
                if($stmt->execute()){
                    $retorno = true;
                }
            }

            return $retorno;
        } catch (\Throwable $th) {
            echo "Error al eliminar al proveedor ".$th;
        }
        finally{
            Desconecta($conexion);
        }
    }


?>