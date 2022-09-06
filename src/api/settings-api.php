<?php

/**
 * 
 * 
 * 
 * 
 */
class Settings {

    // Woher die Einstellungen ziehe?
    function  __construct($SettingTable = "_einstellungen", $userTable = "_user") {

        // Tabelle festlegen
        $this->table = $SettingTable;
        $this->userTable = $userTable;

        // Alle Einstellungen auslesen
        $this->settings = $this->getAll();

        // Cache 
        $this->cache = [];
    }


    /**
     * 
     * ###### GET FUNKTIONEN
     * 
     */



    /**
     * Alle Einstellungen auslesen
     */
    function getAll() {

        global $db;

        // Einstellungen
        $settings = [];

        // Query
        $query = "SELECT * FROM `" . $this->table . "`";

        // Ergebnis
        $result = $db->query($query);

        // Prüfen ob es Ergebnisse gibt
        if ($result && $result->num_rows > 0) {

            // 
            while ($row = $result->fetch_assoc()) {

                // Key
                $key = $row['id'];

                // Alle Einstellungen kopieren
                $settings[$key] = $row;

                // Werte normalisieren
                $settings[$key]['global'] = ($row['global'] == 1) ? true : false;
                $settings[$key]['berechtigung'] = ($row['berechtigung'] == 1) ? true : false;

                // Wert normalisieren
                $settings[$key]['wert'] = (is_null($row['wert'])) ? $row['standard'] : $row['wert'];

                // Wenn der Binäre Wert vorhanden ist
                if ($row['binLength'] > 0 && strlen($settings[$key]['wert']) > 0) {

                    // Decimal wert abspeichern
                    $settings[$key]['decWert'] = $settings[$key]['wert'];

                    // Wert in Binär umsetzen
                    $settings[$key]['wert'] = $this->decimalToBinary($settings[$key]['wert'], $row['binLength']);
                }
            }
        }

        // Rückgabe
        return $settings;
    }


    /**
     * Gibt die Einstellungen eines Benutzers zurück
     */
    function getAllUser($userId) {

        // Maybe Create Cache at this point?
        // Cache prüfen 

        // Aus dem Cache bedienen
        if (isset($this->cache[$userId])) {

            // 
            $userSettings = $this->cache[$userId];

            // Cache wiederherstellen
        } else {

            // User Settings neu definieren
            $userSettings = $this->settings;

            // Die Admin-Werte setzen
            // #####################################

            // Prüfen ob der Benutzer ein Admin ist?
            $userApi = new User();
            $isAdmin = $userApi->isAdmin($userId);

            // Jetzt die Werte als Admin setzten
            if ($isAdmin) {

                // User Settings erneut durchgehen
                foreach ($userSettings as $key => $value) {

                    // Wenn es keinen AdminWert gibt
                    if (is_null($value['adminWert'])) {

                        // Wenn es sich um eine Berechtigung handelt
                        if ($value['berechtigung']) {
                            $userSettings[$key]['wert'] = 1;
                        }

                        // Wenn es einen Admin Wert gibt
                    } else {

                        // Wenn es ein Binärer Admin Wert ist
                        $userSettings[$key]['wert'] = ($value['binLength'] > 0) ? $this->decimalToBinary($value['adminWert'], $value['binLength']) : $value['adminWert'];

                        if ($value['binLength'] > 0) {
                            $userSettings[$key]['decWert'] = $value['adminWert'];
                        }
                    }
                }
            }


            // Die Daten aus der User-Tabelle mergen
            // #####################################

            // Die reinen Einstellungen aus der Datenbank holen
            $userSettingsRaw = $this->getAllUserRaw($userId);

            // Für jede Berechtigung
            foreach ($userSettingsRaw as $key => $value) {

                // Wenn der Key existiert
                if (isset($userSettings[$key]) && !$userSettings[$key]['global']) {

                    // Wenn es ein Binärer Admin Wert ist
                    $userSettings[$key]['wert'] = ($userSettings[$key]['binLength'] > 0) ? $this->decimalToBinary($value, $userSettings[$key]['binLength']) : $value;

                    // Dezimalwert auch setzen
                    if ($userSettings[$key]['binLength'] > 0) {
                        $userSettings[$key]['decWert'] = $value;
                    }
                }
            }

            // Berechtigungen ohne Wert noch setzen!
            // #####################################

            foreach ($userSettings as $key => $value) {
                if (is_null($value['wert']) && $value['berechtigung']) {
                    $userSettings[$key]['wert'] = 0;
                }
            }

            // Cache aktualisieren
            $this->cache[$userId] = $userSettings;
        }

        // Vollständiges Objekt zurückgeben
        return $userSettings;
    }

