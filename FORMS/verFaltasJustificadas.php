<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();
$cierraSesion = isset($_POST['cierraSesion']);

$mostrar = RP_Falta::MostrarJustificadas();
$i=0;

if($mostrar == null){
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
            width: 80%;
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
            
            foreach ($mostrar as $key): 
            
                ?>
                <tr>
                    <td><?php echo $key->getID(); ?></td>
                    <td><?php echo $key->getFecha(); ?></td>
                    <td><?php echo $key->getEstado(); ?></td>
                    <td><?php echo $key->getNombreUsuario() . " " . $key->getApe1Usuario() . " " . $key->getApe2Usuario(); ?></td>
                </tr>
                <?php
                $i++;
            endforeach; ?>
        </table>
    </div>
    
    <?php
}
?>
