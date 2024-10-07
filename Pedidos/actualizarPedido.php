<?php
include "../include/templates/header.php" ?>

<?php

require_once "../include/functions/recoge.php";

?>
<script type="text/javascript" src="../js/ControllerPedido/actualizaPedido.js"></script>
<script type="text/javascript" src="../js/ControllerPedido/pagarPedido.js"></script>

<?php
$id = $_GET['id'];
?>
<main class="container">
    <ul class="nav margen">
        <li class="nav-item margenNav">
            <a class=" navIndex" aria-current="page" href="../principal.php">Inicio</a>
        </li>
        <li class="nav-item margenNav">
            <a class="navIndex" aria-current="page" href="infoPedido.php">Pedidos</a>
        </li>
        <li class="nav-item">
            <a class="activo navIndex" aria-current="page" href="">Actualizar</a>
        </li>
    </ul>
    <h1 class="margen">Actualizar Pedido</h1>
    <form class="formulario margen">
        <input type="hidden" id="id" name="id" value='<?php echo $id; ?>'>
        <div>
            <label for="ID_Cliente">Cliente:</label>
            <select name="ID_Cliente" id="ID_Cliente" class="campoFormulario form-select">
            </select>
        </div>

        <div>
            <label for="ID_Comida">Comidas:</label>
            <div style="display: flex; align-items: center;" class="campoFormularioPedido">
                <select name="ID_Comida" id="ID_Comida" class="campoFormulario form-select " style="width:400px;">
                    <option value="">Seleccione la comida</option>
                </select>
                <button type="button" class="btn btn-outline-danger m-3" id="agregarComida">+</button>
            </div>
        </div>


        <div>
            <label for="ID_Empleado">Empleado</label>
            <input type="text" name="ID_Empleado" id="ID_Empleado" class="campoFormulario form-control"
                placeholder="Ingrese aquí la Descripcion" aria-label="ID_Empleado" readonly>
        </div>




        <div>
            <label for="ID_Bebida">Bebidas:</label>

            <div style="display: flex; align-items: center;" class="campoFormularioPedido">
                <select style="width:400px;" name="ID_Bebida" id="ID_Bebida" class="campoFormulario form-select ">
                    <option value="">Seleccione la bebida</option>
                </select>
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
        <div name="ID_Estado" id="ID_Estado">
            <label>Estado:</label>
            <br>
        </div>
        <div name="ID_Metodo" id="ID_Metodo" <?php 
        if ($_SESSION['Logueado']['ID_Puesto'] != 2 && $_SESSION['Logueado']['ID_Puesto'] != 3  && $_SESSION['Logueado']['ID_Puesto'] != 4) {
            echo "style='display:none'";
        }
        
        ?>>
            <label>Metodo de pago:</label>
            <br>
        </div>
        <br>

        <div class="botones-container divBotones">
            <button <?php 
        if ($_SESSION['Logueado']['ID_Puesto'] != 2 && $_SESSION['Logueado']['ID_Puesto'] != 3  && $_SESSION['Logueado']['ID_Puesto'] != 4) {
            echo "style='display:none'";
        }
        
        ?> class="btn btn-danger boton" id="pagarPedido" name="pagarPedido">Pagar</button>
            <br>
            <div>
                <a href="infopedido.php" type="button" class="btn btn-secondary boton">Volver</a>
                <button class="btn btn-primary boton" id="guardarPedido" name="guardarPedido">Actualizar</button>
            </div>
    </form>
</main>


<?php include "../include/templates/footer.php" ?>