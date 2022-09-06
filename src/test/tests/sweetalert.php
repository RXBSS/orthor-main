<?php include('01_init.php');

$_page = [
    'title' => 'SweetAlert'
];

?>
<!doctype html>

<!-- Head -->

<head>
    <title>SweetAlert</title>
    <?php include('02_header.php'); ?>
</head>


<!-- Body -->

<body>
    <?php include('03_navigation.php'); ?>

    <div class="wrapper <?php echo (isset($_GET['loader'])) ? $_GET['loader'] : ""; ?>">
        <div class="container-fluid">


            <!-- Sweet Alert
            ###################################################################################################
            ###################################################################################################
            ###################################################################################################
            -->
            <div class="card">
                <div class="card-body">

                    <h4><i class="fa-solid fa-exclamation-circle"></i> SweetAlert</h4>
                    <h6 class="subtext">Ein Plugin zum Erstellen von Alerts und Notifys</h6>
                    <p>Weitere Informationen und die Dokumentation findet man auf <a href="https://sweetalert2.github.io/">https://sweetalert2.github.io/</a>.<br>
                        In der Konsole bekommt man anzeigt, was man zurück erhält.
                    </p>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>Standardmäßig wird SweetAlert so aufgerufen</p>
                            <button class="btn btn-primary btn-example" data-example="1">Standard</button>
                        </div>

                        <div class="col-md-6">
                            <pre><code class="hljs language-js ctc">// Diesen Code nicht nehmen
Swal.fire(
    'Standard SweetAlert',   
    'Oh man ist das ein hässlicher Button',
    'success'
);</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Wir haben es aber so angepasst, dass es automatisch schon unsere Style mitbringt bei den Buttons. Man hat aber trotzdem keine Einschränkungen und kann die komplette Library von SweetAlert nutzen.</p>
                            <button class="btn btn-primary btn-example" data-example="2">Custom Button</button>
                        </div>

                        <div class="col-md-6">
                            <pre><code class="hljs language-js ctc">// Dieser Code ist viel Besser
app.swal.fire(
    'Unser SweetAlert',   
    'Puhh... schon viel besser',
    'success'
);</code></pre>
                        </div>
                    </div>

                    <hr>
                    <br>
                    Wir haben jetzt schon einige Standard-Funktionen gebaut, die die Arbeit abnehmen und noch weitere Voreinstellungen treffen
                </div>
            </div>

            <!-- Alert
            ###################################################################################################
            ###################################################################################################
            ###################################################################################################
            -->
            <div class="card">
                <div class="card-body">
                    <h4><i class="fa-solid fa-exclamation-circle"></i> Alert</h4>
                    <h6 class="subtext">Wir haben hier unterteilt in die einzelen Situationen: <strong>success</strong>, <strong>error</strong>, <strong>warning</strong>, <strong>info</strong>, <strong>save</strong>, <strong>question</strong> </h6>

                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                Minimaler Aufruf ohne weitere Angaben.
                            </p>
                            <button class="btn btn-primary btn-example" data-example="10">Success</button>
                            <button class="btn btn-danger btn-example" data-example="11">Error</button>
                            <button class="btn btn-secondary btn-example" data-example="12">Question</button>
                            <button class="btn btn-secondary btn-example" data-example="13">Save</button>
                            <button class="btn btn-secondary btn-example" data-example="16">Löschen</button>

                            <br>
                            <br>
                            <p>
                                Warnung und Info funktionen zwar auch, machen aber eigentlich ohne Kontext keinen Sinn!
                            </p>
                            <button class="btn btn-warning btn-example" data-example="14">Warnung</button>
                            <button class="btn btn-secondary btn-example" data-example="15">Info</button>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="hljs language-js ctc">// Success
app.alert.success.fire();</code></pre>
                            <pre><code class="hljs language-js ctc">// Error
app.alert.error.fire();</code></pre>
                            <pre><code class="hljs language-js ctc">// Frage
app.alert.question.fire().then((result) => {
    console.log(result);
});</code></pre>
                            <pre><code class="hljs language-js ctc">// Speichern
app.alert.save.fire().then((result) => {
    console.log(result);
});
</code></pre>
                            <pre><code class="hljs language-js ctc">// Löschen
