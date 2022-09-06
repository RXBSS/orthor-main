<?php include('01_init.php');

$_page = [
    'title' => "Quickselect"
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
            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fas fa-fighter-jet'></i> Quickselect</h4>
                    <h6 class='subtext'>Quickselect ist eine eigene Programmierung die auf <a href="select2.php">Select2</a> basiert.</h6>
                    <p>
                        Ähnlich wie bei der <a href="pickliste.php">Pickliste</a> wird hier auch eine Datei unter den Modulen erstellt.
                        Ein Quickselect ist aber wesentlich einfacher gehalten und hat nicht so viele Möglichkeiten.<br>
                        Ziel ist es hierbei auch eine Art Vorlage zu erstellen, die man dann auf verschiedenen Seiten nutzen kann.
                    </p>

                    <a href="quickselect-dokumentation" class="btn btn-primary"><i class="fa-solid fa-book"></i> Dokumentation</a>

                    <hr>


                    <!-- Standard-Beispiel -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-floating">
                                <select class="form-select init-select2" name="laender" placeholder="Quickselect Beispiel">

                                </select>
                                <label>Quickselect Beispiel</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Ohne Angabe des Selectors
var q = new Quickselect('laender');</code></pre>
                        </div>
                    </div>

                    <hr>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-floating">
                                <select class="form-select init-select2" id="some-selector" name="user" placeholder="Quickselect Beispiel">
                                </select>
                                <label>Quickselect Beispiel</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Mit Angabe des Selectors und anderem Default Wert
var q = new Quickselect('user', {
    selector: '#some-selector',
    defaultText: 'Bitte Benutzer auswählen',
    defaultValue: '0'
});</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <strong>In Kombination mit dem FormHandler</strong><br>
                                Dabei wird das Initalisieren vom FormHandler übernommen. Man muss nichts weiter tun, nur die Klasse <code>.init-quickselect</code> hinzufügen.
                                Die Optionen können über die data-Attribute gesteuert werden: <br>
                            <ul>
                                <li><code>data-qs-name="laender"</code> </li>
                                <li><code>data-qs-default-text="Bitte ein Land wählen"</code> </li>
                                <li><code>data-qs-default-value="0"</code> </li>
                            </ul>
                            </p>
                            <form id="some-form">
                                <div class="form-group form-floating">
                                    <select class="form-select init-quickselect" id="some-selector" name="laender1" placeholder="Quickselect Beispiel" data-qs-name="laender" data-qs-default-text="Bitte ein Land wählen" data-qs-default-value="0">
                                    </select>
                                    <label>Quickselect Beispiel</label>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-html ctc">// Mit Angabe des Selectors und anderem Default Wert
<select class="form-select init-quickselect" name="user" placeholder="Quickselect Beispiel" data-qs-name="laender" data-qs-default-text="Bitte ein Land wählen" data-qs-default-value="0">
</select></code></pre>
                            <pre><code class="language-js ctc">// Form Initalisieren
var form = new Form('#some-form');</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <strong>Link zwischen Quickselect</strong><br>
                                Hierbei werden zwei Quickselects miteinander verbunden. Das erste Feld gibt den Filter an das nachfolgende Feld weiter.
                                Der erste Parameter ist immer die jeweils andere Klasse des Felds. Parameter 2 ist der Name der Spalte der Tabelle die gefiltert wid.
                                Der Parameter 3 ist optional. Hier wird das Feld angezeigt, wenn keine Ergebnisse da sind.
                            </p>

                            <form id="liste-form">

                                <!-- Form -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-floating">
                                            <select class="form-select init-quickselect" name="liste_a" placeholder="Liste A" required>
                                            </select>
                                            <label>Liste A</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-floating">
                                            <select class="form-select init-quickselect" name="liste_b" placeholder="Liste B" required>
                                            </select>
                                            <label>Liste B</label>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                        <div class="col-md-6">
                            <strong>Ohne FormHandler</strong>
                            <pre><code class="language-js ctc">// Erstellen der Quickselect Objekte
var quickselect1 = new Quickselect('liste_a');
var quickselect2 = new Quickselect('liste_b');

// Verlinken
quickselect1.link(quickselect2, 'label_a', 'Label A');
</code></pre><strong>Mit FormHandler</strong>
                            <pre><code class="language-js ctc">// Erstellen des Form Handlers
var form = new Form('#liste-form');
form.initValidation();

// Verlinken (Quickselect wird unter form.qs[name] gespeichert)
form.qs['liste_a'].link(form.qs['liste_b'], 'liste_a', 'Liste A');
</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <strong>Filter setzen</strong><br>
                                Den Filter der in der Link benutzt wird kann man auch für andere Felder benutzen! Wie hier im Beispiel kann man so zum Beispiel auch ein Textfeld
                                oder jede andere Skript-Aktion mit einem Filter verknüpfen. Mit <code>clearFilter</code> kann man auch den Filter wieder löschen.
                                <br>
                                <em>Im Beispiel bitte die IDs angeben (1,2,3 oder 4)</em>
                            </p>

                            <form id="liste-form2">

                                <!-- Form -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-floating">
                                            <input type="text" name="name" class="form-control editable" placeholder="Mein Feld">
                                            <label>Mein Feld</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-floating">
                                            <select class="form-select init-quickselect" name="liste_b" placeholder="Liste B" required>
                                            </select>
                                            <label>Liste B</label>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" id="btn-test" class="btn btn-secondary">Clear Filter</button>
                            </form>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Erstellen der Quickselect Objekte
var quickselect1 = new Quickselect('liste_a');

// Textfeld
var el = $('input[name=name]');

// Filter setzen
quickselect1.setFilter('liste_a', el.val(), 'Textfeld');

// Event Listner on Key Up setzen
el.on('keyup', function() {
    quickselect1.setFilter('liste_a', el.val(), 'Textfeld');
});

// Filter löschen
$('#btn-test').on('click', function() {
    quickselect1.clearFilter();
});
</code></pre>
                        </div>
                    </div>
                    <hr>


                    <!-- ID -->
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Quickselect mit mehreren Werten</strong>
                            <p>
                                Es kann manchmal sein, dass es sinnvoll ist, mehrere Werte in der Suche angezeigt zu bekommen.
                                Dies sollte dann aber nur in der Suche erscheinen und nicht im Textfeld.
                                Dies kann mit dem Parameter <code>onlyId</code> festegelegt werden. Dann wird in der Suche alle Felder angezeigt, aber im Vorschau nur die ID
                            </p>
                            <div class="form-group form-floating">
                                <select class="form-select editable" id="quickselect3" placeholder="label">
                                    <option value="">bitte wählen</option>
                                </select>
                                <label>Beispiel</label>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">var quickselect1 = new Quickselect('custom', {
    onlyId: true
});</code></pre>
                            <pre><code class="language-html ctc"><select data-qs-only-id="true"></select></code></pre>
                        </div>
                    </div>
                    <hr>


                    <!-- Quickselect Multi -->

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Quickselect Multi</strong>
                            <p>
                                Bei Select und auch bei Select2 gibt es die möglichkeit ein multi Attribute anzugeben.
                                Standardmäßig wird hierbei auch das Attribute <code>closeOnSelect</code> auf <code>false</code> gesetzt, da man ja vermutlich mehrere auswählen möchte.
                            </p>
                            <br>
                            <div class="form-group">
                                <label class="form-label">Beispiel Multi</label>
                                <select class="form-select editable" id="quickselect4" placeholder="label" multiple>
                                </select>
                            </div>
                            <br>
                            <div class="form-group form-select2-multi-column">
                                <label class="form-label">Beispiel Multi - Komplette Zeile</label>
                                <select class="form-select editable" id="quickselect5" placeholder="label" multiple>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="form-label">Beispiel Multi - Close on Select true</label>
                                <select class="form-select editable" id="quickselect4b" placeholder="label" multiple>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="form-label">Beispiel Single - Close on Select false</label>
                                <select class="form-select editable" id="quickselect4c" placeholder="label">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>Um Multiple zu setzen muss man dies einfach in das Select schreiben</p>
                            <pre><code class="language-html ctc"><div class="form-group form-select2-multi-column">
    <select class="form-select" id="..." multiple="true">
        <!-- Options-->    
    </select>
