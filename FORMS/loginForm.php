<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

$registrarse = isset($_POST['btnRegistro']);
$acceder = isset($_POST['btnAcceder']);


if ($registrarse) {

    header('Location: /ProyectoRecuperacion/index.php?menu=registro');

}

if ($acceder) {

    $usuario = $_POST['txtNombreUsuario'];
    $contraseña = $_POST['txtContraseña'];


    $existe = funcionesLogin::existeUsuario($usuario, $contraseña);

    if ($existe == true) {

        funcionesLogin::logIn($usuario);


        $user=RP_Usuario::BuscarPorDNI($usuario);
        

        $ID = $user -> getID();


        if($user->getRol() == 'Profesor'){
            
            header('Location: /ProyectoRecuperacion/index.php?menu=profesor');


        } 

        if($user->getRol() == 'Alumno'){
 
            header('Location: /ProyectoRecuperacion/index.php?menu=alumno&&ID='.$ID);
        }

        if($user->getRol() == 'Tutor'){
 
            header('Location: /ProyectoRecuperacion/index.php?menu=tutor');
        }

    }else{
        
            $mensaje = "No existe el usuario";
            echo '<div id="mensajeError">' . $mensaje . '</div>';

    }
}



?>
<div class="contenidoLogin">
    <form method="post">
        <div id="infologin">
            <div id="divTitulo">
                <label id="tituloLogin">LOGIN</label>
            </div>
            <div id="divUsuario">
                <div id="lblNombreUsuario">
                    <label>DNI:</label>
                </div>
                <div id="divtxtNombreUsuario">
                    <input type="text" name="txtNombreUsuario" id="txtNombreUsuario">
                </div>
            </div>
            <div id="divContraseña">
                <div id="lblContraseña">
                    <label>Contraseña:</label>
                </div>
                <div id="divtxtContraseña">
                    <input type="text" name="txtContraseña" id="txtContraseña">
                </div>
            </div>
            <div id="divBotones">
          
                    <input type="submit" value="Acceder" name="btnAcceder" id="btnAcceder">
               
               
                    <input type="submit" value="Registrarse" name="btnRegistro" id="btnRegistro">
            
            </div>
        </div>
    </form>
</div>
