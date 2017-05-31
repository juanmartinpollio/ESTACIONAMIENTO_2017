<?php

require_once "Vehiculo.php";

class Cochera()
{
    private $_tipo;
    private $_numero;
    private $_estado;

    function __construct($tipo,$numero,$estado)
    {
        $this->_tipo = $tipo;
        $this->_numero = $numero;
        $this->_estado = $estado;
    }

    function GetTipo()
    {
        return $this->_tipo;
    }
    
    function GetNumero()
    {
        return $this->_numero;
    }

    function GetEstado()
    {
        return $this->_estado;
    }
}



?>