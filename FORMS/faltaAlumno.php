<?php


require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

?>


<style>
    body {
        font-family: Arial, sans-serif;
    }
    form {
        margin: 20px auto;
        width: 70%; 
        max-width: 500px; 
    }

    label {
        font-weight: bold;
        margin-top: 10px;
    }

    input[type="text"] {
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
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre"><br>

    <label for="apellido1">Apellido 1:</label><br>
    <input type="text" id="apellido1" name="apellido1"><br>

    <label for="apellido2">Apellido 2:</label><br>
    <input type="text" id="apellido2" name="apellido2"><br>

    <input type="submit" value="Consultar" name="btnConsultar">

    <input type="submit" id="btnVolverElim" value="Volver" name="btnVolverAlu">


</form>

<?php

$consultar = isset( $_POST['btnConsultar']);
$volver=isset($_POST['btnVolverAlu']);

if($consultar){


    $nombre=$_POST['nombre'];
    $apellido1=$_POST['apellido1'];
    $apellido2=$_POST['apellido2'];



    $alumno = RP_Usuario::BuscarPorNombreCompleto($nombre, $apellido1, $apellido2);

    if ($alumno !== null){


        $ID_Alumno = $alumno->getID();


        $mostrar = RP_Falta::MostrarFaltasPorUsuario($ID_Alumno);
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


    } else {
        echo("No existe el usuario");
    }

}


if($volver) {
    
    header('Location:/ProyectoRecuperacion/index.php?menu=faltas');
}
?>