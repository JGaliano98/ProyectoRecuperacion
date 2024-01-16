<?php
class Justificacion {
    private $ID;
    private $fecha;
    private $motivo;
    private $documento;

    // Constructor
    public function __construct($ID, $fecha, $motivo, $documento) {
        $this->ID = $ID;
        $this->fecha = $fecha;
        $this->motivo = $motivo;
        $this->documento = $documento;
    }

    // Getters
    public function getID() {
        return $this->ID;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getMotivo() {
        return $this->motivo;
    }

    public function getDocumento() {
        return $this->documento;
    }


    // Setters
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setMotivo($motivo) {
        $this->motivo = $motivo;
    }

    public function setDocumento($documento) {
        $this->documento = $documento;
    }
}
?>
