<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

$verTodas = isset($_POST['btnVerTodas']);
$verJustificadas = isset($_POST['btnVerJustificadas']);
$filtroAlumnos = isset($_POST['btnFaltasPorAlumno']);
$filtroCurso = isset($_POST['btnFaltasPorCurso']);
$filtroFechas = isset($_POST['btnFaltasPorFecha']);
$verFaltasAJustificar = isset($_POST['btnFaltasPorJustificar']);



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

if($verFaltasAJustificar){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=justificarFaltas');
}






if($cerrarSesion){


    header('Location:/ProyectoRecuperacion/index.php?menu=profesor');
    
}



?>

<div class="contenidoAdministrador">
        <form method="post">

            <div id="divTituloAdministrador">
                <label id="tituloAdministrador">BIENVENIDO PROFESOR</label>
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
                <div id="divJustificarFaltas">
                    <input type="submit" value="Ver Faltas A Justificar" name="btnFaltasPorJustificar" id="btnFaltasPorJustificar">
                </div>
                <div id="divbtnCerrarSesion">
                    <input type="submit" value="Volver" name="btnCerrarSesion" id="btnCerrarSesion">
                </div>

            </div>

        </form>
    </div>