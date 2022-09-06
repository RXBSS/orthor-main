<?php include('01_init.php');

$_page = [
    'title' => "Seach Value",
    'breadcrumbs' => ["<a href='pickliste'><i class=\"fas fa-list\"></i> Pickliste</a>"]
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
                    <h4 class="card-title"><i class="fa-solid fa-search"></i> Suchhilfe</h4>
                    <h6 class="subtext">Die Suchhilfe soll mit einer Tastenkombination stattfinden. Diese ist angelehnt an die Funktion von Success mit dem F5.</h6>


                    <hr>

                    <div class="row mb-3 mt-3">
                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-floating">
                                        <input type="text" name="beispiel-1" class="form-control editable" placeholder="Bezeichnung 1" autocomplete="off">
                                        <label>Beispiel 1</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Hier der Code</code></pre>
                        </div>
                    </div>



                    <hr>

                    <div class="row mb-3 mt-3">
                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-floating">
                                        <select class="form-select editable" name="beispiel-2" placeholder="Beispiel 2">
                                            <option value="">bitte wählen</option>
                                        </select>
                                        <label>Beispiel 2</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Hier der Code</code></pre>
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


        // Picklist Modal
        var picklist = new PicklistModal("example", {
            type: 'single-picklist',
            quickPick: true
        });

        // Mit Angabe des Selectors und anderem Default Wert
        var q = new Quickselect('user', {
            selector: 'select[name="beispiel-2"]',
            defaultText: 'Bitte Benutzer auswählen',
            defaultValue: '0',
            connectedSearch: picklist
        });





    });
</script>

</html>