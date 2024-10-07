<?php
require_once "Conexion.php";

function GuardarPedidoYProductos($ID_Cliente, $ID_Empleado, $productos)
{
    $retorno = "";
    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {

            $FechaHora = date('Y-m-d H:i:s');
            $ID_Estado = 0;
            $query = "INSERT INTO pedido (ID_Cliente, ID_Empleado, ID_Estado, FechaHora) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "iiss", $ID_Cliente, $ID_Empleado, $ID_Estado, $FechaHora);
            mysqli_stmt_execute($stmt);


            $pedidoID = mysqli_insert_id($conexion);


            foreach ($productos as $producto) {
                $query = "INSERT INTO pedido_producto (ID_Pedido, ID_Producto, Cantidad) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conexion, $query);
                mysqli_stmt_bind_param($stmt, "iii", $pedidoID, $producto['id'], $producto['cantidad']);
                mysqli_stmt_execute($stmt);
                $retorno = "Se almaceno el pedido satisfactoriamente.";
            }



        }
    } catch (\Throwable $th) {


        $retorno = "No se pudo ingresar el pedido";

    } finally {
        $stmt->close();
        Desconecta($conexion);
    }

    return $retorno;
}

function ObtenerEstados($sql)
{
    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {

            if (!$result = mysqli_query($conexion, $sql))
                die();

            $retorno = array();

            while ($row = mysqli_fetch_array($result)) {
                $retorno[] = $row;
            }

        }
    } catch (\Throwable $th) {
        echo "No se pudo obtener los pedidos. Error: " . mysqli_error($conexion);

    } finally {
        Desconecta($conexion);
    }

    return $retorno;
}
function ObtenerMetodos($sql)
{
    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {

            if (!$result = mysqli_query($conexion, $sql))
                die();

            $retorno = array();

            while ($row = mysqli_fetch_array($result)) {
                $retorno[] = $row;
            }

        }
    } catch (\Throwable $th) {
        echo "No se pudo obtener los Estados. Error: " . mysqli_error($conexion);

    } finally {
        Desconecta($conexion);
    }

    return $retorno;
}

function ObtenerPedidos($sql)
{
    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {

            if (!$result = mysqli_query($conexion, $sql))
                die();

            $retorno = array();

            while ($row = mysqli_fetch_array($result)) {

                $sqlPago = "SELECT ID_Pago FROM pago WHERE ID_Pedido =" . $row["ID_Pedido"];
                if (!$PagoRetornado = mysqli_query($conexion, $sqlPago)) {
                    die("Error en la consulta del cliente: " . mysqli_error($conexion));
                }

                if ($Pago = mysqli_fetch_array($PagoRetornado)) {
                    $row['Pago'] = true;
                } else {
                    $row['Pago'] = false;
                }


                $retorno[] = $row;
            }

        }


    } catch (\Throwable $th) {
        echo "No se pudo obtener los pedidos. Error: " . mysqli_error($conexion);

    } finally {
        Desconecta($conexion);
    }

    return $retorno;
}

function ObtenerPagos($sql)
{
    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {

            if (!$result = mysqli_query($conexion, $sql))
                die();

            $retorno = array();

            while ($row = mysqli_fetch_array($result)) {
                $retorno[] = $row;
            }

        }


    } catch (\Throwable $th) {
        echo "No se pudo obtener los pagos. Error: ";

    } finally {
        Desconecta($conexion);
    }

    return $retorno;
}


