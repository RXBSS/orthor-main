<?php include('01_init.php');

$_page = [
    'title' => "Notification"
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
                    <h4 class="card-title"><i class="fa-solid fa-bullhorn"></i> Nofifications</h4>
                    <h6 class="subtext">Als Notifications werden die Icons in der oberen Navigationsleiste bezeichnet</h6>



                    <!-- Dokumemntation -->
                    <p>Dokumentation folgt noch. Einfach den Code dieser Seite vorerst nutzen</p>

                    <hr>

                    <!-- Erstellen -->
                    <div class="row">
                        <div class="col-md-6"><button class="btn-beispiel-erstellen btn btn-secondary">Erstellen</button></div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">var notification = new Notification({
    icon: "fas fa-plus"
});</code></pre>
                        </div>
                    </div>

                    <hr>

                    <!-- Erstellen -->
                    <div class="row">
                        <div class="col-md-6"><button class="btn-beispiel-show btn btn-secondary">Show</button></div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">notification.show();</code></pre>
                        </div>
                    </div>

                    <hr>

                    <!-- Hide -->
                    <div class="row">
                        <div class="col-md-6"><button class="btn-beispiel-hide btn btn-secondary">Hide</button></div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">notification.hide();</code></pre>
                        </div>
                    </div>

                    <hr>

                    <!-- Destroy -->
                    <div class="row">
                        <div class="col-md-6"><button class="btn-beispiel-loeschen btn btn-danger">Zerstören</button></div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">notification.destroy();</code></pre>
                        </div>
                    </div>

                    <hr>

                    <!-- Set Status -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-floating-radio">
                                <label class="form-label">Icon</label><br>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-icon-1" name="icon" value="fas fa-history" checked>
                                    <label class="form-check-label" for="cb-icon-1"><i class="fa-solid fa-history"></i></label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-icon-2" name="icon" value="fas fa-clock">
                                    <label class="form-check-label" for="cb-icon-2"><i class="fa-solid fa-clock"></i></label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-icon-3" name="icon" value="fas fa-calendar-alt">
                                    <label class="form-check-label" for="cb-icon-3"><i class="fa-solid fa-calendar-alt"></i></label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-icon-3" name="icon" value="fas fa-bomb">
                                    <label class="form-check-label" for="cb-icon-3"><i class="fa-solid fa-bomb"></i></label>
                                </div>
                            </div>

                            <div class="form-group form-floating-radio">
                                <label class="form-label">Farbe</label><br>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-farbe-1" name="farbe" value="success" checked>
                                    <label class="form-check-label" for="cb-farbe-1">Success</label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-farbe-2" name="farbe" value="warning">
                                    <label class="form-check-label" for="cb-farbe-2">Warning</label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-farbe-3" name="farbe" value="danger">
                                    <label class="form-check-label" for="cb-farbe-3">Danger</label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-farbe-4" name="farbe" value="info">
                                    <label class="form-check-label" for="cb-farbe-4">Info</label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-farbe-5" name="farbe" value="light">
                                    <label class="form-check-label" for="cb-farbe-5">Light</label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-farbe-6" name="farbe" value="dark">
                                    <label class="form-check-label" for="cb-farbe-6">Dark</label>
                                </div>

                            </div>
                            <div class="form-group form-floating-radio">
                                <label class="form-label">Leuchten</label><br>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-blink-1" name="blink" value="static" checked>
                                    <label class="form-check-label" for="cb-blink-1">Dauerhaft</label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-blink-2" name="blink" value="true">
                                    <label class="form-check-label" for="cb-blink-2">Langsam</label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input editable" type="radio" id="cb-blink-3" name="blink" value="fast">
                                    <label class="form-check-label" for="cb-blink-3">Schnell</label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">var obj = {
    icon: 'fas fa-history', // Icon Class Name
    color: 'success', // all Button colors (success, danger, ...)
    blink: 'static' // slow (or true), fast, static
}              

notification.change(obj);</code></pre>
                        </div>
                    </div>


                    <hr>

                    <!-- Event -->
                    <div class="row">
                        <div class="col-md-6">Klick Event</div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">notification.on('click', function() {
    app.notify.success.fire("Titel","Inhalt");
});</code></pre>
                        </div>
                    </div>

                    <hr>

                    <!-- Sidebar -->
                    <div class="row">
                        <div class="col-md-6">Der Action Button kann zusammen mit Sidebar verknüpft werden.<br>
                            <button class="btn btn-primary mt-3 btn-beispiel-sidebar">Jetzt ausprobieren</button>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Neuen Action Button erstellen
var actionButton = new Notification({
    icon: 'fas fa-bars'
});                 

// Neue Sidebar erstellen
var sidebar = new Sidebar({
    ..., // Siehe Sidebar Settings

    // Action Button mit Sidebar verlinken
    actionButton: actionButton
})</code></pre>
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

        // Neue Notification erstellen
        var n = new Notification({
            icon: 'fa fa-history',
            color: 'success'
        });

        // Bei einem Wechsel den Status anpassen
        $('input[name=icon], input[name=farbe], input[name=blink]').on('click', function() {

            // Status
            var status = {
                icon: $('input[name=icon]:checked').val(),
                color: $('input[name=farbe]:checked').val(),
                blink: $('input[name=blink]:checked').val()
            };

            console.log(n);

            // Change
            n.change(status);
        });

        // 
        $('.btn-beispiel-erstellen').on('click', function() {

            var icons = ['fas fa-plus', 'far fa-lightbulb', 'fab fa-blackberry', 'fas fa-biohazard', 'fas fa-fist-raised'];
            var colors = [false, 'success', 'warning', 'danger', 'info', 'light'];
            var blink = ['fast', 'slow', 'static'];

            new Notification({
                icon: icons[(Math.random() * icons.length) | 0],
                color: colors[(Math.random() * colors.length) | 0],
                blink: blink[(Math.random() * blink.length) | 0],
            });
        });

        $('.btn-beispiel-loeschen').on('click', function() {
            n.destroy();
        });

        $('.btn-beispiel-show').on('click', function() {
            n.show();
        });

        $('.btn-beispiel-hide').on('click', function() {
            n.hide();
        });

        // 
        n.on('click', function() {
            app.notify.success.fire("Klick Event", "Sie haben auf den Action Button geklickt");
        });

        $('.btn-beispiel-sidebar').on('click', function() {
            var actionButton = new Notification({
                icon: 'fas fa-bars'
            });

            var sidebar = new Sidebar({
                actionButton: actionButton
            })
        });

    });
</script>

</html>