<?php include('01_init.php');

$_page = [
    'title' => "Template"
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
        <?php   
        

        echo "<pre>";
        print_r($_SERVER);
        echo "</pre>";


    ?> 

</div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    
</script>
</html>