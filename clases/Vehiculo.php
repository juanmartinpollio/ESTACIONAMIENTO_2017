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
		
            $sql = "SELECT patente, color, marca, cochera, fechaIngreso, fechaRetiro, pago FROM vehiculos";

            $consulta = $objetoAccesoDato->RetornarConsulta($sql);
            $consulta->execute();

            return $consulta->fetchall(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

    public static function TraerTodosLosVehiculosCochera()
    {
        try
		{
			$pdo = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");

            $consulta = $pdo->prepare("SELECT * FROM cocheras");

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
        $consulta->execute();

		return true;
	}

    public static function buscarLugarEstacionamiento($cochera)
    {
        $array = array();

        try
        {
            $pdo = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");

            $consulta = $pdo->prepare("SELECT `patente`, `tipo`, `numero`, `estado`, `cantidadUsada` FROM `cocheras` WHERE numero='$cochera'");
            $consulta->execute();
            
            $array = $consulta->fetchall(PDO::FETCH_ASSOC);

            foreach ($array as $item) 
            {
                if($item["estado"] == 0)
                {
                    return "trueBuscar";
                }
                else
                {
                    return "falseBuscar";
                }
            }
        } 
        catch(PDOException $err)
        {
            return array("Error" => $err->getMessage());
        }
    }

    public static function agregarAutoAlEstacionamiento($patente,$cochera)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");

        $fechaIngreso = date("Y-m-d H:i:s");

        if(Vehiculo::buscarLugarEstacionamiento($cochera) == "trueBuscar")
        {
            $consulta = $pdo->prepare("UPDATE `cocheras` SET `patente`='$patente',`estado`=1,`cantidadUsada`=`cantidadUsada`+1, `fechaIngreso`='$fechaIngreso' WHERE `numero`='$cochera'");

            return $consulta->execute();
        }
        else
        {
            return "falseAgregar";
        } 
    }

	public static function quitarAutoDelEstacionamiento($patente)
	{
		if(Vehiculo::verificarPatente($patente) == "autoExiste")
        {
            $pdo = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");
            $consulta = $pdo->prepare("SELECT `numero`, `fechaIngreso` FROM `cocheras` WHERE `patente`='$patente'");
            $consulta->execute();
            $datosAutoARetirar = $consulta->fetch(PDO::FETCH_ASSOC);

            $pdoDos = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");
            $consultaDos = $pdoDos->prepare("UPDATE `cocheras` SET `patente`='vacio',`estado`=0, `fechaIngreso`=0 WHERE `patente`='$patente'");
            $consultaDos->execute();
            
            $pdoTres = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");
            $consultaTres = $pdoTres->prepare("SELECT `patente`, `color`, `marca` FROM `vehiculos` WHERE `patente`='$patente'");
            $consultaTres->execute();

            $autoARetirar = $consultaTres->fetch(PDO::FETCH_ASSOC);
            $autoARetirar["fechaIngreso"] = $datosAutoARetirar["fechaIngreso"];
            $autoARetirar["fechaRetiro"] = date("Y-m-d H:i:s");
            $horaEnSegundos = (strtotime($autoARetirar["fechaRetiro"]) - strtotime($datosAutoARetirar["fechaIngreso"]));
            $autoARetirar["pago"] = ceil($horaEnSegundos/60/60);
            
            $cantidadDeDias = 0;

            while($horaEnSegundos >= 86400)
            {
                $horaEnSegundos = $horaEnSegundos - 86400;
                $cantidadDeDias++;
            }

            $importe = $cantidadDeDias * 170;

            if($horaEnSegundos <= 43200 && $horaEnSegundos >= 32400)
            {
                $importe = $importe + 90;
            } 
            else 
            {
                if($horaEnSegundos < 32400)
                {
                    $importe += ceil($horaEnSegundos/60/60) * 10;
                }
                else
                {
                    if($horaEnSegundos > 43200 && $horaEnSegundos < 72000)
                    {
                        $redondeo = ceil($horaEnSegundos/60/60) - 12;
                        
                        $importe = $importe + 90 + $ceil * 10; 
                    }
                    else
                    {
                        $importe += 170;
                    }
                }
            }

            $autoARetirar["pago"] = $importe;

            $pago = $autoARetirar['pago'];
            $fechaIngreso = $datosAutoARetirar['fechaIngreso'];
            $fechaEgreso = $autoARetirar['fechaRetiro'];

            $pdoCuatro = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");
            $consultaCuatro = $pdoCuatro->prepare("UPDATE `vehiculos` SET `fechaRetiro`='$fechaEgreso',`pago`='$pago' WHERE `patente`='$patente' AND `fechaIngreso`='$fechaIngreso'");
            $consultaCuatro->execute();

            return $autoARetirar;
        }
        else
        {
            return "autoNoExisteQuitar";
        }
	}

    public static function verificarPatente($patente)
    {
        $array = array();

        try
        {
            $pdo = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");

            $consulta = $pdo->prepare("SELECT `patente` FROM `cocheras`");
            $consulta->execute();
            
            $array = $consulta->fetchall(PDO::FETCH_ASSOC);

            foreach ($array as $item) 
            {
                if($item["patente"] == $patente)
                {
                    return "autoExiste";
                }
            }

            return "autoNoExiste";
        } 
        catch(PDOException $err)
        {
            return array("Error" => $err->getMessage());
        }
    }

}

?>