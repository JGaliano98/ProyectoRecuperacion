<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();
$cierraSesion = isset($_POST['cierraSesion']);

$mostrar = RP_Falta::MostrarTodasLasFaltas();
$i=0;

if($mostrar ==null){
    echo "No hay Faltas";
}else{
    ?>
   <style>
    .divTablaMostrar {
        margin-left: 10%;
        margin-right: 10%;
        margin-top: 1%;
    }
    .tablaMostrar {
        width: 100%;
        border-collapse: collapse;
    }
    .tablaMostrar, .tablaMostrar th, .tablaMostrar td {
        border: 1px solid #ddd;
        text-align: left;
    }
    .tablaMostrar th, .tablaMostrar td {
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
    #btnCierraSesion {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }
    #btnCierraSesion:hover {
        background-color: #0056b3;
    }
</style>

    <div class="divTablaMostrar">
        <table class="tablaMostrar">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Nombre Completo</th>
            </tr>
            <?php
            
            foreach ($mostrar as $falta): 
                ?>
                <tr>
                    <td><?php echo $falta->getID(); ?></td>
                    <td><?php echo $falta->getFecha(); ?></td>
                    <td><?php echo $falta->getEstado(); ?></td>
                    <td><?php echo $falta->getNombreUsuario() . " " . $falta->getApe1Usuario() . " " . $falta->getApe2Usuario(); ?></td> <!-- Concatenando nombre y apellidos -->
                </tr>
                <?php
                $i++;
            endforeach; ?>
        </table>
    </div>
    
    <?php
        

}

?>

