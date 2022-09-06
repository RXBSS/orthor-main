<?php

/**
 * 
 * 
 * 
 * 
 */
class User {

    // Cookie Zeit in Tagen
    public $cookieTime = 30;


    function __construct($userTable = '_user', $settingTable = "_einstellungen") {

        // usertable
        $this->userTable = $userTable;
        $this->settingTable = $settingTable;

        // Salt definieren
        $this->salt = isset($_SESSION['___settings']) &&  isset($_SESSION['___settings']['db']['salt'])? $_SESSION['___settings']['db']['salt'] :false;

        // Cookie prüfen
        $this->checkCookie();

    }


    // Hilfefunktionen    

    public function getUserById($id) {
        return $this->getUserData($id);
    }

    public function getUserByEMail($email) {
        return $this->getUserData($email, true);
    }


    /**
     * 
     * 
     * Gibt die Benutzerdaten als Array zurück, ansonsten false
     */
    public function getUserData($value, $isMail = false) {

        // Initalisieren
        $userData = false;
        global $db;

        //Sanitize
        $value = $db->real_escape_string($value);

        // Prüfen wir welches Feld ausgelesen werden soll
        $field = ($isMail) ? "email" : "id";

        // Select Query
        $query = "SELECT * FROM `".$this->userTable."` WHERE `".$field."` = '".$value."'";

        // Datenbank Abfrage
        $result = $db->query($query);
        
        // Prüfen ob ein Ergebnis da ist
        if($result->num_rows === 1) {
            $userData = $result->fetch_assoc();
        }

        return $userData;
    }


    /**
    * Prüfen ob Passwort mit Benutzer Eingabe übereinstimmt, 
    * ob  es der Benutzer gibt und ob er gesperrt ist
    * @param string $email
    * @param string $password
    */
    public function checkLogin($email, $password) {

        $success = false;
        $error = false;

        // Hier holen wir uns den Benutzer aus der Datenbank
        $user = $this->getUserByEmail($email);

        // Wenn es einen Benutzer gibt
        if($user) {

            // Prüfen ob die Konto gesperrt ist
            if(empty($user['sperre'] ) || $user['sperre'] != 1) {

                // Passwort prüfen
                $checkPw = $this->checkPassword($password, $user['passwort']);

                if($checkPw) {
                    $success = true;
                } else {
                    $error = "Das Passwort ist falsch";
                }

            // Fehlermeldung
            } else {
                $error = "Ihr Konto wurde gesperrt";
            }

        } else {
            $error = "Der Benutzer wurde nicht gefunden";
        }

        // Rückgabe
        return [
            'success' => $success,
            'error' => $error,
            'user' => $user
        ];
    }

    /**
    * This Function will login the user without checking.
    * Therefore check user to be authorized before using this function
    *
    * @param mixed $id 
    * @param boolean $mitCookie
     */
    public function doLogin($id, $mitCookie=false) {
        
        $success = false;
        $error = false;
        
        $user = $this->getUserById($id);

         // Prüfen ob der Login erfolgreich war
        if($user) {


            $success = true;

            // Benutzer in die Session schreiben
            $_SESSION['user'] = $user;
            $_SESSION['user']['isLoggedIn'] = true;

            // Einstellungen des Benutzers holen und speichern
            $_SESSION['user']['settings'] = serialize(new Settings($this->settingTable, $this->userTable));

            // Mit Cookie setzen
            if($mitCookie) {
                $this->setCookie($user['id']);
            }

        } else {
            $error = "Es ist ein Fehler beim Login aufgetreten";
        }

        return [
            'success' => $success,
            'error' => $error,
            'user' => $user
        ];
    }


    /**
     * Prüft ob der Benuzter ein Admin ist
     * // TODO: Muss noch fertiggestellt werden!
     */
    public function isAdmin($userId = true) {

        // Wenn kein Benutzer mitgeben wurde, dann der aktuelle Benutzer
        if($userId === true) {

        } else {

        }


        return false;
    }