app.alert.delete.fire().then((result) => {
    console.log(result);
});
</code></pre>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                Man kann auch den Default Titel, Text oder Icon ersetzen.<br>
                                Standardmäßig aktzeptiert SweetAlert diese in der Reihenfolge: Titel, Text, Icon, ...<br>
                                Man kann aber explizit mitgeben, was man überschreiben möchte.
                            </p>
                            <button class="btn btn-primary btn-example" data-example="20">Success</button>
                            <button class="btn btn-danger btn-example" data-example="21">Error</button>
                            <button class="btn btn-warning btn-example" data-example="22">Warning</button>
                            <button class="btn btn-secondary btn-example" data-example="23">Info</button>
                            <button class="btn btn-secondary btn-example" data-example="24">Question</button>
                            <button class="btn btn-secondary btn-example" data-example="25">Save</button>
                            <button class="btn btn-secondary btn-example" data-example="26">Löschen</button>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="hljs language-js ctc">// Success
app.alert.success.fire("Jippi","Das hat ja wunderbar geklappt");</code></pre>
                            <pre><code class="hljs language-js ctc">// Error
app.alert.error.fire('You shall not pass');</code></pre>
                            <pre><code class="hljs language-js ctc">// Warning
app.alert.warning.fire('Warnung', 'Nicht schlimm, deshalb Info Icon!', 'info');</code></pre>
                            <pre><code class="hljs language-js ctc">// Info
app.alert.info.fire({
    'text': 'So funktioniert das ganze auch',
});</code></pre>
                            <pre><code class="hljs language-js ctc">// Question
app.alert.question.fire({
    title: 'Fragetitel',
    text: 'Der Inhalt der Frage',
    confirmButtonText: '<i class="fa-solid fa-thumbs-up"></i> Große Zustimmung',
    cancelButtonText: '<i class="fa-solid fa-thumbs-down"></i> Große Abneigung',
    showCancelButton: true
});
</code></pre>
                            <pre><code class="hljs language-js ctc">// Save
app.alert.save.fire("Dokument XYZ").then((result) => {
    if(result.isConfirmed) {
        // Speichern
    } 
});
</pre></code>
                            <pre><code class="hljs language-js ctc">// Löschen
app.alert.delete.fire("Dokument XYZ").then((result) => {
    if(result.isConfirmed) {
        // Löschen
    } 
});
</pre></code>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">

                            <p>Im Vergleich zu den anderen Alerts handelt es sich bei dieser Funktion nicht um ein Mixin. Deshalb muss hier die genauen Variablen übergeben.
                                Die Debug-Info ist allerdings optional.<br>
                                Die Funktion ruft einen Error auf, allerdings automatisch in 100% Breite und mit einem Scrollbaren-Inhalt der in ein <strong>&lt;pre&gt;&lt;/pre&gt;</strong> eingebettet ist.
                                Dies ist besonders bei Ajax-Fehlern sinnvoll.
                            </p>
                            <br>
                            <button class="btn btn-danger btn-example" data-example="27">Debug Error</button>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="hljs language-js ctc">// Debug Info
app.alert.debugError("Titel der Meldung", "Fehlerbeschreibung", "Debug Info");
</pre></code>
                        </div>
                    </div>


                </div>
            </div>

            <!-- Noftify
            ###################################################################################################
            ###################################################################################################
            ###################################################################################################
            -->
            <div class="card">
                <div class="card-body">
                    <h4><i class="fa-solid fa-exclamation-circle"></i> Notify</h4>
                    <h6 class="subtext">Notify soll einen kleinen Alarm oben rechts in der Ecke abgeben.</h6>

                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                Minimaler Aufruf ohne weitere Angaben. Man kann leider nicht leer übergeben, deshalb muss man immer false mit übergeben.
                            </p>
                            <button class="btn btn-primary btn-example" data-example="30">Success</button>
                            <button class="btn btn-danger btn-example" data-example="31">Error</button>
                            <button class="btn btn-secondary btn-example" data-example="32">Question</button>
                            <button class="btn btn-secondary btn-example" data-example="33">Save</button>
                            <button class="btn btn-secondary btn-example" data-example="36">Löschen</button>
                            <button class="btn btn-secondary btn-example" data-example="37">Style (Langes Timeout)</button>

                            <br>
                            <br>
                            <p>
                                Warnung und Info funktionen zwar auch, machen aber eigentlich ohne Kontext keinen Sinn!
                            </p>
                            <button class="btn btn-warning btn-example" data-example="34">Warnung</button>
                            <button class="btn btn-secondary btn-example" data-example="35">Info</button>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="hljs language-js ctc">// Success
