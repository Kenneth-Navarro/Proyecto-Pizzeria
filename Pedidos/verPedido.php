<?php include "../include/templates/header.php" ?>


<?php
require_once "../DAL/pedidoDAL.php";
require_once "../DAL/clienteDAL.php";
require_once "../DAL/productoDAL.php";
?>
<script type="text/javascript" src="../js/ControllerPedido/verPedido.js"></script>
<?php
    $id = $_GET['id'];
?>


<main class="container">
    <h1>Información del Pedido</h1>
    <div class="formulario">
            <input type="hidden" id="id" name="id" value='<?php echo$id;?>'>
            <div class="">
                <label for="ID_Cliente:">Cliente</label>
                <input type="text" name="ID_Cliente" id="ID_Cliente" class="campoFormulario form-control"
                    placeholder="Ingrese aquí el nombre" aria-label="ID_Cliente" readonly>
            </div>

            <div class="">
                <label for="ID_Empleado">Empleado</label>
                <input type="text" name="ID_Empleado" id="ID_Empleado" class="campoFormulario form-control"
                    placeholder="Ingrese aquí la Descripcion" aria-label="ID_Empleado" readonly>
            </div>
            <div class=" ">
                <label for="Fecha">Fecha</label>
                <input type="text" name="Fecha" id="Fecha" class="campoFormulario form-control"
                    placeholder="Ingrese aquí el Fecha" aria-label="Fecha" readonly>
            </div>


            <div class=" ">
                <label for="Hora">Hora</label>
                <input type="text" name="Hora" id="Hora" class="campoFormulario form-control"
                            aria-label="Hora" readonly>
            </div>
            <div class="">
                <label for="ID_Estado">Estado</label>
                <input type="text" name="ID_Estado" id="ID_Estado" class="campoFormulario form-control"
                     aria-label="ID_Estado" readonly>

            </div>

            <div class="fila-unica">   
            <br>
            <div>
                <table class="tabla table table-striped tabla-centrada" id="tablaProductosPedido" name="tablaProductosPedido">
                
                </table>
            </div>
            
             </div>



            <a href="infoPedido.php" class="btn btn-secondary boton">Volver</a>

   



</main>
</main>

<?php include "../include/templates/footer.php" ?>