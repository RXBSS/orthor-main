<?php include('01_init.php');

$req = new Request($_POST);

if($_POST['task'] == 'load') {
    
    $req->result = [
        'laender' => 'de'
    ];


    $req->success = true;
    $req->echoAnswer();

} 
?>