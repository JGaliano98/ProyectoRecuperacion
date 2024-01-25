<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

$nuevoAlumno = isset($_POST['btnNuevoAlumno']);
$eliminarAlumno = isset($_POST['btnEliminarAlumno']);
$actualizaAlumno = isset($_POST['btnActualizarAlumno']);
$faltas = isset($_POST['btnFaltas']);
$cerrarSesion = isset($_POST['btnCerrarSesion']);

if($nuevoAlumno){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=nuevoAlumno');
}

if($eliminarAlumno){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=borraAlumno');
}

if($actualizaAlumno){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=actualizaAlumno');
}

if($faltas){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=faltas');
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
                    <input type="submit" value="Crear nuevo Alumno" name="btnNuevoAlumno" id="btnCrearConvocatoria">
                </div>
                <div id="divbtnVerConvocatorias">
                    <input type="submit" value="Ver y Eliminar Alumnos" name="btnEliminarAlumno" id="btnVerConvocatoria">
                </div>
                <div id="divbtnActualizarConvocatorias">
                    <input type="submit" value="Actualizar Alumno" name="btnActualizarAlumno" id="btnActualizarConvocatoria">
                </div>
                <div id="divbtnBaremar">
                    <input type="submit" value="Faltas" name="btnFaltas" id="btnBaremarConvocatoria">
                </div>
                <div id="divbtnCerrarSesion">
                    <input type="submit" value="Cerrar Sesión" name="btnCerrarSesion" id="btnCerrarSesion">
                </div>

            </div>

        </form>
    </div>