<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portal de Faltas Las Fuentezuelas</title>
    <link rel="stylesheet" href="Styles/estilos.css">
    <script src="JS/pdf.js"></script>
    <script src="JS/horario.js"></script>
    <script src="JS/justificarFalta.js"></script>
</head>

<body id = "fondo">

    <div class="fondoInicio">
        
        <div id="divHeader">
            <?php
                require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/VISTAS/header.php';
            ?>
        </div>

        <div id="cuerpo">
            <?php
                require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/VISTAS/enrutador.php';
            ?>
        </div>

        <div id="divFooter">
            <?php
            require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/VISTAS/footer.php';
            ?>
        </div>

    </div>
</body>

</html>
