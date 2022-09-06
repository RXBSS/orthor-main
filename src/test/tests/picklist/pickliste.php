<?php include('01_init.php');

$_page = [
    'title' => '<i class="fa-solid fa-list"></i> Pickliste'
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
                    <div class='card'>
                        <div class='card-body'>
                            <h4><i class='fas fa-list'></i> Pickliste</h4>
                            <h6 class='subtext'>Eine Programmierung von Listen basierend auf <a href="datatables.php">DataTables</a>!</h6>

                            <p>
                                Die Tabellen bzw. sog. Picklisten sind mit die wichstigesten Werkzeuge in einem ERP-System.<br>
                                Sie müssen folgenden Anforderungen unterstützen:<br>
                            <ul>
                                <li>Performance</li>
                                <li>Übersicht</li>
                                <li>Suche</li>
                                <li>Filter</li>
                                <li>Erweiterbar</li>
                                <li>Auswahl</li>
                            </ul>

                            Es gibt auch eine extra Klasse mit der Erweiterung um ein Modal.<br>
                            Eine weitere Besonderheit sind die Einstellungen, die mitgegeben werden können. Hierfür gibt es in den Einstellungen.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class='card'>
                        <div class='card-body'>
                            <h4><i class='fas fa-book'></i> Dokumentation</h4>

                            <h6 class='subtext'>Die vollständige Dokumentation findet sich auf der Unterseite. Hier nur eine kurze Erklärung zur Initaliserung.</h6>

                            <pre><code class="language-javascript">// Erstellen einer Pickliste
var list = new Picklist("#example-pickliste", "example", {...});</code></pre>
                            <pre><code class="language-javascript">// Erstellen einer Pickliste als Modal
var list = new PicklistModal("example", {...});</code></pre>
                            <a href="pickliste-doku" class="btn btn-primary"><i class="fa-solid fa-book"></i> Dokumentation</a><br>
                            <br>
                            <p>Weitere Beispiele </p>
                            <a href="pickliste-sample-1" class="btn btn-secondary mb-3"><i class="fa-solid fa-clock"></i> Öffnungszeiten</a>
                            <a href="pickliste-sample-2" class="btn btn-secondary mb-3"><i class="fa-solid fa-handshake"></i> Mehrere Config Dateien</a>
                            <a href="pickliste-sample-3" class="btn btn-secondary mb-3"><i class="fa-solid fa-filter"></i> Filter</a>
                            <a href="pickliste-sample-4" class="btn btn-secondary mb-3"><i class="fa-solid fa-check"></i> Get Selected</a>
                            <a href="pickliste-sample-5" class="btn btn-secondary mb-3"><i class="fa-solid fa-search"></i> Suchhilfe</a>
                            <a href="pickliste-sample-6" class="btn btn-secondary mb-3"><i class="fa-solid fa-toggle-on"></i> Auto Deselect</a>
                            <a href="pickliste-sample-7" class="btn btn-secondary mb-3"><i class="fa-solid fa-ban"></i> Disabled</a>
                            <a href="pickliste-sample-8" class="btn btn-secondary mb-3"><i class="fa-solid fa-text-slash"></i> Readonly</a>
                        </div>
                    </div>

                </div>
            </div>



            <hr>

            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fas fa-book-open'></i> Modal Picklisten</h4>
                    <h6 class='subtext'>Die nachfolgenden Picklisten öffnen sich alle in einem Modal</h6>

                    <br>


                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary" id="picklist5-open"><i class="fa-solid fa-external-link-square-alt"></i> Single List</button>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">var picklist = new PicklistModal("example");</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary" id="picklist6-open"><i class="fa-solid fa-external-link-square-alt"></i> Single Picklist</button>
                        </div>
                        <div class="col-md-6">
                        <pre><code class="language-js ctc">var picklist = new PicklistModal("example", {
    type: 'single-picklist',
});</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary" id="picklist9-open"><i class="fa-solid fa-external-link-square-alt"></i> Quick Pick</button>
                        </div>
                        <div class="col-md-6">
                        <pre><code class="language-js ctc">var picklist = new PicklistModal("example", {
    type: 'single-picklist',
    quickPick: true
});</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary" id="picklist7-open"><i class="fa-solid fa-external-link-square-alt"></i> Multi Picklist</button>
                        </div>
                        <div class="col-md-6">
                        <pre><code class="language-js ctc">var picklist = new PicklistModal("example", {
    type: 'multi-picklist',
});</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary" id="picklist8-open"><i class="fa-solid fa-external-link-square-alt"></i> Simple</button>
                        </div>
                        <div class="col-md-6">
                        <pre><code class="language-js ctc">var picklist = new PicklistModal("example", {
    type: 'simple',
});</code></pre>
                        </div>
                    </div>










                </div>
            </div>




            <hr>


            <p><i class="fa-solid fa-arrow-down"></i> single-list</p>
            <div id="example-pickliste-1"></div>

            <p><i class="fa-solid fa-arrow-down"></i> single-picklist</p>
            <div id="example-pickliste-2"></div>


            <p><i class="fa-solid fa-arrow-down"></i> multi-picklist</p>
            <div id="example-pickliste-3"></div>

            <p><i class="fa-solid fa-arrow-down"></i> simple</p>
            <div id="example-pickliste-4"></div>



        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="fab-container">
         <button class="btn btn-primary btn-something-add"><i class="fa-solid fa-plus"></i></button>
    </div>


</body>

<?php include('04_scripts.php'); ?>

<script>
    // App Ready
    $(document).on('app:ready', function() {

        var picklist1 = new Picklist('#example-pickliste-1', "example", {
            // type: 'single-picklist'
        });

        var picklist2 = new Picklist('#example-pickliste-2', "example", {
            type: 'single-picklist',
            searchFocus: false
        });

        picklist2.on('select', function(a, b, c) {

            console.log(a);
            console.log(b);
            console.log(c);
            app.notify.success.fire("Event Fired", "Es wurde etwas angewählt!");
        });




        var picklist3 = new Picklist('#example-pickliste-3', "example", {
            type: 'multi-picklist',
            searchFocus: false
        });

        var picklist4 = new Picklist('#example-pickliste-4', "example", {
            type: 'simple'
        });



        // Modal Picklists
        var picklist5 = new PicklistModal("example", {

        });


        $('#picklist5-open').on('click', function() {
            picklist5.open();
        });




        var picklist6 = new PicklistModal("example", {
            type: 'single-picklist',
            addButtons: [{
                action: 'test',
                icon: 'fas fa-check',
                pos: 11
            }],
            // submitButton: false
        });

        $('#picklist6-open').on('click', function() {
            picklist6.open();
        });

        picklist6.on('selected', function(el, data) {
            console.log('Event: Selected');
            // console.log(data);
        });

        picklist6.on('deselected', function(el, data) {
            console.log('Event: Deselected');
            // console.log(data);
        });

        picklist6.on('selection', function(el, data) {
            console.log('Event: Selection');
            // console.log(data);
        });


        picklist6.on('pick', function(el, data) {
            console.log('Event: Pick');
            app.notify.success.fire("Zeile gewählt", "Es wurde die ID <strong>" + data[1] + "</strong> mit dem Titel <strong>" + data[2] + "</strong> gewählt!");

        });



        var picklist7 = new PicklistModal("example", {
            type: 'multi-picklist'
        });

        picklist7.on('pick', function(el, data) {
            console.log('Event: Pick');
            console.log(data);
            app.notify.success.fire("Zeile gewählt", "Es wurden <strong>" + Object.keys(data).length + "</strong> Datensätze gewählt!");

        });

        $('#picklist7-open').on('click', function() {
            picklist7.open();
        });

        var picklist8 = new PicklistModal("example", {
            type: 'simple'
        });

        $('#picklist8-open').on('click', function() {
            picklist8.open();
        });

        var picklist9 = new PicklistModal("example", {
            type: 'single-picklist',
            quickPick: true
        });

        picklist9.on('pick', function(el, data) {
            console.log('Event: Pick');
            app.notify.success.fire("Zeile gewählt", "Es wurde die ID <strong>" + data[1] + "</strong> mit dem Titel <strong>" + data[2] + "</strong> gewählt!");

        });

        $('#picklist9-open').on('click', function() {
            picklist9.open();
        });


        app.waitForPicklists([picklist1,picklist2,picklist3,picklist4,picklist5,picklist6,picklist7,picklist8,picklist9], function() {
            console.log('All Picklists are Ready');
        });



    });
</script>

</html>