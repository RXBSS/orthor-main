<?php include('01_init.php');

$_page = [
    'title' => "Form Handler - Doku",
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

            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fab fa-react'></i> Methoden</h4>
                    <h6 class='subtext'>Alle Verfügbaren Methoden</h6>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-javascript">// Initalisieren
form.initValidation(fields, plugins);</code></pre>
                        </div>
                        <div class="col-md-8">
                            <strong>initValidation</strong><br>
                            Initalisiert die <a href="formvalidation.php">FormValidation</a>. Mit dem ersten Parameter können die Felder übergeben werden. Mit dem zweiten Paramter können weitere Plugins aktiviert werden.
                            Beide Parameter sind optional. Die Validierung kann auch über das data-attribute
                            erfolgen.
                            <br>
                            <br>
                            <table class="table">
                                <tr>
                                    <td><code>fields</code></td>
                                    <td><code>Object</code></td>
                                    <td><em>optional</em></td>

                                    <td>Felder die Validiert werden sollen. Die Felder müssen nicht als Objekt übergeben werden, sondern können auch über das <strong>data Attribute</strong> mitgegeben werden.
                                        (Siehe <a href="https://formvalidation.io/guide/plugins/declarative/">Declarative plugin</a>). Es ist auch eine Mischform möglich!</td>
                                </tr>
                                <tr>
                                    <td><code>plugins</code></td>
                                    <td><code>Object</code></td>
                                    <td><em>optional</em></td>

                                    <td>Zusätzliche Plugins, die zu den Standard-Plugins aktiviert werden sollen. (siehe <a href="https://formvalidation.io/guide/getting-started/usage#4--adding-plugins">Plugins</a>).
                                        Standardmäßig sind die Plugins: Declarative, Trigger, Bootstrap5, SubmitButton, Icon aktiv.
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-javascript">// Save
form.save(task, phpFile, callbackSuccess, callbackError, additionalData);</code></pre>
                        </div>
                        <div class="col-md-8">
                            <strong>save</strong><br>
                            Die Save Funktion führt den kompletten Speichervorgang aus. Bei Card bzw. Modal werden automatisch auch Design-Themen mit berücksichtigt.
                            Sie sammelt außerdem alle Daten mit dem getData Befehl ein!<br><br>

                            <a href="#example-form-save"><i class="fa-solid fa-info-circle"></i> Beispiel</a>
                            <br>
                            <br>


                            <table class="table">
                                <tr>
                                    <td><code>task</code></td>
                                    <td><code>String</code></td>
                                    <td>required</td>
                                    <td>
                                        Füllt die Variable Task beim AJAX Request. Mit Hilfe dieser Variable kann im PHP Skript unterschieden werden, welche Skript laufen soll.
                                        So kann man mit einem PHP Skript mehrere Anfragen bearbeiten.
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>phpFile</code></td>
                                    <td><code>String</code></td>
                                    <td>required</td>

                                    <td>
                                        Die Datei, die angesprochen werden soll. Dort wird der Ajax Request hingesendet.
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>callbackSuccess</code></td>
                                    <td><code>Function</code></td>
                                    <td><em>optional</em></td>
                                    <td>
                                        Hier kann eine <code>function</code> oder <code>false</code> oder <code>null</code> angegeben werden. Wird eine Funktion mitgegeben, dann wird diese getriggert, wenn in der AJAX-Antwort der Parameter success mit true angegeben wird.
                                        In dieser Funktion kann man dann über einen return value <code>true</code> den Standard oder mit einem Return Value String diesen String ausgeben lassen.
                                        Wird nichts angegeben, passiert auch nichts weiter. Wird kein Callback angegeben greift das Standard-Verhalten und es wird eine Erfolgsmeldung ausgegeben.
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>callbackSuccess</code></td>
                                    <td><code>Function</code></td>
                                    <td><em>optional</em></td>
                                    <td>
                                        Hier kann eine <code>function</code> oder <code>false</code> oder <code>null</code> angegeben werden. Wird eine Funktion mitgegeben, dann wird diese getriggert, wenn in der AJAX-Antwort der Parameter success mit false angegeben wird oder die Ajax-Abfrage scheitert.
                                        In dieser Funktion kann man dann über einen return value <code>true</code> den Standard oder mit einem Return Value String diesen String ausgeben lassen.
                                        Wird nichts angegeben, passiert auch nichts weiter. Wird kein Callback angegeben greift das Standard-Verhalten und es wird eine Fehlermeldung ausgegeben.
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>additionalData</code></td>
                                    <td><code>Object</code></td>
                                    <td><em>optional</em></td>
                                    <td>
                                        Hier können weitere Daten mit übergeben werden. Daten die nicht von der getData Funktion erfasst werden.
                                        ACHTUNG: Key Value Pairs, bei denen der Value undefined ist, werden nicht mit übergeben. (AJAX Standard Verhalten).
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-javascript">// Readonly setzen
form.setReadonly(true);</code></pre>
                            <pre class="ctc"><code class="language-javascript">// Readonly aufheben
form.setReadonly(false);
</code></pre>
                        </div>
                        <div class="col-md-8">
                            <strong>setReadonly</strong><br>
                            Setzt alle Felder in der Form die die Klasse <code>.editable</code> haben auf Readonly oder eben nicht mehr.
                            Feuert außerdem das Event <code>readonly</code> und wird auch standardmäßig von der <code>save</code> Methode während des sendens verwendet.
                            <br>
                            <br>
                            <table class="table">
                                <tr>
                                    <td><code>readonly</code></td>
                                    <td><code>Boolean</code></td>
                                    <td>required</td>
                                    <td>
                                        Wenn <code>true</code> setzt es alle Felder mit <code>.editable</code> auf Readonly. Mit <code>false</code> hebt es dies wieder auf.
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-javascript">// Reset auf Standard Werte
form.reset(0);</code></pre>
                            <pre class="ctc"><code class="language-javascript">// Reset zu leer
form.reset(1);</code></pre>
                            <pre class="ctc"><code class="language-javascript">// Reset FormValidation only
form.reset(2);</code></pre>
                        </div>
                        <div class="col-md-8">
                            <strong>reset</strong><br>
                            Setzt das komplette Formular zurück. Die Stufe der zurücksetzung kann gesteuert werden
                            <br>
                            <br>
                            <table class="table">
                                <tr>
                                    <td><code>mode</code></td>
                                    <td><code>Number</code></td>
                                    <td>required</td>
                                    <td>
                                        0 = Reset auf die Standardwerte, die das Dokument beim laden der Seite hatte<br>
                                        1 = Reset und leer alle Felder<br>
                                        2 = Reset nur die FormValidation. Funktioniert nur, wenn FormValidation mit initValidation aktiviert wurde
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-javascript">// Laden der Daten via AJAX
form.load('task','file-handle.php', 5000, function() {
    // Do something (Custom Callback)
});</code></pre>
                            <pre class="ctc"><code class="language-php">// Beispiel Antwort PHP
echo json_encode([
    "success" => true,
    "data" => [
        "field": "sometext",
    ]
]);</code></pre>
                        </div>
                        <div class="col-md-8">
                            <strong>load</strong> <em>ab Version 1.0.3</em><br>
                            Lädt die Daten via AJAX in ein Form. Benutzt dazu setData.
                            <br>
                            <br>
                            <table class="table">
                                <tr>
                                    <td><code>task</code></td>
                                    <td><code>String</code></td>
                                    <td>required</td>
                                    <td>
                                        Der Task, der in PHP angesprochen werden soll
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>file</code></td>
                                    <td><code>String</code></td>
                                    <td>required</td>
                                    <td>
                                        Die Handle-PHP-Datei, die angesprochen werden soll
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>data</code></td>
                                    <td><code>Any</code></td>
                                    <td>optional</td>
                                    <td>
                                        Optionalen Daten um die Daten zu laden. In den meisten Fällen die ID, mit der der Datensatz geladen werden kann
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>callback</code></td>
                                    <td><code>Function</code></td>
                                    <td>optional</td>
                                    <td>
                                        Ein optionaler Callback.
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-javascript">// Get Data
form.getData();</code></pre>
                        </div>
                        <div class="col-md-8">
                            <strong>getData</strong><br>
                            Liest alle Form Felder aus. Unterstützt aktuell alle Input Typen, Select, Textarea. Damit man spezielle Felder auslesen kann, kann man zustätzlich die Methode
                            <code>getAdditionalData</code> überschreiben.<br><br>
                            <table class="table">
                                <tr>
                                    <td><code>Returns</code></td>
                                    <td><code>Object</code></td>
                                    <td>
                                        Gibt ein Objekt mit allen Feldern und deren Werten zurück. Als Key wird der Name des Feldes gesetzt. (Siehe getData und setData Objekt ganz unten)
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-javascript">// Set Data
form.setData(data);

// Mit weiteren Argumenten
form.setData(data, true, true);
</code></pre>
                        </div>
                        <div class="col-md-8">
                            <strong>setData</strong><br>
                            Setzt die Daten in die Form ein. Dazu muss ein Objekt übergeben werden, wie das, dass man bei getData erhalten hat. (Siehe getData und setData Objekt ganz unten)<br><br>
                            <table class="table">
                                <tr>
                                    <td><code>data</code></td>
                                    <td><code>Object</code></td>
                                    <td>required</td>
                                    <td>
                                        Objekt wie von <code>getData</code>
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>asInit</code></td>
                                    <td><code>Boolean</code></td>
                                    <td>optional</td>
                                    <td>
                                        Hier kann man angeben ob diese Daten als Standard Werte für den Reset genommen werden sollen.
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>noRevalidation</code></td>
                                    <td><code>Boolean</code></td>
                                    <td>optional</td>
                                    <td>
                                        Hier kann mit angegeben werden ob eine Revalidierung durchgeführt werden soll.
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-javascript">// Zusätzliche Daten einfügen
form.getAdditionalData = function(data) {
    
    // Eigene Daten anfügen
    data['myadditionaldata'] = 'something';
    
    // Zurückgeben
    return data;
};

// Diese Funktion muss aufgerufen werden 
// sonst stimmt das initFormData Objekt nicht!
form.renewInitFormData();
</code></pre>
                        </div>
                        <div class="col-md-8">

                            <p><strong>getAdditionalData</strong> <em>Methode zum überschreiben!</em><br>
                                Eine Funktion die Überschrieben werden kann. Sie wird während der <code>getData</code> Funktion aufgerufen. Als Parameter enthält sie alle gesammelten Daten.
                                Dort fügt man dann die zusätzlichen Daten an und gibt das komplette Objekt wieder zurück.
                            </p>
                            <p>
                                <strong class="text-danger"><i class="fa-solid fa-exclamation-triangle "></i> WICHTIG!</strong><br>
                                Damit die <code>initFormData</code> korrekt sind muss auf jeden Fall die Funktion <code>renewInitFormData</code> aufgerufen werden.

                            </p>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-javascript">// Funktion zum Schreiben der Daten
form.setAdditionalData = function(data) {

    // Do Something with the Data


};</code></pre>
                        </div>
                        <div class="col-md-8">

                            <p><strong>renewInitFormData</strong><br>
                               Beim Start wird die <code>getData</code> Funktion aufgerufen um die initalen Daten zu speichern. 
                               Da beim Start der Klasse aber <code>setAdditionalData</code> nicht vorhanden ist, muss diese erneut ausgeführt werden. 
                               Nur so hat man die richtigen initalen Daten!
                            </p>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-javascript">// Erneuern der Init Daten
                            form.renewInitFormData();</code></pre>
                        </div>
                        <div class="col-md-8">

                            <p><strong>setAdditionalData</strong> <em>Methode zum überschreiben!</em><br>
                                Eine Funktion die Überschrieben werden kann. Sie wird während der <code>setData</code> und <code>reset</code>Funktion aufgerufen. Als Parameter enthält sie alle Daten aus dem Set Data Objekt.
                                Hiermit steuert man dann die zusätzlichen Dinge.
                            </p>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-javascript">// Open
form.open();</code></pre>
                        </div>
                        <div class="col-md-8">
                            <strong>open</strong> <em>Nur in ModalForm verfügbar</em><br>
                            Öffnet das Modal.
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-javascript">// Close
form.close();</code></pre>
                        </div>
                        <div class="col-md-8">
                            <strong>close</strong> <em>Nur in ModalForm verfügbar</em><br>
                            Schließt das Modal.
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-javascript">// Load and Open
form.loadAndOpen(task, file, id, function() {
    // Do Something
});</code></pre>
                        </div>
                        <div class="col-md-8">
                            <strong>loadAndOpen</strong> <em>Version 1.0.3 | Nur in ModalForm verfügbar</em><br>
                            Ist eine Kombination aus den Funktionen load und open. Für die Parameter siehe Funktion load.
                        </div>
                    </div>
                </div>
            </div>

            <div class='card'>
                <div class='card-body'>
                    <h4><i class="fab fa-react"></i> Events</h4>
                    <h6 class='subtext'>Alle Events die ausgeführt werden</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-javascript">// Initalisieren
var form = new Form('#example');

// Event abfangen
form.on('event', function(param1, param2, ...) {
    // Do Something
});
</code></pre>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Event</th>
                                        <th>Info</th>
                                        <th>Parameter</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>submit</td>
                                        <td>Wenn die Form abgeschickt wird. Hier kann auch valid genutzt werden.</td>
                                        <td><em>keine</em></td>
                                    </tr>
                                    <tr>
                                        <td>valid</td>
                                        <td>Wenn die Form Valide ist und abgeschickt wird.</td>
                                        <td><em>keine</em></td>
                                    </tr>
                                    <tr>
                                        <td>invalid</td>
                                        <td>Wenn die Form Invalide ist und abgeschickt wird</td>
                                        <td><em>keine</em></td>
                                    </tr>
                                    <tr>
                                        <td>readonly</td>
                                        <td>Wenn die Form auf Readonly gesetzt oder es aufgehoben wird.</td>
                                        <td><code>param1</code> Boolean Readonly true/false</td>
                                    </tr>
                                    <tr>
                                        <td>reset</td>
                                        <td>Wenn Die form zurückgesetzt wird.<br>Parameter 1 = Boolean - Readonly</td>
                                        <td><code>param1</code> Number - Reset Stufe (0,1,2)</td>
                                    </tr>
                                    <tr>
                                        <td>saving</td>
                                        <td>Während das Speichern gestartet wird</td>
                                        <td><em>keine</em></td>
                                    </tr>
                                    <tr>
                                        <td>saved</td>
                                        <td>Wenn vollständig gespeichert wurde.<br>Parameter 1 = Boolean - Error</td>
                                        <td><code>param1</code> Number - Reset Stufe (0,1,2)</td>
                                    </tr>
                                    <tr>
                                        <td>initComplete</td>
                                        <td>Vollständig initalisiert</td>
                                        <td><em>keine</em></td>
                                    </tr>
                                    <tr>
                                        <td>end</td>
                                        <td>
                                            Nur bei Card verfügbar<br>
                                            Wenn die Bearbeitung Fertig ist
                                        </td>
                                        <td><code>param1</code> Boolean - <code>false</code> = Wenn abgebrochen wurde. <code>true</code> = Wenn gespeichert wurde </td>
                                    </tr>
                                    <tr>
                                        <td>enable</td>
                                        <td>
                                            Nur bei Card verfügbar<br>
                                            Wenn die Card aktiviert wird
                                        </td>
                                        <td><em>keine</em></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fab fa-react'></i> Weiteres nützliches Wissen</h4>
                    <h6 class='subtext'>Noch ein paar Beispiele und Hilfreiches</h6>

                    <hr>
                    <p>
                        Wenn FormValidation aktiviert wurde, dann wird das Objekt in die Variable fvInstanz gespeichert.<br>
                        Man kann also alles mit FormValidation machen, was man möchte:
                    </p>

                    <pre class="ctc"><code class="language-javascript">// Initalisieren
var form = new Form('#example');

// Form Validation aktivieren
form.initValidation();

// Ein bestimmtes Feld von der Validierung ausnehmen
form.fvInstanz.disableValidator('somefield');

// Auf ein spezielles Event hören
form.fvInstanz.on('core.field.invalid',function(field, reset)  {
    console.log('Das Feld >' + field + '< ist ungültig');
});</code></pre>
                </div>
            </div>


            <!-- get und set Data -->


            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fab fa-react'></i> getData und setData Objekt</h4>
                    <h6 class='subtext'>Bei getData und setData erhält man bzw. übergibt man ein JSON Objekt. Hier sind die Werte erklärt:</h6>
                    <div class="mt-3"><br></div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control editable" placeholder="InputText" value="Hallo Welt">
                                <label>InputText</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            Das gleiche ist auch beim den anderen Text-basierenden Inputs wie <code>type["email"]</code>, <code>type["password"]</code>, <code>type["email"]</code>, <code>type["hidden"]</code>.
                            Hier ist für das Auslesen und setzen nichts weiter zu beachten.
                        </div>
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-json">{
    "inputText": "Hallo Welt"
}</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="date" name="date" class="form-control editable" placeholder="DateInput" value="1991-02-13">
                                <label>DateInput</label>
                            </div>

                        </div>
                        <div class="col-md-4">
                            Das Datum muss immer im Format Jahr (4 Stellig) Monat (2 Stellig) Tag (2 Stellig) <code>PHP: Y-m-d</code> und <code>MomentJS: YYYY-MM-DD</code> angegeben werden.
                            So erhält man es auch zurück. Alle anderen Datumsformate werde als ungültig ausgegeben.
                        </div>
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-json">{
    "DateInput": "1991-02-13"
}</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="time" name="time" class="form-control editable" placeholder="TimeInput" value="10:20">
                                        <label>TimeInput</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating">
                                        <input type="time" name="time" class="form-control editable" placeholder="TimeInput" value="10:20:54">
                                        <label>TimeInput</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            Die Zeit muss immer in Stunden : Minunten oder in Stunden : Minuten : Sekunden angegeben werden. <code>PHP: H:i:s</code> und <code>MomentJS: HH:mm:ss</code>
                        </div>
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-json">// Ohne Sekunden
{
    "TimeInput": "10:20"
}</code></pre>
                            <pre class="ctc"><code class="language-json">// Mit Sekunden
{
    "TimeInput": "10:20:54"
}</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Einfach Auswahl</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input editable" id="cb-doku-1-1" name="cbeinfach" value="Wert" checked />
                                    <label class="form-check-label" for="cb-doku-1-1">cbInput</label>
                                </div>
                            </div>
                            <div class="form-group form-check form-switch">
                                <input class="form-check-input editable" name="cbswitch" type="checkbox" id="cb-doku-1-2" checked>
                                <label class="form-check-label" for="cb-doku-1-2">cbInput</label>
                            </div>

                        </div>
                        <div class="col-md-4">
                            Eine normale Checkbox gibt immer ein Objekt zurück. Beim setzen der Checkbox braucht man allerdings nicht umbedingt einen Value mitgeben!
                            Dieser wird beim setzen sowieso nicht berücksichtigt. Das gleiche gilt für Switches.
                        </div>
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-json">// Fürs auslesen und setzen
{
    "cbInput": {
        "checked": true, // oder false
        "value": "Wert" // value Attribute der Checkbox
    }
}</code></pre>
                            <pre class="ctc"><code class="language-json">// Optional das setzen ohne Value
{
    "cbInput": true // oder false
}</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Mehrfachauswahl</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input editable" id="cb-3-1" name="tageAuswahl[]" value="1" />
                                    <label class="form-check-label" for="cb-3-1">Montag</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input editable" id="cb-3-2" name="tageAuswahl[]" value="2" checked />
                                    <label class="form-check-label" for="cb-3-2">Dienstag</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input editable" id="cb-3-3" name="tageAuswahl[]" value="3" checked />
                                    <label class="form-check-label" for="cb-3-3">Mittwoch</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input editable" id="cb-3-4" name="tageAuswahl[]" value="4" />
                                    <label class="form-check-label" for="cb-3-4">Donnerstag</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input editable" id="cb-3-5" name="tageAuswahl[]" value="5" />
                                    <label class="form-check-label" for="cb-3-5">Freitag</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input editable" id="cb-3-6" name="tageAuswahl[]" value="6" />
                                    <label class="form-check-label" for="cb-3-6">Samstag</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input editable" id="cb-3-7" name="tageAuswahl[]" value="7" />
                                    <label class="form-check-label" for="cb-3-7">Sonntag</label>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-4">
                            Es gibt den Fall, dass man Checkboxen als eine zusammenhängenden Teil validieren kann. In diesem Fall erhalten mehrere Checkboxen die gleiche Klasse.
                            Wichtig ist sowohl für FormValidation als auch für die FormHandler Klasse, dass der Namen als Array angegeben wird. <br>
                            Zum Beispiel: <code>tageAuswahl[]</code><br>
                            Dann wird die Validierung und das setzen und auslesen der Checkboxen so durchgeführt als wären Sie ein Feld.
                            Das ermöglicht Validierungen wie: "Wählen Sie mindestens 4 Tage aus". (Siehe Beispiel)

                        </div>
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-json">// Fürs auslesen und setzen
{
    "tageAuswahl": [{
        "value": "2", 
        "text": "Dienstag"
    },{
        "value": "3", 
        "text": "Mittwoch"
    }]
}</code></pre>
                            <pre class="ctc"><code class="language-json">// Optional das setzen ohne Value
{
    "tageAuswahl": [2,3] // oder false
}</code></pre>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Einfaches Radio</label><br>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input" type="radio" id="cb-2-1" name="radioInput" value="Wert 1">
                                    <label class="form-check-label" for="cb-2-1">Wert 1</label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input" type="radio" id="cb-2-2" name="radioInput" value="Wert 2" checked>
                                    <label class="form-check-label" for="cb-2-2">Wert 2</label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input" type="radio" id="cb-2-3" name="radioInput" value="Wert 3">
                                    <label class="form-check-label" for="cb-2-3">Wert 3</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            Bei einem Radio wird nur der Wert mitgegeben
                        </div>
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-json">{
    "radioInput": "Wert 2" // false, wenn keine ausgewählt
}</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Standard Select</label><br>
                                <select class="form-select editable" name="select">
                                    <option value="" selected>bitte wählen</option>
                                    <option value="1">Wert 1</option>
                                    <option value="2">Wert 2</option>
                                    <option value="3">Wert 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            Bei einem Select wird beim Auslesen sowohl das Value Attribute als auch der Text ausgelesen. Wie bei der Checkbox auch, reicht es aber den Wert zu setzen.
                            Dies gilt auch für Select 2.
                            <br>
                            <br>
                            <div class="alert alert-danger">
                                Hier gibt es ggf. noch Probleme bei AJAX und Select 2. Dort müsste nämlich eigentlich sowohl der Text als auch der Wert gesetzt werden?
                            </div>
                        </div>
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-json">// Fürs auslesen und setzen
{
    "select": {
        "value": "1", 
        "text": "Wert 1"
    }
}</code></pre>
                            <pre class="ctc"><code class="language-json">// Optional das setzen ohne Text
{
    "select": 1
}</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Standard Select</label><br>
                                <select class="form-select editable" name="select" multiple>
                                    <option value="1">Wert 1</option>
                                    <option value="2" selected>Wert 2</option>
                                    <option value="3" selected>Wert 3</option>
                                    <option value="4">Wert 4</option>
                                    <option value="5">Wert 5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            Bei Select gibt es auch Multiple Auswahl. In dem Fall muss mit Arrays gearbeitet werden.
                            Wenn kein Wert definiert wurde, gibt es <code>false</code> zurück
                        </div>
                        <div class="col-md-4">
                            <pre class="ctc"><code class="language-json">// Fürs auslesen und setzen
{
    "multiSelect": [{
        "value": "2", 
        "text": "Wert 2"
    },{
        "value": "3", 
        "text": "Wert 3"
    }] // oder false
}</code></pre>
                            <pre class="ctc"><code class="language-json">// Optional das setzen ohne Text
{
    "multiSelect": [2,3]    // false für Leer
}</code></pre>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" id="example-form-save">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-check"></i> Ausführliche Erklärung zu der Save Funktion</h4>
                    <h6 class="subtext">Hier wird mit ein paar Beispielen noch einmal genau erläutert, wie man die save-Funktion nutzen kann.</h6>
                    <pre><code class="language-js ctc">// Save mit Callback
