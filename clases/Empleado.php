<?php

class Empleado
{
    private $_id;
    private $_usuario;
    private $_nombre;
    private $_apellido;
    private $_password;
    private $_turno;
    private $_condicion;
    private $_administrador;

    function __construct($id = NULL,$usuario,$nombre,$apellido,$password,$turno,$condicion,$administrador)
    {
        $this->_id = $id;
        $this->_usuario = $usuario;
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_password = $password;
        $this->_turno = $turno;
        $this->_condicion = $condicion;
        $this->_administrador = $administrador;
    }

    function GetID()
    {
        return $this->_id;
    }

    function GetUsuario()
    {
        return $this->_usuario;
    }

    function GetNombre()
    {
        return $this->_nombre;
    }

    function GetApellido()
    {
        return $this->_apellido;
    }

    function GetPassword()
    {
        return $this->_password;
    }

    function GetTurno()
    {
        return $this->_turno;
    }

    function GetCondicion()
    {
        return $this->_condicion;
    }

    function GetAdministrador()
    {
        return $this->_administrador;
    }

    public static function TraerTodosLosEmpleadosBD()
	{
		try
		{
			$pdo = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");
			$array = [];

			$consulta = $pdo->prepare("SELECT * FROM empleados");
			$consulta->execute();
			
			while($row = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$array[] = $row;
			}

            $arrayDeEmpleados = [];

            foreach ($array as $item)
            {
                $empleadoAux = new Empleado($item["id"],$item["usuario"],$item["nombre"],$item["apellido"],$item["password"],$item["turno"],$item["condicion"],$item["administrador"]);
                array_push($arrayDeEmpleados,$empleadoAux);
            }

            return $arrayDeEmpleados;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

    public static function GuardarEnBD($objeto)
    {
        try
    	{
			$pdo = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");
			
			$auxID = $objeto->GetID();
            $auxUsuario = $objeto->GetUsuario();
            $auxNombre = $objeto->GetNombre();
            $auxApellido = $objeto->GetApellido();
            $auxPassword = $objeto->GetPassword();
            $auxTurno = $objeto->GetTurno();
            $auxCondicion = $objeto->GetCondicion();
            $auxAdministrador = $objeto->GetAdministrador();

			$consulta = $pdo->prepare("INSERT INTO `empleados`(`id`,`usuario`, `nombre`, `apellido`, `password`, `turno`, `condicion`, `administrador`) VALUES (:id,:usuario,:nombre,:apellido,:password,:turno,:condicion,:administrador)");
			$consulta->bindParam(":id",$auxID);
			$consulta->bindParam(":usuario",$auxUsuario);
			$consulta->bindParam(":nombre",$auxNombre);
            $consulta->bindParam(":apellido",$auxApellido);
            $consulta->bindParam(":password",$auxPassword);
            $consulta->bindParam(":turno",$auxTurno);
            $consulta->bindParam(":condicion",$auxCondicion);
            $consulta->bindParam(":administrador",$auxAdministrador);

			return $consulta->execute();
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }

}

?>