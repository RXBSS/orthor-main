<?php


/**
 * Ein abgespecktes Equivalent zur der JavaScript Klasse
 * Hier werden nur die Dinge benutzt, die man in PHP wirklich braucht. 
 * 
 * 
 */
class Formatter {

    // Stellt sicher, dass es eine PHP Float Variable ist
    public function phpFloat($input) {

        // Normalisieren wenn es kein Float ist
        if (!is_float($input)) {
            $input = (is_int($input)) ? floatval($input) : floatval(str_replace(",", ".", str_replace(".", "", $input)));
        }

        // Rückgabe
        return $input;
    }

    // Generelle Formatierung Funktoin
    public function format($input, $funcName) {

        $result = $input;

        // Funktion ausführen
        $result = $this->$funcName($input);

        return $result;
    }


    public function formatArray($input, $adviser) {

        $result = $input;

        foreach ($adviser as $key => $value) {

            // Wenn es den Key im Input gibt
            if (isset($result[$key])) {
                $result[$key] = $this->format($result[$key], $value);
            }
        }

        return $result;
    }


    // Währung formatieren
    public function betrag($input, $waehrung = false) {
        $waehrung = ($waehrung) ? (($waehrung === true) ? "€" : $waehrung) : false;
        return $this->autoFloat($input, 2, 6) . (($waehrung) ? " " . $waehrung : "");
    }

    // Bytes
    public function bytes($size, $precision = 2) {

        $base = log($size, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');   
    
        return str_replace(".",",",round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)]);
    }



    // Automatische Float 
    public function autoFloat($input, $wanted = 2, $maximal = 6) {

        // 
        $wanted = (is_null($wanted)) ? 2 : $wanted;
        $maximal = (is_null($maximal)) ? 6 : $maximal;

        // Float Variable konvertieren
        $inputAsFloat = $this->phpFloat($input);

        // Anzahl der Nachkommastellen?
        $expl = explode(".", $inputAsFloat);

        // Nachkommastellen
        $nachkomma = (isset($expl[1])) ? strlen($expl[1]) : 0;

        if ($nachkomma > $wanted) {
            $result = number_format($inputAsFloat, ($nachkomma > $maximal) ? $maximal : $nachkomma, ",", ".");
        } else {
            $result = number_format($inputAsFloat, $wanted, ",", ".");
        }

        return $result;
    }


    public function block($value) {
        return implode(" ", str_split($this->trim($value), 4));
    }

    public function trim($value) {
        return trim(str_replace(" ", "", $value));
    }
}
