<?php include('01_init.php');
  
    $_SESSION['log'] = [];


    $_page = [
        'title' => "PHP Test"
    ];

        $app->user->logout();
     
        


?>
<!doctype html>
<head>
    <?php include('02_header.php'); ?>
</head>
<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="container-fluid">
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
</html>