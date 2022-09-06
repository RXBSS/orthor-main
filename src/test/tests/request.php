<?php include('01_init.php');

$_page = [
    'title' => "Request"
];

$req = new Request();

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
                    <h4 class="card-title"><i class="fa-solid fa-bullhorn"></i> Request API</h4>
                    <h6 class="subtext">Die Request API soll bei der Vereinfachung der Datenbank-Abfragen dienen.</h6>


                    <pre><code class="language-php ctc">// Ohne Daten
$req = new Request();

// Request mit Daten
$req = new Request($post);
</code></pre>


                    <hr>
                    <div class="row">

                        <div class="col-md-4">
                            <strong>sanitize($array)</strong><br>
                            Befehl zum Bereinigen eines Arrays um es in die Datenbank einzufügen.
                            Siehe dazu auch <code>$db->real_escape_string</code>

                        </div>
                        <div class="col-md-4">

                            <pre><code class="hljs language-php ctc"> <?php
                                    $post = [
                                        "some" => "Data with ' and \ and .."
                                    ];

                                    $sanitizedData = $req->sanitize($post);

                                    print_r($sanitizedData);
                                    ?>
                                </code>
                            </pre>
                        </div>
                        <div class="col-md-4">
                            <pre><code class="hljs language-php ctc">$post = [
    "some" => "Data with ' and \ and .."
];

$sanitizedData = $req->sanitize($post);

print_r($sanitizedData);</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-md-4">
                            <strong>setData($array)</strong><br>
                            Setzt die Basis der Daten. Andere Funktionen greifen dann auf diese Basis zu.
                            Kann man theoretisch auch mit <code>$req->data = $data</code> machen.

                        </div>
                        <div class="col-md-4">

                            <pre><code class="hljs language-php ctc"><?php
                                    $post = [
                                        "some" => "Data with ' and \ and .."
                                    ];

                                    $sanitizedData = $req->sanitize($post);

                                    print_r($sanitizedData);
                                    ?>
                                    </code>
                            </pre>
                        </div>
                        <div class="col-md-4">
                            <pre><code class="hljs language-php ctc">$post = [
    "some" => "Data with ' and \ and .."
];

$sanitizedData = $req->sanitize($post);

print_r($sanitizedData);</code></pre>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <strong>insert($table, $array) - (Vereinfachung der Insert Query)</strong> <br><br>
                            <table class="table">
                                <tr>
                                    <td> <code>$table</code> </td>
                                    <td> Gibt den Namen der Datenbanktabelle in dem Parameter mit. <br>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>$array</code></td>
                                    <td>Mit dem <strong><i>$array</i></strong> - Parameter gibt man die Daten an die in einem bestimmen Format übergeben werden können. <br>
                                        Dafür können die <strong>$post Data</strong> Namen überschrieben werden, wenn sie anders heißen als in der Datenbank und/oder auch ein bestimmtes Dateiformat angegeben werden.
                                        <br> z.B. wie folgt:  <i class="fa-solid fa-level-down-alt fa-lg"></i>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-8">
                            <pre><code class="hljs language-php ctc">$req->insert("tablename", $array)</code></pre>
                        </div>

                        <div class="col-md-4">
                            <p>

                                <br> <br>
                                <table class="table">
                                    <tr>
                                        <td><code>value[0]</code></td>
                                        <td>Um welche Art von Inputfeld handelt es sich. Möglichkeiten: <br>
                                            <table class="table">
                                                <tr>
                                                    <td> <code>"c"</code> </td>
                                                    <td> checkbox | Nimmt den Wert checked und überträgt ihn als 1 oder 0 in die Datenbank                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><code>"dt"</code></td>
                                                    <td>datetime | Konvertiert den Eingabe-Wert in Datum, dass die Datenbank versteht</td>
                                                </tr>
                                                <tr>
                                                    <td><code>"t"</code></td>
                                                    <td>text | Keine Änderungen</td>
                                                </tr>
                                                <tr>
                                                    <td><code>"n"</code></td>
                                                    <td>number | Konvertiert den Wert von einer deutschen Zahl in eine Float</td>
                                                </tr>
                                                <tr>
                                                    <td><code>"s"</code></td>
                                                    <td>select | Nimmt automatisch den value aus dem Array</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><code>value[1]</code></td>
                                        <td>Name des Feldes, die aus der $_POST Data kommen sollten</td>
                                    </tr>
                                    <tr>
                                        <td><code>value[2]</code></td>
                                        <td>Wenn der Name des Feldes nicht dem gleichen Spalte in der Datenbank handel, kann man den Feldnamen überschreieben und passend gemacht werden.</td>
                                    </tr>
                                    <tr>
                                        <td><code>value[3]</code></td>
                                        <td>Es kann ein Wert mitgegeben werden, der als Value in dem Feld stehen sollte. <br>

                                            Wenn das Value leer ist kann man auch Standardmäßig <strong><mark><i>'NULL'</i></mark></strong> mitgeben. <br><strong><mark><i>siehe $array (ganz rechts)</i></mark></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><code>value[4]</code></td>
                                        <td>Es kann ein bestimmtes Datenbankformat mitgegeben werden z.B. <strong><mark><i>date</i></mark></strong> oder <strong><mark><i>time</i></mark></strong> <br> <strong><mark><i>siehe $array (ganz rechts)</i></mark></strong></td>
                                    </tr>
                                    <tr>
                                        <td><code>value[5]</code></td>
                                        <td>Wenn ein Zeitstempel in einem "komischen" Format ist, kann man das Format angeben in dem es geschrieben werden soll.
                                            z.B.<br> 
                                            <strong><mark><i>Y-M-D H-I-S</i></mark></strong> <br>
                                            <strong><mark><i>siehe $array (ganz rechts)</i></mark></strong>
                                        </td>
                                    </tr>
                                </table>
                            </p>
                        </div>
                        <div class="col-md-4">

                        <pre><code class="hljs language-php ctc"> // Daten
