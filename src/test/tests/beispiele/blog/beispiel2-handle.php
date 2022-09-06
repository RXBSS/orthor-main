<?php


if($_POST['task'] == 'test') {

    // Die Klasse Sanitized automatisch die Anfrage
    $req = new Request($_POST);

    // Die sauberen Daten stehen dann unter requestData zur Verfügung. Zur Vereinfachung kann man sich dies in eine kurze Variable setzen
    $d = $req->requestData['formData'];

    // Insert Query schreiben
    $query = "INSERT INTO `example` SET `field1` = '".$d['field1']."', ...";

    // 
    $req->setQuery($query);

    // Verarbeiten - Führt die Datenbank Abfrage durch und setzt die Antworten automatisch
    $req->process();

    // Gibt eine JSON im passenden Format zurück
    $req->answer();

}





?>