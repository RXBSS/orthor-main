<?php include('01_init.php');

$_page = [
    'title' => "<i class=\"fas fa-check-square\"></i> Activation Checkbox",
    'breadcrumbs' => ['<a href="activation"><i class="fa-solid fa-toggle-on"></i> Activation</a>']
];

?>
<!doctype html>

<head>
    <?php include('02_header.php'); ?>

    <style>
        .border {
            border: 1px solid black;
            padding: 15px;
        }
    </style>


</head>

<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-check-square"></i> Activation Checkbox</h4>
                    <h6 class="card-subtitle">Mit der Activation Checkbox kann man einfach ein ein- und ausblenden eines oder mehrere Elemente erreichen! Zudem kann man mit Hilfe
                        von einem Event oder übergabe eine Funktion einen einfachen Callback erreichen.
                    </h6>





                    <div class="row">
                        <div class="col-md-6">

                            <strong>Einfachste Variante</strong><br>
                            Das erste Argument ist immer die Checkbox, das zweite kann hier auch ein <code>String</code> oder <code>jQuery</code> Objekt sein.

                            <div class="form-group form-floating-check">
                                <label class="form-label">Checkbox</label>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input editable" id="example-1" name="example-1" value="1" />
                                    <label class="form-check-label" for="example-1">Wert</label>
                                </div>
                            </div>

                            <div id="div-checked-1" class="border mt-3">
                                <i class="fa-solid fa-check text-success"></i> Ich werde nur einblendet wenn die Checkbox angehakt ist
                            </div>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Einfachste Variante
new ActivationCheckbox('#checkbox', '#container');</code></pre>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">

                            <strong>Mehrere Elemente</strong><br>
                            Hierbei ist der zweite Container ein Array aus Objekten in den Objekten können die Werte <code>el</code> und optional der <code>reverse</code> Parameter mitgegeben werden.
                            <div class="form-group form-floating-check">
                                <label class="form-label">Checkbox</label>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input editable" id="example-2" name="example-2" value="1" />
                                    <label class="form-check-label" for="example-2">Wert</label>
                                </div>
                            </div>

                            <div id="div-checked-2" class="border mt-3">
                                <i class="fa-solid fa-check text-success"></i> Ich werde nur einblendet wenn die Checkbox angehakt ist
                            </div>

                            <div id="div-unchecked-2" class="border mt-3">
                                <i class="fa-solid fa-times text-danger"></i> Ich werde nur einblendet wenn die Checkbox nicht angehakt ist
                            </div>


                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Mit einem Array aus mehreren Elementen
// Falls gewünscht kann hier auch ein jQuery Element angegeben werden
new ActivationCheckbox('#checkbox', [{
        el: '#container-checked' // Kann auch jQuery sein $('xxx')
    },
    {
        el: '#container-checked',
        reverse: true   // wird beim unchecked eingeblendet
    }
]);</code></pre>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-6">

                            <strong>Funktion übergeben</strong><br>
                            Statt eines Elements oder eines Arrays von Elementen wird hier ein Callback übergeben

                            <div class="form-group form-floating-check">
                                <label class="form-label">Checkbox</label>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input editable" id="example-3" name="example-3" value="1" />
                                    <label class="form-check-label" for="example-3">Wert</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Funktion übergeben
