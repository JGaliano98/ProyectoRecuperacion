<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

class RP_Usuario {

    public static function MostrarTodo() {
        $conexion = Conexion::AbreConexion();
        $array = [];

        $resultado = $conexion->query("SELECT * FROM usuario");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID_Usuario = $tuplas->ID;
            $DNI = $tuplas->DNI;
            $nombre = $tuplas->nombre;
            $apellido1 = $tuplas->apellido1;
            $apellido2 = $tuplas->apellido2;
            $telefono = $tuplas->telefono;
            $correo = $tuplas->correo;
            $rol = $tuplas->rol;
            $foto = $tuplas->foto;
            $curso = $tuplas->curso;
            $contraseña = $tuplas->contraseña;

            $usuario = new Usuario($ID_Usuario, $DNI, $nombre, $apellido1, $apellido2, $telefono, $correo, $rol, $foto, $curso, $contraseña);
            $array[] = $usuario;
        }


        return $array;
    }

    public static function MostrarTodoAlumnos() {
        $conexion = Conexion::AbreConexion();
        $array = [];

        $resultado = $conexion->query("SELECT * FROM usuario where rol='Alumno'");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID_Usuario = $tuplas->ID;
            $DNI = $tuplas->DNI;
            $nombre = $tuplas->nombre;
            $apellido1 = $tuplas->apellido1;
            $apellido2 = $tuplas->apellido2;
            $telefono = $tuplas->telefono;
            $correo = $tuplas->correo;
            $rol = $tuplas->rol;
            $foto = $tuplas->foto;
            $curso = $tuplas->curso;
            $contraseña = $tuplas->contraseña;

            $usuario = new Usuario($ID_Usuario, $DNI, $nombre, $apellido1, $apellido2, $telefono, $correo, $rol, $foto, $curso, $contraseña);
            $array[] = $usuario;
        }


        return $array;
    }

    public static function BuscarPorID($id) {
        $conexion = Conexion::AbreConexion();
        $resultado = $conexion->query("SELECT * FROM Usuario WHERE ID=$id");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID_Usuario = $tuplas->ID;
            $DNI = $tuplas->DNI;
            $nombre = $tuplas->nombre;
            $apellido1 = $tuplas->apellido1;
            $apellido2 = $tuplas->apellido2;
            $telefono = $tuplas->telefono;
            $correo = $tuplas->correo;
            $rol = $tuplas->rol;
            $foto = $tuplas->foto;
            $curso = $tuplas->curso;
            $contraseña = $tuplas->contraseña;

            $usuario = new Usuario($ID_Usuario, $DNI, $nombre, $apellido1, $apellido2, $telefono, $correo, $rol, $foto, $curso, $contraseña);
        }


        return $usuario;
    }

    public static function BuscarPorNombreCompleto($nombre, $apellido1, $apellido2) {
        $conexion = Conexion::AbreConexion();
        $consulta = $conexion->prepare("SELECT * FROM Usuario WHERE nombre = :nombre AND apellido1 = :apellido1 AND apellido2 = :apellido2");
        
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':apellido1', $apellido1);
        $consulta->bindParam(':apellido2', $apellido2);
        
        $consulta->execute();
    
        $tupla = $consulta->fetch(PDO::FETCH_OBJ);
        if ($tupla) {
            $usuario = new Usuario(
                $tupla->ID,
                $tupla->DNI,
                $tupla->nombre,
                $tupla->apellido1,
                $tupla->apellido2,
                $tupla->telefono,
                $tupla->correo,
                $tupla->rol,
                $tupla->foto,
                $tupla->curso,
                $tupla->contraseña
            );
            return $usuario;
        }
    
        return null; // Devuelve null si no se encuentra ningún usuario
    }
    
    

    public static function BuscarPorDNI($DNI) {
        $conexion = Conexion::AbreConexion();
        $resultado = $conexion->query("SELECT * FROM Usuario WHERE DNI = '$DNI'");
        $usuario=null;

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID_Usuario = $tuplas->ID;
            $DNI = $tuplas->DNI;
            $nombre = $tuplas->nombre;
            $apellido1 = $tuplas->apellido1;
            $apellido2 = $tuplas->apellido2;
            $telefono = $tuplas->telefono;
            $correo = $tuplas->correo;
            $rol = $tuplas->rol;
            $foto = $tuplas->foto;
            $curso = $tuplas->curso;
            $contraseña = $tuplas->contraseña;

            $usuario = new Usuario($ID_Usuario, $DNI, $nombre, $apellido1, $apellido2, $telefono, $correo, $rol, $foto, $curso, $contraseña);
        }


        return $usuario;
    }

    public static function BorraPorID($id) {
        $conexion = Conexion::AbreConexion();
        $conexion->exec("DELETE FROM Usuario WHERE ID=$id");
    }

    public static function ActualizaPorID($id, $objeto) {
        $conexion = Conexion::AbreConexion();
        $conexion->exec("UPDATE Usuario SET ID='{$objeto->getID()}', DNI='{$objeto->getDNI()}', nombre='{$objeto->getNombre()}', apellido1='{$objeto->getApellido1()}', apellido2='{$objeto->getApellido2()}', telefono='{$objeto->getTelefono()}', correo='{$objeto->getCorreo()}', rol='{$objeto->getRol()}', foto='{$objeto->getFoto()}', curso='{$objeto->getCurso()}', contraseña='{$objeto->getContraseña()}' WHERE ID={$id}");

    }


    public static function InsertaObjeto($objeto) {
        $conexion = Conexion::AbreConexion();
    
        $ID_Usuario = 0;
        $DNI = $objeto->getDNI();
        $nombre = $objeto->getNombre();
        $apellido1 = $objeto->getApellido1();
        $apellido2 = $objeto->getApellido2();
        $telefono = $objeto->getTelefono();
        $correo = $objeto->getCorreo();
        $rol = $objeto->getRol();
        $foto = $objeto->getFoto();
        $curso = $objeto->getCurso();
        $contraseña = $objeto->getContraseña();
    
        $conexion->exec ("INSERT INTO Usuario (ID, DNI, nombre, apellido1, apellido2, telefono, correo, rol, foto, curso, contraseña) VALUES ('$ID_Usuario', '$DNI', '$nombre', '$apellido1', '$apellido2', '$telefono', '$correo', '$rol', '$foto', '$curso', '$contraseña')");

    }

    public static function existeUsuario($DNI){


        $resultado = RP_Usuario::BuscarPorDNI($DNI);

        if ($resultado!=null){
            if ($resultado->getDNI() == $DNI){
                return true;
            } else{
                return false;
            }
        }else{
            return false;
        }    
    }
    
    
}
?>