app.notify.success.fire();</code></pre>
                            <pre><code class="hljs language-js ctc">// Error
app.notify.error.fire();</code></pre>
                            <pre><code class="hljs language-js ctc">// Frage
app.notify.question.fire().then((result) => {
    console.log(result);
});</code></pre>
                            <pre><code class="hljs language-js ctc">// Speichern
app.notify.save.fire().then((result) => {
    if(result.isConfirmed) {
        // Speichern
    } 
});</code></pre>

<pre><code class="hljs language-js ctc">// Löschen
app.notify.delete.fire().then((result) => {
    if(result.isConfirmed) {
        // Löschen
    } 
});</code></pre>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                Man kann auch den Default Titel, Text oder Icon ersetzen.<br>
                                Standardmäßig aktzeptiert SweetAlert diese in der Reihenfolge: Titel, Text, Icon, ...<br>
                                Wenn man etwas nicht überschreiben möchte, dann benutzt man an der Stelle einfach false.<br>
                                Man kann aber explizit mitgeben, was man überschreiben möchte (Siehe z.B. Question)
                            </p>
                            <button class="btn btn-primary btn-example" data-example="40">Success</button>
                            <button class="btn btn-danger btn-example" data-example="41">Error</button>
                            <button class="btn btn-warning btn-example" data-example="42">Warning</button>
                            <button class="btn btn-secondary btn-example" data-example="43">Info</button>
                            <button class="btn btn-secondary btn-example" data-example="44">Question</button>
                            <button class="btn btn-secondary btn-example" data-example="45">Save</button>
                            <button class="btn btn-secondary btn-example" data-example="46">Löschen</button>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="hljs language-js ctc">// Success
app.notify.success.fire("Jippi","Das hat ja wunderbar geklappt");</code></pre>
                            <pre><code class="hljs language-js ctc">// Error
app.notify.error.fire('You shall not pass');</code></pre>
                            <pre><code class="hljs language-js ctc">// Warning
app.notify.warning.fire('Warnung', 'Nicht schlimm, deshalb Info Icon!', 'info');</code></pre>
                            <pre><code class="hljs language-js ctc">// Info
app.notify.info.fire({
    'text': 'So funktioniert das ganze auch',
});</code></pre>
                            <pre><code class="hljs language-js ctc">// Question
app.notify.question.fire({
    title: 'Fragetitel',
    text: 'Der Inhalt der Frage',
    confirmButtonText: '<i class="fa-solid fa-thumbs-up"></i> Große Zustimmung',
    cancelButtonText: '<i class="fa-solid fa-thumbs-down"></i> Große Abneigung',
    showCancelButton: true
});
</code></pre>
                            <pre><code class="hljs language-js ctc">// Save
app.alert.save.fire("Dokument XYZ").then((result) => {
    if(result.isConfirmed) {
        // Speichern
    } 
});
</pre></code>

