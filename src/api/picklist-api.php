<?php



/**
 * DataTables Api
 */
class Picklist {

    public $recordsFiltered = 0;
    public $recordsTotal = 0;
    public $data = [];
    public $log = [];
    public $debug = false;
    public $fixedFilter = false;

    function __construct($get = false, $name = false) {

        $this->request = $get;
        $this->name = $name;
        $this->log[] = "-- Constructor for >" . $name . "<";

        $this->log[] = $get;
    }


    // Konfigurationsdatei einlesen
    public function readConfig($path = false) {

        global $_root;

        $this->log[] = "-- Read Config";

        // Pfad zur Config Datei
        $path = $_root . "/modules/picklist/" . $this->name . "/config.json";

        if (is_file($path)) {

            // Konfigurationsdatei
            $this->config = json_decode(file_get_contents($path), true);


            // Wenn eine Zweite Konfiguration vorhanden ist
            if (isset($this->request['secondConfig']) && isset($this->request['secondConfig']['file']) && $this->request['secondConfig']['file']) {

                // Zweite Config Datei
                $sPath = $_root . "/modules/picklist/" . $this->name . "/" . $this->request['secondConfig']['file'];

                if (is_file($sPath)) {

                    // Wenn die Konfiguration überschrieben werden soll!
                    if ($this->request['secondConfig']['mode'] == 'overwrite') {

                        // Konfigurationsdatei
                        $this->config = json_decode(file_get_contents($sPath), true);
                    } else {

                        // Wenn die Dateien gemergt werden müssen!
                        $this->config = array_merge_recursive($this->config, json_decode(file_get_contents($sPath), true));
                    }
                }
            }

            // Konfigurationsdatei verarbeiten
            $this->setSpalte();
        } else {
            throw new Exception("Es wurde keine Konfigurationsdatei gefunden!", 1);
        }
    }

    // Setzt die Spalten
    function setSpalte() {

        $this->log[] = "-- Set Spalten";


        // Datables Keys
        $i = 1;

        // Alle Spalten loopen
        foreach ($this->config['fields'] as $key => $value) {

            // Alias vergeben
            $this->config['fields'][$key]['index'] =  $i;
            $this->config['fields'][$key]['alias'] =  "_" . $key;
            $this->config['fields'][$key]['searchable'] = (isset($this->config['fields'][$key]['searchable']) && $this->config['fields'][$key]['searchable'] == false) ? false : true;
            $this->config['fields'][$key]['sortable'] = (isset($this->config['fields'][$key]['sortable']) && $this->config['fields'][$key]['sortable'] == false) ? false : true;

            // Wenn es sich um ein Feld handelt!
            if (empty($value['type']) || $value['type'] == 'field') {

                // Wenn das Feld nicht extra definiert ist, dann nimmt man den Namen (Index)
                $field = (empty($value['field'])) ? $key : $value['field'];

                // Wenn die Tabelle im Feld nicht gefüllt ist, dann nehme die Standard-Tabelle, ansonsten den Wert der eingetragen ist
                $table = (empty($value['table'])) ? $this->config['table']['name'] : $value['table'];

                // Zum Array hinzufügen
                $array[] = $table . "." . $field;

                // Normalisieren der Config, damit das ganze nur einmal gemacht werden muss
                $this->config['fields'][$key]['type'] = 'field';
                $this->config['fields'][$key]['field'] = $field;
                $this->config['fields'][$key]['table'] =  $table;
                $this->config['fields'][$key]['select'] =  "`" . $table . "`.`" . $field . "`";



                // Wenn es sich um ein Multi feld handelt
            } else if ($value['type'] == 'multi-field') {

                // Prüfen, dass die Felde rein Array sind
                if (is_array($value['field'])) {

                    $normalisedConfig = [];
                    $glued = [];

                    // Array durchgehen
                    foreach ($value['field'] as $fieldKey => $fieldInfo) {

                        // 
                        $fieldInfo = (is_array($fieldInfo)) ? $fieldInfo : [$fieldInfo];

                        // Man kann die entweder nur Feld oder Feld + Tabelle angeben
                        $field = (count($fieldInfo) == 2) ? $fieldInfo[1] : $fieldInfo[0];
                        $table = (count($fieldInfo) == 2) ? $fieldInfo[0] : ((empty($value['table'])) ? $this->config['table']['name'] : $value['table']);

                        // Hinzufügen
                        $glued[] =  "`" . $table . "`.`" . $field . "`";

                        $normalisedConfig[] = [$field, $table];
                    }

                    $this->config['fields'][$key]['field'] = $normalisedConfig;

                    // Temp Select
                    $tempSelect = [];

                    // Temporärer Select
                    foreach ($this->config['fields'][$key]['field'] as $field) {
                        $tempSelect[] = "`" . $field[1] . "`.`" . $field[0] . "`";
                    }

                    // Glue
                    $glue = (isset($value['glue']) ? $value['glue'] : " ");


                    $this->config['fields'][$key]['select'] = "CONCAT(" . implode(",'" . $glue . "',", $tempSelect) . ")";
                } else {
                    throw new Exception("Bei Multi Fields muss ein Array angegeben werden!", 1);
                }
            } else if ($value['type'] == 'calculation' || $value['type'] == 'query') {

                // Fehlermeldung um alte Config abzufangen
                if ($value['type'] == 'calculation') {
                    throw new Exception("Der Typ 'calculation' wurde in Orthor 1.0.22 in 'query' umbenannt. Bitte entsprechend anpassen", 1);
                }

                // Prüfen, dass das Feld gefüllt ist
                if (empty($value['field'])) {
                    throw new Exception("Bei einer Kalkulation muss das Feld angegeben werden", 1);
                }

                // Feldwert setzen
                $this->config['fields'][$key]['select'] = $value['field'];

                // Für alle Anderen Felder
            } else {
                $this->config['fields'][$key]['searchable'] = false;
                $this->config['fields'][$key]['orderable'] = false;
            }

            // Hochzählen
            $i++;
        }
    }

