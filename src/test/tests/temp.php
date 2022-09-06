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


            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fas fa-icon"></i> Titel</h4>

                    <h6 class="subtext">Das ist der Subtext</h6>

                    <div id="test"></div>
                </div>
            </div>






        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {

        var fc = new FormCreator();
        var array = [];
        var test = ['SW', 'Farbe'];
        for(var i = 0; i < test.length; i++) {

            array.push(fc.createInput('input-' + i, test[i]));

        }


        $('#test').append("<div class='row'><div class='col-4'>" + array.join("</div><div class='col-4'>") + "</div></div>");


    });
</script>

</html>