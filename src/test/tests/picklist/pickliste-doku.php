<?php include('01_init.php');

$_page = [
    'title' => "Pickliste Dokumentation",
    'breadcrumbs' => ["<a href='pickliste'><i class=\"fas fa-list\"></i> Pickliste</a>"]
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
                    <h4><i class='fas fa-book'></i> Getting Started</h4>
                    <h6 class='subtext'>Initialisieren einer Pickliste</h6>


                    <div class="accordion accordion-flush" id="accordion-picklist">

                        <!-- Item -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="accordion-heading-howto">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-body-howto" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <i class="fa-solid fa-edit"></i> Erstellen einer Pickliste
                                </button>
                            </h2>
                            <div id="accordion-body-howto" class="accordion-collapse collapse" aria-labelledby="accordion-heading-howto" data-bs-parent="#accordion-picklist">
                                <div class="accordion-body">
                                    Zum erstellen einer Pickliste legt man zunächst in dem Ordner <strong>module</strong> einen neuen Unterordner an. Der Name dieses Unterordners ist auch gleichzeitig der Name der Pickliste.
                                    über diesen Namen kann man später die Pickliste aufrufen!
                                    <br><br>
                                    In dem Ordner erstellt man dann mehrere Dateien:
                                    <ul>
                                        <li><strong>config.json</strong><br>Die wichtigste Datei in der alle Informationen enthalten sind</li>
                                        <li><strong>process.php</strong><br>Die Datei, die für die Kommunikation mit der Datenbank zuständig ist. Dafür gibt es ebenfalls eine eigene Datei.</li>
                                    </ul>

                                    Hat man dies angelegt, erstellt man mit einem einfachen JavaScript Befehl eine neue Pickliste. Hier kann man nicht nur zwischen<strong>Picklist</strong> und <strong>PicklistModal</strong>
                                    sondern auch zwischen den Typen:
                                    <br>
                                    <ul>
                                        <li><strong>single-list (Standard)</strong><br>Einfache Liste mit Suche, Filter</li>
                                        <li><strong>single-picklist</strong><br>Liste um einen Datensatz auszuwählen</li>
                                        <li><strong>multi-picklist</strong><br>Liste um mehrere Datensätze auszuwählen</li>
                                        <li><strong>simple</strong><br>Einfache Liste ohne Funktionen aktiviert</li>
                                    </ul>

                                    Bei den Typen handelt es sich aber nur um Voreinstellungen. Diese Voreinstellungen können immer noch überschrieben werden.

                                </div>
                            </div>
                        </div>

                        <!-- Item -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    <i class="fa-solid fa-cogs"></i> Konfigurationsdatei
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordion-picklist">
                                <div class="accordion-body">
                                    Die Konfiguration ist auf mehreren Ebenen möglich und werden von oben nach unten überschrieben:<br>
                                    <br>
                                    <i class="fa-solid fa-arrow-down"></i> Standard Einstellungen im Skript<br>
                                    <em><i class="fa-solid fa-arrow-down"></i> Einstellungen des jeweiligen Typs (single-pickliste, etc.)<br></em>
                                    <i class="fa-solid fa-arrow-down"></i> Einstellungen über die Config Datei<br>
                                    <i class="fa-solid fa-arrow-down"></i> Einstellungen beim Aufruf des Skripts<br>
                                    <br>
                                    = Finale Einstellungen<br><br>





                                    Aufbau der Konfigurationsdatei:
                                    <pre><code class="language-js hljs">{
// Konfiguration der Tabelle
"table": {
    
    // Name der Tabelle
    "name": "example",      
    
    // Left Joins als Text
    "joins": "LEFT JOIN `example_auswahl` exa ON exa.id = example.auswahl"        
},

// Konfiguration der Felder
"fields": {

    ...

    // Name des Feldes
    "id": {                     
        
        // Titel der in der Tabelle angezeigt wird (Pflichtfeld)
        "title": "ID",      
        
        // field = Standard DB Feld, multi-field = Mehrere DB Felder, 
        // special = PHP Skript siehe unten (optional = "field")
        // query = z.B. ein Feld, dass eine Subquery oder eine Kalkulation ausführt
        "type": "field"

        // Wenn das Feld in einer anderen Tabelle steht
        "table": "tablename",          

        // Wenn sich der Feldname von Key unterscheidet
        "field": "fieldname",          

        // Tooltip (Beschreibung) (optional = "")
        "tooltip": "Text..",    

        // Ob das Feld beim Start angezeigt werden soll (optional = false)
        "hidden": true,           

        // Ob eine Berechtigung benötigt wird (optional = false)
        "permission": false,

        // Ob das Feld suchbar sein soll (optional = true)
        "searchable": false,

        // Ob das Feld sortierbar sein soll (optional = true)
        "sortable": false,

        // Ob die Zeile formatiert werden soll (optional)
        "format": "betrag",

        // Konfiguration des formatierens (optional)
        "format-config": ["parameter1","paramter2"],

        // Hier kann ein Wert eingetragen werden, der Eingetragen wird, falls kein Wert vorhanden ist (optional)
        "default": "Leer"

    },

    ...
},



</code></pre>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    <i class="fa-solid fa-fighter-jet"></i> PHP / AJAX & Spezialfeld
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordion-picklist">
                                <div class="accordion-body">
                                    Die Kommunikation mit AJAX findet mit der process.php Datei statt. Hierfür gibt es eine eigene Klasse.
                                    Im Besten Fall muss diese Datei nur mit 3 Zeilen Code gefüllt werden: <br><br>

                                    <pre><code class="language-php hljs"> 
$dt = new Dt($_GET);
$dt->process();
$dt->output();
</code>
</pre>
                                    Es gibt die Möglichkeit Spezialfelder zu definieren. Dazu kann man die Klasse erweitern.<br><br>
                                    <pre><code class="language-php hljs"> 
// Eigene Klasse erstellen
class ExampleDt extends Dt {

    // Die Spezialfunktion überschreiben
    public function editSpecialColumn($dbResultData, $fieldname, $config) {

        // Wenn es mehrere Spezialfelder gibt, dann wird für alle die gleiche Funktion aufgerufen
        switch($fieldname) {

            // Name des Spezialfelds
            case "myfield": 

                // Custom PHP Code
                $value = date('Y-m-d',strtotime($dbResultData['dbfield']));
                break;
        }

        // Rückgabe ist wichtig, sonst wird nicht angezeigt!
        return $value;
    }
}
</code>
</pre>
                                    <br>
                                    Anschließend ruft man diese Klasse auf statt der Dt Klasse.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="accordion-heading-format">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-body-filter" aria-expanded="false" aria-controls="flush-collapseThree">
                                    <i class="fa-solid fa-filter"></i> Suche und Filtern
                                </button>
                            </h2>
                            <div id="accordion-body-filter" class="accordion-collapse collapse show" aria-labelledby="accordion-heading-filter" data-bs-parent="#accordion-picklist">
                                <div class="accordion-body">
                                    <p>
                                        Eine der wichtigesten Funktionen in einer Pickliste ist das Suchen und Filtern.<br>
                                        Hier zunächst die Begrifflichkeiten erklärt:
                                    </p>

                                    <p>
                                        <strong>Suche</strong><br>
                                        Wenn wir von der Suche sprechen, dann meinen wir damit die Volltext-Suche oberhalb der Pickliste.
                                        Die Suche wird grundsätzlich über alle Spalten in der Tabelle ausgeführt (auch versteckte), die <code>searchable:true</code> haben.
                                        Dabei wird diese Suche auf die Datenbank mit <code>LIKE</code> und als Order Suche ausgeführt:

                                    <pre><code class="language-sql ctc">/* Suchbegriff "Test" */
SELECT field1, ... FROM `mytable` WHERE (field1 LIKE '%Test%' OR field2 LIKE '%TEST%' OR ...) AND (... optional weitere ...)

/* Suchbegriffe mit Leerzeichen "Foo Bar" */
SELECT field1, ... FROM `mytable` 
    WHERE (
            field1 LIKE '%Foo%' OR field2 LIKE '%Foo%' OR ... OR
            field1 LIKE '%Bar%' OR field2 LIKE '%Bar%' OR ...
    ) AND (... optional weitere ...)</code></pre>
                                    </p>


                                    <hr>

                                    <p>
                                        <strong>Filter</strong><br>
                                        Als Filter bezeichnen wir das Suchen in einer bestimmten Spalte. Dabei gibt es jetzt zwei Unterschiede.
                                        Der eine ist ein sog. Fixed Filter. Diesen Fixed Filter kann man über das System mit vorgeben.
                                        Er wird dann immer mit angehängt. Das andere sind Spaltenfilter. Diese können dann auch dynamisch gesetzt werden.
                                        Unterschiede der beiden sind eingentlich nur, dass bei einem Reset die Spaltenfilter zurückgesetzt werden.
                                        Der Fixed Filter bleibt immer bestehen.
                                        <br>


                                    <p>
                                        Sowohl der Column Filter als auch der Fixed Filter können mit einem Objekt gefüllt werden.
                                        Für dieses Objekt gibt es eine eigene Klasse <code>new PickFilter();</code>.<br>
                                        Diese Klasse ist darauf ausgelegt, dass man schnell und einfach Filter erstellen kann.<br>
                                        <br>

                                        Initalisieren kann man den Filter auf zwei Methoden. Entweder man nutzt die Parameter 1-4 oder man übergibt alles als Objekt im Parameter 1
                                    </p>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Initalisieren eines neuen Filters</strong><br>
                                            <pre><code class="language-js ctc">// Initalisieren mit Parameter 1-4
var f1 = new PickFilter(columns, value, type, logic);

// Initalisieren einzelne Spalte
var f1 = new PickFilter(2, 'Some', '=');

// Initalisieren mehrere Spalten
var f1 = new PickFilter([1,2], 'Some', '=', 'OR')

// Oder als Objekt
var f1 = new PickFilter({
    column: [1,2],
    value: 'Some',
    type: '=',
    logic: 'OR'
});
</code></pre>
                                        </div>
                                        <div class="col-md-6">
                                        <strong>Initalisieren einer neuen Gruppe</strong><br>
                                            <pre><code class="language-js ctc">// Filtergruppe
var f1 = new PickFilter(arrayOfFilters, logic);
</code></pre>
                                        </div>
                                    </div>




                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="col-1">Parameter</th>
                                                <th class="col-5">Beschreibung</th>
                                                <th class="col-1">Typ</th>
                                                <th class="col-1">Default</th>
                                                <th>Beispiele</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>column</th>
                                                <td>
                                                    Hier kann eine oder mehrere Spalten übergeben werden. Dabei kann der Index der Spalte oder der Name der Spalte angegeben werden.
                                                    <br>Es kann immer nur entweder column oder filter angegeben werden!
                                                    <br>
                                                    <br>

                                                    <ul>
                                                        <li><strong>Es kann immer nur entweder column oder filter angegeben werden!</strong></li>
                                                        <li><strong>Bei der kurzen Schreibweise ist parameter 2 bei column=value und bei filter=logic</strong></li>
                                                    </ul>
                                                </td>
                                                <td><code>String|Array|Number</code></td>
                                                <td><code>false</code></td>
                                                <td>
                                                    <pre><code class="language-js ctc">// Kurze Schreibweise bei Column
var filter = new PickFilter(1, ['Foo','Bar'], '!=', 'OR');

// Kurze Schreibeweise bei filter (siehe unten)
var f = new Picklist([f1,f2], 'OR');
</code></pre>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>filter</th>
                                                <td>
                                                    Hier kann ein oder mehrere Filter-Objekte angegeben werden.
                                                    Bei Filter werden <code>value</code> und <code>type</code> ingnoriert.<br>
                                                    Die Logik ist so ausgelegt, dass es keine Limit gibt. Man kann also über unendliche viele Ebenen verlinken.

                                                    <br>
                                                    <br>

                                                    <ul>
                                                        <li><strong>Es kann immer nur entweder column oder filter angegeben werden!</strong></li>
                                                        <li><strong>Bei der kurzen Schreibweise ist parameter 2 bei column=value und bei filter=logic</strong></li>
                                                    </ul>

                                                </td>
                                                <td><code>false</code></td>
                                                <td><code>false</code></td>
                                                <td>
                                                    <pre><code class="language-js ctc">// Einen oder mehrere Filter definieren
var f1 = new PickFilter(1, 'Foo', '!=');
var f2 = new PickFilter(2, 'Bar');

// Filtert "1 != 'Foo' OR 2 = 'Bar'" 
var f = new Picklist([f1,f2], 'OR');
</code></pre>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>value</th>
                                                <td>
                                                    Hier kann eine oder mehrere Werte übergeben werden.
                                                    Wenn mehrere Werte übergeben werden, dann muss die Anzahl an column mit der Anzahl der Werte übereinstimmen.
                                                    Wenn nur ein Wert angegeben wird, wird dieser für alle Columns verwendet.
                                                    <br>Es kann immer nur entweder column oder filter angegeben werden!
                                                </td>
                                                <td><code>String|Array|Number</code></td>
                                                <td><code>false</code></td>
                                                <td>
                                                    <pre><code class="language-js ctc">// Filtert WHERE `column1` = "Test"
new PickFilter(1, 'Foo');

// Filtert WHERE `column1` = 'Foo' AND `column2` = 'Foo'
new PickFilter([1,2], 'Foo');

// Filtert WHERE `column1` = 'Foo' AND `column2` = 'Bar'
new PickFilter([1,2], ['Foo','Bar']);

// Wirft eine Exception
new PickFilter([1,2,3], ['Foo', 'Bar']);
</code></pre>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>type</th>
                                                <td>
                                                    Hier kann eine Reihe von Typen zum Filtern angegeben werden. Diese Entscheiden nach welcher Art gefiltert wird.
                                                    Die Groß- und Kleinschreibung spielt keine Rolle, da diese sowieso toLowerCase() normalisiert werden!
                                                    Folgende sind erlaubt:<br><br>
                                                    <ul>
                                                        <li><code>=</code> oder <code>equals</code>: Filter mit ist gleich</li>
                                                        <li><code>&lt;</code>: Kleiner als</li>
                                                        <li><code>&gt;</code>: Größer als</li>
                                                        <li><code>&lt;=</code>: Kleiner gleich</li>
                                                        <li><code>&gt;=</code>: Größer gleich</li>
                                                        <li><code>in</code>: Dafür muss Values immer ein Array sein, sonst wird eine Exception geworfen. Bei mehreren Columns wird der IN Value immer auf alle angewendet.</li>
                                                        <li><code>x%</code> oder <code>startwith</code>: Filter mit LIKE in der Query und setzt automatisch das Prozentzeichen an den Ende</li>
                                                        <li><code>%x</code> oder <code>endwith</code>: Filter mit LIKE in der Query und setzt automatisch das Prozentzeichen and das Anfang</li>
                                                        <li><code>%%</code> oder <code>equals</code>: Filter mit LIKE in der Query und setzt automatisch das Prozentzeichen vorne und Hinten</li>
                                                    </ul>

                                                </td>
                                                <td><code>String</code></td>
                                                <td><code>=</code></td>
                                                <td>
                                                    <pre><code class="language-js ctc">// `column` = 'Foo'
new PickFilter(1, 'Foo', '=');

// WHERE `column` IN ('Foo','Bar')
new PickFilter(1, ['Foo','Bar'], 'in');

// WHERE `column` LIKE '%Foo'
new PickFilter(1, 'Foo', 'endsWith');

// WHERE `column` LIKE '%Foo%'
new PickFilter(1, 'Foo', '%%');</code></pre>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>logic</th>
                                                <td>
                                                    Definiert, welche Logische Verknüpfung genommen werden soll.
                                                    Hier kann man nur zwischen <code>AND</code> und <code>OR</code> unterscheiden.<br>
                                                    Die Logik greift, wenn man mehrere Filter über den Parameter filter verknüpft oder wenn man mehrere Columns und/oder mehrere Werte angibt!
                                                </td>
                                                <td><code>String</code></td>
                                                <td><code>AND</code></td>
                                                <td>
                                                    <pre><code class="language-js ctc">// Beispiele mit Columns

// Filtert WHERE `column1` = 'Foo' AND `column2` = 'Foo'
new PickFilter([1,2], 'Foo');

// Filtert WHERE `column1` = 'Foo' OR `column2` = 'Foo'
new PickFilter([1,2], 'Foo', null, 'OR');

// Filtert WHERE `column1` = 'Foo' OR `column1` = 'Bar'
new PickFilter([1,2], ['Foo', 'Bar'], null, 'OR');

var f1 = new PickFilter(1, 'Foo');
var f2 = new PickFilter(2, 'Bar');

// new PickFilter([f1,f2], 'OR');


// --

// Mehrere Filter mit einer OR Logik verbinden
// --> Siehe Beispiel bei Filter</code></pre>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </p>

                                    <p>
                                        Wie in der Beschreibung bei <strong>filter</strong> schon beschrieben kann man hier unendliche viele verknüpfungen und tiefen bauen.
                                    </p>

                                    <pre><code class="language-js ctc">// Extremes Beispiel - vermutlich Praxisfremd aber funktioniert!

// Filter Elemente bauen
// #####################

var fA1 = new PickFilter(1, 'Hans');
var fA2 = new PickFilter(2, 90, '>');

var fB1 = new PickFilter([3,4], 'Wurst');
var fB2 = new PickFilter(1, 'Foo', '%%');

var fC1 = new PickFilter(3, ['Foo','Bar'], 'in');

var fD1 = new PickFilter(4, 'Foo', 'endsWith');

// Verbindungen bauen
// ##################

var con1 = new PickFilter(fA1,fA2);
var con2 = new PickFilter([fC1,fD1],'OR');

var con3 = new PickFilter([con1,con2]);

var con4 = new PickFilter([con3, fB1, fB2]);
</code></pre>

                                    <pre><code class="language-sql ctc">/* Ergebnis in der Query - Es werden diverse unnötige Klammern erstellt, das ist aber nicht tragisch */
WHERE
(

    /* aus con 4 */
    (

        /* aus con 3 */
        (
            /* aus con1 */
            (`example`.`column1` = 'Hans') AND (`example`.`column2` > '90')
        )
        AND 
        (   
            /* aus con2 */
            (`example`.`column3` IN ('Foo', 'Bar'))  OR (`example`.`column4` LIKE '%Foo')
        )
    )
    AND 
    (
        `example`.`column3` = 'Wurst' AND `example`.`column3` = 'Wurst'
    )
    AND 
    (
        `example`.`column1` LIKE '%Foo%'
    )
)</code></pre>

                                    <hr>
                                    <p>
                                        <strong>PHP Filter (Fixed)</strong><br>
                                        Auch in der PHP Klasse gibt es noch eine Möglichkeit einen Filter zu setzen.
                                        Dieser ist eingentlich überflüssig, bleibt aber aus Kompatibitätsgründen noch vorhanden.
                                        Manchmal kann er auch durchaus sinnvoll und einfacher sein, wenn man zum Beispiel immer nach einem festen Wert filtert.
                                        Sobald man mit einem dynamischen Wert arbeiten, sollte man dies aber über JavaScript tun!

                                    <pre><code class="language-php ctc">// Get Variable übergeben
$dt = new Dt($_GET , "lieferanten");

// Add Filter;
$dt->fixedFilter = "`adressen`.`ist_lieferant` = '1'";

// Verarbeiten
$dt->process();</code></pre>
                                    </P>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="accordion-heading-format">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-body-format" aria-expanded="false" aria-controls="flush-collapseThree">
                                    <i class="fa-solid fa-magic"></i> Formatieren
                                </button>
                            </h2>
                            <div id="accordion-body-format" class="accordion-collapse collapse" aria-labelledby="accordion-heading-format" data-bs-parent="#accordion-picklist">
                                <div class="accordion-body">
                                    Wenn der Parameter Format gesetzt wird, dann wird der Wert automatisch mit einer der genannten Funktionen formatiert.
                                    Über format-config kann ein string oder Array angegeben werden für weitere Parameter:<br><br>
                                    <pre><code class="hljs">

// Deutsches Datum
// Beispiel: 31.08.2021
date

// Deutsche Zeit
// Beispiel: 10:20
time

// Deutsches Datum und Uhrzeit
// Beispiel: 31.08.2021 10:20
datetime

// Benutzerdefinierte Zeit
// Parameter 1 = PHP Date Variablen ('Y-m-d')
// Beispiel: 2021-08-31
custom-datetime

// Wandelt in einen deutschen Betrag um
// Parameter 1 = Anzahl Nachkommastellen
// Parameter 2 = Runden Entscheidet, ob gerundete werden soll, wenn mehr Nachkommastellen da sind (Default false)
// Beispiel: 1.232,00
number

// Wandelt in einen deutschen Betrag um. Nachkommastellen werden auf 2 oder länger, gerundet
// Parameter 1 = Währungssymbol (Standard € akzeptiert auch false)
// Beispiel: 1.232,00 €
betrag

// Ja / Nein - Macht aus einer 1 oder einer 0 ein Ja bzw. Nein
// Beispiel: Ja
yes-no

// Substring - Führt immer auch einen strip_tags durch um Probleme mit HTML zu vermeiden
// Parameter 1 = Anzahl der Stellen (Standard 30)
// Parameter 2 = Mit ... oder ohne (Standard True)
// Beispiel: Lorem Ipsum, bla...
substring

// Block 
// Greift auf die Formatter API Block zurück
// Beispiel: DE12 1234 5678
block

// Trimt einen Wert (Entfernt führende und folgende Leerzeichen und Zeilenumbrüche)
// Beispiel: " Hallo " => "Hallo"
trim

// Ist dazu da die Dateigröße in Bytes in einer Sinnvollen größe darzustellen
// Parameter 1 = Anzahl der Nachkommastellen (Standard 2)
// Beispiel: 20,56 MB
bytes

// Ist dazu da nummerische Werte 0,1,2,3 durch die jeweilige Array Position zu ersetzen
// Parameter 1 = Ist das Array und wird zwangsläufig benötigt
// Beispiel: ["Wert A", "Wert B", ..] Eingabe: 1 -> Ausgabe: -> Wert B

</code>
</pre>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="accordion-heading-javascript">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-body-javascript" aria-expanded="false" aria-controls="flush-collapseThree">
                                    <i class="fa-solid fa-code"></i> JavaScript
                                </button>
                            </h2>
                            <div id="accordion-body-javascript" class="accordion-collapse collapse" aria-labelledby="accordion-heading-javascript" data-bs-parent="#accordion-picklist">
                                <div class="accordion-body">


                                    <h3>DataTables</h3>
                                    <p>
                                        Es gibt in dieser Klasse sehr viele Optionen, Event und Methoden, die hier aufgelistet sind. Dies dient dazu die Handhabung zu vereinfachen und die Funktionen zu erweitern.
                                        Man kann aber auch immer direkt auf <strong>DataTable</strong> Objekt zugreifen und alle Funktionen nutzen, die es bei <a href="https://datatables.net/" target="_blank">DataTables</a> direkt gibt.

                                    <pre><code class="language-js ctc">// Pickliste erstellen
var list = new Picklist("#example-pickliste", "example", {
    dataTableOptions: {
        order: [3, 'desc']
    }
});

// Eine Event nutzen
list.DataTable.row.add([1,2,3, ...]).draw(false);

// Eine Methode nutzen
list.DataTable.row.add([1,2,3, ...]).draw(false);</code></pre>
                                    </p>

                                    <hr>

                                    <div class="mb-3 mt-3">


                                        <h3>Events</h3>

                                        <p>
                                            Events können Standardmäßig wie folgt aufgerufen werden:
                                        </p>
                                        <pre><code class="language-js">// Event aufrufen
picklist.on('event', function(el, arg1, arg2, ...) {
    // el = Element
    // arg1, ... = Je nach Event
})</code></pre>



                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%;">Event</th>
                                                    <th style="width: 40%;">Beschreibung</th>
                                                    <th style="width: 20%;">Argumente</th>
                                                    <th>Beispiel</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>pick</th>
                                                    <td>Das Pick Event wird ausgeführt, wenn ein Datensatz ausgewählt wurde. Dies passiert standardmäßig bei allen Listen aus bei <strong>single-picklist</strong>
                                                        und <strong>multi-picklist</strong> bei einem Doppelklick oder bei Enter. Bei den Picklisten muss erst der Button zur Bestätigung (bei Modals) gedruckt werden.</td>
                                                    <td>data = Der/die gewählte/n Datensätze</td>
                                                    <td>
                                                        <pre><code class="language-js">// Event aufrufen
picklist.on('pick', function(el, data) {

})</code></pre>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>loading</th>
                                                    <td>Wird beim Start und beim Ende des Ladens getriggert.</td>
                                                    <td>isLoading = True oder False ob gelanden wird</td>
                                                    <td><em>folgt noch</em></td>
                                                </tr>
                                                <tr>
                                                    <th>key-insert</th>
                                                    <td>Wird getriggert, wenn jemand den INSERT Button klickt</td>
                                                    <td>data = Der/die gewählte/n Datensätze</td>
                                                    <td><em>folgt noch</em></td>
                                                </tr>
                                                <tr>
                                                    <th>key-delete</th>
                                                    <td>Wird getriggert, wenn jemand den ENTF Button klickt</td>
                                                    <td>data = Der/die gewählte/n Datensätze</td>
                                                    <td><em>folgt noch</em></td>
                                                </tr>
                                                <tr>
                                                    <th>key</th>
                                                    <td>Wird bei einem Tastendruck getriggert (Achtung: DataTables blockiert einige, die es selber verwendet)</td>
                                                    <td>data = Der/die gewählte/n Datensätze</td>
                                                    <td><em>folgt noch</em></td>
                                                </tr>
                                                <tr>
                                                    <th>selection<br></th>
                                                    <td><em>Nur Pickliste (single-select oder multi-select)</em><br>
                                                        Wird beim an- und abwählen getriggert
                                                    </td>
                                                    <td>selection = true oder false für an- oder abwahl</td>
                                                    <td><em>folgt noch</em></td>
                                                </tr>
                                                <tr>
                                                    <th>selected<br></th>
                                                    <td><em>Nur Pickliste (single-select oder multi-select)</em><br>
                                                        Wird nur beim Anwählen getriggert
                                                    </td>
                                                    <td>selection = true oder false für an- oder abwahl</td>
                                                    <td><em>folgt noch</em></td>
                                                </tr>
                                                <tr>
                                                    <th>deselected<br></th>
                                                    <td><em>Nur Pickliste (single-select oder multi-select)</em><br>
                                                        Wird nur beim Anwählen getriggert
                                                    </td>
                                                    <td>selection = true oder false für an- oder abwahl</td>
                                                    <td><em>folgt noch</em></td>
                                                </tr>
                                                <tr>
                                                    <th>ajax<br></th>
                                                    <td>Wird ausgeführt, wenn ein Ajax-Call fertig ist</td>
                                                    <td>data = json als Daten.</td>
                                                    <td><em>folgt noch</em></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                    <hr>



                                    <div class="mt-3 mb-3">
                                        <h3>Optionen</h3>
                                        <p>
                                            Wie in der Konfiguration schon erklärt, gibt es mehrere Optionen die mit angegeben werden können.
                                            Diese werden hier aufgelistet.<br><br>

                                            Bei dem Default Wert muss man etwas aufpassen. Dieser bezieht sich immer auf die Klasse <strong>Picklist</strong> mit dem <strong>type='single-list'</strong>.<br>
                                            Sowohl die Modal-Klasse also auch der Type führen dazu, dass es ggf. andere Standard-Werte gibt.

                                        </p>

                                        <table class="table mt-3">
                                            <thead>
                                                <tr>
                                                    <th class="col-1">Name</th>
                                                    <th class="col-4">Beschreibung</th>
                                                    <th class="col-2">Argumente</th>
                                                    <th class="col-2">Default</th>
                                                    <th class="col-3">Code Beispiel</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>type</th>
                                                    <td>Eine der wichtigesten Einstellungen. Diese Einstellungen setzt unterschiedliche Werte für verschiedenen Bereiche<br><br>
                                                        <strong>single-list (Standard):</strong>Einfache Liste mit Suche, Filter<br>
                                                        <strong>single-picklist:</strong>Liste um einen Datensatz auszuwählen<br>
                                                        <strong>multi-picklist:</strong>Liste um mehrere Datensätze auszuwählen<br>
                                                        <strong>simple:</strong>Einfache Liste ohne Funktionen aktiviert<br>
                                                    </td>
                                                    <td>String</td>
                                                    <td><code>'single-list'</code></td>
                                                    <td>
                                                        <pre><code class="language-js ctc">type: 'single-list'</code></pre>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>autoDeselect</th>
                                                    <td>
                                                        Diese Option gibt es nur bei <strong>mulit-picklist</strong>.
                                                        Hier wird das Verhalten beim Anklicken eines weiteren Feldes definiert.
                                                        Bei <strong>false</strong> wird einfach ein Feld nach dem anderen ausgewählt. Bei <strong>true</strong>
                                                        wir das vorherige Feld abgewählt und nur das neue Feld angewählt.
                                                        Mehrere Felder kann man dann nur noch mit der Shift-Taste auswählen.
                                                        <br>
                                                        Siehe <a href="pickliste-sample-6">Beispiel</a>!

                                                    </td>
                                                    <td>Boolean</td>
                                                    <td><code>true</code></td>
                                                    <td>
                                                        <pre><code class="language-js ctc">autoDeselect: false // true</code></pre>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>card</th>
                                                    <td>Ob die Pickliste in einer Card angezeigt werden soll</td>
                                                    <td>Boolean</td>
                                                    <td><code>true</code></td>
                                                    <td>
                                                        <pre><code class="language-js ctc">card: false // true</code></pre>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>config</th>
                                                    <td>Hier kann man eine zweite Config-Datei angeben. Dabei kann man einen String übergeben oder einen ein Objekt.
                                                        Der Mode Overwrite sorgt dafür, dass die erste Config-Datei ignoriert wird und nur die angegebene Config-Datei genommen wird.
                                                        Der Mode Merge führt beide zusammen und benutzt dafür einen Deep-Merge von <a href="https://api.jquery.com/jquery.extend/" target="_blank">jQuery Exetend</a>.
                                                    </td>
                                                    <td>Boolean / Object / String</td>
                                                    <td><code>false</code><br>
                                                        Mode = <code>'overwrite'</code></td>
                                                    <td>
                                                        <pre><code class="language-js ctc">// Als Object
config: {
    file: 'my-config-file.json',
    mode: 'overwrite' // oder merge
}

// Als String
config: 'my-config-file.json' // Mode defaults to 'overwrite'
</code></pre>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>fields</th>
                                                    <td>Hier kann ein Objekt angegeben werden, dass dann mit den Einstellungen aus den Konfig-Dateien gemergt wird.
                                                        Die Optionen hier haben immer Priorität.
                                                    </td>
                                                    <td>Object</td>
                                                    <td><code>{}</code></td>
                                                    <td>
                                                        <pre><code class="language-js ctc">fields: {
    beschreibung: {
        hidden: true
    }
}</code></pre>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>order</th>
                                                    <td>Steuert die Funktion von DataTable an. Vorteil ist, dass hier auch eine einfach Zahl reicht.
                                                        Wenn nur eine Zahl angegeben wird, dann wird diese Spalte mit ASC sortiert.
                                                        Wenn nichts angegeben wird, dann wird nach der zweiten Spalte sortiert. Da wir davon ausgehen, dass dort der Primäre Wert drin steht.
                                                        In Zeile 0 = Checkbox, In Zeile 1 sollte immer die ID sein und in Zeile 2 der Primäre Wert. Sollte es in der Tabelle nur 2 Spalten (0,1) geben,
                                                        dann wird nach der Spalte 1 sortiert.
                                                        <br><br>
                                                        ASC = Ascending = Aufsteigend<br>
                                                        DESC = Descending = Absteigend
                                                    </td>
                                                    <td>Number / Array</td>
                                                    <td><code>[2, 'asc']</code><br><code>[1, 'asc']</code></td>
                                                    <td>
                                                        <pre><code class="language-js ctc">// Sortiert nach der Spalte 3 (ASC)
order: 3

// Sortiert nach der Spalte 3 (DESC)
order: [3, 'desc']

// Nach Spalte 3 (ASC) und danach 5 (DESC)
order: [[3, 'asc'], [5, 'desc']]
</code></pre>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>select</th>
                                                    <td>Wenn man <code>true</code> oder <code>'single'</code> setzt, dann wird es eine Single Select.
                                                        Bei Multi eine Multi-List</td>
                                                    <td>Boolean / String</td>
                                                    <td><code>false</code></td>
                                                    <td>
                                                        <pre><code class="language-js ctc">// Boolean
select: true // false

// Als String
select: 'multi' // oder 'single'
</code></pre>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>addHandleButtons</th>
                                                    <td>
                                                        Fügt automatisch die sog. Handle Buttons ein. Dabei handet um:<br>
                                                        <ul>
                                                            <li><i class="fa-solid fa-plus"></i> Hinzufügen</li>
                                                            <li><i class="fa-solid fa-edit"></i> Bearbeiten</li>
                                                            <li><i class="fa-solid fa-trash"></i> Löschen</li>
                                                        </ul>
                                                        <br>
                                                        Dies sind die gängisten Buttons, die man für eine Pickliste benötigt und so spart man sich Zeit.


                                                    </td>
                                                    <td>Boolean / String</td>
                                                    <td><code>false</code></td>
                                                    <td>
                                                        <pre><code class="language-js ctc">// Boolean
// Hier das Skript zum Hinzufügen

// Hier das Event zum Abfangen

</code></pre>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>title</th>
                                                    <td>???</td>
                                                    <td>String</td>
                                                    <td><code>"Eine Liste"</code></td>
                                                    <td>
                                                        <pre><code class="language-js ctc">title: "Tolle Liste"</code></pre>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>pageLength</th>
                                                    <td>Anzahl der Ergebnisse die in der Liste angezeigt werden. Hier muss auch die Option "lengthMenu" berücksichtigt werden.</td>
                                                    <td>Number</td>
                                                    <td><code>20</code></td>
                                                    <td>
                                                        <pre><code class="language-js ctc">pageLength: 50</code></pre>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>lengthMenu</th>
                                                    <td>Hier kann das Length Menü angepasst werden.</td>
                                                    <td>Array of Arrays</td>
                                                    <td><code>[<br>[20, 50, 100],<br>['20 Zeilen', '50 Zeilen', '100 Zeilen']<br>]</code></td>
                                                    <td>
                                                        <pre><code class="language-js ctc">lengthMenu: false</code></pre>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>


                                    </div>

                                    <hr>

                                    <div class="mt-3 mb-3">
                                        <h3>Methoden</h3>

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Beschreibung</th>
                                                    <th>Argumente</th>
                                                    <th>Code Beispiel</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>focusSearch</th>
                                                    <td>Fokussiert die Suche. Kann auch als Option beim Start schon mitgegeben werden</td>
                                                    <td><em>keine</em></td>
                                                    <td><em>folgt noch</em></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4">
                                                        <hr>
                                                        Get Selected Funktionen. Siehe auch Beispiel: <a href="pickliste-sample-4">Get Selected</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>getSelectedSingle</th>
                                                    <td></td>
                                                    <td><em>keine</em></td>
                                                    <td><em>folgt noch</em></td>
                                                </tr>
                                                <tr>
                                                    <th>getSelectedLength</th>
                                                    <td></td>
                                                    <td><em>keine</em></td>
                                                    <td><em>folgt noch</em></td>
                                                </tr>
                                                <tr>
                                                    <th>getSelectedSingleColumn</th>
                                                    <td></td>
                                                    <td><em>keine</em></td>
                                                    <td><em>folgt noch</em></td>
                                                </tr>
                                                <tr>
                                                    <th>getSelectedColumn</th>
                                                    <td></td>
                                                    <td><em>keine</em></td>
                                                    <td><em>folgt noch</em></td>
                                                </tr>
                                                <tr>
                                                    <th>getSelectedIndex</th>
                                                    <td></td>
                                                    <td><em>keine</em></td>
                                                    <td><em>folgt noch</em></td>
                                                </tr>
                                            </tbody>



                                        </table>





                                    </div>

                                    <hr>

                                    <h3>Beispiele</h3>
                                    <p>
                                        Dieses Beispiel blendet eine leere Column aus!
                                    </p>
                                    <pre><code class="language-js ctc">var picklist1 = new Picklist('#example-pickliste-1', "example");
picklist.on('ajax', function(el, response) {
    
    var isset = false;
    var columnIndex = 0;

    // Alle Daten durchloopen    
    $.each(response.data, function(key, values) {
        if(values[columnIndex]) {
            isset = true;
            break;
        }
    });

    // Spalte ein- bzw. ausblenden!
    picklist1.DataTable.column(columnIndex).visible(isset);
});
                                    </code></pre>


                                </div>
                            </div>
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
        // Do Something
    });
</script>

</html>