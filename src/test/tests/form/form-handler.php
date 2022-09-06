<?php include('01_init.php');

// Gibt es auf jeder Seite
$_page = [
    'title' => "Form Handler",
];

?>
<!doctype html>

<!-- Head -->

<head>
    <?php include('02_header.php'); ?>
</head>


<!-- Body -->

<body>
    <?php include('03_navigation.php'); ?>
    <?php include('form-handler-testform.php'); ?>



    <div class="wrapper">
        <div class="container-fluid">
            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fas fa-exchange-alt'></i> Form Handler</h4>

                    <h6 class='subtext'>
                        Bei dem Form-Handler handelt es sich um eine eigene Klasse, mit deren Hilfe die Steuerung von Forms erleichtert wird.

                    </h6>

                    <p>Der Form Handler übernimmt alle wesentlichen Funktionen beim Bearbeiten von Forms. Er soll dabei helfen, dass das bearbeiten einer Form mit wenigen Klicks funktioniert.</p>

                    <ul>
                        <li><a href="form-handler-guide">Step-by-Step Anleitung</a></li>
                        <li><a href="form-handler-doku">Dokumentation</a></li>
                        <li><a href="form-creator">Form Creator</a></li>
                        <li><a href="form-sample-1">Beispiel: Subform</a></li>
                        <li><a href="form-sample-3">Beispiel: Auto Validation</a></li>
                        <li><a href="form-sample-4">Beispiel: Dynamische Form</a></li>
                        <li><a href="form-sample-5">Beispiel: Auto Complete</a></li>
                        <!--<li><a href="form-sample-2">Beispiel: Activation Cards</a></li>-->
                    </ul>

                    Für den Test kann man zwischen Prefilled und nicht Prefilled unterscheiden. Dies dient zum Testen von diversen Funktionen. <br>
                    Standardmäßig ist Prefilled aktiviert. Gesteuert wird das ganze über eine $_GET Variable <code>no-prefill</code>

                    <?php

                    $prefilled = (isset($_GET['no-prefill']) && $_GET['no-prefill'] == 'true') ? false : true;

                    ?>




                    <div class="mt-3 mb-3">
                        <a class="btn btn-success" href="form-handler.php">Aktivieren</a>
                        <a class="btn btn-danger" href="form-handler.php?no-prefill=true">Deaktivieren</a>
                    </div>
                    <strong>Status: <?php echo ($prefilled) ? '<span class="text-primary"><i class="fa-solid fa-check"></i> Aktiviert</span>' : '<span class="text-danger"><i class="fa-solid fa-times"></i> Deaktiviert</span>'; ?></strong>


                    <div class="row mt-3">
                        <div class="col">

                            <p>Man kann außerdem unterscheiden, welche Meldung man zurückhaben will. Die Checkbox beeinflusst das Beispiel-Backend Skript</p>

                            <div class="form-group">
                                <label class="form-label">Rückmeldung des Dummy Skripts</label><br>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input" type="radio" id="cb-6-1" name="example-error" value="1" checked>
                                    <label class="form-check-label" for="cb-6-1">Sende Success</label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input" type="radio" id="cb-6-2" name="example-error" value="2">
                                    <label class="form-check-label" for="cb-6-2">Sende Fehler</label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input" type="radio" id="cb-6-3" name="example-error" value="3">
                                    <label class="form-check-label" for="cb-6-3">Sende Exception</label>
                                </div>
                            </div>

                        </div>
                    </div>



                </div>
            </div>

            <div class='card'>
                <div class='card-body'>

                    <h4>Beispiel ohne FormValidation</h4>
                    <h6 class='subtext'>In diesem Beispiel wird kein FormValidation benutzt</h6>

                    <form autocomplete="off" id="example-1">

                        <?php echo getExampleForm("1", $prefilled); ?>

                        <div class="mt-3">


                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-secondary example-set mb-2" data-one="false" data-two="false" data-bs-toggle="tooltip" data-bs-placement="top" title="initData = false; noRevalidation = false">Set (f,f)</button>
                                    <button type="button" class="btn btn-secondary example-set mb-2" data-one="false" data-two="true" data-bs-toggle="tooltip" data-bs-placement="top" title="initData = false; noRevalidation = true">Set (f,t)</button>
                                    <button type="button" class="btn btn-secondary example-set mb-2" data-one="true" data-two="false" data-bs-toggle="tooltip" data-bs-placement="top" title="initData = true; noRevalidation = false">Set (t,f)</button>
                                    <button type="button" class="btn btn-secondary example-set mb-2" data-one="true" data-two="true" data-bs-toggle="tooltip" data-bs-placement="top" title="initData = true; noRevalidation = true">Set (t,t)</button>
                                    <button id="example-get" type="button" class="btn btn-secondary mb-2">Auslesen</button>
                                    <button id="example-load" type="button" class="btn btn-secondary mb-2">Load (Ajax)</button>
                                    <button id="example-init-fv" type="button" class="btn btn-secondary mb-2">FormValidation aktivieren</button>
                                    <button id="example-set-read-only" type="button" class="btn btn-secondary mb-2">Readonly setzen</button>
                                    <button id="example-unset-read-only" type="button" class="btn btn-secondary mb-2">Readonly entfernen</button>
                                    <button type="button" class="btn btn-secondary btn-form-save mb-2">Alternativer Submit (.btn-form-save)</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button data-reset="0" type="button" class="example-reset btn btn-danger mb-2">Reset to Data</button>
                                    <button data-reset="1" type="button" class="example-reset btn btn-danger mb-2">Reset to Clear</button>
                                    <button data-reset="2" type="button" class="example-reset btn btn-danger mb-2">Reset only FV</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <!---
    ################## CARD