new ActivationCheckbox('#checkbox', function(el, isChecked, isInit) {

    // Mit isInit kann festgestellt werden ob initalisiert wird
    if(!isInit) {

        // Mit isChecked kann der Status der Checkbox ausfindig gemacht werden
        if (isChecked) {
            app.notify.success.fire("Checked","Die Checkbox ist aktiviert");
        } else {
            app.notify.error.fire("Unchecked","Die Checkbox ist nicht aktiviert");
        }
    } else {
        app.notify.info.fire("Init","Der Vorgang wurde initalisiert");
    }
});</code></pre>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">

                            <strong>Mit Callback Event</strong><br>
                            Es kann sein, dass man zusätzlich zum Ein- und Ausblenden eine Funktion ausführen möchte.
                            Dazu kann man den Callback auf ein Event nutzen.

                            <div class="form-group form-floating-check">
                                <label class="form-label">Checkbox</label>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input editable" id="example-4" name="example-4" value="1" />
                                    <label class="form-check-label" for="example-4">Wert</label>
                                </div>
                            </div>

                            <div id="div-checked-4" class="border mt-3">
                                <i class="fa-solid fa-check text-success"></i> Ich werde nur einblendet wenn die Checkbox angehakt ist
                            </div>

                            <div id="div-unchecked-4" class="border mt-3">
                                <i class="fa-solid fa-times text-danger"></i> Ich werde nur einblendet wenn die Checkbox nicht angehakt ist
                            </div>


                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Mit Callback Event
var cb = new ActivationCheckbox('#checkbox', [{
        el: '#container-checked'
    },
    {
        el: '#container-checked',
        reverse: true
    }
]);

// Gleiche Parameter wie wenn eine Funktion übergeben wird
cb.on('callback', function(el, isChecked, isInit) {
    if (isChecked) {
        app.notify.success.fire("Checked", "Die Checkbox ist aktiviert");
    } else {
        app.notify.error.fire("Unchecked", "Die Checkbox ist nicht aktiviert");
    }
});

</code></pre>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>In Verbindung mit einer Form</strong>

                            <form id="example-form">

                                <div class="form-group form-floating-check">
                                    <label class="form-label">Checkbox</label>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input editable" id="example-5" name="example-5" value="1" />
                                        <label class="form-check-label" for="example-5">Wert</label>
                                    </div>
                                </div>


                                <div class="form-group form-floating">
                                    <input type="text" name="input-wildcard" class="form-control editable" placeholder="Bezeichnung" value="Anderer Text" value="Foobar" autocomplete="off" required>
                                    <label>Anderes Feld</label>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div id="div-checked-5">
                                            <div class="form-group form-floating">
                                                <input type="text" name="input-checked" class="form-control editable" placeholder="Nur bei Checked" autocomplete="off" required>
                                                <label>Nur bei Checked</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div id="div-unchecked-5">
                                            <div class="form-group form-floating">
                                                <input type="text" name="input-unchecked" class="form-control editable" placeholder="Nur bei Un-Checked" autocomplete="off" required>
                                                <label>Nur bei Un-Checked</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-primary btn-form-example-1 mb-2">Senden</button>
                                    <button type="button" class="btn btn-danger btn-form-example-2 mb-2">Reset</button>
                                    <button type="button" class="btn btn-secondary btn-form-example-3 mb-2">Set Readonly</button>
                                    <button type="button" class="btn btn-secondary btn-form-example-4 mb-2">Unset Readonly</button>
                                    <button type="button" class="btn btn-secondary btn-form-example-5 mb-2">Set Checked</button>
                                    <button type="button" class="btn btn-secondary btn-form-example-6 mb-2">Set Unchecked</button>
                                </div>
                            </form>
                        </div>


                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Form erstellen
var form = new Form('#example-form');

// Form Validation aktivieren (optional)
form.initValidation();

