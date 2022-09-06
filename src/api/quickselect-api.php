<?php

/**
 * Quickselect API
 */
class Quickselect {

    // Constructor
    function __construct($get) {

        // Get Varaiblen
        $this->get = $get;

        // Filter initalisieren
        $this->filter = [];

        // Prüfen ob Filter via JavaScript mitgeben wurden
        if (isset($this->get['filter']) && $this->get['filter'] != 'false') {

            // Wenn ein komplettes Array mitgegeben wurde
            if (isset($this->get['filter'][0])) {

                foreach ($this->get['filter'] as $fValue) {
                    $this->addFilter($fValue['field'], (isset($fValue['value'])) ? $fValue['value'] : false);
                }

                // Wenn direkt ein Objekt mitgegeben wurde
            } else {

                // Einzelnen Filter hinzufügen
                $this->addFilter($this->get['filter']['field'], (isset($this->get['filter']['value'])) ? $this->get['filter']['value'] : false);
            }
        }
    }


    /**
     * Field > Value Pair zum Filter hinzufügen
     * 
     * $qs->addFilter($field, $value);
     * 
     */
    public function addFilter($field, $value) {

        // Filter hinzufügen
        $this->filter[] = [
            'field' => $field,
            'value' => $value
        ];
    }



    /**
     * Zum Erstellen einer vollständige Antwort für Quickselect
     *
     */
    public function createComplete($table, $fields, $primary = "id", $schema = false) {

        global $db;

        // Fields normalisieren
        $fields = (is_array($fields)) ? $fields : [$fields];

        // Query auslesen
        $query = $this->getSelectQuery($table, $fields, $primary);

        // Datenbank Abfrage
        $result = $db->query($query);

        // Array
        $array = [];

        // Prüfen ob die Query erfolgreich war
        if ($result) {

            // Prüfen ob ein Ergebnis da ist
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    // Render Row
                    $array[] = $this->renderRow($fields, $row, $schema, $primary);
                }
            }
        } else {
            echo "Fehler bei der Datenbank-Abfrage:\n";
            echo $db->error;
            echo "\n\n";

            $logQuery = str_replace(["\r\n", "  ", "\t"], " ", $query);

            // Query aufhübschen
            while (str_contains($logQuery, "  ")) {
                $logQuery = str_replace("  ", " ", $logQuery);
            }

            echo trim($logQuery);
            echo "\n\n";
        }

        $this->outputDataAsJson($array);
    }



    
    public function renderRow($fields, $row, $schema, $primary) {

        $text = $this->renderText($fields, $row, $schema, $primary);

        // Als Array
        return [
            'id' => $row[$primary],
            'text' => $text
        ];
    }

    public function renderText($fields, $row, $schema, $primary) {

        // Wenn die Werte nach einem Schema hingefügt werden sollen
        if ($schema) {

            // Schema
            $text = $this->applySchemaToText($schema, $fields, $row);

            // Ansonsten werden die Werte einfach aneinander gereiht
        } else {

            // Initalisieren
            $text = [];

            // Schleife durch alle Felder die ausgelesen werden sollen!
            foreach ($fields as $field) {
                $text[] = $row[$field];
            }

            // Zusammenführen des Textes
            $text = implode(" ", $text);
        }

        return $text;
    }

    /**
     * Schema hinzufügen
     * 
     */
    public function applySchemaToText($schema, $fields, $row) {

        // Schema in Text-Variable schreiben
        $text = $schema;

        // Iterator
        $i = 0;

        // Schleife durch alle FElder
        foreach ($fields as $field) {

            // Ersetze {0} mit ersten Wert aus Array, usw. 
            $text = str_replace("{" . $i . "}", $row[$field], $text);

            // Iterator hochzählen
            $i++;
        }

        // Rückgabe
        return $text;
    }


    // Ausgabe als JSON
    public function outputDataAsJson($array) {

        // Ausgabe
        echo json_encode([
            'results' => $array
        ]);
    }


    // Get Select Query
    public function getSelectQuery($table, $fields, $primary = "id") {

        // Query erstellen
        $query = "
            SELECT " . (in_array($primary, $fields) ? "" : "`" . $primary . "`,") . " `" . implode("`,`", $fields) . "` 
                FROM `" . $table . "` 
                " . $this->getWhereQuery($fields, $primary) . " 
                ORDER BY `" . implode("`,`", $fields) . "`";

        return $query;
    }



    // Felder
    public function getWhereQuery($fields, $primary) {

        // Where
        $where = "";
        $suchbegriffeWhere = false;
        $filterWhere = false;

        // Suchbegriffe
        $suchbegriffe = (isset($this->get['term']) && $this->get['term']) ? explode(" ", trim($this->get['term'])) : false;

        // Wenn es Suchbegriffe und Felder zum Durchsuchen gibt
        if ($suchbegriffe > 0 && count($fields) > 0) {

            $and = [];

            // Doppelte Suchbegriffe entfernen
            $suchbegriffe = array_unique($suchbegriffe);

            // Für jeden Suchbegriff
            foreach ($suchbegriffe as $suchbegriff) {

                $or = [];

                // Für jedes Feld
                foreach ($fields as $field) {
                    $or[] = "`" . $field . "` LIKE '%" . $suchbegriff . "%'";
                }

                $and[] = implode(" OR ", $or);
            }

            // Suchbegriffe zu einer Query zusammenstellen
            $suchbegriffeWhere = "(" . implode(") AND (", $and) . ")";
        }


        // FILTER 
        // ******

        // 
        $filterWhere = [];

        // Prüfen ob es einen Filter gibt
        if (count($this->filter) > 0) {

            // Schleife durch alle Filter
            foreach ($this->filter as $fValues) {

                // Prüfen ob es einen Wert gibt
                if (isset($fValues['value']) && strlen($fValues['value']) > 0) {

                    // Filter Where hinzufügen
                    $filterWhere[] = "(`" . $fValues['field'] . "` = '" . $fValues['value'] . "')";

                    // Empty String wird zu '' oder NULL
                } else {

                    // Hier wird nach '' und NULL gefiltert
                    $filterWhere[] = "(`" . $fValues['field'] . "` = '' OR `" . $fValues['field'] . "` IS NULL)";
                }
            }
        }


        // Nur wenn die Resolve Id mit angegeben ist
        if(isset($this->get['resolveId']) && $this->get['resolveId']) {
            $filterWhere[] = "(`".$primary."` = '".$this->get['resolveId']."')";
        }


        // Prüfen ob es notwendig ist, dass eine Where Clausel angegeben wird
        if ($suchbegriffeWhere || count($filterWhere) > 0) {

            // Initalisieren
            $where = " WHERE ";

            // Wenn beide gegeben sind
            if ($suchbegriffeWhere && $filterWhere) {

                // Beide verknüpfen mit einer AND
                $where .= "(" . implode(" AND ", $filterWhere) . ") AND (" . $suchbegriffeWhere . ")";

                // Wenn nur einer von beiden vorhanden ist
            } else {

                // Dann diesen für die Where Clausel nutzen
                $where .= ($suchbegriffeWhere) ? $suchbegriffeWhere : implode(" AND ", $filterWhere);
            }
        }

        // Where zurückgeben
        return $where;
    }
}
