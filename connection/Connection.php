<?php

class Connection extends Mysqli{

    private $host = 'localhost';
    private $usuario = 'root';
    private $contrasenia = '';
    private $baseDatos = 'api_rest';

    function __construct()
    {
        parent::__construct($this->host,$this->usuario,$this->contrasenia,$this->baseDatos);
        $this->set_charset('utf8');

        if($this->connect_error == null)
        {
            echo '<br>coneccion exitosa';
        }else{
            echo '<br>ERROR al conectarse';
        }

    }
}