    function getAllUserRaw($userId) {

        global $db;

        // Select Query
        $query = "SELECT `einstellungen` FROM `" . $this->userTable . "` WHERE `id` = '" . $userId . "'";

        // Datenbank Abfrage
        $result = $db->query($query);

        // Prüfen ob ein Ergebnis da ist
        if ($result && $result->num_rows > 0) {

            // Ergebnis
            $settings = $this->decodeUserString($result->fetch_assoc()['einstellungen']);

            // Fehler ausgeben
        } else {
            throw new Exception("Der Benutzer konnte nicht gefunden werden!", 1);
        }

        return $settings;
    }

    function getCurrentUser() {
        return $this->getAllUser($this->getLoggedInUser());
    }


    /**
     * Gibt alle globalen Einstellungen zurück
     */
    function getAllGlobal() {

        // Globale Einstellungen
        $global = [];

        // Globale Einstellungen?
        foreach ($this->settings as $key => $value) {
            if ($value['global'] == 1) {
                $global[$key] = $value;
            }
        }

        return $global;
    }

    // Get
    // ##############

    function getByKey($key) {
        return ($this->isGlobal($key)) ? $this->getGlobalByKey($key) : $this->getCurrentUserByKey($key);
    }

    // Globale 
    function getGlobalByKey($key) {

        // Alle Globalen Einstellungen
        $global = $this->getAllGlobal();

        // Rückgabe
        return isset($global[$key]) ? $global[$key] : false;
    }

    // Benutzereinstellung
    function getUserByKey($key, $userId) {

        // Benutzereinstellungen 
        $userSettings = $this->getAllUser($userId);

        // Rückgabe
        return isset($userSettings[$key]) ? $userSettings[$key] : false;
    }

    // Benutzereinstellung
    function getCurrentUserByKey($key) {

        // Benutzereinstellungen 
        $userSettings = $this->getAllUser($this->getLoggedInUser());

        // Rückgabe
        return isset($userSettings[$key]) ? $userSettings[$key] : false;
    }



    // Get Value Only by Key
    // ################

    function getValueByKey($key) {
        return ($this->isGlobal($key)) ? $this->getGlobalValueByKey($key) : $this->getCurrentUserValueByKey($key);
    }

    // Global
    function getGlobalValueByKey($key) {
        $array = $this->getGlobalByKey($key);
        return $array['wert'];
    }

    // Einen Benutzer
    function getUserValueByKey($key, $userId) {
        $array = $this->getUserByKey($key, $userId);
        return $array['wert'];
    }

    // Aktuellen Benutzer
    function getCurrentUserValueByKey($key) {
        $array = $this->getUserByKey($key, $this->getLoggedInUser());
        return $array['wert'];
    }

    // Get Decimal Value Only by Key    
    // #############################


    function getDecValueByKey($key) {
        return ($this->isGlobal($key)) ? $this->getGlobalDecValueByKey($key) : $this->getCurrentUserDecValueByKey($key);
    }

    // Global
    function getGlobalDecValueByKey($key) {
        $array = $this->getGlobalByKey($key);
        return $array['decWert'];
    }

    // Benutzer
    function getUserDecValueByKey($key, $userId) {
        $array = $this->getUserByKey($key, $userId);
        return $array['decWert'];
    }

    // Aktueller Benutzer
    function getCurrentUserDecValueByKey($key) {
        $array = $this->getUserByKey($key, $this->getLoggedInUser());
        return $array['decWert'];
    }



    /**
     * 
     * ###### CHECK FUNKTIONEN
     * 
     */


    // Simple Check Funktionen
    // #######################


    // Prüfen gegeben 
    function checkGlobal($key, $checkValue = 1) {
        $value = ($this->isBinary($key)) ? $this->getGlobalDecValueByKey($key) : $this->getGlobalValueByKey($key);
        return ($value == $checkValue) ? true : false;
    }

    // Prüfen genen Benutzer Id
    function checkUser($key, $userId, $checkValue = 1) {
        $value = ($this->isBinary($key)) ? $this->getUserDecValueByKey($key, $userId) : $this->getUserValueByKey($key, $userId);
        return ($value == $checkValue) ? true : false;
    }

