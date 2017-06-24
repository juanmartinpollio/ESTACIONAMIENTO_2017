<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TP Estacionamiento - Registrar Vehículo</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="funciones.js"></script>
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
            window.location.href = "listadoDeVehiculos.php";
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
        });    

    }


    </script>
</head>
<body>

    <?php

    session_start();
    
    if(isset($_SESSION["empleado"]))
    {
        echo "<script type='text/javascript'>
            
        var empleado='".$_SESSION["empleado"]."';

        </script>";
    }

    ?>

    Pantente:
    </br>
    <input type="text" name="patente" id="patente">
    </br>
    Color:
    </br>
    <input type="text" name="color" id="color">
    </br>
    Marca:
    </br>
    <input type="text" name="marca" id="marca">
    </br>
    Tipo de cochera:
    </br>
    <select name="discapacidad" id="discapacidad" onchange="actualizarCocheras()">
    <option value="">--SELECCIONE UNA OPCION--</option>
    <option value="0">Normal</option>
    <option value="1">Embarazada/Discapacidad</option>
    </select>
    </br>
    </br>
    Cocheras disponibles:
    </br>
    <select name="cochera" id="cochera">
    <option value="0">--Esperando tipo de cocheras--</option>
    </select>
    </br>
    </br>
    </br>
    <input type="button" value="Agregar vehiculo" onclick="agregar()">
    </br>
    <a href="index.php">Volver al menú principal</a>
</body>
</html>