</div></code></pre>
                            <p>
                                Multiple mit vollständiger Zeile
                            </p>
                            <pre><code class="language-html ctc"><div class="form-group form-select2-multi-column">
    <select class="form-select" id="..." multiple="true">
        <!-- Options-->    
    </select>
</div></code></pre>


                            <p>Close on Select</p>
                            <pre><code class="language-js ctc">var quickselect1 = new Quickselect('custom', {
    closeOnSelect: false
});</code></pre>
                            <pre><code class="language-html ctc"><select data-qs-close-on-select="false"></select></code></pre>
                        </div>
                    </div>


                    <br>




                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group form-floating">

                                        <select class="form-select editable" id="quickselect6" placeholder="label" multiple>
                                        </select>
                                        <label>Beispiel Multi</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-floating">
                                        <input type="text" name="name" class="form-control editable" placeholder="Bezeichnung" autocomplete="off" autocomplete="nope" value="asd">
                                        <label>Bezeichnung</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>



                    <hr>



                    <p>
                        <strong>Quickselect Action Buttons (qs-buttons)</strong><br>
                        Dies soll dabei helfen die Datensätze die in einem Quickselect ausgewählt werden können jederzeit dynamisch zu bearbeiten.
                        Gedacht ist, dass man neben dem Quickselect Buttons anbringen kann, mit denen man dann wiederrum die Werte bearbeiten kann.


                    </p>

                    <div class="row">
                        <div class="col-md-6">
                            <br><br>
                            <div class="qs-buttons d-flex justify-content-between">

                                <div class="form-group form-floating form-select2-multi-column flex-grow-1">
                                    <select class="form-select init-quickselect editable" id="q12" name="laender11" placeholder="Länder">
                                        <option value="">Bitte wählen</option>
                                    </select>
                                    <label>Land</label>
                                </div>

                                <div class="btn-group align-self-start pt-4 ps-2">
                                    <button type="button" class="btn btn-primary" data-action="a">A</button>
                                    <button type="button" class="btn btn-primary" data-action="b">B</button>
                                    <button type="button" class="btn btn-primary" data-action="c">C</button>
                                </div>
                            </div>
                            <div class="qs-buttons d-flex justify-content-between">

                                <div class="form-group form-floating form-select2-multi-column flex-grow-1">
                                    <select class="form-select init-quickselect editable" id="q11" name="laender11" placeholder="Länder" multiple>
                                        <option value="">Bitte wählen</option>
                                    </select>
                                    <label>Länder</label>
                                </div>

                                <div class="btn-group align-self-start pt-4 ps-2">
                                    <button type="button" class="btn btn-primary" data-action="a">A</button>
                                    <button type="button" class="btn btn-primary" data-action="b">B</button>
                                    <button type="button" class="btn btn-primary" data-action="c">C</button>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <nav>
                                <div class="nav nav-tabs" id="tab-nav-qsbuttons-1">
                                    <button class="nav-link active" id="tab-nav-qsbuttons-1-1" data-bs-toggle="tab" data-bs-target="#tab-content-qsbuttons-1-1" type="button">HTML</button>
                                    <button class="nav-link" id="tab-nav-qsbuttons-1-2" data-bs-toggle="tab" data-bs-target="#tab-content-qsbuttons-1-2" type="button">JS</button>
                                </div>
                            </nav>
                            <br>
                            <div class="tab-content" id="tab-content-qsbuttons-1">
                                <div class="tab-pane show active" id="tab-content-qsbuttons-1-1">
                                    <pre><code class="language-html ctc"><div class="qs-buttons d-flex justify-content-between">
    <div class="... flex-grow-1">
        <!-- Hier die Select -->
    </div>
    <div class="btn-group align-self-start pt-4 ps-2">
        <button ... data-action="some">...</button>
    </div>
