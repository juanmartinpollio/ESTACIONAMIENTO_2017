function cerrarSesionEmpleado()
{
    $.ajax({
            url: "verificarEmpleado.php",
            type: "POST",
            data: "op=logout",
            success: function(data)
            {
                if (data == "salir")
                {
                    alert("Sesión cerrada");
                    window.location.href = "index.php";
                }
                else
                {
                    alert("Error al deslogearse, intente nuevamente");
                }
            }
        })
}

function redireccionarAdministrarEmpleados()
{
    window.location.href = "menuAdministrarEmpleados.php";
}

function agregar()
{
    var pagina = "http://localhost/tpEstacionamiento/ESTACIONAMIENTO_2017/apiRest/vehiculo";

	var formData = new FormData();
	formData.append("patente",$("#patente").val());
	formData.append("color",$("#color").val());
	formData.append("marca",$("#marca").val());
    formData.append("cochera",$("#cochera").val());

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

function actualizarCocheras()
{
    var pagina = "actualizarCocheras.php";
    //var nombre = document.getElementById("txtNombre").value;
    //var datoString = "txtNombre="+nombre;
    
        $.ajax({
            type: 'POST',//GET o POST. GET DEFAULT.
            url: pagina,//PAGINA DESTINO DE LA PETICION
            dataType: "text",//INDICA EL TIPO QUE SE ESPERA RECIBIR DESDE EL SERVIDOR (XML, HTML, TEXT, JSON, SCRIPT) 
            data: "discapacidad="+$("#discapacidad").val(),//DATO A SER ENVIADO AL SERVIDOR. TIPO: OBJETO, STRING, ARRAY.
            async: true,//ESTABLECE EL MODO DE PETICION. DEFECTO ASINCRONICO.
            statusCode: {//CODIGO NUMERICO DE RESPUESTA HTTP
                    200: function(){
                        console.log("200 - Encontrado!!!");
                    },
                    404: function(){
                        console.log("404 - No encontrado!!!");
                    }
                }
            })
        .done(function (data) {//RECUPERO LA RESPUESTA DEL SERVIDOR EN 'RESULTADO', DE ACUERDO AL DATATYPE.
             //alert(data);
                 $("#cochera").html(data);
             //alert(data);
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
        });
}