// Activation Checkbox mit letzem Parameter, die Form
new ActivationCheckbox('#example-5', [{
        el: '#div-checked-5'
    },
    {
        el: '#div-unchecked-5',
        reverse: true
    }
], form);</code></pre>
                        </div>
                    </div>

                    <hr>



                    <div class="row">
                        <div class="col-md-6">
                            <strong>Verschachtelte Validierung</strong>
                            <p>
                                Wenn man mehrere Bereiche miteinander Verknüpft, dann kann es dazu kommen, dass eine Feld validiert wird, dass nicht mehr eingeblendet ist.
                                Deshalb kann man verschaltete Elemente verbinden.
                            </p>

                            <form id="test-schachtel">

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group form-floating-check">
                                            <label class="form-label">Ebene 1</label>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input editable" id="example-7-1" name="ebene-1-cb" value="1" />
                                                <label class="form-check-label" for="example-7-1">Aktivieren</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div id="div-checked-7-1" class="form-group form-floating">
                                            <input type="text" name="example-7-1" class="form-control editable" placeholder="Bezeichnung" autocomplete="nope" required>
                                            <label>Bezeichnung</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div id="div-unchecked-7-1" class="form-group form-floating">
                                            <input type="text" name="example-7-2" class="form-control editable" placeholder="Bezeichnung" autocomplete="nope" required>
                                            <label>Bezeichnung</label>
                                        </div>
                                    </div>
                                </div>

                                <div id="ebene-2">

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group form-floating-check">
                                                <label class="form-label">Ebene 2</label>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input editable" id="example-7-2" name="ebene-2-cb" value="1" />
                                                    <label class="form-check-label" for="example-7-2">Aktivieren</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div id="div-checked-7-2" class="form-group form-floating">
                                                <input type="text" name="example-7-3" class="form-control editable" placeholder="Bezeichnung" autocomplete="nope" required>
                                                <label>Bezeichnung</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div id="div-unchecked-7-2" class="form-group form-floating">
                                                <input type="text" name="example-7-4" class="form-control editable" placeholder="Bezeichnung" autocomplete="nope" required>
                                                <label>Bezeichnung</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="ebene-3">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group form-floating-check">
                                                    <label class="form-label">Ebene 3</label>
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input editable" id="example-7-3" name="ebene-3-cb" value="1" />
                                                        <label class="form-check-label" for="example-7-3">Aktivieren</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div id="div-checked-7-3" class="form-group form-floating">
                                                    <input type="text" name="example-7-5" class="form-control editable" placeholder="Bezeichnung" autocomplete="nope" required>
                                                    <label>Bezeichnung</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div id="div-unchecked-7-3" class="form-group form-floating">
                                                    <input type="text" name="example-7-6" class="form-control editable" placeholder="Bezeichnung" autocomplete="nope" required>
                                                    <label>Bezeichnung</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <br>
                                <button class="btn btn-primary">Abschicken</button>
                                <button type="button" class="btn btn-secondary" id="reviel">Reviel</button>

                            </form>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-html ctc"><input type="checkbox" id="cb1">
<div id="sub-1">
    <input type="checkbox" id="cb2">
    <div id="sub-2">
        <input type="checkbox" id="cb3">
    </div>
</div></code></pre>


                            <pre><code class="language-js ctc">// Erstellen und verbinden der Elemente
