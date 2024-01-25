<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

class RP_Horario {

    public static function MostrarTodo() {
        $conexion = Conexion::AbreConexion();
        $array = [];

        $resultado = $conexion->query("SELECT * FROM horario");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $ID_usuario = $tuplas->ID_usuario;
            $ID_asignatura = $tuplas->ID_asignatura;
            $hora_inicio = $tuplas->hora_inicio;
            $hora_fin = $tuplas->hora_fin;
            $dia = $tuplas->dia;

            $horario = new Horario($ID, $ID_usuario, $ID_asignatura, $hora_inicio, $hora_fin, $dia);
            $array[] = $horario;
        }

        return $array;
    }

    public static function BuscarPorID($id) {
        $conexion = Conexion::AbreConexion();
        $resultado = $conexion->query("SELECT * FROM horario WHERE ID = $id");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $ID_usuario = $tuplas->ID_usuario;
            $ID_asignatura = $tuplas->ID_asignatura;
            $hora_inicio = $tuplas->hora_inicio;
            $hora_fin = $tuplas->hora_fin;
            $dia = $tuplas->dia;

            $horario = new Horario($ID, $ID_usuario, $ID_asignatura, $hora_inicio, $hora_fin, $dia);
        }

        return $horario;
    }

    public static function InsertaObjeto($objeto) {
        $conexion = Conexion::AbreConexion();

        $ID_usuario = $objeto->getIDUsuario();
        $ID_asignatura = $objeto->getIDAsignatura();
        $hora_inicio = $objeto->getHoraInicio();
        $hora_fin = $objeto->getHoraFin();
        $dia = $objeto->getDia();

        $conexion->exec("INSERT INTO horario (ID_usuario, ID_asignatura, hora_inicio, hora_fin, dia) VALUES ('$ID_usuario', '$ID_asignatura', '$hora_inicio', '$hora_fin', '$dia')");
    }

    public static function ActualizaPorID($id, $objeto) {
        $conexion = Conexion::AbreConexion();

        $ID_usuario = $objeto->getIDUsuario();
        $ID_asignatura = $objeto->getIDAsignatura();
        $hora_inicio = $objeto->getHoraInicio();
        $hora_fin = $objeto->getHoraFin();
        $dia = $objeto->getDia();

        $conexion->exec("UPDATE horario SET ID_usuario = '$ID_usuario', ID_asignatura = '$ID_asignatura', hora_inicio = '$hora_inicio', hora_fin = '$hora_fin', dia = '$dia' WHERE ID = $id");
    }

    public static function BorraPorID($id) {
        $conexion = Conexion::AbreConexion();
        $conexion->exec("DELETE FROM horario WHERE ID = $id");
    }

}
?>
