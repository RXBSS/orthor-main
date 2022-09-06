<?php

/**
 * Vereinfachung von AJAX Requests
 * 
 * // Noch geplante Features
 * // GET QUERY
 * // INSERT OR UPDATE
 * // DUPLICATE CHECK
 * 
 * 
 * 
 */
class Request {


    // Defaults
    public $success = false;
    public $error = false;
    public $message = false;
    public $data = false;
    public $result = false;
    public $resetData = false;
    public $task = false;
    public $resetSuccess = null;
    public $log = [];

    // Constructor
    function __construct($data = false, $noSanitation = false) {

        $this->log[] = "-- Constructor";

        // Wenn es eine Datenbasis gibt!
        if ($data) {
            $this->log[] = "- with Data";
            $this->log[] = $data;

            $this->setData(($noSanitation === false) ? $this->sanitize($data) : $data);

            // Task setzen
            if (isset($data['task'])) {
                $this->task = $data['task'];
            }
        }
    }



    // Bereinig ein Array
    public function sanitize($array) {

        global $db;

        foreach ($array as $key => $value) {

            if ($value === 'true') {
                $value = true;
            }

            if ($value === 'false') {
                $value = false;
            }

            $array[$key] = (is_array($value)) ? $this->sanitize($value) : ((is_string($value)) ? $db->real_escape_string($value) : $value);
        }

        return $array;
    }

    // Daten setzen
    public function setData($data) {

        // Daten setzen
        $this->data = false;
        $this->data = $data;
    }


    // Insert Funciton
    public function insert($table, $array) {

        $this->log[] = "- Called Function >insert<";

        // Query Data holen
        $queryData = $this->queryHelper($array);

        // Query Erstellen
        $query = "INSERT INTO `" . $table . "` SET " . implode(", ", $queryData);

        // Insert Query
        $this->insertQuery($query);

        // Build Reset 
        $this->resetData = [
            'id' => $this->result,
            'table' => $table,
            'auto_increment' => true
        ];
    }


    /**
     * Fügt mehrere Werte in die gleiche Tabelle ein. 
     * Baut dabei eine Query die wie folgt aussieht: 
     * 
     * INSERT INTO `table` (`field1`, `field2`) VALUES ('1','2'), ('3', '4');
     * 
     * // TODO: Insert Multiple
     */
    public function insertMultiple($table, $process) {

        $this->log[] = "- Called Function >insertMultiple<";

        // Die Keys aus dem ersten Datensatz erhalten
        $keys = $this->getQueryKeys($process);

        // Query Erstellen
        $query = "INSERT INTO `" . $table . "` (`" . implode("`,`", $keys) . "`) VALUES ";

        // Fertige Reihen
        $rows = [];

        // Alle Datensätze loopen
        foreach ($this->data as $data) {

            // Column initalisieren
            $cols = [];

            // Das Process Array durchgehen
            foreach ($process as $value) {

                // Wenn es die Spalte gibt
                if (isset($data[$value[1]])) {
                    $cols[] = $this->getFormattedValue($data[$value[1]], $value);
                }
            }

            // Column in die Rows packen
            $rows[] = implode(",", $cols);
        }

        // Query anfügen
        $query .= " (" . implode("),(", $rows) . ")";

        // Insert Query
        $this->insertMultiQuery($query);
    }



    /**
     * Insert Query
     */
    public function insertQuery($query) {

        $this->log[] = "- Called Function >insertQuery<";

        global $db;

        $success = false;
        $error = false;

        // Datenbank Abfrage
        $result = $db->query($query);

        // Wenn die Query funktioniert hat
        if ($result) {

            // Insert Id
            $insert_id = $db->insert_id;
            $success = true;
        } else {
            $error = "Fehler beim Schreiben in die Datenbank. " . $db->error;
            $this->log[] = $query;
            $this->log[] = $db->error;
        }

        // Ergebnisse schreiben
        $this->success = $success;
        $this->error = $error;
        $this->result = ($success) ? $insert_id : false;
    }


    public function insertMultiQuery($query) {

        $this->log[] = "- Called Function >insertMultiQuery<";

        global $db;

        $success = false;
        $error = false;

        // Datenbank Abfrage
        $result = $db->query($query);

        // Wenn die Query funktioniert hat
        if ($result) {
            $success = true;
        } else {
            $error = "Fehler beim Schreiben in die Datenbank. " . $db->error;
            $this->log[] = $query;
            $this->log[] = $db->error;
        }

        // Ergebnisse schreiben
        $this->success = $success;
        $this->error = $error;
        $this->result = ($success) ? true : false;
    }


    // Update Funktion
    public function update($table, $array, $where, $afftected = false) {

        $this->log[] = "- Called Function >update<";

        // Init
        global $db;
        $success = false;
        $error = false;
        $continue = false;


        // Wenn geprüft werden muss, wie viele Rows betroffen sind
        if ($afftected !== false) {

            $this->log[] = "Es wurde eingestellt, dass eine Prüfung stattfinden muss, das alle Zeile existieren!";

            // Hier muss geprüft werden, das der Filter wirklich exitsitert
            $query = "SELECT COUNT(*) AS `counter` FROM `" . $table . "` " . $where;
            $this->log[] = $query;

            // Datenbank Abfrage
            $result = $db->query($query);

            // Prüfen, dass die Query durchlaufen konnte
            if ($result) {

                // Anzahl an Zeilen mit dem Filter
                $rows = $result->fetch_assoc();

                // Anzahl der geforderten Query 
                $needed = (is_array($afftected)) ? count($afftected) : $afftected;

                // Prüfen, dass die Anzahl der Zeilen des Where Filters auch aktualisiert wurden
                if ($rows['counter'] == $needed) {
                    $this->log[] = "Die Prüfung war erfolgreich";
                    $continue = true;


                    // Wenn die Prüfung nicht erfolgreich war
                } else {
                    $error = "Es wurden " . $rows['counter'] . " Zeilen mit dem Filter gefunden, es müssten aber " . $needed . " sein!";
                    $this->log[] = $error;
                }

                // Wenn die Query nicht funktioniert hat
            } else {
                $this->log[] = $db->error;
                $error = "Es konnte nicht geprüft werden, dass alle Zeilen vorhanden sind";
            }

            // Wenn egal ist, wie viele Rows betroffen sind
        } else {
            $continue = true;
        }

        // Wenn das Update durchgeführt werden darf
        if ($continue) {

            // Query Data holen
            $queryData = $this->queryHelper($array);

            // Query Erstellen
            $query = "UPDATE `" . $table . "` SET " . implode(", ", $queryData) . " " . $where;

            $this->log[] = "- Update Query";
            $this->log[] = $query;

            // Datenbank Abfrage
            $result = $db->query($query);

            // Wenn das Ergebnis erfolgreich war
            if ($result) {

                // Setzte Success auf true
                $success = true;

                // Anzahl der Zeilen, die wirklich geändert wurden
                $this->log[] = "Es wurden " . $db->affected_rows . " aktualisiert";

                // Wenn beim Schreiben ein Fehler aufgetreten ist
            } else {
                $this->log[] = $db->error;
                $error = "Fehler beim Schreiben in die Datenbank. " . $db->error;
            }
        }

        // Ergebnisse schreiben
        $this->success = $success;
        $this->error = $error;
    }