form.save('task','file.php', function(data) {
    
    // Success Callback - Wird ausgeführt, wenn von AJAX success => true zurück kommt
    // ******************************************************************************

    // Im Argument data sind alle Daten aus der Form enthalten
    console.log(data);

    // -- ohne Return 
    // passiert nichts weiter, nur form.saved(false) wird ausgeführt

    // -- mit Return true
    // Es wird geprüft ob in message => "Hier eine Meldung" etwas drin steht. Falls nicht, wird der Default Text genommen.
    // Mit einem der beiden Texte wird ein notify.success getriggert.
    return true; 

    // -- mit Return Value
    // Der Text wird im notify.success angezeigt
    return "Ein erfolgreich Text";

}, function(error, data) {

    // Error Callback - Wird ausgeführt, wenn von AJAX success => false zurück gibt
    // oder wenn die AJAX-Abfrage fehlschlägt
    // ******************************************************************************

    // Wenn die Ajax-Abfrage fehlschlägt
    if(error == 'ajax') {

        // Dann befindet sich in den Daten der Response Text
        console.log(data);

    // Wenn von AJAX success => false zurück kommt
    } else if(error == 'custom') {
        
        // Dann befindet sich in den Daten aus dem PHP Skript (wie beim Success Callback)
        console.log(data);
    }

    // -- ohne Return 
    // passiert nichts weiter, nur form.saved(true) wird ausgeführt

    // -- mit Return true
    // Es wird geprüft ob in error => "Hier eine Fehlermeldung" etwas drin steht. Falls nicht, wird der Default Text genommen.
    // Mit einem der beiden Texte wird ein notify.error getriggert.
    return true; 

    // -- mit Return Value
    // Der Text wird im notify.error angezeigt
    return "eine Fehlermeldung";

}, {

    // Als fünfter Parameter kann ein Objekt übergeben werden
    // ACHTUNG: undefined Werte werden von AJAX standardmäßig nicht mit übertragen
    key: "value"
});
                    </code></pre>



                </div>
            </div>



        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>



</html>