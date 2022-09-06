<?php include('01_init.php');

$_page = [
    'title' => "Test"
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


            // 
            $reqMain = new Request();


            // Hier noch dies
            // Hier noch das

            $reqMain->success = true;
            $reqMain->log[] = 'Hier ein Log';
            $reqMain->log[] = 'Da ein Log';



            // 
            $reqSub = new Request();
            
            // $regSub->insert
            $reqSub->error = "Something went Wrong";

            $reqSub->log[] = "Noch was";


            echo "<pre>";
            print_r($reqSub->answer());
            echo "</pre>";
            

                      

            // $reqMain->adapt($reqSub);


            echo "<pre>";
            print_r($reqMain->answer());
            echo "</pre>";



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