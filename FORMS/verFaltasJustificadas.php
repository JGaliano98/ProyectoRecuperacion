<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();
$cierraSesion = isset($_POST['cierraSesion']);

$mostrar = RP_Falta::MostrarJustificadas();
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
if ($cierraSesion) {
    funcionesLogin::logOut("?menu=login");
}

?>
<form method="post">
<div id="cierraSesion">
    <input type="submit" id="btnCierraSesion" value="Cerrar Sesión" name="cierraSesion">
</div>
</form>