    /**
     * Für ein Update einer bestimmten ID durch. Dadurch braucht man nicht mehr extra die Query 
     * "WHERE `id` = '".$id."'" schreiben.
     *      * 
     *
     * @param string $table Die Tabelle die aktualisiert werden soll
     * @param array $process Das Process Array
     * @param integer $id Die ID die aktualisiert werden soll
     * @return void
     */
    public function updateById($table, $process, $id, $noCheck = false) {
        $this->updateByKey($table, $process, 'id', $id, $noCheck);
    }


    /**
     * Update By Key
     */
    public function updateByKey($table, $process, $key, $value, $noCheck = false) {

        // Where 
        $where = " WHERE " . ((is_array($value)) ? "`" . $key . "` IN ('" . implode("','", $value) . "')" : "`" . $key . "` = '" . $value . "'");

        // Prüfen ob ein Check durchgeführt werden soll
        if ($noCheck) {

            // Übergabe
            $this->update($table, $process, $where);
        } else {

            // Übergabe
            $this->update($table, $process, $where, (is_array($value)) ? count($value) : 1);
        }
    }



    public function updateByKeyValuePair($table, $process, $keyValuePair) {

        $filter = $this->keyValuePairToFilter($keyValuePair);

        // Where 
        $where = " WHERE " . implode(" AND ", $filter);

        // Übergabe
        $this->update($table, $process, $where);
    }

    // Simple Delete
    public function delete($table, $id, $condition = false) {

        // Sollte ein Array übergeben werden - Dann eine Condition Query generieren
        if ($condition != false && is_array($condition)) {
            $condition['id'] = $id;
            $condition = $this->getDeleteFilterCondition($table, $condition);
        }

        $this->log[] = "- Called Function >delete<";
        $query = "DELETE FROM `" . $table . "` WHERE `id` = '" . $id . "';";
        $this->deleteQuery($query, $condition);
    }

    // 
    public function deleteByKey($table, $key, $value, $condition = false) {

        // Sollte ein Array übergeben werden - Dann eine Condition Query generieren
        if ($condition != false && is_array($condition)) {
            $condition[$key] = $value;
            $condition = $this->getDeleteFilterCondition($table, $condition);
        }

        $this->log[] = "- Called Function >delete<";
        $query = "DELETE FROM `" . $table . "` WHERE `" . $key . "` = '" . $value . "';";
        $this->deleteQuery($query, $condition);
    }

    // 
    public function deleteByKeyValuePair($table, $keyValuePair) {

        $filter = $this->keyValuePairToFilter($keyValuePair);

        $this->log[] = "- Called Function >deleteByKeyValuePair<";

        $query = "DELETE FROM `" . $table . "` WHERE " . implode(" AND ", $filter);
        $this->deleteQuery($query);
    }

    /**
     * 
     * // 
     * $req->deleteMultiple("sometable", [12,34], ['field' => 'value']);
     * 
     * 
     */
    public function deleteMultiple($table, $ids, $condition = false) {

        $this->log[] = "- Called Function >deleteMultiple<";

        // Sollte ein Array übergeben werden - Dann eine Condition Query generieren
        if ($condition != false && is_array($condition)) {
            $condition['id'] = [$ids];
            $condition = $this->getDeleteFilterCondition($table, $condition);
        }

        $ids = (is_array($ids)) ? $ids : [$ids];
        $query = "DELETE FROM `" . $table . "` WHERE `id` IN ('" . implode("','", $ids) . "');";
        $this->deleteQuery($query, $condition);
    }


    public function deleteMultipleByKey($table, $key, $value, $condition = false) {

        $this->log[] = "- Called Function >deleteMultipleByKey<";

        // Sollte ein Array übergeben werden - Dann eine Condition Query generieren
        if ($condition != false && is_array($condition)) {
            $condition[$key] = $value;
            $condition = $this->getDeleteFilterCondition($table, $condition);
        }

        $value = (is_array($value)) ? $value : [$value];
        $query = "DELETE FROM `" . $table . "` WHERE `" . $key . "` IN ('" . implode("','", $value) . "');";
        $this->deleteQuery($query, $condition);
    }



