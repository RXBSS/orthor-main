<?php include('./../../../01_init.php');


class TestDt extends Dt {
    public function editSpecialColumn($row, $field, $defs) {
        
        $value = "";
        
        switch ($field) {
            case "special":

                // $value = substr($a['name'],0,3). "$$$"; 

                break;

            case "link":

                $value = '<a href="javascript:void(0);">Link</a>';

                break;
        }

        return $value;
    }

    public function getAdditionalOutput() {

        // $this->
        // Zusätzliche DB Abfragen

        return ["some" => "data"];
    }
}


// Get Variable übergeben
$dt = new TestDt($_GET, "example");

// Verarbeiten
$dt->process();


// echo $dt->where;


// Output
$dt->output();
