<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

class funcionesRegistro {

    public static function registraUsuario($objeto){

       
        RP_Usuario::InsertaObjeto($objeto);

        echo "Registrado con éxito";

    }
}

?>