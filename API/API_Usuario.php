<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

//GET

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        $conexion = Conexion::AbreConexion();

        $consulta = "SELECT * FROM usuario WHERE rol = 'Alumno'";
        $stmt = $conexion->prepare($consulta);
        $stmt->execute();

        // Verificar si se encontraron usuarios
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($usuarios) > 0) {
            // Establecer el código de estado a 200 (OK) y mostrar los usuarios
            http_response_code(200);
            echo json_encode($usuarios);
        } else {
            // No se encontraron usuarios con el rol 'Alumno', establecer el código de estado a 404
            http_response_code(404);
            echo json_encode(array("mensaje" => "No se encontraron usuarios con el rol 'Alumno'."));
        }
    } catch (PDOException $e) {
        // Error en el servidor, establecer el código de estado a 500
        http_response_code(500);
        echo json_encode(array("mensaje" => "Error al conectar con la base de datos: " . $e->getMessage()));
    }
} else {
    // Método no permitido, establecer el código de estado a 405
    http_response_code(405);
    echo json_encode(array("mensaje" => "Método no permitido."));
}


?>
