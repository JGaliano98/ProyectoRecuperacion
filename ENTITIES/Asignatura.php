<?php
class Asignatura {
    private $ID;
    private $Nombre;

    // Constructor
    public function __construct($ID, $Nombre) {
        $this->ID = $ID;
        $this->Nombre = $Nombre;
    }

    // Getters
    public function getID() {
        return $this->ID;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    // Setters
    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }
}
?>