var cb3 = new ActivationCheckbox('#cb3', [{...},{...}]);
var cb2 = new ActivationCheckbox('#cb2', [{...},{
    el: '#sub-2',
    child: cb3
}]);
var cb1 = new ActivationCheckbox('#cb1', [{...},{
    el: '#sub-1',
    child: cb2
}]);</code></pre>
                        </div>
                    </div>

                    
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Verschachtelte Validierung - mit Befehl</strong>
                            <p>
                                Man kann auch die Checkbox automatisch aktivieren und deaktivieren. Dazu gibt man dem Child die Option <code>checked</code> mit.
                            </p>

                            <form id="test-schachtel-2">

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group form-floating-check">
                                            <label class="form-label">Ebene 1</label>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input editable" id="example-8-1" name="ebene-8-1-cb" value="1" />
                                                <label class="form-check-label" for="example-8-1">Aktivieren</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div id="div-checked-8-1" class="form-group form-floating">
                                            <input type="text" name="example-8-1" class="form-control editable" placeholder="Bezeichnung" autocomplete="nope" required>
                                            <label>Bezeichnung</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div id="div-unchecked-8-1" class="form-group form-floating">
                                            <input type="text" name="example-8-2" class="form-control editable" placeholder="Bezeichnung" autocomplete="nope" required>
                                            <label>Bezeichnung</label>
                                        </div>
                                    </div>
                                </div>

                                <div id="ebene-8-2">

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group form-floating-check">
                                                <label class="form-label">Ebene 2</label>
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" class="form-check-input editable" id="example-8-2" name="ebene-8-2-cb" value="1" />
                                                    <label class="form-check-label" for="example-8-2">Aktivieren</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div id="div-checked-8-2" class="form-group form-floating">
                                                <input type="text" name="example-8-3" class="form-control editable" placeholder="Bezeichnung" autocomplete="nope" required>
                                                <label>Bezeichnung</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div id="div-unchecked-8-2" class="form-group form-floating">
                                                <input type="text" name="example-8-4" class="form-control editable" placeholder="Bezeichnung" autocomplete="nope" required>
                                                <label>Bezeichnung</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="ebene-8-3">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group form-floating-check">
                                                    <label class="form-label">Ebene 3</label>
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input editable" id="example-8-3" name="ebene-8-3-cb" value="1" />
                                                        <label class="form-check-label" for="example-8-3">Aktivieren</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div id="div-checked-8-3" class="form-group form-floating">
                                                    <input type="text" name="example-8-5" class="form-control editable" placeholder="Bezeichnung" autocomplete="nope" required>
                                                    <label>Bezeichnung</label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div id="div-unchecked-8-3" class="form-group form-floating">
                                                    <input type="text" name="example-8-6" class="form-control editable" placeholder="Bezeichnung" autocomplete="nope" required>
                                                    <label>Bezeichnung</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <br>
                                <button class="btn btn-primary">Abschicken</button>
                                <button type="button" class="btn btn-secondary" id="reviel">Reviel</button>

                            </form>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-html ctc"><input type="checkbox" id="cb1">
<div id="sub-1">
    <input type="checkbox" id="cb2">
    <div id="sub-2">
        <input type="checkbox" id="cb3">
    </div>
</div></code></pre>


                            <pre><code class="language-js ctc">// Erstellen und verbinden der Elemente
