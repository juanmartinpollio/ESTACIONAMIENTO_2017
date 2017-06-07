<?php

require_once "clases/Empleado.php";


if($_POST["op"] == "logout")
{
    session_start();

    session_destroy();

    echo "salir";
}


?>