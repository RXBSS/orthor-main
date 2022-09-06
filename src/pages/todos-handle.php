<?php include_once('01_init.php');
/**
 * Handler für die Todos
 * 
 * 
 * 
 */


$req = new Request($_POST);
$todo = new ToDo();


// GET
if($_POST['task'] == 'get') {
    $res = $todo->getOpenUser(1);
    $req->adapt($res);
    $req->echoAnswer();

// SET COMPLETE
} else if($_POST['task'] == 'set-complete') {
    $res = $todo->setComplete($req->data['data']);
    $req->adapt($res);
    $req->echoAnswer();
}





?>