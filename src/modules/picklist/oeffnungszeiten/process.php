<?php include('./../../../01_init.php');


class OeffnungszeitenPicklist extends Picklist {

    public function editSpecialColumn($row, $field, $defs) {

        $result = "";

        switch ($field) {
            case "tag2":
                $tage = [null, "Mo", "Di", "Mi", "Do", "Fr", "Sa", "So"];
                $result = $tage[$row['_tag']];
                break;

            case "zeit1":
                if ($row['_offen'] == 1) {
                    $result = substr($row['_von1'], 0, 5) . " - " . substr($row['_bis1'], 0, 5);

                    // Wenn zweite Öffnungszeiten vorhanden sind
                    if ($row['_von2']) {
                        $result .= " | ".substr($row['_von2'], 0, 5) . " - " . substr($row['_bis2'], 0, 5);
                    }

                } else {
                    $result = "Geschlossen";
                }
                break;
        }

        return ($result && date('N') == $row['_tag']) ? "<strong>".$result."</strong>" : $result;
    }
}


// Get Variable übergeben
$dt = new OeffnungszeitenPicklist($_GET, "oeffnungszeiten");

// Verarbeiten
$dt->process();

// Output
$dt->output();
