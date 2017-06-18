<?php

switch ($_POST["discapacidad"])
{
    case 0:
        $pdo = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");

        $consulta = $pdo->prepare("SELECT * FROM `cocheras` WHERE estado=0 AND tipo='normal'");
        $consulta->execute();

        while($row = $consulta->fetch(PDO::FETCH_ASSOC))
        {
            $array[] = $row;
        }
        
        echo "<option value=''>--Seleccione una cochera--</option>";
        
        for ($i=0; $i < count($array); $i++)
        { 
            echo "<option value='".$array[$i]["numero"]."'>".$array[$i]["numero"]."</option>";
        }

        break;
    case 1:

        $pdo = new PDO("mysql:host=localhost;dbname=tpEstacionamiento","root","");

        $consulta = $pdo->prepare("SELECT * FROM `cocheras` WHERE estado=0 AND tipo='reservado'");
        $consulta->execute();

        while($row = $consulta->fetch(PDO::FETCH_ASSOC))
        {
            $array[] = $row;
        }
        
        echo "<option value=''>--Seleccione una cochera--</option>";
        
        for ($i=0; $i < count($array); $i++) 
        { 
            echo "<option value='".$array[$i]["numero"]."'>".$array[$i]["numero"]."</option>";
        }
        
        break;
    default:
        echo "";
        break;
}

?>