    // Verarbeiten
    public function process() {

        // Konfigurationsdatei einlesen
        $this->readConfig();

        // Query Teile erstellen
        $this->generateSelect();
        $this->generateJoins();
        $this->generateFilter();
        $this->generateOrder();
        $this->generateLimit();

        // Query zusammenstellen
        $this->generateQuery();

        // Daten sammeln
        $this->getData();

        // Total und gefiltert 
        $this->generateTotal();
        $this->generateFiltered();

        // Output generieren
        $this->generateOutput();
    }


    // 
    public function getAdditionalOutput() {

        // Nichts ausgeben
        return [];
    }


    // Ausgabe generieren
    public function generateOutput() {

        // Ausgabe
        $this->output = [
            "draw" => $this->request['draw'],
            "recordsTotal" => $this->recordsTotal,
            "recordsFiltered" => $this->recordsFiltered,
            "data" => $this->data,
            "log" => $this->log,
            "additional" => $this->getAdditionalOutput()
        ];
    }

    public function getNameByIndex($index) {

        // Schleife durch alle Felder
        foreach ($this->config['fields'] as $key => $value) {
            if ($value['index'] == $index) {
                return $key;
            }
        }

        return false;
    }

    public function getData() {

        global $db;

        $result = $db->query($this->query);

        // Daten
        $data = [];

        // Ergebnis
        if (!$result) {
            throw new Exception("Error Catching Query Result: >>> " . $db->error . " <<< >>> " . $this->query . " <<< ", 1);
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $this->editRow($row);
            }
        }

