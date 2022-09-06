<?php include('01_init.php');

$_page = [
    'title' => "Pickliste Filter",
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



            Eine vollständige Doku gibt es <a href="pickliste-doku">hier</a> in dem Bereich <strong>Suche und Filtern</strong>.
            Hier sollen mehr die Praktischen Ansätze und Code-Snippets gezeigt werden.

            <br><br>



            <div class="row">
                <div class="col-md-6">
                    <strong>Dynamische Filter</strong><br>
                    Setzen des Filters dynamisch mit der Funktion <strong>setFilter</strong><br>
                    <br>

                    <button id="example-1" class="btn btn-primary">Filter setzen</button>
                    <button class="btn btn-danger example-3">Filter Löschen</button>
                    <br>
                    <br>
                    <pre><code class="language-js ctc">// Definieren eines Filter
var filter1 = new PickFilter('id', 8);

// Setzen des Filters
picklist.setFilter(filter1);</code></pre>

                    <hr>
                    Setzen mehrer Filter von Extern<br>
                    <br>
                    <button id="example-2" class="btn btn-primary">Filter setzen</button>
                    <button class="btn btn-danger example-3">Filter Löschen</button>
                    <br>
                    <br>
                    <pre><code class="language-js ctc">// Definieren eines Filter
var filter1 = new PickFilter('id', 8, '>');
var filter2 = new PickFilter('betrag', 500, '>');

// Setzen des Filters
picklist.setFilter([filter1, filter2], "OR");</code></pre>






                </div>
                <div class="col-md-6">
                    <div id="pickliste-demo-1"></div>
                </div>
            </div>


            <hr>

            <div class="row">
                <div class="col-md-6">
                    <strong>Filter beim Start</strong><br>
                    Schon beim Start kann man eine Filter mitgeben. Für diesen Filter kann man dann auch einstellen, ob er der Standard-Filter ist oder nur einmalig bei Laden gesetzt werden sollte.



                    <pre><code class="language-js ctc">var pickliste = new Picklist("#pickliste", "example", {
    pageLength: 10,
    filter: new PickFilter('id', 8, '<')
});</code></pre>



                </div>
                <div class="col-md-6">

                    <nav>
                        <div class="nav nav-tabs" id="tab-nav-example-2">
                            <button class="nav-link active" id="tab-nav-example-2-1" data-bs-toggle="tab" data-bs-target="#tab-content-example-2-1" type="button">Ohne Standard</button>
                            <button class="nav-link" id="tab-nav-example-2-2" data-bs-toggle="tab" data-bs-target="#tab-content-example-2-2" type="button">Mit Standard</button>
                        </div>
                    </nav>
                    <br>
                    <div class="tab-content" id="tab-content-example-2">
                        <div class="tab-pane show active" id="tab-content-example-2-1">
                            <div id="pickliste-demo-2-a"></div>
                        </div>
                        <div class="tab-pane" id="tab-content-example-2-2">
                            <div id="pickliste-demo-2-b"></div>
                        </div>
                    </div>


                </div>
            </div>

            <hr>


            <div class="row">
                <div class="col-md-6">

                    <strong>Feste Filter (Fixed-Filter)</strong><br>
                    Es gibt zwei Wege, wie man feste Filter vergeben kann. Ein Weg ist über PHP direkt in der Klasse.<br><br>

                    <pre><code class="language-php ctc">// Get Variable übergeben
$dt = new Dt($_GET , "lieferanten");

// Add Filter;
$dt->fixedFilter = "`adressen`.`ist_lieferant` = '1'";

// Verarbeiten
$dt->process();</code></pre>

                    Der andere Weg geht beim initalisieren über JavaScript. Selbst ein Reset kann diesen Filter nicht zurücksetzen.<br><br>

                    <pre><code class="language-js ctc">var pickliste = new Picklist("#pickliste", "example", {
    fixFilter: new PickFilter('id', 8, '<')
});</code></pre>

                </div>
                <div class="col-md-6">
                    <div id="pickliste-demo-3"></div>
                </div>
            </div>


            <hr>

            <div class="row">

                <div class="col-md-6">
                    Beispiel Filter beim Start geöffnet<br><br>
                    <pre><code class="language-js ctc">var pickliste = new Picklist("#pickliste", "example", {
    pageLength: 10,
    showFilterOnStart: true
});</code></pre>
                </div>
                <div class="col-md-6">
                    <div id="pickliste-demo-4"></div>
                </div>
            </div>










        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {


        // Demo 1
        // -----------------------

        // Pickliste      
        var pickliste1 = new Picklist("#pickliste-demo-1", "example", {
            debug: false,
            pageLength: 10,
            showFilterOnStart: true
        });


        $('#example-1').on('click', function() {
            var filter1 = new PickFilter('id', 8);
            pickliste1.setFilter(filter1);
        });

        $('#example-2').on('click', function() {
            var filter1 = new PickFilter('id', 8, '>');
            var filter2 = new PickFilter('betrag', 500, '>');
            pickliste1.setFilter(new PickFilter([filter1, filter2], "OR"));
        });

        $('.example-3').on('click', function() {
            pickliste1.resetFilter();
        });


        // Demo 2
        // -----------------------

        var pickliste2 = new Picklist("#pickliste-demo-2-a", "example", {
            debug: true,
            pageLength: 10,
            filter: new PickFilter('id', 8, '<')
        });

        var pickliste2 = new Picklist("#pickliste-demo-2-b", "example", {
            debug: false,
            pageLength: 10,
            filter: new PickFilter('id', 8, '<')
        });

        // Demo 3
        // -----------------------

        var pickliste3 = new Picklist("#pickliste-demo-3", "example", {
            debug: false,
            pageLength: 10,
            fixFilter: new PickFilter('id', 8, '<')
        });

        // Demo 4
        // -----------------------

        var pickliste3 = new Picklist("#pickliste-demo-4", "example", {
            debug: false,
            pageLength: 10,
            showFilterOnStart: true
        });






        //         
        // var pickliste1 = new Picklist("#pickliste-demo-1", "example", {
        //     debug: false,

        //     /*
        //     dataTableOptions: {
        //         order: [[5, "asc"]]
        //     }
        //     */

        //     // fixFilter: new PickFilter(2, "Titel K"),

        //     pageLength: 10,
        //     order: [
        //         [5, "asc"],
        //         [2, "asc"]
        //     ],
        //     showFilterOnStart: true
        // });



    });
</script>

</html>