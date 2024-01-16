<?php
class Usuario_Horario {
    private $ID;
    private $ID_Usuario;
    private $ID_Horario;

    // Constructor
    public function __construct($ID, $ID_Usuario, $ID_Horario) {
        $this->ID = $ID;
        $this->ID_Usuario = $ID_Usuario;
        $this->ID_Horario = $ID_Horario;
    }

    // Getters
    public function getID() {
        return $this->ID;
    }

    public function getIDUsuario() {
        return $this->ID_Usuario;
    }

    public function getIDHorario() {
        return $this->ID_Horario;
    }

    // Setters
    public function setIDUsuario($ID_Usuario) {
        $this->ID_Usuario = $ID_Usuario;
    }

    public function setIDHorario($ID_Horario) {
        $this->ID_Horario = $ID_Horario;
    }
}
?>
