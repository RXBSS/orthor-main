<?php include('01_init.php');

$_page = [
    'title' => "Konfigurationsdatei"
];

?>
<!doctype html>

<head>
    <?php include('02_header.php'); ?>
</head>

<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="container-fluid">
            
            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fas fa-cogs'></i> Konfiguration</h4>
                    <h6 class='subtext'>Hier die Ausgabe der Konfiguration bzw. der kompletten Session</h6>

                    <hr>

                    <pre><?php 
                        print_r($_SESSION);
                        ?></pre>

                </div>
            </div>
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
</html>