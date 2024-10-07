<?php

    function Conecta(){
        $server= "localhost";
        $user = "root";
        $password = "";
        $database = "pizzeria";

        $conexion = mysqli_connect($server,$user,$password,$database);
        
        if (!$conexion) {
            echo "Ocurrio un error al establecer la conexión con la base" . mysqli_connect_error();
        }

        return $conexion;

    }

    function Desconecta($conexion){
        mysqli_close($conexion);
    }


?>