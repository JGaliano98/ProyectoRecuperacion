<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

$nuevoAlumno = isset($_POST['btnNuevoAlumno']);
$eliminarAlumno = isset($_POST['btnEliminarAlumno']);
$actualizaAlumno = isset($_POST['btnActualizarAlumno']);
$faltas = isset($_POST['btnFaltas']);
$nuevoHorario = isset($_POST['btnHorario']);
$pasarLista = isset($_POST['btnLista']);
$cerrarSesion = isset($_POST['btnCerrarSesion']);


if($faltas){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=faltasProfesor');
}


if($pasarLista){
    
    header('Location:/ProyectoRecuperacion/index.php?menu=pasaLista');
}

if($cerrarSesion){

    session::cerrarSesion();

    header('Location:/ProyectoRecuperacion/index.php?menu=login');
    
}



?>

<div class="contenidoAdministrador">
        <form method="post">

            <div id="divTituloAdministrador">
                <label id="tituloAdministrador">BIENVENIDO PROFESOR</label>
            </div>

            <div id="divBotonesAdministrador">
                
                <div id="divbtnBaremar">
                    <input type="submit" value="Faltas" name="btnFaltas" id="btnBaremarConvocatoria">
                </div>
               
                <div id="divbtnPasarLista">
                    <input type="submit" value="Pasar Lista" name="btnLista" id="btnPasarLista">
                </div>
                <div id="divbtnCerrarSesion">
                    <input type="submit" value="Cerrar Sesión" name="btnCerrarSesion" id="btnCerrarSesion">
                </div>

            </div>

        </form>
    </div>