var cb3 = new ActivationCheckbox('#cb3', [{...},{...}]);
var cb2 = new ActivationCheckbox('#cb2', [{...},{
    el: '#sub-2',
    child: [{el: cb3, checked: false}]
}]);
var cb1 = new ActivationCheckbox('#cb1', [{...},{
    el: '#sub-1',
    child: [{el: cb2, checked: false}]
}]);</code></pre>
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

        // Beispiel 7




        var formSchachtel = new Form('#test-schachtel');

        formSchachtel.initValidation();

        formSchachtel.on('valid', function() {
            app.notify.success.fire("Gültig", "Alle Felder sind vollständig ausgefüllt");
        });

        formSchachtel.on('invalid', function() {
            app.notify.error.fire("Ungültig", "Ein Feld ist noch nicht ausgefüllt");
        });

        // Reviel
        $('#reviel').on('click', function() {
            $('#ebene-2, #ebene-3').show();
            $('#div-checked-7-1,#div-unchecked-7-1, #div-checked-7-2,#div-unchecked-7-2,#div-checked-7-3,#div-unchecked-7-3').show();
        });



      



        var cbL3 = new ActivationCheckbox('#example-7-3', [{
                el: '#div-checked-7-3'
            },
            {
                el: '#div-unchecked-7-3',
                reverse: true
            }
        ], formSchachtel);


        var cbL2 = new ActivationCheckbox('#example-7-2', [{
                el: '#div-checked-7-2'
            },
            {
                el: '#div-unchecked-7-2',
                reverse: true
            }, {
                el: '#ebene-3',
                child: cbL3
            }
        ], formSchachtel);


        var cbL1 = new ActivationCheckbox('#example-7-1', [{
                el: '#div-checked-7-1'
            },
            {
                el: '#div-unchecked-7-1',
                reverse: true
            }, {
                el: '#ebene-2',
                child: cbL2
            }
        ], formSchachtel);



        // ------------------

        var formSchachtel2 = new Form('#test-schachtel-2');

        formSchachtel2.initValidation();

        formSchachtel2.on('valid', function() {
            app.notify.success.fire("Gültig", "Alle Felder sind vollständig ausgefüllt");
        });

        formSchachtel2.on('invalid', function() {
            app.notify.error.fire("Ungültig", "Ein Feld ist noch nicht ausgefüllt");
        });

        // Reviel
        $('#reviel-2').on('click', function() {
            $('#ebene-8-2, #ebene-8-3').show();
            $('#div-checked-8-1,#div-unchecked-8-1, #div-checked-8-2,#div-unchecked-8-2,#div-checked-8-3,#div-unchecked-8-3').show();
        });







        var cbK3 = new ActivationCheckbox('#example-8-3', [{
                el: '#div-checked-8-3'
            },
            {
                el: '#div-unchecked-8-3',
                reverse: true
            }
        ], formSchachtel);


        var cbK2 = new ActivationCheckbox('#example-8-2', [{
                el: '#div-checked-8-2'
            },
            {
                el: '#div-unchecked-8-2',
                reverse: true
            }, {
                el: '#ebene-8-3',
                child: [{el: cbK3, checked: false}]
            }
        ], formSchachtel);


        var cbK1 = new ActivationCheckbox('#example-8-1', [{
                el: '#div-checked-8-1'
            },
            {
                el: '#div-unchecked-8-1',
                reverse: true
            }, {
                el: '#ebene-8-2',
                child: [{el: cbK2, checked: false}]
            }
        ], formSchachtel);



        // -- Beispiel 1 
        var cb1 = new ActivationCheckbox('#example-1', '#div-checked-1');

        // -- Beispiel 2
        var cb1 = new ActivationCheckbox('#example-2', [{
                el: '#div-checked-2'
            },
            {
                el: '#div-unchecked-2',
                reverse: true
            }
        ]);

        // -- Beispiel 3
        var cb3 = new ActivationCheckbox('#example-3', function(el, isChecked, isInit) {
            if (!isInit) {
                if (isChecked) {
                    app.notify.success.fire("Checked", "Die Checkbox ist aktiviert");
                } else {
                    app.notify.error.fire("Unchecked", "Die Checkbox ist nicht aktiviert");
                }
            } else {
                app.notify.info.fire("Init", "Der Vorgang wurde initalisiert");
            }
        });

        // -- Beispiel 4
        var cb4 = new ActivationCheckbox('#example-4', [{
                el: '#div-checked-4'
            },
            {
                el: '#div-unchecked-4',
                reverse: true
            }
        ]);

        cb4.on('callback', function(el, isChecked, isInit) {
            if (isChecked) {
                app.notify.success.fire("Checked", "Die Checkbox ist aktiviert");
            } else {
                app.notify.error.fire("Unchecked", "Die Checkbox ist nicht aktiviert");
            }
        });


        // -- Beispiel 5

        var form = new Form('#example-form');

        form.initValidation();

        var cb2 = new ActivationCheckbox('#example-5', [{
                el: '#div-checked-5'
            },
            {
                el: '#div-unchecked-5',
                reverse: true
            }
        ], form);

        // Submit Form
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
            form.reset(0);
        });

        $('.btn-form-example-3').on('click', function() {
            form.setReadonly(true);
        });

        $('.btn-form-example-4').on('click', function() {
            form.setReadonly(false);
        });

        $('.btn-form-example-5').on('click', function() {
            form.setData({
                'example-5': true,
            });
        });

        $('.btn-form-example-6').on('click', function() {
            form.setData({
                'example-5': false,
            });
        });
    });
</script>

</html>