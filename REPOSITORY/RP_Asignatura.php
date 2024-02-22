<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

class RP_Asignatura {

    public static function MostrarTodo() {
        $conexion = Conexion::AbreConexion();
        $array = [];

        $resultado = $conexion->query("SELECT * FROM asignatura");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $nombre = $tuplas->nombre;

            $asignatura = new Asignatura($ID, $nombre);
            $array[] = $asignatura;
        }

        return $array;
    }

    public static function BuscarPorID($id) {
        $conexion = Conexion::AbreConexion();
        $resultado = $conexion->query("SELECT * FROM asignatura WHERE ID = $id");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $nombre = $tuplas->nombre;

            $asignatura = new Asignatura($ID, $nombre);
        }

        return $asignatura;
    }

    public static function InsertaObjeto($objeto) {
        $conexion = Conexion::AbreConexion();

        $nombre = $objeto->getNombre();

        $conexion->exec("INSERT INTO asignatura (nombre) VALUES ('$nombre')");
    }

    public static function ActualizaPorID($id, $objeto) {
        $conexion = Conexion::AbreConexion();

        $nombre = $objeto->getNombre();

        $conexion->exec("UPDATE asignatura SET nombre = '$nombre' WHERE ID = $id");
    }

    public static function BorraPorID($id) {
        $conexion = Conexion::AbreConexion();
        $conexion->exec("DELETE FROM asignatura WHERE ID = $id");
    }

}
?>
