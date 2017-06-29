<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TP Estacionamiento - Listado de cocheras</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="funciones.js"></script>
    <link href="estilos/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script>

    window.onload = traerTodos;

    function traerTodos()
    {
        var pagina = "http://localhost/tpEstacionamiento/ESTACIONAMIENTO_2017/apiRest/cocheras";

        $.ajax({
            type: 'GET',
            url: pagina,
            dataType: "json",
            async: true
        })
        .done(function (objJson) 
        {
            var tablaEncabezado = "<table class='table' style='background-color:white;'>";
            tablaEncabezado += "<tr><th>PATENTE</th><th>TIPO</th><th>NUMERO</th><th>ESTADO</th><th>CANTIDAD DE VECES USADA</th><th>FECHA DE INGRESO</th></tr>";
            var tablaCuerpo = "";
            var tablaPie = "</tr>";


            for(var i=0;i<objJson.length;i++)
            {
                if(objJson[i].estado == 0 && objJson[i].patente == "vacio")
                {
                    objJson[i].patente = "-";
                    objJson[i].estado = "Disponible";
                    tablaCuerpo += "<tr class='success'><td>"+objJson[i].patente+"</td><td>"+objJson[i].tipo;
                    tablaCuerpo += "</td><td>"+objJson[i].numero+"</td><td>"+objJson[i].estado;
                    tablaCuerpo += "</td><td>"+objJson[i].cantidadUsada+"</td><td>"+objJson[i].fechaIngreso+"</td></tr>";
                }
                else
                {
                    objJson[i].estado = "Ocupada";
                    tablaCuerpo += "<tr class='danger'><td>"+objJson[i].patente+"</td><td>"+objJson[i].tipo;
                    tablaCuerpo += "</td><td>"+objJson[i].numero+"</td><td>"+objJson[i].estado;
                    tablaCuerpo += "</td><td>"+objJson[i].cantidadUsada+"</td><td>"+objJson[i].fechaIngreso+"</td></tr>";
                }
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
    <font color="black"><h2 style="background-color:white;">Listado de cocheras</h2></font>
    <div id="divTabla" class="container"></div>
    <a href="menuAdministrarVehiculos.php" class="btn btn-primary">Volver a la página principal</a>
    </div>
</body>
</html>