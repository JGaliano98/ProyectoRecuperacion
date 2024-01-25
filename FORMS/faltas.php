<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

$verTodas = isset($_POST['btnVerTodas']);
$verJustificadas = isset($_POST['btnVerJustificadas']);


$cerrarSesion = isset($_POST['btnCerrarSesion']);

if($verTodas){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=verTodasFaltas');
}

if($verJustificadas){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=verFaltasJustificadas');
}

if($cerrarSesion){

    session::cerrarSesion();

    header('Location:/ProyectoRecuperacion/index.php?menu=login');
    
}



?>

<div class="contenidoAdministrador">
        <form method="post">

            <div id="divTituloAdministrador">
                <label id="tituloAdministrador">BIENVENIDO TUTOR</label>
            </div>

            <div id="divBotonesAdministrador">
                <div id="divbtnCrearConvocatoria">
                    <input type="submit" value="Ver Todas las Faltas" name="btnVerTodas" id="btnCrearConvocatoria">
                </div>
                <div id="divbtnVerConvocatorias">
                    <input type="submit" value="Ver Faltas Justificadas" name="btnVerJustificadas" id="btnVerConvocatoria">
                </div>
                <div id="divbtnCerrarSesion">
                    <input type="submit" value="Cerrar Sesión" name="btnCerrarSesion" id="btnCerrarSesion">
                </div>

            </div>

        </form>
    </div>