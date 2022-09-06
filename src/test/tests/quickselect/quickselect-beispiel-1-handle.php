<?php include('01_init.php');

$req = new Request($_POST);

if($_POST['task'] == 'load') {

    $req->getByKey("_laender","code", (is_array($_POST['data'])) ? $_POST['data'][0] : $_POST['data']);
    $req->echoAnswer();

} else if($_POST['task'] == 'save') {

    // Neuer Subrequest
    $subreq = new Request($_POST['formData']);

    // Process Array
    $process = [
        ['t','de'],
        ['t','en'],
        ['t','es'],
        ['t','fr'],
        ['t','it'],
        ['t','ru']
    ];

    // Neu hinzufügen
    if($_POST['formData']['subtask'] == 'new') {

        // Code noch hinzufügen
        $process = array_merge([
            ['t','code']
        ], $process);

        // Insert
        $subreq->insert("_laender", $process);


    // Bearbeiten
    } else if ($_POST['formData']['subtask'] == 'edit') {

        $subreq->updateByKey("_laender", $process, "code", $_POST['formData']['code']);
        
    // Fehler
    } else {
        $req->success = false;
    }
 
    // Form-Daten als Ergebnis übergeben!
    // Das ist notwendig, da wir ja das eben abgespeicherte noch in der Quickselect ersetzten wollen
    $subreq->result = $_POST['formData'];

    // Antworten
    $req->echoAnswer($subreq);

} else if($_POST['task'] == 'remove') {

    // Löschen
    $req->deleteMultipleByKey("_laender", "code", $_POST['data']);
    $req->echoAnswer();

}


?>