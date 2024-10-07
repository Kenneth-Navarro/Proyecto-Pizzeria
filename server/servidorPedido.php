<?php
require_once "../DAL/productoDAL.php";
require_once "../DAL/pedidoDAL.php";
require_once "../include/functions/recoge.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === "insertar") {
        insertarPedido();
    } else if (isset($_POST['accion']) && $_POST['accion'] === "actualizar") {
        actualizaPedido();
    } else if (isset($_POST['accion']) && $_POST['accion'] === "pagar") {
        pagarPedidos();
    } else if (isset($_POST['accion']) && $_POST['accion'] === "eliminar") {
        eliminar();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] === "ObtenerPedidos") {
        devuelvePedidos();
    } else if (isset($_GET["accion"]) && $_GET["accion"] === "ObtenerPedido") {
        devuelvePedido();
    } else if (isset($_GET["accion"]) && $_GET["accion"] === "ObtenerComidas") {
        devuelveComidas();
    } else if (isset($_GET["accion"]) && $_GET["accion"] === "ObtenerBebidas") {
        devuelveBebidas();
    } else if (isset($_GET["accion"]) && $_GET["accion"] === "ObtenerEstados") {
        devuelveEstados();
    } else if (isset($_GET["accion"]) && $_GET["accion"] === "ObtenerMetodos") {
        devuelveMetodos();
    } 

}




