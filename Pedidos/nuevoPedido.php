<?php 
include "../include/templates/header.php" ?>

<?php

require_once "../include/functions/recoge.php";

?>
<script type="text/javascript" src="../js/ControllerPedido/nuevoPedido.js"></script>
<main class="container">
<ul class="nav margen">
        <li class="nav-item margenNav">
            <a class=" navIndex" aria-current="page" href="../principal.php">Inicio</a>
        </li>
        <li class="nav-item margenNav">
            <a class="navIndex" aria-current="page" href="infoPedido.php">Pedidos</a>
        </li>
        <li class="nav-item">
            <a class="activo navIndex" aria-current="page" href="">Nuevo Pedido</a>
        </li>
    </ul>
    <h1 class="margen">Agregar Pedido</h1>
    <form class="formulario margen"method="post">
        <div>
            <label for="ID_Cliente">Cliente:</label>
            <select name="ID_Cliente" id="ID_Cliente" class="campoFormulario form-select ">
            </select>
        </div>

        <div>
        <label for="ID_Comida">Comidas:</label>
        <div style="display: flex; align-items: center;"  class="campoFormularioPedido">
            <select name="ID_Comida" id="ID_Comida" class="campoFormulario form-select " ></select>
            <button type="button" class="btn btn-outline-danger m-3" id="agregarComida">+</button>
        </div>
        </div>

        <div>
            <label for="ID_Empleado">Empleado:</label>
            <input type="hidden" name="ID_Empleado" id="ID_Empleado" value="<?php echo $_SESSION['Logueado']['Id_Empleado']; ?>">
            <input type="text" name="NombreEmpleado" id="NombreEmpleado" class="campoFormulario form-control"
                value="<?php echo $_SESSION['Logueado']['NombreEmpleado'] . " " . $_SESSION['Logueado']['PrimerApellidoEmpleado']; ?>" aria-label="NombreEmpleado" readonly>
        </div>



        <div>
            <label for="ID_Bebida">Bebidas:</label>
            <div style="display: flex; align-items: center;"  class="campoFormularioPedido">
                <select  name="ID_Bebida" id="ID_Bebida" class="campoFormulario form-select "></select>
                <button type="button" id="agregarBebida" class="btn btn-outline-danger m-3">+</button>
            </div>
        </div>

        <div class="fila-unica">   
        <table id="tablaProductos" class="tabla table table-striped tabla-centrada"> 
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        </div>

        <br/><br/><br/>
        <div>
        <a href="infopedido.php" type="button" class="btn btn-secondary boton">Volver</a>
        <button class="btn btn-success boton" id="guardarPedido" name="guardarPedido" disabled>Guardar</button>
        </div>
    </form>
</main>

<?php include "../include/templates/footer.php" ?>