function ObtenerPedido($sql)
{
    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            if (!$result = mysqli_query($conexion, $sql))
                die();

            $retorno = null;

            while ($row = mysqli_fetch_array($result)) {
                $pedido = $row;
                $sqlCliente = "SELECT Nombre, PrimerApellido FROM Cliente WHERE Cedula=" . $row["ID_Cliente"];

                if (!$ClienteRetornado = mysqli_query($conexion, $sqlCliente)) {
                    die("Error en la consulta del cliente: " . mysqli_error($conexion));
                }

                if ($Cliente = mysqli_fetch_array($ClienteRetornado)) {
                    $pedido['Cliente'] = $Cliente['Nombre']." ".$Cliente['PrimerApellido'];
                }

                $sqlEmpleado = "SELECT Nombre, PrimerApellido FROM Empleado WHERE Cedula=" . $row["ID_Empleado"];
                if (!$EmpleadoRetornado = mysqli_query($conexion, $sqlEmpleado)) {
                    die("Error en la consulta del empleado: " . mysqli_error($conexion));
                }

                if ($Empleado = mysqli_fetch_array($EmpleadoRetornado)) {
                    $pedido['Empleado'] = $Empleado['Nombre']." ".$Empleado['PrimerApellido'];
                }

                $sqlEstado = "SELECT tipo FROM Estado WHERE ID_Estado=" . $row["ID_Estado"];
                if (!$EstadoRetornado = mysqli_query($conexion, $sqlEstado)) {
                    die("Error en la consulta del estado: " . mysqli_error($conexion));
                }

                if ($Estado = mysqli_fetch_array($EstadoRetornado)) {
                    $pedido['Estado'] = $Estado['tipo'];
                }

                $idPedido = $row["ID_Pedido"];
                $sqlProductos = "SELECT p.ID_Producto, p.Nombre, pp.Cantidad, p.Precio FROM Producto p
                                     INNER JOIN Pedido_Producto pp ON p.ID_Producto = pp.ID_Producto
                                     WHERE pp.ID_Pedido = $idPedido";

                if (!$ProductosRetornados = mysqli_query($conexion, $sqlProductos)) {
                    die("Error en la consulta de productos: " . mysqli_error($conexion));
                }

                $productos = array();
                while ($producto = mysqli_fetch_array($ProductosRetornados)) {
                    $productos[] = array(
                        'ID_Producto' => $producto['ID_Producto'],
                        'Nombre' => $producto['Nombre'],
                        'Cantidad' => $producto['Cantidad'],
                        'Precio' => $producto['Precio']
                    );
                }

                $pedido['Productos'] = $productos;

                $retorno = $pedido;
            }
        }
    } catch (\Throwable $th) {
        echo "Ocurrió un error al obtener el pedido " . mysqli_connect_error();
    } finally {
        return $retorno;
    }
}
function actualizarPedido($ID_Cliente, $ID_Estado, $productos, $ID_Pedido)
{
    $retorno = "";

    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            // Eliminar todos los registros de pedido_producto asociados al ID_Pedido
            $stmtDelete = $conexion->prepare("DELETE FROM pedido_producto WHERE ID_Pedido = ?");
            $stmtDelete->bind_param("i", $ID_Pedido);
            $stmtDelete->execute();
            $stmtDelete->close();

            // Actualizar los datos del pedido en la tabla pedido
            $stmtUpdate = $conexion->prepare("UPDATE pedido SET ID_Cliente = ?, ID_Estado = ? WHERE ID_Pedido = ?");
            $stmtUpdate->bind_param("iii", $ID_Cliente, $ID_Estado, $ID_Pedido);
            $stmtUpdate->execute();
            $stmtUpdate->close();

            // Insertar los nuevos registros en la tabla pedido_producto
            foreach ($productos as $producto) {
                $queryInsert = "INSERT INTO pedido_producto (ID_Pedido, ID_Producto, Cantidad) VALUES (?, ?, ?)";
                $stmtInsert = mysqli_prepare($conexion, $queryInsert);
                mysqli_stmt_bind_param($stmtInsert, "iii", $ID_Pedido, $producto['id'], $producto['cantidad']);
                mysqli_stmt_execute($stmtInsert);
                mysqli_stmt_close($stmtInsert);

            }

            $retorno = "Se Actualizo con exito el pedido";
        }

        return $retorno;
    } catch (\Throwable $th) {
        $retorno = "Error al actualizar el pedido";
    } finally {
        Desconecta($conexion);
    }
}
function pagarPedido($ID_Cliente, $ID_Estado, $productos, $ID_Pedido, $Total, $ID_Metodo)
{
    $retorno = "";

    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            // Eliminar todos los registros de pedido_producto asociados al ID_Pedido
            $stmtDelete = $conexion->prepare("DELETE FROM pedido_producto WHERE ID_Pedido = ?");
            $stmtDelete->bind_param("i", $ID_Pedido);
            $stmtDelete->execute();
            $stmtDelete->close();

            // Actualizar los datos del pedido en la tabla pedido
            $stmtUpdate = $conexion->prepare("UPDATE pedido SET ID_Cliente = ?, ID_Estado = ? WHERE ID_Pedido = ?");
            $stmtUpdate->bind_param("iii", $ID_Cliente, $ID_Estado, $ID_Pedido);
            $stmtUpdate->execute();
            $stmtUpdate->close();

            $stmtpago = $conexion->prepare("Insert into pago ( ID_Pedido, Monto, ID_Metodo) values (?,?,?)");
            $stmtpago->bind_Param("iii", $ID_Pedido, $Total, $ID_Metodo);
            $stmtpago->execute();
            $stmtpago->close();

            // Insertar los nuevos registros en la tabla pedido_producto
            foreach ($productos as $producto) {
                $queryInsert = "INSERT INTO pedido_producto (ID_Pedido, ID_Producto, Cantidad) VALUES (?, ?, ?)";
                $stmtInsert = mysqli_prepare($conexion, $queryInsert);
                mysqli_stmt_bind_param($stmtInsert, "iii", $ID_Pedido, $producto['id'], $producto['cantidad']);
                mysqli_stmt_execute($stmtInsert);
                mysqli_stmt_close($stmtInsert);

            }

            $retorno = "Se realizo el pago con exito";
        }

        return $retorno;
    } catch (\Throwable $th) {
        $retorno = "Error al actualizar el pedido";
    } finally {
        Desconecta($conexion);
    }
}




