<?php



class App {


    // Variablen
    public $version = "0.2.0";
    public $scriptVersion = 56;

    // Constructor 
    function __construct() {

        // Datenbank Verbindung
        $this->checkMinimumRequirements();

        // Konfigurationsdatei auslesen
        $configOk = $this->readConfig();

        if(!$configOk) {
            header('Location: install.php');
            die();
        }

        // Datenbank Verbindung
        $this->dbConnect();

        // Zeitzone einstellen!
        date_default_timezone_set('Europe/Berlin');

        // 
        $_SESSION['log'] = [];

        // Initalisiren
        $this->initUser();

        // If
        if (isset($_SESSION['user']['settings'])) {
            $this->settings = unserialize($_SESSION['user']['settings']);
        }
    }

    // 
    public function initUser() {
       
        // User API speichern
        $this->user = new User();
    }


    /**
     * Datenbank Verbindung aufbauen
     * Hier wird die Datenbank-Verbindung zum MySQL Server aufgebbaut. Sollte etwas fehlschlagen wird der weitere Aufbau der Seite abgebrochen
     * 
     * Die Verbindung ist immer über die Variable $db erreichbar. 
     * In Funktionen kann diese mit global $db zugänglich gemacht werden und muss nicht über Argumente mitgegeben werden
     *
     * @return void
     */
    function dbConnect() {

        // Variable als Global
        global $db;

        $db = new mysqli(
            $_SESSION['___settings']['db']['url'],
            $_SESSION['___settings']['db']['user'],
            $_SESSION['___settings']['db']['password'],
            $_SESSION['___settings']['db']['name']
        );


        // Prüfen ob ein Aufbau der Datenbank-Verbindungen möglich war. 
        // Falls nicht, wird das Laden der Seite hier abgebrochen!
        if (mysqli_connect_errno()) {
            echo "Fehler in der Datenbankverbindung! Änderen Sie die Konfiguration oder passen Sie die Datenbank an! Danach bitte neu laden!";
            session_destroy();
            die();
        }

        // Prüfen ob die Datenbank Verbindung auf UTF-8 gesetzt werde kann
        // Falls nicht, wird das Laden der Seite hier abgebrochen!
        if (!$db->set_charset("utf8")) {
            echo "Fehler in der Datenbankverbindung! Änderen Sie die Konfiguration oder passen Sie die Datenbank an! Danach bitte neu laden!";
            session_destroy();
            die();
        }
    }

    /**
     * Liest die Konfigurations- und Versions-  Datei ein und prüft ob alle Pflichtfelder vorhanden sind. 
     * Setzt die Session Settings und Version
     *
     * @return void
     */
    function readConfig() {

        $result = true;

        // System
        global $_system_id;

        // Prüfung, dass es sich um die richtige Session handelt
        if (isset($_SESSION['___settings'])) {

            // System ID = System ID 
            if (!isset($_SESSION['___settings']['system']) || !isset($_SESSION['___settings']['system']['id']) || $_SESSION['___settings']['system']['id'] != $_system_id) {

                // Session zerstören
                session_destroy();

                // Weiterleiten
                header('Location: ' . $_SERVER['PHP_SELF']);

                // Fehlermeldung ausgeben
                echo "Die Weiterleitung ist fehlgeschlagen";

                // Verhindern, dass es im Fehlerfall weitergeht!a
                die();
            }
        }

        // Prüfe ob die Settings schon aus der Datei in die Session gelesen wurden
        if (!isset($_SESSION['___settings'])) {
            
            $configFile = "config.json";

            // Prüfen ob die Config Datei existiert
            if (is_file($configFile)) {

                // Config Datei als String einlesen und nach Vollständigkeit prüfen
                $config = file_get_contents($configFile);
                $missingConfig = $this->checkMissingConfig($configFile);

                if (!$missingConfig) {

                    // Aus dem JSON String ein PHP Array machen
                    $settings = json_decode($config, true);

                    // Settings in die Session schreiben
                    $_SESSION['___settings'] = $settings;

                    // Version aus Version-File auslesen
                    $_SESSION['___settings']['system']['version'] = (is_file("VERSION")) ? file_get_contents("VERSION") : false;
                    $_SESSION['___settings']['system']['version_orthor'] = (is_file("VERSION_ORTHOR")) ? file_get_contents("VERSION_ORTHOR") : false;
                } else {
                    $result = false;
                    die();
                }
            } else {
                $result = false;
            }
        }


        return $result;
    }

    /**
     * Prüft ob die config.json Datei jede Einstellung verfügt. Gibt eine Array mit dem fehlenden Konfig zurück
     *
     * @param string $file Pfad zum config.json Datei
     * @return Array
     */
    function checkMissingConfig($file) {

        //config einlesen   
        $config = json_decode(file_get_contents($file), true);

        // Missing
        $missing = [];

        //Pflichtfelder bestimmen
        $fields = [
            "system"  => ["name", "root", "id"],
            "db"           => ["url", "user", "password",  "name", "salt"],
            "address" => ["name", "street", "zip", "city", "country"],
            "mail"        => ["server", "port", "auth", "user", "password", "secure", "sender", "senderName", "reply", "replyName", "debug", "debugMail"]
        ];


        // Level 1
        foreach ($fields as $key => $subarray) {

            // Prüfen das der Punkt generell exisitert
            if (isset($config[$key])) {

                // Level 2
                foreach ($subarray as $value) {
                    if (isset($config[$key][$value]) === false) {
                        $missing[] = $key . " > " . $value;
                    }
                }

                // Wenn der komplette 
            } else {
                $missing[] = $key;
            }
        }

        // 
        return (count($missing) > 0) ? $missing : false;
    }

    // PHP Version
    public function checkMinimumRequirements() {

        // PHP Version prüfen
        $phpVersion = explode('.', PHP_VERSION);

        // Wenn die PHP Version kleiner ist als 7.3.0
        if (intval($phpVersion[0]) < 7 || (intval($phpVersion[0]) == 7 && intval($phpVersion[1]) < 3)) {
            echo "PHP Version ist zu alt.<br>Die Version im Einsatz ist die " . implode(".", $phpVersion) . ", benötigt wird aber mindestens 7.3.0";
            die();
        }
    }
}