    /**
    * ----------------------------------------------------------------------------------
    * ----------------------------------------------------------------------------------
    * ----------------------------------------------------------------------------------
    * User LogOut
    */
    public function logout() {

        // Beide Werte löschen
        $_SESSION['user'] = false;
        $_SESSION['user']['isLoggedIn'] = false;

        // Beide Variablen direkt löschen
        unset($_SESSION['user']);
        unset($_SESSION['user']['isLoggedIn']);


        // Cookie löschen
        $this->deleteCookie();
        
    }
    /**
    * ----------------------------------------------------------------------------------
    * ----------------------------------------------------------------------------------
    * ----------------------------------------------------------------------------------
    * Registrieren
    */

    public function doRegistered() {


        // Checkt eventuell ob man berechtigt ist sich selber ein Account anzulegen 
            // ---> eigen Funktion für Berechtigung weil man das an mehreren Stellen brauch


        //bekommt die Daten via Ajax die in die Input Felder geschrieben worden sind


        // Verarbeitet die Daten (Datenbank, Hash, ...)


        // Gibt eine Rückmeldung zurück


    }

    public function checkPassword($eingabe, $password) {

        $result = false;

        // Eingabe des Benutzers hashen
        $eingabeHash = $this->hashPassword($eingabe);

        // Password-Hashs vergleichen und prüfen das keins von Beiden leer ist
        if($password && $eingabeHash && $eingabeHash == $password) {
            $result = true;
        }

        return $result;
    }

    /**
     * Funktion zum Hashen eines Passwords
     * @param string $value
     */
    public function hashPassword($value) {	        

        // Salt
        $salt = $this->salt;    

        // Prüfen das das Salt auch vergeben ist
        if(strlen($salt) > 0) {
            $verified = hash('sha256',$salt.hash('sha256', $salt.$value));
            return $verified;
        } else {
            throw new Exception("Es gibt ein Problem mit dem Login!", 1);
        }
    }


    // Prüfen ob der Benutzer eingeloggt ist
    public function isLoggedIn() {
        return (isset($_SESSION['user']) && isset($_SESSION['user']['isLoggedIn'])  && $_SESSION['user']['isLoggedIn'] === true) ? true : false;
    }

    public function getLoggedInUserId() {
        return ($this->isLoggedIn()) ? $_SESSION['user']['id'] : false;
    }

    // Redirect On No Login
    public function redirectOnNoLogin() {
        
        $isLoggedIn = $this->isLoggedIn(); 

        // Wenn der Benutzer nicht eingeloggt ist
        if(!$isLoggedIn) {
            header('Location: login.php');
            die();
        }

    }



    public function passwordStartReset($email) {

        // Checkt eventuell ob man berechtigt ist das Password selber zu wechseln
            // ---> eigen Funktion für Berechtigung weil man das an mehreren Stellen brauch

        $success = false;
        global $db;


        // EMail Checken ob es den User gibt
        $userData = $this->getUserByEMail($email);

        if($userData) {

            // Generieren uns einen Hash
            $hash = hash("sha256", $email.time().rand(1000000000000000,99999999999999999)); 

            // Update Query
            $query = "UPDATE `".$this->userTable."` SET `passwort_reset` = '".$hash."' WHERE `id` = '".$userData['id']."'";
            
            // Prüfen ob das Update erfolgreich war
            if($db->query($query)) {

                // Link Erstellen
                $link = "<a href='login.php?reset=".$hash."'>Reset Passwort</a>";

                // TODO: Per Mail vesenden

                $_SESSION['log'][] = $link;
                $_SESSION['log'][] = $hash;
            }
        }

        return false;
    }

    // Hash
    public function passwordEndReset($hash, $password) {

        global $db;

        $success = false;

        // 
        $userData = $this->checkPasswordHash($hash);
        
        // 
        if($userData) {

            // Passwort 
            $passwordHash = $this->hashPassword($password);

            // Datenbank Abfrage
            $query = "UPDATE `".$this->userTable."` SET `passwort` = '".$passwordHash."', `passwort_reset` = NULL WHERE `id` = '".$userData['id']."'";

            if($db->query($query)) {
                $success = true;   

                // TODO: EMail mit Efolgreich Meldung
            }

        } else {

        }

        return $success;
    }


