<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

$ID=$_GET['ID'];
$ID_falta = $_GET["IDfalta"];
$fecha_falta = $_GET['Fecha'];

?>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4; /* Color de fondo ligero */
    }

    #divTitulo {
        text-align: center;
        margin: 20px 0;
    }

    #tituloLogin {
        font-size: 24px; /* Tamaño de la fuente para el título */
        color: #007bff; /* Color azul */
    }

    form {
        background-color: white; /* Fondo blanco para el formulario */
        padding: 20px;
        margin: auto;
        width: 60%; /* Ancho del formulario */
        border-radius: 8px; /* Bordes redondeados */
        box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Sombra sutil */
    }

    label {
        font-weight: bold; /* Negrita para las etiquetas */
    }

    input[type=datetime], textarea, input[type=file] {
        width: 100%; /* Ancho completo */
        padding: 10px; /* Espaciado interno */
        margin: 10px 0; /* Margen vertical */
        border: 1px solid #ddd; /* Borde sutil */
        border-radius: 4px; /* Bordes redondeados */
    }

    #btnJustificar, button[type=button] {
        background-color: #007bff; /* Fondo azul */
        color: white; /* Texto blanco */
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer; /* Cursor en forma de mano */
        margin-right: 10px; /* Espaciado entre botones */
    }

    #btnJustificar:hover, button[type=button]:hover {
        background-color: #0056b3; /* Azul más oscuro al pasar el cursor */
    }

    #abrirPDF {
        background-color: #28a745; /* Verde */
        margin-left: 10px; /* Espaciado a la izquierda */
    }

    #abrirPDF:hover {
        background-color: #218838; /* Verde oscuro al pasar el cursor */
    }
</style>



<form method="post">

    <div id="divTitulo">
        <label id="tituloLogin">JUSTIFICAR FALTA DE ASISTENCIA</label>
    </div>

    <input type="hidden" name="idFalta" id="idFalta" value="<?php echo $ID_falta; ?>">

    

    <label id="lblfecha">Fecha:</label><br>
    <input type="datetime" id="fecha" name="fechaJust" value="<?php echo $fecha_falta; ?>"><br><br>


    <label id="obser">Observaciones:</label><br>
    <textarea id="observaciones" name="observacionesJust" rows="4" cols="50"></textarea><br><br>

    <label id="lblNotas">Adjuntar Documento (JPG o PDF):</label><br>
    <div> <input type="file" id="documento1" name="documento" accept="image/jpeg, application/pdf">
        
        <button id="abrirPDF">Abrir PDF</button>
    </div><br>
    <div id="contenedor">



    <button type="submit" id="btnJustificar" name="btnJustif">Justificar</button>
    <button type="button" onclick="history.back();">Atrás</button>
</form>
