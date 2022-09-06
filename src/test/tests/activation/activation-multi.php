<?php include('01_init.php');

$_page = [
    'title' => "<i class=\"fas fa-exchange-alt\"></i> Activation Multi",
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
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-exchange-alt"></i> Activation Multi</h4>
                    <h6 class="card-subtitle">Eine Erweiterung der <a href="activation-checkbox">Actionvation Checkbox</a>. Hier wird statt mit <strong>true</strong> und <strong>false</strong>
                        mit Werten gearbeitet.</h6>


                    <hr>

                    <div class="row">
                        <div class="col-6">

                            <strong>Beispiel mit Radio</strong>

                            <div class="form-group form-floating-radio">
                                <label class="form-label">Eine wählen</label>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-1-1" name="example-multi-1" value="apple" />
                                    <label class="form-check-label" for="example-multi-1-1"><i class="fab fa-apple"></i> Apple</label>
                                </div>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-1-2" name="example-multi-1" value="facebook" />
                                    <label class="form-check-label" for="example-multi-1-2"><i class="fab fa-facebook"></i> Facebook</label>
                                </div>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-1-3" name="example-multi-1" value="google" />
                                    <label class="form-check-label" for="example-multi-1-3"><i class="fab fa-google"></i> Google</label>
                                </div>
                            </div>


                            <div class="d-flex justify-content-around mt-3">

                                <div class="card-multi-1 m-1 p-3 flex-grow-1" style="border: 2px solid red;" data-values="apple">
                                    <i class="fab fa-apple"></i> Apple
                                </div>

                                <div class="card-multi-1 m-1 p-3 flex-grow-1" style="border: 2px solid green;" data-values="facebook">
                                    <i class="fab fa-facebook"></i> Facebook
                                </div>

                                <div class="card-multi-1 m-1 p-3 flex-grow-1" style="border: 2px solid blue;" data-values="google">
                                    <i class="fab fa-google"></i> Google
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <pre><code class="language-html ctc"><!-- Radios -->
<input type="radio" name="myradio" value="apple" ... />
<input type="radio" name="myradio" value="facebook" ... />
<input type="radio" name="myradio" value="google" ... />

<!-- Div -->
<div class="mydivs" data-values="apple">Apple</div>
<div class="mydivs" data-values="facebook">Facebook</div>
<div class="mydivs" data-values="google">Google</div>
                            </code></pre>
                            <pre><code class="language-js ctc">new ActivationMulti('input[name=myradio]', '.mydivs');</code></pre>
                        </div>


                    </div>

                    <hr>


                    <div class="row">
                        <div class="col-6">

                            <strong>Beispiel mit Radio (Komplexer)</strong><br>
                            Es ist möglich sowohl beim der Eingabe mehrere Werte mitzugeben, als auch bei den Divs.
                            Außerdem kann man jedem Container <code>[data-reveres=true]</code> mitgeben. Dann wird er immer angezeigt, wenn der Wert <strong>nicht</strong> angehakt ist.

                            <div class="form-group form-floating-radio">
                                <label class="form-label">Eine wählen</label>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-2-1" name="example-multi-2" value="apple,google" />
                                    <label class="form-check-label" for="example-multi-2-1"><i class="fab fa-apple"></i> Apple und Google</label>
                                </div>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-2-2" name="example-multi-2" value="facebook" />
                                    <label class="form-check-label" for="example-multi-2-2"><i class="fab fa-facebook"></i> Facebook</label>
                                </div>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-2-3" name="example-multi-2" value="google" />
                                    <label class="form-check-label" for="example-multi-2-3"><i class="fab fa-google"></i> Google</label>
                                </div>
                            </div>


                            <div class="d-flex justify-content-around mt-3">

                                <div class="card-multi-2 m-1 p-3 flex-grow-1" style="border: 2px solid red;" data-values="apple">
                                    <i class="fab fa-apple"></i> Apple
                                </div>

                                <div class="card-multi-2 m-1 p-3 flex-grow-1" style="border: 2px solid green;" data-values="facebook" data-reverse="true">
                                    <i class="fab fa-facebook"></i> Facebook (ist Reverse)
                                </div>

                                <div class="card-multi-2 m-1 p-3 flex-grow-1" style="border: 2px solid blue;" data-values="google">
                                    <i class="fab fa-google"></i> Google
                                </div>

                                <div class="card-multi-2 m-1 p-3 flex-grow-1" style="border: 2px solid purple;" data-values="facebook,google">
                                    <i class="fab fa-facebook"></i> Facebook oder <i class="fab fa-google"></i> Google
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <pre><code class="language-html ctc"><!-- Radios -->
<input type="radio" name="myradio" value="apple,google" ... />
<input type="radio" name="myradio" value="facebook" ... />
<input type="radio" name="myradio" value="google" ... />

<!-- Div -->
<div class="mydivs" data-values="apple">Apple</div>
<div class="mydivs" data-values="facebook" data-reverse="true">Facebook</div>
<div class="mydivs" data-values="google">Google</div>
<div class="mydivs" data-values="facebook,google">Google</div>
        </code></pre>
                            <pre><code class="language-js ctc">new ActivationMulti('input[name=myradio]', '.mydivs');</code></pre>
                        </div>


                    </div>

                    <hr>


                    <div class="row">
                        <div class="col-6">

                            <strong>Beispiel mit Radio (ohne Data Attribute)</strong>

                            <div class="form-group form-floating-radio">
                                <label class="form-label">Eine wählen</label>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-6-1" name="example-multi-6" value="apple" />
                                    <label class="form-check-label" for="example-multi-6-1"><i class="fab fa-apple"></i> Apple</label>
                                </div>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-6-2" name="example-multi-6" value="facebook" />
                                    <label class="form-check-label" for="example-multi-6-2"><i class="fab fa-facebook"></i> Facebook</label>
                                </div>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-1-3" name="example-multi-6" value="google" />
                                    <label class="form-check-label" for="example-multi-6-3"><i class="fab fa-google"></i> Google</label>
                                </div>
                            </div>


                            <div class="d-flex justify-content-around mt-3">

                                <div id="card-multi-6-1" class="m-1 p-3 flex-grow-1" style="border: 2px solid red;">
                                    <i class="fab fa-apple"></i> Apple
                                </div>

                                <div id="card-multi-6-2" class="m-1 p-3 flex-grow-1" style="border: 2px solid green;">
                                    <i class="fab fa-facebook"></i> Facebook
                                </div>

                                <div id="card-multi-6-3" class="m-1 p-3 flex-grow-1" style="border: 2px solid blue;">
                                    <i class="fab fa-google"></i> Google (ist Reveres)
                                </div>

                                <div id="card-multi-6-4" class="m-1 p-3 flex-grow-1" style="border: 2px solid purple;">
                                    <i class="fab fa-apple"></i> Apple und <i class="fab fa-google"></i> Google
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <pre><code class="language-html ctc"><!-- Radios -->
<input type="radio" name="myradio" value="apple" ... />
<input type="radio" name="myradio" value="facebook" ... />
<input type="radio" name="myradio" value="google" ... />

<!-- Div -->
<div id="mydiv-1">Apple</div>
<div id="mydiv-2">Facebook</div>
<div id="mydiv-3">Google</div>
<div id="mydiv-4">Apple und Google</div>
                            </code></pre>
                            <pre><code class="language-js ctc">new ActivationMulti('input[name=myradio]', [{
        el: '#mydiv-1', // Kann auch ein jQuery Element sein
        values: 'apple'
    },{
        el: '#mydiv-2',
        values: 'facebook'
    },{
        el: '#mydiv-3',
        values: 'google',
        reverse: true
    },{
        el: '#mydiv-4',
        // Mehrere als Array angeben und nicht als String mit Komma
        values: ['apple','google']  
    }
]);</code></pre>
                        </div>


                    </div>


                    <hr>

                    <div class="row">
                        <div class="col-6">

                            <strong>Beispiel mit Select</strong>
                            <div class="form-group form-floating">
                                <select class="form-select editable" name="example-multi-3" placeholder="Hersteller wählen">
                                    <option value="">bitte wählen</option>
                                    <option value="apple">Apple</option>
                                    <option value="facebook">Facebook</option>
                                    <option value="google">Google</option>
                                    <option value="apple,google">Apple und Google</option>
                                    <option value="facebook,google">Google und Facebook</option>
                                    <option value="apple,google,facebook">Alle</option>
                                </select>
                                <label>Hersteller wählen</label>
                            </div>

                            <div class="d-flex justify-content-around mt-3">

                                <div class="card-multi-3 m-1 p-3 flex-grow-1" style="border: 2px solid red;" data-values="apple">
                                    <i class="fab fa-apple"></i> Apple
                                </div>

                                <div class="card-multi-3 m-1 p-3 flex-grow-1" style="border: 2px solid green;" data-values="facebook">
                                    <i class="fab fa-facebook"></i> Facebook
                                </div>

                                <div class="card-multi-3 m-1 p-3 flex-grow-1" style="border: 2px solid blue;" data-values="google">
                                    <i class="fab fa-google"></i> Google
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <pre><code class="language-html ctc"><!-- Einfache Select -->
<select name="myselect">
    <option value="">bitte wählen</option>
    <option value="apple">Apple</option>
    <option value="facebook">Facebook</option>
    <option value="google">Google</option>
    <option value="apple,google">Apple und Google</option>
    <option value="facebook,google">Google und Facebook</option>
    <option value="apple,google,facebook">Alle</option>
</select></code></pre>
                            <pre><code class="language-js ctc">new ActivationMulti('select[name=myselect]', '.mydivs');</code></pre>
                        </div>
                    </div>


                    <hr>

                    <div class="row">
                        <div class="col-6">

                            <strong>Beispiel mit Multi-Select</strong><br>
                            Mit STRG oder SHIFT kann man hier mehrere Werte auswählen

                            <div class="form-group form-floating">
                                <select class="form-select editable" name="example-multi-4" placeholder="Hersteller wählen" multiple style="height: auto;">
                                    <option value="apple">Apple</option>
                                    <option value="facebook">Facebook</option>
                                    <option value="google">Google</option>
                                    <option value="apple,google">Apple und Google</option>
                                </select>
                                <label>Hersteller wählen</label>
                            </div>

                            <div class="d-flex justify-content-around mt-3">

                                <div class="card-multi-4 m-1 p-3 flex-grow-1" style="border: 2px solid red;" data-values="apple">
                                    <i class="fab fa-apple"></i> Apple
                                </div>

                                <div class="card-multi-4 m-1 p-3 flex-grow-1" style="border: 2px solid green;" data-values="facebook">
                                    <i class="fab fa-facebook"></i> Facebook
                                </div>

                                <div class="card-multi-4 m-1 p-3 flex-grow-1" style="border: 2px solid blue;" data-values="google">
                                    <i class="fab fa-google"></i> Google
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <pre><code class="language-html ctc"><!-- Multi Select -->
<select name="myselect" multiple>
    <option value="apple">Apple</option>
    <option value="facebook">Facebook</option>
    <option value="google">Google</option>
    <option value="apple,google">Apple und Google</option>
</select></code></pre>
                            <pre><code class="language-js ctc">new ActivationMulti('select[name=myselect]', '.mydivs');</code></pre>
                        </div>
                    </div>

                    
                    <hr>

                    <div class="row">
                        <div class="col-6">

                            <strong>Beispiel mit Funktion</strong>

                            <div class="form-group form-floating-radio">
                                <label class="form-label">Eine wählen</label>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-7-1" name="example-multi-7" value="apple" />
                                    <label class="form-check-label" for="example-multi-7-1"><i class="fab fa-apple"></i> Apple</label>
                                </div>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-7-2" name="example-multi-7" value="facebook" checked />
                                    <label class="form-check-label" for="example-multi-7-2"><i class="fab fa-facebook"></i> Facebook</label>
                                </div>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-7-3" name="example-multi-7" value="google" />
                                    <label class="form-check-label" for="example-multi-7-3"><i class="fab fa-google"></i> Google</label>
                                </div>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-7-4" name="example-multi-7" value="apple,google" />
                                    <label class="form-check-label" for="example-multi-7-4"><i class="fab fa-apple"></i> Apple</label> und <i class="fab fa-google"></i> Google</label>
                                </div>
                            </div>


    
                        </div>
                        <div class="col-6">
                            <pre><code class="language-js ctc">new ActivationMulti('input[name=myradio]', , function(el, value, isInit) {
    if(isInit) {
        app.notify.info.fire("Initalisiert","Wurde mit dem Wert >" + value + "< initalisiert");
    } else {
        app.notify.success.fire("Neuer Wert","Der neue Wert ist >" + value + "< ");
    }
}</code></pre>
                        </div>


                    </div>

        

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>In Verbindung mit einer Form</strong>

                            <form id="example-form">

                                <div class="form-group form-floating-radio">
                                    <label class="form-label">Eine wählen</label>
                                    <div class="form-radio">
                                        <input type="radio" class="form-check-input editable" id="example-multi-5-1" name="example-multi-5" value="apple" />
                                        <label class="form-check-label" for="example-multi-5-1"><i class="fab fa-apple"></i> Apple</label>
                                    </div>
                                    <div class="form-radio">
                                        <input type="radio" class="form-check-input editable" id="example-multi-5-2" name="example-multi-5" value="facebook" />
                                        <label class="form-check-label" for="example-multi-5-2"><i class="fab fa-facebook"></i> Facebook</label>
                                    </div>
                                    <div class="form-radio">
                                        <input type="radio" class="form-check-input editable" id="example-multi-5-3" name="example-multi-5" value="google" />
                                        <label class="form-check-label" for="example-multi-5-3"><i class="fab fa-google"></i> Google</label>
                                    </div>
                                    <div class="form-radio">
                                        <input type="radio" class="form-check-input editable" id="example-multi-5-4" name="example-multi-5" value="apple,google" />
                                        <label class="form-check-label" for="example-multi-5-4"><i class="fab fa-apple"></i> Apple und <i class="fab fa-google"></i> Google</label>
                                    </div>
                                </div>

                                <div class="form-group form-floating">
                                    <input type="text" name="input-wildcard" class="form-control editable" placeholder="Bezeichnung" value="Anderer Text" value="Foobar" autocomplete="off" required>
                                    <label>Anderes Feld</label>
                                </div>



                                <div class="d-flex justify-content-around mt-3">

                                    <div class="card-multi-5 m-1 p-3 flex-grow-1" style="border: 2px solid red;" data-values="apple">
                                        <div class="form-group form-floating">
                                            <input type="text" name="apple-input" class="form-control editable" placeholder="Apple Input" autocomplete="off" required>
                                            <label><i class="fab fa-apple"></i> Apple</label>
                                        </div>
                                    </div>

                                    <div class="card-multi-5 m-1 p-3 flex-grow-1" style="border: 2px solid green;" data-values="facebook">
                                        <div class="form-group form-floating">
                                            <input type="text" name="facebook-input" class="form-control editable" placeholder="Facebook Input" autocomplete="off" required>
                                            <label><i class="fab fa-facebook"></i> Facebook</label>
                                        </div>
                                    </div>

                                    <div class="card-multi-5 m-1 p-3 flex-grow-1" style="border: 2px solid blue;" data-values="google">
                                        <div class="form-group form-floating">
                                            <input type="text" name="google-input" class="form-control editable" placeholder="Google Input" autocomplete="off" required>
                                            <label><i class="fab fa-google"></i> Google</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-primary btn-form-example-1 mb-2">Senden</button>
                                    <button type="button" class="btn btn-danger btn-form-example-2 mb-2">Reset</button>
                                    <button type="button" class="btn btn-secondary btn-form-example-3 mb-2">Set Readonly</button>
                                    <button type="button" class="btn btn-secondary btn-form-example-4 mb-2">Unset Readonly</button>
                                    <button type="button" class="btn btn-secondary btn-form-example-5 mb-2">Set Apple</button>
                                    <button type="button" class="btn btn-secondary btn-form-example-6 mb-2">Set Google</button>
                                </div>
                            </form>
                        </div>


                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Form erstellen
var form = new Form('#example-form');

// Form Validation aktivieren (optional)
form.initValidation();

// Activation Checkbox mit letzem Parameter, die Form
new ActivationMulti('input[name=myradio]', '.mydiv', form);</code></pre>
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

        // -- Beispiel 1
        radio1 = new ActivationMulti('input[name=example-multi-1]', '.card-multi-1');

        // -- Beispiel 6
        radio2 = new ActivationMulti('input[name=example-multi-6]', [{
                el: '#card-multi-6-1',
                values: 'apple'
            },
            {
                el: '#card-multi-6-2',
                values: 'facebook'
            },
            {
                el: '#card-multi-6-3',
                values: 'google',
                reverse: true
            },
            {
                el: '#card-multi-6-4',
                values: ['apple', 'google']
            }
        ]);

        // -- Beispiel 2
        new ActivationMulti('input[name=example-multi-7]', function(el, value, isInit) {
            if(isInit) {
                app.notify.info.fire("Initalisiert","Wurde mit dem Wert >" + value + "< initalisiert");
            } else {
                app.notify.success.fire("Neuer Wert","Der neue Wert ist >" + value + "< ");
            }
        });

        // -- Beispiel 2
        radio2 = new ActivationMulti('input[name=example-multi-2]', '.card-multi-2');

        // -- Beispiel 2
        select1 = new ActivationMulti('select[name=example-multi-3]', '.card-multi-3');

        // -- Beispiel 4
        select2 = new ActivationMulti('select[name=example-multi-4]', '.card-multi-4', false, true);

        // -- Beispiel 5

        var form = new Form('#example-form');

        form.initValidation();

        radio1 = new ActivationMulti('input[name=example-multi-5]', '.card-multi-5', form);

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
                'example-multi-5': 'apple',
            });
        });

        $('.btn-form-example-6').on('click', function() {
            form.setData({
                'example-multi-5': 'google',
            });
        });

    });
</script>

</html>