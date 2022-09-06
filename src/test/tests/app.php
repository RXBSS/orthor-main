<?php include('01_init.php');

$_page = [
    'title' => "App"
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
                    <h4 class="card-title"><i class="fas fa-key"></i> Shortcuts</h4>
                    <h6 class="subtext">Für die meinsten Shortcuts wird <a href="hotkeys">Hotkeys</a> verwendet</h6>


                    <form id="test-form">



                        <p>
                            <strong>Alle Input Felder</strong><br>
                        </p>
                        <ul>
                            <li><code>STRG</code> + <code>ENTF</code> löscht den Wert eines Indexfelds</li>
                        </ul>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group form-floating">
                                    <input type="text" name="text" class="form-control editable" placeholder="Text" autocomplete="nope" required>
                                    <label>Text</label>
                                </div>
                            </div>
                        </div>

                        <hr>




                        <p>
                            <strong>Datumsfelder</strong><br>
                        </p>
                        <ul>
                            <li><code>STRG</code> + <code>D</code> setzt das aktuelle Datum/Zeit ein</li>
                            <li><code>+</code> / <code>-</code> zählen einen Tag/Minute hoch bzw. runter</li>
                            <li><code>+</code> / <code>-</code> zählen einen Tag hoch bzw. runter</li>
                        </ul>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group form-floating">
                                    <input type="date" name="date" class="form-control editable" placeholder="Datum" autocomplete="nope" required>
                                    <label>Datum</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-floating">
                                    <input type="time" name="time" class="form-control editable" placeholder="Datum" autocomplete="nope" required>
                                    <label>Zeit</label>
                                </div>
                            </div>
                        </div>



                        <hr>

                    </form>

                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-server"></i> Simple Request (AJAX)</h4>
                    <h6 class="subtext">Simple Request ist ein Wrapper für einen Ajax Call</h6>




                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                Bei einem Request (Siehe auch Request API) kann es im Prinzip 3 mögliche Rückmeldungen geben:
                            </p>
                            <ol>
                                <li>
                                    <strong>success</strong> Wenn alles geklappt hat<br>
                                    Es kommt ein JSON zurück und dieses JSON hat das Flag <code>success</code> = <code>true</code><br><br>
                                </li>
                                <li>
                                    <strong>error</strong> Wenn ein erwarteter Fehler aufgetreten ist<br>
                                    Es kommt ein JSON zurück und dieses JSON hat das Flag <code>success</code> = <code>false</code> und <code>error</code> ist gefüllt<br><br>
                                </li>
                                <li>
                                    <strong>server error</strong> Ein ein unerwarteter Fehler aufgetreten ist<br>
                                    Es kommt kein JSON bzw. ein ungültiges JSON zurück. Es gibt keine Verbindung 404, etc.<br><br>
                                </li>
                            </ol>
                            <br>

                            <p>
                                Wenn man keine eigenen Callbacks definiert, kommen die folgenden zum tragen:
                            </p>
                            <button id="simple-request-1" class="btn btn-primary">Success</button>
                            <button id="simple-request-2" class="btn btn-warning">Error</button>
                            <button id="simple-request-3" class="btn btn-danger">Server Error</button>
                        </div>
                        <div class="col-md-6">


                            <nav>
                                <div class="nav nav-tabs" id="tab-nav-ergebnis">
                                    <button class="nav-link active" id="tab-nav-ergebnis-1" data-bs-toggle="tab" data-bs-target="#tab-content-ergebnis-1" type="button">JavaScript (Frontend)</button>
                                    <button class="nav-link" id="tab-nav-ergebnis-2" data-bs-toggle="tab" data-bs-target="#tab-content-ergebnis-2" type="button">PHP (Backend)</button>
                                </div>
                            </nav>
                            <br>
                            <div class="tab-content" id="tab-content-ergebnis">
                                <div class="tab-pane show active" id="tab-content-ergebnis-1">
                                    <pre><code class="language-js ctc">app.simpleRequest("task", "file", data, cbSuccess, cbError, cbServerError)</code></pre>

                                    <pre><code class="language-js ctc">// Einfacher Request 
app.simpleRequest("task", "file", {foo: "bar"});


// Request mit eigenem Success & Error Callback
app.simpleRequest("task", "file", {foo: "bar"}, function(response) {
    // Ich werde bei Erfolg getriggert
    // response.data -> hier sind die Daten drin
}, function(response) {
    // Ich wenn es schief geht
    // response.error -> hier ist die Fehlerbeschreibung drin
});

// Request mit allen Callbacks
app.simpleRequest("task", "file", {foo: "bar"}, function(response) {
    // Ich werde bei Erfolg getriggert
}, function(response) {
    // Ich wenn es schief geht
}, function(jqXHR, textStatus, errorThrown) {
    // und ich wenn es einen Server Fehler gibt
    // jqXHR, textStatus, errorThrown -> siehe https://api.jquery.com/jquery.ajax/ dann error
});</code></pre>
                                </div>
                                <div class="tab-pane" id="tab-content-ergebnis-2">
                                    <pre><code class="language-php ctc">$req = new Request($_POST);
// $_POST['task'] -> Hier ist der Task drin
// $_POST['data'] -> Hier sind die Daten drin 

// Wenn man erfolgreich setzen will
$req->success = true;

// Wenn man einen Fehler setzen will
// $req->success = false; braucht man nicht, wird standardmäßig auf false gesetzt
$req->error = "Hier der Text";

// Wenn etwas schief geht, zum Beispiel eine Exception</code></pre>
                                </div>

                            </div>


                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <strong>Werte im Callback zurückgeben</strong><br>
                                Man kann im Callback auch noch einen Wert zurückgeben, wenn das spart dann noch ein bisschen Zeit
                            </p>

                            <button id="simple-request-4" class="btn btn-primary">Success (Eigener Text)</button>
                            <button id="simple-request-5" class="btn btn-primary">Success (Standard)</button>
                            <button id="simple-request-6" class="btn btn-warning">Error (Eigener Text)</button>
                            <button id="simple-request-7" class="btn btn-warning">Error (Beibehalten)</button>
                        </div>
                        <div class="col-md-6"><pre><code class="language-js ctc">// Eigene Success Meldung
app.simpleRequest("task", "file", {foo: "bar"}, function(response) {
    return "Hier kommt mein toller Text";
});</code></pre>

<pre><code class="language-js ctc">// Standard Success Meldung
app.simpleRequest("task", "file", {foo: "bar"}, function(response) {
    return true;
});</code></pre>

<pre><code class="language-js ctc">// Eigene Error Meldung
app.simpleRequest("task", "file", {foo: "bar"}, null, function(response) {
    return "Hier kommt meine toller Fehlermeldung";
});</code></pre>

<pre><code class="language-js ctc">// Fehlermeldung aus data.error oder Standard wenn leer
app.simpleRequest("task", "file", {foo: "bar"}, null, function(response) {
    return true;
});</code></pre>
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

        // Simple Request
        $('#simple-request-1').on('click', function() {
            app.simpleRequest("mytask", "app-request-test", 1);
        });

        $('#simple-request-2').on('click', function() {
            app.simpleRequest("mytask", "app-request-test", 2);
        });

        $('#simple-request-3').on('click', function() {
            app.simpleRequest("mytask", "app-request-test", 3);
        });

        $('#simple-request-4').on('click', function() {
            app.simpleRequest("mytask", "app-request-test", 1, function() {
                return "Hier kommt mein toller Text";
            });
        });

        $('#simple-request-5').on('click', function() {
            app.simpleRequest("mytask", "app-request-test", 1, function() {
                return true;
            });
        });

        $('#simple-request-6').on('click', function() {
            app.simpleRequest("mytask", "app-request-test", 2, null, function() {
                return "Hier kommt meine toller Fehlermeldung";
            });
        });

        $('#simple-request-7').on('click', function() {
            app.simpleRequest("mytask", "app-request-test", 2, null, function() {
                return true
            });
        });

       
        

        var form = new Form('#test-form');

        form.initValidation();


        // 
        $('input[name=name], input[name=date], input[name=time]').on('change', function() {
            console.log('change Event');
        });


    });
</script>

</html>