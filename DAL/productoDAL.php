<?php
    require_once "Conexion.php";

    function IngresoProductos( $nombre, $descripcion,$precio, $ID_Tipo , $ID_Proveedor ){
        $retorno = false;
        if ($ID_Proveedor == "") {
            $ID_Proveedor=null;
        } 
        
        try {
            $conexion = Conecta();

            if (mysqli_set_charset($conexion,"utf8")) {
                $stmt = $conexion->prepare("Insert into producto (Nombre, Descripcion , Precio, ID_Tipo, ID_Proveedor) values (?,?,?,?,?)");
                $stmt->bind_Param("ssdii", $nombre,$descripcion, $precio, $ID_Tipo , $ID_Proveedor );

                if($stmt->execute()){
                    $retorno="Se almaceno el el producto satisfactoriamente";
                }
            }


        } catch (\Throwable $th) {
            $retorno = "No se pudo ingresar el producto". mysqli_connect_error();
        }finally{
            Desconecta($conexion);
        }

        return $retorno;
        
    }

    function ObtenerProductos($sql){
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
            echo "No se pudo obtener los productos.". mysqli_connect_error();
        }finally{
            Desconecta($conexion);
        }

        return $retorno;
    }

    function ObtenerProducto($sql){
        try {
            $conexion = Conecta();

            if(mysqli_set_charset($conexion,"utf8")){
                if(!$result = mysqli_query($conexion, $sql)) die();

                $retorno = null;

                while($row = mysqli_fetch_array($result)){
                    $producto = $row;
                    $sqlTipo = "select Nombre from Tipo where ID_Tipo= " . $row["ID_Tipo"];
                    
                    if (!$tipoRetornado = mysqli_query($conexion, $sqlTipo))
                        die();
    
                    if ($tipo = mysqli_fetch_array($tipoRetornado)) {
                        $producto['tipo'] = $tipo['Nombre'];
                    }
                     if ($row["ID_Proveedor"] != "") {
                        $sqlProveedor = "select Nombre from Proveedor where ID_Proveedor= " . $row["ID_Proveedor"];
                        if (!$proveedorRetornado = mysqli_query($conexion, $sqlProveedor))
                            die();

                        if ($proveedor = mysqli_fetch_array($proveedorRetornado)) {
                            $producto['proveedor'] = $proveedor['Nombre'];
                        }
                     }else{
                        $producto['proveedor'] = null;
                     }

                    $retorno = $producto;
                }

            }
        } catch (\Throwable $th) {
            echo "Ocurrio un error al obtener el producto ". mysqli_connect_error();
        }finally{
            return $retorno;
        }
    }

    function ObtenerProducto2($sql){
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
            echo "Ocurrio un error al obtener el producto ". mysqli_connect_error();
        }finally{
            return $retorno;
        }
    }

    function actualizarProducto($nombre, $descripcion,$precio, $ID_Tipo , $ID_Proveedor,$id_producto){
        $retorno = false;
        if ($ID_Proveedor == "") {
            $ID_Proveedor=null;
        } 
        
        try {
            $conexion = Conecta();

            if(mysqli_set_charset($conexion,"utf8")){
                $stmt = $conexion->prepare("Update Producto set Nombre = ?,Descripcion = ?, Precio = ?, ID_tipo= ?, ID_Proveedor = ? where ID_Producto = ?");
                $stmt->bind_Param("ssdiii", $nombre,$descripcion, $precio, $ID_Tipo , $ID_Proveedor, $id_producto);
            
                if($stmt->execute()){
                    $retorno = "Producto actualizado con exito";
                }
            }

            return $retorno;
        } catch (\Throwable $th) {
            $retorno = "Error al actualizar el producto";
        }
        finally{
            Desconecta($conexion);
        }
    }
    
    function eliminarProducto($Id){
        $retorno = "";
        
        try {
            $conexion = Conecta();

            if(mysqli_set_charset($conexion,"utf8")){
                $stmt = $conexion->prepare("Delete from producto where ID_Producto = ?");
                $stmt->bind_Param("i", $Id);
            
                if($stmt->execute()){
                    $retorno = "Producto eliminado correctamente.";
                }
            }

            return $retorno;
        } catch (\Throwable $th) {
            $retorno = "Error al eliminar el Producto";
        }
        finally{
            $stmt ->close();
            Desconecta($conexion);
        }

        return $retorno;
    }



    function ObtenerTipos(){
        try {
            $conexion = Conecta();
    
            if (mysqli_set_charset($conexion, "utf8")) {
            $sql = "Select ID_Tipo, Nombre from Tipo";
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

    

    function ObtenerTipo($sql){
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
            echo "Ocurrio un error al obtener el tipo ". mysqli_connect_error();
        }finally{
            return $retorno;
        }
    }

    
    function ObtenerProductoPorCodigo($codigo) {
        try {
            $conexion = Conecta();
    
            if (mysqli_set_charset($conexion, "utf8")) {
                $sql = "SELECT codigo, detalle, imagen, nombre, precio FROM productos WHERE codigo = $codigo";
    
                if ($result = mysqli_query($conexion, $sql)) {
                    $retorno = null;
    
                    if (mysqli_num_rows($result) > 0) {
                        $retorno = mysqli_fetch_assoc($result);
                    }
                    
                    mysqli_free_result($result);
                } else {
                    echo "Error en la consulta: " . mysqli_error($conexion);
                }
            } else {
                echo "Error al configurar el juego de caracteres: " . mysqli_error($conexion);
            }
        } catch (\Throwable $th) {
            echo "Ocurrió un error al obtener el producto: " . mysqli_connect_error();
        } finally {
            Desconecta($conexion);
        }
    
        return $retorno;
    }


?>

