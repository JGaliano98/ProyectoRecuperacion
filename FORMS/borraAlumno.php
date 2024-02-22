<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

$volver = isset($_POST['btnVolverElim']);

$mostrar = RP_Usuario::MostrarTodoAlumnos();
$i = 0;

if ($mostrar == null) {
    echo "No hay usuarios";
} else {
    ?>
    <style>
        #divTablaBorrar, #divVolver {
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
                    <td><?php echo $key->getID(); ?></td>
                    <td><?php echo $key->getNombre() . " " . $key->getApellido1() . " " . $key->getApellido2();?></td>
                    <td><?php echo $key->getContraseña(); ?></td>
                    <td><?php echo $key->getCorreo(); ?></td>
                    <td>
                        <form method="post">
                            <input type="submit" name="btnBorrar<?php echo $i ?>" value="Borrar">
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
?>

