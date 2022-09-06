<?php include('01_init.php');


$req = new Request($_POST);

/**
 * 
 * 
 */
if($_POST['task'] == 'picklist-disabled') {

    // Pickliste
    $api = new Picklist();

    // Input Daten
    $input = $req->data['data'];

    // Ergebnis
    $result = $api->createDisabledQuery($input);

    // Ergebnis adaptieren
    $req->adapt($result);

    // Antwort
    $req->echoAnswer();
    
}









?>