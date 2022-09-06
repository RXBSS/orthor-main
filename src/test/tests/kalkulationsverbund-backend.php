<?php include('01_init.php');


// Request
$req = new Request();

// Auf Success setzen
$req->success = true;

// Ergebnis
$req->result = [
    'menge' => 5,
    'ek' => 1000,
    'vk' => 2000,
    'steuer_satz' => 19
];

// Answert
$req->echoAnswer();



?>