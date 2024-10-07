<?php
require_once "../DAL/productoDAL.php";
require_once "../DAL/proveedorDAL.php";
require_once "../include/functions/recoge.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === "insertar") {
        insertarProducto();
    } else if (isset($_POST['accion']) && $_POST['accion'] === "actualizar") {
        actualizaProducto();
    } else if (isset($_POST['accion']) && $_POST['accion'] === "eliminar") {
        eliminar();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] === "ObtenerProductos") {
        devuelveProductos();
    } else if (isset($_GET["accion"]) && $_GET["accion"] === "ObtenerProducto") {
        devuelveProducto();
    }else if (isset($_GET["accion"]) && $_GET["accion"] === "ObtenerTipos") {
        devuelveTipos();
    }else if (isset($_GET["accion"]) && $_GET["accion"] === "ObtenerProveedores") {
        devuelveProveedores();
    }
    
}

function insertarProducto()
{
    $Nombre = recogePost("Nombre");
    $Descripcion = recogePost("Descripcion");
    $Precio = recogePost("Precio");
    $tipo = recogePost("Tipo");
    $proveedor = recogePost("Proveedor");

    $NombreOK = false;
    $DescripcionOK = false;
    $PrecioOK = false;
    $tipoOK = false;
    



    if ($Nombre == "") {
        print "No se ha ingresado el nombre del Producto";
    } else {
        $NombreOK = true;
    }

    if ($Descripcion == "") {
        print "No se ha ingresado Descripcion del Producto.";
    } else {
        $DescripcionOK = true;
    }

    if ($Precio == "") {
        print "No se ha ingresado el Precio del Producto.";
    } elseif (!is_numeric($Precio)) {
        print "El dato del Precio del Producto no es válido.";
    } else {
        $PrecioOK = true;
    }

    if ($tipo  == "") {
        print "No se ha ingresado la tipo  del Producto.";
    } elseif (!is_numeric($tipo )) {
        print "El dato de la tipo  del Producto no es válido.";
    } else {
        $tipoOK = true;
    }



    if ($NombreOK && $DescripcionOK && $PrecioOK && $tipoOK ) {
        $respuesta = IngresoProductos($Nombre,$Descripcion,$Precio, $tipo,$proveedor);
        if ($respuesta == "No se pudo ingresar el producto") {
            print "No se pudo ingresar el producto.";
        } else {
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }


}



function devuelveProducto(){
    $ID_Producto=recogeGet("id");
    $sql = "Select ID_Producto, Nombre, Descripcion, Precio, ID_Tipo, ID_Proveedor from Producto where ID_Producto= {$ID_Producto}";
    $producto = ObtenerProducto($sql);
    $ID = $producto['ID_Producto'];
    $producto['ID'] = $ID;
    echo json_encode($producto, JSON_UNESCAPED_UNICODE);

}



function devuelveTipos()
{
    $Tipos = ObtenerTipos();
    echo json_encode($Tipos, JSON_UNESCAPED_UNICODE);
}

function devuelveProveedores()
{
    $Proveedores =  ObtenerProveedores2();
    echo json_encode($Proveedores, JSON_UNESCAPED_UNICODE);
}


function devuelveProductos()
{
    $sql = "Select ID_Producto, Nombre, Descripcion, Precio from Producto";
    $Productos = ObtenerProductos($sql);
    echo json_encode($Productos, JSON_UNESCAPED_UNICODE);
}

function actualizaProducto()
{
    
    $Nombre = recogePost("Nombre");
    $Descripcion = recogePost("Descripcion");
    $Precio = recogePost("Precio");
    $tipo = recogePost("Tipo");
    $proveedor = recogePost("Proveedor");
    $ID = recogePost("ID");

    $NombreOK = false;
    $DescripcionOK = false;
    $PrecioOK = false;
    $tipoOK = false;




    if ($Nombre == "") {
        print "No se ha ingresado el nombre del Producto";
    } else {
        $NombreOK = true;
    }

    if ($Descripcion == "") {
        print "No se ha ingresado Descripcion del Producto.";
    } else {
        $DescripcionOK = true;
    }

    if ($Precio == "") {
        print "No se ha ingresado el Precio del Producto.";
    } elseif (!is_numeric($Precio)) {
        print "El dato del Precio del Producto no es válido.";
    } else {
        $PrecioOK = true;
    }

    if ($tipo  == "") {
        print "No se ha ingresado la tipo  del Producto.";
    } elseif (!is_numeric($tipo )) {
        print "El dato de la tipo  del Producto no es válido.";
    } else {
        $tipoOK = true;
    }



    if ($NombreOK && $DescripcionOK && $PrecioOK && $tipoOK) {
        $respuesta = actualizarProducto($Nombre,$Descripcion,$Precio, $tipo,$proveedor, $ID);
        if ($respuesta == "Error al actualizar el producto") {
            print "No se pudo actualizar el producto.";
        } else {
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }


}

function eliminar()
{
    $idEliminar = recogePost("ID");
    $respuesta = eliminarProducto($idEliminar);
    if ($respuesta =="Error al eliminar el Producto") {
        print "No se pudo eliminar el Producto";
    } else {
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }

}


?>