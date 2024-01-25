<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

class RP_Falta {

    public static function MostrarTodo() {
        $conexion = Conexion::AbreConexion();
        $array = [];

        $resultado = $conexion->query("SELECT * FROM falta");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;

            $falta = new Falta($ID, $fecha, $estado,  $ID_usuario , $ID_justificacion);
            $array[] = $falta;
        }

        return $array;
    }



    public static function MostrarJustificadas() {
        $conexion = Conexion::AbreConexion();
        $array = [];

        $resultado = $conexion->query("SELECT * FROM falta where estado='Justificada'");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;

            $falta = new Falta($ID, $fecha, $estado, $ID_usuario, $ID_justificacion);
            $array[] = $falta;
        }

        return $array;
    }

    public static function MostrarInjustificadasPorUsuario($ID) {
        $conexion = Conexion::AbreConexion();
        $array = [];

        $resultado = $conexion->query("SELECT * FROM falta where estado='Injustificada' and ID_Usuario=$ID");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;

            $falta = new Falta($ID, $fecha, $estado, $ID_usuario, $ID_justificacion);
            $array[] = $falta;
        }

        return $array;
    }

    public static function MostrarInjustificadasPorUsuarioOBJ($ID) {
        $conexion = Conexion::AbreConexion();
        $array = [];

        $resultado = $conexion->query("SELECT * FROM falta where estado='Injustificada' and ID_Usuario=$ID");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;

            $falta = new Falta($ID, $fecha, $estado, $ID_usuario, $ID_justificacion);
            //$array[] = $falta;
        }

        return $falta;
    }

    public static function MostrarTodasLasFaltas() {
        $conexion = Conexion::AbreConexion();
        $array = [];

        $resultado = $conexion->query(

        "SELECT falta.*, usuario.ID, usuario.DNI, usuario.Nombre, usuario.Apellido1, usuario.Apellido2, usuario.Telefono, usuario.Correo, usuario.Rol, usuario.Foto, usuario.Curso, usuario.Contraseña
        FROM falta
        INNER JOIN usuario ON falta.ID_Usuario = usuario.ID;"
        
        );

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_justificacion;
            $ID_usuario = $tuplas->ID_usuario;
            $DNIusuario = $tuplas -> DNI;

            $falta = new Falta($ID, $fecha, $estado, $ID_justificacion, $ID_usuario);
            $array[] = $falta;
        }

        return $array;
    }

    public static function BuscarPorID($id) {
        $conexion = Conexion::AbreConexion();
        $resultado = $conexion->query("SELECT * FROM falta WHERE ID = $id");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_justificacion;
            $ID_usuario = $tuplas->ID_usuario;

            $falta = new Falta($ID, $fecha, $estado, $ID_justificacion, $ID_usuario);
        }

        return $falta;
    }

    public static function BuscarPorUsuario($id) {
        $conexion = Conexion::AbreConexion();
        $resultado = $conexion->query("SELECT * FROM falta WHERE ID_Usuario = $id");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;

            $falta = new Falta($ID, $fecha, $estado, $ID_usuario, $ID_justificacion);
            $array[] = $falta;
        }

        return $array;
    }


    public static function InsertaObjeto($objeto) {
        $conexion = Conexion::AbreConexion();

        $fecha = $objeto->getFecha();
        $estado = $objeto->getEstado();
        $ID_justificacion = $objeto->getID_Justificacion();
        $ID_usuario = $objeto->getID_Usuario();

        $conexion->exec("INSERT INTO falta (fecha, estado, ID_justificacion, ID_usuario) VALUES ('$fecha', '$estado', '$ID_justificacion', '$ID_usuario')");
    }

    public static function ActualizaPorID($id, $objeto) {
        $conexion = Conexion::AbreConexion();

        $fecha = $objeto->getFecha();
        $estado = $objeto->getEstado();
        $ID_justificacion = $objeto->getID_Justificacion();
        $ID_usuario = $objeto->getID_Usuario();

        $conexion->exec("UPDATE falta SET fecha = '$fecha', estado = '$estado', ID_justificacion = '$ID_justificacion', ID_usuario = '$ID_usuario' WHERE ID = $id");
    }

    public static function BorraPorID($id) {
        $conexion = Conexion::AbreConexion();
        $conexion->exec("DELETE FROM falta WHERE ID = $id");
    }


}
?>
