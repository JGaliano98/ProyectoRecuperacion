<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();
$cierraSesion = isset($_POST['cierraSesion']);

$ID = $_GET['ID'];

$mostrar = RP_Falta::BuscarPorUsuario($ID);
$i = 0;

if ($mostrar == null) {
    echo "No hay Faltas";
} else {
?>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .divTablaMostrar {
        width: 100%;
        margin: 0 auto;
        padding: 20px;
    }

    .tablaMostrar {
        width: 100%;
        border-collapse: collapse;
    }

    .tablaMostrar th, .tablaMostrar td {
        text-align: left;
        padding: 8px;
        border: 1px solid #ddd;
    }

    .tablaMostrar th {
        background-color: #007bff; /* Cambiado a azul */
        color: white;
    }

    .tablaMostrar tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #btnCierraSesion {
        background-color: #007bff; /* Azul */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin: 10px 0;
    }

    #btnCierraSesion:hover {
        background-color: #0056b3; /* Azul oscuro */
    }
</style>


<div class="divTablaMostrar">
    <table class="tablaMostrar">
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Usuario</th>
        </tr>
        <?php foreach ($mostrar as $key): ?>
        <tr>
            <td><?php echo $key->getID(); ?></td>
            <td><?php echo $key->getFecha(); ?></td>
            <td><?php echo $key->getEstado(); ?></td>
            <td>
                <?php 
                
                echo $key->getNombreUsuario() . " " . $key->getApe1Usuario() . " " . $key->getApe2Usuario(); 
                ?>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </table>
</div>

<?php
}
?>