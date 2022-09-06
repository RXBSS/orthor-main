<?php include('01_init.php');

$_page = [
    'title' => "Vorlagen & Beispiele"
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
                    <h4 class="card-title"><i class="fa-solid fa-info-circle"></i> Vorlagen & Beispiele</h4>
            
                    <p>
                        Orthor kommt mit einer Reihe von Vorlangen und Beispielen. Diese werden im Standard-Paket mit ausgeliefert. 
                    </p>
            
            
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