function Obtenerpago($sql)
{
    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            if (!$result = mysqli_query($conexion, $sql))
                die();

            $retorno = null;

            while ($row = mysqli_fetch_array($result)) {
                $retorno = $row;
            }

        }
    } catch (\Throwable $th) {
        echo "Ocurrio un error al obtener el pago " . mysqli_connect_error();
    } finally {
        return $retorno;
    }
}

function eliminarPedido($Id_Pedido)
{
    $retorno = "";

    try {
        $conexion = Conecta();

        if (mysqli_set_charset($conexion, "utf8")) {
            $pago = null;
            $sql = "Select ID_Pago from pago where ID_Pedido = " . $Id_Pedido;
            if (mysqli_set_charset($conexion, "utf8")) {
                if (!$result = mysqli_query($conexion, $sql))
                    die();



                while ($row = mysqli_fetch_array($result)) {
                    $pago = $row;
                }

            }

            if (!$pago) {
                $stmt1 = $conexion->prepare("DELETE FROM pedido_producto WHERE ID_Pedido = ?");
                $stmt1->bind_param("i", $Id_Pedido);
    
                if ($stmt1->execute()) {
                    $stmt2 = $conexion->prepare("DELETE FROM Pedido WHERE ID_Pedido = ?");
                    $stmt2->bind_param("i", $Id_Pedido);
    
                    if ($stmt2->execute()) {
                        mysqli_commit($conexion);
                        $retorno = "Pedido eliminado correctamente.";
                    }
                }
            }else{
                $retorno = "Error al eliminar el Pedido";
            }

           
        }
    } catch (\Throwable $th) {
        $retorno = "Error al eliminar el Pedido";
    } finally {
        Desconecta($conexion);
    }

    return $retorno;
}








