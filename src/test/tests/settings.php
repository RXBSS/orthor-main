<?php include('01_init.php');

$_page = [
    'title' => "Einstellungen"
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


            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-cogs"></i> Einstellungen / Berechtigung</h4>
                            <h6 class="subtext">Hier wird die Einstellungs- und Berechtigungs-API von Orthor erklärt
                            </h6>

                            <p>
                                Für die Einstellungen gibt es eine Tabelle in der Datenbank. Dort werder grundlegend
                                erstmal alle Einstellungen abgespeichert.
                                Es wird dann in globale Einstellungen (Allgemeine gültige) und Benutzereinstellungen
                                unterschieden.<br>
                                <br>
                                Mit Hilfe der verschiedenen Funktionen kann man diese Einstellungen dann auslesen.
                                Die Einstellungen für den Benutzer werden in einer Spalte in der Benutzer-Tabelle
                                abgespeichert.
                                Sie werden dann mit den Einstellungen aus der Datenbank gemergt. So muss man nur die
                                Einstellungen abspeichern beim Benutzer, die man haben möchte.
                                <br>
                                In dem System ist außerdem ein Cache mechanismus integriert. Es werden die
                                Benutzereinstellungen gecacht.
                                Man kann mit <code>clearCache</code> oder dem Öffnen einer neuen Einstellungen
                                <code>new Setting</code> dafür sorgen, dass der Cache geleert wird.
                                Die Speicherfunktionen leeren den Cache in der Regel automatisch mit.
                                Hier ist es explizit wichtig das ganze für den aktuell angemeldeten Benutzer zu
                                berücksichtigen. Dort ist der Cache am wichtigesten, da er die meiste Performance spart.
                                (Alleine in der Navigation wird x Mal die Berechtigung abgefragt). Hier ist es aber auch entscheidend, dass der Cache in der Session auch entsprechend gelöscht wird.
                            </p>
                            <hr>




                            <p>
                                <strong>Übersicht über die Datenbank</strong><br>
                                Hier werden kurz die Spalten in der Datenbank beschrieben.
                            </p>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Aufgabe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>1</th>
                                        <td>id</td>
                                        <td>Die ID der Einstellung. Ist das Ausschalgebende Kriterium.</td>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <td>name</td>
                                        <td>Der Name der Einstellung. Kann als Ersatz für die ID genutzt werden. Muss
                                            ebenfalls eindeutig sein.</td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <td>beschreibung</td>
                                        <td>Eine Beschreibung um die Übersicht über die einzelnen Einstellungen zu
                                            behalten.</td>
                                    </tr>
                                    <tr>
                                        <th>4</th>
                                        <td>berechtigung</td>
                                        <td>Kann 0 oder 1 sein. Gibt an ob es sich bei dieser Einstellung um eine
                                            Berechtigung handelt. </td>
                                    </tr>
                                    <tr>
                                        <th>5</th>
                                        <td>global</td>
                                        <td>Beschreibt ob es sich um eine Globale oder eine Benutzereinstellung handelt.
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>6</th>
                                        <td>adminWert</td>
                                        <td>Gibt an, welchen Wert der Admin an dieser Stelle haben soll. Wenn bei einer
                                            Berechtigung NULL angegeben wird, erhält er
                                            automatisch 1 (true). Wenn bei einer Einstellung NULL angegeben wird, dann
                                            erhält auch der Admin den Standard Wert.
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>7</th>
                                        <td>binLenght</td>
                                        <td>Wenn das Feld gefüllt ist, dann handelt es sich um einen Binären Wert. Werte
                                            dürfen dann nur noch aus Zahlen bestehen.
                                            Diese werden dann in ein Array umgerechnet (Siehe rechte Seite).
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>8</th>
                                        <td>standard</td>
                                        <td>
                                            Dieses Feld enthält den Standard-Wert. Bei globalen Einstellungen wird
                                            dieser in den Wert geschrieben, falls der Wert leer ist.
                                            Bei Berechtigung wird automatisch 0 als Standardwert genommen, falls im Wert
                                            nichts eingetragen ist.
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>9</th>
                                        <td>wert</td>
                                        <td>
                                            Hier wird nur bei Globalen Einstellungen ein Wert eingetragen. Diese Feld
                                            wird dann (nicht in der Datenbank sondern im Skript) mit dem eigentlichen
                                            Wert gefüllt.
                                            Hier entscheidet die Logik, ob ein Admin-Wert, Standard Wert, User Wert,
                                            etc. hinterlegt.
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Die Spalte in der Benutzer-Datenbank</th>
                                    </tr>
                                    <tr>
                                        <th>x</th>
                                        <td>einstellungen</td>
                                        <td>
                                            In dieser Spalte werden die Benutzereinstellungen abgespeichert. Diese
                                            werden als Key->Value Pairs mit der Syntax
                                            <code>Key1:Value1;Key2:Value2;...</code>
                                            abgespeichert. Semikolon und Doppelpunkt werden in ~?~ und ~!~ umgewandelt.
                                            Man benutzt dafür die Funktionen <code>decodeUserString</code> und
                                            <code>encodeUserString</code>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>



                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-flag"></i> Beispiele</h4>
                            <h6 class="subtext">Beispiele zum Ändern der Einstellungen</h6>

                            <form id="einstellungen-example">


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-floating">
                                            <input type="text" name="setting1" class="form-control editable" placeholder="Einstellung Text (Global)" autocomplete="off">
                                            <label>Einstellung Text (Global)</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-floating">
                                            <input type="text" name="setting2" class="form-control editable" placeholder="Einstellung Text (Benutzer)" autocomplete="off">
                                            <label>Einstellung Text (Benutzer)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group form-floating-check">
                                            <label class="form-label">Checkbox</label>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input editable" id="setting3" name="setting3" value="1" />
                                                <label class="form-check-label" for="setting3">Ja</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-check form-floating-check">
                                            <label class="form-label">Checkbox Linebreak</label>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input editable" id="setting4" name="setting4" value="1" />
                                                <label class="form-check-label" for="setting4">Ja</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-floating-radio">
                                            <label class="form-label">Einstellung Radio</label><br>
                                            <div class="form-radio form-check-inline">
                                                <input class="form-check-input editable" type="radio" id="cb-settings5-1" name="settings5" value="value1">
                                                <label class="form-check-label" for="cb-settings5-1">Wert 1</label>
                                            </div>
                                            <div class="form-radio form-check-inline">
                                                <input class="form-check-input editable" type="radio" id="cb-settings5-2" name="settings5" value="value2">
                                                <label class="form-check-label" for="cb-settings5-2">Wert 2</label>
                                            </div>
                                            <div class="form-radio form-check-inline">
                                                <input class="form-check-input editable" type="radio" id="cb-settings5-3" name="settings5" value="value3">
                                                <label class="form-check-label" for="cb-settings5-3">Wert 3</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p>
                                    <br>
                                    <strong>Binär abspeichern</strong><br>
                                    Das nachfolgende wurde als eine Einstellung abgespeichert. Diese wird als
                                    Dezimalwert in der Datenbank gespeichert und beim auslesen entsprechend konvertiert!
                                </p>

                                <div class="form-group form-floating-check">
                                    <label class="form-label">Wochentage</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="wochentag-1" name="wochentage[]" value="1" />
                                        <label class="form-check-label" for="wochentag-1">Montag</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="wochentag-2" name="wochentage[]" value="1" />
                                        <label class="form-check-label" for="wochentag-2">Dienstag</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="wochentag-3" name="wochentage[]" value="1" />
                                        <label class="form-check-label" for="wochentag-3">Mittwoch</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="wochentag-4" name="wochentage[]" value="1" />
                                        <label class="form-check-label" for="wochentag-4">Donnerstag</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="wochentag-5" name="wochentage[]" value="1" />
                                        <label class="form-check-label" for="wochentag-5">Freitag</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="wochentag-6" name="wochentage[]" value="1" />
                                        <label class="form-check-label" for="wochentag-6">Samstag</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="wochentag-7" name="wochentage[]" value="1" />
                                        <label class="form-check-label" for="wochentag-7">Sonntag</label>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-code"></i> Code</h4>
                            <h6 class="subtext">Test Programmierung</h6>

                            <pre>
<?php

/*
$s = new Settings();

// 
$res = $s->checkAndRedirect(2, 'test', false, 4);

if($res) {
    echo "Ja";
} else {
    echo "Nein";
}


$s = new Settings();
$s->checkAndRedirect(2, 'description', false, 4);

*/
?>  
                            </pre>
                        </div>
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-info-circle"></i> Begriffserklärung</h4>
                            <h6 class="subtext">Im folgenden eine genauere Definition der Begriffe</h6>

                            <p>
                                <strong>Einstellungen</strong><br>
                                Einstellung markiert den Überbegriff über alles, was folgt. Diese Unterteilt sich in
                                weitere Bereiche.
                            </p>

                            <p>
                                <strong>Berechtigung</strong><br>
                                In vielen Dinge ähnelt eine Berechtigung einer Einstellung. Sie wird pro Benutzer/Gruppe
                                angegeben.<br>
                                Grundsätzlich ist aber zu sagen, dass der Wert 0 = Keine Berechtigung heißt.
                                Korrespondierend kann es sein, dass der Wert 1 dann eben heißt, dass es Berechtigung
                                gibt.
                                Dies ist aber keine Pflichtvoraussetzung. Es kann zum Beispiel auch sein, dass es 1 =
                                Teilberechtigung und 2 = Volle Berechtigung gibt.
                            </p>

                            <p>
                                <strong>Globale / Benutzer</strong><br>
                                Grundsätzlich unterscheidet man bei Einstellungen immer zwischen Globalen und
                                Benutzereinstellungen.
                                Eine globale Einstellung gilt in der Regel für das System. Das heißt, alle Benutzer
                                haben den gleichen Wert, wenn Sie eingeloggt sind.
                                Bei einer Benutzereinstellung, kann jeder Benutzer einen unterschiedlichen Wert habe.
                                Für das Speichern der Daten heißt das auch, dass die globalen Werte in der Tabelle
                                <code>Einstellungen</code> gespeichert werden und
                                die Benutzereinstellungen direkt bei dem Benutzer
                            </p>

                            <p>
                                <strong>Standardwerte</strong><br>
                                Zum Abspeichern der Werte zu einem Benutzer wird ein neuer Eintrag abgelegt. Damit man
                                nicht zu jedem Benutzer alle Einstellungen abspeichern muss,
                                gibt es Standardwerte. Wenn bei einem Benutzer (oder Gruppe) zu einem Schlüssel kein
                                Wert hinterlegt ist, dann wird dieser Standardwert genommen.
                            </p>

                            <p>
                                <strong>Gruppen</strong><br>
                            <div class="alert alert-danger">In Planung und noch nicht umgesetzt</div>
                            In Gruppen kann man ebenfalls Einstellungen hinterlegen. Bevor die Standardwerte aus der
                            Tabelle der Einstellungen greifen, würden dann die Gruppenwerte greifen.
                            </p>

                            <p>
                                <strong>Admin-Wert</strong><br>
                                In der Datenbank gibt es auch eine Spalte für Admin-Werte. Sollte ein Benutzer ein
                                Administrator sein, ist dort geregelt, welchen Wert er erhält.
                            </p>
                            <p>
                                <strong>Hirachie</strong><br>
                                Die Werte werden also überschrieben/gesetzt, je nach dem ob Sie vorhanden sind. Dabei
                                gilt folgende Reihenfolge:<br>
                                Benutzerwert -> Admin-Wert -> Gruppenwert -> Standardwert
                            </p>
                            <p>
                                <strong>Binäre Werte</strong><br>
                                Es besteht die Möglichkeit Binäre Werte abzuspeichern. Die Binären Werte werden dann zu
                                einem Array aufgelöst:<br>
                                Damit man auch führende 0en erfasst, muss man immer auch eine Binäre Lenge angeben
                                (Anzahl der Bits). In dem Beispiel sind es 8 Bit.<br>
                                128 = Array[1,0,0,0,0,0,0,0];<br>
                                51 = Array[0,0,1,1,0,0,1,1];<br>


                            </p>
                        </div>
                    </div>



                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-book"></i> Dokumentation</h4>
                    <h6 class="subtext">Hier sind die Funktionen dokumentiert</h6>

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-4">Name</th>
                                <th>Beschreibung</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th colspan="2">Get-Funktionen</th>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getAll();</code></pre>
                                </td>
                                <td>Gibt alle Einstellungen zurück</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getAllGlobal();</code></pre>
                                </td>
                                <td>Gibt alle globalen Einstellungen zurück</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getAllUser($userId);</code></pre>
                                </td>
                                <td>Gibt das Einstellungsarray für einen Benutzer zurück</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getCurrentUser();</code></pre>
                                </td>
                                <td>Gibt das Einstellungsarray für den aktuellen Benutzer zurück</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getAllUserRaw($userId);</code></pre>
                                </td>
                                <td>Gibt die Benutzereinstellungen aus der Datenbank zurück, so wie Sie in der Datenbank stehen. Sie sind noch nicht mit dem Einstellungsarray abgeglichen.</td>
                            </tr>    
                            <!-- Get By Key -->                        
                            <tr>
                                <th colspan="2">Get-Funktionen -  By Key</th>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getByKey($key);</code></pre>
                                </td>
                                <td>Gibt die Einstellungen für einen Key zurück. Wenn er Global ist, dann für den Globalen ansonsten für den angemeldeten Benutzer</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getGlobalByKey($key);</code></pre>
                                </td>
                                <td>Gibt die Einstellungen für einen bestimmten globalen Key zurück</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getUserByKey($key, $userId);</code></pre>
                                </td>
                                <td>Gibt die Einstellungen für einen bestimmten User und einen bestimmten Key
                                    zurück</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getCurrentUserByKey($key);</code></pre>
                                </td>
                                <td>gleiche wie oben nur mit dem aktuell eingeloggtem Benutzer</td>
                            </tr>
                            
                            <!-- Get by Only Vlaue -->
                            <tr>
                                <th colspan="2">Get-Funktionen - By Key Only Value</th>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getValueByKey($key);</code></pre>
                                </td>
                                <td>Gibt die Einstellungen für einen Key zurück. Wenn er Global ist, dann für den Globalen ansonsten für den angemeldeten Benutzer</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getGlobalValueByKey($key);</code></pre>
                                </td>
                                <td>Gibt nur den Wert für die Einstellungen für einen bestimmten globalen Key
                                    zurück</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getUserValueByKey($key, $userId);</code></pre>
                                </td>
                                <td>Gibt nur den Wert für die Einstellungen für einen bestimmten User und einen
                                    bestimmten Key zurück</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getCurrentUserValueByKey($key, $userId);</code></pre>
                                </td>
                                <td>gleiche wie oben nur mit dem aktuell eingeloggtem Benutzer</td>
                            </tr>
                            <tr>
                                <th colspan="2">Get-Funktionen - By Key Only Dec Value</th>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getDecValueByKey($key);</code></pre>
                                </td>
                                <td>Gibt die Einstellungen für einen Key zurück. Wenn er Global ist, dann für den Globalen ansonsten für den angemeldeten Benutzer</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getGlobalDecValueByKey($key);</code></pre>
                                </td>
                                <td>Gibt nur den Wert für die Einstellungen für einen bestimmten globalen Key
                                    zurück</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getUserDecValueByKey($key, $userId);</code></pre>
                                </td>
                                <td>Gibt nur den Wert für die Einstellungen für einen bestimmten User und einen
                                    bestimmten Key zurück</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->getCurrentUserDecValueByKey($key, $userId);</code></pre>
                                </td>
                                <td>gleiche wie oben nur mit dem aktuell eingeloggtem Benutzer</td>
                            </tr>
                            <tr>
                                <th colspan="2">Check-Funktionen</th>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->checkGlobal($key, $value = 1);</code></pre>
                                </td>
                                <td>Prüft einen Key und gibt nur <code>true</code> oder <code>false</code>
                                    zurück.
                                    Wenn es sich um einen binären Code handelt, dann wird mit einem Dezimalwert
                                    abgeglichen.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->checkUser($key, $userId, $value = 1);</code></pre>
                                </td>

                                <td>Prüft einen Key und gibt nur <code>true</code> oder <code>false</code>
                                    zurück. .
                                    Wenn es sich um einen binären Code handelt, dann wird mit einem Dezimalwert
                                    abgeglichen.</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->checkCurrentUser($key, $value = 1);</code></pre>
                                </td>

                                <td>gleiche wie oben nur mit aktuellen Benutzer</td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->checkAndRedirectUser($key, $url, $userId, $value = 1);</code></pre>
                                </td>
                                <td>
                                    Wenn bei der $userId = false drin steht, dann wird automatisch gegen einen
                                    globalen Wert gefragt.
                                    Ansonsten wird gegen den User-Wert gefragt.
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <pre><code class="language-php ctc">$app->settings->checkAndRedirectCurrentUser($key, $url, $value = 1);</code></pre>
                                </td>
                                <td>
                                    gleiche wie oben nur mit aktuellen Benutzer
                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>

        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {

        // Form erstellen
        var form = new CardForm('#einstellungen-example');

    });
</script>

</html>