        $this->data = $data;
    }

    // Reihe verarbeiten
    public function editRow($row) {

        // 
        $newRow = [];

        // 
        $newRow[] = (empty($this->request['checkbox'])) ? '' : $this->request['checkbox'];

        // Für jede Spalte = 
        foreach ($this->config['fields'] as $key => $value) {

            // Feld editieren
            $field = $this->editColumn($row, $key, $value);

            $newRow[] = $field;
        }

        // Reihe zurückgeben
        return $newRow;
    }

    public function editColumn($row, $key, $value) {

        // False
        $returnValue = false;

        // 
        if ($value['type'] == 'field' || $value['type'] == 'multi-field' || $value['type'] == 'calculation') {
            $returnValue = $row[$value['alias']];
        } else {
            $returnValue = $this->editSpecialColumn($row, $key, $value);
        }

        // Diese Funktion kann überschrieben werden, dann erhält man alle Werte
        $returnValue = $this->editCustomColumn($row, $key, $value, $returnValue);

        // Rework
        if (!empty($value['format'])) {
            $returnValue = $this->formatColumn($row, $key, $value, $returnValue);
        }

        // Diese Funktion kann überschrieben werden, dann erhält man alle Werte
        $returnValue = $this->editCustomColumnAfter($row, $key, $value, $returnValue);

        // Rückgabe        
        return $returnValue;
    }

    // Diese Funktion muss überschrieben werden!
    public function editSpecialColumn($row, $key, $value) {
        return "";
    }

    // Diese Funktion muss immer den Default zurückgeben, wenn Sie überschrieben wird!
    public function editCustomColumn($row, $key, $value, $default) {
        return $default;
    }

    // Diese Funktion muss immer den Default zurückgeben, wenn Sie überschrieben wird!
    public function editCustomColumnAfter($row, $key, $value, $default) {
        return $default;
    }

    // Formatieren der Column
    public function formatColumn($row, $key, $value, $returnValue) {

        // Neuer Formatter
        $formatter = new Formatter();

        // Prüfen, dass Optionen mi
        if (empty($value['format-config']) && in_array($value['format'], ['custom-datetime', 'array'])) {
            throw new Exception("Bei dieser Option >".$value['format']."< muss ein Parameter mit angeben werden!", 1);
        } else {
            if (isset($value['format-config'])) {
                $o = (is_array($value['format-config'])) ? $value['format-config'] : [$value['format-config']];
            } else {
                $o = [];
            }
        }

        // Abfrage nach der formatierung!
        switch ($value['format']) {

                // Als Datum formatieren
            case "date":
                $returnValue = ($returnValue) ? date('d.m.Y', strtotime($returnValue)) : "";
                break;

                // Als Zeit formatieren
            case "time":
                $returnValue = ($returnValue) ? date('H:i', strtotime($returnValue)) : "";
                break;

                // Als Zeit formatieren
            case "datetime":
                $returnValue = ($returnValue) ? date('d.m.Y H:i', strtotime($returnValue)) : "";
                break;

                // Als Zeit formatieren
            case "custom-datetime":
                $returnValue = ($returnValue) ? date($o[0], strtotime($returnValue)) : "";
                break;

                // Als Nummer formatieren
            case "number":

                $returnValue = $formatter->autoFloat(floatval($returnValue), (isset($o[0])) ? $o[0] : null, (isset($o[1])) ? $o[1] : null);
                break;

                // Als Währung formatieren
            case "betrag":
                $returnValue = $formatter->betrag(floatval($returnValue), (isset($o[0])) ? $o[0] : null);
                break;

                // Ja oder Nein einsetzen
            case "yes-no":
                $returnValue = ($returnValue) ? ((empty($o[0])) ? "Ja" : $o[0]) : ((empty($o[0])) ? "Nein" : $o[1]);
                break;

                // 
            case "substring":

                // Länge des Susbtring
                $laenge = (empty($o[0])) ? 30 : $o[0];
                $withDots = (!isset($o[1]) || $o[1] === true) ? "..." : "";
                
                // Entfernt alle HTML Zeichen
                $returnValue = strip_tags($returnValue);

                // Löscht Die Leerzeichen vorne und hinten
                $returnValue = trim($returnValue);

                // 
                if (strlen($returnValue) > $laenge) {
                    $returnValue = mb_substr($returnValue, 0, $laenge) . $withDots;
                }       


                break;


            case "block":
                $returnValue = $formatter->block($returnValue);
                break;

            case "trim":
                $returnValue = $formatter->trim($returnValue);
                break;

            case "bytes":

                $runden = (empty($o[0])) ? 2 : $o[0];

                $returnValue = $formatter->bytes($returnValue,  $runden);
                break;

            case "array": 
            
                // Optionen
                if(isset($o[$returnValue])) {
                    $returnValue = $o[$returnValue];
                } else if(isset($value['default'])) {
                    $returnValue = $value['default'];
                }

                break;
        }
        
        // Default
        if(!$returnValue && isset($value['default'])) {
            $returnValue = $value['default'];
        }



        // Rückgabe
        return $returnValue;
    }


    public function unFormatColumn($value, $field) {


        // Betrag
        if (isset($field['format'])) {

            $c = (isset($field['format-config'])) ? $field['format-config'] : false;


            switch ($field['format']) {

                    // Als Datum formatieren
                case "date":

                    // Nach Zeitstempel suchen, nur wenn gültiges Datum
                    //$date = DateTime::createFromFormat('d.m.Y', $value);
                    //$value = $date->format('Y-m-d');

                    break;

                    // Als Zeit formatieren
                case "time":
                    // Nach Zeitstempel suchen, nur wenn gültiges Datum
                    break;

                    // Als Zeit formatieren
                case "datetime":
                    // Nach Zeitstempel suchen, nur wenn gültiges Datum
                    break;

                    // Als Zeit formatieren
                case "custom-datetime":
                    // Nach Zeitstempel suchen, nur wenn gültiges Datum
                    break;

                    // Als Nummer formatieren
                case "number":
                    // Wie umgehen, wenn mehrere Nullen angefügt wurde?
                    // $value = str_replace(",", ".", str_replace(".", "", $value));
                    break;

                    // Als Währung formatieren
                case "betrag":
                    $value = str_replace(",", ".", str_replace(".", "", $value));

                    if ($c) {
                        $value = trim(str_replace($c[0], "", $value));
                    }
                    break;

                    // Ja oder Nein einsetzen
                case "yes-no":
                    // Nur wenn es keine HTML Werte sind
                    break;
            }
        }


        return $value;
    }



    // Output
    public function output() {
        echo json_encode($this->output);

        // 
        if ($this->debug) {
        }
    }

    // Select Query erstellen
    public function generateSelect() {

        // Alle Felder zum Auswählen
        $select = [];

        // Select Query mit AS bauen
        foreach ($this->config['fields'] as $key => $value) {
            if ($value['type'] != 'special') {
                $select[] = $value['select'] . " AS `" . $value['alias'] . "`";
            }
        }

        // Select Query
        $this->select = "SELECT " . implode(",", $select) . " FROM `" . $this->config['table']['name'] . "` ";
    }

    // Joins erstellen
    public function generateJoins() {

        $joins = "";

        // Wenn der Wert gesetzt ist
        if (isset($this->config['table']['joins'])) {

            // Wenn es ein Array ist
            if (is_array($this->config['table']['joins']) && count($this->config['table']['joins']) > 0) {
                $joins = implode(" ", $this->config['table']['joins']);
            } else {
                $joins = $this->config['table']['joins'];
            }
        }

        $this->joins =  $joins;
    }

    // WHERE Filter
    public function generateFilter() {

        // Request
        $request = $this->request;

        $this->log[] = "----> Generate Where Query";

        // Initalisiere Where
        $where = "";

        // Init
        $completeFilter = [];

        // Fester Filter
        $fixedFilter = $this->generateFixedFilter();
        if ($fixedFilter) {
            $completeFilter[] = $fixedFilter;
        }

        // Spalten Filter
        $columnFilter = $this->generateColumnFilter();
        if ($columnFilter) {
            $completeFilter[] = $columnFilter;
        }

        // Globale Suche 
        $seachFilter = $this->generateSearchFilter();
        if ($seachFilter) {
            $completeFilter[] = $seachFilter;
        }

        // Wenn es einen Fix Filter in PHP gibt
        if ($this->fixedFilter) {
            $completeFilter[] = $this->fixedFilter;
        }

        // Filter zusammenfügen
        if (count($completeFilter) > 0) {
            $where = " WHERE (" . implode(') AND (', $completeFilter) . ")";
        }

        // Query
        $this->log[] = "WHERE QUERY: " . $where;

        // Where setzen
        $this->where = $where;
    }

    // Fester Filter
    public function generateFixedFilter() {

        $this->log[] = "--> Fixed Filter erstellen";

        $result = false;

        $fixed = (isset($this->request['filter']['fixed']) && count($this->request['filter']['fixed']) > 0) ? $this->request['filter']['fixed'] : false;

        // Wenn es einen Spaltenfilter gibt
        if ($fixed && $fixed['isFilterObj'] == 'true') {

            // Ergebnis
            $result = $this->filterObjToString($fixed);
        } else {
            $this->log[] = "-- Kein Fixed Filter";
        }

        return $result;
    }

    // Column Filter
    public function generateColumnFilter() {

        $result = false;

        $columns = (isset($this->request['filter']['columns']) && count($this->request['filter']['columns']) > 0) ? $this->request['filter']['columns'] : false;

        $this->log[] = "--> Column Filter erstellen";

        // Wenn es einen Spaltenfilter gibt
        if ($columns && $columns['isFilterObj'] == 'true') {

            // Ergebnis
            $result = $this->filterObjToString($columns);
        } else {
            $this->log[] = "-- Kein Column Filter";
        }

        return $result;
    }

    // Suchfilter erstellen
    function generateSearchFilter() {

        $this->log[] = "--> Suchfilter erstellen";

        // Verkürzen
        $search = isset($this->request['search']) ? $this->request['search'] : false;

        // Suchfilter
        $searchFilter = false;

        // Globale Suche
        if ($search && $search['value'] != '') {

            // String
            $extractedString = $this->extractSearchValues($search['value']);

            // Suchfilter
            $searchFilter = "";

            // Druch Leerzeichen getrennte Suchberiffe
            foreach ($extractedString['begriffe'] as $key => $suchbegriff) {

                // Alle Beriffe 
                $array = [];

                // Schleife durch jedes Feld
                foreach ($this->config['fields'] as $value) {
                    if ($value['searchable'] == true) {
                        $array[] = "" . $value['select'] . " LIKE '%" . $this->unFormatColumn($suchbegriff, $value) . "%'";
                    }
                }

                // Wenn es mehrere sind zu einer UND Suche verknüpfen
                $searchFilter .= "(" . implode(" OR ", $array) . ")";


                if ($key < count($extractedString['begriffe']) - 1) {
                    $searchFilter .= " " . $extractedString['anweisungen'][$key] . " ";
                }
            }


            // Log
            $this->log[] = "-- Suchfilter >" . $searchFilter . "<";
        } else {
            $this->log[] = "-- Keine Suche";
        }


        // print_r($searchFilter);

        return $searchFilter;
    }

    /**
     * Macht aus einem Filter Objekt einen String
     * 
     */
    function filterObjToString($obj) {

        $this->log[] = "Filter Object to String";

        // Weiteren Filter
        if ($obj['filter'] != 'false') {

            // Sammeln
            $collect = [];

            // Für jeden Filter
            foreach ($obj['filter'] as $filter) {
                $collect[] = $this->filterObjToString($filter);
            }

            // Wenn es eine Spalte ist
        } else {

            // Wenn es ein Array ist
            $columns = (is_array($obj['column'])) ? $obj['column'] : [$obj['column']];

            // Wenn es mehrere Werte sind
            $multiValues = (is_array($obj['value']) && $obj['type'] != 'in') ? true : false;

            // Prüfen ob bei Multi Values genauso viele Werte in den beiden Arrays sind
            if ($multiValues && count($obj['value']) != count($columns)) {
                throw new Exception("Die Anzahl der Werte unterscheidet sich von den Spalten!", 1);
            }

            // Collect
            $collect = [];
            $i = 0;

            // Für jede Spalte
            foreach ($columns as $column) {

                // Wenn die Spalte Nummerisch angegeben wurde
                $columnName = (is_numeric($column)) ? $this->getNameByIndex($column) : $column;
                $columnData = ($columnName) ? $this->config['fields'][$columnName] : false;

                if ($columnData) {

                    $this->log[] = $columnData['select'];

                    // Wert bestimmen, wenn es sich um Multi Values handelt
                    $value = ($multiValues) ? $obj['value'][$i] : $obj['value'];

                    // Wenn einfach nur das Zeichen erstetz werden muss
                    if (in_array($obj['type'], ['=', '!=', '<', '>', '<=', '>='])) {

                        // Mit dem entsprechenden Zeichen
                        $collect[] = $columnData['select'] . " " . $obj['type'] . " '" . $value . "'";


                        // Wenn es eine Like Abfrage ist
                    } else if (in_array($obj['type'], ['*.', '.*', '*'])) {

                        // Like Abfragen mit %
                        $collect[] = $columnData['select'] . " LIKE '" . ((in_array($obj['type'], ['*.', '*'])) ? "%" : "") . $value . ((in_array($obj['type'], ['.*', '*'])) ? "%" : "") . "'";

                        // Wenn es eine IN Abfrage ist
                    } else if ($obj['type'] == 'in') {

                        // Bei IN gibt es keine Multiple Values!!!
                        $collect[] = $columnData['select'] . " IN ('" . implode("','", $obj['value']) . "')";

                        // Unbekannter Typ
                    } else {
                        throw new Exception("Unbekannter Type >" . $obj['type'] . "<", 1);
                    }

                    // Keine Daten zum Filtern
                } else {
                    throw new Exception("Keine Daten zum Filtern der Spalte gefunden!", 1);
                }

                $i++;
            }
        }

        // Final
        $final = "(" . implode(" " . $obj['logic'] . " ", $collect) . ")";

        $this->log[] = $final;

        return $final;
    }

    function extractSearchValues($input) {

        // Doppelte Eingaben entfernen
        $input = preg_replace('/\s+/', ' ', $input);

        // Suche nach in Hochkomma angegeben Werten
        $count = preg_match_all('/"(.*?)"/', $input, $array);

        // Prüfen ob die RegEx zutrifft 
        if ($count > 0) {
            foreach ($array[1] as $key => $values) {
                $input = str_replace($array[0][$key], str_replace(" ", "~~~", $values), $input);
            }
        }

        // Leerzeichen = AND
        // || = AND
        // Für den Falls, dass beide nebeneinander stehen, gewinnt das &
        $input = preg_replace('/\s\|/', '|', $input);
        $input = preg_replace('/\|\s/', '|', $input);

        // Erstmal nach Leerzeichen filtern
        $array = explode(" ", trim($input));

        // Zwei Array initalisieren
        $newArray = [];
        $anweisung = [];

        $limit = count($array);

        // Schliefe
        foreach ($array as $key => $value) {

            // Sub Array
            $subArray = explode("|", trim($value));

            if (count($subArray) > 1) {

                $limit2 = count($subArray) - 1;

                foreach ($subArray as $key2 => $value2) {
                    $newValue = str_replace("~~~", " ", $value2);

                    if ($newValue) {
                        $newArray[] = $newValue;
                    }

                    if ($newValue && $limit2 > $key2) {
                        $anweisung[] = "OR";
                    }
                }
            } else {

                if ($value) {
                    $newArray[] = str_replace("~~~", " ", $value);
                }

                if ($value && $limit > $key && $limit != 1) {
                    $anweisung[] = "AND";
                }
            }
        }

        // Rückgabe
        return [
            'begriffe' => $newArray,
            'anweisungen' => $anweisung
        ];
    }



    // Limit
    function generateLimit() {

        // Request
        $request = $this->request;

        $limit = '';

        if (isset($request['start']) && $request['length'] != -1) {
            $limit = "LIMIT " . intval($request['start']) . ", " . intval($request['length']);
        }

        $this->limit = $limit;
    }

    // Order
    function generateOrder($custom_order = false) {

        // Request
        $request = $this->request;
        $allFields = array_merge([false], array_keys($this->config['fields']));

        $order = "";
        $reihenfolge = [];

        // Request überprüfen
        if (isset($request['order']) && count($request['order'])) {

            // Für jeden Order Request
            foreach ($request['order'] as $sorting) {

                // Einstellungen für das Field
                $settings = $this->config['fields'][$allFields[$sorting['column']]];

                // Standard Feld
                if ($settings['type'] == 'field' || $settings['type'] == 'calculation' || $settings['type'] == 'multi-field') {

                    // Prüfen ob ein Punkt gesetz ist 
                    $reihenfolge[] = "`" . $settings['alias'] . "` " . $sorting['dir'];
                }

                /*
                CUSTOM ORDER Erstmal weglassen

                if(isset($custom_order[$sorting['column']]) && strlen($custom_order[$sorting['column']])) {
                    
                    // Custom Order
                    $reihenfolge[] = str_replace('<%DIR%>',$sorting['dir'],$custom_order[$sorting['column']]);
                    
                } else {

                */
            }

            // Wenn es etwas zum sortieren gibt!
            if (count($reihenfolge) > 0) {
                $order = "ORDER BY " . implode(', ', $reihenfolge);
            }
        }

        $this->order = $order;
    }

    public function getPrimary() {

        // Tabelle und Field setzen
        $table = false;
        $field = false;

        // Wenn Primär gesetzt ist
        if (isset($this->config['table']['primary'])) {

            // Wenn es ein Konfig Array ist
            if (is_array($this->config['table']['primary'])) {

                // Tabelle füllen
                $field = (isset($this->config['table']['primary']['field'])) ? $this->config['table']['primary']['field'] : false;
                $table = (isset($this->config['table']['primary']['table'])) ? $this->config['table']['primary']['table'] : $this->config['table']['name'];

                // Wenn die Konfiguration nur aus einem String besteht
                // dann handelt es sich um das Feld
            } else {
                $field = $this->config['table']['primary'];
                $table = $this->config['table']['name'];
            }
        }

        // Wenn das Feld nicht definiert ist, dann wird automatisch das erste in der KOnfig
        // als Primär-Key angenommen
        if (!$field) {

            // Erstes Feld
            $arrayKeyFirst = array_key_first($this->config['fields']);

            // Gibt das komplette erste Objekt zurück
            $arrayFirst = $this->config['fields'][$arrayKeyFirst];

            // 
            $field = (isset($arrayFirst['field'])) ? $arrayFirst['field'] : $arrayKeyFirst;
            $table = (isset($arrayFirst['table'])) ? $arrayFirst['table'] : $table;
        }

        // Wenn die Table
        if (!$table) {
            $table = $this->config['table']['name'];
        }

        // Rückgabe
        return [
            'table' => $table,
            'field' => $field
        ];
    }

    public function getCountSelect() {

        // Primary
        $primary = $this->getPrimary();

        // Query erstellen
        $query = "SELECT COUNT(`" . $primary['table'] . "`.`" . $primary['field'] . "`) AS counter FROM `" . $this->config['table']['name'] . "` " . $this->joins;

        // Rückgabe
        return $query;
    }


    /**
     * Abfrage nach allen
     */
    public function generateTotal() {


        global $db;

        // Init
        $count = 0;

        // Query
        $query = $this->getCountSelect();

        if (($this->fixedFilter)) {
            $query .= " WHERE (" . $this->fixedFilter . ")";
        }

        // Ergebnis auslesen
        $result = $db->query($query);

        // Ergebnis prüfen
        if ($result->num_rows > 0) {
            $count = $result->fetch_assoc()['counter'];
        }

        // Alle Records
        $this->recordsTotal = $count;
    }


    public function generateFiltered() {

        global $db;
        // Init
        $count = 0;

        // Query
        $query = $this->getCountSelect() . " " . $this->where;

        // Ergebnis auslesen
        $result = $db->query($query);

        // Ergebnis prüfen
        if (!$result) {
            echo "Fehler bei der Count Query >>>" . $query . "<<< | >>>" . $db->error . "<<<";
            die();
        }

        if ($result->num_rows > 0) {
            $count = $result->fetch_assoc()['counter'];
        }


        $this->recordsFiltered = $count;
    }



    // Get Records
    function generateRecords($tabelle, $primaryKey, $where = '', $leftJoin = '') {

        global $db;

        $count = 0;

        // Explode Key
        $values = explode('.', $primaryKey);
        $query = "SELECT COUNT(`" . implode('`.`', $values) . "`) AS counter FROM " . $tabelle . " " . $leftJoin . " " . $where . ";";

        $result = $db->query($query);
        if ($result->num_rows > 0) {
            $result = $result->fetch_assoc();
            $count = $result['counter'];
        }


        return $count;
    }

    public function generateQuery() {
        $this->query = $this->select . " " . $this->joins . " " . $this->where . " " . $this->order . " " . $this->limit;
    }

    public function escapeTnC($input) {
        // Prüfen ob ein Punkt gesetz ist 
        return "`" . implode('`.`', explode('.', $input)) . "`";
    }


    public function createDisabledQuery($input) {

        $req = new Request();

        // Wenn es ein Array ist, wird die Query dynamisch erstellt
        if (is_array($input)) {

            // Wenn der Filter ein Objekt ist
            if (is_array($input['filter'])) {

                $where = [];

                // Where
                foreach ($input['filter'] as $key => $value) {
                    $where[] = "`" . $key . "` = '" . $value . "'";
                }

                // Where 
                $where = implode(" AND ", $where);

                // Wenn der Filter ein normaler String ist
            } else {
                $where = $input['filter'];
            }

            // Query erstellen
            $query = "SELECT `" . $input['field'] . "` FROM `" . $input['table'] . "` WHERE " . $where;


            // Wenn der Input ein String ist, dann ist dieser die Query
        } else {
            $query = $input;
        }


        // Multi Query
        $req->getMultiQuery($query, true);

        // Leeres Array initalisieren
        $newData = [];

        // Schleife durch alle Ergebnisse
        foreach ($req->result as $key => $value) {

            // 
            $arrayKey = array_key_first($value);

            // 
            $newData[] = strval($value[$arrayKey]);
        }

        // Ergebnis
        $req->result = $newData;

        // 
        return $req->answer();
    }
}

