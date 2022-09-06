<?php include('01_init.php');

$_page = [
    'title' => 'FAB - Floating Action Buttons'
];

include('fabbutton-test.php');

?>
<!doctype html>

<!-- Head -->

<head>
    <?php include('02_header.php'); ?>

    <style>
        .testlabel {
            white-space: nowrap;
            position: absolute;
            right: 100px;
            top: 16px;
            background: #fff;
            text-align: right;
            padding: 2px 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        }
    </style>


</head>


<!-- Body -->

<body>
    <?php include('03_navigation.php'); ?>

    <div class="wrapper">
        <div class="container-fluid">

            <div class='card' style="min-height: 100vh;">
                <div class='card-body'>
                    <h4><i class='fas fa-exclamation-circle'></i> FAB-Button</h4>

                    <h6 class='subtext'>Floating-Action-Buttons in der rechten unteren Ecke.</h6>
                    <p>
                        Alle Button kann man in den Farben der <a href="buttons.php">Buttons</a> nehmen. Zudem funktioniert die Klasse <code>.btn-sm</code>.
                        In diesem Beispiel werden Sie nicht unten rechts angezeigt. Nutzt man Sie auf der Seite aber schon
                    </p>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>FAB Button Einzeln</strong><br>
                                Ein Einzener Button in der unteren Rechten Ecke.
                            </p>
                            <button class="btn btn-primary" data-example="single">Zeige Beispiel</button>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-html ctc"><div class="fab-container">
    <button class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
</div></code></pre>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>FAB Button Gruppe</strong><br>
                                Eine Gruppe an Buttons.
                                Die kleineren Buttons werden erst nach einem Klick angezeigt.<br>
                                <br>
                                <code>.fab-parent</code> Der Button der angezeigt wird.<br>
                                <code>.fab-children</code> Die Button die ausgeblendet sind.<br>
                                <code>.btn-small</code> Kleinere Button.<br>
                            </p>
                            <button class="btn btn-primary" data-example="gruppe">Zeige Beispiel</button>
                        </div>
                        <div class="col-md-8">
                            <pre><code class="language-html ctc"><div class="fab-container">
    <button class="btn btn-danger btn-sm fab-children"><i class="fa-solid fa-user-ninja"></i></button>
    <button class="btn btn-danger btn-sm fab-children"><i class="fa-solid fa-user-secret"></i></button>
    <button class="btn btn-danger btn-sm fab-children"><i class="fa-solid fa-users"></i></button>
    <button class="btn btn-danger fab-parent"><i class="fa-solid fa-user"></i></button>
</div></code></pre>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>FAB Button Gruppe - Rotate</strong><br>
                                Mit <code>.fab-rotate</code> kann man das Icon des <code>.fab-parent</code> automatisch drehen lassen
                            </p>
                            <button class="btn btn-primary" data-example="rotate">Zeige Beispiel</button>
                        </div>
                        <div class="col-md-8">
                            <pre><code class="language-html ctc"><div class="fab-container">
        <button class="btn btn-secondary btn-sm fab-children"><i class="fa-solid fa-angle-up"></i></button>
        <button class="btn btn-secondary btn-sm fab-children"><i class="fa-solid fa-angle-up"></i></button>
        <button class="btn btn-secondary btn-sm fab-children"><i class="fa-solid fa-angle-up"></i></button>
        <button class="btn btn-secondary fab-parent fab-rotate"><i class="fa-solid fa-angle-up"></i></button>
    </div></code></pre>
                        </div>
                    </div>


                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>FAB Button Gruppe - Switch</strong><br>
                                Mit <code>.fab-switch</code> kann man das Icon des <code>.fab-parent</code> austauschen lassen.
                                Dazu gibt man über <code>data-switch</code> die Klassen des Icons an, dass ausgetauscht werden soll.
                            </p>
                            <button class="btn btn-primary" data-example="switch">Zeige Beispiel</button>
                        </div>
                        <div class="col-md-8">
                            <pre><code class="language-html ctc"><div class="fab-container">
    <button class="btn btn-warning fab-children"><i class="fa-solid fa-user-ninja"></i></button>
    <button class="btn btn-warning fab-children"><i class="fa-solid fa-user-secret"></i></button>
    <button class="btn btn-warning fab-children"><i class="fa-solid fa-users"></i></button>
    <button class="btn btn-warning fab-parent fab-switch" data-switch="fas fa-times"><i class="fa-solid fa-plus"></i></button>
