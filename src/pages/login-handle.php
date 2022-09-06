<?php include_once('01_init.php');


if($_POST['task'] == 'login') {

    $log = $_POST;
    $success = false;
    $error = false;

    $cookie = isset($_POST['formData']['stay-logged-in']['checked'] ) ? true : false;
    $data = isset($_POST['formData']) ? $_POST['formData'] : false;
    
    $loginResult = $app->user->checkLogin($data['email'], $data['password']);


    if($loginResult['success']) {
        
        $app->user->doLogin($loginResult['user']['id'], $cookie);
        $success = true;

    } else {
        $error = "Fehler beim Login";
    }

    echo json_encode([
        'success' => $success,
        'error' => $error,
        'log' => $loginResult
    ]);
}


?>