    // Aktuellen Benutzer
    function checkCurrentUser($key, $checkValue = 1) {
        return $this->checkUser($key, $this->getLoggedInUser(), $checkValue);
    }

    // Check And Redirect
    // ##################

    // Check And Redirect
    function checkAndRedirectUser($key, $url = "/", $userId = false, $checkValue = 1) {

        // Ergebnis
        $result = ($userId === false) ? $this->checkGlobal($key, $checkValue) : $this->checkUser($key, $userId, $checkValue);

        // Wenn das Ergebnis zutrifft
        if (!$result) {

            // Redirect
            header('Location: ' . $url);

            // Notfalls sterben, wenn die Header-Informationen schon gesendet wurden!
            die();
        }
    }

    // Current usser
    function checkAndRedirectCurrentUser($key, $url = "/", $checkValue = 1) {
        return $this->checkAndRedirectUser($key, $url, $this->getLoggedInUser(), $checkValue);
    }









    /**
     * 
     * ###### SAVE FUNKTIONEN
     * 
     */






    // Speichern
    function saveKey() {
    }






    /**
     * 
     * ## HELPER
     * 
     * 
     */

    // Logged In Benutzer herausfinden
    function getLoggedInUser() {

        // Benutzer
        $user = new User();
        $userId = $user->getLoggedInUserId();

        if ($userId && intval($userId) > 0) {
            return intval($userId);
        } else {
            throw new Exception("Es ist aktuell kein Benutzer eingeloggt!", 1);
        }
    }

    function isGlobal($key) {
        return (isset($this->settings[$key]) && $this->settings[$key]['global'] > 0) ? true : false;
    }

    function isBinary($key) {
        return (isset($this->settings[$key]) && $this->settings[$key]['binLength'] > 0) ? true : false;
    }

    function encodeUserString($array) {

        // Array nach Keys sortieren
        ksort($array);

        // Sub Array
        $subArray = [];

        // Schliefe für jedes Key Value Pair
        foreach ($array as $key => $value) {

            // Wenn es ein Array ist
            if (is_array($value)) {
                $value = implode("~", $value);
            }

            // Subarray
            $subArray[] = $key . ":" . str_replace([";", ":"], ["~!~", "~?~"], $value);
        }

        // Rückgabe
        return implode(";", $subArray);
    }

    /**
     * Parst einen Benutzer-Einstellungs-String
     */
    function decodeUserString($string) {

        // Permission Array
        $pmArray = [];

        // Prüfen ob überhaupt ein String vorhanden ist
        if (strlen($string) > 0) {

            // String = 14:1;18:1;39:1;50:Hallo Welt usw..
            // Nach ; auftrennen
            $array = explode(';', $string);

            // Key Value Pairs zuordnen
            foreach ($array as $value) {

                // Nach : auftrennen
                $sub = explode(':', $value);

                // In das Neue Array hinzufügen
                $pmArray[$sub[0]] = str_replace(["~!~", "~?~"], [";", ":"], $sub[1]);

                // Prüfen ob es ~~ als Mengentrenner gibt
                if (strpos($sub[1], "~")) {

                    // Wenn ja, dann sollen die Werte aufgetrennt werden
                    $pmArray[$sub[0]] = explode('~', $sub[1]);
                }
            }
        }

        // [8 => 1, 27 => 1, 28 => 2, 35 => 'Test', 49 => [12, 13]]
        return $pmArray;
    }



    function binaryToDecimal($binaryArray) {
        return bindec(implode($binaryArray));
    }


    function decimalToBinary($decimal, $binLength) {

        // Prüfen, dass der Maximalwert nicht überschritten wird.
        $maxBin = [];

        // Maximalwert zusammensetzen
        for ($i = 0; $i < $binLength; $i++) {
            $maxBin[] = 1;
        }

        // Umrechen in Dezimal
        $maxBinAsDec = $this->binaryToDecimal($maxBin);

        // Prüfen und ggf. Exception werden
        if ($maxBinAsDec < $decimal) {
            throw new Exception("Die Maximale Wert ist größer als der eingegebene Dezimalwert (" . $binLength . " = " . $maxBinAsDec . " | gegeben = " . $decimal . ")", 1);
        }

        // Rückgabe
        return str_split(str_pad(decbin($decimal), $binLength, '0', STR_PAD_LEFT));
    }
}
