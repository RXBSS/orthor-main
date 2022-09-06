<?php include('01_init.php');

$_page = [
    'title' => "Beispiel Mehrere Config Dateien",
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


            <div class="row">
                <div class="col-md-6">
                    <h3><i class="fa-solid fa-handshake"></i> Pickliste mit Merge</h3>
                    <p>
                        Dabei wird die Konfiguration mit der zweiten Datei zusammengeführt<br>
                        Beispiel: <a href="modules/picklist/example/config-merge.json" target="_blank">Config Datei</a>
                    </p>
                    <pre><code class="language-js ctc">// Picklist mit Merge Config            
var picklist1 = new Picklist('#example-pickliste-1', "example", {
    config: {
        file: 'config-merge.json',
        mode: 'merge'
    }
});</code></pre>

                    <div id="example-pickliste-1"></div>
                </div>
                <div class="col-md-6">
                    <h3><i class="fa-solid fa-handshake-alt-slash"></i> Pickliste mit Overwrite</h3>
                    <p>
                        Dabei wird die Konfiguration komplett überschrieben. Die erste Datei greift nicht mehr.<br>
                        Beispiel: <a href="modules/picklist/example/config-overwrite.json" target="_blank">Config Datei</a>
                    </p>

                    <pre><code class="language-js ctc">// Picklist mit Merge Config            
var picklist1 = new Picklist('#example-pickliste-1', "example", {
    config: {
        file: 'config-merge.json',
    }
});</code></pre>

                    



                    <div id="example-pickliste-2"></div>
                </div>
            </div>


        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {



        // Picklist
        var picklist1 = new Picklist('#example-pickliste-1', "example", {
            config: {
                file: 'config-merge.json',
                mode: 'merge'
            }
        });


        var picklist2 = new Picklist('#example-pickliste-2', "example", {
            config: {
                file: 'config-overwrite.json'
            },
        });


        picklist2.on('ajax', function(el, response) {


            var isset = false;
            var columnIndex = 4;

            console.log(response);

            // Alle Daten durchloopen    
            $.each(response.data, function(key, values) {
                if (values[columnIndex]) {
                    isset = true;
                    return false;
                }
            });

            // Spalte ein- bzw. ausblenden!
            picklist2.DataTable.column(columnIndex).visible(isset);

        });





    });
</script>

</html>