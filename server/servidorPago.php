<?php
require_once "../DAL/proveedorDAL.php";
require_once "../include/functions/recoge.php";
require_once "../DAL/pagosDAL.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === "insertar") {
        // Llama a la función "insertarCliente"
        insertarPago();
    } else {
        // Maneja otras acciones o valores de acción no válidos
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] === "devuelvePagos") {
        devuelvePagos();
    }else if(isset($_GET["accion"]) && $_GET["accion"] === "ObtenerPago"){
        verPago();

    }
}


function insertarPago()
{
    $ID_Pedido = recogePost('ID_Pedido');
    $Monto = recogePost('Monto');
    $ID_Metodo = recogePost('Metodo');


    if (IngresoPago($ID_Pedido, $Monto, $ID_Metodo)) {
        echo "Se inserto un pago";
        header("Location: infoPago.php");
    } else {
        echo "Error al insertar un Proveedor"; // Puedes manejar errores de inserción
    }
}


function devuelvePagos()
{
    $sql = "SELECT ID_Pago, ID_Pedido, Monto, ID_Metodo FROM pago";
    $Pagos = ObtenerPagos($sql);
    foreach ($Pagos as &$pago) {
        $sqlPedido = "SELECT ID_Pedido, ID_Cliente, ID_Empleado FROM pedido WHERE ID_Pedido = " . $pago['ID_Pedido'];
        $pedido = ObtenerPago($sqlPedido);
        $sqlCliente = "SELECT Cedula, Nombre, PrimerApellido, SegundoApellido FROM cliente WHERE Cedula = " . $pedido['ID_Cliente'];
        $cliente = ObtenerPago($sqlCliente);
        $sqlMetodo = "SELECT ID_Metodo, Metodo FROM metodo_pago WHERE ID_Metodo = " . $pago['ID_Metodo'];
        $metodo = ObtenerPago($sqlMetodo);
        $pago['Pedido'] = $pedido;
        $pago['Cliente'] = $cliente;
        $pago['MetodoPago'] = $metodo;
    }

    echo json_encode($Pagos, JSON_UNESCAPED_UNICODE);
}


function devuelvePedido()
{
    $sql = "select ID_Pedido, ID_Cliente, ID_Empleado from pedido";
    $Pedido = ObtenerPagos($sql);
    echo json_encode($Pedido, JSON_UNESCAPED_UNICODE);
}

function devuelveCliente()
{
    $sql = "select Cedula, Nombre, PrimerApellido, SegundoApellido from cliente";
    $Cliente = ObtenerPagos($sql);
    echo json_encode($Cliente, JSON_UNESCAPED_UNICODE);


}


function devuelveMetodo()
{
    $sql = "select ID_Metodo, Metodo from metodo_pago";
    $Metodo = ObtenerPagos($sql);
    echo json_encode($Metodo, JSON_UNESCAPED_UNICODE);
}
function verPago(){
    $ID=$_GET['id'];
    $sql = "select ID_Pago, ID_Pedido, Monto, ID_Metodo from pago where ID_Pago = ".$ID;
    $pago = ObtenerPago($sql);

    $sqlPedido = "select ID_Pedido, ID_Cliente, ID_Empleado from pedido where ID_Pedido = ".$pago['ID_Pedido'];
    $pedido = ObtenerPago($sqlPedido);

    $sqlCliente = "select Nombre, PrimerApellido from cliente where Cedula=".$pedido['ID_Cliente'];
    $Cliente = ObtenerPago($sqlCliente);

    $sqlMetodo = "select ID_Metodo, Metodo from metodo_pago where ID_Metodo=".$pago['ID_Metodo'];
    $Metodo = ObtenerPago($sqlMetodo);

    $idPedido = $pago['ID_Pedido'];

    $sql1 = "select p.*, pp.cantidad
             FROM producto p
             INNER JOIN Pedido_Producto pp ON p.ID_Producto = pp.ID_Producto
             INNER JOIN Pedido pd ON pp.ID_Pedido = pd.ID_Pedido
             where pp.ID_Pedido = $idPedido";
    $P_Productos = ObtenerPagos($sql1);

    $todoslosdatos = array(
        'pago' => $pago,
        'pedido' => $pedido,
        'cliente' => $Cliente,
        'metodo' => $Metodo,
        'productos' => $P_Productos
    );



    echo json_encode($todoslosdatos, JSON_UNESCAPED_UNICODE);
}

?>