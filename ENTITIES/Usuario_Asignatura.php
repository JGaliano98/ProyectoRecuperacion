<?php
class Usuario_Asignatura {
    private $ID;
    private $ID_Usuario;
    private $ID_Asignatura;

    // Constructor
    public function __construct($ID, $ID_Usuario, $ID_Asignatura) {
        $this->ID = $ID;
        $this->ID_Usuario = $ID_Usuario;
        $this->ID_Asignatura = $ID_Asignatura;
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

    // Setters
    public function setIDUsuario($ID_Usuario) {
        $this->ID_Usuario = $ID_Usuario;
    }

    public function setIDAsignatura($ID_Asignatura) {
        $this->ID_Asignatura = $ID_Asignatura;
    }
}
?>
