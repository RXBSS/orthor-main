<?php include('01_init.php');

$_page = [
    'title' => "Form Sample 2",
    'breadcrumbs' => ['<a href="form-handler">Form Handler</a>']
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
                    <h4 class="card-title"><i class="fa-solid fa-fish"></i> Activation Card mit Forms</h4>
                    <h6 class="subtext">Das ist Verbindung einer Activation Card mit einer Form</h6>

                  
                    <form id="test">

                        <div class="form-group form-floating">
                            <input type="text" name="test" class="form-control editable" placeholder="Bezeichnung" autocomplete="off" required>
                            <label>Bezeichnung</label>
                        </div>

                        <div class="form-group form-floating">
                            <input type="text" name="test2" class="form-control editable" placeholder="Bezeichnung" autocomplete="off" required>
                            <label>Bezeichnung</label>
                        </div>


                        <br><br>
                        <button class="btn btn-primary">Submit</button>
                        <button id="test-load" class="btn btn-secondary" type="button">Load</button>
                        <button id="test-r1" class="btn btn-secondary" type="button">set</button>
                        <button id="test-r2" class="btn btn-secondary" type="button">unset</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {
        var form = new Form('#test');

       
        

        form.initValidation();

        var result = form.inValidationList('test');
        console.log(result);

       

        form.on('submit',function() {
            app.notify.success.fire("Erfolgreich","Submit");
        });

    


        $('#test-load').on('click', function() {
            form.load('load-test','form-handle-test-backend');

        });

        $('#test-r1').on('click', function() {
            form.setReadonly(true);
        });


        $('#test-r2').on('click', function() {
            form.setReadonly(false);
        });



    });
</script>

</html>