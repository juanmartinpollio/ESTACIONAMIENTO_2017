<?php

require_once "Vehiculo.php";

class Cochera
{
    private $_patenteOcupada;
    private $_numero;

    function __construct($patenteOcupada,$numero)
    {
        $this->_patenteOcupada = $patenteOcupada;
        $this->_numero = $numero;
    }

    function GetNumero()
    {
        return $this->_numero;
    }

    function GetPatenteOcupada()
    {
        return $this->_patenteOcupada;
    }
}
?>