<?php include('01_init.php');

$_page = [
    'title' => "File Upload"
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
                    <h4 class="card-title"><i class="fa-solid fa-upload"></i> File Upload</h4>
                    <h6 class="subtext">Hier wird erklärt, wie ein File-Upload funktioniert</h6>

                    <div class="alert alert-soft-warning">
                        <strong>Achtung</strong><br>
                        PHP hat beim Upload zwei Parameter, die den Upload von Dateien und den POST-Request beschränken. Diese müssen ggf. angepasst werden oder über das Limit abefangen werden.
                        In der <strong>php.ini</strong> kann man dazu die Werte <strong>upload_max_filesize</strong> und <strong>post_max_size</strong> setzen!

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <form id="file-upload-form">

                                <div class="form-group form-floating">
                                    <input type="text" name="Test" class="form-control editable" placeholder="Test" autocomplete="nope">
                                    <label>Test</label>
                                </div>

                                <div class="form-group form-floating">
                                    <input type="file" name="name" class="form-control editable" placeholder="Bezeichnung" autocomplete="nope">
                                    <label>Test Datei</label>
                                </div>

                                <br>

                                <button class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        <div class="col-md-6">

                        </div>

                    </div>



                </div>
            </div>

            <hr>




            <div class="row">
                <div class="col-md-6">

                    <h5>Kombination mit einer Pickliste</h5>
                    <p>Hier ein Beispiel zum Verbinden einer Drag & Drop-Fläche mit einer Pickliste</p>


                    <button type="button" id="clear-upload" class="btn btn-danger mb-3">Clear</button>


                    <div id="mydragndrop" class="upload-area mb-3"></div>



                    <div id="upload-pickliste"></div>

                </div>
                <div class="col-md-6">

                    <nav>
                        <div class="nav nav-tabs" id="tab-nav-example-1">
                            <button class="nav-link active" id="tab-nav-example-1-1" data-bs-toggle="tab" data-bs-target="#tab-content-example-1-1" type="button">HTML</button>
                            <button class="nav-link" id="tab-nav-example-1-2" data-bs-toggle="tab" data-bs-target="#tab-content-example-1-2" type="button">JS</button>
                            <button class="nav-link" id="tab-nav-example-1-3" data-bs-toggle="tab" data-bs-target="#tab-content-example-1-3" type="button">PHP</button>
                        </div>
                    </nav>
                    <br>
                    <div class="tab-content" id="tab-content-example-1">
                        <div class="tab-pane show active" id="tab-content-example-1-1">
                            <pre><code class="language-html ctc"><!-- Drag and Drop Bereich -->
<div id="some-div" class="upload-area mb-3"></div>

<!-- Pickliste -->
<div id="upload-pickliste"></div>
                </code></pre>
                        </div>
                        <div class="tab-pane" id="tab-content-example-1-2">
                            <pre><code class="language-js ctc">// Pickliste erstellen
var list = new Picklist("#upload-pickliste", "upload", {
    type: 'multi-picklist'
});

// Drag N Drop Klasse initalisieren
var dragger = new DragAndDrop('#some-div', {
    handle: 'file-upload-handle',
    task: 'upload'
});

// Bei erfolgreichem Upload die Liste neu laden
dragger.on('upload-success', function() {
    list.refresh();
});</code></pre>
                        </div>
                        <div class="tab-pane" id="tab-content-example-1-3">
                            <pre><code class="language-js ctc">// Task
if ($_POST['task'] == 'upload') {

    // Neuen Request erstellen - Wichti
    $req = new Request($_POST);

    // Uploaded Files verschieben
    $req->moveUploadedFiles($_FILES, "demo", [
        'normalize' => true
    ]);

    // In die Datenbank schreiben
    $req->uploadResultToDatabase('example_upload');

    //  Antwort ausgeben
    $req->echoAnswer();
}</code></pre>
                        </div>
                    </div>





                </div>

            </div>


            <hr>


            <!-- 
                    GALERIE
            -->


            <div class="row">
                <div class="col-md-6">
                    <h5>Bilder Galerie</h5>
                    <p>
                        Die Bilder Galerie greift auf die Datenbank zu und kann die Bilder entsprechend anzeigen
                    </p>

                    <div id="example-galerie" class="mb-3"></div>

                    <div id="example-galerie-dragndrop" class="upload-area mb-3"></div>

                </div>
                <div class="col-md-6">

                </div>
            </div>




            <hr>


            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-code-pull-request"></i> Request API</h4>
                    <h6 class="subtext">Für das Thema File Upload gibt es ein paar Funktionen in der Request API</h6>


                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>moveUploadedFiles($files, $dest, $options)</strong><br>
                            Diese Funktion verschiebt die Dateien an ein mitgegebenes Ziel.

                            <br><br>
                            Der erste Parameter ist entwerden ein Array aus Arrays oder ein einzelnes Array eines Files.
                            Dabei wird auf die PHP Super-Variable <code>$_FILES</code> übernommen.

                            <br>
                            Der zweite Parameter ist das Verzeichnis (relativ) in dem die Dokumente abgelegt werden sollen.
                            <br>
                            Der dritte Parameter ist ein Optionen-Parameter

                            <ul>
                                <li><code>replace</code>: (false) Gibt an, ob die Datei ersetzt werden soll oder nicht. Wenn die Datei nicht ersetzt werden soll, dann wird automatisch mit _1, _2, ... hochgezählt</li>
                                <li><code>mkdir</code>: (true) Gibt an, ob das Verzeichnis erstellt werden soll, wenn es nicht erstellt werden soll und nicht exitstier, schlägt der Upload fehl.</li>
                                <li><code>normalize</code>: (false) Wird dieser Punkt aktiviert, dann wird der Dateiname normalisiert. Dabei werden Leerzeichen, Sondernzeichen (bis auf _ -) entfernt und der Name klein geschrieben</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-php ctc">// Neuen Request erstellen
$req = new Request();

// Eine Datei übergeben
$req->moveUploadedFiles($_FILES['name'], "demo", [
    'replace' => true,         // Default = false
    'mkdir' => false,          // Default = true
    'normalize' => true        // Default = false
]);

// Mehrere Dateien übergeben
$req->moveUploadedFiles($_FILES, "demo");</code></pre>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>uploadResultToDatabase($table, $additional, $overwrite)</strong><br>
                            Diese Funktion schließt sich direkt an ein <code>moveUploadedFiles</code> an und übernimmt die Daten der Hochgeladenden Dateien und schreibt diese in die Datenbank.<br>

                            Dazu benötigt die Funktion natürlich die Tabelle als Parameter <strong>$table</strong> in die geschrieben werden soll.
                            Mit Hilfe dieser Tabelle prüft die Funktion ob und welche Felder in der Datenbank vorhanden sind und füllt dann auch nur diese aus.<br>

                            Mit dem Parameter <strong>$additional</strong> kann man ein Array an weiteren Daten mitgeben.<br>

                            Über den Parameter <strong>$overwrite</strong> kann man die standard-namen auch überschreiben.
                            Dann muss man allerdings die Reihenfolge einhalten!
                            <br>
                            <br>
                            <strong>Reihenfolge und Felder:</strong>
                            <ul>
                                <li>name</li>
                                <li>name_original</li>
                                <li>pfad</li>
                                <li>groesse</li>
                                <li>dateiendung</li>
                                <li>mime</li>
                            </ul>


                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-php ctc">// Neuen Request erstellen
$req = new Request();

// Datei/en hochlanden
$req->moveUploadedFiles($_FILES, "demo");

// Ergebnis in die Datenbank schreiben
$req->uploadResultToDatabase("example_upload");</code></pre>

                            <pre><code class="language-php ctc">...

// Mit zusätzlichen Daten als Key Value Pair
$req->uploadResultToDatabase("example_upload", [
    'autrag_id' => 15,
    ...
]);</code></pre>

                            <pre><code class="language-php ctc">...

// Mit überschreiben der Felder Namen
$req->uploadResultToDatabase("example_upload", null, [
    'custom_name',
    'custom_name_original',
    ...
]);</code></pre>


                        </div>
                    </div>
                </div>
            </div>


            <ul id="mycustom-dropdown" class="dropdown-menu context-menu">
                <li><a class="dropdown-item" href="javascript:void(0);" data-action="title"><i class="fa-solid fa-star"></i> Titelbild festlegen</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);" data-action="entfernen"><i class="fa-solid fa-trash"></i> Entfernen</a></li>
            </ul>



            <div class="fab-container">
                <button class="btn btn-primary btn-something-add"><i class="fas fa-plus"></i></button>
            </div>


        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {


        // ------------------- DEMO 1

        // Löschen
        $('#clear-upload').on('click', function() {
            app.notify.success.fire("Erfolgreich", "Die Daten wurden gelöscht");

            // Delete   
            app.simpleRequest("delete", "file-upload-handle", null, function(response) {
                list.refresh();
                galerie.refresh();
            });
        });


        // Löschen
        var list = new Picklist("#upload-pickliste", "upload", {
            type: 'multi-picklist'
        });


        var ex = new DragAndDrop('#mydragndrop', {
            handle: 'file-upload-handle',
            task: 'upload'
        });

        ex.on('upload', function(el, success) {

            if (success) {
                list.refresh();
            }

        });


        // ------------------- DEMO 2


        // Galiere erstellen
        var galerie = new Galerie('#example-galerie');
        
        // Kontext Menü erstellen
        var c = new ContextMenu('#example-galerie', {
            childSelectorClass: 'galerie-item',
            contextSelector: '#mycustom-dropdown'
        });

        c.on('action', function(container, pickedEl, action) {
            $('#example-galerie').find('.galerie-item').removeClass('galerie-marked');
            // pickedEl.addClass('galerie-marked');
        });

        // Upload erstellen
        var ex2 = new DragAndDrop('#example-galerie-dragndrop', {
            handle: 'file-upload-handle',
            task: 'upload-image',
            allowed: ['jpg','jpeg','png','tiff','tif','gif']
        });

        // 
        ex2.on('upload-success', function(el) {
            galerie.refresh();
        });

    });
</script>

</html>