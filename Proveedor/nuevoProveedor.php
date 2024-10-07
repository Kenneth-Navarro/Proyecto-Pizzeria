<?php include "../include/templates/header.php" ?>

<script type="text/javascript" src="../js/controllerProveedor.js"></script>

<main class="container">
    <h1>Nuevo Proveedor</h1>
    <form class="formulario" method="post">
      
        <div>
            <label for="Nombre">Nombre:</label>
            <br>
            <input type="text" name="Nombre" id="Nombre" >
        </div>

        <div>
            <label for="Encargado">Encargado:</label>
            <br>
            <input type="text" name="Encargado" id="Encargado" >
        </div>

        <div>
            <label for="Telefono">Teléfono:</label>
            <br>
            <input type="number" name="Telefono" id="Telefono" >
        </div>
      
        <div>
            <label for="Correo">Correo:</label>
            <br>
            <input type="text" name="Correo" id="Correo" >
        </div>

     
        <div>
            <a href="infoProveedor.php" type="button" class="espaciado_enlaces">Volver</a>
            <button  type="submit"  onclick="insertar()">Guardar</button>
        </div>
    </form>


</main>

<?php include "../include/templates/footer.php" ?>