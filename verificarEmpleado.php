<?php

require_once "clases/Empleado.php";

if($_POST["op"] == "login")
{
    $arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();

    foreach ($arrayDeEmpleados as $item)
    {
       if($item->GetUsuario() == $_POST["txtEmpleado"] && $item->GetPassword() == $_POST["txtPassword"])
       {
            if($item->GetAdministrador() == "Activado")
            {
                session_start();
                $_SESSION["personal"] = $_POST["txtEmpleado"];
                echo "administrador";
            }
            else
            {
                session_start();
                $_SESSION["personal"] = $_POST["txtEmpleado"];
                echo "empleado";
            }
        }
    }
}

if($_POST["op"] == "logout")
{
    session_start();

    session_destroy();

    echo "salir";
}


?>