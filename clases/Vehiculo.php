<?php

class Vehiculo
{
    private $_patente;
    private $_color;
    private $_marca;
    private $_pago;
    private $_cochera;
    private $_fechaIngreso;

    function __construct($patente,$color,$marca,$pago,$cochera,$fechaIngreso)
    {
        $this->_patente = $patente;
        $this->_color = $color;
        $this->_marca = $marca;
        $this->_pago = $pago;
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
}




?>