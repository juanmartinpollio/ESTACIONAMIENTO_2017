<?php

class Empleado
{
    private $_usuario;
    private $_nombre;
    private $_apellido;
    private $_password;
    private $_turno;

    function __construct($usuario,$nombre,$apellido,$password,$turno)
    {
        $this->_usuario = $usuario;
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_password = $password;
        $this->_turno = $turno;
    }
}

?>