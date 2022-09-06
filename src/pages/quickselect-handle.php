<?php include($_SERVER["DOCUMENT_ROOT"].'/01_init.php'); 
/**
 * Hierbei handelt es sich um eine Standard-Handle Datei
 * 
 * 
 * 
 * 
 */

// Quickselect Klasse definieren
$q = new Quickselect($_GET);

// Primär-Schlüssel
$primary = ($_GET['primary'] && $_GET['primary'] != 'false') ?  $_GET['primary'] : 'id';
$schema = ($_GET['schema'] && $_GET['schema'] != 'false') ?  $_GET['schema'] : false;

// Create Complete
$q->createComplete($_GET['table'], $_GET['fields'], $primary, $schema);


?>