</div></code></pre>

                                    <strong>Ready to Use - Beispiel</strong>
                                    <pre><code class="language-html ctc"><div class="qs-buttons d-flex justify-content-between">

    <div class="form-group form-floating form-select2-multi-column flex-grow-1">
        <select class="form-select init-quickselect editable" id="my-id" name="my-name" placeholder="Liste">
            <option value="">Bitte wählen</option>
        </select>
        <label>Liste</label>
    </div>

    <div class="btn-group align-self-start pt-4 ps-2">
        <button type="button" class="btn btn-primary" data-action="search"><i class="fa-solid fa-search"></i></button>
        <button type="button" class="btn btn-primary" data-action="edit" data-validate="single"><i class="fa-edit fa-search"></i></button>
        <button type="button" class="btn btn-primary" data-action="add"><i class="fa-edit fa-add"></i></button>
    </div>
</div></code></pre>
                                </div>
                                <div class="tab-pane" id="tab-content-qsbuttons-1-2">
                                    <pre><code class="language-js ctc">// Quickselect initalisieren
var quickselect = new Quickselect('laender', {
    selector: '#quickselect',
});

// Event Listner auf eine Action
quickselect.on('action', function(e, action, value, buttonEl, picklist) {

    // e = Event
    // action = data-action aus dem Button
    // value = Die grade eingetragenen Werte
    // buttonEl = Das Button Element
    // picklist = Das gesamte Picklisten Objekt

    // Beispiel Ausgabe als Notify
    app.notify.success.fire("Action: " + action,"Aktuelle Werte: " + value);
});</code></pre>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                Damit das Programmieren noch einfacher wird gibt es ein paar Standard-Funktionen zum Validieren, ob Werte gefüllt sind!<br>
                                Dazu nutzt man das Attribute <code>data-validate=""</code>

                            <ul>
                                <li><code>filled</code><br>Muss zwingend gefüllt sein, sonst kommt eine Meldung</li>
                                <li><code>notfilled</code><br>Muss zwingend leer sein, sonst kommt eine Meldung</li>
                                <li><code>single</code><br>Bringt eine Meldung, wenn leer und öffnet bei mehrere Werte eine Auswahl-Liste, sodass nur ein Werte genommen werden kann</li>
                                <li><code>multiple</code><br>Muss zwingend mehr als ein Wert sein, sonst kommt eine Meldung. Nur bei Mulit-Select sinnvoll.</li>
                            </ul>
                            </p>


                            <div class="qs-buttons d-flex justify-content-between">

                                <div class="form-group form-floating form-select2-multi-column flex-grow-1">
                                    <select class="form-select init-quickselect editable" id="q13" name="laender11" placeholder="Länder" multiple>
                                        <option value="">Bitte wählen</option>
                                    </select>
                                    <label>Länder</label>
                                </div>

                                <div class="btn-group align-self-start pt-4 ps-2">
                                    <button type="button" class="btn btn-secondary" data-action="a" data-validate="filled">F</button>
                                    <button type="button" class="btn btn-secondary" data-action="b" data-validate="notfilled">N</button>
                                    <button type="button" class="btn btn-secondary" data-action="c" data-validate="single">S</button>
                                    <button type="button" class="btn btn-secondary" data-action="d" data-validate="multiple">M</button>
                                </div>
                            </div>

                            <div class="qs-buttons d-flex justify-content-between">

                                <div class="form-group form-floating form-select2-multi-column flex-grow-1">
                                    <select class="form-select init-quickselect editable" id="q14" name="laender12" placeholder="Länder">
                                        <option value="">Bitte wählen</option>
                                    </select>
                                    <label>Länder</label>
                                </div>

                                <div class="btn-group align-self-start pt-4 ps-2">
                                    <button type="button" class="btn btn-secondary" data-action="a" data-validate="filled">F</button>
                                    <button type="button" class="btn btn-secondary" data-action="b" data-validate="notfilled">N</button>
                                    <button type="button" class="btn btn-secondary" data-action="c" data-validate="single">S</button>
                                    <button type="button" class="btn btn-secondary" data-action="d" data-validate="multiple">M</button>
                                </div>
                            </div>

                            <br><br>
                            <p>
                                Beispiel Programmierung für den Einsatz mit echten Datensätzen
                            </p>

                            <a href="quickselect-beispiel-1" class="btn btn-primary"><i class="fa-solid fa-bolt"></i> Beispiel</a>


                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>



                    <hr>


                    <!-- Andere Initalisierung -->
                    <p>
                        <strong>Initalisierung mit Default</strong><br>
                        Im Lauf der Entwicklung hat sich gezeigt, dass das Backend-Skript, dass ebenfalls benötigt wird in vielen Fällen immer gleich aussieht.<br>
                        Aus diesem Grund wurde die Funktion jetzt noch einmal überarbeitet. Dabei kann man jetzt auf den Namen <code>default</code> angeben.
                        In diesem Fall nimmt Quickselect immer eine Standard-Handle Datei. Diese Handle-Datei lässt sich wiederum über weitere Parameter steuern.
                        <br><br>
                        Der Vorteil der daraus entsteht ist, dass man zumindest für einfache Picklisten nicht jedes Mal eine komplette Config anlegen muss.
                        Will man zum Beispiel nur das Feld ändern das ausgelesen wird, oder Anpassungen an der Reihenfolge (Schema siehe unten) vornehmen, dann braucht man dafür keine Config
                        sondern passt dies einfach im JavaScript an.
                    </p>


                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Beispiel mit Config</strong>
                            <div class="form-group form-floating">
                                <select class="form-select editable" id="quickselect8" name="test-default" placeholder="mit Config">
                                    <option value="">Bitte wählen</option>
                                </select>
                                <label>mit Config</label>
                            </div>

                            <br>
                            <pre><code class="language-js ctc">// Front-End (JavaScript)
