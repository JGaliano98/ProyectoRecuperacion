<?php
class Horario {
    private $ID;
    private $ID_Usuario;
    private $ID_Asignatura;
    private $hora_inicio;
    private $hora_fin;
    private $dia;

    // Constructor
    public function __construct($ID, $ID_Usuario, $ID_Asignatura, $hora_inicio, $hora_fin, $dia) {
        $this->ID = $ID;
        $this->ID_Usuario = $ID_Usuario;
        $this->ID_Asignatura = $ID_Asignatura;
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = $hora_fin;
        $this->dia = $dia;
    }

    // Getters
    public function getID() {
        return $this->ID;
    }

    public function getIDUsuario() {
        return $this->ID_Usuario;
    }

    public function getIDAsignatura() {
        return $this->ID_Asignatura;
    }

    public function getHoraInicio() {
        return $this->hora_inicio;
    }

    public function getHoraFin() {
        return $this->hora_fin;
    }

    public function getDia() {
        return $this->dia;
    }

    // Setters
    public function setIDUsuario($ID_Usuario) {
        $this->ID_Usuario = $ID_Usuario;
    }

    public function setIDAsignatura($ID_Asignatura) {
        $this->ID_Asignatura = $ID_Asignatura;
    }

    public function setHoraInicio($hora_inicio) {
        $this->hora_inicio = $hora_inicio;
    }

    public function setHoraFin($hora_fin) {
        $this->hora_fin = $hora_fin;
    }

    public function setDia($dia) {
        $this->dia = $dia;
    }
}
?>