function insertarPedido()
{

    $ID_Cliente = recogePost("ID_Cliente");
    $ID_Empleado = recogePost("ID_Empleado");
    $Productos = recogePost("Productos");
    $ID_ClienteOK = false;
    $ID_EmpleadoOK = false;

    if ($ID_Cliente == "") {
        print "No se ha ingresado el ID del Cliente.";
    } elseif (!is_numeric($ID_Cliente)) {
        print "el ID del Cliente no es válido.";
    } else {
        $ID_ClienteOK = true;
    }
    if ($ID_Empleado == "") {
        print "No se ha ingresado el id del empleado.";
    } elseif (!is_numeric($ID_Empleado)) {
        print "el ID del empleado no es válido.";
    } else {
        $ID_EmpleadoOK = true;
    }

    if ($ID_ClienteOK && $ID_EmpleadoOK) {
        $respuesta = GuardarPedidoYProductos($ID_Cliente,$ID_Empleado,$Productos);
        if ($respuesta == "No se pudo ingresar el pedido") {
            print "No se pudo ingresar el Pedido.";
        } else {
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }


}

function devuelvePedido()
{
    $ID_Pedido = recogeGet("id");
    $sql = "SELECT 
    ID_Pedido, 
    ID_Cliente, 
    ID_Empleado, 
    DATE(FechaHora) AS Fecha,
    TIME(FechaHora) AS Hora,
    ID_Estado 
    FROM Pedido 
    WHERE ID_Pedido = {$ID_Pedido};
";
    $pedido = ObtenerPedido($sql);
    $ID = $pedido['ID_Pedido'];
    $pedido['ID'] = $ID;
    echo json_encode($pedido, JSON_UNESCAPED_UNICODE);

}

function devuelvePago()
{
    $ID_Pedido = recogeGet("id");
    $sql = "SELECT ID_Pago FROM pago WHERE ID_Pedido = {$ID_Pedido}";
    $pago = Obtenerpago($sql);

    if ($pago === null || empty($pago)) {
        echo json_encode(array("error" => true), JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode(array("error" => false, "pago" => $pago), JSON_UNESCAPED_UNICODE);
    }
}


function devuelveProveedores()
{
    $Proveedores = ObtenerProveedores2();
    echo json_encode($Proveedores, JSON_UNESCAPED_UNICODE);
}


function devuelveComidas()
{
    $sql = "SELECT ID_Producto, Nombre, Descripcion, Precio
    FROM Producto
    WHERE ID_Tipo = (
        SELECT ID_Tipo
        FROM Tipo
        WHERE Nombre = 'Comida'
    );";
    $Comidas = ObtenerProductos($sql);
    echo json_encode($Comidas, JSON_UNESCAPED_UNICODE);
}


function devuelveBebidas()
{
    $sql = "SELECT ID_Producto, Nombre, Descripcion, Precio
    FROM Producto
    WHERE ID_Tipo = (
        SELECT ID_Tipo
        FROM Tipo
        WHERE Nombre = 'Bebida'
    );";
    $Comidas = ObtenerProductos($sql);
    echo json_encode($Comidas, JSON_UNESCAPED_UNICODE);
}


function devuelveEstados()
{
    $sql = "SELECT ID_Estado, tipo from estado";
    $Estados = ObtenerEstados($sql);
    echo json_encode($Estados, JSON_UNESCAPED_UNICODE);
}

function devuelveMetodos()
{
    $sql = "SELECT ID_Metodo, Metodo from metodo_pago";
    $Metodos = ObtenerEstados($sql);
    echo json_encode($Metodos, JSON_UNESCAPED_UNICODE);
}
function devuelvePedidos()
{
    $sql = "SELECT 
    P.ID_Pedido, 
    DATE(P.FechaHora) AS Fecha,
    DATE_FORMAT(P.FechaHora, '%H:%i') AS Hora, 
    P.ID_Estado, 
    E.tipo
FROM 
    Pedido P
JOIN 
    Estado E ON P.ID_Estado = E.ID_Estado
ORDER BY P.ID_Pedido DESC";
$Pedidos = ObtenerPedidos($sql);
echo json_encode($Pedidos, JSON_UNESCAPED_UNICODE);
}

function actualizaPedido()
{

    $ID_Cliente = recogePost("ID_Cliente");
    $ID_Estado = recogePost("ID_Estado");
    $Productos = recogePost("Productos");
    $ID_Pedido = recogePost("ID_Pedido");
    $ID_ClienteOK = false;
    $ID_EstadoOK = false;
    $IDOK = false;

    if ($ID_Cliente == "") {
        print "No se ha ingresado el ID del Cliente.";
    } elseif (!is_numeric($ID_Cliente)) {
        print "el ID del Cliente no es válido.";
    } else {
        $ID_ClienteOK = true;
    }
    if ($ID_Estado == "") {
        print "No se ha ingresado el id del estado.";
    } elseif (!is_numeric($ID_Estado)) {
        print "el id del estado no es válido.";
    } else {
        $ID_EstadoOK = true;
    }
    if ($ID_Pedido == "") {
        print "No se ha ingresado el id del Pedido.";
    } elseif (!is_numeric($ID_Pedido)) {
        print "el id del Pedido no es válido.";
    } else {
        $IDOK = true;
    }

//validar los productos
    if ($ID_ClienteOK ) {
        $respuesta = actualizarPedido($ID_Cliente,$ID_Estado, $Productos,$ID_Pedido);
        if ($respuesta == "Error al actualizar el pedido") {
            print "No se pudo actualizar el pedido.";
        } else {
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }


}


function pagarPedidos()
{

    $ID_Cliente = recogePost("ID_Cliente");
    $ID_Estado = 2;
    $Productos = recogePost("Productos");
    $ID_Pedido = recogePost("ID_Pedido");
    $ID_Metodo = recogePost("ID_Metodo");

    $ID_ClienteOK = false;
    $ID_EstadoOK = false;
    $IDOK = false;
    $ID_MetodoOK = false;
    $PagosOK = false;

    if ($ID_Cliente == "") {
        print "No se ha ingresado el ID del Cliente.";
    } elseif (!is_numeric($ID_Cliente)) {
        print "el ID del Cliente no es válido.";
    } else {
        $ID_ClienteOK = true;
    }
    if ($ID_Estado == "") {
        print "No se ha ingresado el id del estado.";
    } elseif (!is_numeric($ID_Estado)) {
        print "el id del estado no es válido.";
    } else {
        $ID_EstadoOK = true;
    }
    if ($ID_Pedido == "") {
        print "No se ha ingresado el id del Pedido.";
    } elseif (!is_numeric($ID_Pedido)) {
        print "el id del Pedido no es válido.";
    } else {
        $IDOK = true;
    }
    if ($ID_Metodo == "") {
        print "No se ha ingresado el metodo de pago.";
    } elseif (!is_numeric($ID_Metodo)) {
        print "el id del metodo de pago no es válido.";
    } else {
        $ID_MetodoOK = true;
    }

    $sql = "SELECT ID_Pago, ID_Pedido, Monto, ID_Metodo FROM pago";
    $Pagos = ObtenerPagos($sql);

    if (empty($Pagos)) {
        $PagosOK = true;
    } else {
        foreach ($Pagos as $pago) {
            if ($pago['ID_Pedido'] == $ID_Pedido) {
                print("El pago ya se realizó");
                $PagosOK = false;
                break; // Puedes salir del bucle porque ya encontraste un pago con el mismo ID_Pedido
            } else {
                $PagosOK = true;
            }
        }
    }
    if (is_array($Productos)) {
        $total = 0;
        $numeroDeProductos = count($Productos);
        for ($i = 0; $i < $numeroDeProductos; $i++) {
            $cantidad = $Productos[$i]['cantidad'];
            $total += $Productos[$i]['precio'] * $cantidad;
        }
    } else {

        echo "Error: La decodificación JSON falló.";
    }

    if ($ID_ClienteOK && $ID_EstadoOK && $IDOK && $ID_MetodoOK && $PagosOK) {
        $respuesta = pagarPedido($ID_Cliente, $ID_Estado, $Productos, $ID_Pedido, $total, $ID_Metodo);
        if ($respuesta == "Error al pagar el pedido") {
            print "No se pudo pagar el pedido.";
        } else {
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }

}

function eliminar()
{
    $idEliminar = recogePost("ID");
    $respuesta = eliminarPedido($idEliminar);
    if ($respuesta == "Error al eliminar el Pedido") {
        print "No se pudo eliminar el Pedido";
    } else {
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

}


?>