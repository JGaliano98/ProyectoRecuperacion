<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

?>

<style>
   
    .tablaMostrar {
        width: 100%; 
        margin: 0 auto; 
        border-collapse: collapse;
    }

    .tablaMostrar, .tablaMostrar th, .tablaMostrar td {
        border: 1px solid #ddd;
        text-align: center;
        padding: 8px;
    }

    .tablaMostrar th {
        background-color: #007bff;
        color: white;
    }

    .tablaMostrar tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .tablaMostrar tr:hover {
        background-color: #ddd;
    }

    input[type="submit"], #btnVolverAct, #btnEditar {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover, #btnVolverAct:hover, #btnEditar:hover {
        background-color: #0056b3;
    }

    input[type="text"], #inputActualizar {
        width: 90%;
        padding: 5px;
        margin: 2px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
</style>





<?php


$volver = isset($_POST['btnVolverAct']);

$mostrar = RP_Usuario::MostrarTodo();
$i = 0;

if ($mostrar == null) {
    echo "No hay usuarios";
} else {
    ?>
    <div id="divTablaActualizar">
        <form method="post">
            <table class="tablaMostrar">
                <tr>

                    <th>Nombre</th>
                    <th>1º Apellido</th>
                    <th>2º Apellido</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Curso</th>
                    <th>Contraseña</th>
                </tr>
                <?php
                $nuevoObjeto = array(); // Inicializa el array antes del bucle

                foreach ($mostrar as $key):
                ?>
                    <tr>
                       
                        <td><input type="text" id="inputActualizar" name="nombre[]" value="<?php echo $key->getNombre(); ?>"></td>
                        <td><input type="text" id="inputActualizar" name="apellido1[]" value="<?php echo $key->getApellido1(); ?>"></td>
                        <td><input type="text" id="inputActualizar" name="apellido2[]" value="<?php echo $key->getApellido2(); ?>"></td>
                        <td><input type="text" id="inputActualizar" name="correo[]" value="<?php echo $key->getCorreo(); ?>"></td>
                        <td><input type="text" id="inputActualizar" name="telefono[]" value="<?php echo $key->getTelefono(); ?>"></td>
                        <td><input type="text" id="inputActualizar" name="curso[]" value="<?php echo $key->getCurso(); ?>"></td>
                        <td><input type="text" id="inputActualizar" name="contraseña[]" value="<?php echo $key->getContraseña(); ?>"></td>
                        <td style="display: none;"><input type="text" id="inputActualizar" name="DNI[]" value="<?php echo $key->getDNI(); ?>"></td>
                        <td style="display: none;"><input type="text" id="inputActualizar" name="rol[]" value="<?php echo $key->getRol(); ?>"></td>
                        <td style="display: none;"><input type="text" id="inputActualizar" name="foto[]" value="<?php echo $key->getFoto(); ?>"></td>
                        <td style="display: none;"><input type="text" id="inputActualizar" name="ID_Usuario[]" value="<?php echo $key->getID(); ?>"></td>

                        <td>
                            <input type="submit" id="btnEditar" name="btnEditar<?php echo $i ?>" value="Editar">
                        </td>

                    </tr>
                    <?php
                    $i++;
                endforeach;
                ?>
            </table>
        </form>
    </div>

    <?php
}

// Verifica si se ha enviado el formulario antes de procesar los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($j = 0; $j < $i; $j++) {
        if (isset($_POST['btnEditar'. $j])) {
            
            $IDs = $_POST['ID_Usuario'];
            $nombres = $_POST['nombre'];
            $apellidos1 = $_POST['apellido1'];
            $apellidos2 = $_POST['apellido2'];
            $correos = $_POST['correo'];
            $telefonos = $_POST['telefono'];
            $DNIs = $_POST['DNI'];
            $cursos = $_POST['curso'];
            $contraseñas = $_POST['contraseña'];
            $roles = $_POST['rol'];
            $fotos = $_POST['foto'];
       
    
            //Si todo es correcto, añade los datos y crea el objeto
            if (isset($IDs[$j], $nombres[$j], $apellidos1[$j], $apellidos2[$j], $correos[$j], $telefonos[$j],$DNIs[$j],$cursos[$j],$contraseñas[$j], $roles[$j], $fotos[$j])) {
                $ID = $IDs[$j];
                $nombre = $nombres[$j];
                $apellido1 = $apellidos1[$j];
                $apellido2 = $apellidos2[$j];
                $telefono = $telefonos[$j];
                $dni = $DNIs[$j];
                $curso = $cursos[$j];
                $contraseña = $contraseñas[$j];
                $rol = $roles[$j];
                $foto = $fotos[$j];
                $correo = $correos[$j];
    
                $nuevoObjeto[$j] = new Usuario($ID, $dni, $nombre, $apellido1,$apellido2, $telefono, $correo, $rol, $foto, $curso,$contraseña);
                
                // Actualiza el usuario por ID
                RP_Usuario::ActualizaPorID($mostrar[$j]->getID(), $nuevoObjeto[$j]);

               
    
                echo '<script>window.location.href="?menu=actualizaAlumno";</script>';
            }
        }
    }
}
if ($volver) {

    echo '<script>window.location.href="?menu=tutor";</script>';
    
}
?>
<form method="post">
<div id="cierraSesion">
    <input type="submit" id="btnVolverAct" value="Volver" name="btnVolverAct">
</div>
</form>