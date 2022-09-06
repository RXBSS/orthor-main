<?php include('01_init.php');

// Gibt es auf jeder Seite
$_page = [
    'title' => "Hotkeys"
];

?>
<!doctype html>

<!-- Head -->

<head>
    <?php include('02_header.php'); ?>
</head>


<!-- Body -->

<body>
    <?php include('03_navigation.php'); ?>

    <div class="wrapper">
        <div class="container-fluid">


            <div class='card'>
                <div class='card-body'>
                    <h4><i class="fa-solid fa-keyboard"></i> Hotkeys</h4>

                    <h6 class='subtext'>Hier wird ein Plugin namens <a href="https://github.com/jaywcjlove/hotkeys">hotkeys.js</a> verwendet.</h6>

                    <br>
                    <p>
                        <strong>Einfacher Tasten Abfangen</strong><br>
                        Man kann jeden Buchstaben auf der Tastatur abfangen.
                    <pre><code class="language-javascript ctc">hotkeys('g', function(event, handler){
    app.alert.info.fire('Tastendruck', 'Du hast g gedrückt!');
});</code></pre>

                    </p>
                    <hr>
                    <p>
                        <strong>Sonderfunktionen</strong><br>
                        Man kann sogar Sonderfunktionen wie F5 abfangen.<br>Das <strong>event.preventDefault();</strong> bewirkt, dass die Funktion nicht weiter ausgeführt wird
                    <pre><code class="language-javascript ctc">hotkeys('f5', function(event, handler){
    event.preventDefault() 
    app.alert.info.fire('Tastendruck', 'Du hast F5 gedrückt!');
});</code></pre>

                    </p>
                    <hr>
                    <p>
                        <strong>Tastenkombinationen</strong><br>
                        Es ist auch Möglich Tastenkombinationen abzufangen
                    <pre><code class="language-javascript ctc">hotkeys('ctrl+i', function(event, handler){
    app.alert.info.fire('Tastendruck', 'Du hast STRG und i gedrückt!');
});</code></pre>

                    </p>
                    <hr>
                    <p>
                        <strong>Mehrere Gleichzeitig</strong><br>
                        Es ist auch mehrere Gleichzeitig abzufangen
                    <pre><code class="language-javascript ctc">hotkeys('ctrl+a,ctrl+s,ctrl+l', function(event, handler){
    app.alert.info.fire('Tastendruck', 'Du hast STRG eine der drei Tastenkombinationen gedrückt!');
});</code></pre>

                    </p>
                    <hr>
                    <p>
                        <strong>Nur in Input</strong><br>
                        Man kann auch die Tastenkombinationen auf einen Input beschränken!
                    <div style="border: 1px solid black; padding: 20px; max-width: 200px;">
                        <label for="">Input</label>
                        <input type="text" name="test" id="example" class="form-control" value="Hier ist ein Text">
                    </div>
                    <br>

                    <pre><code class="language-javascript ctc">hotkeys('ctrl+b', function(event, handler) {
    var tagName = (event.target || event.srcElement).tagName;
    if(tagName == 'INPUT') {
        app.alert.info.fire('Tastendruck', 'Ich wurde im Input gedrückt');
    }     
});</code></pre>

                    </p>


                </div>
            </div>
        </div>








    </div>
    </div>


</body>

<?php include('04_scripts.php'); ?>

<script>
    hotkeys('g', function(event, handler) {
        app.alert.info.fire('Tastendruck', 'Du hast g gedrückt!');
    });

    hotkeys('f5', function(event, handler) {
        event.preventDefault();
        app.alert.info.fire('Tastendruck', 'Du hast F5 gedrückt!');
    });

    hotkeys('ctrl+i', function(event, handler) {
        app.alert.info.fire('Tastendruck', 'Du hast STRG und i gedrückt!');
    });

    hotkeys('ctrl+a,ctrl+s,ctrl+l', function(event, handler) {
        event.preventDefault();
        app.alert.info.fire('Tastendruck', 'Du hast STRG eine der drei Tastenkombinationen gedrückt!');
    });


   

    hotkeys('ctrl+b', function(event, handler) {
        var tagName = (event.target || event.srcElement).tagName;
        if(tagName == 'INPUT') {
            app.alert.info.fire('Tastendruck', 'Ich wurde im Input gedrückt');
        }     
    });
</script>


</html>