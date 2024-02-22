<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();



$volver = isset($_POST['btnAccederReg']) ? $_POST['btnAccederReg'] :'';
$registrar = isset($_POST['btnRegistroReg']) ? $_POST['btnRegistroReg'] :'';

if ($volver) {

    header('Location: /ProyectoRecuperacion/index.php?menu=tutor');

}

if ($registrar) {


    $DNI=$_POST['txtDNI'];
    $Contraseña=$_POST['txtContraseñaReg'];
    $Nombre=$_POST['txtNombreReg'];
    $Apellido1=$_POST['txtAp1Reg'];
    $Apellido2=$_POST['txtAp2Reg'];
    $Telefono=$_POST['txtTelefonoReg'];
    $Correo=$_POST['txtCorreoReg'];
    $Curso=$_POST['txtCursoReg'];


    $alumno = new Usuario(1,$DNI,$Nombre,$Apellido1,$Apellido2,$Telefono,$Correo,"Alumno","No",$Curso,$Contraseña);

    if(RP_Usuario::existeUsuario($DNI)==true){

        ?><script>alert("El usuario ya existe.");</script><?php

    } else {

        RP_Usuario::InsertaObjeto($alumno);
        
        ?><script>alert("Usuario registrado con éxito.");</script><?php
    }

    
    

}

?>
 


<div class="contenidoRegistro">
    <form method="post">
        <div id="inforegistro">

            <div id="divTituloReg">
                <label id="tituloRegistro">NUEVO ALUMNO</label>
            </div>

            <div id="divContenidoReg">

                <div id="divIzquierda">

                    <div id="divDNIReg">
                        <div id="divlblDNIReg">
                            <label>DNI:</label>
                        </div>
                        <div id="divtxtDNIReg">
                            <input type="text" name="txtDNI" id="txtDNI" data-valida="dni">
                        </div>
                    </div>

                    <div id="divContraseñaReg">
                        <div id="lblContraseñaReg">
                            <label>Contraseña:</label>
                        </div>
                        <div id="divtxtContraseñaReg">
                            <input type="text" name="txtContraseñaReg" id="txtContraseñaReg" data-valida="relleno">
                        </div>
                    </div>

                    <div id="divNombreReg">
                        <div id="lblNombreReg">
                            <label>Nombre:</label>
                        </div>
                        <div id="divtxtNombreReg">
                            <input type="text" name="txtNombreReg" id="txtNombreReg" data-valida="relleno">
                        </div>
                    </div>

                    <div id="divAp1Reg">
                        <div id="lblAp1Reg">
                            <label>Primer Apellido:</label>
                        </div>
                        <div id="divtxtAp1Reg">
                            <input type="text" name="txtAp1Reg" id="txtAp1Reg" data-valida="relleno">
                        </div>
                    </div>

                   

                </div>

                <div id="divDerecha">


                    <div id="divAp2Reg">
                        <div id="lblAp2Reg">
                            <label>Segundo Apellido:</label>
                        </div>
                        <div id="divtxtAp2Reg">
                            <input type="text" name="txtAp2Reg" id="txtAp2Reg">
                        </div>
                    </div>

                    <div id="divTelefonoReg">
                        <div id="lblTelefonoReg">
                            <label>Teléfono:</label>
                        </div>
                        <div id="divtxtTelefonoReg">
                            <input type="text" name="txtTelefonoReg" id="txtTelefonoReg" data-valida="telefono">
                        </div>
                    </div>


                    <div id="divCorreoReg">
                        <div id="lblCorreoReg">
                            <label>Correo Electrónico:</label>
                        </div>
                        <div id="divtxtCorreoReg">
                            <input type="text" name="txtCorreoReg" id="txtCorreoReg" data-valida="correoElectronico">
                        </div>
                    </div>


                    <div id="divCursoReg">
                        <div id="lblCursoReg">
                            <label>Curso:</label>
                        </div>
                        <div id="divtxtCursoReg">
                            <input type="text" name="txtCursoReg" id="txtCursoReg" data-valida="curso">
                        </div>
                    </div>


                </div>

                
                <div id="divBotonesReg">

                    <div id="divBtnAccederReg">
                        <input type="submit" value="Volver" name="btnAccederReg" id="btnAccederReg">
                    </div>

                    <div id="divBtnRegistroReg">
                        <input type="submit" value="Crear" name="btnRegistroReg" id="btnRegistroReg">
                    </div>
                        
                </div>

            </div>
            
        </div>
    </form>
</div>



