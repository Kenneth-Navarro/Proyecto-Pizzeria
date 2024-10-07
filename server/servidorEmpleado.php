<?php
require_once "../DAL/empleadoDAL.php";
require_once "../include/functions/recoge.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === "insertar") {
        insertarEmpleado();
    } else if (isset($_POST['accion']) && $_POST['accion'] === "actualizar") {
        actualizaEmpleado();
    }else if (isset($_POST['accion']) && $_POST['accion'] === "eliminar"){
        eliminar();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['accion']) && $_GET['accion'] === "ObtenerEmpleados") {
        devuelveEmpleados();
    }
    else if (isset($_GET['accion']) && $_GET['accion'] === "ObtenerPuestos") {
        devuelvePuestos();
    } else if (isset($_GET["accion"]) && $_GET["accion"] === "ObtenerEmpleado") {
        devuelveEmpleado();
    }
}


function insertarEmpleado()
{
    $cedula = recogePost("Cedula");
    $nombre = recogePost("nombre");
    $prApellido = recogePost("PrimerApellido");
    $seApellido = recogePost("SegundoApellido");
    $edad = recogePost("Edad");
    $puesto = recogePost("Puesto");
    $salario = recogePost("Salario");
    $fechaContratacion = recogePost("Fecha");
    $direccion = recogePost("Direccion");
    $telefono = recogePost("Telefono");
    $correo = recogePost("Correo");

    $cedulaOK = false;
    $nombreOK = false;
    $prApellidoOK = false;
    $seApellidoOK = false;
    $edadOK = false;
    $salarioOK = false;
    $fechaContratacionOK = false;
    $puestoOK = false;
    $direccionOK = false;
    $telefonoOK = false;
    $correoOK = false;


    if ($cedula == "") {
        print "No se ha ingresado la cédula del Empleado.";
    } elseif (!is_numeric($cedula)) {
        print "El dato de la cédula del Empleado no es válido.";
    } elseif(strlen($cedula) != 9){
        print "La cédula no es válida. La cedula debe contener 9 números.";
    }else {
        $cedulaOK = true;
    }


    if ($nombre == "") {
        print "No se ha ingresado el nombre del Empleado.";
    } else {
        $nombreOK = true;
    }

    if ($prApellido == "") {
        print "No se ha ingresado el primer apellido del Empleado.";
    } else {
        $prApellidoOK = true;
    }

    if ($seApellido == "") {
        print "No se ha ingresado el segundo apellido del Empleado.";

    } else {
        $seApellidoOK = true;
    }

    if ($edad == "") {
        print "No se ha ingresado la edad del Empleado.";

    } elseif(!is_numeric($edad)) {
        print "El dato de la edad del Empleado no es válido.";
    }elseif($edad < 18){
        print "La persona es menor de edad. No se puede ingresar este Empleado.";
    }else {
        $edadOK = true;
    }


    if ($salario == "") {
        print "No se ha ingresado el alario del Empleado.";

    } elseif(!is_numeric($salario)) {
        print "El dato de la salario del Empleado no válido.";
    }else {
        $salarioOK = true;
    }

    if ($fechaContratacion == "") {
        print "No se ha ingresado la fecha de contratación del Empleado.";

    } else {
        $fechaContratacionOK = true;
    }

    if ($puesto == "") {
        print "No se ha ingresado el puesto del Empleado.";
    } elseif(!is_numeric($puesto)) {
        print "El dato del puesto del Empleado no es válido.";
    }else {
        $puestoOK = true;
    }
    
    

    if ($direccion == "") {
        print "No se ha ingresado la dirección del Empleado.";
    } else {
        $direccionOK = true;
    }

    if ($telefono == "") {
        print "No se ha ingresado el télefono del Empleado.";
    } elseif (!is_numeric($telefono)) {
        print "El dato del télefono del Empleado no es válido.";
    } elseif(strlen(strlen($telefono) != 8)){
        print "El telefono no es válido. Debe tener 8 números.";
    }else {
        $telefonoOK = true;
    }

    if ($correo == "") {
        print "No se ha ingresado el correo del Empleado.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        print "No se ha ingresado un correo válido del Empleado.";
    } else {
        $correoOK = true;
    }


    if ($cedulaOK && $nombreOK && $prApellidoOK && $seApellidoOK && $edadOK && $salarioOK && $fechaContratacionOK && $puestoOK && $direccionOK && $telefonoOK && $correoOK) {
        $respuesta = IngresoEmpleados($cedula, $nombre, $prApellido, $seApellido, $edad, $puesto, $salario, $fechaContratacion, $direccion, $telefono, $correo);
        if ($respuesta == "No se pudo ingresar el empleado ") {
            print "No se pudo actualizar el Cliente.";
        } else {
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }

    
}


function devuelveEmpleado()
{
    $ID = recogeGet("id");
    $sql = "Select Cedula, Nombre, PrimerApellido, SegundoApellido, Edad, ID_Puesto, Salario, FechaContratacion, Direccion, Telefono, Correo  from empleado where Cedula = {$ID}";
    $empleado = ObtenerEmpleado($sql);
    $empleado['ID'] =$ID;


    if ($empleado) {
        echo json_encode($empleado);
    } else {
        echo json_encode(array("error" => "Empleado no encontrado"));
    }
}

function devuelveEmpleados()
{
    $sql = "Select Cedula, Nombre, PrimerApellido, SegundoApellido from empleado";
    $empleado = ObtenerEmpleados($sql);
    
    echo json_encode($empleado, JSON_UNESCAPED_UNICODE);
}

function devuelvePuestos(){
    $puestos = obtenerPuestos();

    echo json_encode($puestos, JSON_UNESCAPED_UNICODE);
}


function actualizaEmpleado()
{
    $ID = recogePost("ID");
    $cedula = recogePost("Cedula"); 
    $nombre = recogePost("Nombre");  
    $prApellido = recogePost("PrimerApellido");  
    $seApellido = recogePost("SegundoApellido"); 
    $edad = recogePost("Edad");  
    $puesto = recogePost("Puesto");   
    $salario = recogePost("Salario");  
    $fechaContratacion = recogePost("FechaContratacion"); 
    $direccion = recogePost("Direccion"); 
    $telefono = recogePost("Telefono"); 
    $correo = recogePost("Correo"); 


    $cedulaOK = false;
    $nombreOK = false;
    $prApellidoOK = false;
    $seApellidoOK = false;
    $edadOK = false;
    $puestoOK = false;
    $salarioOK = false;
    $fechaContratacionOK = false;
    $direccionOK = false;
    $telefonoOK = false;
    $correoOK = false;


    if ($cedula == "") {
        print "No se ha ingresado la cédula del Empleado.";
    } elseif (!is_numeric($cedula)) {
        print "El dato de la cédula del Empleado no es válido.";
    } elseif(strlen($cedula) != 9){
        print "La cédula no es válida. La cedula debe contener 9 números.";
    }else {
        $cedulaOK = true;
    }


    if ($nombre == "") {
        print "No se ha ingresado el nombre del Empleado.";
    } else {
        $nombreOK = true;
    }

    if ($prApellido == "") {
        print "No se ha ingresado el primer apellido del Empleado.";
    } else {
        $prApellidoOK = true;
    }

    if ($seApellido == "") {
        print "No se ha ingresado el segundo apellido del Empleado.";

    } else {
        $seApellidoOK = true;
    }

    if ($edad == "") {
        print "No se ha ingresado la edad del Empleado.";

    } elseif(!is_numeric($edad)) {
        print "El dato de la edad del Empleado no es válido.";
    }elseif($edad < 18){
        print "La persona es menor de edad. No se puede ingresar este Empleado.";
    } else {
        $edadOK = true;
    }


    if ($salario == "") {
        print "No se ha ingresado el alario del Empleado.";

    } elseif(!is_numeric($salario)) {
        print "El dato de la salario del Empleado no válido.";
    }else {
        $salarioOK = true;
    }

    if ($fechaContratacion == "") {
        print "No se ha ingresado la fecha de contratación del Empleado.";

    } else {
        $fechaContratacionOK = true;
    }

    if ($puesto == "") {
        print "No se ha ingresado el puesto del Empleado.";
    } elseif(!is_numeric($puesto)) {
        print "El dato del puesto del Empleado no es válido.";
    }else {
        $puestoOK = true;
    }
    
    if ($direccion == "") {
        print "No se ha ingresado la dirección del Empleado.";
    } else {
        $direccionOK = true;
    }

    if ($telefono == "") {
        print "No se ha ingresado el télefono del Empleado.";
    } elseif (!is_numeric($telefono)) {
        print "El dato del télefono del Empleado no es válido.";
    } elseif(strlen(strlen($telefono) != 8)){
        print "El telefono no es válido. Debe tener 8 números.";
    }else {
        $telefonoOK = true;
    }

    if ($correo == "") {
        print "No se ha ingresado el correo del Empleado.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        print "No se ha ingresado un correo válido del Empleado.";
    } else {
        $correoOK = true;
    }


    if ($cedulaOK && $nombreOK && $prApellidoOK && $seApellidoOK && $edadOK && $salarioOK && $fechaContratacionOK && $puestoOK && $direccionOK && $telefonoOK && $correoOK) {
        $respuesta = actualizaREmpleado($cedula, $nombre, $prApellido, $seApellido, $edad, $puesto, $salario, $fechaContratacion, $direccion, $telefono, $correo, $ID);
        if ($respuesta == "No se pudo actualizar el Empleado") {
            print "No se pudo actualizar el Empleado.";
        } else {
            echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        }
    }


    
}


function eliminar(){
    $idEliminar = recogePost("ID");
    $respuesta = eliminarEmpleado($idEliminar);
    
    if ($respuesta == "Error al eliminar el empleado"){
        print "No se pudo eliminar el Empleado.";
    }else{
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    }
}   

?>

