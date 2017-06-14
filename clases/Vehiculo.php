<?php

class Vehiculo
{
    private $_patente;
    private $_color;
    private $_marca;
    private $_pago;
    private $_cochera;
    private $_fechaIngreso;

    function __construct($patente,$color,$marca,$cochera,$fechaIngreso)
    {
        $this->_patente = $patente;
        $this->_color = $color;
        $this->_marca = $marca;
        $this->_pago = 0;
        $this->_cochera = $cochera;
        $this->_fechaIngreso = $fechaIngreso;
    }

    function GetPatente()
    {
        return $this->_patente;
    }
    
    function GetColor()
    {
        return $this->_color;
    }

    function GetMarca()
    {
        return $this->_marca;
    }

    function GetPago()
    {
        return $this->_pago;
    }

    function GetCochera()
    {
        return $this->_cochera;
    }

    function GetFechaIngreso()
    {
        return $this->_fechaIngreso;
    }

    public static function TraerTodosLosVehiculos()
	{
		try
		{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
            $sql = "SELECT patente, color, marca, cochera, fechaIngreso FROM vehiculos";

            $consulta = $objetoAccesoDato->RetornarConsulta($sql);
            $consulta->execute();

            return $consulta->fetchall(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public static function agregarVehiculo($patente,$color,$marca,$cochera,$fechaIngreso)
	{
        $pdo = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");
			
        $auxPatente = $patente;
        $auxColor = $color;
        $auxMarca = $marca;
        $auxCochera = $cochera;
        $auxFechaIngreso = $fechaIngreso;

        $consulta = $pdo->prepare("INSERT INTO `vehiculos`(`patente`, `color`, `marca`, `cochera`, `fechaIngreso`) VALUES (:patente,:color,:marca,:cochera,:fechaIngreso)");
        $consulta->bindParam(":patente",$auxPatente);
        $consulta->bindParam(":color",$auxColor);
        $consulta->bindParam(":marca",$auxMarca);
        $consulta->bindParam(":cochera",$auxCochera);
        $consulta->bindParam(":fechaIngreso",$auxFechaIngreso);

		return $consulta->execute();
	}

	/*public static function EliminarCD($id)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

		$sql = "DELETE FROM cds WHERE id='$id'";

		$consulta = $objetoAccesoDato->RetornarConsulta($sql);
		return $consulta->execute();
	}*/

}

?>