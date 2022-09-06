<?php include('01_init.php');

$_page = [
    'title' => "Form Handler Guide",
    'breadcrumbs' => ['<a href="form-handler">Form Handler</a>']
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

            <h5>Schritt 1 - HTML</h5>
            Je nachdem ob man eine Form auf einer kompletten Seite erstellen möchte, oder eine Form für eine Card oder für ein Modal nutzen will muss man jeweils das entsprechenden Layout in HTML und die entsprechende Klasse in JavaScript nehmen.

            <br>
            <br>

            <div class="row">
                <div class="col-md-6">
                    <strong>Standard Form</strong><br>
                    Bei der Standard Form müssen wir den Submit Button auf jeden Fall mit in die Form einfügen. Dieser muss keinen speziellen Namen haben.

                    <pre class="ctc"><code class="language-html"><div id="example">
    <!-- INHALT DER FORM -->
    <button class="btn btn-primary">Submit</button>
</div></code></pre>
                    <br>
                    <strong>Card Form</strong><br>
                    Bei der Card Form wird alles automatisch gesetzt, auch die Submit Button
                    <pre class="ctc"><code class="language-html"><div id="example"><!-- INHALT DER FORM --></div></code></pre>
                </div>
                <div class="col-md-6">
                    <strong>Modal Form</strong><br>
                    Bei der Modal Form müssen wir das Mockup für das Modal erstellen. Hier kann man auch nach belieben Customizen.
                    Die Button werden automatisch erstellt.
                    <pre class="ctc"><code class="language-html"><div class="modal fade" id="example" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"><i class="fa-solid fa-cat"></i> Überschrift</h4>
            <div class="actions"></div>
        </div>
        <div class="modal-body">
            <!-- INHALT DER FORM -->
        </div>
        <div class="modal-footer"></div>
        </div>
    </div>
</div></code></pre>
                </div>
            </div>


            <hr>
            <h4>Schritt 2 - Die Felder</h4>
            <p>
                Damit die Felder einwandfrei funktionieren brauchen Sie die Klasse <code>.editable</code>. Jedes Form-Feld, dass diesen Input hat, wird automatisch mit verarbeitet.
                Verarbeitet heißt in dem Fall, dass hier automatisch Readonly beim senden gesetzt wird, etc. Das System hat auch einen Mechanismus der automatische alle Felder ausließt.
                Dafür benötigt man <strong>nicht</strong> die Klasse <code>.editable</code>. Standardmäßig werden alle Felder ausgelesen!
            </p>

            <p>Hier eine Auflistung der Felder mit dem entsprechenden Code:
            </p>


            <!-- Input Type Text -->
            <div class="accordion" id="acc-1">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                            Input - Type Text, Date, Time, Email, Password
                        </button>
                    </h2>
                    <div id="collapse-1" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#acc-1">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <pre class="ctc"><code class="language-html"><div class="form-floating">
    <input type="text" name="name" class="form-control editable" placeholder="Bezeichnung">
    <label>Bezeichnung</label>
</div></code></pre>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" name="name" class="form-control editable" placeholder="Bezeichnung" value="Hallo Welt">
                                        <label>Bezeichnung</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Select -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                            Select
                        </button>
                    </h2>
                    <div id="collapse-2" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#acc-1">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <pre class="ctc"><code class="language-html"><div class="form-group">
    <label class="form-label">Static Select</label>
    <select class="form-select editable" name="sselect" placeholder="Floating Select">
        <option value="">Bitte wählen</option>
        <option value="1">Wert 1</option>
        <option value="2">Wert 2</option>
        <option value="3">Wert 3</option>
    </select>
</div></code></pre>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Static Select</label>
                                        <select class="form-select editable" name="sselect" placeholder="Floating Select">
                                            <option value="">Bitte wählen</option>
                                            <option value="1">Wert 1</option>
                                            <option value="2">Wert 2</option>
                                            <option value="3">Wert 3</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                            Textarea
                        </button>
                    </h2>
                    <div id="collapse-3" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#acc-1">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <pre class="ctc"><code class="language-html"><div class="form-floating form-group">
    <textarea class="form-control editable" name="ftextarea" placeholder="Floating Textarea"></textarea>
    <label>Floating Textarea</label>
</div></code></pre>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating form-group">
                                        <textarea class="form-control editable" name="ftextarea" placeholder="Floating Textarea"></textarea>
                                        <label>Floating Textarea</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="false" aria-controls="collapse-3">
                            ...
                            <!-- Todo -->
                        </button>
                    </h2>
                    <div id="collapse-4" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#acc-1">
                        <div class="accordion-body">
                            <em>Rest noch auflisten</em>
                        </div>
                    </div>
                </div>
            </div>



            <!-- INPUT TEXT -->









            <hr>
            <h4>Schritt 3 - JavaScript</h4>
            Im nächsten Schritt muss man das alles Initialisieren. Dafür nimmt man die jeweilige Klasse. Beim Modal gibt es ein paar zusätzliche JavaScript Befehle um das Modal zu öffnen und zu schließen.
            Dies müssen wir dann eigenständig z.B. über ein onclick Event erledigen.
            <p>


            <div class="row">
                <div class="col-md-4">
                    <strong>Standard Form</strong>
                    <pre class="ctc"><code class="language-javascript">// Form über eine ganze Seite
var form = new Form('#example');</code></pre>
                </div>
                <div class="col-md-4"><strong>Card Form</strong>
                    <pre class="ctc"><code class="language-javascript">// Form in einer Card
var form = new CardForm('#example');</code></pre>
                </div>
                <div class="col-md-4"><strong>Modal Form</strong>
                    <pre class="ctc"><code class="language-javascript">// From in einem Modal
var form = new ModalForm('#example');

$('#somebutton').on('click', function() {
    form.open();
});
</code></pre>
                </div>
            </div>
            </p>


            <hr>
            <h4>Schritt 4 - FormValidation</h4>
            <p>
                Optional kann man nun FormValidation noch initalisieren. Sowohl die Felder als auch die Plugins sind optional.
                Bei den Feldern kann man auch mit dem data-attributen von FormValidation arbeiten. Es ist auch Möglich mit beiden in Kombination zu arbeiten.
            </p>

            <div class="row">
                <div class="col-md-6">
                    Beispiel wenn man über fields Objekt die Felder hinzufügt
                    <pre class="ctc"><code class="language-javascript">// Beispiel Felder deklaration
fields: {
    example: {
        validators: {
            notEmpty: {
                message: 'Example darf nicht leer sein'
            }
        }
    }
}

// FormValidation initalisieren
form.initValidation(fields, plugins);</code></pre>
                </div>
                <div class="col-md-6">
                    Beispiel wenn man über HTML die Felder hinzufügt
                    <pre class="ctc"><code class="language-html"><div class="form-floating">
    <input type="text" name="name" class="form-control editable" data-fv-not-empty___message="Example darf nicht leer sein" placeholder="Example">
    <label>Example</label>
</div></code></pre>
                    <pre class="ctc"><code class="language-js">// FormValidation initalisieren
form.initValidation();</code></pre>

                </div>
            </div>

            <hr>
            <h4>Schritt 5 - AJAX Kommunikation</h4>
            <p>
                Im nächsten Schritt wird unsere Form versendet. Auch hier stehen einige Automatismen sowohl auf Seiten von JavaScript als auch PHP zur Verfügung.
                Zunächst müssen wir mit <code>onSubmit</code> abfangen, wenn die Form versendet wird. Nun können wir mit der Funktion <code>save()</code> die Form speichern.
                Diese akzeptiert noch weitere Parameter:

            <ol>
                <li>Task Parameter</li>
                <li>Datei Parameter</li>
                <li>Callback für Success (optional)</li>
                <li>Callback für Error (optional)</li>
                <li>Zustätzliche Daten (optional)</li>
            </ol>

            Wenn man keine Callbacks angibt, wird im Standard ein Meldung per notify bzw. alert ausgegeben.

            </p>
            <pre class="ctc"><code class="language-js">// On Submit Event Abfangen
form.on('submit',function(e) {

    // Daten speichern
    form.save('test', 'myBackendScript.php', null, null, {
        example: data
    });
});</code></pre>
            </p>

            <p>
                Die JavaScript Form Klasse sendet immer nach einem bestimmten Aufbau. Dieser ist auf der linken Seite beschrieben.
                Für das Backend kann man dann die extra Klasse der API nutzen. Alternative kann man aber auch ein beliebiges eigenes Skript bauen.
                Dabei ist nur zu beachten, dass die Antwort immer ein reines JSON sein muss. Das JSON sollte auf jeden Fall die Werte <code>success</code>, <code>error</code> als Boolean und im Fehlerfall <code>message</code> als Text enthalten.
                Weitere Parameter können nach belieben gesetzt werden. 
            </p>


            <div class="row">
                <div class="col-md-6">

                <strong>JS</strong> <i class="fa-solid fa-arrow-right"></i> <strong>PHP als POST Request</strong>
                <pre class="ctc"><code class="language-php">$_POST = [
    'task' => 'example'
    'formData' => [...],
    'compareData' => [...],
    'additional' => [...]
];</code></pre>
                </div>
                <div class="col-md-6">
                <strong>PHP</strong> <i class="fa-solid fa-arrow-right"></i> <strong>JS als JSON</strong> 
                <pre class="ctc"><code class="language-json">{
    "success": false,
    "error": true,
    "message": "Irgendeine Fehlermeldung",
    "data": {...}
}
            </code></pre>
                </div>
            </div>


            <p>Nutzt man die API, dann geht man wie folgt vor. Die API hat außerdem verschiedenste weitere Möglichkeiten für individuelle Anpassungen.</p>

            <pre class="ctc"><code class="language-php">// Die Klasse Sanitized automatisch die Anfrage
$req = new Request($_POST);

// Die sauberen Daten stehen dann unter requestData zur Verfügung. Zur Vereinfachung kann man sich dies in eine kurze Variable setzen
$d = $req->requestData['formData'];

// Insert Query schreiben
$req->setQuery("INSERT INTO `example` SET `field1` = '".$d['field1']."', ...");

// Verarbeiten - Führt die Datenbank Abfrage durch und setzt die Antworten automatisch
$req->process();

// Gibt eine JSON im passenden Format zurück
$req->answer();
</code></pre>
        
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {
        // Do Something
    });
</script>

</html>