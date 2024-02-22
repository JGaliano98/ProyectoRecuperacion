<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();


$ID_falta = $_GET["IDfalta"];
$fecha_falta = $_GET['Fecha'];

$IDJustificacion = $_GET['IDJustifi'];



$obj = RP_Justificacion::BuscarPorID($IDJustificacion);


$rutaDocumento = $obj->getDocumento();


?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    #divTitulo {
        text-align: center;
        margin: 20px 0;
    }

    #tituloLogin {
        font-size: 24px;
        color: #007bff;
    }

    form {
        background-color: white;
        padding: 20px;
        margin: auto;
        width: 60%;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    label {
        font-weight: bold;
    }

    input[type=datetime], textarea {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    #btnJustifProfesor, button[name="ATRAS"] {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-right: 10px;
    }

    #btnJustifProfesor:hover, button[name="ATRAS"]:hover {
        background-color: #0056b3;
    }
</style>




<form method="post" enctype="multipart/form-data">

    <div id="divTitulo">
        <label id="tituloLogin">JUSTIFICAR FALTA DE ASISTENCIA</label>
    </div>

    <input type="hidden" name="idFalta" id="idFalta" value="<?php echo $ID_falta; ?>">
    
    <label id="lblfecha">Fecha:</label><br>
    <input type="datetime" id="fecha" name="fechaJust" value="<?php echo $fecha_falta; ?>"><br><br>

    <label id="obser">Observaciones:</label><br>
    <textarea id="observaciones" name="observacionesJust" rows="4" cols="50"><?php echo $obj->getMotivo(); ?></textarea><br><br>


    


    <label id="lblNotas">Visualizar Documento (JPG o PDF):</label><br>
    <a href="<?php echo 'ProyectoRecuperacion/' . htmlspecialchars($rutaDocumento); ?>" target="_blank">Visualizar Documento</a>


    
    <div>
    </div><br>
    <div id="contenedor">

    <button type="submit" id="btnJustifProfesor" name="btnJustifProfesor">Justificar</button>
    <button type="submit" name="ATRAS" >Atrás</button>
</form>

<?php

$btnJustifProfesor = isset($_POST['btnJustifProfesor']);

$atras = isset($_POST['ATRAS']);








if (isset($_POST['btnJustifProfesor'])) {
    
    RP_Falta::ActualizaEstadoDeFaltaPorID($IDJustificacion, 'Justificada', $ID_falta);

    echo("Justificada con éxito");

}
if($atras){

    header('Location:/ProyectoRecuperacion/index.php?menu=justificarFaltas');

}

?>