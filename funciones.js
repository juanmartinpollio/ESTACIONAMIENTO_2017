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
            url: "administrarEmpleados.php",
            type: "POST",
            data: $("#form").serialize()+"&op=altaEmpleado",
            success: function(data)
            {
                if (data == "empleado agregado")
                {
                    alert("Empleado agregado");
                    //window.location.href = "listadoEmpleados.php";
                }
                else
                {
                    alert(data);
                    window.location.href = "../menuAdministrarEmpleados.php";
                }
            }
        })
}

function suspenderEmpleado()
{
    $.ajax({
            url: "administrarEmpleados.php",
            type: "POST",
            data: $("#form").serialize()+"&op=suspenderEmpleado",
            success: function(data)
            {
                if (data == "empleado suspendido")
                {
                    alert("Empleado suspendido");
                    //window.location.href = "listadoEmpleados.php";
                }
                else
                {
                    alert("El empleado no existe");
                    window.location.href = "../menuAdministrarEmpleados.php";
                }
            }
        })
}

function habilitarEmpleado()
{
    $.ajax({
            url: "administrarEmpleados.php",
            type: "POST",
            data: $("#form").serialize()+"&op=habilitarEmpleado",
            success: function(data)
            {
                if (data == "empleado habilitado")
                {
                    alert("Empleado habilitado");
                    //window.location.href = "listadoEmpleados.php";
                }
                else
                {
                    alert("El empleado no existe");
                    window.location.href = "../menuAdministrarEmpleados.php";
                }
            }
        })
}

function eliminarEmpleado()
{
    $.ajax({
            url: "administrarEmpleados.php",
            type: "POST",
            data: $("#form").serialize()+"&op=eliminarEmpleado",
            success: function(data)
            {
                if (data == "empleado eliminado")
                {
                    alert("Empleado eliminado");
                    //window.location.href = "listadoEmpleados.php";
                }
                else
                {
                    alert("El empleado no existe");
                    window.location.href = "../menuAdministrarEmpleados.php";
                }
            }
        })
}