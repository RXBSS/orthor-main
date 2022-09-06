<?php include('01_init.php');

$_page = [
    'title' => "Beispiel 2"
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
            <div id="example-pickliste"></div>



            <form id="test-form">

                <div class="form-group form-floating">
                    <input type="text" name="titel" class="form-control editable" placeholder="Titel" value="Hans" required>
                    <label>Titel</label>
                </div>

                <div class="form-group form-floating">
                    <textarea class="form-control editable" name="inhalt" required></textarea>
                    <label>Inhalt</label>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-floating">
                            <textarea class="form-control" placeholder="Floating Textarea"></textarea>
                            <label>Hallo</label>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>

                <br>
                <br>
                <button class="btn btn-primary">Submit</button>

            </form>



        </div>
    </div>

    <div class="fab-container">
        <button class="btn btn-primary btn-neuer-blogeintrag"><i class="fa-solid fa-plus"></i></button>
    </div>

</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {


        /*
        var list = new Picklist("#example-pickliste", "blog", {

        });
        */


        var form = new CardForm('#test-form', true, true);

        // Validierung aktivieren
        form.initValidation();

        form.on('valid', function() {

            form.save('test', 'beispiel2-handle.php');

        });


        /*
        // validierung

        $('#test-form').on('submit',function(e) {
            e.preventDefault();

            // Daten einsammeln

            // Ajax Request

                // Erfolgsmeldung

                // Fehlermeldung

            console.log('Abschicken');
        });
        */


        $('.btn-neuer-blogeintrag').on('click', function() {
            app.notify.success.fire("Erfolgreich", "Ihre Aktion wurde erfolgreich angepasst");
        });



    });
</script>

</html>