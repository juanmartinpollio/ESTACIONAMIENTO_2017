<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TP Estacionamiento - Historial de vehículos</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="funciones.js"></script>
    <link href="estilos/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script>
    window.onload = traerTodos;

    function traerTodos()
    {
        var pagina = "http://localhost/tpEstacionamiento/ESTACIONAMIENTO_2017/apiRest/vehiculo";

        $.ajax({
            type: 'GET',
            url: pagina,
            dataType: "json",
            async: true
        })
        .done(function (objJson) 
        {
            var tablaEncabezado = "<div class='container'><table class='table table-striped' style='background-color:white;'>";
            tablaEncabezado += "<tr><th>PATENTE</th><th>COLOR</th><th>MARCA</th><th>COCHERA UTILIZADA</th><th>FECHA DE INGRESO</th><th>FECHA DE RETIRO</th><th>PAGO</th></tr>";
            var tablaCuerpo = "";
            var tablaPie = "</tr></div>";


            for(var i=0;i<objJson.length;i++)
            {
                if(objJson[i].pago == 0)
                {
                    objJson[i].pago = "El vehículo aún se encuentra en el estacionamiento";
                }
                else
                {
                    objJson[i].pago = "$"+objJson[i].pago;
                }

                if(objJson[i].fechaRetiro == "0000-00-00 00:00:00")
                {
                    objJson[i].fechaRetiro = "El vehículo aún se encuentra en el estacionamiento";
                }

                tablaCuerpo += "<tr><td>"+objJson[i].patente+"</td><td>"+objJson[i].color;
                tablaCuerpo += "</td><td>"+objJson[i].marca+"</td><td>"+objJson[i].cochera;
                tablaCuerpo += "</td><td>"+objJson[i].fechaIngreso+"</td><td>"+objJson[i].fechaRetiro+"</td><td>"+objJson[i].pago+"</td></tr>";
            }

            $("#divTabla").html(tablaEncabezado+tablaCuerpo+tablaPie);

        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
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
                        <li><a href="menuAdministrarEmpleados.php">Empleados</a></li>
                        <li><a href="menuAdministrarVehiculos.php">Vehículos</a></li>
                        <li><a href="listadoDeEmpleados.php">Historial de empleados</a></li>
                        <li class="active"><a href="listadoDeVehiculos.php">Historial de vehículos</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php 
                                                                                        require "clases/Empleado.php";
                                                                                        session_start(); 
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
    <font color="black"><h2 style="background-color:white;">Historial de vehículos</h2></font>
    <div id="divTabla" class="table-striped"></div>
    <a href="menuAdministrador.php" class="btn btn-primary">Volver a la página principal</a>
    </div>
</body>
</html>