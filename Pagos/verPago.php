<?php include "../include/templates/header.php";
require_once "../include/functions/recoge.php";
require_once "../DAL/pagosDAL.php";


?>
<?php
$id = $_GET['id'];
?>
<script type="text/javascript" src="../js/ControllerPago/verPago.js"></script>
<main class="container">
    <ul class="nav margen">
        <li class="nav-item margenNav">
            <a class=" navIndex" aria-current="page" href="../principal.php">Inicio</a>
        </li>
        <li class="nav-item margenNav">
            <a class=" navIndex" aria-current="page" href="infoPagos.php">Pagos</a>
        </li>
        <li class="nav-item">
            <a class="activo navIndex" aria-current="page" href="">Ver</a>
        </li>
    </ul>
    <h1 class="margen">Información del Pago </h1>

    
    <div class="formulario">
        <input type="hidden" id="id" name="id" value='<?php echo $id; ?>'>
        <div>
            <label for="Nombre">Cliente</label>
            <input type="text" name="Nombre" id="Nombre" class="campoFormulario form-control" aria-label="Nombre"
                readonly>
        </div>



    </div>

    <table class="tabla table table-striped tabla-centrada mt-5 mb-5" id="tablaProductos"> </table>
    <div class="formulario">


        <div>
            <label for="Metodo">Metodo de pago</label>
            <input type="text" name="Metodo" id="Metodo" class="campoFormulario form-control" aria-label="Metodo"
                readonly>
        </div>


        <div>
            <label for="Monto">Monto total</label>
            <input type="text" name="Monto" id="Monto" class="campoFormulario form-control" aria-label="Monto" readonly>
        </div>

        <br>
        
        <div style="grid-column-end: 3;">
            <a href="infoPago.php" class="btn btn-secondary boton">Volver</a>
        </div>

    </div>


</main>

<?php include "../include/templates/footer.php" ?>