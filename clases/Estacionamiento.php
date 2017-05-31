<?php

class Estacionamiento
{
    private $_piso;
    private $_cocheras;

    function __construct($piso,$cocheras)
    {
        $this->_piso = $piso;
        $this->_cocheras = $cocheras;
    }

    function GetPiso()
    {
        return $this->_piso;
    }

    function GetCocheras()
    {
        return $this->_cocheras;
    }
}

?>