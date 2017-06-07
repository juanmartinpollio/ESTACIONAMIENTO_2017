<?php

session_start();

if(isset($_SESSION["empleado"]))
{
    echo '<!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Menú para administrar empleados</title>
                <script type="text/javascript" src="jquery.js"></script>
                <script type="text/javascript" src="funciones.js"></script>
            </head>
            <body>
                <h2>Administrar empleados</h2>
                <form action="menuAdministrarEmpleados.php" method="POST">
                    <input type="submit" name="alta" value="Agregar nuevo empleado">
                    </br>
                    <input type="submit" name="suspender" value="Suspender empleado">
                    </br>
                    <input type="submit" name="habilitar" value="Habilitar empleado">
                    </br>
                    <input type="submit" name="baja" value="Eliminar empleado">
                    </br>
                    </br>
                </form>
                <a href="menuAdministrador.php">Volver al menú del administrador</a>
            </body>
            </html>';

    if(isset($_POST["alta"]))
    {
        header("Location:altaEmpleado.php");
    }

    if(isset($_POST["suspender"]))
    {
        header("Location:suspenderEmpleado.php");
    }

    if(isset($_POST["habilitar"]))
    {
        header("Location:habilitarEmpleado.php");
    }

    if(isset($_POST["baja"]))
    {
        header("Location:eliminarEmpleado.php");
    }
}
else
{
    header("Location:index.php");
}

?>