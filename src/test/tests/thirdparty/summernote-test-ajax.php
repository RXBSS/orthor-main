<?php include($_SERVER["DOCUMENT_ROOT"].'/01_init.php'); 



$req = new Request($_POST);

// Laden
if($_POST['task'] == 'load') {

    $req->result = [
        'smform' => 'Hallo Welt'
    ];

    $req->success = true;

    $req->echoAnswer();

// Speichern
} else if($_POST['task'] == 'save') {

    // Alles löschen
    $result = scandir("data/summernote-demo");

    foreach($result AS $key => $value) {
        if($value != '.' && $value != '..') {
            unlink("data/summernote-demo/".$value);
        }
    }


    $result = $req->extractImagesFromText($req->data['formData']['smform'], "data/summernote-demo");

    $req->success = true;
    $req->result = $result;
    $req->echoAnswer();


} else if($_POST['task'] == 'mini-explorer') {

    // Ergebnis
    $req->result = scandir("data/summernote-demo");

    $req->success = true;
    $req->echoAnswer();

} else if($_POST['task'] == 'mini-explorer-delete') {
    
   

    $req->success = true;
    $req->echoAnswer();
}









?>