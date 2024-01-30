<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $obj=json_decode(file_get_contents("php://input"));

    // Obtiene los valores del formulario
    $ID = 2;
    $motivo = $obj->observacionesJust;
    $fecha = $obj->fechaJust;

    // Manejo del archivo PDF
    $rutaArchivo = null;
    if (isset($_FILES['documento'])) {
        $pdfFile = $_FILES['documento'];


        // Guardar archivo en el sistema de archivos
        $destination = '/ProyectoRecuperacion/STYLES/DOCUMENTOS/' . $pdfFile['justificacion'];
        if (move_uploaded_file($pdfFile['tmp_name'], $destination)) {
            $rutaArchivo = $destination; // La ruta del archivo almacenado
        } else {
            // Manejar el error al mover el archivo
            echo "Error";
        }
    }

    $justificacionOBJ = new Justificacion($ID,$fecha,$motivo,$rutaArchivo);

    RP_Justificacion::InsertaObjeto($justificacionOBJ);

    // Establece el código de estado HTTP (en este caso, 200 OK)
    http_response_code(200);

    // Retorna la respuesta
    echo json_encode(array("mensaje" => "Datos y archivo subidos correctamente"));
}

?>