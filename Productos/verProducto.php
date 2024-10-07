<?php include "../include/templates/header.php" ?>


<?php

?>
<script type="text/javascript" src="../js/ControllerProducto/verProducto.js"></script>
<?php
    $id = $_GET['id'];
?>

<main class="container">
    <ul class="nav margen">
        <li class="nav-item margenNav">
            <a class=" navIndex" aria-current="page" href="../principal.php">Inicio</a>
        </li>
        <li class="nav-item margenNav">
            <a class="navIndex" aria-current="page" href="infoProducto.php">Productos</a>
        </li>
        <li class="nav-item">
            <a class="activo navIndex" aria-current="page" href="">Ver</a>
        </li>
    </ul>
    <h1 class="margen">Información del Producto</h1>
    <div class="formulario margen">
            <input type="hidden" id="id" name="id" value='<?php echo$id;?>'>
            <div class="">
                <label for="Nombre:">Nombre</label>
                <input type="text" name="Nombre" id="Nombre" class="campoFormulario form-control"
                    placeholder="Ingrese aquí el nombre" aria-label="Nombre" readonly>
            </div>

            <div class="">
                <label for="Descripcion">Descripcion</label>
                <input type="text" name="Descripcion" id="Descripcion" class="campoFormulario form-control"
                    placeholder="Ingrese aquí la Descripcion" aria-label="Descripcion" readonly>
            </div>
            <div class=" ">
                <label for="Precio">Precio</label>
                <input type="number" name="Precio" id="Precio" class="campoFormulario form-control"
                    placeholder="Ingrese aquí el Precio" aria-label="Precio" readonly>
            </div>


            <div class=" ">
                <label for="Tipo">Tipo</label>
                <input type="text" name="Tipo" id="Tipo" class="campoFormulario form-control"
                            aria-label="Tipo" readonly>
            </div>
            <div  id="Proveedor">
               
            </div>
            <br>



            <a href="infoProducto.php" class="btn btn-secondary boton">Volver</a>

    </div>



</main>

<?php include "../include/templates/footer.php" ?>