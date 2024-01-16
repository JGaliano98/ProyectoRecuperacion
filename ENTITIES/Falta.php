<?php
class Falta {
    private $ID;
    private $fecha;
    private $estado;
    private $ID_Usuario;
    private $ID_Justificacion;

    // Constructor
    public function __construct($ID, $fecha, $estado, $ID_Usuario, $ID_Justificacion) {
        $this->ID = $ID;
        $this->fecha = $fecha;
        $this->estado = $estado;
        $this->ID_Usuario = $ID_Usuario;
        $this->ID_Justificacion = $ID_Justificacion;
    }

    // Getters
    public function getID() {
        return $this->ID;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getIDUsuario() {
        return $this->ID_Usuario;
    }

    public function getIDJustificacion() {
        return $this->ID_Justificacion;
    }

    // Setters
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setIDUsuario($ID_Usuario) {
        $this->ID_Usuario = $ID_Usuario;
    }

    public function setIDJustificacion($ID_Justificacion) {
        $this->ID_Justificacion = $ID_Justificacion;
    }
}
?>
