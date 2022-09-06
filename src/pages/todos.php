<?php include('01_init.php');

$_page = [
    'title' => "To-Do's"
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
                    <h4 class="card-title"><i class="fa-solid fa-check"></i> To-Do's</h4>
                    <h6 class="subtext">Das Konzept der ToDos</h6>

                   
                    <em>Siehe Seitenleiste / Haken oben Rechts<br>Dokumentation folgt...</em>





                </div>
            </div>
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {

        var todo = new ToDo();



    });
</script>

</html>