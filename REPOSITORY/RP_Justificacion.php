<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

class RP_Justificacion {

    public static function MostrarTodo() {
        $conexion = Conexion::AbreConexion();
        $array = [];

        $resultado = $conexion->query("SELECT * FROM justificacion");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha_justificacion = $tuplas->fecha_justificacion;
            $documento = $tuplas->documento;
            $motivo = $tuplas->motivo;

            $justificacion = new Justificacion($ID, $fecha_justificacion, $documento, $motivo);
            $array[] = $justificacion;
        }

        return $array;
    }

    public static function BuscarPorID($id) {
        $conexion = Conexion::AbreConexion();
        $resultado = $conexion->query("SELECT * FROM justificacion WHERE ID = $id");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha_justificacion = $tuplas->fecha_justificacion;
            $documento = $tuplas->documento;
            $motivo = $tuplas->motivo;

            $justificacion = new Justificacion($ID, $fecha_justificacion, $documento, $motivo);
        }

        return $justificacion;
    }

    public static function InsertaObjeto($objeto) {
        $conexion = Conexion::AbreConexion();

        $fecha_justificacion = $objeto->getFechaJustificacion();
        $documento = $objeto->getDocumento();
        $motivo = $objeto->getMotivo();

        $conexion->exec("INSERT INTO justificacion (fecha_justificacion, documento, motivo) VALUES ('$fecha_justificacion', '$documento', '$motivo')");
    }

    public static function ActualizaPorID($id, $objeto) {
        $conexion = Conexion::AbreConexion();

        $fecha_justificacion = $objeto->getFechaJustificacion();
        $documento = $objeto->getDocumento();
        $motivo = $objeto->getMotivo();

        $conexion->exec("UPDATE justificacion SET fecha_justificacion = '$fecha_justificacion', documento = '$documento', motivo = '$motivo' WHERE ID = $id");
    }

    public static function BorraPorID($id) {
        $conexion = Conexion::AbreConexion();
        $conexion->exec("DELETE FROM justificacion WHERE ID = $id");
    }

}
?>