    public function deleteQuery($query, $condition = false) {

        global $db;

        $this->log[] = "- Called Function >deleteQuery<";

        $continue = true;

        if ($condition != false) {

            // Prüfen, dass es ein String ist
            if (is_string($condition)) {

                $this->log[] = "- Delete Funktion with Condition";

                // Subrequest
                $req = new Request();

                // Daten auslesen
                $req->getQuery($condition);

                // Löschen ist möglich!
                if ($req->result['count'] == 0) {
                    $this->success = false;
                    $this->error = "Die Bedingung trifft nicht zu!";
                    $continue = false;
                }

                // Falls ein Array oder etwas anderes übergeben wurde
            } else {
                $this->success = false;
                $this->error = "Es wurde ein falscher Parameter übergeben (Condition muss ein String sein)";
                $continue = false;
            }
        }

        if ($continue) {

            // Query
            $result = $db->query($query);

            if ($result) {
                $this->success = true;
            } else {
                $this->log[] = $db->error;
                $this->log[] = $query;
                $this->error = "Fehler beim Löschen";
            }
        }
    }

    public function getDeleteFilterCondition($table, $condition) {

        // Filter
        $filters = [];

        // Schliefe durch alle Bedingungen
        foreach ($condition as $key => $value) {
            $filters[] = "`" . $key . "` " . ((is_array($value)) ? " IN ('" . implode("','", $value) . "')" : " = '" . $value . "'");
        }

        // Query
        $query = "SELECT COUNT(*) AS count FROM `" . $table . "` WHERE " . implode(" AND ", $filters);

        return $query;
    }


    public function keyValuePairToFilter($keyValuePair) {

        $filter = [];

        foreach ($keyValuePair as $key => $value) {
            $filter[] = "`" . $key . "` " . ((is_array($value)) ? " IN ('" . implode("','", $value) . "')" : " = '" . $value . "'");
        }

        return $filter;
    }



    /**
     * Funktion zum Ergänzen von Werten.
     * Am einfachsten ist diese Funktion anhand eines Beispiels zu Erklären: 
     * 
     * Zu einem Angebot gibt es N Kontakte (1:N).
     * Wenn nun ein Mitarbeiter das Angebot bearbeitet, kann es sein, dass er die zugehörigen Kontakte gelöscht, ergänzt und aktualisiert hat. 
     * Man muss als folgendes tun: 
     * 
     * - In die Datenbank schauen und auslesen, welche Kontakte aktuell dort stehen. 
     * - Die Kontakte die vom Benutzer kommen und noch nicht in der Datenbank hinzufügen
     * - Die Kontakte die vom Benuzter kommen und bereits in der Datenbank aktualisieren
     * - Die Kontakte die nicht vom Benutzer kommen, aber noch in der Datenbank stehen löschen
     * 
     * Genau diese Ablauf hält diese Funktion ein. 
     * Man übergibt Ihr zum Beispiel: 
     * 
     *      $req->supplement("angebote_kontakte", "angebot_id", "1000", "kontakt_id");
     *  
     *  Dann wird ein Filter auf "angebot_id" mit dem Wert gesetzt und für die Werte wird "kontakt_id" genommen.
     * 
     * 
     * @param String $table = Die Tabelle die gefüllt werden soll
     * @param Array $process = Das Process Array
     * @param String $key1 = Die Tabelle die gefüllt werden soll
     * @param String $key1Value = Die Tabelle die gefüllt werden soll
     * @param String $key2 = Die Tabelle die gefüllt werden soll
     * 
     */
    public function supplement($table, $process, $key1, $key1Value, $key2) {

        // Log
        $this->log[] = "- Starte Supplement Funktion";

        // Neuen SubRequest ohne Sanitize
        $subReq1 = new Request($this->data, true);

        // Alle Daten aus der Datenbank auslesen
        $subReq1->getMultiByKey($table, $key1, $key1Value, true);

        // Fehlermeldungen
        $errors = [];

        // Alread in DB sind die IDs von $key2
        $alreadyInDb = [];

        // Schleife
        foreach ($subReq1->result as $key => $value) {
            $alreadyInDb[] = $value[$key2];
        }

        // Arrays für die spätere Verwaltung initalisieren
        $toAdd = $toUpdate = $toDelete = [];

        // Sub Request 1 wenn erfolgreich
        if ($subReq1->success) {

            // Wenn es keine Daten gibt von der Anfrage, dann muss auch nichts hinzugefügt oder aktualisiert werden
            if ($subReq1->data && is_array($subReq1->data) && count($subReq1->data)) {

                // Schleife durch alle Daten die erneutert werden sollen
                foreach ($subReq1->data as $key => $value) {

                    // Prüfen ob das was erneut werden soll in der Datenbank bereits vorhanden ist
                    $foundKey = array_search($value[$key2], $alreadyInDb);

                    if ($foundKey !== false) {
                        $toUpdate[] = $key;
                        unset($alreadyInDb[$foundKey]);
                    } else {
                        $toAdd[] = $key;
                    }
                }
            }

            // Alle die übrig bleiben
            foreach ($alreadyInDb as $key => $value) {
                $toDelete[] = $value;
            }

            // Wenn etwas schief gegangen ist
        } else {

            $errors[] = "Fehler bei Sub-Request 1";
            $this->adapt($subReq1);
        }

        // Loggen
        $this->log[] = "- Es müssen " . count($toAdd) . " Wert/e hinzugefügt werden";
        $this->log[] = "- Es müssen " . count($toUpdate) . " Wert/e aktualisiert werden";
        $this->log[] = "- Es müssen " . count($toDelete) . " Wert/e gelöscht werden";

        // ADD
        // ---------------------------------
        if (count($toAdd) > 0) {
            // Schleife durch alle die hinzufügt werden sollen 
            foreach ($toAdd as $key => $value) {
                $subReq2 = new Request($subReq1->data[$value]);
                $subReq2->insert($table, $process);

                if (!$subReq2->success) {
                    $errors[] = "Fehler bei Sub-Request 2";
                }
            }
        } else {
            $this->log[] = "- Keine Datensätze zum hinzufügen vorhanden";
        }

        // UPDATE
        // ---------------------------------

        $updateForProcess = [];

        // Schleife

        foreach ($process as $key => $value) {
            if ($value[1] != $key1 && $value[1] != $key2) {
                $updateForProcess[] = $value;
            }
        }


        // Wenn es Datensätze gibt, die aktualisiert werden sollen
        if (count($toUpdate) > 0) {

            // Wenn überhaupt Daten da sind, die aktualisiert werden sollen
            if (count($updateForProcess) > 0) {

                // Schleife durch alle Updates
                foreach ($toUpdate as $key => $value) {

                    $subReq3 = new Request($subReq1->data[$value]);

                    $keyValuePair = [];
                    $keyValuePair[$key1] = $subReq1->data[$value][$key1];
                    $keyValuePair[$key2] = $subReq1->data[$value][$key2];

                    // Update durchführen
                    $subReq3->updateByKeyValuePair($table, $updateForProcess, $keyValuePair);

                    if (!$subReq3->success) {
                        $errors[] = "Fehler bei Sub-Request 3";
                    }
                }
            } else {
                $this->log[] = "- Nichts zum Updaten vorhanden";
            }
        } else {
            $this->log[] = "- Keine Datensätze zum aktualisieren vorhanden";
        }

        // DELETE
        // ---------------------------------


        // Schleife durch alle die gelöscht werden sollen 
        foreach ($toDelete as $key => $value) {

            $subReq4 = new Request();

            $keyValuePair = [];
            $keyValuePair[$key1] = $key1Value;
            $keyValuePair[$key2] = $value;

            // SubRequest 4
            $subReq4->deleteByKeyValuePair($table, $keyValuePair);

            if (!$subReq4->success) {
                $errors[] = "Fehler bei Sub-Request 3";
            }
        }

        // Auf Erfolgreich sezten
        $this->success = (count($errors) > 0) ? false : true;
        $this->error = (count($errors) > 0) ? implode(", ", $errors) : false;
    }


