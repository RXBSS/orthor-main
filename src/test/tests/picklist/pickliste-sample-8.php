<?php include('01_init.php');

if (isset($_POST['task'])) {

    $req = new Request();
    $req->success = true;
    $req->echoAnswer();

    die();
}



$_page = [
    'title' => "Readonly",
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
                    <h4 class="card-title"><i class="fa-solid fa-text-slash"></i> Readonly Pickliste</h4>
                    <h6 class="subtext">Hier ist beschrieben, wie man eine Select Pickliste Readonly machen kann</h6>


                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Beispiel Readonly setzen</h4>

                            <div id="pickliste-example-1" class="mb-3"></div>

                            <button id="example-1-set" class="btn btn-secondary">Setzen</button>
                            <button id="example-1-unset" class="btn btn-secondary">Entfernen</button>


                        </div>
                    </div>


                </div>
                <div class="col-md-6">
                    <pre><code class="language-js ctc">// Liste initalisieren
var list = new Picklist("#example", "example", {
    type: 'multi-picklist',
    
    // Handle Buttons reagieren automatisch
    addHandleButtons: true,

    // Bei zusätzlichen Buttons man es steuern
    addButtons: [{
        action: "something",
        icon: "fa-solid fa-person-falling-burst",
        tooltip: "Something",
        pos: 999,
        
        // Bei Readonly true, reagiert der Button auf Readonly
        readonly: true
    }]
});

// Readonly setzen 
list.setReadonly(true);

// Readonly entfernen
list.setReadonly(false);

// Events
list.on('action', function() {
    app.notify.success.fire("Event","Ein Action Event wurde getriggert");
});
</code></pre>


                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Beispiel in Form</h4>

                            <form id="card-form">

                                <div class="form-group form-floating">
                                    <input type="text" name="name" class="form-control editable" placeholder="Bezeichnung" autocomplete="nope" value="Some Text" required>
                                    <label>Bezeichnung</label>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-floating-check">
                                            <label class="form-label">Validierung: Fehler Tabelle leer</label>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input editable" id="leer" name="leer" value="1" />
                                                <label class="form-check-label" for="leer">Aktiviert</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-floating-check">
                                            <label class="form-label">Validierung: Fehler Tabelle gefüllt</label>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input editable" id="voll" name="voll" value="1" />
                                                <label class="form-check-label" for="voll">Aktiviert</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>





                                <div id="pickliste-example-2" class="mt-3 mb-3"></div>

                            </form>
                        </div>
                    </div>


                </div>
                <div class="col-md-6">
                    <pre><code class="language-js ctc">// Liste initalisieren
var list = new Picklist("#example-list", "example", {
    type: 'multi-picklist',
});

// Form initalisieren
var form = new CardForm('#example-form');

// Standardwert setzen (Bei Card Form muss dies gesetzt werden)
form.on('initComplete', function() {
    list.setReadonly(true);
});

// Auf jede Änderung der Form reagieren und weitergeben
form.on('readonly', function(el, readonly) {
    list.setReadonly(readonly);
});
</code></pre>
<pre><code class="language-js ctc">// Felder mit Callback zusammenstellen
var fields = {
    checkbox: {
        validators: {
            callback: {
                callback: function() {

                    // Wert der Checkbox auslesen
                    var data = form.getDataField('checkbox');

                    // Reihen aus der Tabelle auslesen
                    var length = example2.getRowCount();

                    // Wenn die Checkbox angehakt ist, darf die Tabelle nicht leer sein
                    return (data.checked && length == 0) ? false : true;
                },
                message: 'Die Tabelle darf nicht leer sein'
            }
        }
    },
    ...
}

// Validierung aktivieren
form.initValidation(fields);</div>
            </div>


        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {


        var example1 = new Picklist("#pickliste-example-1", "example", {
            type: 'multi-picklist',
            pageLength: 10,
            card: false,
            addHandleButtons: true,
            addButtons: [{
                action: "something",
                icon: "fa-solid fa-person-falling-burst",
                tooltip: "Something",
                pos: 999,
                readonly: true
            }]
        });

        $('#example-1-set').on('click', function() {
            example1.setReadonly(true);
        });

        $('#example-1-unset').on('click', function() {
            example1.setReadonly(false);
        });

        example1.on('action', function() {
            app.notify.success.fire("Event", "Ein Action Event wurde getriggert");
        });


        // --- EXAMPLE 2
        var example2 = new Picklist("#pickliste-example-2", "example", {
            type: 'multi-picklist',
            pageLength: 10,
            card: false
        });


        var form = new CardForm('#card-form');

        form.on('submit', function() {
            form.save('sample-form', 'pickliste-sample-8.php');
        });

        form.on('initComplete', function() {
            example2.setReadonly(true);
        });

        form.on('readonly', function(el, readonly) {
            example2.setReadonly(readonly);
        });


        var fields = {
            leer: {
                validators: {
                    callback: {
                        callback: function() {
                            var data = form.getDataField('leer');
                            var length = example2.getRowCount();
                            return (data.checked && length == 0) ? false : true;
                        },
                        message: 'Die Tabelle darf nicht leer sein'
                    }
                }
            },
            voll: {
                validators: {
                    callback: {
                        callback: function() {
                            var data = form.getDataField('voll');
                            var length = example2.getRowCount();
                            return (data.checked && length > 0) ? false : true;
                        },
                        message: 'Die Tabelle darf nicht voll sein'
                    }
                }
            }
        }

        form.initValidation(fields);


    });
</script>

</html>