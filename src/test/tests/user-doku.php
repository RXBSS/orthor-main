<?php include('01_init.php');

$_page = [
    'title' => "User API - Dokumentation"
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
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-user"></i> User API</h4>
                    <h6 class="subtext">Dokumentation der User API</h6>
                    <br>
                    <ul>
                        <li>
                            <a href="login">Login</a> 
                            <br>Die Seite zum Einloggen. <em>Funktional aber nicht final</em>
                        </li>
                        <li>
                            <a href="registrieren">Registrieren</a> 
                            <br>Die Seite zum Registrieren <em>Nicht Funktional</em>
                        </li>
                        <li>
                            <a href="profil">Profil</a> 
                            <br>Das Profil <em>Nicht Existent</em>
                        </li>
                        <li>
                            <a href="profil">Benutzerverwaltung</a> 
                            <br>Die Verwaltung <em>Nicht Existent</em>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {
        // Do Something
    });
</script>
</html>