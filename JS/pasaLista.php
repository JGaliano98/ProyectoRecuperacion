<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

?>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    #contenedor {
        background-color: white;
        padding: 20px;
        margin: auto;
        width: 60%;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    input[type=date], #horaSeleccionada {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    #seleccionar, #guardarAsistencia {
        background-color: #007bff; 
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
    }

    #seleccionar:hover, #guardarAsistencia:hover {
        background-color: #0056b3; 
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px; 
    }

    th, td {
        text-align: left;
        padding: 8px;
        border: 1px solid #ddd;
    }

    th {
        background-color: #007bff; /* Azul */
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>



<div id="contenedor">
    <label>Fecha: </label>
    <input type="date" id="fechaSeleccionada" name="fechaSeleccionada" max="">
    
    <label>Hora: </label>
    <select id="horaSeleccionada">
        <option value="">Seleccione un tramo horario</option>
        <option value="1">08:00 - 09:00</option>
        <option value="2">09:00 - 10:00 </option>
        <option value="3">10:00 - 11:00</option>
        <option value="4">11:00 - 12:00</option>
        <option value="5">12:00 - 13:00</option>
        <option value="6">13:00 - 14:00</option>
    </select>

    <button id="seleccionar">Seleccionar</button>

    <button id="guardarAsistencia">Guardar</button>


 

    <table id="listaAsistencia">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Justificada (J)</th>
                <th>Injustificada (I)</th>
                <th>Retraso (R)</th>
            </tr>
        </thead>
        <tbody>
            <!-- Los alumnos se cargarán aquí -->
        </tbody>
    </table>
</div>

<script>
    // Establecer la fecha máxima como el día actual
    document.addEventListener("DOMContentLoaded", function() {
        var fechaActual = new Date().toISOString().split('T')[0]; // Obtener la fecha actual en formato YYYY-MM-DD
        document.getElementById("fechaSeleccionada").setAttribute("max", fechaActual); // Establecer el atributo max
    });
</script>