<pre><code class="hljs language-js ctc">// Save
app.alert.delete.fire("Dokument XYZ").then((result) => {
    if(result.isConfirmed) {
        // Löschen
    } 
});
</pre></code>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4><i class="fa-solid fa-exclamation-circle"></i> Loading</h4>
                    <h6 class="subtext">Meldung zum Anzeigen, dass grade etwas geladen wird!</h6>

                    <!-- Start Loading -->

                    <div class="row">
                        <div class="col">
                            <p>
                                <strong>Dezentes Laden</strong><br>
                                Die Ladeanzeige ist als Toast oben recht über Notify

                            </p>
                            <button class="btn btn-secondary btn-example" data-example="50">Start Loading</button>
                            <button class="btn btn-secondary btn-example" data-example="51">Stop Loading</button>

                        </div>
                        <div class="col">
                            <pre><code class="hljs language-js ctc">app.notify.loader.fire();</code></pre>
                            <pre><code class="hljs language-js ctc">app.notify.loader.close();</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <p>
                                <strong>Blockiertes Laden</strong><br>
                                Die Ladeanzeige wird in der Mitte angezeigt wird in der Mitte angezeigt.<br>
                                Der Benutzer kann in der Zeit nichts mehr klicken. <br><br>

                                <em>In der Demo schließt es automatisch nach 5 Sekunden</em>


                            </p>
                            <button class="btn btn-secondary btn-example" data-example="52">Start Loading</button>
                            <button class="btn btn-secondary btn-example" data-example="51" disabled>Stoppt automatisch</button>
                        </div>
                        <div class="col">
                            <pre><code class="hljs language-js ctc">app.alert.loader.fire();</code></pre>
                            <pre><code class="hljs language-js ctc">app.alert.loader.close();</code></pre>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-circle-notch"></i> Wrapper-Loader</h4>
                    <h6 class="subtext">Ein Modul um ein Ladesymbol im Wrapper anzuzeigen</h6>

                    <div class="row">
                        <div class="col-md-6">
                            Wenn man in die Klasse <code>.wrapper</code> die Klasse <code>.loading</code> hinzugefügt, dann wird der Inhalt automatisch ausgeblendet.<br>
                            Man muss dann den Stop-Befehl Triggern. Auf dieser Seite ist dies als Beispiel implementiert.<br><br>
                            <div class="alert alert-warning"><strong>ACHTUNG</strong>
                                Man verliert damit die Standardfunktionalität, dass der Browser auf die Höhe scrollt
                                an der man vorher war, wenn man manuell (F5) neu geladen hat.
                            </div>

                            <a href="sweetalert?loader=loading" class="btn btn-secondary">Mit Loader</a>
                            <a href="sweetalert" class="btn btn-secondary">Ohne Loader</a>

                        </div>
                        <div class="col-md-6">
                            Die Klasse <code>.loading</code> in den <code>.wrapper</code> hinzufügen.
                            <pre><code class="language-html ctc" id="sample-text"></code></pre>
                            Stoppen, wenn alles auf der Seite geladen wurde
                            <pre><code class="language-js ctc">app.wrapperLoader.stop();</code></pre>
                        </div>
                    </div>




                    <hr>


                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                Natürlich kann man den Loader auch per API aufrufen.
                                Dazu benutzt man die beiden Befehle.<br><br>
                                <em>In der Demo schließt es automatisch nach 5 Sekunden</em>
                            </p>

                            <button class="btn btn-secondary btn-example" data-example="61">Start Loading</button>
                            <button class="btn btn-secondary" disabled>Stoppt automatisch</button>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Loader starten
app.wrapperLoader.start();

// Loader beenden
app.wrapperLoader.stop();
</code></pre>
                        </div>
                    </div>









                </div>
            </div>

        </div>
    </div>



</body>

<?php include('04_scripts.php'); ?>


