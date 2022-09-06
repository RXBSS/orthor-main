<?php include('01_init.php');

$_page = [
    'title' => "Large DB Test"
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
            <div id="large-db-picklist"></div>
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {
        var list = new Picklist("#large-db-picklist", "large");
    });
</script>
</html>