var q = new Quickselect('laender', {
    ...
});</code></pre>

                            <pre><code class="language-js ctc">// Backend (PHP)
$q = new Quickselect($_GET);
$q->createComplete("_laender", ["de"], "code");
</code></pre>
                        </div>
                        <div class="col-md-6">
                            <strong>Beispiel mit Default</strong>

                            <div class="form-group form-floating">
                                <select class="form-select editable" id="test-default" name="test-default" placeholder="mit Default">
                                    <option value="">Bitte wählen</option>
                                </select>
                                <label>mit Default</label>
                            </div>

                            <br>
                            <pre><code class="language-js ctc">// Front-End (JavaScript)
var q = new Quickselect('default', {
    
    // Der Selector muss zwangsläufig gesetzt werden
    selector: '#my-quickselect',

    // Werte die sonst über PHP gesetzt werden
    table: '_laender',
    fields: 'de',
    primary: 'code'

});</code></pre>
                        </div>
                    </div>
                    <hr>


                    <p>
                        <strong>Schema & HTML</strong><br>
                        Ab Version 1.0.22 von Orthor kann Quickselect jetzt auch mit HTML Daten umgehen. Diese können bereits in der Datenbank stehen.
                        Eine weitere Funktion die dazu gekommen ist, ist das sog. Schema. Mit dessen Hilfe kann man die Reihenfolge und den Text beeinflussen, in dem die ausgelesen Werte dargestellt werden.

                    </p>

                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Beispiel mit Benutzern und einem Icon</strong></p>
                            <div class="form-group form-floating">
                                <select class="form-select init-quickselect" id="quickselect7" name="liste_html_schema" placeholder="Liste der Benutzer" required>
                                </select>
                                <label>Liste der Benutzer</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">var qs = new Quickselect('default', {
    selector: '#my-selector',
    table: '_user',
    fields: ["vorname", "nachname", "email"],
    schema: "&#60;i class='fa-solid fa-user'>&#60;/i> {1}, {0} ({2})"
});</code></pre>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Beispiel mit Länder und Flagge</strong></p>


                            <div class="form-group form-floating">
                                <select class="form-select init-quickselect" id="quickselect9" name="liste_laender_schema" placeholder="Liste der Länder" required>
                                </select>
                                <label>Liste der Länder</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">var qs = new Quickselect('default', {
    selector: '#my-selector',
    table: "_laender",
    fields: ["de", "code"],
    primary: "code",
    schema: '&#60;img src="https://flagcdn.com/16x12/{1}.png" width="16" height="12" alt="{0}"> {0}'
});</code></pre>



                        </div>
                    </div>




                    <div class="alert alert-soft-warning">
                        Wenn man die Felder dynamisch per Ajax füllt, dann muss man natürlich dafür sorgen, dass die Daten auch in der richtigen Formatierung dargestellt werden.
                        Das Schema wird ja nur auf das Auslesen angewandt. Man könnte überlegen dies zu automatisieren mit einer Funktion die das entsprechende Skript mit dem Schema anspricht.
                        Hier kann auch der Parameter <strong>onlyId</strong> helfen, da er den Anzeigetext entfernt und nur den ausgewählten Wert anzeigt
                    </div>


                    Das Schema wird als String übergeben der an die sog. Handlebars angelehnt ist. Also {0} für den ersten Wert, usw. Es wird allerdings eine eigene Programmierung
                    und nicht die Handlebars verwendet.<br><br>

                    <div class="alert alert-soft-warning">
                        Wenn die Formatierung hier noch weiterem Bedarf muss man überlegen ob man nicht zum Beispiel Handlebars verwendet.<br>
                        (Zum Beispiel: <a href="https://github.com/salesforce/handlebars-php">https://github.com/salesforce/handlebars-php</a>)
                        Dies würde ich aber in abhänigkeit davon machen, ob der Use-Case in Aule benötigt wird oder nicht.
                    </div>


                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class='card'>
                        <div class='card-body'>
                            <h4><i class='fas fa-folder'></i> Ordnerstruktur</h4>

                            <h6 class='subtext'>Wie alle Module werden die Daten für Quickselect wie folgt abgespeichert</h6>

                            <p>
                                - module<br>
                                --- quickselect<br>
                                ----- name.php
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class='card'>
                        <div class='card-body'>
                            <h4><i class='fas fa-code'></i> PHP</h4>
                            <h6 class='subtext'>Es gibt eine eigene PHP Klasse für Quickselect.</h6>

                            <p>Mit der Klasse kann man in einfachen Schritten die komplette PHP Kommunikation darstellen:</p>

                            <pre><code class="language-php ctc">$q = new Quickselect($_GET);
$q->createComplete("_laender", ["de"], "code");</code></pre>


                            <p>
                                Wenn man mehr eingreifen will, dann kann man auch die einzelnen Komponenten der Klasse nutzen.
                                Diese sind in der Funktion <strong>createComplete</strong> beschrieben. Hier kann man dann nach belieben Anpassungen vornehmen.
                            </p>

                        </div>
                    </div>
                </div>
            </div>












        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>

<script>
    $(document).on('app:ready', () => {

        var q11 = new Quickselect('laender', {
            selector: '#q11',
        });

        q11.on('action', function(el, action, value, buttonEl) {
            app.notify.success.fire("Action: " + action, "Aktuelle Werte: " + value);
        });

        q11.setData('de', 'Deutschland');
        q11.setData('fj', 'Fidschi');
        q11.setData('is', 'Island');

        var q12 = new Quickselect('laender', {
            selector: '#q12',
        });

        q12.on('action', function(el, action, value, buttonEl) {
            app.notify.success.fire("Action: " + action, "Aktueller Wert: " + value);
        });

        var q13 = new Quickselect('laender', {
            selector: '#q13',
        });

        q13.on('action', function(el, action, value, buttonEl) {
            app.notify.success.fire("Action: " + action, "Aktueller Wert: " + value);
        });

        var q14 = new Quickselect('laender', {
            selector: '#q14',
        });

        q14.on('action', function(el, action, value, buttonEl) {
            app.notify.success.fire("Action: " + action, "Aktueller Wert: " + value);
        });


        var q7 = new Quickselect('laender', {
            selector: '#quickselect8',
        });

        var q7 = new Quickselect('default', {
            selector: '#quickselect7',
            table: '_user',
            fields: ["vorname", "nachname", "email"],
            schema: "<i class='fa-solid fa-user'></i> {1}, {0} ({2})"
        });

        var q9 = new Quickselect('default', {
            selector: '#quickselect9',
            table: "_laender",
            fields: ["de", "code"],
            primary: "code",
            schema: '<img src="https://flagcdn.com/16x12/{1}.png" width="16" height="12" alt="{0}"> {0}'
        });

        var qDef = new Quickselect('default', {
            selector: '#test-default',
            table: "_laender",
            fields: ["de"],
            primary: "code"
        });


        var q4 = new Quickselect('laender', {
            selector: '#quickselect4'
        });

        var q4 = new Quickselect('laender', {
            selector: '#quickselect4b',
            closeOnSelect: true
        });

        var q4 = new Quickselect('laender', {
            selector: '#quickselect4c',
            closeOnSelect: false
        });

        var q5 = new Quickselect('laender', {
            selector: '#quickselect5'
        });

        var q6 = new Quickselect('laender', {
            selector: '#quickselect6'
        });

        var q3 = new Quickselect('custom', {
            selector: '#quickselect3',
            onlyId: true,
            debug: true
        });



        var q1 = new Quickselect('laender', {
            debug: false
        });

        /*
        q1.container.on('change', function() {
            alert('Change');
        });
        */

        var q2 = new Quickselect('user', {
            selector: '#some-selector',
            defaultText: 'Bitte Benutzer auswählen',
            defaultValue: '0'
        });


        // Form Example
        var form3 = new Form('#some-form');


        // Form Example
        var form = new Form('#liste-form');

        // Init Validation
        form.initValidation();

        // Verheiraten der Listen
        form.qs['liste_a'].link(form.qs['liste_b'], 'liste_a', 'Liste A');

        // ########################

        // Form Example
        var form2 = new Form('#liste-form2');

        // Init Validation
        form2.initValidation();

        form2.qs['liste_b'].setFilter('liste_a', form2.container.find('input[name=name]').val(), 'Textfeld');

        form2.container.find('input[name=name]').on('keyup', function() {
            form2.qs['liste_b'].setFilter('liste_a', $(this).val(), 'Textfeld');
            console.log('Filter ist jetzt: ' + $(this).val());
        });


        $('#btn-test').on('click', function() {
            form2.qs['liste_b'].clearFilter();
        });
    });
</script>

</html>