<script>
    $(document).ready(function() {

        // Text setzen ohne, dass dort etwas eingefügt wird!
        $('#sample-text').text('<div class="wrapper loading"></div>');
        hljs.highlightElement($('#sample-text')[0]);

        // Timeout setzen
        setTimeout(function() {
            app.wrapperLoader.stop();
        }, 2000);


        $('.btn-example').on('click', function() {

            var example = parseInt($(this).data('example'));

            switch (example) {

                case 1:

                    Swal.fire(
                        'Standard SweetAlert',
                        'Oh man ist das ein hässlicher Button',
                        'success'
                    ).then((result) => {
                        console.log(result);
                    });


                    break;

                case 2:
                    app.swal.fire(
                        'Unser SweetAlert',
                        'Puhh... schon viel besser',
                        'success'
                    ).then((result) => {
                        console.log(result);
                    });
                    break;

                    // *********************

                    // Minimal 
                case 10:
                    app.alert.success.fire().then((result) => {
                        console.log(result);
                    });
                    break;
                case 11:
                    app.alert.error.fire().then((result) => {
                        console.log(result);
                    });
                    break;
                case 12:
                    app.alert.question.fire().then((result) => {
                        console.log(result);
                    });
                    break;
                case 13:
                    app.alert.save.fire().then((result) => {
                        console.log(result);
                    });
                    break;
                case 14:
                    app.alert.warning.fire().then((result) => {
                        console.log(result);
                    });
                    break;
                case 15:
                    app.alert.info.fire().then((result) => {
                        console.log(result);
                    });
                    break;
                case 16:
                    app.alert.delete.fire().then((result) => {
                        console.log(result);
                    });
                    break;


                case 20:
                    app.alert.success.fire("Jippi", "Das hat ja wunderbar geklappt").then((result) => {
                        console.log(result);
                    });
                    break;
                case 21:
                    app.alert.error.fire('You shall not pass').then((result) => {
                        console.log(result);
                    });
                    break;
                case 22:
                    app.alert.warning.fire('Warnung', 'Nicht schlimm, deshalb Info Icon!', 'info').then((result) => {
                        console.log(result);
                    });
                    break;
                case 23:
                    app.alert.info.fire({
                        'text': 'So funktioniert das ganze auch',
                    }).then((result) => {
                        console.log(result);
                    });
                    break;
                case 24:
                    app.alert.question.fire({
                        title: 'Fragetitel',
                        text: 'Der Inhalt der Frage',
                        confirmButtonText: '<i class="fa-solid fa-thumbs-up"></i> Große Zustimmung',
                        cancelButtonText: '<i class="fa-solid fa-thumbs-down"></i> Große Abneigung',
                        showCancelButton: true
                    }).then((result) => {
                        console.log(result);
                    });
                    break;
                case 25:
                    app.alert.save.fire("Dokument XYZ").then((result) => {
                        console.log(result);
                    });
                    break;

                case 26:
                    app.alert.delete.fire("Dokument XYZ").then((result) => {
                        console.log(result);
                    });
                    break;

                case 27:
                    app.alert.debugError("Titel der Meldung", "Fehlerbeschreibung", JSON.stringify(JSON.parse('<?php echo json_encode($_SESSION); ?>'), null, 4));
                    break;

                case 30:
                    app.notify.success.fire().then((result) => {
                        console.log(result);
                    });
                    break;
                case 31:
                    app.notify.error.fire().then((result) => {
                        console.log(result);
                    });
                    break;
                case 32:
                    app.notify.question.fire().then((result) => {
                        console.log(result);
                    });
                    break;
                case 33:
                    app.notify.save.fire().then((result) => {
                        console.log(result);
                    });
                    break;
                case 34:
                    app.notify.warning.fire().then((result) => {
                        console.log(result);
                    });
                    break;
                case 35:
                    app.notify.info.fire().then((result) => {
                        console.log(result);
                    });
                    break;
                case 36:
                    app.notify.delete.fire().then((result) => {
                        console.log(result);
                    });
                    break;
                case 37:
                    app.notify.error.fire({
                        title: "Langes Timeout",
                        text: "Das hier wird sehr lange angezeigt!",
                        timer: 99999,
                        icon: 'info'
                    });
                    break;

                case 40:
                    app.notify.success.fire("Jippi", "Das hat ja wunderbar geklappt").then((result) => {
                        console.log(result);
                    });
                    break;
                case 41:
                    app.notify.error.fire('You shall not pass').then((result) => {
                        console.log(result);
                    });
                    break;
                case 42:
                    app.notify.warning.fire('Warnung', 'Nicht schlimm, deshalb Info Icon!', 'info').then((result) => {
                        console.log(result);
                    });
                    break;
                case 43:
                    app.notify.info.fire({
                        'text': 'So funktioniert das ganze auch',
                    }).then((result) => {
                        console.log(result);
                    });
                    break;
                case 44:
                    app.notify.question.fire({
                        title: 'Fragetitel',
                        text: 'Der Inhalt der Frage',
                        confirmButtonText: '<i class="fa-solid fa-thumbs-up"></i> Große Zustimmung',
                        cancelButtonText: '<i class="fa-solid fa-thumbs-down"></i> Große Abneigung',
                        showCancelButton: true,

                        timer: 99999

                    }).then((result) => {
                        console.log(result);
                    });
                    break;
                case 45:
                    app.notify.save.fire({
                        title: "Dokument XYZ",
                        timer: 99999
                    }).then((result) => {
                        console.log(result);
                    });
                    break;
                case 46:
                    app.notify.delete.fire({
                        title: "Dokument XYZ",
                        timer: 99999
                    }).then((result) => {
                        console.log(result);
                    });
                    break;

                case 50:
                    app.notify.loader.fire();
                    break;

                case 51:
                    app.notify.loader.close();
                    break;

                case 52:

                    app.alert.loader.fire();
                    setTimeout(function() {
                        swal.close();
                    }, 5000);
                    break;

                case 61:
                    app.wrapperLoader.start();

                    setTimeout(function() {
                        app.wrapperLoader.stop();
                    }, 5000);
                    break;

            }
        });
    });
</script>

</html>