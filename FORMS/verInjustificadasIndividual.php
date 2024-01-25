<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();
$cierraSesion = isset($_POST['cierraSesion']);


$ID = $_GET['ID'];


$mostrar = RP_Falta::MostrarInjustificadasPorUsuario($ID);

$obj = RP_Falta::MostrarInjustificadasPorUsuarioOBJ($ID);

$IDfalta = $obj -> getID();



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
                <th>Justificar</th>
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
                    <td>
                        <form method="post">
                            <input type="hidden" name="IDfalta" value="<?php echo $key->getID(); ?>">
                            <input type="submit" name="btnJustificar<?php echo $i ?>" id="botonJustificar" value="Justificar">
                        </form>
                    </td>
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
for ($j = 0; $j < $i; $j++) {
    if (isset($_POST['btnJustificar' . $j])) {

        $IDfalta = $_POST['IDfalta'];
        echo '<script>window.location.href="?menu=justificar&ID=' . $ID . '&IDfalta=' . $IDfalta . '";</script>';
        
    }
}

?>
<form method="post">
<div id="cierraSesion">
    <input type="submit" id="btnCierraSesion" value="Cerrar Sesión" name="cierraSesion">
</div>
</form>
