<?php include('01_init.php');

$_page = [
    'title' => "Galerie"
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
                    <h4 class="card-title"><i class="fa-solid fa-photo-film"></i> Galerie</h4>
                    <h6 class="subtext">Dabei handelt es sich um ein Plugin zum Anzeigen von Bildern und Dateien</h6>
            

                    <hr>
                    <strong>Beispiel - Bilder Galerie</strong>

                    <div class="row">
                        <div class="col-md-6">
                            <div id="example-galerie-1"></div>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Daten
var data = [{
    name: 'Doggo',
    thumbUrl: 'https://picsum.photos/id/237/500/200',
    imageUrl: 'https://picsum.photos/id/237/1920/1080'
}, {
    name: 'City',
    imageUrl: 'https://picsum.photos/id/238/500/400'
}, ... ];

// Galerie Erstellen
var galerie = new Galerie('#example-galerie');

</code></pre>
                        </div>
                    </div>




                    <hr>
                    <strong>Beispiel - Bilder Galerie mit Dateien</strong>

                    <hr>
                    <strong>Komplette Lösung</strong><br>




                </div>
            </div>

        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {
        

        var dataset1 = [{
            name: 'Doggo',
            thumbUrl: 'https://picsum.photos/id/237/500/200',
            imageUrl: 'https://picsum.photos/id/237/1920/1080'
        }, {
            name: 'City',
            imageUrl: 'https://picsum.photos/id/238/500/400'
        }, {
            name: 'Flower',
            class: 'galerie-marked',
            imageUrl: 'https://picsum.photos/id/239/500/200'
        }, {
            name: 'Stairs',
            imageUrl: 'https://picsum.photos/id/240/500/300'
        }, {
            name: 'Landscape',
            imageUrl: 'https://picsum.photos/id/241/500/200'
        }, {
            name: 'Train',
            imageUrl: 'https://picsum.photos/id/242/500/200'
        }, {
            name: 'Forest',
            imageUrl: 'https://picsum.photos/id/243/500/200'
        }];


        // Beispiel 1
        var galerie1 = new Galerie('#example-galerie-1', dataset1);

    });
</script>
</html>