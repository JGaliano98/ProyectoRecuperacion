<?php
class Falta {
    private $ID;
    private $fecha;
    private $estado;
    private $ID_Usuario;
    private $ID_Justificacion;
    private $nombreUsuario;
    private $ape1Usuario;
    private $ape2Usuario;

    // Constructor
    public function __construct($ID, $fecha, $estado, $ID_Usuario, $ID_Justificacion, $nombreUsuario = null, $ape1Usuario = null, $ape2Usuario = null) {
        $this->ID = $ID;
        $this->fecha = $fecha;
        $this->estado = $estado;
        $this->ID_Usuario = $ID_Usuario;
        $this->ID_Justificacion = $ID_Justificacion;
        $this->nombreUsuario = $nombreUsuario; // Inicializar con el nombre del usuario
        $this->ape1Usuario = $ape1Usuario; // Inicializar con el primer apellido
        $this->ape2Usuario = $ape2Usuario; // Inicializar con el segundo apellido
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


    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function getApe1Usuario() {
        return $this->ape1Usuario;
    }

    public function getApe2Usuario() {
        return $this->ape2Usuario;
    }

    public function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function setApe1Usuario($ape1Usuario) {
        $this->ape1Usuario = $ape1Usuario;
    }

    public function setApe2Usuario($ape2Usuario) {
        $this->ape2Usuario = $ape2Usuario;
    }
}
?>
