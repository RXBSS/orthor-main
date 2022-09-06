<?php include('01_init.php');

$_page = [
    'title' => "Alert"
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
                    <h4 class="card-title"><i class="fas fa-info"></i> Alert</h4>
            
                    <h6 class="subtext">Hier findet man alle Alerts von Bootstrap und unsere eigen erstellen Alerts!</h6>

                    <hr>

                    <div class="row">
                        <div class="col-lg-7">

                                
                            <!-- <p class="text-info" style="font-size:18px;">Unsere Alerts</p> -->
                            <div class="row">
                                <div class="alert alert-soft-primary"><i class="fa-solid fa-check"></i> <strong>Das war Erfolgreich!</strong> Hier kommt mein Text und ein <a href="alert">Link</a></div>
                            </div>

                            <div class="row">
                                <div class="alert alert-primary"><i class="fa-solid fa-check"></i> <strong>Das war Erfolgreich!</strong> Hier kommt mein Text und ein <a href="alert">Link</a></div>
                            </div>

                            <br>
                            <br>

                            <div class="row">
                                <div class="alert alert-soft-secondary"><i class="fa-solid fa-crow"></i> <strong>Bonjour Monsieur!</strong> J'ai une Tour Eiffel dans mon <a href="alert">pantalon</a></div>
                            </div>

                            <div class="row">
                                <div class="alert alert-secondary"><i class="fa-solid fa-crow"></i> <strong>Bonjour Monsieur!</strong> J'ai une Tour Eiffel dans mon <a href="alert">pantalon</a></div>
                            </div>

                            <br>
                            <br>

                            <div class="row">
                                <div class="alert alert-soft-danger"><i class="fa-solid fa-circle-exclamation"></i> <strong>Das ist Fehler!</strong> Wenn Sie den Fehler melden möchten klicken Sie <a href="alert">hier</a></div>
                            </div>

                            <div class="row">
                                <div class="alert alert-danger"><i class="fa-solid fa-circle-exclamation"></i> <strong>Das ist Fehler!</strong> Wenn Sie den Fehler melden möchten klicken Sie <a href="alert">hier</a></div>
                            </div>

                            <br>
                            <br>

                            <div class="row">
                                <div class="alert alert-soft-warning"><i class="fa-solid fa-triangle-exclamation"></i> <strong>Das ist eine Warnung!</strong> Denn unser Anschlag ist schon längst in <a href="alert">Planung</a></div>
                            </div>

                            <div class="row">
                                <div class="alert alert-warning"><i class="fa-solid fa-triangle-exclamation"></i> <strong>Das ist eine Warnung!</strong> Denn unser Anschlag ist schon längst in <a href="alert">Planung</a></div>
                            </div>

                            <br>
                            <br>

                            <div class="row">
                                <div class="alert alert-soft-info"><i class="fa-solid fa-circle-info"></i> <strong>Das ist zur Info!</strong> Hier kommt mein Text und ein <a href="alert">Link</a></div>
                            </div>

                            <div class="row">
                                <div class="alert alert-info"><i class="fa-solid fa-circle-info"></i> <strong>Das ist zur Info!</strong> Hier kommt mein Text und ein <a href="alert">Link</a></div>
                            </div>
                        </div>

            
                        <div class="col-lg-5">

                        <table class="table">
                            <tbody>
                                <tr>
                                <td><code>Custom Alert (Soft)</code></td>
                                <td>

                                    <p>Mit dem Alert Soft kann man die Farbe des Alerts aufhellen.</p>
                                    <pre><code class="language-html ctc"><div class="alert alert-soft-info">Success</div></code></pre>

                                </td>
                            </tr>
                            <tr>
                                <td><code>Bootstrap Alert</code></td>
                                <td>

                                    <p>Das ist die zweite Variante des alerts</p>
                                    <pre><code class="language-html ctc"><div class="alert alert-info">Success</div></code></pre>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                            
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