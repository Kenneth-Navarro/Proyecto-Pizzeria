<?php include "../include/templates/header.php" ?>

<?php
require_once "../DAL/productoDAL.php";
require_once "../DAL/proveedorDAL.php";
require_once "../include/functions/recoge.php";
?>
<script type="text/javascript" src="../js/ControllerProducto/infoProducto.js"></script>


<main class="container">
<ul class="nav margen">
        <li class="nav-item" style="margin-right: 2rem;">
            <a class=" navIndex" aria-current="page" href="../principal.php">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="activo navIndex" aria-current="page" href="">Productos</a>
        </li>
    </ul>
    <button type="button" name="Nuevo" id="Nuevo" class="botonNuevo btn btn-success" data-bs-toggle="modal" data-bs-target="#modalNuevo">
        <b>Nuevo Producto <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg></b>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalNuevo" tabindex="-1" aria-labelledby="modalNuevo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered d-flex justify-content-center align-items-center ">
            <div class="modal-content modalConfig bordeModel">
                <div class="modal-header encabezadoNuevo">
                    <h2 class="textoEncabezadoModal modal-title text-center" id="encabezadoNew">Nuevo Producto</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario dentro del modal -->

                    <form class="formularioModal">
                        <div class="">
                            <label for="Nombre:">Nombre:</label>
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
                            <input type="number" name="Precio" id="Precio"
                                class="campoFormulario form-control" placeholder="Ingrese aquí el Precio"
                                aria-label="Precio" required>
                        </div>

                        <div class="">
                            <label for="ID_tipo">Tipo:</label>
                            <select name="ID_tipo" id="ID_tipo" class="campoFormulario form-select" required>
                            </select>
                        </div>

                    
                        <div style="display:none" id="Proveedor">
                            <label for="ID_Proveedor">Proveedor:</label>
                            <select name="ID_Proveedor" id="ID_Proveedor" class="campoFormulario form-select " required>
                            </select>
                        </div>

                        <br>



                        <input type="button" class="btn btn-success boton" name="Guardar" id="Guardar"
                            value="Guardar">

                    </form>
                </div>
            </div>
        </div>
    </div>


    <table class="tabla table table-striped" id="tablaProductos" name="tablaProductos"></table>

</main>
<?php include "../include/templates/footer.php" ?>

