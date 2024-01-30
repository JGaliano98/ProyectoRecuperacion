<?php
if (isset($_GET['menu'])) {
    $rutaBase = $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/';

    if ($_GET['menu'] == "login") {
        require_once $rutaBase . '/Forms/loginForm.php';
    }
    if ($_GET['menu'] == "registro") {
        require_once $rutaBase . '/Forms/registroForm.php';
    }
    if ($_GET['menu'] == "tutor") {
        require_once $rutaBase . '/Forms/tutor.php';
    }
    if ($_GET['menu'] == "profesor") {
        require_once $rutaBase . '/Forms/profesor.php';
    }
    if ($_GET['menu'] == "alumno") {
        require_once $rutaBase . '/Forms/alumno.php'; 
    }
    if ($_GET['menu'] == "nuevoAlumno") {
        require_once $rutaBase . '/Forms/nuevoAlumno.php';
    }
    if ($_GET['menu'] == "borraAlumno") {
        require_once $rutaBase . '/Forms/borraAlumno.php';
    }
    if ($_GET['menu'] == "actualizaAlumno") {
        require_once $rutaBase . '/Forms/actualizaAlumno.php';
    }
    if ($_GET['menu'] == "faltas") {
        require_once $rutaBase . '/Forms/faltas.php';
    }
    if ($_GET['menu'] == "verTodasFaltas") {
        require_once $rutaBase . '/Forms/verTodasFaltas.php';
    }
    if ($_GET['menu'] == "verFaltasJustificadas") {
        require_once $rutaBase . '/Forms/verFaltasJustificadas.php';
    }
    if ($_GET['menu'] == "verFaltasIndividual") {
        require_once $rutaBase . '/Forms/verFaltasIndividual.php';
    }
    if ($_GET['menu'] == "verInjustificadasIndividual") {
        require_once $rutaBase . '/Forms/verInjustificadasIndividual.php';
    }
    if ($_GET['menu'] == "justificar") {
        require_once $rutaBase . '/Forms/justificarFalta.php';
    }
    if ($_GET['menu'] == "horario") {
        require_once $rutaBase . '/JS/horario.html';
    }
    if ($_GET['menu'] == "filtroAlumno") {
        require_once $rutaBase . '/Forms/faltaAlumno.php';
    }

}