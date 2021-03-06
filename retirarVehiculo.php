<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TP Estacionamiento - Retirar Vehículo</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="funciones.js"></script>
    <link href="estilos/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script>
        function retirar()
        {
            var pagina = "http://localhost/tpEstacionamiento/ESTACIONAMIENTO_2017/apiRest/vehiculo";

            $.ajax({
                type: 'PUT',
                url: pagina,
                dataType: "json",
                data:{patente:$("#patente").val(),empleado : empleado},
                async: true
            })
            .done(function (objJson) 
            {
                if(objJson != "autoNoExisteQuitar")
                {
                    alert("Vehiculo retirado:\n"+"Patente: "+objJson.patente+"\nColor: "+objJson.color+"\nMarca: "+objJson.marca+"\nFecha de ingreso: "+objJson.fechaIngreso+"\nFecha de retiro: "+objJson.fechaRetiro+"\nPago: $"+objJson.pago);
                }
                else
                {
                    alert("El vehículo ingresado no se encuentra en el estacionamiento");
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
            });    

        }
    </script>
</head>
<body style="background-color:#87FACB;">
    <header>
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="container fluid">
                <div class="navbar-header">
                </div>
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Menú principal</a></li>
                        <?php

                        require "clases/Empleado.php";
                        session_start(); 
                        $arrayDeEmpleados = [];
                        $arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();

                        foreach ($arrayDeEmpleados as $item) 
                        {
                            if($item->GetUsuario() == $_SESSION["empleado"])
                            {
                                if($item->GetAdministrador() == 0)
                                {
                                    echo '<li><a href="menuAdministrarEmpleados.php">Empleados</a></li>
                                        <li class="active"><a href="menuAdministrarVehiculos.php">Vehículos</a></li>
                                        <li><a href="listadoDeEmpleados.php">Historial de empleados</a></li>
                                        <li><a href="listadoDeVehiculos.php">Historial de vehículos</a></li>';
                                }
                                else
                                {
                                    echo '<li class="active"><a href="menuAdministrarVehiculos.php">Vehículos</a></li>';
                                }
                            }
                        }


                        

                        ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php 
                                                                                        
                                                                                        echo $_SESSION["empleado"]; 
                                                                                        $arrayDeEmpleados = [];
                                                                                        $arrayDeEmpleados = Empleado::TraerTodosLosEmpleadosBD();

                                                                                        foreach ($arrayDeEmpleados as $item) 
                                                                                        {
                                                                                            if($item->GetUsuario() == $_SESSION["empleado"])
                                                                                            {
                                                                                                if($item->GetAdministrador() == 0)
                                                                                                {
                                                                                                    echo " (Administrador)";
                                                                                                }
                                                                                                else
                                                                                                {
                                                                                                    echo " (Empleado)";
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        ?></a></li>
                    </ul>
            </div>
        </nav>
    </header>


    <?php
    
    if(isset($_SESSION["empleado"]))
    {
        echo "<script type='text/javascript'>
            
        var empleado='".$_SESSION["empleado"]."';

        </script>";
    }

    if(isset($_SESSION["empleado"]))
    {
        
    }
    else
    {
        header("Location:index.php");
    }

    ?>

    <div class="form-group text-center">
    <font color="black"><h2 style="background-color:white;">Retirar vehículo</h2></font>
    <input type="text" id="patente" name="patente" placeholder="Ingrese la patente">
    </br>
    </br>
    <input type="button" class="btn btn-success" value="Retirar vehículo" onclick="retirar()">
    </br>
    </br>
    </br>
    </br>
    <a href="menuAdministrarVehiculos.php" class="btn btn-primary">Volver al menú principal</a>
    </div>
</body>
</html>