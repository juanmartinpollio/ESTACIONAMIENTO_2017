<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TP Estacionamiento - Retirar Vehículo</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="funciones.js"></script>
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


    <input type="text" id="patente" name="patente">
    </br>
    </br>
    <input type="button" value="Retirar vehículo" onclick="retirar()">
    <a href="index.php">Volver al menú principal</a>
</body>
</html>