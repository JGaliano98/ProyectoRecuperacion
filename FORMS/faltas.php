<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

$verTodas = isset($_POST['btnVerTodas']);
$verJustificadas = isset($_POST['btnVerJustificadas']);
$filtroAlumnos = isset($_POST['btnFaltasPorAlumno']);
$filtroCurso = isset($_POST['btnFaltasPorCurso']);
$filtroFechas = isset($_POST['btnFaltasPorFecha']);



$cerrarSesion = isset($_POST['btnCerrarSesion']);

if($verTodas){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=verTodasFaltas');
}

if($verJustificadas){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=verFaltasJustificadas');
}

if($filtroAlumnos){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=filtroAlumno');
}

if($filtroCurso){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=filtroCurso');
}

if($filtroFechas){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=filtroFechas');
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
                <div id="divFaltasAlumno">
                    <input type="submit" value="Ver Faltas por Alumno" name="btnFaltasPorAlumno" id="btnFaltasPorAlumno">
                </div>
                <div id="divFaltaPorCurso">
                    <input type="submit" value="Ver Faltas por Curso" name="btnFaltasPorCurso" id="btnFaltasPorCurso">
                </div>
                <div id="divFaltaPorFechas">
                    <input type="submit" value="Ver Faltas en un Intervalo de Fechas" name="btnFaltasPorFecha" id="btnFaltasPorFecha">
                </div>
                <div id="divbtnCerrarSesion">
                    <input type="submit" value="Cerrar Sesión" name="btnCerrarSesion" id="btnCerrarSesion">
                </div>

            </div>

        </form>
    </div>