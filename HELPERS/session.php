<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

class session{

    public static function iniciarSesion(){

        session_start();
    }

    public static function cerrarSesion(){

        session_start();
        session_destroy();
    }

    public static function guardarSesion($clave, $objeto){

        $_SESSION[$clave] = $objeto;
    }

    public static function leerSesion($clave){

        return $_SESSION[$clave];
    }

    public static function existeSesion($clave){

        return isset($_SESSION[$clave]);
    }


}



?>