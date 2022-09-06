<?php include('01_init.php');

$_page = [
    'title' => "Sidebar"
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
                    <h4 class="card-title"><i class="fa-solid fa-bars"></i> Sidebar</h4>
                    <h6 class="subtext">Für die Sidebars gibt es eine JS-Klasse zum erstellen von einer oder mehrer Sidebars</h6>




                    <br>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            Neue Sidebar erstellen. Als Name wird die ID der Sidebar angegeben. Man kann selber das Template schon anlegen.
                            Wenn kein Template gefunden wird, dann wird dieses automatisch angelegt.
                            <br>
                            name = Der Name der Sidebar, wird sonst automatisch generiert<br>
                            width = Breite in Pixel (Number)<br>
                            noClose = Entscheidet ob es einen Schließen Button gibt Default false<br>
                            clickToClose = Wenn true, dann wird die Sidebar über einen Klick geschlossen Default falses
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">var somebar = new Sidebar({
    name: 'some-name',
    width: 400,
    clickToClose: true, // Wenn man Weg klickt
    noClose: true // Zeigt keinen Schließen Button
});</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-secondary btn-test-oeffnen">Öffnen (1)</button>
                            <button class="btn btn-secondary btn-test-oeffnen2">Öffnen (2)</button>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">somebar.open();</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-secondary btn-test-schliessen">Schließen (1)</button>
                            <button class="btn btn-secondary btn-test-schliessen2">Schließen (2)</button>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">somebar.close();</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            Ajax Load mit Öffnen Event<br>
                            <button class="btn btn-secondary btn-test-oeffnen3 mt-1">Öffnen</button>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">somebar.on('open', function() {
    somebar.setLoading();

    app.simpleRequest("task", "file", "data", function(response) {
        somebar.setHtml(response.data);
    });
});</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            Timeline in Verbindung mit Sidebar
                            <br>
                            <button class="btn btn-secondary btn-test-oeffnen4 mt-1">Öffnen</button>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">somebar.on('open', function() {

    somebar.setLoading();

    app.simpleRequest("task", "file", "data", function(response) {
        var timeline = new Timeline(somebar4.getEl());
        timeline.setData(dataSet);
        timeline.render();
    });
});</code></pre>
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


        var somebar = new Sidebar();

        somebar.setHtml('Bar 1');

        $('.btn-test-oeffnen').on('click', function() {
            somebar.open();
        });

        $('.btn-test-schliessen').on('click', function() {
            somebar.close();
        });


        var somebar2 = new Sidebar({
            width: 500,
            clickToClose: true
        });

        somebar2.setHtml('Bar 2');

        $('.btn-test-oeffnen2').on('click', function() {
            somebar2.open();
        });

        $('.btn-test-schliessen2').on('click', function() {
            somebar2.close();
        });


        var somebar3 = new Sidebar({
            clickToClose: true
        });


        $('.btn-test-oeffnen3').on('click', function() {
            somebar3.open();
        });

        // 
        somebar3.on('open', function() {
            somebar3.setLoading();

            setTimeout(function() {
                somebar3.setHtml('Hier kommt der AJAX Content!');
            }, 3000);
        });

        var somebar4 = new Sidebar({
            clickToClose: true,
            width: 350
        });

        $('.btn-test-oeffnen4').on('click', function() {
            somebar4.open();
        });


        // Beispiel Datensatz
        var dataSet = [{
                'timestamp': '2021-05-06 10:20:00',
                'icon': 'fa fa-check',
                'content': 'Das ist der Inhalt'
            },
            {
                'timestamp': '2021-05-06 10:20:00',
                'icon': 'fa fa-check',
                'content': 'Das ist der Inhalt'
            },
            {
                'timestamp': '2021-05-06 10:20:00',
                'icon': 'fa fa-check',
                'content': 'Das ist der Inhalt'
            },
            {
                'timestamp': '2021-05-06 10:20:00',
                'icon': 'fa fa-check',
                'content': 'Das ist der Inhalt'
            }
        ];

        // 
        somebar4.on('open', function() {

            somebar4.setLoading();

            setTimeout(function() {

                var timeline = new Timeline(somebar4.getEl());
                timeline.setData(dataSet);
                timeline.render();

            }, 3000);
        });

    });
</script>

</html>