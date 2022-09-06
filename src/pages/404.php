<?php

if(count(explode("/",$_SERVER['REQUEST_URI'])) > 2) {
    header('Location: /404.php?technical=true&request='.urlencode($_SERVER['REQUEST_URI']));
    die();
}


// Entfernen des ? damit die Handle erkannt werden kann
$temp = explode('?', $_SERVER['REQUEST_URI']);

// Prüfen auf Handle
$technical = (isset($_GET['technical']) && $_GET['technical'] == 'true') ? true : str_ends_with($temp[0],"-handle.php");
$reqUrl = (isset($_GET['request'])) ? urldecode($_GET['request']) : $temp[0];

// Wenn es eine Technische Seite ist
if($technical) {

    echo "Die angeforderte Website ><strong>".explode('?', $reqUrl)[0]."</strong>< wurde nicht gefunden";
    die();
}


include('01_init.php');


$_page = [
    'title' => "<i class='fas fa-exclamation-triangle'></i> Seite nicht gefunden"
];

?>
<!doctype html>

<head>
    <?php include('02_header.php'); ?>
</head>

<body>
    <?php

    // Navigation nur einbetten, wenn der Benutzer eingloggt ist
    if ($app->user->isLoggedIn() || 1 == 1) {
        include('03_navigation.php');
        echo '<div class="wrapper">';
    }

    ?>

    <div class="container-fluid fullsize-page d-flex align-items-center">
        <div style="width: 100%;">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-end">
                    <img src="assets/essentials/404_image.png">
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <div>
                        <h1><i class='fas fa-exclamation-triangle'></i> 404 - Seite nicht gefunden</h1>
                        <p>Die angeforderte Seite konnte nicht gefunden werden!<br>
                            Sollte es sich um einen Fehler handeln, dann wenden Sie sich bitte an den Administrator.
                        </p>
                    </div>
                    <div>
                        <a href="index.php" class="btn btn-success"><i class="fa-solid fa-home"></i> Zurück zur Startseite</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php

    if ($app->user->isLoggedIn()) {
        echo '</div>';
    }
    ?>

</body>

<?php include('04_scripts.php'); ?>

</html>