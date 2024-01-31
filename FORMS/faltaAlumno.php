<?php


require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

?>

<form method="post">
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre"><br>

    <label for="apellido1">Apellido 1:</label><br>
    <input type="text" id="apellido1" name="apellido1"><br>

    <label for="apellido2">Apellido 2:</label><br>
    <input type="text" id="apellido2" name="apellido2"><br>

    <input type="submit" value="Consultar" name="btnConsultar">

    <input type="submit" id="btnVolverElim" value="Volver" name="btnVolverAlu">


</form>

<?php

$consultar = isset( $_POST['btnConsultar']);
$volver=isset($_POST['btnVolverAlu']);

if($consultar){


    $nombre=$_POST['nombre'];
    $apellido1=$_POST['apellido1'];
    $apellido2=$_POST['apellido2'];



    $alumno = RP_Usuario::BuscarPorNombreCompleto($nombre, $apellido1, $apellido2);

    if ($alumno !== null){


        $ID_Alumno = $alumno->getID();


        $mostrar = RP_Falta::MostrarFaltasPorUsuario($ID_Alumno);
        $i=0;

        if($mostrar ==null){
            echo "No hay Faltas";
        }else{
            ?>
            <div class="divTablaMostrar">

                <table class="tablaMostrar">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>ID Usuario</th>
                    </tr>
                    <?php
                    
                    foreach ($mostrar as $key): 
                        
                        ?>
                        <tr>
                            <td><?php echo $key->getID(); ?></td>
                            <td name="nombre<?php echo $i ?>"><?php echo $key->getFecha(); ?></td>
                            <td><?php echo $key->getEstado(); ?></td>
                            <td><?php echo $key->getIDUsuario(); ?></td>
                            <td style="display: none;"><?php echo $key->getIDJustificacion(); ?></td>
                        </tr>
                    <?php
                    $i++;
                        endforeach; ?>
                </table>
            </div>
            
            <?php
                

        }


    } else {
        echo("No existe el usuario");
    }

}


if($volver) {
    
    header('Location:/ProyectoRecuperacion/index.php?menu=faltas');
}
?>