    /**
     * ACHTUNG: Sollte nur für bestimmte zwecke eingesetzt werden
     * Sicherheitshalber ist ein "Passwort" hinterlegt dieses lautet "suredelete" 
     * Es muss als String, als zweiter Parameter übergeben werden
     * 
     */
    public function clear($table, $password = "nothing") {

        // 
        if ($password == "suredelete") {
            $query = "DELETE FROM `" . $table . "`";

            $this->deleteQuery($query);
        } else {
            $this->error = "Fehler beim Clear, es wurde kein Passwort angegeben!";
        }
    }


    /**
     * Undocumented function
     *
     */
    public function extractImagesFromText($string, $directory) {

        $string = stripslashes($string);

        // Verzeichnis Erstellen, falls es nicht existiert
        if (!is_dir($directory)) {
            mkdir($directory);
        }

        // Images
        $finalImages = [];

        // Random File Name
        $imgName = date('Ymd-His') . "-" . hrtime(true) . "_inline_image_";

        // Neuen DOM
        $dom = new DOMDocument();

        // String in Dom Laden
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $string);


        // Alle Images Nodes prüfen
        $imgNodes = $dom->getElementsByTagName("img");

        // Counter
        $i = 1;

        // Alle Images durchlaufen
        foreach ($imgNodes as $imgNode) {

            // Dateiname für dieses Bild
            $thisFileName = $imgName . str_pad($i, 3, '0', STR_PAD_LEFT);

            // Den 64base String einlesen
            $completeImgString = $imgNode->getAttribute('src');

            // Explode String und Header trennen 
            $partImgString = explode(',', $completeImgString);

            // Image Data
            $imgData = base64_decode($partImgString[1]);

            // Extension
            $imgExtension = str_replace(['data:image/', ';base64'], ['', ''], mb_convert_encoding($partImgString[0], "UTF-8"));

            // Write the Complete File Name
            $completeFileName = $thisFileName . "." . $imgExtension;

            // Write Image Data to File
            file_put_contents($directory . "/" . $completeFileName, $imgData);

            // Replace Attribute
            $imgNode->setAttribute('src', '~~url~~' . $completeFileName);

            // Weitere Infos zu dem Bild
            $result = [
                'dir' => $directory,
                'upload_file' => [
                    'name' => $completeFileName,
                    'size' => filesize($directory . "/" . $completeFileName)
                ],
                'pathinfo' => pathinfo($directory . "/" . $completeFileName),
                'modified' => date('Y-m-d H:i:s'),
                'upload' => date('Y-m-d H:i:s'),
                'mime_type' => mime_content_type($directory . "/" . $completeFileName),
            ];

            $result['pathinfo']['extension'] = strtolower($result['pathinfo']['extension']);

            // Bild hinzufügen
            $finalImages[] = $result;

            // Count Up
            $i++;
        }

