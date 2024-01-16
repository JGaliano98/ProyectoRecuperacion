<?php
class Horario_Asignatura {
    private $ID;
    private $ID_Horario;
    private $ID_Asignatura;

    // Constructor
    public function __construct($ID, $ID_Horario, $ID_Asignatura) {
        $this->ID = $ID;
        $this->ID_Horario = $ID_Horario;
        $this->ID_Asignatura = $ID_Asignatura;
    }

    // Getters
    public function getID() {
        return $this->ID;
    }

    public function getIDHorario() {
        return $this->ID_Horario;
    }

    public function getIDAsignatura() {
        return $this->ID_Asignatura;
    }

    // Setters
    public function setIDHorario($ID_Horario) {
        $this->ID_Horario = $ID_Horario;
    }

    public function setIDAsignatura($ID_Asignatura) {
        $this->ID_Asignatura = $ID_Asignatura;
    }
}
?>
