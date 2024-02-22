<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();
$cierraSesion = isset($_POST['cierraSesion']);

$ID = $_GET['ID'];

$mostrar = RP_Falta::MostrarInjustificadasPorUsuario($ID);

$obj = RP_Falta::MostrarInjustificadasPorUsuarioOBJ($ID);

$IDfalta = $obj->getID();
$Fecha = $obj->getFecha();

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
        table-layout: fixed; /* Añadido para manejar el ancho de las columnas */
    }

    .tablaMostrar th, .tablaMostrar td {
        text-align: left;
        padding: 8px;
        border: 1px solid #ddd;
        word-wrap: break-word; /* Asegura que el texto se ajuste dentro de la celda */
    }

    .tablaMostrar th {
        background-color: #007bff; /* Azul */
        color: white;
    }

    .tablaMostrar tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    input[type="submit"], #botonJustificar {
        background-color: #007bff; /* Azul */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover, #botonJustificar:hover {
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
            <th>Justificar</th>
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
            <td>
                <form method="post">
                    <input type="hidden" name="IDfalta" value="<?php echo $key->getID(); ?>">
                    <input type="submit" name="btnJustificar<?php echo $i ?>" id="botonJustificar" value="Justificar">
                </form>
            </td>
        </tr>
        <?php $i++; endforeach; ?>
    </table>
</div>
<?php
}

for ($j = 0; $j < $i; $j++) {
    if (isset($_POST['btnJustificar' . $j])) {
        $IDfalta = $_POST['IDfalta'];
        echo '<script>window.location.href="?menu=justificar&ID=' . $ID . '&IDfalta=' . $IDfalta . '&Fecha=' . $Fecha . '";</script>';
    }
}
?>
