<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

$crearConvocatoria = isset($_POST['btnCrearConvocatoria']);
$verConvocatoria = isset($_POST['btnVerConvocatoria']);
$actualizarConvocatoria = isset($_POST['btnActualizarConvocatoria']);
$baremarConvocatoria = isset($_POST['btnBaremarConvocatoria']);
$cerrarSesion = isset($_POST['btnCerrarSesion']);

if($crearConvocatoria){
    
    header('Location:/ProyectoErasmus/index.php?menu=crearConv');
}

if($verConvocatoria){
    
    header('Location:/ProyectoErasmus/index.php?menu=verConv');
}

if($actualizarConvocatoria){
    
    header('Location:/ProyectoErasmus/index.php?menu=actualizarConv');
}

if($baremarConvocatoria){
    
    header('Location:/ProyectoErasmus/index.php?menu=baremarConvocatorias');
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
                <div id="divbtnCrearConvocatoria">
                    <input type="submit" value="Crear nueva convocatoria" name="btnCrearConvocatoria" id="btnCrearConvocatoria">
                </div>
                <div id="divbtnVerConvocatorias">
                    <input type="submit" value="Ver y Eliminar Convocatorias" name="btnVerConvocatoria" id="btnVerConvocatoria">
                </div>
                <div id="divbtnActualizarConvocatorias">
                    <input type="submit" value="Actualizar Convocatorias" name="btnActualizarConvocatoria" id="btnActualizarConvocatoria">
                </div>
                <div id="divbtnBaremar">
                    <input type="submit" value="Baremar Convocatorias" name="btnBaremarConvocatoria" id="btnBaremarConvocatoria">
                </div>
                <div id="divbtnCerrarSesion">
                    <input type="submit" value="Cerrar Sesión" name="btnCerrarSesion" id="btnCerrarSesion">
                </div>

            </div>

        </form>
    </div>