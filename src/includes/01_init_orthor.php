<?php session_start();

// Error Reporting
// error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ALL & ~E_NOTICE);

// Root
$_root = (isset($_root)) ? $_root : $_SERVER['DOCUMENT_ROOT'];

// Vendor Files einbinden!
require_once($_root.'/../vendor/autoload.php');

// Alle Dateien in dem Ordner "api/ einfügen", die mit -api.php enden
includeApiFile($_root.'/api');

// Alle Dateien in dem Ordner "api/plugins/" einfügen, die mit -api.php enden
includeApiFile($_root.'/api/plugins');

// Fügt die API Skripte mit ein
function includeApiFile($dir) {

    // Prüfen ob es sich um ein Verzeichnis handelt
    if(is_dir($dir)) {

        // Scandir
        $scan = scandir($dir);

        // Alle Dateien auf der Ebene prüfen
        foreach($scan AS $key => $value) {
            
            // Nur einfügen, wenn es eine PHP Datei mit der Endung ist und kein Ordner
            if($value != '.' && $value != '..' && is_file($dir."/".$value) && substr($value,-strlen('-api.php')) === '-api.php') {
                require_once($dir."/".$value);
            }   
        }
    }
}


?>