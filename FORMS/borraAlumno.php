<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

$volver = isset($_POST['btnVolverElim']);

$mostrar = RP_Usuario::MostrarTodo();
$i = 0;

if ($mostrar == null) {
    echo "No hay usuarios";
} else {
    ?>
    <div id="divTablaBorrar">
        <table class="tablaMostrar">
            <tr>
                <th>ID</th>
                <th>Alumno</th>
                <th>Contraseña</th>
                <th>Correo</th>
                <th>Eliminar</th>
            </tr>
            <?php
            foreach ($mostrar as $key):
            ?>
                <tr>
                    <td name="ID_Usuario<?php echo $i ?>"><?php echo $key->getID(); ?></td>
                    <td name="nombre<?php echo $i ?>"><?php echo $key->getNombre(); ?></td>
                    <td name="contraseña<?php echo $i ?>"><?php echo $key->getContraseña(); ?></td>
                    <td name="correo<?php echo $i ?>"><?php echo $key->getCorreo(); ?></td>
                    <td>
                        <form method="post">
                            <input type="submit" id="btnBorrar" name="btnBorrar<?php echo $i ?>" id="botonBorrar" value="Borrar">
                        </form>
                    </td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>
        </table>
    </div>
    <?php
}

for ($j = 0; $j < $i; $j++) {
    if (isset($_POST['btnBorrar' . $j])) {
        RP_Usuario::BorraPorID($mostrar[$j]->getID());

        echo '<script>window.location.href="?menu=borraAlumno";</script>';
    }
}
if ($volver) {
    funcionesLogin::logOut("?menu=tutor");
}
?>
<form method="post">
<div id="divVolver">
    <input type="submit" id="btnVolverElim" value="Volver" name="btnVolverElim">
</div>
</form>
<style>
    #enlace {
        display: none;
    }
</style>