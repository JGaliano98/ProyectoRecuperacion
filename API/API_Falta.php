<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();



//GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    

    $fecha = isset($_GET['fecha']) ? $_GET['fecha'] : null;
    $hora = isset($_GET['hora']) ? $_GET['hora'] : null;

    if ($fecha === null || $hora === null) {
        http_response_code(400);
        echo json_encode(array("mensaje" => "Faltan la fecha o la hora en la solicitud."));
        exit;
    }

    try {
        $conexion = Conexion::AbreConexion();
        $consulta = "SELECT ID, fecha, estado, ID_Usuario FROM falta WHERE DATE(fecha) = :fecha AND hora = :hora";
        $stmt = $conexion->prepare($consulta);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora', $hora, PDO::PARAM_INT);

        $stmt->execute();
        $faltas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($faltas) > 0) {
            http_response_code(200);
            echo json_encode($faltas);
        } else {
            http_response_code(404);
            echo json_encode(array("mensaje" => "No se encontraron faltas para la fecha y hora especificadas."));
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(array("mensaje" => "Error al conectar con la base de datos: " . $e->getMessage()));
    }
}




//POST

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $datos = json_decode(file_get_contents("php://input"), true);

    if (isset($datos['accion']) && $datos['accion'] == 'eliminar') {


        // Llamo a la funcion eliminar falta.
        eliminarFalta($datos);


    } else {


        // Llamo a la funcion crear o actualizar una falta.
        crearActualizarFalta($datos);
    }

}


// Función para eliminar una falta
function eliminarFalta($datos) {
    $ID_Usuario = $datos['ID_Usuario'];
    $fecha = $datos['fecha'];
    $hora = $datos['hora'];

    try {
        $conexion = Conexion::AbreConexion();
        $consulta = "DELETE FROM falta WHERE ID_Usuario = :ID_Usuario AND DATE(fecha) = :fecha AND hora = :hora";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute([':ID_Usuario' => $ID_Usuario, ':fecha' => $fecha, ':hora' => $hora]);

        if ($stmt->rowCount() > 0) {
            http_response_code(200);
            echo json_encode(["mensaje" => "La falta ha sido eliminada correctamente."]);
        } else {
            http_response_code(404);
            echo json_encode(["mensaje" => "La falta no existe o ya fue eliminada."]);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["mensaje" => "Error al conectar con la base de datos: " . $e->getMessage()]);
    }
}


// Función para crear o actualizar una falta
function crearActualizarFalta($datos) {
    $ID_Usuario = $datos['ID_Usuario'];
    $fecha = $datos['fecha'];
    $estado = $datos['estado'];
    $hora = $datos['hora'];

    try {
        $conexion = Conexion::AbreConexion();
        // Verifica si la falta ya existe
        $consultaExistente = "SELECT ID FROM falta WHERE ID_Usuario = :ID_Usuario AND DATE(fecha) = :fecha AND hora = :hora";
        $stmtExistente = $conexion->prepare($consultaExistente);
        $stmtExistente->execute([':ID_Usuario' => $ID_Usuario, ':fecha' => $fecha, ':hora' => $hora]);
        $faltaExistente = $stmtExistente->fetch(PDO::FETCH_ASSOC);

        if ($faltaExistente) {
            // Actualizar la falta existente
            $consultaActualizar = "UPDATE falta SET estado = :estado WHERE ID = :ID";
            $stmtActualizar = $conexion->prepare($consultaActualizar);
            $stmtActualizar->execute([':estado' => $estado, ':ID' => $faltaExistente['ID']]);
            echo json_encode(["mensaje" => "La falta ha sido actualizada correctamente."]);
        } else {
            // Crear una nueva falta
            $consultaInsertar = "INSERT INTO falta (ID_Usuario, fecha, estado, hora) VALUES (:ID_Usuario, :fecha, :estado, :hora)";
            $stmtInsertar = $conexion->prepare($consultaInsertar);
            $stmtInsertar->execute([':ID_Usuario' => $ID_Usuario, ':fecha' => $fecha, ':estado' => $estado, ':hora' => $hora]);
            echo json_encode(["mensaje" => "La falta ha sido creada correctamente."]);
        }
        http_response_code(200);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["mensaje" => "Error al conectar con la base de datos: " . $e->getMessage()]);
    }
}



//DELETE

// if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
//     // Decodificar el cuerpo de la solicitud para obtener los datos JSON
//     $input = file_get_contents("php://input");
//     parse_str($input, $datos);
//     $ID_Usuario = isset($datos['ID_Usuario']) ? $datos['ID_Usuario'] : null;
//     $fecha = isset($datos['fecha']) ? $datos['fecha'] : null;
//     $hora = isset($datos['hora']) ? $datos['hora'] : null;

//     if ($ID_Usuario === null || $fecha === null || $hora === null) {
//         // Si alguno de los parámetros necesarios no está presente, establecer el código de estado a 400
//         http_response_code(400);
//         echo json_encode(["mensaje" => "Faltan parámetros necesarios (ID_Usuario, fecha, hora) en la solicitud."]);
//         exit;
//     }

//     try {
//         // Obtener la conexión a la base de datos
//         $conexion = Conexion::AbreConexion();

//         // Preparar la consulta SQL para eliminar
//         $consulta = "DELETE FROM falta WHERE ID_Usuario = :ID_Usuario AND DATE(fecha) = :fecha AND hora = :hora";
//         $stmt = $conexion->prepare($consulta);
//         $stmt->bindParam(':ID_Usuario', $ID_Usuario, PDO::PARAM_INT);
//         $stmt->bindParam(':fecha', $fecha);
//         $stmt->bindParam(':hora', $hora);

//         // Ejecutar la consulta
//         $stmt->execute();

//         // Verificar si se eliminó la falta
//         if ($stmt->rowCount() > 0) {
//             // Establecer el código de estado a 200 (OK)
//             http_response_code(200);
//             echo json_encode(["mensaje" => "La falta ha sido eliminada correctamente."]);
//         } else {
//             // La falta no existe, establecer el código de estado a 404
//             http_response_code(404);
//             echo json_encode(["mensaje" => "La falta no existe o ya fue eliminada."]);
//         }
//     } catch (PDOException $e) {
//         // Error en el servidor, establecer el código de estado a 500
//         http_response_code(500);
//         echo json_encode(["mensaje" => "Error al conectar con la base de datos: " . $e->getMessage()]);
//     }
// }


?> 