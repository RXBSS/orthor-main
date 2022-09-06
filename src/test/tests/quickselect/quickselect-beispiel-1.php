<?php include('01_init.php');

$_page = [
    'title' => "Quickselect Beispiel 1"
];

?>
<!doctype html>

<head>
    <?php include('02_header.php'); ?>

    <style>

        
    </style>


</head>

<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="container-fluid">


            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fas fa-cat"></i> Form</h4>
                            <h6 class="subtext">Eine Beispiel Form</h6>

                            <form id="test-form">

                                <div class="form-group form-floating">
                                    <input type="text" name="field" class="form-control editable" placeholder="Field" autocomplete="nope">
                                    <label>Field</label>
                                </div>

                                <!-- Der Container -->
                                <div class="qs-buttons d-flex justify-content-between">

                                    <!-- Quickselect -->
                                    <div class="form-group form-floating form-select2-multi-column flex-grow-1">
                                        <select class="form-select init-quickselect editable" name="laender" placeholder="Land" multiple>
                                            <option value="">Bitte wählen</option>
                                        </select>
                                        <label>Land</label>
                                    </div>


                                    <!-- Button Gruppe -->
                                    <div class="btn-group align-self-start pt-4 ps-2">
                                        
                                        <!-- Add Button ohne Validierung -->
                                        <button type="button" class="btn btn-secondary" data-action="add"><i class="fa-solid fa-add"></i></button>
                                        
                                        <!-- Edit Button, es darf nur ein Wert ausgewählt sein! -->
                                        <button type="button" class="btn btn-secondary" data-action="edit" data-validate="single"><i class="fa-solid fa-edit"></i></button>
                                        
                                        <!-- Delte Button, es muss mindestens ein Wert ausgefüllt sein-->
                                        <button type="button" class="btn btn-danger" data-action="remove" data-validate="filled"><i class="fa-solid fa-trash"></i></button>
                                    </div>

                                </div>


                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <!-- MODAL -->
    <div class="modal" id="modal-laender" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

    	        <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" ><i class="fas fa-flag"></i> <span id="modal-title"></span></h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body pt-0">
                    <form id="modal-form">
                        <div class="row">

                            <!-- Hidden Input Field für den Subtask -->
                            <input type="hidden" name="subtask" value="">

                            <!-- Beschreibung zur Vereinfachnug zum Einpflegen von neuen Daten -->
                            <em>Freie Ländercodes: tp, ta, tb und fast alles was ein q hat </em>

                            <!-- Die Input Felder -->
                            <div class="col-md-12">
                                <div class="form-group form-floating">
                                    <input type="text" name="code" class="form-control editable" placeholder="Code" autocomplete="nope" required>
                                    <label>Code</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-floating">
                                    <input type="text" name="en" class="form-control editable" placeholder="Englische Bezeichnung" autocomplete="nope" required>
                                    <label>Englische Bezeichnung</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-floating">
                                    <input type="text" name="de" class="form-control editable" placeholder="Deutsche Bezeichnung" autocomplete="nope" required>
                                    <label>Deutsche Bezeichnung</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-floating">
                                    <input type="text" name="es" class="form-control editable" placeholder="Spanische Bezeichnung" autocomplete="nope" required>
                                    <label>Spanische Bezeichnung</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-floating">
                                    <input type="text" name="fr" class="form-control editable" placeholder="Französische Bezeichnung" autocomplete="nope" required>
                                    <label>Französische Bezeichnung</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-floating">
                                    <input type="text" name="it" class="form-control editable" placeholder="Italienische Bezeichnung" autocomplete="nope" required>
                                    <label>Italienische Bezeichnung</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-floating">
                                    <input type="text" name="ru" class="form-control editable" placeholder="Russische Bezeichnung" autocomplete="nope" required>
                                    <label>Russische Bezeichnung</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>



</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {

        var test = {

            init() {
                var me = this;
                me.initForm();
                me.initModalForm();
            },

            // 
            initForm() {

                var me = this;

                // Form initalisieren
                me.form = new CardForm('#test-form');

                // Valdierung aktivieren
                me.form.initValidation();

                // Auf die Quick Action Button Events reagieren
                me.form.qs['laender'].on('action', function(el, action, value) {

                    // Auf Action prüfen
                    switch (action) {
                        case "add":
                            me.new();
                            break;
                        case "edit":
                            me.edit(value);
                            break;
                        case "remove":
                            me.remove(value);
                            break;
                    }
                });

                // Form direkt nach dem Laden entsperren - für Demo Zwecke
                me.form.enable();

                // Submit Event der Form - Daten loggen. So kann man sehen, dass diese geändert wurden
                me.form.on('submit', function() {
                    var data = me.form.getData();
                    console.log(data);
                });
            
            },

            // Modal initalisieren
            initModalForm() {
                var me = this;

                // Initalisieren und Validierung aktivieren
                me.modalForm = new ModalForm('#modal-form');
                me.modalForm.initValidation();

                // Submit Event abfangen
                me.modalForm.on('submit', function() {

                    // Speichern (Ajax) triggern
                    me.modalForm.save("save","quickselect-beispiel-1-handle.php", function(response) {

                        // Setze die neu abgespeicherte Bezeichnung in das Quickselect ein!
                        me.form.qs['laender'].setData(response.data.code, response.data.de);

                        // Sorgt dafür, dass ein Notify ausgegeben wird
                        return true;
                    });
                });
            },

            // Neues Land erstellen
            new() {
                var me = this;

                // Titel des Modals ändern
                $('#modal-title').html('Land hinzufügen');

                // Form zurücksetzen
                me.modalForm.reset(1);

                // Code Readonly entfernen, da diese ja zum hinzufügen benötigt wird und manuell vergeben werden muss
                // -- Normalesweiße würde in PHP eine ID automatisch vergeben werden (Auto Increment) das ist bei den Ländern ja anders
                me.modalForm.setFieldReadonly('code', false);
               
                // Das Feld "Subtask" mit dem Wert "new" füllen, damit PHP weiß, dass jetzt ein neues Land angelegt werden muss
                me.modalForm.getField('subtask').val('new');

                // Modal öffnen
                me.modalForm.open();
            },

            // Ein bestehendes Land bearbeiten
            edit(id) {
                
                var me = this;

                // Titel des Modals anpassen
                $('#modal-title').html('Land bearbeiten');

                // Das Feld "Subtask" mit dem Wert "edit" füllen, damit PHP weiß, dass jetzt ein bestehendes Land bearbeitet werden muss
                me.modalForm.getField('subtask').val('edit');

                // Die Daten des Wertes, der aktuell ausgelesen ist laden und das Modal öffnen
                me.modalForm.loadAndOpen("load","quickselect-beispiel-1-handle.php", id, function() {

                    // Das Feld Code auf Readonly setzen
                    me.modalForm.setFieldReadonly('code', true);
                });
            },

            // Remove
            remove(id) {

                var me = this;

                // Nachfrage ob wirklich gelöscht werden soll
                app.alert.delete.fire().then((result) => {

                    // Wenn diese bestätigt wurde
                    if(result.isConfirmed) {

                        // Simple Request
                        app.simpleRequest("remove","quickselect-beispiel-1-handle.php", id, function(response) {
               
                            // Reset Quickselect
                            me.form.qs['laender'].reset();
                            
                            // Ausgabe damit ein Alert kommt
                            return true;
                        });

                    }
                });

            }
        }


        test.init();

    });
</script>

</html>