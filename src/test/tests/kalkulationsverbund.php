<?php include('01_init.php');

$_page = [
    'title' => "Kalkulationsverbund"
];

?>
<!doctype html>

<head>
    <?php include('02_header.php'); ?>


    <style>

        .badge[data-role=richtung] {
            cursor: pointer;
            margin-bottom: 5px;
        }

    </style>

</head>

<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-calculator"></i> Kalkulationsverbund</h4>
                    <h6 class="subtext">Ein Kalkulationsverbund ist ein zusammenschluss mehrere Felder. Dieser rechnet dann automatisch verschiedene Feld-Werte aus</h6>

                    <a class="btn btn-primary" href="kalkulationsverbund-doku"><i class="fa-solid fa-book"></i> Dokumentation</a>

                    <br>
                    <hr>

                    <strong>Einfachstes Beispiel</strong>

                    <div class="row">
                        <div class="col-md-6">
                            <div id="k1">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="wert1" data-role="menge" class="form-control editable" placeholder="Netto" autocomplete="nope">
                                            <label>Menge</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="wert1" data-role="vk" class="form-control editable" placeholder="Netto" autocomplete="nope">
                                            <label>Preis</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="wert2" data-role="netto_gesamt" class="form-control editable" placeholder="Brutto" autocomplete="nope" readonly>
                                            <label>Gesamtpreis</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <strong>Der HTML Code</strong>
                            <pre><code class="language-html ctc"><div id="kalk">
    <input type="text" data-role="menge">
    <input type="text" data-role="vk">
    <input type="text" data-role="netto_gesamt">