// Wird noch aus kompatibitätsgründen behalten
// Früher hies die Klasse Dt, jetzt heißt Sie Picklist
// Damit alte Funktionen noch funktioniern, wird die Klasse aber kopiert!
class Dt extends Picklist {
    // Nothing
}


/*

    // Generate Column Filter (ALTE VERSION ÜBER DATATABLES!)   
    // NICHT MEHR IN GEBRAUCHT!!!!
    public function generateColumnFilterOld() {

        $request = $this->request;

        // Jede Spalte loopen
        foreach($request['columns'] AS $key => $value) {
            
            // Nur hinzufügen, wenn das Feld durchsuchbar ist
            if($value['searchable'] == "true" && strlen(trim($value['search']['value'])) > 0) {

                // Daten der Spalte
                $columnName = $this->getNameByIndex($key);
                $columnData = ($columnName) ? $this->config['fields'][$columnName] : false;

                if($columnData) {

                    $this->log[] = $columnData['select'];

                    $columnFilter[]  = $columnData['select']." = '".$value['search']['value']."'";

                }

                // $this->log[] = $this->config['fields']['select'];

                // ColumnFilter zusammensetzen
                $columnName = explode('.', $spalten[$key]);
                
                // Für den Sonderfall, dass eine oder Suche integriert ist
                if(substr($value['search']['value'],0,5) == '~~s~~') {
                    
                    $oderArray = explode('~',str_replace('~~s~~','',$value['search']['value']));
                    $oderSearchParts = [];		
                    
                    foreach($oderArray AS $values) {
                        $oderSearchParts[] = "`".implode('`.`',$columnName)."` = '".$values."'";
                    }
                    
                    $columnFilter[]  = "(".implode(" OR ", $oderSearchParts).")";						

                } else {
                    
                }        
            }
        }
    }

    */
