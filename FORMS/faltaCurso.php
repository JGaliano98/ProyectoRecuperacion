<?php


require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

?>

<form method="post">
    <label for="nombre">Nombre:</label><br>
    <select name="selectCurso">
        <option value="2DAW">2 DAW</option>
        <option value="2ASIR">2 ASIR</option>
    </select>

    <input type="submit" value="Consultar" name="btnConsultar">

    <input type="submit" id="btnVolverElim" value="Volver" name="btnVolverAlu">


</form>

<?php

$consultar = isset( $_POST['btnConsultar']);
$volver=isset($_POST['btnVolverAlu']);

if ($consultar) {

    $curso = $_POST['selectCurso'];

    $alumnos = RP_Usuario::BuscarPorCurso($curso);

    if ($alumnos !== null) {
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
                foreach ($alumnos as $alumno) {
                    $ID_Alumno = $alumno->getID();
                    $mostrar = RP_Falta::MostrarFaltasPorUsuario($ID_Alumno);

                    if ($mostrar != null) {
                        foreach ($mostrar as $key) {
                            ?>
                            <tr>
                                <td><?php echo $key->getID(); ?></td>
                                <td><?php echo $key->getFecha(); ?></td>
                                <td><?php echo $key->getEstado(); ?></td>
                                <td><?php echo $key->getIDUsuario(); ?></td>
                            </tr>
                            <?php
                        }
                    }
                }
                ?>
            </table>
        </div>
        <?php
    } else {
        echo "No hay alumnos en este curso o no se encontraron faltas.";
    }
}



if($volver) {
    
    header('Location:/ProyectoRecuperacion/index.php?menu=faltas');
}
?>