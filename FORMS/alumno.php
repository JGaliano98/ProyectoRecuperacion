<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

$ID=$_GET['ID'];


$justificarFaltas = isset($_POST['btnJustificar']);
$verFaltas = isset($_POST['btnConsultar']);

$cerrarSesion = isset($_POST['btnCerrarSesion']);

if($justificarFaltas){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=verInjustificadasIndividual&&ID='.$ID);
}

if($verFaltas){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=verFaltasIndividual&&ID='.$ID);
}


if($cerrarSesion){

    session::cerrarSesion();

    header('Location:/ProyectoRecuperacion/index.php?menu=login');
    
}



?>

<div class="contenidoAlumno">
        <form method="post">

            <div id="divTituloAlumno">
                <label id="tituloAlumno">BIENVENIDO ALUMNO </label>
            </div>

            <div id="divBotonesAlumno">
                <div id="divbtnVerSolicitudes">
                    <input type="submit" value="Consultar faltas de asistencia" name="btnConsultar" id="btnVerSolicitudes">
                </div>
                <div id="divbtnbtnVerEstado">
                    <input type="submit" value="Justificar faltas de asistencia" name="btnJustificar" id="btnVerEstado">
                </div>
                
                <div id="divbtnCerrarSesion">
                    <input type="submit" value="Cerrar Sesión" name="btnCerrarSesion" id="btnCerrarSesion">
                </div>

            </div>

        </form>
    </div>