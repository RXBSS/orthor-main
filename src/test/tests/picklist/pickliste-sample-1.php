<?php include('01_init.php');

$_page = [
    'title' => "Pickliste Öffnungszeiten",
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


            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-book"></i> Beispiel Öffnungszeiten</h4>
                    <h6 class="subtext">Das ist ein Beispiel für die Pickliste</h6>


                    <hr>

                    <div class="row">
                        <div class="col-md-8">

                            <p>
                                Zunächst Konfigurieren wir die Tabelle relativ einfach.
                                Mit type = simple blenden wir die Suchfunktionen.
                                Wir erhalten jetzt eine einfache Tabelle mit den Öffnungszeiten<br>
                                <a href="modules/picklist/oeffnungszeiten/config.json" target="_blank">Siehe vollständige Konfiguration</a>
                            </p>

                            <pre><code class="language-js ctc">var pickliste1 = new Picklist("#picklist-1", "oeffnungszeiten", {
    card: false,
    type: 'simple',
    pagination: false,
});</code></pre>
                        </div>
                        <div class="col-md-4">
                            <h3><i class="fa-solid fa-clock"></i> Öffnungszeiten</h3>
                            <div id="picklist-1"></div>

                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-8">

                            <p>
                                Nun könnten wir schon die Felder formatieren, aber nur bis zu einem bestimmten grad.<br>
                                Felder die wir nicht brauchen, können wir mit "hidden": true ausblenden<br>
                                <a href="modules/picklist/oeffnungszeiten/config-1.json" target="_blank">Siehe vollständige Konfiguration</a>
                            </p>

                            <pre><code class="language-json ctc">...
"id": {
    "title": "ID",
    "hidden": true
},
"tag": {
    "title": "Tag"
},
"offen": {
    "title": "Offen",
    "format": "yes-no"
},
"von1": {
    "title": "Von1",
    "format": "time"
},
...</code></pre>
                        </div>
                        <div class="col-md-4">
                            <h3><i class="fa-solid fa-clock"></i> Öffnungszeiten</h3>
                            <div id="picklist-2"></div>

                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-8">

                            <p>
                                Nun können wir das ganze via PHP etwas schöner gestalten. Dazu legen wir in der Conig Spezialfelder an und blenden die anderen Felder aus.
                                <br>
                                <a href="modules/picklist/oeffnungszeiten/config-2.json" target="_blank">Siehe vollständige Konfiguration</a>
                            </p>

                            <pre><code class="language-php ctc">// Die Picklist Klasse erweitern
class OeffnungszeitenPicklist extends Picklist {
    public function editSpecialColumn($row, $field, $defs) {

        // Standard definieren, falls nichts zutrifft
        $result = "";

        switch ($field) {

            // Tage als Mo, Di, ... Ausgeben
            case "tag2":
                $tage = [null, "Mo", "Di", "Mi", "Do", "Fr", "Sa", "So"];
                $result = $tage[$row['_tag']];
                break;

            // Kombination aus Von1 und Bis1 anzeigen oder geschlossen
            case "zeit1":
                if ($row['_offen'] == 1) {
                    $result = substr($row['_von1'], 0, 5) . " - " . substr($row['_bis1'], 0, 5);

                    // Wenn zweite Öffnungszeiten vorhanden sind
                    if ($row['_von2']) {
                        $result .= " | ".substr($row['_von2'], 0, 5) . " - " . substr($row['_bis2'], 0, 5);
                    }
                } else {
                    $result = "Geschlossen";
                }
                break;
        }

        // Den aktuellen Tag in Fett-Buchstaben ausgeben
        return ($result && date('N') == $row['_tag']) ? &quot;&lt;strong&gt;&quot;.$result.&quot;&lt;/strong&gt;&quot; : $result;
    }
}</code></pre>
                        </div>
                        <div class="col-md-4">
                            <h3><i class="fa-solid fa-clock"></i> Öffnungszeiten</h3>
                            <div id="picklist-3"></div>

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

        var pickliste1 = new Picklist("#picklist-1", "oeffnungszeiten", {
            card: false,
            type: 'simple',
            pagination: false,
        });

        var pickliste2 = new Picklist("#picklist-2", "oeffnungszeiten", {
            config: 'config-1.json',
            card: false,
            type: 'simple',
            pagination: false
        });

        var pickliste3 = new Picklist("#picklist-3", "oeffnungszeiten", {
            config: 'config-2.json',
            card: false,
            type: 'simple',
            pagination: false
        });

    });
</script>

</html>