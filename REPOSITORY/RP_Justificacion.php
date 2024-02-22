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
            $fecha = $tuplas->fecha;
            $motivo = $tuplas->motivo;
            $documento = $tuplas->documento;
            

            $justificacion = new Justificacion($ID, $fecha,  $motivo,  $documento);
            $array[] = $justificacion;
        }

        return $array;
    }

    public static function BuscarPorID($id) {
        $conexion = Conexion::AbreConexion();
        $resultado = $conexion->query("SELECT * FROM justificacion WHERE ID = $id");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $motivo = $tuplas->motivo;
            $documento = $tuplas->documento;
            

            $justificacion = new Justificacion($ID, $fecha,  $motivo,  $documento);
            //$array[] = $justificacion;
        }

        return $justificacion;
    }

    public static function InsertaObjeto($objeto) {
        $conexion = Conexion::AbreConexion();
    
        $fecha = $objeto->getFecha();
        $motivo = $objeto->getMotivo();
        $documento = $objeto->getDocumento();
    
        $stmt = $conexion->prepare("INSERT INTO justificacion (fecha, motivo, documento) VALUES (?, ?, ?)");
        $stmt->execute([$fecha, $motivo, $documento]);
    
        $ultimoId = $conexion->lastInsertId();
    
       
        return $ultimoId;
    }
    
    

    public static function ActualizaPorID($id, $objeto) {
        $conexion = Conexion::AbreConexion();

        $fecha = $objeto->getFecha();
        $documento = $objeto->getDocumento();
        $motivo = $objeto->getMotivo();

        $conexion->exec("UPDATE justificacion SET fecha = '$fecha', documento = '$documento', motivo = '$motivo' WHERE ID = $id");
    }

    public static function BorraPorID($id) {
        $conexion = Conexion::AbreConexion();
        $conexion->exec("DELETE FROM justificacion WHERE ID = $id");
    }

}
?>