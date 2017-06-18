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

            var formData = new FormData();
            formData.append("patente",$("#patente").val());

            $.ajax({
                type: 'PUT',
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
                window.location.href = "listadoDeVehiculos.php";
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
            });    

        }
    </script>
</head>
<body>
    <input type="text" id="patente" name="patente">
    </br>
    </br>
    <input type="button" value="Retirar vehículo" onclick="retirar()">
</body>
</html>