</div></code></pre>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>FAB Button Gruppe - Label</strong><br>
                                Man kann jederzeit an ein <code>.fab-children</code> das Attribute <code>[data-label="Text"]</code> anfügen.
                                Dann wird neben dem Button ein Label erstellt. Man kann dies aktuell nur auf der rechten Seite nutzen, ich denke das reicht aber auch.
                                Die Buttons die nach links verschoben sind, sind sowieso nur zu Demo-zwecken da.

                            </p>
                            <button class="btn btn-primary" data-example="label-klein">Klein</button>
                            <button class="btn btn-primary" data-example="label-gross">Groß</button>
                            <button class="btn btn-primary" data-example="label-gemischt">Gemischt</button>
                        </div>
                        <div class="col-md-8">
                            <pre><code class="language-html ctc"><div class="fab-container">
    <button class="btn btn-warning fab-children"><i class="fa-solid fa-user-ninja"></i></button>
    <button class="btn btn-warning fab-children"><i class="fa-solid fa-user-secret"></i></button>
    <button class="btn btn-warning fab-children"><i class="fa-solid fa-users"></i></button>
    <button class="btn btn-warning fab-parent fab-switch" data-switch="fas fa-times"><i class="fa-solid fa-plus"></i></button>
</div></code></pre>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>FAB Text</strong><br>
                                Buttons mit Text. Dazu muss man die Klasse <code>.fab-text</code> einfügen. Wenn man mehrere Nebeneinander haben will,
                                dann braucht man noch die Klasse <code>.fab-row</code>. Dies funktioniert aber momentan noch nicht mit Children. 
                            </p>
                            <button class="btn btn-primary" data-example="text">Zeige Beispiel</button>
                        </div>
                        <div class="col-md-8">
                            <pre><code class="language-html ctc"><div class="fab-container fab-row">
    <button class="fab-text btn btn-danger"><i class="fa-solid fa-trash"></i> Verwerfen</button>
    <button class="fab-text btn btn-primary"><i class="fa-solid fa-save"></i> Speichern</button>
</div></code></pre>
                        </div>
                    </div>


                    <div class="example ex-default">
                        <div class="fab-container">
                            <button class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>

                    <div class="example ex-single">
                        <div class="fab-container">
                            <button class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>

                    <div class="example ex-gruppe">
                        <?php echo getExampleFAB('default'); ?>
                    </div>

                    <div class="example ex-rotate">
                        <?php echo getExampleFAB('rotate'); ?>
                    </div>

                    <div class="example ex-switch">
                        <?php echo getExampleFAB('switch'); ?>
                    </div>

                    <div class="example ex-label-klein">
                        <div class="fab-container">
                            <button class="btn btn-danger btn-sm fab-children" data-label="Ninja"><i class="fa-solid fa-user-ninja"></i></button>
                            <button class="btn btn-secondary btn-sm fab-children" data-label="Secret User"><i class="fa-solid fa-user-secret"></i></button>
                            <button class="btn btn-success btn-sm fab-children" data-label="<i class='fas fa-check'></i> Go to Group"><i class="fa-solid fa-users"></i></button>
                            <button class="btn btn-info fab-parent fab-rotate"><i class="fa-solid fa-angle-up"></i></button>
                        </div>

                    </div>
                    <div class="example ex-label-gross">
                        <div class="fab-container">
                            <button class="btn btn-danger fab-children" data-label="Ninja"><i class="fa-solid fa-user-ninja"></i></button>
                            <button class="btn btn-secondary fab-children" data-label="Secret User"><i class="fa-solid fa-user-secret"></i></button>
                            <button class="btn btn-success fab-children" data-label="<i class='fas fa-check'></i> Go to Group"><i class="fa-solid fa-users"></i></button>
                            <button class="btn btn-secondary fab-parent fab-rotate"><i class="fa-solid fa-angle-up"></i></button>
                        </div>

                    </div>
                    <div class="example ex-label-gemischt">
                        <div class="fab-container">
                            <button class="btn btn-danger btn-sm fab-children" data-label="Ninja"><i class="fa-solid fa-user-ninja"></i></button>
                            <button class="btn btn-secondary fab-children" data-label="Secret User"><i class="fa-solid fa-user-secret"></i></button>
                            <button class="btn btn-success btn-sm fab-children" data-label="<i class='fas fa-check'></i> Go to Group"><i class="fa-solid fa-users"></i></button>
                            <button class="btn btn-primary fab-parent fab-rotate"><i class="fa-solid fa-angle-up"></i></button>
                        </div>
                    </div>

                    <div class="example ex-text">
                        <div class="fab-container fab-row">
                            <button class="fab-text btn btn-danger"><i class="fa-solid fa-trash"></i> Verwerfen</button>
                            <button class="fab-text btn btn-primary"><i class="fa-solid fa-save"></i> Speichern</button>
                        </div>
                    </div>





                </div>
            </div>







        </div>

    </div>


</body>

<?php include('04_scripts.php'); ?>


<script>
    $(document).ready(function() {



        $('.example').hide();
        $('.ex-default').show();



        $('[data-example]').on('click', function() {
            var example = $(this).data('example');
            $('.example').hide();
            $('.ex-' + example).show();
            app.notify.info.fire("Ansicht gewechselt", "Sie haben eine neue Ansicht gewählt");
        });



        $('body').on('click', '.fab-container button', function() {
            if (!$(this).hasClass('fab-parent')) {
                app.notify.success.fire("Erfolgreich", "Sie haben einen FAB-Button geklickt!");
            }
        });





    });
</script>

</html>