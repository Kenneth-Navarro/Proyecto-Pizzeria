<?php include "../include/templates/header.php" ?>

<?php
require_once "../DAL/pedidoDAL.php";
require_once "../include/functions/recoge.php";
?>

<script type="text/javascript" src="../js/ControllerPedido/infoPedido.js"></script>

<main class="container">
    <ul class="nav margen">
        <li class="nav-item" style="margin-right: 2rem;">
            <a class=" navIndex" aria-current="page" href="../principal.php">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="activo navIndex" aria-current="page" href="">Pedidos</a>
        </li>
    </ul>

    <a href="nuevoPedido.php" class="botonNuevo btn btn-success">
        <b>Nuevo Pedido 
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
        </b>
    </a>


    <table class="tabla table table-striped" id="tablaPedidos" name="tablaPedidos"></table>
</main>

<?php include "../include/templates/footer.php" ?>
