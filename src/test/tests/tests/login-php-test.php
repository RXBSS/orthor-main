<?php include('01_init.php');
  
    $_SESSION['log'] = [];


    $_page = [
        'title' => "PHP Test"
    ];

    //session_destroy();


        // $mail = new Mail();
            
        $email = "c.fernandez@buerosystemhaus.de";
        $password = "crespoo0";

        
        $keepLoggedIn = true;

        //$result = $app->user->login($email, $password, $keepLoggedIn);
        // $app->user->logout();
        // Nur eingeloggte User
        // $app->user->redirectOnNoLogin();
        
//     $app->user->findUser( $email );

        //$result = $app->user->doLogin($email, $password, true);
        //$app->dbConnect();
        


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

                echo "<hr><pre>"; 
                //print_r($result);
                phpinfo();
                echo "</pre>"; 

            ?>
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
</html>