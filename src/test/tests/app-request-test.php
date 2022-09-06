<?php include('01_init.php');

if($_POST['task'] == 'mytask') {

    $req = new Request($_POST);


    if($_POST['data'] == 1) {
        $req->success = true;
    } else if($_POST['data'] == 2) {
        $req->success = false;
        $req->error = "Da fehlt wohl etwas, es hat nicht geklappt, bitte prüfe noch einmal";
    } else if($_POST['data'] == 3) {
        throw new Exception("Something went totally wrong motherf****");
    }   

    // Antwort senden
    $req->echoAnswer();    
}


?>