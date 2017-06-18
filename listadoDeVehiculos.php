<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TP Estacionamiento - Listado de vehículos</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="funciones.js"></script>
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
            var tablaEncabezado = "<table border='1' class='table'>";
            tablaEncabezado += "<tr><th>PATENTE</th><th>COLOR</th><th>MARCA</th><th>COCHERA UTILIZADA</th><th>FECHA DE INGRESO</th><th>FECHA DE RETIRO</th><th>PAGO</th></tr>";
            var tablaCuerpo = "";
            var tablaPie = "</tr></html>";

            for(var i=0;i<objJson.length;i++)
            {
                tablaCuerpo += "<tr><td>"+objJson[i].patente+"</td><td>"+objJson[i].color;
                tablaCuerpo += "</td><td>"+objJson[i].marca+"</td><td>"+objJson[i].cochera;
                tablaCuerpo += "</td><td>"+objJson[i].fechaIngreso+"</td><td>"+objJson[i].fechaRetiro+"</td><td>$"+objJson[i].pago+"</td></tr>";
            }

            $("#divTabla").html(tablaEncabezado+tablaCuerpo+tablaPie);

        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        });    
    }
    </script>
</head>
<body>
    <div id="divTabla"></div>
    <a href="index.php">Volver a la página principal</a>
</body>
</html>