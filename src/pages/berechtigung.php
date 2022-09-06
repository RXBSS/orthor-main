<?php include('01_init.php');

$_page = [
    'title' => "<i class=\"fa-solid fa-exclamation-triangle text-danger\"></i> Fehlende Berechtigung"
];

?>
<!doctype html>

<head>
    <?php include('02_header.php'); ?>
</head>

<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="d-flex justify-content-center align-items-center">
            <div style="margin-top: 10vh;">
                <h1><i class="fa-solid fa-exclamation-triangle text-danger"></i> Fehlende Berechtigung</h1>
                <p>
                    Sie haben keine Berechtigung auf diese Seite zuzugreifen.<br>
                    Sollte es sich dabei um einen Fehler handeln, melden Sie sich bitte bei Ihrem Administrator.
                </p>
                <button id="btn-page-back" class="btn btn-secondary"><i class="fa-solid fa-reply"></i> Zurück</button>
                <button id="btn-page-home" class="btn btn-secondary"><i class="fa-solid fa-house"></i> Startseite</button>
            </div>
        </div>
    </div>

</body>
<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {

        $('#btn-page-back').on('click', function() {
            history.back();
        });

        $('#btn-page-home').on('click', function() {
            app.redirect("/");
        });

    });
</script>

</html>