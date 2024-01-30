<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ProyectoRecuperacion/Helpers/Autoload.php';
Autoload::Autoload();

$validator = new Validator();

//Para que los errores de primeras se encuentren vacios.
$errores = [
    'dni' => '',
    'contraseña' => '',
    'nombre' => '',
    'apellido1' => '',
    'apellido2' => '',
    'telefono' => '',
    'correo' => '',
    'curso' => ''
];

$acceder = isset($_POST['btnAccederReg']) ? $_POST['btnAccederReg'] : '';
$registrar = isset($_POST['btnRegistroReg']) ? $_POST['btnRegistroReg'] : '';

if ($acceder) {
    header('Location: /ProyectoRecuperacion/index.php?menu=login');
}

if ($registrar) {
    $DNI = $_POST['txtDNI'];
    $Contraseña = $_POST['txtContraseñaReg'];
    $Nombre = $_POST['txtNombreReg'];
    $Apellido1 = $_POST['txtAp1Reg'];
    $Apellido2 = $_POST['txtAp2Reg'];
    $Telefono = $_POST['txtTelefonoReg'];
    $Correo = $_POST['txtCorreoReg'];
    $Curso = $_POST['txtCursoReg'];

    // Validaciones
    if (!$validator->validaDNI($DNI)) {
        $errores['dni'] = "DNI inválido.";
    }
    if (!$validator->validaContraseña($Contraseña)) {
        $errores['contraseña'] = "Contraseña inválida.";
    }
    if (!$validator->validaNombre($Nombre, 50, 1)) {
        $errores['nombre'] = "Nombre inválido.";
    }
    if (!$validator->validaApellido($Apellido1, 50, 1)) {
        $errores['apellido1'] = "Primer apellido inválido.";
    }
    if (!$validator->validaApellido($Apellido2, 50, 1)) {
        $errores['apellido2'] = "Segundo apellido inválido.";
    }
    if (!$validator->validaTlf($Telefono)) {
        $errores['telefono'] = "Teléfono inválido.";
    }
    if (!$validator->validaCorreo($Correo)) {
        $errores['correo'] = "Correo electrónico inválido.";
    }

    if (empty(array_filter($errores))) {
        $alumno = new Usuario(1, $DNI, $Nombre, $Apellido1, $Apellido2, $Telefono, $Correo, "Alumno", "No", $Curso, $Contraseña);
        if (RP_Usuario::existeUsuario($DNI)) {
            $errores['dni'] = "El usuario ya existe.";
        } else {
            RP_Usuario::InsertaObjeto($alumno);
            echo '<script>alert("Usuario registrado con éxito.");</script>';
        }
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
                        <label>DNI:</label>
                        <input type="text" name="txtDNI" id="txtDNI">
                        <div class="error"><?php echo $errores['dni']; ?></div>
                        <br>
                    </div>

                    <div id="divContraseñaReg">
                        <label>Contraseña:</label>
                        <input type="password" name="txtContraseñaReg" id="txtContraseñaReg">
                        <div class="error"><?php echo $errores['contraseña']; ?></div>
                        <br>
                    </div>

                    <div id="divNombreReg">
                        <label>Nombre:</label>
                        <input type="text" name="txtNombreReg" id="txtNombreReg">
                        <div class="error"><?php echo $errores['nombre']; ?></div>
                        <br>
                    </div>

                    <div id="divAp1Reg">
                        <label>Primer Apellido:</label>
                        <input type="text" name="txtAp1Reg" id="txtAp1Reg">
                        <div class="error"><?php echo $errores['apellido1']; ?></div>
                        <br>
                    </div>
                </div>

                <div id="divDerecha">
                    <div id="divAp2Reg">
                        <label>Segundo Apellido:</label>
                        <input type="text" name="txtAp2Reg" id="txtAp2Reg">
                        <div class="error"><?php echo $errores['apellido2']; ?></div>
                        <br>
                    </div>

                    <div id="divTelefonoReg">
                        <label>Teléfono:</label>
                        <input type="text" name="txtTelefonoReg" id="txtTelefonoReg">
                        <div class="error"><?php echo $errores['telefono']; ?></div>
                        <br>
                    </div>

                    <div id="divCorreoReg">
                        <label>Correo Electrónico:</label>
                        <input type="email" name="txtCorreoReg" id="txtCorreoReg">
                        <div class="error"><?php echo $errores['correo']; ?></div>
                        <br>
                    </div>

                    <div id="divCursoReg">
                        <label>Curso:</label>
                        <input type="text" name="txtCursoReg" id="txtCursoReg">
                        <div class="error"><?php echo $errores['curso']; ?></div>
                        <br>
                    </div>
                </div>
                
                <div id="divBotonesReg">
                    <div id="divBtnAccederReg">
                        <input type="submit" value="Acceder" name="btnAccederReg" id="btnAccederReg">
                    </div>

                    <div id="divBtnRegistroReg">
                        <input type="submit" value="Registrarse" name="btnRegistroReg" id="btnRegistroReg">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>




