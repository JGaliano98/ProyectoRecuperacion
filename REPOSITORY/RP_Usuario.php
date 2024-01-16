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

    public static function BuscarPorDNI($DNI) {
        $conexion = Conexion::AbreConexion();
        $resultado = $conexion->query("SELECT * FROM Usuario WHERE DNI = '$DNI'");

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
        $conexion->exec("UPDATE Usuario SET DNI='{$objeto->getDNI()}', nombre='{$objeto->getNombre()}', apellido1='{$objeto->getApellido1()}', apellido2='{$objeto->getApellido2()}', telefono='{$objeto->getTelefono()}', correo='{$objeto->getCorreo()}', rol='{$objeto->getRol()}', foto='{$objeto->getFoto()}', curso='{$objeto->getCurso()}', contraseña='{$objeto->getContraseña()}' WHERE ID={$id}");

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
    
    
}
?>