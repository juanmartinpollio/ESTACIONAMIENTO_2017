function verificarEmpleado()
{
    $.ajax({
            url: "verificarEmpleado.php",
            type: "POST",
            data: "txtEmpleado="+$("#txtEmpleado").val()+"&txtPassword="+$("#txtPassword").val()+"&op=login",
            success: function(data)
            {
                if (data == "empleado")
                {
                    alert("Ingreso correcto como EMPLEADO, redireccionando al menú correspondiente...");
                    window.location.href = "menuEmpleado.php";
                }
                else
                {
                    if (data == "administrador") 
                    {
                        alert("Ingreso correcto como ADMINISTRADOR, redireccionando al menú correspondiente...");
                        window.location.href = "menuAdministrador.php";
                    } 
                    else 
                    {
                        alert("Datos incorrectos, intente nuevamente");
                        window.location.href = "index.php";
                    }
                }
            }
        })
}

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

function agregarEmpleado()
{
    $.ajax({
            url: "administrarEmpleados/administrarEmpleados.php",
            type: "POST",
            data: "op=altaEmpleado",
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