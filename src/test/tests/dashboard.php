<?php include('01_init.php');

$_page = [
    'title' => 'Dashboard'
];

?>
<!doctype html>

<!-- Head -->

<head>
    <title>Dashboard</title>
    <?php include('02_header.php'); ?>
    
</head>


<!-- Body -->

<body>
    <?php include('03_navigation.php'); ?>

    <style>

        .avatar-char {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: red;
            font-size: 20px;
            margin-top: 2%;
            text-align: center;
            padding-left: 0%;
            color: white;
            font-weight: 1000;
        }
    </style>

    <div class="wrapper">
        <div class="container-fluid">
    
            <div class="row">
                <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">

                                <h4><i class="fa-solid fa-exclamation-circle"></i> Dashboard</h4>
                                <h6 class="subtext">Willkommen auf unserem Dashboard</h6>
                                <p>Aktuelle ist noch alles in Bearbeitung, aber bald wird unser Orthor, der orthor über alle sein!       <i class="fa-solid fa-trophy fa-3x"></i></p>

                                <hr>    

                                <div class="row">
                                    <div class="col-md-6">
                                    </div>
                                </div>

                        
                            
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    
            
                </div>
            </div>
            

          

            
            
        </div>
    </div>



</body>

<?php include('04_scripts.php'); ?>


<script>
    $(document).ready(function() {

        
      
    });
</script>

</html>