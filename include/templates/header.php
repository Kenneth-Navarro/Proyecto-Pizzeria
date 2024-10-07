<?php
session_start();
if ($_SESSION['Logueado'] == null) {
    header("Location: ../index.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_destroy();
    header("Location: ../index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzería Mabet</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <!-- jQuery y SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body>
    <header class="encabezado">
        <div>
            <button class="btn botonUsuario m-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                Usuario
            </button>

            <div class="offcanvas offcanvas-start infoUsuario" data-bs-backdrop="static" tabindex="-1"
                id="staticBackdrop" aria-labelledby="staticBackdropLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="staticBackdropLabel">Información de Sesión</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body infoUsuario">
                    <div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item infoUsuario"><b>Usuario:</b>
                                <?php echo $_SESSION['Logueado']['Usuario'] ?>
                            </li>
                            <li class="list-group-item infoUsuario"><b>Rol:</b>
                                <?php
                                if ($_SESSION['Logueado']['Rol'] == 1) {
                                    echo "Administrador";
                                } else {
                                    echo "Usuario";
                                }

                                ?>
                            </li>
                            <li class="list-group-item infoUsuario"><b>Empleado:</b>
                                <?php echo $_SESSION['Logueado']['NombreEmpleado'] . " " . $_SESSION['Logueado']['PrimerApellidoEmpleado'] ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <a href="../principal.php">
            <img class="logo" src="../img/Logo.png" alt="Logo Pizzería">
        </a>

        <form method="POST">
            <button type="submit" class="botonSalir ">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="simboloSalir bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                    <path fill-rule="evenodd"
                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                </svg>
            </button>
        </form>

    </header>