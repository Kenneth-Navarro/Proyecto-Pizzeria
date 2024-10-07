<?php
include "../include/templates/header.php";
require_once "../DAL/proveedorDAL.php";
require_once "../include/functions/recoge.php"; ?>

<script type="text/javascript" src="../js/ControllerPago/infoPago.js"></script>


<main class="container">

<ul class="nav margen">
        <li class="nav-item margenNav">
            <a class=" navIndex" aria-current="page" href="../principal.php">Inicio</a>
        </li>
        <li class="nav-item margenNav">
            <a class=" navIndex activo" aria-current="page" href="infoPago.php">Pagos</a>
        </li>
    </ul>


    <table class="tabla table table-striped margen" id="tablaPagos" name="tablaPagos"></table>
</main>


<?php include "../include/templates/footer.php" ?>