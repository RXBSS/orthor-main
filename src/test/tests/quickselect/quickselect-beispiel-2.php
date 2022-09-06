<?php include('01_init.php');

$_page = [
    'title' => "Quickselect Beispiel 2"
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

            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fas fa-bomb"></i> Quickselect Test</h4>
                            <h6 class="subtext">In diesem Test geht es darum nur die ID zurückzugeben!</h6>


                            <form id="test">

                                <div class="form-group form-floating">
                                    <select class="form-select init-quickselect editable" name="laender" placeholder="Test">
                                        <option value="">Bitte wählen</option>
                                    </select>
                                    <label>Test</label>
                                </div>

                                <br>

                                <button class="btn btn-primary">Senden</button>

                            </form>




                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fas fa-bomb"></i> Quickselect Test</h4>
                            <h6 class="subtext">In diesem Test geht es um die Validierung!</h6>


                            <form id="test-2">

            
                                <div class="qs-buttons d-flex justify-content-between">

                                    <div class="form-group form-floating form-select2-multi-column flex-grow-1">
                                        <select class="form-select init-quickselect editable" name="laender" placeholder="Test" required>
                                            <option value="">Bitte wählen</option>
                                        </select>
                                        <label>Test</label>
                                    </div>

                                    <div class="btn-group align-self-start pt-4 ps-2">
                                        <button type="button" class="btn btn-primary" data-action="search"><i class="fa-solid fa-search"></i></button>
                                        <button type="button" class="btn btn-primary" data-action="edit" data-validate="single"><i class="fa-solid fa-edit"></i></button>
                                        <button type="button" class="btn btn-primary" data-action="add"><i class="fa-solid fa-add"></i></button>
                                    </div>
                                </div>

                                <br>

                                <button class="btn btn-primary">Senden</button>

                            </form>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {

        var form = new Form('#test');

        form.load('load', 'quickselect-beispiel-2-handle');


        var form = new Form('#test-2');
        form.initValidation();

    });
</script>

</html>