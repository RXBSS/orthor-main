<?php include('01_init.php');

$_page = [
    'title' => "Meine Seite"
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
                    <h4><i class='fas fa-user'></i> Benuterverwaltung</h4>

                    <h6 class='subtext'>Hier findet die Benutzerverwaltung statt!</h6>


                    <form id="example">
                        <div class="form-floating">
                            <input type="text" name="benutzername" class="form-control editable" placeholder="Benutzername">
                            <label>Benutzername</label>
                        </div>
                        
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control editable" placeholder="Passwort">
                            <label>Passwort</label>
                        </div>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>

</html>
