<?php include('01_init.php');

$_page = [
    'title' => "<i class=\"fas fa-toggle-on\"></i> Activation"
];

?>
<!doctype html>

<head>
    <?php include('02_header.php'); ?>

    <style>
        .border {
            border: 1px solid black;
            padding: 15px;
        }
    </style>
</head>

<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" id="c-2">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-check-square"></i> Activation Checkbox</h4>
                            <h6 class="subtext">
                                Eine einfache Funktion um Elemente ein- und auszublenden und die darin enthaltenen Form Elemente zu aktivieren und deaktivieren.
                                Außerdem können damit auch Callbacks ausgelöst werden
                            </h6>
                            <a href="activation-checkbox" class="btn btn-success my-3"><i class="fa-solid fa-book"></i> Activation Checkbox</a>
                            <hr>

                            <strong>Beispiel</strong><br><br>

                            <div class="form-group form-floating-check">
                                <label class="form-label">Checkbox</label>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input editable" id="example-2" name="example-2" value="1" />
                                    <label class="form-check-label" for="example-2">Wert</label>
                                </div>
                            </div>

                            <div id="div-checked-2" class="border mt-3">
                                <i class="fa-solid fa-check text-success"></i> Ich werde nur einblendet wenn die Checkbox angehakt ist
                            </div>

                            <div id="div-unchecked-2" class="border mt-3">
                                <i class="fa-solid fa-times text-danger"></i> Ich werde nur einblendet wenn die Checkbox nicht angehakt ist
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card" id="c-1">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-calendar-check"></i> Activation Card</h4>
                            <h6 class="subtext">Dabei handelt es sich um eine Klasse um eine Card zu aktivieren und deaktivieren.</h6>

                            <a href="activation-card" class="btn btn-success my-3"><i class="fa-solid fa-book"></i> Activation Card</a>

                            <hr>

                            <strong>Beispiel</strong><br><br>

                            <div class="card" id="example-card">
                                <div class="card-body">
                                    <h6>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input card-activate-switch" type="checkbox" id="example-cb-1">
                                            <label class="form-check-label" for="example-cb-1">Activation Card</label>
                                        </div>
                                    </h6>
                                    <h6 class="subtext">In der Standard-Funktion wird nur ein- und ausgeblendet</h6>

                                    <div class="card-body-checked">
                                        <i class="fa-solid fa-check text-success"></i> Ich werde nur einblendet wenn die Checkbox angehakt ist
                                    </div>

                                    <div class="card-body-unchecked">
                                        <i class="fa-solid fa-times text-danger"></i> Ich werde nur einblendet wenn die Checkbox nicht angehakt ist
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card" id="c-3">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-edit"></i> Activation Input</h4>
                            <h6 class="subtext">Dies ist eine Erweiterung der Checkbox Klasse. Sie dient zur einfachen De/Aktivierung von Input Feldern</h6>

                            <a href="activation-input" class="btn btn-success my-3"><i class="fa-solid fa-book"></i> Activation Input</a>
                            <hr>

                            <strong>Beispiel</strong><br><br>
                            <div class="activation-input-container">
                                <div class="form-group form-floating-check">
                                    <label class="form-label"></label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="cb-input" name="cb-input" value="1" checked />
                                        <label class="form-check-label" for="cb-input"></label>
                                    </div>
                                </div>
                                <div class="form-group form-floating">
                                    <input type="text" name="example-input" class="form-control editable" placeholder="Bezeichnung" value="Mein Text" autocomplete="off">
                                    <label>Bezeichnung</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-exchange-alt"></i> Activation Multi</h4>
                            <h6 class="subtext">Genauso wie Activation Checkbox, nur das man hier mehrere Auswahl-Möglichkeiten hat</h6>

                            <a href="activation-multi" class="btn btn-success my-3"><i class="fa-solid fa-book"></i> Activation Multi</a>
                            <hr>

                            <strong>Beispiel</strong><br>


                            <div class="form-group form-floating-radio">
                                <label class="form-label">Eine wählen</label>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-1" name="example-multi" value="apple" checked />
                                    <label class="form-check-label" for="example-multi-1"><i class="fab fa-apple"></i> Apple</label>
                                </div>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-2" name="example-multi" value="facebook" />
                                    <label class="form-check-label" for="example-multi-2"><i class="fab fa-facebook"></i> Facebook</label>
                                </div>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input editable" id="example-multi-3" name="example-multi" value="google" />
                                    <label class="form-check-label" for="example-multi-3"><i class="fab fa-google"></i> Google</label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-around mt-3">
                                <div class="card-multi p-3 flex-grow-1" style="border: 2px solid red;" data-values="apple">
                                    www.apple.com
                                </div>

                                <div class="card-multi p-3 flex-grow-1" style="border: 2px solid green;" data-values="facebook">
                                    www.facebook.com
                                </div>

                                <div class="card-multi p-3 flex-grow-1" style="border: 2px solid blue;" data-values="google">
                                    www.google.com
                                </div>
                            </div>
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

        // Beispiel Card
        // ----------
        // -- Beispiel 2
        var cb1 = new ActivationCheckbox('#example-2', [{
                el: '#div-checked-2'
            },
            {
                el: '#div-unchecked-2',
                reverse: true
            }
        ]);

        // Beispiel Card
        // ----------
        new ActivationCard('#example-card');

        // Beispiel Input
        // ----------
        new ActivationInput('#cb-input', 'input[name=example-input]');

        // Beispiel Mulit
        // ----------
        new ActivationMulti('input[name=example-multi]', '.card-multi');

        new CardSizer(['#c-1', '#c-2', '#c-3']);

    });
</script>

</html>