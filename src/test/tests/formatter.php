<?php include('01_init.php');

$_page = [
    'title' => "Formatter"
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
                    <h4 class="card-title"><i class="fa-solid fa-code"></i> Formatter</h4>
                    <h6 class="subtext">Die Formatter Klasse soll dabei helfen, verschiedene Werte schneller und leichter zu konvertieren!</h6>



                    Der Formatter ist eine Klasse. Er wird beim starten der App initalisiert und ist über <code>app.formatter</code> ansprechbar.<br>
                    Man kann sich aber natürlich auch eine eigene Instanz generieren!


                    <pre><code class="language-js ctc">// Eigene Instanz
var formatter = new Formatter();

// App Instanz
app.formatter.xxx</code></pre>
                    <hr>
                    <strong>Standard Funktionen</strong><br>
                    <br>

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-2">Funktion</th>
                                <th class="col-5">Beschreibung</th>
                                <th class="col-3">Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>allFormat</th>
                                <td>Wird beim Starten ausgeführt und startet den Auto-Formatter auf alle Elemente mit <code>data-format</code></td>
                                <td>
                                    <pre><code class="language-js ctc">app.formatter.allFormat();</code></pre>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <hr>
                    <strong>Verfügbare Formatierer</strong><br>
                    Diese Formatierer stehen zur Verfügung.
                    <br>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-2">Funktion</th>
                                <th class="col-5">Beschreibung</th>
                                <th class="col-1">Input</th>
                                <th class="col-1">Output</th>
                                <th class="col-3">Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>formatWaehrung</th>
                                <td>Formatiert eine Zahl zu einer Währung. Dabei werden immer mindestens zwei Nachkommastellen angehängt.
                                    Sollte es eine Float mit mehreren Nachkommastellen sein, dann werden diese behalten!</td>
                                <td>50</td>
                                <td>50,00</td>
                                <td>
                                    <pre><code class="language-js ctc">var result = app.formatter.formatWaehrung(value);</code></pre>
                                    <pre><code class="language-html ctc">data-format="Waehrung"</code></pre>
                                </td>
                            </tr>
                            <tr>
                                <th>formatTelefon</th>
                                <td>Formatiert eine Telefonnummer in ein entsprechendes Format mit Vorwahl und Leerzeichen.
                                    Dazu wird von eine Klasse von Google benutzt: <a href="https://github.com/google/libphonenumber" target="_blank"><i class="fab fa-github"></i> Github</a>
                                </td>
                                <td>0661-902530</td>
                                <td>+49 661 902530</td>
                                <td>
                                    <pre><code class="language-js ctc">var result = app.formatter.formatTelefon(value);</code></pre>
                                    <pre><code class="language-html ctc">data-format="Telefon"</code></pre>
                                </td>
                            </tr>
                            <tr>
                                <th>formatLowercase</th>
                                <td>Einfache Formatierung zu LowerCase. Sinnvoll zum Beispiel für E-Mail Adressen</td>
                                <td>Tobias.Pitzer@gmail.com</td>
                                <td>tobias.pitzer@gmail.com</td>
                                <td>
                                    <pre><code class="language-js ctc">var result = app.formatter.formatLowercase(value);</code></pre>
                                    <pre><code class="language-html ctc">data-format="Lowercase"</code></pre>
                                </td>
                            </tr>
                            <tr>
                                <th>formatUppercase</th>
                                <td>Einfache Formatierung zu Uppercase. Sinnvoll zum Beispiel für Token oder Seriennummern</td>
                                <td>afs3lkse</td>
                                <td>AFS3LKSE</td>
                                <td>
                                    <pre><code class="language-js ctc">var result = app.formatter.formatUppercase(value);</code></pre>
                                    <pre><code class="language-html ctc">data-format="Uppercase"</code></pre>
                                </td>
                            </tr>
                            <tr>
                                <th>formatStrasse</th>
                                <td>Zum Vereinheitlichen von Abkürzungen der Straße</td>
                                <td>Haimbacher Str. 24</td>
                                <td>Haimbacher Straße 24</td>
                                <td>
                                    <pre><code class="language-js ctc">var result = app.formatter.formatStrasse(value);</code></pre>
                                    <pre><code class="language-html ctc">data-format="Strasse"</code></pre>
                                </td>
                            </tr>
                            <tr>
                                <th>formatWebsite</th>
                                <td>Für die einheitliche Schreibweise für Websites. Entfernt automatisch das https:// und www. etc.</td>
                                <td>https://www.buerosystemhaus.de</td>
                                <td>buerosystemhaus.de</td>
                                <td>
                                    <pre><code class="language-js ctc">var result = app.formatter.formatWebsite(value);</code></pre>
                                    <pre><code class="language-html ctc">data-format="Website"</code></pre>
                                </td>
                            </tr>
                            <tr>
                                <th>formatLink</th>
                                <td>Für die einheitliche Schreibweise für Links. Fügt automatisch das https:// an, falls kein http:// oder https:// angegeben wurde</td>
                                <td>buerosystemhaus.de</td>
                                <td>https://buerosystemhaus.de</td>
                                <td>
                                    <pre><code class="language-js ctc">var result = app.formatter.formatLink(value);</code></pre>
                                    <pre><code class="language-html ctc">data-format="Link"</code></pre>
                                </td>
                            </tr>
                            <tr>
                                <th>formatMac</th>
                                <td>Einheitliche Schreibweise für MAC-Adressen</td>
                                <td>00fff10189e0<br>78:45:c4:26:89:4a</td>
                                <td>00-FF-F1-01-89-E0<br>78-45-C4-26-89-4A</td>
                                <td>
                                    <pre><code class="language-js ctc">var result = app.formatter.formatMac(value);</code></pre>
                                    <pre><code class="language-html ctc">data-format="Mac"</code></pre>
                                </td>
                            </tr>
                            <tr>
                                <th>formatBlock</th>
                                <td>Ein Formatter, der Dinge automatisch in Blocks unterteilt. Dieser kan zum Beispiel für IBANs genutzt werden.</td>
                                <td>DE42530601800000233072</td>
                                <td>DE42 5306 0180 0000 2330 72</td>
                                <td>
                                    <pre><code class="language-js ctc">var result = app.formatter.formatBlock(value);</code></pre>
                                    <pre><code class="language-html ctc">data-format="Block"</code></pre>
                                </td>
                            </tr>
                            <tr>
                                <th>formatTrim</th>
                                <td>Entfernt Leerzeichen vor und zwischen dem String und ist quasi die Gegen-Funktion von formatBlock.</td>
                                <td>DE42 5306 0180 0000 2330 72</td>
                                <td>DE42530601800000233072</td>
                                <td>
                                    <pre><code class="language-js ctc">var result = app.formatter.formatTrim(value);</code></pre>
                                    <pre><code class="language-html ctc">data-format="Trim"</code></pre>
                                </td>
                            </tr>
                            <tr>
                                <th>formatTime</th>
                                <td>Formatiert eine eingabe in eine Uhrzeit. Erlaubt ist 2,3,4 und 6-Stellig</td>
                                <td>22, 122, 1215</td>
                                <td>00:22, 01:22, 12:15</td>
                                <td>
                                    <pre><code class="language-js ctc">var result = app.formatter.formatTime(value);</code></pre>
                                    <pre><code class="language-html ctc">data-format="Time"</code></pre>
                                </td>
                            </tr>
                            <tr>
                                <th>formatDate</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <pre><code class="language-js ctc">var result = app.formatter.formatDate(value);</code></pre>
                                    <pre><code class="language-html ctc">data-format="Date"</code></pre>
                                </td>
                            </tr>
                        </tbody>
                    </table>











                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-paragraph"></i> Input Formatter</h4>
                    <h6 class="subtext">Dabei handelt es sich um eine Klasse zum automatischen formatieren des Inputs</h6>

                    <p>
                        Der Code wird automatisch auf jeder Seite ausgeführt. Er sucht nach allen Input-Feldern, die <code>data-format</code> im Code stehen haben.
                    </p>


                    <hr>

                    <div class="row">
                        <div class="col-md-6">

                            <p>
                                <strong>Einfaches Beispiel</strong><br>
                                Standard-Verhalten der Funktion
                            </p>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-floating">
                                        <input type="text" name="waehrung" data-format="Waehrung" class="form-control editable" placeholder="Währung" autocomplete="off">
                                        <label>Währung</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-floating">
                                        <input type="text" name="telefon" data-format="Telefon" class="form-control editable" placeholder="Telefon" autocomplete="off">
                                        <label>Telefon</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-floating">
                                        <input type="text" name="lowercase" data-format="Lowercase" class="form-control editable" placeholder="Beispiel" autocomplete="off">
                                        <label>Lowercase</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-floating">
                                        <input type="text" name="uppercase" data-format="Uppercase" class="form-control editable" placeholder="Beispiel" autocomplete="off">
                                        <label>Uppercase</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-floating">
                                        <input type="text" name="strasse" data-format="Strasse" class="form-control editable" placeholder="Beispiel" autocomplete="off">
                                        <label>Straße</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-floating">
                                        <input type="text" name="website" data-format="Website" class="form-control editable" placeholder="Website">
                                        <label>Website</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-floating">
                                        <input type="text" name="link" data-format="Link" class="form-control editable" placeholder="Link">
                                        <label>Link</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-floating">
                                        <input type="text" name="mac" data-format="Mac" class="form-control editable" placeholder="MAC">
                                        <label>MAC</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-floating">
                                        <input type="text" name="block" data-format="Block" class="form-control editable" placeholder="MAC">
                                        <label>Block</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-floating">
                                        <input type="text" name="trim" data-format="Trim" class="form-control editable" placeholder="MAC">
                                        <label>Trim</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-floating">
                                        <input type="text" name="time" data-format="Time" class="form-control editable" placeholder="Time">
                                        <label>Time</label>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>

                    <hr>

                    <br>
                    <strong>Design Anpassung</strong>
                    <p>
                        Für bestimmte Bereiche (z.B. Seriennummern) kann es sinnvoll sein, dass man nicht nur den Wert, sondern auch das aussehen formatiert.
                        Dazu gibt es die Klasse <code>.more-readable</code> die in das Input Feld hinzugefügt werden kann.
                    </p>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-floating">
                                        <input type="text" name="name" data-format="Uppercase" class="form-control more-readable editable" placeholder="Seriennummer" autocomplete="off">
                                        <label>Seriennummer</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-floating">
                                        <input type="date" name="date" class="form-control more-readable editable" placeholder="date" autocomplete="off">
                                        <label>Datum</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-html ctc"><input type="..." class="... more-readable"></code></pre>
                        </div>
                    </div>



                    <hr>


                    <p>
                        <strong>Einheiten (unit)</strong><br>
                        Mit dieser Funktion kann man deutlicher machen, um was es in Input Feldern geht oder zum Beispiel die Einheit anzeigen, in der die Input Felder sind.
                        Es handelt sich dabei um eine Funktion des <a href="form-handler">Form Handlers</a> deshalb muss dieser hier initalisiert werden, damit es funktioniert.
                        Man kann auch Icons einfügen.
                    </p>

                    <div class="row">
                        <div class="col-md-6">
                            <form id="form-unit-test">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="name" data-unit="Meter" class="form-control editable" placeholder="Seriennummer" autocomplete="off">
                                            <label>Länge</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="benutzer" data-unit="<i class='fa-solid fa-users'></i> Benutzer" class="form-control editable" placeholder="Anzahl" autocomplete="off">
                                            <label>Anzahl</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="waehrung" data-format="Waehrung" data-unit="<i class='fa-solid fa-euro'></i>" class="form-control editable" placeholder="Währung" autocomplete="off">
                                            <label>Währung</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-html ctc"><input type="..." data-unit="Meter">
<input type="..." data-unit="<i class='fa-solid fa-users'></i>"></code></pre>
                            <pre><code class="language-js ctc">var form = new Form('#my-form');</code></pre>

                        </div>
                    </div>


                    <p>
                        <strong>Klickbare Einheiten (unitaction)</strong><br>
                        Man kann die Einheitne auch anklickbar machen. Dazu muss man eine unitaction="..." hinzufügen. 
                        Die folgenden Actions sind vorbelegt: call, mail, link, copy. Alle anderen Actions triggern ein Event. Das Event wird auf den Body und auf die Form ausgeführt. 
                        Man kann diese entsprechend abfangen.
                    </p>

                    <div class="row">
                        <div class="col-md-6">
                            <form id="form-unit-test-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="telefon" data-format="Telefon" data-unit="<i class='fa-solid fa-phone'></i>" data-unitaction="call" value="0661902530" class="form-control editable" placeholder="Telefon" autocomplete="off">
                                            <label>Telefon</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="mail" data-format="Lowercase" data-unit="<i class='fa-solid fa-envelope'></i>" data-unitaction="mail" value="info@test.de" class="form-control editable" placeholder="Mail" autocomplete="off">
                                            <label>Mail</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="link" data-format="Link" data-unit="<i class='fa-solid fa-link'></i>" data-unitaction="link" value="www.buerosystemhaus.de" class="form-control editable" placeholder="Währung" autocomplete="off">
                                            <label>Link</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="clipboard" data-unit="<i class='fa-solid fa-clipboard'></i>" data-unitaction="copy" value="A0EDF2345" class="form-control editable" placeholder="Clipboard" autocomplete="off">
                                            <label>Clipboard</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="custom" data-unit="<i class='fa-solid fa-bell'></i>" data-unitaction="custom" value="Hallo Welt" class="form-control editable" placeholder="Custom" autocomplete="off">
                                            <label>Custom</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="custom" data-unit="<i class='fa-solid fa-bell'></i>" data-unitaction="custom2" value="Na du?" class="form-control editable" placeholder="Custom" autocomplete="off">
                                            <label>Custom 2</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-html ctc"><input type="..." data-unit="..." data-unitaction="..."></code></pre>
                            <pre><code class="language-js ctc">// Abfangen des Events
form.on('unitaction', function(el, action, inputValue) {
    ...
});

$('body').on('unitaction', function(el, action, inputValue) {
    ...
});

form.on('custom', function(el, inputValue) {
    ...
});

$('body').on('custom', function(el, inputValue) {
    ...
});</code></pre>

                        </div>
                    </div>




                    <hr>

                    <p>
                        <strong>Beispiel in einer Form</strong><br>
                        Jede Form die mit einem <a href="form-handler">Form Handler</a> initalisiert wurde triggert beim Schreiben in ein Feld das Event <strong>form-input</strong>.
                        Der Formatter reagiert darauf und formatiert automatisch diesen neuen Wert den er erhalten hat. Man braucht hier keine weiteren Eingaben tätigen.
                    </p>


                    <div class="row">
                        <div class="col-md-6">


                            <form id="test-format-form-1">


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="waehrung" data-format="Waehrung" data-unit="<i class='fa-solid fa-euro'></i>" class="form-control editable" placeholder="Währung" required>
                                            <label>Währung</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="telefon" data-format="Telefon" data-unit="<i class='fa-solid fa-phone'></i>" class="form-control editable" placeholder="Telefon" required>
                                            <label>Telefon</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="lowercase" data-format="Lowercase" data-unit="<i class='fa-solid fa-envelope'></i>" class="form-control editable" placeholder="Lowercase" required>
                                            <label>Lowercase</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="uppercase" data-format="Uppercase" class="form-control editable" placeholder="Uppercase" required>
                                            <label>Uppercase</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="strasse" data-format="Strasse" class="form-control editable" placeholder="Straße" required>
                                            <label>Straße</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="website" data-format="Website" class="form-control editable" placeholder="Website" required>
                                            <label>Website</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="weblink" data-format="Link" class="form-control editable" placeholder="Link" required>
                                            <label>Link</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="mac" data-format="Mac" class="form-control editable" placeholder="MAC" required>
                                            <label>MAC</label>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <br>

                                <button class="btn btn-primary" id="form-1-send">Senden</button>
                                <button type="button" class="btn btn-secondary" id="form-1-set">Set</button>
                                <button type="button" class="btn btn-secondary" id="form-1-reset">Reset</button>

                            </form>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Beispiel Set Daten
var data = {
    waehrung: 1000.1,
    telefon: "017683224749",
    lowercase: "Tobias.Pitzer@gmail.com",
    uppercase: "afs3lkse",
    strasse: "Haimbacher Str. 24",
    website: "https://www.buerosystemhaus.de",
    weblink: "buerosystemhaus.de",
    mac: "00fff10189e0",
    block: "DE42530601800000233072",
    block: " ich bins ",
};

form.setData(data);</code></pre>


                        </div>
                    </div>



                    <hr>


                    <p>
                        <strong>Sonderfall bei Währung</strong><br>
                        Wenn Daten von einer Form gesetzt werden, dann werden diese automatisch von einer JavaScript Number in ein deutsche Zahl konvertiert. Anschließend wird dann formatiert.
                        Sonst müsste man immer in der handle eine kovertierung durchführen. Tipp man allerdings per Hand ein und nutzt nur das focusout Event, dann wird keine konvertierung vorgenommen.
                    </p>

                    <div class="row">
                        <div class="col-md-6">
                            <form id="test-format-form-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="waehrung" data-format="Waehrung" class="form-control editable" placeholder="Währung" required>
                                            <label>Währung</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="text" class="form-control editable" placeholder="Text" required>
                                            <label>Textfeld</label>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <button type="button" class="btn btn-secondary" id="form-2-set">Set</button>

                            </form>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Beispiel Set Daten
var data = {
    waehrung: 1000.1,
    text: 1000.1,
};

form.setData(data);</code></pre>

                            <div class="alert alert-soft-info">
                                <strong>Hinweis</strong><br>
                                Die Daten müssen beim Speichern in die Datenbank auch wieder zurück konvertiert werden. Dazu gibt es in der <a href="request">Request API</a> die den Wert <strong>["n", "field"]</strong>.

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

        var uForm = new Form('#form-unit-test');
        var uForm2 = new Form('#form-unit-test-2');

        uForm2.on('unitaction', function(el, action, inputValue) {
            alert('Custom Event\nAktion: ' + action + "\nWert: " + inputValue);
        });

        // Form
        var form = new Form('#test-format-form-1');

        // Land
        var fields = {
            waehrung: {
                validators: {
                    numeric: {
                        message: 'Kein gültiger Wert',
                        thousandsSeparator: '.',
                        decimalSeparator: ',',
                    },
                },
            },
            telefon: {
                validators: {
                    phone: {
                        country: 'DE',
                        message: 'Keine gültige Telefonnummer',
                    },
                },
            },
        }

        form.initValidation(fields);


        var data = {
            waehrung: 1000.1,
            telefon: "017683224749",
            lowercase: "Tobias.Pitzer@gmail.com",
            uppercase: "afs3lkse",
            strasse: "Haimbacher Str. 24",
            website: "https://www.buerosystemhaus.de",
            weblink: "buerosystemhaus.de",
            mac: "00fff10189e0",
            block: "DE42530601800000233072",
            block: " ich bins ",
        };


        $('#form-1-set').on('click', function() {
            form.setData(data);
        });

        $('#form-1-reset').on('click', function() {
            form.reset(0);
        });




        var form2 = new Form('#test-format-form-2');

        form2.initValidation();

        var data2 = {
            waehrung: 1000.1,
            text: 1000.1,
        };



        $('#form-2-set').on('click', function() {
            form2.setData(data2);
        });

        $('#form-2-reset').on('click', function() {
            form2.reset(0);
        });
    });
</script>

</html>