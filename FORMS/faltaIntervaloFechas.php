<?php


require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

?>

<form method="post">
    <label for="nombre">Fecha Inicio:</label><br>
    <input type="datetime-local" name="fechaInicio">
    <input type="datetime-local" name="fechaFin">

    <input type="submit" value="Consultar" name="btnConsultar">

    <input type="submit" id="btnVolverElim" value="Volver" name="btnVolverAlu">


</form>

<?php

$consultar = isset( $_POST['btnConsultar']);
$volver=isset($_POST['btnVolverAlu']);

if ($consultar) {

    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];



    $mostrar = RP_Falta::MostrarTodoFechas($fechaInicio, $fechaFin);
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

}



if($volver) {
    
    header('Location:/ProyectoRecuperacion/index.php?menu=faltas');
}
?>