-->
            <div class='card'>
                <div class='card-body'>

                    <div class="actions">
                        <a class="action-item" id="example2-load" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Laden"><i class="fa-solid fa-download"></i></a>
                        <a class="action-item" id="example2-validation" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Validierung aktivieren"><i class="fa-solid fa-exclamation-triangle"></i></a>
                        <a class="action-item" id="example2-einsetzen" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Einsetzen"><i class="fa-solid fa-sign-in-alt"></i></a>
                        <a class="action-item" id="example2-auslesen" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Auslesen"><i class="fa-solid fa-sign-out-alt"></i></a>
                    </div>

                    <h4>Beispiel in einer Card</h4>
                    <h6 class='subtext'>In diesem Beispiel wird die Klasse CardForm benutzt</h6>
                    <form autocomplete="off" id="example-2">
                        <?php echo getExampleForm("2", $prefilled); ?>
                    </form>



                </div>
            </div>

            <div class='card'>
                <div class='card-body'>

                    <h4>Beispiel in einem Modal</h4>
                    <h6 class='subtext'>In diesem Beispiel wird die Klasse ModalForm benutzt</h6>


                    <div class="row">
                        <div class="col-md-6">
                            Das Mockup für das Modal muss händisch erstellt werden. <br>
                            Hintergrund ist, dass sonst die Klasse die ganzen Anpassungen (Titel, Icon, Buttons, Größe des Modals, etc.) alle mit übernehmen müsste.
                            <br>
                            <br>
                            Bei dem Modal greifen ein paar Bootstrap-Themen:
                            <ul>
                                <li>In der <code>.modal</code> Klasse kann man die Animation hinterlegen</li>
                                <li>In der <code>.modal-dialog</code> Klasse kann man die Größe des Modals hinterlegen.</li>
                                <li>Man kann den Modal Title hinterlegen</li>
                            </ul>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-html ctc">
<div class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa-solid fa-icon"></i> Titel</h5>
                <div class="actions"></div>
            </div>
            <div class="modal-body">
                <form id="form-xxx">
                    <!-- Form Content -->
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div></code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary" id="example-modal-1"><i class="fa-solid fa-external-link-alt"></i> Modal ohne FV</button>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-javascript ctc">// Form ohne FormValidation
var form = new ModalForm('#modal-example-3', true);

// open Form
$('#btn-example').on('click', function() {
    form.open();
});</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary" id="example-modal-2"><i class="fa-solid fa-external-link-alt"></i> Modal mit FV</button>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-javascript ctc">// Form mit FormValidation
var form = new ModalForm('#modal-example-4', true);

// Init FormValidation
form.initValidation();

// Open Form
$('#btn-example').on('click', function() {
    form.open();
});</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary mb-3" id="example-modal-3"><i class="fa-solid fa-circle-notch"></i> <i class="fa-solid fa-external-link-alt"></i> Load and Open</button><br>
                            <button class="btn btn-primary mb-3" id="example-modal-4"><i class="fa-solid fa-circle-notch"></i> Load</button><br>
                            <button class="btn btn-primary mb-3" id="example-modal-5"><i class="fa-solid fa-external-link-alt"></i> Open</button>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-javascript ctc">// Form mit Load and Open
var form = new ModalForm('#modal-example', true);

// Init FormValidation
form.initValidation();

