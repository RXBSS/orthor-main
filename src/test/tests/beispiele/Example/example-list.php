<?php include('01_init.php');

$_page = [
    'title' => "Beispiel",
    'breadcrumbs' => ['<i class="fab fa-algolia"></i> Unterseite mit Icon', '<a href="example-list.php">Verlinkte Unterseite</a>']
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

            <!-- Pickliste -->
            <div id="example-pickliste"></div>

            <!-- Fab Button -->
            <div class="fab-container">
                <button class="btn btn-primary btn-example-neu"><i class="fa-solid fa-plus"></i></button>
            </div>

        </div>
    </div>

    <!-- Modal zum Bearbeiten -->
    <div class="modal" id="modal-example-neu" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa-solid fa-cat"></i> Meine Überschrift</h4>
                    <div class="actions"></div>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" name="name" class="form-control editable" placeholder="Name">
                        <label>Bezeichnung</label>
                    </div>
                    <div class="form-floating form-group">
                        <textarea class="form-control editable" name="ftextarea" placeholder="Beschreibung"></textarea>
                        <label>Beschreibung</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating form-group">
                                <select class="form-select editable" name="fselect" placeholder="Floating Select">
                                    <option value="">bitte wählen</option>
                                    <option value="1">Auswahl 1</option>
                                    <option value="2">Auswahl 2</option>
                                    <option value="3">Auswahl 3</option>
                                    <option value="3">Auswahl 4</option>
                                    <option value="3">Auswahl 5</option>
                                    <option value="3">Auswahl 6</option>
                                </select>
                                <label>Auswahl</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" name="zeitstempel" class="form-control editable" placeholder="Zeitstempel">
                                <label>Zeitstempel</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating form-group">
                        <select class="form-select editable" name="fselect" placeholder="Floating Select">
                            <option value="">bitte wählen</option>
                            <option value="1">Auswahl 1</option>
                            <option value="2">Auswahl 2</option>
                            <option value="3">Auswahl 3</option>
                            <option value="3">Auswahl 4</option>
                            <option value="3">Auswahl 5</option>
                            <option value="3">Auswahl 6</option>
                        </select>
                        <label>Auswahl</label>
                    </div>
                    
    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="betrag" class="form-control editable" placeholder="Betrag">
                                <label>Betrag</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="nachkomma" class="form-control editable" placeholder="Nachkomma">
                                <label>Nachkomma</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-floating-check">
                                <label class="form-label">Bewerten Sie</label><br>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-1" name="cbradioinline" value="option1">
                                    <label class="form-check-label" for="cb-1"><i class="fa-solid fa-thumbs-up text-primary"></i></label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-2" name="cbradioinline" value="option2">
                                    <label class="form-check-label" for="cb-2"><i class="fa-solid fa-thumbs-up text-danger"></i></label>
                                </div>
                            </div>
                        </div>                       
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {

        // Pickliste
        var list = new Picklist("#example-pickliste", "example", {
            type: 'multi-picklist',
            addHandleButtons: true
        });

        // Form für Neu
        var form = new ModalForm('#modal-example-neu');
        
        // Button für Neu
        $('body').on('click', '.btn-example-neu', function() {
            form.open();
        });

    });
</script>

</html>