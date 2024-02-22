<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();
$cierraSesion = isset($_POST['cierraSesion']);

$mostrar = RP_Falta::MostrarFaltasEnEspera();

$obj = RP_Falta::MostrarFaltasEnEsperaOBJ();

$IDfalta = $obj -> getID();
$Fecha = $obj -> getFecha();
$IDJust = $obj -> getIDJustificacion();




$i=0;

if($mostrar ==null){
    echo "No hay Faltas";
}else{
    ?>
    <style>
        .divTablaMostrar {
            margin-left: 10%;
            margin-right: 10%;
        }

        .tablaMostrar {
            width: 80%;
            margin: 20px auto;
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

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <div class="divTablaMostrar">
        <table class="tablaMostrar">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Nombre Usuario</th>
                <th>Justificar</th>
            </tr>
            <?php
            foreach ($mostrar as $key):
                ?>
                <form method="post">
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
                        <input type="hidden" name="IDfalta" value="<?php echo $key->getID(); ?>">
                        <input type="hidden" name="IDUsuario" value="<?php echo $key->getIDUsuario(); ?>">
                        <input type="hidden" name="IDJust" value="<?php echo $key->getIDJustificacion(); ?>">
                        <input type="hidden" name="Fecha" value="<?php echo $key->getFecha(); ?>">
                        <input type="submit" name="btnJustificar<?php echo $i ?>" id="botonJustificar" value="Justificar">
                    </td>
                </tr>
                </form>
                <?php
                $i++;
            endforeach; ?>
        </table>
    </div>
    <?php
}
if ($cierraSesion) {
    funcionesLogin::logOut("?menu=login");
}
for ($j = 0; $j < $i; $j++) {
    if (isset($_POST['btnJustificar' . $j])) {
        $IDfalta = $_POST['IDfalta'];
        $IDUsuario = $_POST['IDUsuario'];
        $IDJust = $_POST['IDJust'];
        $Fecha = $_POST['Fecha'];

        echo '<script>window.location.href="?menu=justificarFaltasProfesor&IDfalta=' . $IDfalta . '&IDUsuario=' . $IDUsuario . '&IDJustifi=' . $IDJust . '&Fecha=' . $Fecha . '";</script>';
    }
}

?>