// Beim Klick Laden und Öffnen
$('#btn-example').on('click', function() {
    form.loadAndOpen('get','example-handle.php',5000);
});</code></pre>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa-solid fa-cat"></i> I bims 1 Katze</h5>
                    <div class="actions"></div>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" id="modal-example-3"><?php echo getExampleForm("3", $prefilled); ?></form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa-solid fa-cat"></i> I bims noch 1 Katze</h5>
                    <div class="actions"></div>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" id="modal-example-4"><?php echo getExampleForm("4", $prefilled); ?></form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa-solid fa-cat"></i> I bims noch 1 Katze</h5>
                    <div class="actions"></div>
                </div>
                <div class="modal-body">
                    <form id="modal-example-5"><?php echo getExampleForm("5", $prefilled); ?></form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>




</body>

<?php include('04_scripts.php'); ?>

<script>
    var obj = {

        getDef(form, result) {

            // Rückgabe
            result['color'] = form.container.find('.additional-data').css("background-color");

            return result;
        },

        setDef(form, data) {
            if (data) {
                form.container.find('.additional-data').css("background-color", data.color);
            } else {
                form.container.find('.additional-data').css("background-color", '#000000');
            }
        },

        startColorListner(form) {

            var me = this;

            form.container.on('click', '.additional-data', function() {

                if (!form.isReadonly) {
                    $(this).css('background-color', me.getRandomColor());
                }
            });
        },

        getRandomColor() {
            var colorR = Math.floor((Math.random() * 256));
            var colorG = Math.floor((Math.random() * 256));
            var colorB = Math.floor((Math.random() * 256));
            return "rgb(" + colorR + "," + colorG + "," + colorB + ")";
        },


        card: function() {

            var me = this;

            // New Form
            var form = new CardForm('#example-2', {
                // debug: false
            });



            form.getAdditionalData = function(result) {
                return me.getDef(this, result);
            }

            form.setAdditionalData = function(data) {
                me.setDef(this, data);
            }

            form.renewInitFormData();

            form.on('submit', function(e) {

                var data = $('input[name=example-error]:checked').val();

                // Save Data
                form.save('save', 'form-handle-test-backend.php', null, null, {
                    example: data
                });
            });


            form.container.on('click', '#example2-load', function() {
                var someId = 5000;
                form.load('load', 'form-handle-test-backend.php', someId);
            });

            form.container.on('click', '#example2-validation', function() {
                form.initValidation();
            });

            form.container.on('click', '#example2-einsetzen', function() {
                form.setData(obj.exampleData);
            });

            form.container.on('click', '#example2-auslesen', function() {
                var data = form.getData();
                console.log(data);
            });

            // Farbe
            me.startColorListner(form);
        },

        modal: function() {

            var me = this;

            // New Form
            var form = new ModalForm('#modal-example-3', {
                // debug: true
            });

            form.getAdditionalData = function(result) {
                return me.getDef(this, result);
            }

            form.setAdditionalData = function(data) {
                me.setDef(this, data);
            }

            form.renewInitFormData();

            // open Form
            $('#example-modal-1').on('click', function() {
                form.open();
            });

            form.on('submit', function(e) {
                var data = $('input[name=example-error]:checked').val();

                // Save Data
                form.save('save', 'form-handle-test-backend.php', null, null, {
                    example: data
                });
            });


            // New Form
            var form2 = new ModalForm('#modal-example-4');

            form2.getAdditionalData = function(result) {
                return me.getDef(this, result);
            }

            form2.setAdditionalData = function(data) {
                me.setDef(this, data);
            }

            form.renewInitFormData();

            // Init FormValidation
            form2.initValidation();

            // Open Form
            $('#example-modal-2').on('click', function() {

                form2.open();
            });

            form2.on('submit', function(e) {
                var data = $('input[name=example-error]:checked').val();

                // Save Data
                form2.save('save', 'form-handle-test-backend.php', null, null, {
                    example: data
                });
            });

            // MODAL 3
            // *************************

            // New Form
            var form3 = new ModalForm('#modal-example-5');

            form3.getAdditionalData = function(result) {
                return me.getDef(this, result);
            }

            form3.setAdditionalData = function(data) {
                me.setDef(this, data);
            }

            form3.renewInitFormData();

            // Init FormValidation
            form3.initValidation();

            // Open Form
            $('#example-modal-3').on('click', function() {
                form3.loadAndOpen('load', 'form-handle-test-backend.php', 5000);
            });

            // Open Form
            $('#example-modal-4').on('click', function() {
                form3.load('load', 'form-handle-test-backend.php', 5000);
            });

            // Open Form
            $('#example-modal-5').on('click', function() {
                form3.open();
            });

            form3.on('submit', function(e) {

                var data = $('input[name=example-error]:checked').val();

                // Save Data
                form3.save('save', 'form-handle-test-backend.php', null, null, {
                    example: data
                });
            });

            // Farbe
            me.startColorListner(form);
            me.startColorListner(form2);
            me.startColorListner(form3);
        },

        standard: function() {

            // New Form
            var form = new Form('#example-1');

            var me = this;

            form.getAdditionalData = function(result) {
                return me.getDef(this, result);
            }

            form.setAdditionalData = function(data) {
                me.setDef(this, data);
            }

            form.renewInitFormData();


            // Events
            form.on('submit', function(e) {

                console.log('EVENT: submit');

                var data = $('input[name=example-error]:checked').val();

                // Save Data
                form.save('save', 'form-handle-test-backend.php', null, null, {
                    example: data
                });
            });

            /**
             * Aktionen (Buttons)
             */


            // Set
            $('.example-set').on('click', function() {

                // Attribute 1 und 2
                var attr1 = $(this).data('one');
                var attr2 = $(this).data('two');

                console.log(attr1, attr2);

                // Setze die Daten
                form.setData(obj.exampleData, attr1, attr2);
            });

            // Get
            $('#example-get').on('click', function() {
                var data = form.getData();
                console.log(data);
            });

            // Load
            $('#example-load').on('click', function() {
                var someId = 5000;
                form.load('load', 'form-handle-test-backend.php', someId);
            });

            // Init FormValidation
            $('#example-init-fv').on('click', function() {
                form.initValidation();
            });

            // Setze Read Only
            $('#example-set-read-only').on('click', function() {
                form.setReadonly(true);
            });

            // Hebe Read Only auf
            $('#example-unset-read-only').on('click', function() {
                form.setReadonly(false);
            });

            // Reset Buttons
            $('.example-reset').on('click', function() {
                var mode = $(this).data('reset');
                form.reset(mode);
            });










            /**
             * Events Loggen
             */

            // Valid 
            form.on('valid', function(e) {
                console.log('EVENT: valid');
            });

            // Invalid
            form.on('invalid', function(e) {
                console.log('EVENT: invalid');
            });

            // Save
            form.on('saving', function(e) {
                console.log('EVENT: saving');
            });

            form.on('saved', function(e) {
                console.log('EVENT: saved');
            });

            form.on('readonly', function(e, mode) {
                console.log('EVENT: reset - Mode >' + mode + '<');
            });

            form.on('reset', function(e, mode) {
                console.log('EVENT: reset - Mode >' + mode + '<');
            });




            // Init ?? 
            $('#1-custom-div .test-readonly-1').hide();

            // Farbe
            me.startColorListner(form);

        },

        // Beispiel Daten
        exampleData: {

            // Static
            stext: 'Hans',
            semail: 'hans.wurst@web.de',
            spassword: 'OMFG#sosecret',
            sdate: '1991-02-13',
            stime: '11:56',
            sselect: 1,
            sselectmulti: [3, {
                value: 6,
                text: 'Wert 6'
            }, 7],
            stextarea: 'I walked across an empty land.\nI knew the pathway like the back of my hand.\nI felt the earth beneath my feet.\nSat by the river and it made me complete',

            // Floating
            ftext: 'Bernd',
            femail: 'bernd.brot@hotmail.de',
            fpassword: 'TomRiddle1337',
            fdate: '2021-05-04',
            ftime: '10:07',
            fselect: {
                value: 3,
                text: "Wert 3"
            },
            fselectmulti: false,
            ftextarea: 'Oh simple thing, where have you gone?\nI\'m getting old and I need something to rely on\nSo tell me when\nyou\'re gonna let me in\nI\'m getting tired and I need somewhere to begin',

            // Checkboxen
            cbeinfach: true,
            cbradioinline: "option2",
            cbradioline: 2,
            cbswitch: true,
            'cbmehrfach[]': [1, {
                value: 2,
                text: "Wert 2"
            }],
            'cbmehrfachinline[]': false,

            // Button Radio / Checkbox
            checkedbutton1: true,
            checkedbutton2: false,
            checkedbutton3: true,

            radiobutton: 1,

            // Range
            range: 87,

            // Select2 
            select21: {
                value: 2,
                text: 'Wert 2'
            },
            select22: 2,
            select2multi: [2, 3],

            quickselect: [{
                value: "EG",
                text: "Ägypten"
            },{
                value: "MX",
                text: "Mexiko"
            }],

            quickselect2: {
                value: "1",
                text: "Tobias Pitzer"
            },

            summernote: "Ein anderer Text",

            betrag: 100.20,
            meter: 120,

            // 
            color: 'rgb(255,255,0)'
        }
    }




    // Event Ready Event
    $(document).on("app:ready", function() {

        // Summernote muss vorher ausgeführt werden
        $('.summernote').summernote({
            lang: 'de-DE',
            toolbar: []
        });



        obj.standard();
        obj.card();
        obj.modal();

    });
</script>



</html>