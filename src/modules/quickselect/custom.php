<?php include($_SERVER["DOCUMENT_ROOT"].'/01_init.php'); 

// Ausgabe
$q = new Quickselect($_GET);

$array = [
    ['id' => 1000, 'text' => '1000 - Ein toller Wert'],
    ['id' => 2000, 'text' => '2000 - Noch besserer Wert'],
    ['id' => 3000, 'text' => '3000 - Der tollste Wert']
];



$q->outputDataAsJson($array);

?>