</div></code></pre>
                            <strong>Der JS Code</strong>
                            <pre><code class="language-js ctc">var kalk = new Kalkulationsverbund('#kalk');</code></pre>
                        </div>
                    </div>


                    <hr>

                    <strong>Vollständiges Beispiel</strong>

                    <div class="row">
                        <div class="col-md-4">
                            <form id="k2">


                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group form-floating">
                                            <input type="text" name="menge" data-role="menge" class="form-control editable" placeholder="Menge" required>
                                            <label>Menge</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-floating label-info">
                                            <input type="text" name="vk" data-role="vk" class="form-control editable" data-unit="€" placeholder="Netto">
                                            <label>VK Netto</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-floating">
                                            <input type="text" name="steuer_satz" data-role="steuer_satz" value="19" class="form-control editable" data-unit="%" placeholder="Steuer">
                                            <label>Steuer</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-end">
                                        <span class="badge bg-secondary" data-role="richtung">EK <i class="fa-solid fa-angle-right"></i> VK</span>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group form-check form-floating-check form-switch">
                                            <label class="form-label">Rabatt</label><br>
                                            <input class="form-check-input editable color-warning" id="test-checkbox" name="rabatt_aktiv" data-role="rabatt_aktiv" type="checkbox">
                                            <label class="form-check-label" for="position-rabatt-aktiv">Aktiv</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 rabatt-is-checked">
                                        <div class="form-group form-floating label-warning">
                                            <input type="text" name="rabatt_prozent" data-role="rabatt_prozent" data-unit="%" class="form-control editable" placeholder="Prozent">
                                            <label>Prozent</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 rabatt-is-checked">
                                        <div class="form-group form-floating label-warning">
                                            <input type="text" name="rabatt_wert" data-role="rabatt_wert" data-unit="€" class="form-control editable" placeholder="rabatt_wert">
                                            <label>Wert</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 rabatt-is-checked">
                                        <div class="form-group form-floating label-warning">
                                            <input type="text" name="vk_inkl_rabatt" data-role="vk_inkl_rabatt" data-unit="€" class="form-control editable" placeholder="VK Rabatt">
                                            <label>VK (Rabatt)</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="row rabatt-is-checked">

                                    <div class="col-md-3 "></div>
                                    <div class="col-md-3 ">
                                        <div class="form-group form-floating label-warning">
                                            <input type="text" name="marge_prozent_inkl_rabatt" data-role="marge_prozent_inkl_rabatt" data-unit="%" class="form-control editable" placeholder="Netto">
                                            <label>Marge Rabatt %</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-floating label-warning">
                                            <input type="text" name="marge_wert_inkl_rabatt" data-role="marge_wert_inkl_rabatt"  data-unit="€" class="form-control editable" placeholder="Netto">
                                            <label>Marge Rabatt</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>



                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group form-floating">
                                            <input type="text" name="ek" data-role="ek" class="form-control editable" data-unit="€" placeholder="Netto">
                                            <label>EK Netto</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-floating">
                                            <input type="text" name="marge_prozent" data-role="marge_prozent" data-unit="%" class="form-control editable" placeholder="Marge %">
                                            <label>Marge %</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-floating">
                                            <input type="text" name="marge_wert" data-role="marge" data-unit="€" class="form-control editable" placeholder="Marge">
                                            <label>Marge</label>
                                        </div>
                                    </div>

                                </div>

                                <br>

                                <strong>Gesamt</strong>
                                <div class="row rabatt-is-not-checked">
                                    <div class="col-md-3">
                                        <div class="form-group form-floating">
                                            <input type="text" name="netto_gesamt" data-role="netto_gesamt"  class="form-control editable" data-unit="€"  placeholder="Netto" value="" disabled>
                                            <label>Netto</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-floating">
                                            <input type="text" name="marge_gesamt" data-role="marge_gesamt" class="form-control editable" data-unit="%" placeholder="Marge" value="" disabled>
                                            <label>Marge</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-floating">
                                            <input type="text" name="steuer_wert_gesamt" data-role="steuer_wert_gesamt" data-unit="€" class="form-control editable" placeholder="MwSt." value="" disabled>
                                            <label>MwSt.</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-floating">
                                            <input type="text" name="brutto_gesamt" data-role="brutto_gesamt" data-unit="€" class="form-control editable" placeholder="Brutto" value="" disabled>
                                            <label>Brutto</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row rabatt-is-checked">
                                    <div class="col-md-3">
                                        <div class="form-group form-floating label-warning">
                                            <input type="text" name="netto_inkl_rabatt_gesamt" data-role="netto_inkl_rabatt_gesamt" class="form-control editable" placeholder="Netto" value="" disabled>
                                            <label>Netto</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-floating label-warning">
                                            <input type="text" name="marge_inkl_rabatt_gesamt" data-role="marge_inkl_rabatt_gesamt" class="form-control editable" data-unit="%" placeholder="Marge" value="" disabled>
                                            <label>Marge</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-floating label-warning">
                                            <input type="text" name="steuer_wert_inkl_rabatt_gesamt" data-role="steuer_wert_inkl_rabatt_gesamt" data-unit="€" class="form-control editable" placeholder="MwSt." value="" disabled>
                                            <label>MwSt.</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-floating label-warning">
                                            <input type="text" name="brutto_inkl_rabatt_gesamt" data-role="brutto_inkl_rabatt_gesamt" data-unit="€" class="form-control editable" placeholder="Brutto" value="" disabled>
                                            <label>Brutto</label>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <pre>Not as Fields<br><span id="fields-not-on-form"></span></pre>


                                <button class="btn btn-primary">Submit</button>
                                <button type="button" data-id="1" class="btn btn-secondary form-load">Load 1</button>
                                <button type="button" data-id="2" class="btn btn-secondary form-load">Load 2</button>
                                <button type="button" class="btn btn-danger">Reset</button>


                            </form>
                        </div>
                        <div class="col-md-6">


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

        // Beispiel 1
        // var k1 = new Kalkulationsverbund('#k1');


        // Beispiel 2
        var form = new Form('#k2');
        var k2 = new Kalkulationsverbund('#k2', form);

        // Activation Checkbox
        var cb = new ActivationCheckbox('#test-checkbox', [{
            el: '.rabatt-is-checked'
        }]);

        

        $('.form-load').on('click', function() {
            form.load('load', 'kalkulationsverbund-backend', $(this).data('id'), function() {
                console.log('-- Load Complete');
            });
        });


    });
</script>

</html>