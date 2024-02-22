<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();



if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $conexion = Conexion::AbreConexion();

        $consulta = "SELECT * FROM horario";
        $stmt = $conexion->prepare($consulta);

        $stmt->execute();

        // Verificar si se encontró el horario
        if ($stmt->rowCount() > 0) {
            $horarios = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtengo todas las filas

            // Establecer el código de estado a 200 (OK)
            http_response_code(200);
            echo json_encode($horarios);
        } else {
            // El horario no existe, establecer el código de estado a 404
            http_response_code(404);
            echo json_encode(["mensaje" => "El horario no existe."]);
        }
    } catch (PDOException $e) {
        // Error en el servidor, establecer el código de estado a 500
        http_response_code(500);
        echo json_encode(["mensaje" => "Error al conectar con la base de datos: " . $e->getMessage()]);
    }
}

 



//POST


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificar el cuerpo de la solicitud JSON para obtener los datos
    $data = json_decode(file_get_contents("php://input"), true);

    $conexion = Conexion::AbreConexion();

    foreach ($data as $horario) {
        $consulta = "INSERT INTO horario (ID_Usuario, ID_Asignatura, hora_inicio, hora_fin, dia) VALUES (:ID_Usuario, :ID_Asignatura, :hora_inicio, :hora_fin, :dia)";
        $stmt = $conexion->prepare($consulta);

        $stmt->bindParam(':ID_Usuario', $horario['ID_Usuario'], PDO::PARAM_INT);
        $stmt->bindParam(':ID_Asignatura', $horario['ID_Asignatura'], PDO::PARAM_INT);
        $stmt->bindParam(':hora_inicio', $horario['hora_inicio']);
        $stmt->bindParam(':hora_fin', $horario['hora_fin']);
        $stmt->bindParam(':dia', $horario['dia']);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            // Si hay un error con este elemento, interrumpe el bucle y reporta el error
            http_response_code(500);
            echo json_encode(["mensaje" => "Error al crear el horario: " . $e->getMessage(), "datosRecibidos" => $horario]);
            exit;
        }
    }

    // Si todos los elementos se procesaron correctamente
    http_response_code(201);
    echo json_encode(["mensaje" => "Horarios creados correctamente."]);
}


// DETELE


if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
   
    try {
        $conexion = Conexion::AbreConexion();

        $consulta = "DELETE FROM horario";
        $stmt = $conexion->prepare($consulta);

        $stmt->execute();

        // Verificar si se eliminó el horario
        if ($stmt->rowCount() > 0) {
            // El horario fue eliminado, establecer el código de estado a 200 (OK)
            http_response_code(200);
            echo json_encode(["mensaje" => "El horario ha sido eliminado correctamente."]);
        } else {
            // El horario no existe, establecer el código de estado a 404
            http_response_code(404);
            echo json_encode(["mensaje" => "El horario no existe o ya fue eliminado."]);
        }
    } catch (PDOException $e) {
        // Error en el servidor, establecer el código de estado a 500
        http_response_code(500);
        echo json_encode(["mensaje" => "Error al conectar con la base de datos: " . $e->getMessage()]);
    }
}





//PUT

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Intenta obtener el ID del horario desde el parámetro de la URL
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    // Decodificar el cuerpo de la solicitud JSON para obtener los datos
    $data = json_decode(file_get_contents("php://input"), true);

    // Validar que todos los datos necesarios están presentes
    if ($id === null || empty($data['ID_Usuario']) || empty($data['ID_Asignatura']) || empty($data['hora_inicio']) || empty($data['hora_fin']) || empty($data['dia'])) {
        http_response_code(400);
        echo json_encode(["mensaje" => "Faltan datos para actualizar el horario."]);
        exit;
    }

    try {
        // Obtener la conexión a la base de datos
        $conexion = Conexion::AbreConexion();

        // Preparar la consulta SQL para actualizar el horario
        $consulta = "UPDATE horario SET ID_Usuario = :ID_Usuario, ID_Asignatura = :ID_Asignatura, hora_inicio = :hora_inicio, hora_fin = :hora_fin, dia = :dia WHERE ID = :id";
        $stmt = $conexion->prepare($consulta);

        // Vincular los parámetros, asegurándose de que el nombre del parámetro coincide con el marcador en la consulta
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':ID_Usuario', $data['ID_Usuario'], PDO::PARAM_INT);
        $stmt->bindParam(':ID_Asignatura', $data['ID_Asignatura'], PDO::PARAM_INT);
        $stmt->bindParam(':hora_inicio', $data['hora_inicio']);
        $stmt->bindParam(':hora_fin', $data['hora_fin']);
        $stmt->bindParam(':dia', $data['dia']);

        // Ejecutar la consulta
        $stmt->execute();

        // Verificar si se actualizó el horario
        if ($stmt->rowCount() > 0) {
            http_response_code(200);
            echo json_encode(["mensaje" => "El horario ha sido actualizado correctamente."]);
        } else {
            // No se encontró el horario o no se necesitó actualizar, establecer el código de estado a 404
            http_response_code(404);
            echo json_encode(["mensaje" => "El horario no existe o los datos son los mismos."]);
        }
    } catch (PDOException $e) {
        // Error en el servidor, establecer el código de estado a 500
        http_response_code(500);
        echo json_encode(["mensaje" => "Error al conectar con la base de datos: " . $e->getMessage()]);
    }
}


?>


