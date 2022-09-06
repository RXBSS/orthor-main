<?php include('01_init.php');

$_page = [
    'title' => "Formatter PHP"
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
            PHP Formatter

            <?php

            $test = "DE42530601800000233072";

            $f = new Formatter();

            $after = $f->block($test);


            print_r($test);
            echo "<br>";
            print_r($after);

            ?>


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