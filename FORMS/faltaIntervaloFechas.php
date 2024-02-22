<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();
?>

<style>
    form {
        margin: 20px auto;
        width: 90%;
        max-width: 500px;
    }

    label {
        font-weight: bold;
        display: block; /* Hace que el label se muestre en su propia línea */
        margin-top: 10px;
    }

    input[type="datetime-local"], input[type="text"] {
        width: 100%;
        padding: 8px;
        margin: 5px 0 20px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

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
</style>

<form method="post">
    <label for="fechaInicio">Fecha Inicio:</label>
    <input type="datetime-local" name="fechaInicio">
    <input type="datetime-local" name="fechaFin">

    <input type="submit" value="Consultar" name="btnConsultar">
    <input type="submit" id="btnVolverElim" value="Volver" name="btnVolverAlu">
</form>

<?php
$consultar = isset($_POST['btnConsultar']);
$volver = isset($_POST['btnVolverAlu']);

if ($consultar) {
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];

    $mostrar = RP_Falta::MostrarTodoFechas($fechaInicio, $fechaFin);

    if ($mostrar == null) {
        echo "No hay Faltas";
    } else {
        echo "<div class='divTablaMostrar'><table class='tablaMostrar'><tr><th>ID</th><th>Fecha</th><th>Estado</th><th>ID Usuario</th></tr>";
        foreach ($mostrar as $key) {
            echo "<tr><td>{$key->getID()}</td><td>{$key->getFecha()}</td><td>{$key->getEstado()}</td><td>{$key->getIDUsuario()}</td></tr>";
        }
        echo "</table></div>";
    }
}

if ($volver) {
    header('Location:/ProyectoRecuperacion/index.php?menu=faltas');
}
?>
