<?php


$_GET['url'];

$req = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=Museum%20of%20Contemporary%20Art%20Australia&inputtype=textquery&fields=formatted_address%2Cname%2Crating%2Copening_hours%2Cgeometry&key=AIzaSyBcz5vCR6GMcbQtHfK_ImcU3yQwgmAVfa8";


// cURL Data
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL verification
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $req);
$response = curl_exec($ch);
curl_close($ch);


echo "<pre>";
print_r($response);
echo "<hr>";
$response = json_decode($response, true);
print_r($response);



// print_r($response);

?>
