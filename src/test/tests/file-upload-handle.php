<?php include('01_init.php');


// Post Data
$req = new Request($_POST);

if ($_POST['task'] == 'upload-file') {

    // Uploaded Files verschieben
    $req->moveUploadedFiles($_FILES, "demo", [
        'normalize' => true
    ]);

    // In die Datenbank schreiben
    $req->uploadResultToDatabase('example_upload');

    //  Antwort ausgeben
    $req->echoAnswer();
} else if ($_POST['task'] == 'upload-image') {

    // Uploaded Files verschieben
    $req->moveUploadedFiles($_FILES, "demo2", [
        'normalize' => true
    ]);

    // In die Datenbank schreiben
    $req->uploadResultToDatabase('example_upload2');

    //  Antwort ausgeben
    $req->echoAnswer();
} else if ($_POST['task'] == 'galerie') {

    $query = "SELECT * FROM `example_upload2`";

    // 
    $req->getMultiQuery($query, true);

    // Schleife
    if($req->result) {
        foreach($req->result AS $key => $value) {
            $req->result[$key] = [
                'name' => $value['name_original'],
                'imageUrl' => $value['pfad']."/".$value['name']
            ];
        }
    }



    //  Antwort ausgeben
    $req->echoAnswer();


    // 
} else if ($_POST['task'] == 'delete') {


    // Verzeichnis löschen
    if (is_dir("demo")) {

        $result = scandir("demo");

        foreach ($result as $key => $file) {
            if ($file != '.' && $file != '..') {
                unlink("demo/" . $file);
            }
        }

        $req->clear("example_upload", "suredelete");
    } else {
        $req->success = true;
    }

     // Verzeichnis löschen
     if (is_dir("demo2")) {

        $result = scandir("demo2");

        foreach ($result as $key => $file) {
            if ($file != '.' && $file != '..') {
                unlink("demo2/" . $file);
            }
        }

        $req->clear("example_upload2", "suredelete");
    } else {
        $req->success = true;
    }

    $req->echoAnswer();
}
