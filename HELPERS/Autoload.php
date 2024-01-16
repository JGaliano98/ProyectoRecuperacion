<?php
class Autoload
{
    public static function autoload()
    {

        spl_autoload_register(function($clase){
            $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/Proyectorecuperacion/';
            $directorios = [
                'ENTITIES',
                'API',
                'FORMS',
                'HELPERS',
                'JS',
                'REPOSITORY',
                'STYLES',
                'VISTAS'
            ];

            foreach ($directorios as $directorio) {
                $archivo = $baseDir . $directorio . '/' . $clase . '.php';
                if (file_exists($archivo)) {
                    require_once $archivo;
                    return;
                }
            }  

        });
    }
}
    
?>