$post = [
    "checkbox1" => [
        "value" => "foo", 
        "checked" => true
    ],
    "checkbox2" => [
        "value" => "bar", 
        "checked" => false
    ],
    "datum1" => "1980-07-31",
    "datum2" => "",
    "datum3" => "31082021 083000",
    "datum4" => "31.08.2021 08:30:00",
    "datum5" => "31.08.2021 08:30:00",
    "datum6" => "31.08.2021 08:30:00",
    "text1" => "BMW",
    "text2" => "",
    "nummber"=> "1.023,02",
    "select1" => [
        "value" => "12",
        "text" => "Some Wert"
    ],
    "select2" => false,
    "time1" => "09:50",
    "time2" => false
];</code></pre>

                        </div>
                        <div class="col-md-4">
                            <pre><code class="hljs language-php ctc">// Verarbeitungsarray
$array = [
    ["c","checkbox1","custom_cb1", 'NULL'],
    ["c","checkbox2","custom_cb2", 'NULL'],
    ["t","datum1"],
    ["t","datum2"],
    ["dt","datum3", "custom_date", null, "date", "dmY His"],
    ["dt","datum4", "custom_date2", null],
    ["dt","datum5", "custom_date3", null, "time"],
    ["dt","datum6", "custom_date4", null, "Y-M-D H-I-S"],
    ["t","text1","auto"],
    ["t","text2","hersteller","1000"],
    ["n","nummber"],
    ["s","select1"],
    ["s","select2"],
    ["dt","time1", "custom_time", null, "time"],
    ["dt","time2", "custom_time2", null, "time"],
];</code></pre>
                            
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">

                            <strong>update($table, $array, $where) - (Vereinfachung der Update Query)</strong> <br><br>

                            <table class="table">
                                <tr>
                                    <td> <code>$table</code> </td>
                                    <td> <strong><mark><i>siehe $array (ganz rechts)</i></mark></strong> <br>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>$array</code></td>
                                    <td><strong><mark><i>siehe $array (ganz rechts)</i></mark></strong></td>
                                </tr>
                                <tr>
                                    <td><code>$where</code></td>
                                    <td>Mit dieser Funktion kann man eine weitere <strong><mark><i>where</i></mark></strong> Klausel angeben, die sich an die Query automatisch ranhängt.  </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">

                            <br><br>
                            <pre><code class="hljs language-php ctc"> $req->update("tablename", $array, "WHERE `id` = '1234'");</code></pre>
                        </div>
                    </div>

                    <hr>

                    <div class="row">

                        <strong>hasDuplicate($table, $fields, $value, $ignoreId = false)</strong> <br><br>

                        
                        <div class="col-md-6">

                            <p>Eine Funktion zur Duplettenprüfung ob es dieses Datenbankfeld schon gibt. <br>
                            Wenn es das Feld schon gibt, kann die Query nicht ausgeführt werden.
                            </p> <br>
                            <table class="table">
                                <tr>
                                    <td> <code>$table</code> </td>
                                    <td> Gibt den Namen der Datenbanktabelle in dem Parameter mit. <br></td>
                                </tr>
                                <tr>
                                    <td><code>$fields</code></td>
                                    <td> Hiermit gibt man den Namen des Datenbankfeldes mit.
                                    </td>
                                </tr>
                                <tr>
                                    <td> <code>$value</code> </td>
                                    <td> Hiermit gibt man den Wert mit auf den eine Duplettenprüfung ausgeführt werden soll. <br>
                                        Wenn es diesen Wert gibt, wird die Query nicht ausgeführt
                                    </td>
                                </tr>
                                <tr>
                                    <td> <code>$ignoreId = false</code> </td>
                                    <td> <strong><mark><i>Default = false</i></mark></strong> <br>
                                        Verhindert das ein Wert sich selber findet. <br>
                                        z.B. bei edit kann das Feld nicht überschrieben werden, weil es findet sich selber
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">

                        <pre><code class="hljs language-php ctc">//Duplettenprüfung
if(!$req->hasDuplicate($this->table, "bezeichnung", $data["bezeichnung"])) {
    // Do Something (QUERY)
}
                        </code></pre>
                            

                        
                        </div>


                    </div>

                    <hr>

                    <div class="row">
                        <strong>answer($customData = false)</strong> 
                        <p>Eine gültiges JSON was man als Antwort zurückbekommen können</p>   

                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td> <code>$customData = false</code> </td>
                                    <td> <strong><mark><i>Defaut = false</i></mark></strong> <br>
                                        Man kann die Daten die zurückgegeben werden sollen, selber angeben. Zur weiteren Verarbeitung
                                    </td>
                                </tr>
                            </table>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="hljs language-php ctc">$req->answer($array)</code></pre>

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