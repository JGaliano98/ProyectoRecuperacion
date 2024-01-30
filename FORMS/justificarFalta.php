<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

$ID=$_GET['ID'];
$ID_falta = $_GET["IDfalta"];
$fecha_falta = $_GET['Fecha'];

?>



<form method="post">

    <div id="divTitulo">
        <label id="tituloLogin">JUSTIFICAR FALTA DE ASISTENCIA</label>
    </div>

    <input type="hidden" name="idFalta" value="<?php echo $ID_Falta; ?>">

    

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
