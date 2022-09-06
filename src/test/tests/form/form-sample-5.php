<?php include('01_init.php');

$_page = [
    'title' => "Form Auto Complete"
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
                    <h4 class="card-title"><i class="fa-regular fa-keyboard"></i> Auto Complete</h4>
                    <h6 class="subtext">Erklärung zum Thema Auto Complete</h6>



                    <p>
                        <strong>Was ist Auto Complete?</strong><br>
                        Wenn man eine Form ausfüllt, dann gibt es bei Browsern meistens eine sog. <strong>Auto Complete</strong> Funktion
                        Diese Funktion sorgt dafür, das Input Felder die bekannt sind, mit vorschlägen aufgefüllt werden.
                    </p>

                    <p>
                        <strong>Wo liegt das Problem mit Auto Complete?</strong><br>
                        Für das normale Surfen im Web ist diese Funktion sehr sinnvoll. Für Admin-Portale in der Regel aber kontra-produktiv.
                        Gibt es bei einer Website das Feld Name, Straße, PLZ und Ort, soll hier meistens die eigenen Werte eingetragen werden.
                        In einem Admin-Panel sollen aber meistens fremde Werte eigetragen werden. In unserem Beispiel würde man für die Kontakt-pflege die Felder ebenfalls
                        Name, Straße, PLZ und Ort nennen. Hier will ich aber Kunden-Kontakte anlegen und Auto Complete würde mir beim Anlegen immer meine Kontakte vorgeben.
                        Ergo muss man die Möglichkeit haben Autocomplete zu deaktivieren.
                    </p>


                    <p>
                        <strong>Wie deaktivere ich Auto Complete?</strong><br>
                        Leider haben die Browser-Hersteller hier unterschiedliche Ansichten wie, wann und warum man Auto Complete unterbinden kann und darf.
                        Genauer haben wir dies im Ticket <a href="https://github.com/BurosystemhausSchafer/orthor/issues/203" target="_blank">#203</a> beschrieben.
                        Im Nachfolgenden ist ein Weg angegeben, wie man eine Form so darfstellt, dass kein Autocomplete angezeigt wird, egal mit welchem Browser man diese ausfüllt.
                        Man kann hier leider nur die komplette Form vorgeben und nicht einzelne Felder.
                    </p>


                    <hr>

                    <div class="row">
                        <div class="col-md-3">
                            <form id="form-1" autocomplete="off">
                                
                                <h6>Form ohne Auto Complete</h6>
                                <div class="form-group form-floating">
                                    <input type="text" name="mysome" class="form-control editable" placeholder="Name" autocomplete="nope">
                                    <label>Name</label>
                                </div>

                                <div class="form-group form-floating">
                                    <input type="text" name="strasse" class="form-control editable" placeholder="Straße" autocomplete="nope">
                                    <label>Straße</label>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="plz" class="form-control editable" placeholder="PLZ" autocomplete="new-nope">
                                            <label>PLZ</label>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group form-floating">
                                            <input type="text" name="ort" class="form-control editable" placeholder="Ort" autocomplete="nope">
                                            <label>Ort</label>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <button class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-danger">Reset</button>


                            </form>

                        </div>
                        <div class="col-md-3">
                            <form id="form-2">
                                <h6>Form mit Auto Complete</h6>
                                <div class="form-group form-floating">
                                    <input type="text" name="name" class="form-control editable" placeholder="Random">
                                    <label>Name</label>
                                </div>

                                <div class="form-group form-floating">
                                    <input type="text" name="strasse" class="form-control editable" placeholder="Straße">
                                    <label>Straße</label>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="zip" class="form-control editable" placeholder="PLZ">
                                            <label>PLZ</label>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group form-floating">
                                            <input type="text" name="ort" class="form-control editable" placeholder="Ort">
                                            <label>Ort</label>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <button class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-danger">Reset</button>


                            </form>

                        </div>
                        <div class="col-md-6"></div>
                    </div>



                </div>
            </div>


        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {
        
        var f1 = new Form('#form-1');
        var f2 = new Form('#form-2');
        
    });
</script>

</html>