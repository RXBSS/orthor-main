<?php include($_SERVER["DOCUMENT_ROOT"].'/01_init.php'); 

// Ausgabe
$q = new Quickselect($_GET);
$q->createComplete("liste_a", ["bezeichnung"]);

?>