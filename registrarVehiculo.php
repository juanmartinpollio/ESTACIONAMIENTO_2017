<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TP Estacionamiento - Registrar Vehículo</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="funciones.js"></script>
    <link href="estilos/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript">
    
    function agregar()
    {
        var pagina = "http://localhost/tpEstacionamiento/ESTACIONAMIENTO_2017/apiRest/vehiculo";

        var formData = new FormData();
        formData.append("patente",$("#patente").val());
        formData.append("color",$("#color").val());
        formData.append("marca",$("#marca").val());
        formData.append("cochera",$("#cochera").val());
        formData.append("empleado",empleado);

        $.ajax({
            type: 'POST',
            url: pagina,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            async: true
        })
        .done(function (objJson) 
        {
            var resultado = JSON.parse(objJson);
            if(resultado == true)
            {
                alert("Vehículo agregado correctamente");
            }
            else
            {
                alert("Error, el vehículo ya existe");
            }
            window.location.href = "listadoDeCocheras.php";
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
    <font color="black"><h2 style="background-color:white;">Registro del vehículo</h2></font>
    <font size="4px" color="black">Pantente:</font>
    </br>
    <input type="text" name="patente" id="patente">
    </br>
    <font size="4px" color="black">Color:</font>
    </br>
    <input type="text" name="color" id="color">
    </br>
    <font size="4px" color="black">Marca:</font>
    </br>
    <input type="text" name="marca" id="marca">
    </br>
    <font size="4px" color="black">Tipo de cochera:</font>
    </br>
    <select name="discapacidad" id="discapacidad" onchange="actualizarCocheras()">
    <option value="">--SELECCIONE UNA OPCION--</option>
    <option value="0">Normal</option>
    <option value="1">Embarazada/Discapacidad</option>
    </select>
    </br>
    </br>
    <font size="4px" color="black">Cocheras disponibles:</font>
    </br>
    <select name="cochera" id="cochera">
    <option value="0">--Esperando tipo de cocheras--</option>
    </select>
    </br>
    </br>
    <input type="button" class="btn btn-success" value="Agregar vehiculo" onclick="agregar()">
    </br>
    </br>
    </br>
    </br>
    <a href="menuAdministrarVehiculos.php" class="btn btn-primary">Volver al menú principal</a>
    </div>
</body>
</html>