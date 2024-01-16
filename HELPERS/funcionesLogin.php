<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

    class funcionesLogin{
        
        public static function existeUsuario($DNI, $contraseña){
            // Obtiene los datos de la base de datos
            $datos = RP_Usuario::MostrarTodo();
            
            // Inicializa una variable para indicar si el usuario y la contraseña coinciden
            $existe = false;
            
            // Itera sobre los objetos en el array de datos
            foreach ($datos as $dato) {
                if ($dato->getDNI() == $DNI && $dato->getContraseña() == $contraseña) {
                    // Si hay coincidencia, cambia la variable a verdadero y termina el bucle
                    $existe = true;
                    break;
                }
            }
            
            // Devuelve true si se encuentra una coincidencia, de lo contrario, devuelve false
            return $existe;
        }   


        public static function logIn($user)
        {
            session::iniciarSesion();
            session::guardarSesion('usuario', $user); 
        }

        public static function estaLogueado($clave)
        {
            return session::existeSesion($clave);
        }

        public static function logOut($ruta)
        {
            session::cerrarSesion();

            if(!empty($ruta))
            {
                header("Location: $ruta");
                exit;
            }
        }
        


    }

?>