<?php include('01_init.php');

$_page = [
    'title' => "<i class=\"fas fa-edit\"></i> Activation Input",
    'breadcrumbs' => ['<a href="activation"><i class="fa-solid fa-toggle-on"></i> Activation</a>']
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

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-check"></i> Activation Input</h4>
                    <h6 class="subtext">Eine Erweiterung der Klasse Activation Checkbox</h6>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>HTML Mockup</strong>
                            <p>
                                Für das Mockup werden keine bestimmten Klassen benötigt.
                                Zur Hilfe gibt es aber die Klasse <code>.activation-input-container</code>. Legt man ein solches DIV an,
                                kann man dort mehrere <code>.form-group</code> hinterlegen. Diese haben dann schon verschiedene Einstellungen über Flex.
                                Die hier gezeigten Beispiele nutzen diese Klasse
                            </p>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-html ctc"><!-- Mockup -->
<div class="activation-input-container">
    <div class="form-group form-floating-check">
        <label class="form-label"></label>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="cb-aktivieren" name="cb-aktivieren" value="1" checked />
            <label class="form-check-label" for="cb-aktivieren"></label>
        </div>
    </div>
    <div class="form-group form-floating">
        <input type="text" name="example-field" class="form-control editable" placeholder="Bezeichnung" value="Mein Text" autocomplete="off">
        <label>Bezeichnung</label>
    </div>
</div></code></pre>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Objekt</strong>
                            <p>
                                Die Übergabe der Felder kann in mehreren Varianten erfolgen<br>
                            <ul>
                                <li>
                                    <strong>String</strong>
                                    <br>Ein Feld mit den Standard Optionen, dabei wird der String als Selector interpretiert.
                                    Wenn eine Form angegeben ist, wird nur in der Form gesucht, ansonsten im kompletten Body.
                                </li>
                                <li>
                                    <strong>jQuery Object</strong><br>
                                    Ein Feld mit den Standard Optionen, dabei wird das Element (el) automatisch übernommen
                                </li>
                                <li>
                                    <strong>Object</strong><br>
                                    Hier wird entwender über den selector oder über Element das Feld gesucht. Alle Optionen werden gemergt.
                                </li>
                                <li>
                                    <strong>Array</strong><br>
                                    Mehrere Felder. Dabei kann jeder Key des Arrays einer der oben genannten Typen sein
                                </li>
                            </ul>
                            </p>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Als String
new ActivationInput('#cb', 'input[name=example-field]');

// Als jQuery Selector
var el = $('selector').find('some-element');
new ActivationInput('#cb', el);

// Object - Mit Selector
new ActivationInput('#cb', {
    selector: input[name=example-field],
    ...
});

// Object - Mit El
// Wenn beides vorhanden ist, wird immer das Element statt des Selector genommen
new ActivationInput('#cb', {
    el: input[name=example-field],
    ...
});


// Array - Mehrer Felder mehrere Möglichkeiten
var jQEl = $('selector').find('some-element');

new ActivationInput('#cb', [{
        el: input[name=example-field],
        ...
    }, 
    jQEl,
    input[name=example-field]
]);</code></pre>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Standard Verhalten</strong>
                            <div class="activation-input-container">
                                <div class="form-group form-floating-check">
                                    <label class="form-label"></label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="cb-aktivieren-1" name="cb-aktivieren-1" value="1" checked />
                                        <label class="form-check-label" for="cb-aktivieren-1"></label>
                                    </div>
                                </div>
                                <div class="form-group form-floating">
                                    <input type="text" name="example-field-1" class="form-control editable" placeholder="Bezeichnung" value="Mein Text" autocomplete="off">
                                    <label>Bezeichnung</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Einfaches Beispiel
new ActivationInput('#cb-aktivieren', 'input[name=example-field]');</code></pre>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Mit Platzhalter</strong>
                            <div class="activation-input-container">
                                <div class="form-group form-floating-check">
                                    <label class="form-label"></label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="cb-aktivieren-2" name="cb-aktivieren-2" value="1" checked />
                                        <label class="form-check-label" for="cb-aktivieren-2"></label>
                                    </div>
                                </div>
                                <div class="form-group form-floating">
                                    <input type="text" name="example-field-2" class="form-control editable" placeholder="Bezeichnung" value="Mein Text" autocomplete="off">
                                    <label>Bezeichnung</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Mit Platzhalter
new ActivationInput('#cb-aktivieren', [{
    selector: 'input[name=example-field]',
    text: 'Ich bin der Platzhalter'
}]);</code></pre>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Mit Reverse</strong>
                            <div class="activation-input-container">
                                <div class="form-group form-floating-check">
                                    <label class="form-label"></label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="cb-aktivieren-3" name="cb-aktivieren-3" value="1" checked />
                                        <label class="form-check-label" for="cb-aktivieren-3"></label>
                                    </div>
                                </div>
                                <div class="form-group form-floating">
                                    <input type="text" name="example-field-3" class="form-control editable" placeholder="Bezeichnung" value="Mein Text" autocomplete="off">
                                    <label>Bezeichnung</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Mit Reverse Parameter
new ActivationInput('#cb-aktivieren', [{
    selector: 'input[name=example-field]',
    reverse: true,
}]);</code></pre>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Mit Keep (Parameter Text wird ignoriert)</strong>
                            <div class="activation-input-container">
                                <div class="form-group form-floating-check">
                                    <label class="form-label"></label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="cb-aktivieren-4" name="cb-aktivieren-4" value="1" checked />
                                        <label class="form-check-label" for="cb-aktivieren-4"></label>
                                    </div>
                                </div>
                                <div class="form-group form-floating">
                                    <input type="text" name="example-field-4" class="form-control editable" placeholder="Bezeichnung" value="Mein Text" autocomplete="off">
                                    <label>Bezeichnung</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Mit Keep Parameter
new ActivationInput('#cb-aktivieren', [{
    selector: 'input[name=example-field]',
    keep: true,
}]);</code></pre>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Mit NoBackup</strong>
                            <div class="activation-input-container">
                                <div class="form-group form-floating-check">
                                    <label class="form-label"></label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="cb-aktivieren-4a" name="cb-aktivieren-4a" value="1" checked />
                                        <label class="form-check-label" for="cb-aktivieren-4a"></label>
                                    </div>
                                </div>
                                <div class="form-group form-floating">
                                    <input type="text" name="example-field-4a" class="form-control editable" placeholder="Bezeichnung" value="Mein Text" autocomplete="off">
                                    <label>Bezeichnung</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// No Backup
new ActivationInput('#cb-aktivieren', [{
    selector: 'input[name=example-field]',
    noBackup: true,
}]);</code></pre>
                        </div>
                    </div>


                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Mit Element initalisieren</strong>
                            <div class="activation-input-container">
                                <div class="form-group form-floating-check">
                                    <label class="form-label"></label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="cb-aktivieren-5" name="cb-aktivieren-5" value="1" checked />
                                        <label class="form-check-label" for="cb-aktivieren-5"></label>
                                    </div>
                                </div>
                                <div class="form-group form-floating">
                                    <input type="text" name="example-field-5" class="form-control editable" placeholder="Bezeichnung" value="Mein Text" autocomplete="off">
                                    <label>Bezeichnung</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// jQuery Element
var el = $('body').find('input[name=example-field]');

// Übergabe des jQuery Elements
new ActivationInput('#cb-aktivieren', el);</code></pre>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Mehrere Werte Initalisieren</strong>
                            <div class="activation-input-container">
                                <div class="form-group form-floating-check">
                                    <label class="form-label"></label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="cb-aktivieren-6" name="cb-aktivieren-6" value="1" checked />
                                        <label class="form-check-label" for="cb-aktivieren-6"></label>
                                    </div>
                                </div>
                                <div class="form-group form-floating">
                                    <input type="text" name="example-field-6a" class="form-control editable" placeholder="Bezeichnung" value="Mein Text" autocomplete="off">
                                    <label>Bezeichnung</label>
                                </div>
                                <div class="form-group form-floating">
                                    <input type="text" name="example-field-6b" class="form-control editable" placeholder="Bezeichnung" value="Mein Text" autocomplete="off">
                                    <label>Bezeichnung</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Mehrere Elemente mit unterschiedlichen Werten
new ActivationInput('#cb-aktivieren', [{
    selector: 'input[name=example-field-a]',
    text: 'Mit einem Platzhalter'
},{
    selector: 'input[name=example-field-b]',
    reverse: true
}]);</code></pre>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>In Verbindung mit einer Form</strong>

                            <form id="example-form">

                                <div class="form-group form-floating">
                                    <input type="text" name="example-field-7a" class="form-control editable" placeholder="Bezeichnung" value="Anderer Text" autocomplete="off">
                                    <label>Anderes Feld</label>
                                </div>

                                <div class="activation-input-container">
                                    <div class="form-group form-floating-check">
                                        <label class="form-label"></label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input editable" id="cb-aktivieren-7" name="cb-aktivieren-7" value="1" checked />
                                            <label class="form-check-label" for="cb-aktivieren-7"></label>
                                        </div>
                                    </div>
                                    <div class="form-group form-floating">
                                        <input type="text" name="example-field-7b" class="form-control editable" placeholder="Bezeichnung" value="Mein Text" autocomplete="off" required>
                                        <label>Bezeichnung</label>
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
new ActivationInput('#cb-aktivieren', [{
    selector: 'input[name=example-field]'
}], form);</code></pre>
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
        new ActivationInput('#cb-aktivieren-1', 'input[name=example-field-1]');

        // Beispiel 2
        // ----------
        new ActivationInput('#cb-aktivieren-2', [{
            selector: 'input[name=example-field-2]',
            text: 'Ich bin der Platzhalter'
        }]);

        // Beispiel 3
        // ----------
        new ActivationInput('#cb-aktivieren-3', [{
            selector: 'input[name=example-field-3]',
            reverse: true
        }]);

        // Beispiel 4
        // ----------
        new ActivationInput('#cb-aktivieren-4', [{
            selector: 'input[name=example-field-4]',
            keep: true
        }]);

        // Beispiel 4a
        // ----------
        new ActivationInput('#cb-aktivieren-4a', [{
            selector: 'input[name=example-field-4a]',
            noBackup: true
        }]);


        // Beispiel 5
        // ----------
        var el = $('body').find('input[name=example-field-5]');
        new ActivationInput('#cb-aktivieren-5', el);

        // Beispiel 6
        // ----------
        new ActivationInput('#cb-aktivieren-6', [{
            selector: 'input[name=example-field-6a]',
            text: 'Mit einem Platzhalter'
        }, {
            selector: 'input[name=example-field-6b]',
            reverse: true
        }]);


        // Beispiel 7
        // ----------

        var form = new Form('#example-form');

        form.initValidation();

        new ActivationInput('#cb-aktivieren-7', [{
            selector: 'input[name=example-field-7b]'
        }], form);

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
                'cb-aktivieren-7': true,
            });
        });

        $('.btn-form-example-6').on('click', function() {
            form.setData({
                'cb-aktivieren-7': false,
            });
        });


    });
</script>

</html>