        // Rückgabe ohne Base64
        return [
            'text' => preg_replace('~<(?:!DOCTYPE|/?(?:html|body|xml))[^>]*>\s*~i', '', str_replace('<?xml encoding="utf-8" ?>', "", $dom->saveHTML())),
            'images' => $finalImages
        ];
    }

    public function editorText($input, $url, $dir) {

        return $input;
    }


    /**
     * Verschiebt eine Hochgeladene Datie
     *
     * 
     * 
     */
    public function moveUploadedFile($file, $dir, $options = []) {

        $this->log[] = "Move Uploaded File";

        // Daten initalisieren
        $result = [
            'dir' => $dir,
            'upload_file' => $file
        ];

        // Optionen
        $result['options'] = array_merge([
            'replace' => false,         // Prüft ob die Datei ersetzt werden soll
            'mkdir' => true,            // Prüft ob das Verzeichnis existiert
            'normalize' => false        // Ersetzt Leerzeichen und macht alles in Kleinbuchstaben
        ], $options);

        $this->log[] = $result['options'];

        // Prüfen ob das Verzeichnis schon existiert 
        if (!is_dir($dir)) {

            // Wenn die Option gesetzt wird, dann wird das Verzeichnis erstellt
            if ($result['options']['mkdir']) {
                mkdir($dir);
            }
        }

        // Wenn das Verzeichnis nicht existiert
        if (is_dir($dir)) {

            // Dateiname
            $result['pathinfo'] = pathinfo($file['name']);
            $result['pathinfo']['extension'] = strtolower($result['pathinfo']['extension']);

            // Name
            $newFileName = $result['pathinfo']['filename'];

            // Wenn der Dateiname normalisiert werden soll
            if ($result['options']['normalize']) {
                $newFileName = strtolower(str_replace([" "], ["_"], $newFileName));
                $newFileName = preg_replace("/[^a-z0-9\_\-\.]/i", '', $newFileName);
                $this->log[] = "Dateiname wurde normalisiert >" . $newFileName . "<";
            }

            // Prüfen ob es die Datei schon gibt
            if (file_exists($dir . "/" . $newFileName . "." . $result['pathinfo']['extension'])) {

                $this->log[] = "Zieldatei existiert bereits";

                // Prüfen ob die Datei schon existiert
                if (!$result['options']['replace']) {

                    $this->log[] = "Datei darf nicht ersetzt werden, es wird ein neuer Dateiname generiert";

                    // initalisieren
                    $i = 0;

                    // Schleife
                    while (true) {

                        $i++;

                        if (!file_exists($dir . "/" . $newFileName . "_" . $i . "." . $result['pathinfo']['extension'])) {
                            $newFileName = $newFileName . "_" . $i;
                            break;
                        }
                    }

                    // 
                } else {
                    $this->log[] = "Das Replace Flag ist gesetzt. Die Datei wird überschrieben";
                }
            }

            // Extension anfügen
            $newFileName = $newFileName . "." . $result['pathinfo']['extension'];
            $this->log[] = "Neuer Dateiname >" . $newFileName . "<";

            // Modified = Upload Datum
            $result['modified'] = date('Y-m-d H:i:s');

            // Zusätzliche File Info
            if (isset($this->data['additionalFileInfo'])) {

                // Additional
                $ad = json_decode(stripslashes($this->data['additionalFileInfo']), true);

                if ($ad[$file['name']]) {
                    $result['modified'] = $ad[$file['name']];
                }
            }

            // Upload Datum setzen
            $result['upload'] = date('Y-m-d H:i:s');

            // Datei verschieben
            if (move_uploaded_file($file['tmp_name'], $dir . "/" . $newFileName)) {
                $this->log[] = "Verschieben der Datei war erfolgreich";
                $this->success = true;

                // Meme Type
                $result['mime_type'] = mime_content_type($dir . "/" . $newFileName);


                // Daten übernehmen
                $result['filename'] = $newFileName;
                $this->result = $result;
            } else {
                $this->log[] = "Verschieben der Datei ist fehlgeschalgen";
                $this->error = "Verschieben der Datei ist fehlgeschlagen";
            }
        } else {
            $this->log[] = "Das Ziel-Verzeichnis >" . $dir . "< existiert nicht";
            $this->error = "Das Zielverzeichnis existiert nicht";
        }
    }

    /**
     * Gleiche Funktion nur mit mehreren Dateien
     */
    public function moveUploadedFiles($files, $dir, $options = []) {

        $this->log[] = "Upload Multiple Files";

        // Normalisieren
        $files = (is_array($files)) ? $files : [$files];

        // Daten
        $result = [];
        $error = false;

        // Schleife
        foreach ($files as $key => $file) {

            $this->log[] = "--- Upload File >" . $key . "<";

            // Dateien verschieben
            $this->moveUploadedFile($file, $dir, $options);

            // Wenn der Upload erfolgreich war, dann weitermachen
            if ($this->success) {

                // Zurücksetzen
                $this->success = false;

                // Daten sammeln und zurücksetzen
                $result[] = $this->result;
                $this->result = false;
            } else {
                $error = true;
                break;
            }
        }

        // Wenn alles geklappt hat
        if (!$error) {
            $this->success = true;
            $this->error = false;
            $this->result = $result;
            $this->log[] = "--- Alle Datei/en wurden vollständig hochgeladen";
        } else {
            $this->success = false;
            $this->error = "Fehler beim Hochladen einer Datei";
            $this->log[] = "--- Fehler beim Hochladen einer Datei";

            // TODO: Hier sollten bereits hochgeladene Daten ggf. gelöscht werden um eine Konsitenzt zu erhalten
        }
    }

    /**
     * Verarbeitet das Ergebnis eines Datei-Uploads und schreibt dies in die Datenbank
     * Nutzt dabei standardtisierte Feld-Namen
     * 
     * // TODO: Aktuell
     */
    public function uploadResultToDatabase($table, $additional = [], $overwrite = false) {

        global $db;

        // Diese Funktion funktioniert nur im Anschluss an eine move XXX Funktion
        if ($this->success) {

            // Die Standard-Felder
            $fields = ($overwrite && is_array($overwrite)) ? $overwrite : ['name', 'name_original', 'pfad', 'groesse', 'dateiendung', 'mime', 'datum_aenderung', 'datum_upload'];

            // Datenbank Keys definieren
            $dbKeys = (count($additional) > 0) ? array_merge($fields, array_keys($additional)) : $fields;

            // Normalisieren
            $result = (isset($this->result['filename'])) ? [$this->result] : $this->result;

            $dbValues = [];

            // Schliefe durch alle Ergebnisse
            foreach ($result as $key => $fileData) {

                // Daten aus der Datei auslesen in der Reihenfolge der Keys
                $temp = [
                    $fileData['filename'],
                    $fileData['upload_file']['name'],
                    $fileData['dir'],
                    $fileData['upload_file']['size'],
                    $fileData['pathinfo']['extension'],
                    $fileData['mime_type'],
                    $fileData['modified'],
                    $fileData['upload']
                ];

                // Neues Array
                $temp2 = [];

                // Schleife durch alle Felder
                foreach ($fields as $key => $field) {
                    if ($field) {
                        $temp2[] = $db->real_escape_string($temp[$key]);
                    }
                }

                // Wenn zusätzliche Felder mit dazu sollen
                if (count($additional) > 0) {
                    foreach ($additional as $key => $add) {
                        $temp2[] = $db->real_escape_string($add);
                    }
                }

                // Werte
                $dbValues[] = "'" . implode("','", $temp2) . "'";
            }

            // Query
            $query = " INSERT INTO `" . $table . "` (`" . implode("`,`", $dbKeys) . "`) VALUES (" . implode("), (", $dbValues) . ")";

            // Request
            $req = new Request();

            // Query einfügen
            $req->insertMultiQuery($query);

            // Wenn es ein Ergebnis gibt
            if (!$req->success) {
                $this->error = "Fehler beim Schreiben der Daten in die Datenbank";
            }
        }
    }


    /**
     * TODO: Funktioniert aktuelle nur bei einer Simplen Insert Funktion!
     *  
     * 
     * Funktion um einen Reset durchzuführen
     * Dazu muss eine Reset Query angegeben worden sein
     * Bei den Funktionen X,Y,Z ist dies automatisch mit dabie
     * 
     * Setzt niemals Success, da es sich bei einem Reset ja immer nur um eine Rückabwicklung handelt
     * Hier wird an der Stelle nur geloggt. Es wird aber außerdem der Parameter "resetSuccess" gesetzt
     *  
     * -- Reset Funktioniert nur unter bestimmten gegebenheiten!
     *    -- Die Tabelle muss ein Feld namens ID haben und AutoIncrement sein
     * 
     */
    public function reset() {

        global $db;

        // Loggen
        $this->log[] = "- Called Function >reset<";

        // Wenn es eine Reset Query gibt
        if (isset($this->resetData)) {

            $rD = $this->resetData;

            // Prüfen, dass die benötigeten Daten vorhanden sind
            if (isset($rD['table']) && isset($rD['id'])) {


                $ids = (is_array($rD['id'])) ? $rD['id'] : [$rD['id']];

                // All OK
                $allOk = true;

                // Schliefe
                foreach ($ids as $id) {

                    // Reset Query
                    $this->resetQuery("DELETE FROM `" . $rD['table'] . "` WHERE `id` = '" . $id . "'");

                    if (!$this->resetSuccess) {
                        $allOk = false;
                    }
                }

                $this->resetSuccess = $allOk;

                // Bei Auto Increment
                if (isset($rD['auto_increment'])) {

                    // 
                    $niedrigsteId = min($ids);

                    // $que
                    $query = "ALTER TABLE `" . $rD['table'] . "` AUTO_INCREMENT=" . $niedrigsteId . ";";
                    $this->log[] = $query;

                    // Query
                    $result = $db->query($query);

                    if ($result) {
                        $this->log[] = "- Auto Increment wurde rückgängig gemacht";
                    } else {
                        $this->log[] = "- Das Rückgängig machen des Auto Increment ist fehlgeschlagen";
                    }
                }
            } else {
                $this->log[] = "- Es fehlt die ID oder die Tabelle!";
            }
        } else {
            $this->log[] = "- Es wurde keine Daten angegeben!";
        }
    }



    public function resetQuery($query) {

        global $db;

        $this->log[] = "- Called Function >resetQuery<";
        $this->log[] = $query;

        // Query
        $result = $db->query($query);

        if ($result) {
            $this->resetSuccess = true;
            $this->log[] = "- Reset Query war erfolgreich";
        } else {
            $this->resetSuccess = false;
            $this->log[] = "- Reset Query war nicht erfolgreich";
        }
    }

    // Simple Get
    public function get($table, $id, $allowZero = false) {
        $query = "SELECT * FROM `" . $table . "` WHERE `id` = '" . $id . "';";
        $this->log[] = "- Called Function >get<";
        $this->getQuery($query, $allowZero);
    }

    public function getByKey($table, $key, $value, $allowZero = false) {
        $query = "SELECT * FROM `" . $table . "` WHERE `" . $key . "` = '" . $value . "';";
        $this->log[] = "- Called Function >getByKey<";
        $this->getQuery($query, $allowZero);
    }

    // Simple Get Query Result
    public function getQuery($query, $allowZero = false) {

        $this->log[] = "- Called Function >getQuery<";

        global $db;

        // Query
        $result = $db->query($query);

        if ($result) {

            // Wenn es Ergebnis gibt
            if ($result->num_rows > 0) {

                if ($result->num_rows === 1) {
                    $this->result = $result->fetch_assoc();
                    $this->success = true;

                    // Wenn der Datensatz nicht eindeutig ist
                } else {
                    $this->error = "Der Datensatz ist nicht eindeutig";
                }

                // Wenn der Datensatz nicht gefunden wurde
            } else {

                if ($allowZero) {
                    $this->result = [];
                    $this->success = true;
                } else {

                    $this->error = "Der gewünschte Datensatz wurde nicht gefunden";
                    $this->log[] = $query;
                }
            }

            // Wenn die Query fehlschlägt
        } else {
            $this->error = "Fehler beim Ausführen der Datenbank Abfrage";
            $this->log[] = $db->error;
            $this->log[] = $query;
        }
    }

    public function getMultiByKey($table, $key, $value, $allowZero = false) {
        $query = "SELECT * FROM `" . $table . "` WHERE `" . $key . "` = '" . $value . "';";
        $this->log[] = "- Called Function >getMultiByKey<";
        $this->getMultiQuery($query, $allowZero);
    }

    // Simple Get Query Result
    public function getMultiQuery($query, $allowZero = false) {

        $this->log[] = "- Called Function >getMultiQuery<";

        global $db;

        // Query
        $result = $db->query($query);

        if ($result) {

            // Wenn es Ergebnis gibt
            if ($result->num_rows > 0) {

                $this->result = [];

                // 
                while ($row = $result->fetch_assoc()) {
                    $this->result[] = $row;
                }

                $this->success = true;

                // Wenn der Datensatz nicht gefunden wurde
            } else {

                if ($allowZero) {
                    $this->result = [];
                    $this->success = true;
                } else {
                    $this->error = "Der gewünschte Datensatz wurde nicht gefunden";
                    $this->log[] = $query;
                }
            }

            // Wenn die Query fehlschlägt
        } else {
            $this->error = "Fehler beim Ausführen der Datenbank Abfrage";
            $this->log[] = $db->error;
            $this->log[] = $query;
        }
    }

    /**
     * 
     */
    public function extractValueFromMultiArray($array, $field) {

        $newResult = [];


        if ($array && is_array($array) && count($array) > 0) {
            foreach ($array as $key => $value) {
                $newResult[] = $value[$field];
            }
        }

        return $newResult;
    }




    // Wenn 
    public function checkRequired($array) {

        // 
        if ($array && count($array) > 0) {

            $result = true;

            // Prüfen
            foreach ($array as $key) {

                // ergebnis
                $loopResult = false;

                // Prüfen ob der Wert gesetzt ist
                if (isset($this->data[$key])) {

                    // Array
                    if (is_array($this->data[$key])) {

                        $loopResult = true;

                        // Boolean
                    } else if ($this->data[$key] === true || $this->data[$key] === false) {

                        $loopResult = true;

                        // Alles andere
                    } else {

                        // Zu einem String konvertieren
                        $loopResult = (strlen(strval($this->data[$key])) > 0) ? true : false;
                    }
                }

                if (!$loopResult) {
                    $result = false;
                }
            }
        } else {
            $result = true;
        }

        // Wenn es einen Fehler gibt
        if (!$result) {
            $this->error = "Ein Pflichtfeld wurde nicht übergeben";
        }

        return $result;
    }




    // 
    public function mergeForList($id, $text) {

        // Wenn die ID definiert ist
        if ($id) {

            // Text
            $text = ($text) ? $text : "";

            // Rückgabe
            return [
                "value" => $id,
                "text" => $text
            ];

            // Wenn keine ID definiert ist
        } else {
            return false;
        }
    }

    public function queryHelper($array) {

        // Daten
        $post = $this->data;

        $finish = [];

        // 
        foreach ($array as $key => $value) {

            // Gibt es diesen Datensatz überhaupt in den Post daten
            if (isset($post[$value[1]])) {

                // Feldname definieren
                $feldname = $this->getFieldName($value);

                // Wert
                $wert = $this->getFormattedValue($post[$value[1]], $value);

                // Fertiges Array
                $finish[] = "`" . $feldname . "` = " . $wert;

                // Fehlermeldung
            } else {

                // Wenn dieser Punkt aktiviert wäre, müssten zwangläufig alle Daten angegeben sein
                // So können Daten auch Optional sein
                // throw new Exception("Der gewünschte Datensatz ist nicht vorhanden");

            }
        }

        return $finish;
    }


    public function getFieldName($value) {
        return (isset($value[2]) && $value[2]) ? $value[2] : $value[1];
    }

    /**
     * Erhält die Process Tabelle und gibt die Keys zurück
     */
    public function getQueryKeys($process) {

        $keys = [];

        // Prozess-Tabelle durchgehen
        foreach ($process as $value) {
            $keys[] = $this->getFieldName($value);
        }

        return $keys;
    }


    // Formatierten Wert anzeigen
    public function getFormattedValue($data, $value) {

        $wert = "";

        switch ($value[0]) {

                // Checkbox
            case "c":

                // Es gibt zwei verschiedene Arten, die eine Checkbox aktzeptieren soll
                // Die Variante der Benutzereingabe mit `true` oder `false` bzw. `1` oder `0`
                // Die Variante die direkt aus der Form kommt als Array
                $isChecked = $this->getCbStatus($data);

                // Wert 
                $wert = ($isChecked) ?
                    ((isset($value[4])) ? (($value[4] == 'NULL') ? "NULL" : "'" . $value[4] . "'") : "'1'") : ((isset($value[3])) ? (($value[3] == 'NULL') ? "NULL" : "'" . $value[3] . "'") : "'0'");

                break;

                // Datum
            case "dt":

                if ($data) {

                    $date = (isset($value[5])) ? DateTime::createFromFormat($value[5], $data) : new DateTime($data);

                    // Format herausfinden
                    $format = $value[4] ?? "Y-m-d H:i:s";
                    $format = ($format == 'date') ? "Y-m-d" : (($format == 'time') ? "H:i:s" : $format);

                    // Formatieren
                    $wert = "'" . $date->format($format) . "'";

                    // Wenn nichts angegeben
                } else {
                    $wert = (isset($value[3])) ? "'" . $value[3] . "'" : "NULL";
                }

                break;


                // Text
            case "t":

                if (is_array($data)) {
                    throw new Exception("Bei einem Text wurde ein Array übergeben >" . $value[1] . "<");
                }

                $wert = (isset($data) && $data !== false) ? "'" . trim($data) . "'" : ((isset($value[3])) ? "'" . trim($value[3]) . "'" : "NULL");
                $wert = str_replace(["\\n", "\\r", "\\t"], ["\n", "\r", "\t"], $wert);
                break;

                // Select
            case "s":

                // Es gibt zwei verschiedene Arten, die einer Select aktzeptieren soll
                // Die Variante der Benutzereingabe mit einem Direkten Wert
                // Die Variante die direkt aus der Form kommt als Array
                $wert = $this->getSelectValue($data);
                $wert = ($wert) ?  "'" . $wert . "'" : ((isset($value[3])) ? "'" . $value[3] . "'" : "NULL");

                break;

                // Konvertiert den Wert in einen Datenbank Wert
            case "n":

                $f = new Formatter();
                $wert = ($data) ?  "'" . $f->phpFloat($data) . "'" : ((isset($value[3])) ? "'" . $value[3] . "'" : "NULL");

                break;

                // Summernote
            case "sn":

                // Verzeichnis
                $dir = ($value[3]) ? $value[3] : "data/temp";

                // Bilder aus dem Text entfernen
                $extracted = $this->extractImagesFromText($data, $dir);

                $wert = "'" . $extracted['text'] . "'";

                break;


            default:
                throw new Exception("Der Feldkonverter: >" . $value[0] . "< ist unbekannt!", 1);
                break;
        }

        // Rückgabe
        return $wert;
    }


    public function getCbStatus($data) {

        if (is_array($data)) {
            $isChecked = ($data['checked'] && ($data['checked'] === true || $data['checked'] === 'true')) ? true : false;
        } else {
            $isChecked = ($data === '1' || $data === 1 || $data === true) ? true : false;
        }

        return $isChecked;
    }

    public function getSelectValue($data) {

        if (is_array($data)) {
            $value = ($data && $data['value']) ? $data['value'] : false;
        } else {
            $value = ($data) ? $data : false;
        }

        return $value;
    }

    /**
     * Prüft ob in einer Tabelle ein Wert mehrfach vorkommt. 
     * 
     * @param $table = Die Tabelle die Abgefragt wird
     * @param String|Array $fields = Die Felder die Abgefragt werden (Siehe Beispiel)
     * 
     * 
     * 
     * // Prüft ob es den Wert (tobias.pitzer@googlemail.com) bereits in dem Feld email1 oder email2 in der Tabelle gibt
     * hasDuplicate('sometable', ['email1','email2'], 'tobias.pitzer@googlemail.com');
     * 
     * 
     */
    public function hasDuplicate($table, $fields, $value, $ignoreId = false) {

        global $db;

        // Initalisieren
        $hasDuplicate = false;

        // Prüfen das ein Wert vorhanden ist
        if ($value) {


            $fields = (is_array($fields)) ? $fields : [$fields];

            $or = [];

            foreach ($fields as $field) {
                $or[] = "`" . $field . "` = '" . $value . "'";
            }

            // Select Query
            $query = "SELECT COUNT(*) AS counter FROM `" . $table . "` WHERE (" . implode(" OR ", $or) . ") " . (($ignoreId) ? " AND `id` != '" . $ignoreId . "'" : "") . ";";

            $this->log[] = "- Has Duplicate Query";
            $this->log[] = $query;

            // Datenbank Abfrage
            $result = $db->query($query);

            if ($result) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    if ($row['counter'] > 0) {
                        $hasDuplicate = true;
                    }
                }
            } else {
                throw new Exception("Fehler bei der Datenbank Abfrage: " . $db->error, 1);
            }
        }


        return $hasDuplicate;
    }

    // Dublettenprüfung
    public function checkDuplicate($error, $table, $fields, $value, $ignoreId = false) {
        $hasDuplicate = $this->hasDuplicate($table, $fields, $value, $ignoreId);

        // Duplettenprüfung
        if ($hasDuplicate) {
            $this->error = "Dubeltte gefunden: " . $error;
        } else {
            $this->success = true;
        }
    }

    /**
     * 
     * Tag = 1
     * Adresse = 12345
     * 
     * hasDuplicateCombination('adressen_oeffnungszeiten', ['tag' => '1', 'addresse_id' => 1234])
     */
    public function hasDuplicateCombination($table, $keyValuePairs, $ignoreId = false) {

        global $db;
        $hasDuplicate = false;

        // Query Start
        $query = "SELECT COUNT(*) AS counter FROM `" . $table . "` WHERE (";

        // 
        $and = [];

        foreach ($keyValuePairs as $columnName => $columnValue) {
            $and[] = "`" . $columnName . "` = '" . $columnValue . "'";
        }

        // 
        $query .= implode(" AND ", $and) . ") " . (($ignoreId) ? " AND `id` != '" . $ignoreId . "'" : "") . ";";

        // Datenbank Abfrage
        $result = $db->query($query);

        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                if ($row['counter'] > 0) {
                    $hasDuplicate = true;
                }
            }
        } else {
            throw new Exception("Fehler bei der Datenbank Abfrage: " . $db->error, 1);
        }

        return $hasDuplicate;
    }

    // Fields muss jetzt ein Array sein
    public function checkDuplicateCombination($error, $table, $keyValuePairs, $ignoreId = false) {

        $hasDuplicate = $this->hasDuplicateCombination($table, $keyValuePairs, $ignoreId);

        // Duplettenprüfung
        if ($hasDuplicate) {
            $this->error = "Dubeltte gefunden: " . $error;
        }
    }


    // Adaptieren der Ergebnisse
    public function adapt($res, $withData = true) {

        if (is_array($res)) {

            // 
            $this->adaptArray($res, $withData);
        } else {

            $this->adaptObject($res, $withData);
        }
    }

    public function adaptArray($array, $withData) {

        // Success
        if (isset($array['success'])) {
            $this->success = $array['success'];
        }

        // Error
        if (isset($array['error'])) {
            $this->error = $array['error'];
        }

        // Message
        if (isset($array['message'])) {
            $this->message = $array['message'];
        }

        // Log mergen
        if (isset($array['log'])) {
            $this->log = array_merge($this->log, $array['log']);
        }

        // Daten mergen
        if (isset($array['data']) && $withData) {
            $this->result = $array['data'];
        }
    }

    /**
     * Objekt Adaptieren
     */
    public function adaptObject($obj, $withData) {

        $this->success = $obj->success;
        $this->error = $obj->error;
        $this->message = $obj->message;
        $this->log = array_merge($this->log, $obj->log);

        // Daten mergen
        if ($withData) {
            $this->result = $obj->result;
        }
    }


    // Answer
    public function answer($toAdapt = false) {

        if ($toAdapt) {
            $this->adapt($toAdapt);
        }

        // Array
        $array = [
            'success' => $this->success,
            'error' => $this->error,
            'message' => $this->message,
            'log' => $this->log,
            'data' => $this->result
        ];

        // Rückgabe
        return $array;
    }


    public function echoAnswer($toAdapt = false) {

        $result = $this->answer($toAdapt);
        echo json_encode($result);
    }

    public function proxy($url) {

        $req = $url;


        // cURL Data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL verification
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $req);
        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response, true);

        return $response;
    }
}
