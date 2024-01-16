<?php
class Usuario {
    private $ID;
    private $DNI;
    private $Nombre;
    private $Apellido1;
    private $Apellido2;
    private $Telefono;
    private $Correo;
    private $Rol;
    private $Foto;
    private $Curso;
    private $Contraseña;

    // Constructor
    public function __construct($ID, $DNI, $Nombre, $Apellido1, $Apellido2, $Telefono, $Correo, $Rol, $Foto, $Curso, $Contraseña) {
        $this->ID = $ID;
        $this->DNI = $DNI;
        $this->Nombre = $Nombre;
        $this->Apellido1 = $Apellido1;
        $this->Apellido2 = $Apellido2;
        $this->Telefono = $Telefono;
        $this->Correo = $Correo;
        $this->Rol = $Rol;
        $this->Foto = $Foto;
        $this->Curso = $Curso;
        $this->Contraseña = $Contraseña;
    }

    // Getters
    public function getID() {
        return $this->ID;
    }

    public function getDNI() {
        return $this->DNI;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function getApellido1() {
        return $this->Apellido1;
    }

    public function getApellido2() {
        return $this->Apellido2;
    }

    public function getTelefono() {
        return $this->Telefono;
    }

    public function getCorreo() {
        return $this->Correo;
    }

    public function getCurso() {
        return $this->Curso;
    }

    public function getRol() {
        return $this->Rol;
    }

    public function getFoto() {
        return $this->Foto;
    }

    public function getContraseña() {
        return $this->Contraseña;
    }

    // Setters
    public function setDNI($DNI) {
        $this->DNI = $DNI;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function setApellido1($Apellido1) {
        $this->Apellido1 = $Apellido1;
    }

    public function setApellido2($Apellido2) {
        $this->Apellido2 = $Apellido2;
    }

    public function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }

    public function setCorreo($Correo) {
        $this->Correo = $Correo;
    }

    public function setCurso($Curso) {
        $this->Curso = $Curso;
    }

    public function setRol($Rol) {
        $this->Rol = $Rol;
    }

    public function setFoto($Foto) {
        $this->Foto = $Foto;
    }

    public function setContraseña($Contraseña) {
        $this->Contraseña = $Contraseña;
    }
}
?>
