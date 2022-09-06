<?php include('01_init.php');

$_page = [
    'title' => "<i class=\"fas fa-calendar-check\"></i> Activation Card",
    'breadcrumbs' => ['<a href="activation"><i class="fa-solid fa-toggle-on"></i> Activation</a>']
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
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4><i class="fa-regular fa-id-card"></i> Aktivierbare Karte</h4>
                            <h6 class="subtext">Hier wird eine Klasse zur Verfügung gestellt, die das De/Aktivieren von Karten zulässt. Dabei wird der Inhalt ein- oder ausgeblendet.</h6>






                            <table class="table">
                                <tr>
                                    <th class="col-3">HTML Klassen</th>
                                    <th class="col-9">Erklärung</th>
                                </tr>
                                <tr>
                                    <td><code>.card-activate-switch</code><br>oder <code>.ca-activate-button</code></td>
                                    <td>Diese Klasse muss der Input Switch erhalten. Hier Funktionieren beide Klassen noch, obwohl die neuere Klasse genommen werden sollte!
                                        Die alte Klasse wirft eine Deprecated Meldung.
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>.card-body-checked</code></td>
                                    <td>Diese Klasse wird bei aktiver Checkbox <strong class="text-success">ein-</strong> und bei deaktivierter Checkbox <strong class="text-danger">ausgeblendet</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>.card-body-unchecked</code></td>
                                    <td>Diese Klasse wird bei aktiver Checkbox <strong class="text-danger">aus-</strong> und bei deaktivierter Checkbox <strong class="text-success">eingeblendet</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>.card-input-checked</code></td>
                                    <td>
                                        Diese Klasse ist für alle Form-Felder, deren Validierung bei der aktiver Checkbox <strong class="text-success">ein-</strong> und bei deaktiviert Checkbox <strong class="text-danger">ausgeschaltet</strong> werden soll.<br>
                                        Mit dem Parameter <code>data-mode="1"</code> kann hier auch eine Löschung des Inhalts erfolgen.<br>
                                        Siehe auch Methode <code>addForm</code>.
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>.card-input-unchecked</code></td>
                                    <td>
                                        Diese Klasse ist für alle Form-Felder, deren Validierung bei der aktiver Checkbox <strong class="text-danger">aus-</strong> und bei deaktiviert Checkbox <strong class="text-success">eingeschaltet</strong> werden soll.<br>
                                        Mit dem Parameter <code>data-mode="1"</code> kann hier auch eine Löschung des Inhalts erfolgen.<br>
                                        Siehe auch Methode <code>addForm</code>.
                                    </td>
                                </tr>
                            </table>




                            <table class="table">
                                <tr>
                                    <th class="col-3">Methoden</th>
                                    <th class="col-9">Erklärung</th>
                                </tr>
                                <tr>
                                    <td><code>constructor(el, checkCondition)</code></td>
                                    <td>Es wird das <strong>Element z.B. $('#id)...</strong> mitgegeben auf das gegriffen werden soll mit einer Callback Funktion <strong>checkCondition</strong> als zweiter Parameter</td>
                                </tr>
                                <tr>
                                    <td><code>callback checkCondition</code></td>
                                    <td> Der Callback funktioniert für synchrone und asynchrone Funktionen. Der <strong>status</strong> ist an dem Switch selbst gehängt und in dem Callback können dann Funktionen selbst definiert werden, für Modal, SweetAlert, Checkboxen etc.
                                        <br> Im folgenden sehen Sie drei Beipiele dargestellt wie der Klassenaufruf aufgebaut werden kann:
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>addForm(form, fields)</code></td>
                                    <td>
                                        Damit kann eine Activation Card mit einer Form verknüpft werden. Die Feld-Paramert sind dabei Optional. Wenn Feld-Parameter angegeben werden, 
                                        müssen diese eine der beiden Klasse <code>.card-input-checked</code> oder <code>.card-input-unchecked</code>.<br>
                                        Mit dem Verknüpfen der Form, steuern die Events der Form automatisch die Karte mit.
                                    </td>
                                </tr>
                            </table>

                            <br>


                            <hr>

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="card" id="example-1">
                                        <div class="card-body">
                                            <h4>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input card-activate-switch" type="checkbox" id="example-cb-1">
                                                    <label class="form-check-label" for="example-cb-1">Activation Card</label>
                                                </div>
                                            </h4>
                                            <h6 class="subtext">In der Standard-Funktion wird nur ein- und ausgeblendet</h6>

                                            <div class="card-body-checked">
                                                <i class="fa-solid fa-check text-success"></i> Ich werde nur einblendet wenn die Checkbox angehakt ist
                                            </div>

                                            <div class="card-body-unchecked">
                                                <i class="fa-solid fa-times text-danger"></i> Ich werde nur einblendet wenn die Checkbox nicht angehakt ist
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-html ctc">
<div class="card" id="example">
    <div class="card-body">
        <h4>
            <div class="form-check form-switch">
                <input class="form-check-input card-activate-switch" type="checkbox" id="example-cb-1">
                <label class="form-check-label" for="example-cb-1">Standard Karte</label>
            </div>
        </h4>
        <h6 class="subtext">Das ist die Unterschrift der Standard-Karte</h6>

        <div class="card-body-checked">
            Ich werde nur einblendet wenn die Checkbox angehakt ist
        </div>

        <div class="card-body-unchecked">
            Ich werde nur einblendet wenn die Checkbox nicht angehakt ist
        </div>
    </div>
</div>
</code></pre>
                                    <pre><code class="language-js ctc">// Einfaches Beispiel
new ActivationCard('#example');</code></pre>


                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-md-6">


                                    <form id="example-form-2">

                                        <h3>Form</h3>
                                        <p>
                                            In diesem Szenario ist die Card teil einer Form. Man kann beide miteinander verknüpfen.
                                            Alle wichtigen Dinge wie Readonly setzen, etc. passieren dann automatisch.
                                        </p>

                                        <div class="form-group form-floating mb-3">
                                            <input type="text" name="example-1" class="form-control editable" placeholder="Input 1" autocomplete="off">
                                            <label>Input 1</label>
                                        </div>

                                        <div class="card" id="example-2">
                                            <div class="card-body">
                                                <h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input card-activate-switch editable" name="checkbox" type="checkbox" id="example-cb-2">
                                                        <label class="form-check-label" for="example-cb-2">Activation Card mit Form</label>
                                                    </div>
                                                </h6>

                                                <div class="row">
                                                    <div class="col-4">

                                                        <div class="form-group form-floating">
                                                            <input type="text" name="both" class="form-control editable" placeholder="Both" value="" autocomplete="off" required>
                                                            <label>Both</label>
                                                        </div>

                                                    </div>
                                                    <div class="col-4">
                                                        <div class="card-body-checked">
                                                            <div class="form-group form-floating">
                                                                <input type="text" name="checked" class="form-control card-input-checked editable" placeholder="Checked" data-mode="1" value="" autocomplete="off" required>
                                                                <label>Checked</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="card-body-unchecked">
                                                            <div class="form-group form-floating">
                                                                <input type="text" name="unchecked" class="form-control card-input-unchecked editable" placeholder="Unchecked" data-mode="1" value="" autocomplete="off" required>
                                                                <label>Unchecked</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <br>

                                        <button class="btn btn-primary btn-form-example-1 mb-2">Senden</button>
                                        <button type="button" class="btn btn-danger btn-form-example-2 mb-2">Reset</button>
                                        <button type="button" class="btn btn-secondary btn-form-example-3 mb-2">Set Readonly</button>
                                        <button type="button" class="btn btn-secondary btn-form-example-4 mb-2">Unset Readonly</button>
                                        <button type="button" class="btn btn-secondary btn-form-example-5 mb-2">Set Checked</button>
                                        <button type="button" class="btn btn-secondary btn-form-example-6 mb-2">Set Unchecked</button>

                                    </form>

                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Form erstellen
var form = new Form('#form');                                        
                                    
// Einfaches Beispiel
var card = new ActivationCard('#example');

// Felder in der Card
var fields = ['input-1','input-2','input-3'];

// Form verknüpfen
card.addForm(form, fields);
</code></pre>
                                    <p>
                                        Die Felder, die über den zweiten Parameter mitgegeben werden können folgende Eigenschaften haben:
                                    </p>
                                    <pre><code class="language-html ctc"><!-- Data Mode 
.card-input-checked = Bei aktivierter Checkbox
.card-input-unchecked = Bei nicht aktivierter Checkbox

-->
<input type="text" name="beispiel" class="card-input-checked">

<!-- Data Mode
    0 = De/Aktiviert falls FormValidation vorhanden ist
    1 = clear = Löscht zusätzlich das Feld 
-->
<input type="text" name="beispiel" data-mode="0">
</code></pre>


                                </div>
                            </div>
                            <hr>



                            <!-- -------------------------------------------------------- -->
                            <!-- Modal & Aktivierbare Card zum Modal -->
                            <!-- -------------------------------------------------------- -->
                            <div class="modal" id="aktivCardModal" tabindex="-1" style="margin-top: 25%;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Modal body text goes here.</p>
                                        </div>
                                        <div class="modal-footer"> </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class='card' id="activCardModal">
                                        <div class='card-body'>
                                            <h4>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input card-activate-switch" type="checkbox" id="flexSwitchCheckDefault">
                                                    <label class="form-check-label" for="flexSwitchCheckDefault">Modal</label>
                                                </div>
                                            </h4>
                                            <h6 class='subtext'>Hier bei handelt es sich um eine aktivierbare Modal Karte</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <pre><code class="hljs language-js ctc">// Aktivierbare Karte Modal
var modal = new ModalForm('#activCardModal');

var testCard = new ActivationCard('#testCardAct', function(status, callback) {

    if(status) {
        // Öffne Modal
        modal.open();

        modal.on('submit', function() {
            testCard.activate();
            modal.close();
        });
    }
    callback(false);
});
                                    </code></pre>
                                </div>
                            </div>

                            <hr>

                            <!-- -------------------------------------------------------- -->
                            <!-- Aktivierbare Cards für Sweet Alert -->
                            <!-- -------------------------------------------------------- -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class='card' id="activCArdSweetAlert">
                                        <div class='card-body'>
                                            <h4>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input card-activate-switch" type="checkbox" id="flexSwitchSweetAlert">
                                                    <label class="form-check-label" for="flexSwitchSweetAlert">Sweet Alert</label>
                                                </div>
                                            </h4>
                                            <h6 class='subtext'>Hier bei handelt es sich um eine aktivierbare Sweet Alert Karte</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="hljs language-js ctc">// Aktivierbare Karte Sweet Alert
var activCArdSweetAlert = new ActivationCard('#activCArdSweetAlert', function(status, callback) {

    if(status) {
        // Öffne SweetAlert
        app.alert.question.fire('Wollen Sie wirklich Aktivieren?').then(function(result) {
            if(result.isConfirmed){
                activCArdSweetAlert.activate();
            }
        });
    }
    callback(false);
});
                                    </code></pre>
                                </div>
                            </div>


                            <hr>

                            <!-- -------------------------------------------------------- -->
                            <!-- Aktivierbare Cards für Checkboxen-->
                            <!-- -------------------------------------------------------- -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class='card' id="activCardChechbox">
                                        <div class='card-body'>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="zeiterfassung-aktiv">
                                                <label class="form-check-label" for="zeiterfassung-aktiv">Zeiterfassung aktiv</label>
                                            </div>
                                            <h4>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input card-activate-switch" type="checkbox" id="flexSwitchCheckox">
                                                    <label class="form-check-label" for="flexSwitchCheckox">Checkbox</label>
                                                </div>
                                            </h4>
                                            <h6 class='subtext'>Hier bei handelt es sich um eine aktivierbare Checkbox Karte</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="hljs language-js ctc">// Aktivierbare Karte Checkbox
var activCardChechbox = new ActivationCard('#activCardChechbox', function(status, callback) {

    // das gleiche in kurzer Form
    callback(status && $('#zeiterfassung-aktiv').prop('checked'));
    
});
                                    </code></pre>
                                </div>
                            </div>

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

        // Beispiel 1
        // ----------
        var ex1 = new ActivationCard('#example-1');


        // Beispiel 2
        // ----------

        var ex2 = new ActivationCard('#example-2');
        var form = new Form('#example-form-2');

        // Form Validation aktivieren
        form.initValidation();

        // Form hinzufügen
        ex2.addForm(form, ['checked', 'unchecked']);

        form.on('submit', function() {
            var data = form.getData();
            console.log('Form Submit');
            console.log(data);
            app.notify.success.fire("Erfolgreich", "Die Form konnte erfolgreich abgeschickt werden!");
        });

        form.on('invalid', function() {
            app.notify.error.fire("Fehler", "Mindestens ein Feld konnte noch nicht vollständig validiert werden!");
        });

        $('.btn-form-example-2').on('click', function() {
            form.reset();
        });

        $('.btn-form-example-3').on('click', function() {
            form.setReadonly(true);
        });

        $('.btn-form-example-4').on('click', function() {
            form.setReadonly(false);
        });

        $('.btn-form-example-5').on('click', function() {
            form.setData({
                'both': '1 Both',
                'checkbox': true,
                'checked': '1 Checked',
                'unchecked': false,
                'example-1': '1 Etwas außerhalb'
            });
        });

        $('.btn-form-example-6').on('click', function() {
            form.setData({
                'both': '2 Both',
                'checkbox': false,
                'checked': false,
                'unchecked': '2 Unchecked',
                'example-1': '2 Etwas außerhalb'
            });
        });

        // Beispiel 3
        // ----------

        var activCardChechbox = new ActivationCard('#activCardChechbox', function(status, callback) {

            // das gleiche in kurzer Form
            callback(status && $('#zeiterfassung-aktiv').prop('checked'));

        });







        // Aktivierbare Karte Modal
        var modal = new ModalForm('#aktivCardModal');

        var aktivCardModal = new ActivationCard('#activCardModal', function(status, callback) {
            if (status) {
                // Öffne Modal
                modal.open();

                modal.on('submit', function() {
                    aktivCardModal.activate();
                    modal.close();
                });
            }

            callback(false);
        });

        // Aktivierbare Karte Sweet Alert
        var activCArdSweetAlert = new ActivationCard('#activCArdSweetAlert', function(status, callback) {

            if (status) {
                // Öffne SweetAlert
                app.alert.question.fire('Wollen Sie wirklich Aktivieren?').then(function(result) {
                    if (result.isConfirmed) {
                        activCArdSweetAlert.activate();
                    }
                });
            }
            callback(false);
        });


        // Aktivierbare Karte Checkbox
        var activCardChechbox = new ActivationCard('#activCardChechbox', function(status, callback) {

            // das gleiche in kurzer Form
            callback(status && $('#zeiterfassung-aktiv').prop('checked'));

            // callback((status && $('#zeiterfassung-aktiv').prop('checked')) ? true : false);



            // dann ist die Checkbox deaktiviert und soll mit dem Klick aktiviert werden
            if (status) {

                // Wenn die Checkbox geklickt ist darf die Nächste geklickt werden
                var cbZeiterfassung = $('#zeiterfassung-aktiv').prop('checked');

                if (cbZeiterfassung) {
                    callback(true);
                } else {
                    callback(false);
                }


                // dann ist die checkbox aktiviert und soll mit einem Klick deaktiviert werden
            } else {
                callback(false);
            }





        });


    });
</script>

</html>