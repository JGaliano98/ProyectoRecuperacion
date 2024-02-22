
<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();


//GET


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    try {
        $conexion = Conexion::AbreConexion();


        $id = isset($_GET['id']) ? $_GET['id'] : null;

        if ($id !== null) {
       
            $consulta = "SELECT ID, nombre FROM asignatura WHERE ID = :id";
            $stmt = $conexion->prepare($consulta);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        } else {
  
            $consulta = "SELECT ID, nombre FROM asignatura";
            $stmt = $conexion->prepare($consulta);
        }

   
        $stmt->execute();

        $asignaturas = [];
        if ($stmt->rowCount() > 0) {
            // Verificar si se solicitó una asignatura específica o todas
            if ($id !== null) {
                // Devuelve la asignatura específica
                $asignaturas = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                // Devuelve todas las asignaturas
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $asignaturas[] = $fila;
                }
            }

            // Establecer el código de estado a 200 (OK) y devolver los resultados
            http_response_code(200);
            echo json_encode($asignaturas);
        } else {
            // No se encontraron asignaturas, establecer el código de estado a 404
            http_response_code(404);
            echo json_encode(array("mensaje" => "No se encontraron asignaturas."));
        }
    } catch (PDOException $e) {
        // Error en el servidor, establecer el código de estado a 500
        http_response_code(500);
        echo json_encode(array("mensaje" => "Error al conectar con la base de datos: " . $e->getMessage()));
    }
}


?>