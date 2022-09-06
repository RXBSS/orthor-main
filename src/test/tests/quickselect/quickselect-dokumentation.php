<?php include('01_init.php');

$_page = [
    'title' => "Quickselect Dokumentation"
];

?>
<!doctype html>

<head>
    <?php include('02_header.php'); ?>
</head>

<body data-page="quickselect">
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fas fa-book"></i> Dokumentation</h4>


                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-2">Option</th>
                                <th class="col-2">Default</th>
                                <th>Beschreibung</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>name</th>
                                <td></td>
                                <td>
                                    Hier wird der Name angegeben. Falls kein Namen angegeben wird, wird der Name aus dem Selector genommen.<br>
                                    Mit Hilfe des Namens wird dann die entsprechende Config gesucht.
                                    Wenn <code>default</code> angegeben wird, dann müssen die Werte <code>selector</code>, <code>table</code>, <code>fields</code> zwingend mit angegeben werden!
                                </td>
                            </tr>
                            <tr>
                                <th>selector</th>
                                <td></td>
                                <td>
                                    Der Selector (z.B: <code>'#my-select'</code>)
                                </td>
                            </tr>
                            <tr>
                                <th>defaultText</th>
                                <td><code>'Bitte wählen'</code></td>
                                <td>
                                    Der Text der im Select steht, wenn kein Wert ausgewählt wurde
                                </td>
                            </tr>
                            <tr>
                                <th>defaultValue</th>
                                <td><code>''</code></td>
                                <td>
                                    Der Wert der im Select steht, wenn kein Wert ausgewählt wurde
                                </td>
                            </tr>
                            <tr>
                                <th>dropdownParent</th>
                                <td><em>Form Element</em></td>
                                <td>
                                    Der dropdownParent ist eine Option von Select2. Diese wird benötigt, damit der Z-Index stimmt.
                                    Hier wird Standardmäßig das übergeordnete Form Element genommen, wenn es gefunden wird. Das fängt vermutlich 99% der Fälle ab.
                                    Man kann den Wert aber auch manuell setzen.
                                </td>
                            </tr>
                            <tr>
                                <th>onlyId</th>
                                <td><code>false</code></td>
                                <td>
                                    Manchmal kann es sinnvoll sein, dass man beim Auswählen viel Text als unterstüzung angezeigt bekommt, der ausgewählte Wert aber nur das sein soll,
                                    was man ausgewählt hat, damit es nicht so unruhig ist. Siehe Beispiel.
                                </td>
                            </tr>
                            <tr>
                                <th>closeOnSelect</th>
                                <td><code>true</code><br><code>false</code> bei multiple</td>
                                <td>
                                    Beim Auswählen soll sich Quickselect in der Regel schließen. Dies ist auch das Standard-Verhalten.
                                    Anders ist es bei Multiple. Da will man das Verhalten nicht. Das macht Quickselect auch automatisch so.
                                    Man kann diese Funktion aber auch bewusst überschreiben
                                </td>
                            </tr>
                            <tr>
                                <th>connectedSearch</th>
                                <td><code>false</code></td>
                                <td>
                                    Mit dieser Funktion kann man eine Pickliste anbinden. Diese Pickliste wird dann geöffnet wenn man F5 drückt<br>

                                    <div class="alert alert-soft-danger">
                                        Experimentell und noch nicht fertig programmiert!
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>filter</th>
                                <td><code>false</code></td>
                                <td>
                                    Ein Filter der an PHP mit übergeben wird<br>
                                    <div class="alert alert-soft-danger">
                                        Experimentell und noch nicht fertig programmiert!
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>*table</th>
                                <td><code>false</code></td>
                                <td>
                                    Die Tabelle die angesprochen werden soll.
                                </td>
                            </tr>
                            <tr>
                                <th>*fields</th>
                                <td><code>false</code></td>
                                <td>
                                    Die Felder die angesprochen werden sollen. Hier kann ein String oder ein Array angegben werden.
                                </td>
                            </tr>
                            <tr>
                                <th>*primary</th>
                                <td><code>'id'</code></td>
                                <td>
                                    Der Primary Key der angesprochen werden soll.
                                </td>
                            </tr>
                            <tr>
                                <th>*schema</th>
                                <td><code>false</code></td>
                                <td>
                                    Hiermit kann die Reihenfolge der Auslesewerte verändert werden und auch weiterer Text, bzw. HTML übergeben werden.
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    * nur wenn defailt als <strong>name</strong> gewählt wurde


                    <br><br>
                    <strong>Methoden / Events</strong>


                    <table class="table">
                        <thead>
                            <tr>
                                <th>Methode</th>
                                <th>x</th>
                                <th>x</th>
                                <th>x</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><code>on(event, cb)</code></th>
                                <td>x</td>
                                <td>x</td>
                                <td>Event Listner</td>
                            </tr>
                            <tr>
                                <th><code>setData(value, text)</code></th>
                                <td>x</td>
                                <td>x</td>
                                <td>Setzt die gewünschten Daten und triggert ein Change Event</td>
                            </tr>
                            <tr>
                                <th><code>setDataNoTrigger(value, text)</code></th>
                                <td>x</td>
                                <td>x</td>
                                <td>Setzt die gewünschten Daten und triggert kein Change Event</td>
                            </tr>
                            <tr>
                                <th><code>val()</code></th>
                                <td>x</td>
                                <td>x</td>
                                <td>Gibt den Wert zurück</td>
                            </tr>
                            <tr>
                                <th><code>reset(noTrigger)</code></th>
                                <td>x</td>
                                <td>x</td>
                                <td>Führt einen Reset durch. Kann mit und ohne Event ausgeführt werden</td>
                            </tr>
                            <tr>
                                <th><code>link(ortherList, field, name)</code></th>
                                <td>x</td>
                                <td>x</td>
                                <td>Kann benutzt werden um mehrere Quickselects miteinander zu verbinden</td>
                            </tr>
                            <tr>
                                <th><code>setFilter(field, value, name, message)</code></th>
                                <td>x</td>
                                <td>x</td>
                                <td>Kann benutzt werden um einen Filter zu setzen</td>
                            </tr>
                            <tr>
                                <th><code>clearFilter()</code></th>
                                <td>x</td>
                                <td>x</td>
                                <td>Kann benutzt werden um einen Filter zu löschen</td>
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
        // Do Something
    });
</script>

</html>