    public function checkPasswordHash($hash) {
        
        global $db;

        $userData = false;

        // Select Query
        $query = "SELECT * FROM `".$this->userTable."` WHERE `passwort_reset` = '".$hash."'";
        
        // Datenbank Abfrage
        $result = $db->query($query);
        
        // Prüfen ob ein Ergebnis da ist
        if($result->num_rows === 1) {
            
            $userData = $result->fetch_assoc();
        }

        return $userData;
    }




    /**
    * Save cookies to Database and Client
    * @param mixed $userId
    */

    public function setCookie($userId) {

        global $db;

        // Generieren uns einen Hash
        $hash = hash("sha256", $userId.time().rand(1000000000000000,99999999999999999)); 

        // Gültigkeit des cookies
        $gueltig = new DateTime();

        // Gültigkeitszeitraum addieren
        $gueltig->add(new DateInterval('P'.$this->cookieTime.'D'));

        // Speichern wir den Hash zu dem Benutzer
        $query = "INSERT INTO `".$this->userTable."_geraete` SET `user_id` = '".$userId."', `cookie` = '".$hash."', gueltig = '".$gueltig->format('Y-m-d H:i:s')."'";

        // Query ausführen
        $db->query($query);
    
        // Cookie Hash speichern
        setcookie("sli", $hash, $gueltig->format('U'), "/", null, true);
    }


   /**
   *  deletes cookie saved in browser from the database
    */
    public function deleteCookie() {       
        
        // Cookie löschen
        if(isset($_COOKIE['sli'])) {

            global $db;

            // Cookie in der Datenbank löschen
            $query = "DELETE FROM `".$this->userTable."_geraete` WHERE `cookie` = '".$_COOKIE['sli']."';";

            // Löschquery ausführen
            $db->query($query);

            unset($_COOKIE['sli']); 

            setcookie("sli", null, -1, "/");
        }
    }
    
   /**
    * check if there is an existing cookie saved and logs the user in with it
    */
    public function checkCookie() {
        
        // Prüfen ob ein Cookie da ist and Benutzer ist nicht eingeloggt
        if(isset($_COOKIE['sli']) && isset($_SESSION['user']['isLoggedIn']) && $_SESSION['user']['isLoggedIn'] != true) {
            
            global $db;

            // Alle alten Cookies löschen
            $this->clearOldCookies();

            // Hash
            $hash = $_COOKIE['sli'];

            // Select Query
            $query = "SELECT `user_id` FROM `".$this->userTable."_geraete` WHERE `cookie` = '".$hash."'";
            
            // Datenbank Abfrage
            $result = $db->query($query);
            
            // Prüfen ob ein Ergebnis da ist
            if($result->num_rows === 1) {

                // Benutzerdaten aus Datenbank holen
                $userData = $result->fetch_assoc();
                
                // Session setzen
               $this->doLogin($userData['id'],  true);
                
            } else {
                $this->deleteCookie();
            }
        }

    }

    public function clearOldCookies() {

        global $db;

        // Select Query
        $query = "DELETE FROM `".$this->userTable."_geraete` WHERE  `gueltig` < NOW();";

        // Löschquery ausführen
        $db->query($query);
    }

    public function generateRandomPassword($laenge = 8) {
        
        // Mindestlänge
        $laenge = ($laenge < 8) ? 8 : $laenge;

        // Array
        $array = [
            'abcdefghijklmnopqrstuvwxyz',
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            '1234567890',
            '!?#$'
        ];

        // Stellt sicher, dass mindestens 1 Zeichen integriert ist
        $shuffleArray = [0,1,2,3];

        // Verhältnis festlegen
        $verhaeltnis = "000001111122233";

        // Shuffle Array erstellen
        while(count($shuffleArray) < $laenge) {
            $shuffleArray[] = $verhaeltnis[rand(0, strlen($verhaeltnis) - 1)];
        }

        // Reihenfolge anpassen
        shuffle($shuffleArray);

        // Passwort Array erstellen
        $passArray = [];

        // Schleife 
        foreach($shuffleArray AS $number) {
            $passArray[] = $array[$number][rand(0, strlen($array[$number]) - 1)];
        }

        // Rückgabe
        return implode($passArray);
    }

}
