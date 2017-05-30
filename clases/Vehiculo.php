<?php

class Vehiculo
{
    private $_patente;
    private $_color;
    private $_marca;

    function __construct($patente,$color,$marca)
    {
        $this->_patente = $patente;
        $this->_color = $color;
        $this->_marca = $marca;
    }

    function ToString()
    {
        echo "Patente: ".$this->_patente." - Color: ".$this->_color." - Marca: ".$this->_marca; 
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
        return $this->marca;
    }

    function SetPatente($value)
    {
        $this->_patente = $value;
    }

    function SetColor($value)
    {
        $this->_color = $value;
    }

    function SetMarca($value)
    {
        $this->_marca = $value;
    }
}




?>