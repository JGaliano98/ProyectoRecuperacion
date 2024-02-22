<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

class RP_Falta {

    
    public static function MostrarTodo() {
        $conexion = Conexion::AbreConexion();
        $array = [];

        $resultado = $conexion->query("SELECT * FROM falta");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;

            $falta = new Falta($ID, $fecha, $estado,  $ID_usuario , $ID_justificacion);
            $array[] = $falta;
        }

        return $array;
    }

    public static function MostrarTodoFechas($fechaInicio, $fechaFin) {
        $conexion = Conexion::AbreConexion();
        $array = [];
    
        $consulta = $conexion->prepare("SELECT * FROM falta WHERE fecha BETWEEN :fechaInicio AND :fechaFin");
    
        $consulta->bindParam(':fechaInicio', $fechaInicio);
        $consulta->bindParam(':fechaFin', $fechaFin);
        $consulta->execute();
    
        
        while ($tuplas = $consulta->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;
    
            $falta = new Falta($ID, $fecha, $estado, $ID_usuario, $ID_justificacion);
            $array[] = $falta;
        }
    
        return $array;
    }
    



    public static function MostrarJustificadas() {
        $conexion = Conexion::AbreConexion();
        $array = [];
    
        $resultado = $conexion->query(
            "SELECT falta.*, usuario.ID AS UsuarioID, usuario.DNI, usuario.Nombre, usuario.Apellido1, usuario.Apellido2, usuario.Telefono, usuario.Correo, usuario.Rol, usuario.Foto, usuario.Curso, usuario.Contraseña
            FROM falta
            INNER JOIN usuario ON falta.ID_Usuario = usuario.ID
            WHERE falta.estado = 'Justificada';"
        );
    
        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;
            $nombreUsuario = $tuplas->Nombre;
            $ape1Usuario = $tuplas->Apellido1;
            $ape2Usuario = $tuplas->Apellido2;
    

            $falta = new Falta($ID, $fecha, $estado, $ID_usuario, $ID_justificacion, $nombreUsuario, $ape1Usuario, $ape2Usuario);
            $array[] = $falta;
        }
    
        return $array;
    }
    


    public static function MostrarFaltasAlumno($nombre, $apellido1, $apellido2) {
        $conexion = Conexion::AbreConexion();
        $array = [];

        $resultado = $conexion->query("SELECT * FROM falta where estado='Justificada'");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;

            $falta = new Falta($ID, $fecha, $estado, $ID_usuario, $ID_justificacion);
            $array[] = $falta;
        }

        return $array;
    }

    public static function MostrarFaltasPorUsuario($ID) {
        $conexion = Conexion::AbreConexion();
        $array = [];

        $resultado = $conexion->query("SELECT * FROM falta WHERE ID_Usuario=$ID");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;

            $falta = new Falta($ID, $fecha, $estado, $ID_usuario, $ID_justificacion);
            $array[] = $falta;
        }

        return $array;
    }


    public static function MostrarInjustificadasPorUsuario($ID) {
        $conexion = Conexion::AbreConexion();
        $array = [];

        $consulta = "SELECT falta.*, usuario.nombre, usuario.apellido1, usuario.apellido2 
                     FROM falta 
                     JOIN usuario ON falta.ID_Usuario = usuario.ID 
                     WHERE falta.estado='Injustificada' AND falta.ID_Usuario = $ID";
    
        $resultado = $conexion->query($consulta);
    
        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;
            $nombre = $tuplas->nombre;
            $apellido1 = $tuplas->apellido1;
            $apellido2 = $tuplas->apellido2;

            $falta = new Falta($ID, $fecha, $estado, $ID_usuario, $ID_justificacion, $nombre, $apellido1, $apellido2);
            $array[] = $falta;
        }
    
        return $array;
    }
    


    public static function MostrarInjustificadasPorUsuarioOBJ($ID) {
        $conexion = Conexion::AbreConexion();


        $consulta = "SELECT falta.*, usuario.nombre, usuario.apellido1, usuario.apellido2 
                     FROM falta 
                     JOIN usuario ON falta.ID_Usuario = usuario.ID 
                     WHERE falta.estado='Injustificada' AND falta.ID_Usuario = $ID";
    
        $resultado = $conexion->query($consulta);
    
        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;
            $nombre = $tuplas->nombre;
            $apellido1 = $tuplas->apellido1;
            $apellido2 = $tuplas->apellido2;

            $falta = new Falta($ID, $fecha, $estado, $ID_usuario, $ID_justificacion, $nombre, $apellido1, $apellido2);
        
        }
    
        return $falta;
    }

    public static function MostrarFaltasEnEspera() {
        $conexion = Conexion::AbreConexion();
        $array = [];
    
        $consulta = "SELECT falta.*, usuario.nombre, usuario.apellido1, usuario.apellido2 
                     FROM falta 
                     JOIN usuario ON falta.ID_Usuario = usuario.ID 
                     WHERE falta.estado='Espera'";
    
        $resultado = $conexion->query($consulta);
    
        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;
            $nombre = $tuplas->nombre;
            $apellido1 = $tuplas->apellido1;
            $apellido2 = $tuplas->apellido2;
    
        
            $falta = new Falta($ID, $fecha, $estado, $ID_usuario, $ID_justificacion, $nombre, $apellido1, $apellido2);
            $array[] = $falta;
        }
    
        return $array;
    }
    

    public static function MostrarFaltasEnEsperaOBJ() {
        $conexion = Conexion::AbreConexion();
    
        $consulta = "SELECT falta.*, usuario.nombre, usuario.apellido1, usuario.apellido2 
                     FROM falta 
                     JOIN usuario ON falta.ID_Usuario = usuario.ID 
                     WHERE falta.estado='Espera'";
    
        $resultado = $conexion->query($consulta);
    
        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;
            $nombre = $tuplas->nombre;
            $apellido1 = $tuplas->apellido1;
            $apellido2 = $tuplas->apellido2;
    
        
            $falta = new Falta($ID, $fecha, $estado, $ID_usuario, $ID_justificacion, $nombre, $apellido1, $apellido2);
            
        }
    
        return $falta;
    }

    public static function MostrarTodasLasFaltas() {
        $conexion = Conexion::AbreConexion();
        $array = [];
    
        $resultado = $conexion->query(
            "SELECT falta.*, usuario.ID AS UsuarioID, usuario.DNI, usuario.Nombre, usuario.Apellido1, usuario.Apellido2, usuario.Telefono, usuario.Correo, usuario.Rol, usuario.Foto, usuario.Curso, usuario.Contraseña
            FROM falta
            INNER JOIN usuario ON falta.ID_Usuario = usuario.ID;"
        );
    
        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_Justificacion = $tuplas->ID_Justificacion;
            $ID_Usuario = $tuplas->ID_Usuario;
            $nombreUsuario = $tuplas->Nombre;
            $ape1Usuario = $tuplas->Apellido1; 
            $ape2Usuario = $tuplas->Apellido2; 
    
            $falta = new Falta($ID, $fecha, $estado, $ID_Justificacion, $ID_Usuario, $nombreUsuario, $ape1Usuario, $ape2Usuario);
            $array[] = $falta;
        }
    
        return $array;
    }
    

    public static function BuscarPorID($id) {
        $conexion = Conexion::AbreConexion();
        $resultado = $conexion->query("SELECT * FROM falta WHERE ID = $id");

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_justificacion;
            $ID_usuario = $tuplas->ID_usuario;

            $falta = new Falta($ID, $fecha, $estado, $ID_justificacion, $ID_usuario);
        }

        return $falta;
    }

    public static function BuscarPorUsuario($id) {
        $conexion = Conexion::AbreConexion();
        $array = [];
    
        $consulta = "SELECT falta.*, usuario.nombre, usuario.apellido1, usuario.apellido2
                     FROM falta
                     JOIN usuario ON falta.ID_Usuario = usuario.ID
                     WHERE falta.ID_Usuario = $id";
    
        $resultado = $conexion->query($consulta);
    
        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $ID = $tuplas->ID;
            $fecha = $tuplas->fecha;
            $estado = $tuplas->estado;
            $ID_justificacion = $tuplas->ID_Justificacion;
            $ID_usuario = $tuplas->ID_Usuario;
       

            $nombre = $tuplas->nombre;
            $apellido1 = $tuplas->apellido1;
            $apellido2 = $tuplas->apellido2;
    
            $falta = new Falta($ID, $fecha, $estado, $ID_usuario, $ID_justificacion, $nombre, $apellido1, $apellido2);
            $array[] = $falta;
        }
    
        return $array;
    }
    


    public static function InsertaObjeto($objeto) {
        $conexion = Conexion::AbreConexion();

        $fecha = $objeto->getFecha();
        $estado = $objeto->getEstado();
        $ID_justificacion = $objeto->getID_Justificacion();
        $ID_usuario = $objeto->getID_Usuario();

        $conexion->exec("INSERT INTO falta (fecha, estado, ID_justificacion, ID_usuario) VALUES ('$fecha', '$estado', '$ID_justificacion', '$ID_usuario')");
    }

    public static function ActualizaPorID($id, $objeto) {
        $conexion = Conexion::AbreConexion();

        $fecha = $objeto->getFecha();
        $estado = $objeto->getEstado();
        $ID_justificacion = $objeto->getID_Justificacion();
        $ID_usuario = $objeto->getID_Usuario();

        $conexion->exec("UPDATE falta SET fecha = '$fecha', estado = '$estado', ID_justificacion = '$ID_justificacion', ID_usuario = '$ID_usuario' WHERE ID = $id");
    }

    public static function ActualizaEstadoDeFaltaPorID($ID_Justificacion, $estado, $ID_Falta ) {
        $conexion = Conexion::AbreConexion();

        $conexion->exec("UPDATE falta SET  estado = '$estado', ID_justificacion = '$ID_Justificacion' WHERE ID = $ID_Falta");
    }

    public static function BorraPorID($id) {
        $conexion = Conexion::AbreConexion();
        $conexion->exec("DELETE FROM falta WHERE ID = $id");
    }


}
?>
