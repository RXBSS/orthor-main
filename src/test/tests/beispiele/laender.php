<?php include('01_init.php');

$_page = [
    'title' => "Länder"
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
            
            <div class="alert alert-secondary">
                Im Standard wird eine Datenbank von Länder mitausgeliefert. Diese befinden sich in der Tabelle <strong>_laender</strong>.
            </div>



            <div id="laender-pickliste"></div>
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {
        var picklist = new Picklist('#laender-pickliste', "laender");
    });
</script>
</html>