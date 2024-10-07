<?php include "../include/templates/header.php" ?>


<?php
require_once "../DAL/productoDAL.php";
require_once "../DAL/proveedorDAL.php";
require_once "../include/functions/recoge.php";
?>
<script type="text/javascript" src="../js/ControllerProducto/actualizaProducto.js"></script>
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
            <a class="activo navIndex" aria-current="page" href="">Actualizar</a>
        </li>
    </ul>
    <h1 class="margen">Actualización del Producto</h1>
    <form class="formulario margen">
    <input type="hidden" id="id" name="id" value='<?php echo $id; ?>'>
    <div class="">
        <label for="Nombre">Nombre:</label>
        <input type="text" name="Nombre" id="Nombre" class="campoFormulario form-control"
            placeholder="Ingrese aquí el nombre" aria-label="Nombre" required>
    </div>

    <div class="">
        <label for="Descripcion">Descripcion:</label>
        <textarea name="Descripcion" id="Descripcion" class="campoFormulario form-control"
                placeholder="Ingrese aquí la Descripcion" aria-label="Descripcion" required></textarea>
    </div>

    <div class="">
        <label for="Precio">Precio:</label>
        <input type="number" name="Precio" id="Precio" class="campoFormulario form-control"
            placeholder="Ingrese aquí el Precio" aria-label="Precio" required>
    </div>


    <div class="">
        <label for="ID_tipo">Tipo:</label>
        <select name="ID_tipo" id="ID_tipo" class="campoFormulario form-select " required>
        </select>
    </div>

    <div style="display:none" id="Proveedor">
        <label for="ID_Proveedor">Proveedor:</label>
        <select name="ID_Proveedor" id="ID_Proveedor" class="campoFormulario form-select " required>
        </select>
    </div>
   <br>
   <div style="grid-column-end: 3;">
            <a href="infoProducto.php" class="btn btn-secondary boton">Volver</a>
            <input type="button" class="btn btn-success boton" name="Actualizar" id="Actualizar" value="Actualizar">
        </div>
        
    </form>


</main>

<?php include "../include/templates/footer.php" ?>