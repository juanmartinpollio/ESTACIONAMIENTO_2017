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
    .done(function (objJson) {
        alert("Vehículo registrado");
        window.location.href = "listadoDeVehiculos.php";
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
    });    

}