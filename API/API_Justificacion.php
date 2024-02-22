<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        try {
            $justificacion = RP_Justificacion::BuscarPorID($id);
            
            if ($justificacion) {
                http_response_code(200);
                echo json_encode([
                    "success" => true, 
                    "justificacion" => [
                        "ID" => $justificacion->getID(),
                        "fecha" => $justificacion->getFecha(),
                        "motivo" => $justificacion->getMotivo(),
                        "documento" => $justificacion->getDocumento() ? true : false,
                    ]
                ]);
            } else {
                http_response_code(404);
                echo json_encode(["success" => false, "mensaje" => "Justificación no encontrada."]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["success" => false, "mensaje" => "Error al recuperar la justificación: " . $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["success" => false, "mensaje" => "Falta el ID de la justificación en la solicitud."]);
    }
}







if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $json=json_decode($_POST['json']);

    $ID = 2;
    $motivo = $json->motivo;
    $fecha = $json->fecha;
    $idFalta = $json -> idFalta;

    $rutaArchivo = null;
    if (isset($_FILES['documento'])) {


        $destination = '../STYLES/DOCUMENTOS/' . $_FILES['documento']['name'];

        if (move_uploaded_file($_FILES['documento']['tmp_name'], $destination)) {
            $rutaArchivo = $destination; 
            

            $justificacionOBJ = new Justificacion($ID,$fecha,$motivo,$rutaArchivo);

            $ID_Just = RP_Justificacion::InsertaObjeto($justificacionOBJ);


            RP_Falta::ActualizaEstadoDeFaltaPorID($ID_Just, 'Espera', $idFalta);

            // Establece el código de estado HTTP (en este caso, 200 OK)
            http_response_code(200);
            echo json_encode(["mensaje" => "Datos y archivo subidos correctamente"]);
        } else {

            // Manejar el error al mover el archivo
            echo "Error";
        }
    }

}

?>