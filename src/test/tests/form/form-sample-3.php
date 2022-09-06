<?php include('01_init.php');

$_page = [
    'title' => "Form Sample 2",
    'breadcrumbs' => ['<a href="form-handler">Form Handler</a>']
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
                    <h4 class="card-title"><i class="fa-solid fa-truck-fast"></i> Auto Validation</h4>
                    <h6 class="subtext">
                        Es gibt viele Validierungen die immer wiederkehren. Diese sind unten aufgelistet. Es wäre mühsam für jede dieser Validierungen immer ein extra
                        Field Objekt anzugeben. Deshalb habe ich ein paar Standard-Klassen gebaut. Diese fangen alle mit <code>.fv-</code> an.
                        Die Klasse werden erst mit `initValidation` aktiv und werden mit der übergebenen Field List gemergt.
                    </h6>

                    <hr>


                    <form id="test">

                        <div class="row">
                            <div class="col-6">
                                <strong>HTML 5 (Standard)</strong>
                                <br>
                                FormValidation bietet schon im Standard mit <strong>required</strong> und <strong>input[type=email]</strong> Validatoren.
                                Für alles weitere kann man die unten stehenden Standards benutzen.
                            </div>

                            <div class="offset-3 col-3">
                                <div class="form-group form-floating">
                                    <input type="text" name="html5_required" class="form-control editable" placeholder="Text (Required)" autocomplete="off" required>
                                    <label>Text (Required)</label>
                                </div>
                                <div class="form-group form-floating">
                                    <input type="email" name="html5_email" class="form-control editable" placeholder="E-Mail" autocomplete="off">
                                    <label>E-Mail</label>
                                </div>

                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <strong>.fv-date</strong><br>
                                Standardmäßig wird bei einem Datum einige nicht so sinnvolle Werte aktzeptiert wie: <code>01.01.0001</code> oder <code>31.12.275760</code>.
                                Die Klasse fv-date sorgt dafür, dass es ein sinnvolles Datum sein muss und fügt ein Min-Max Datum von jeweils -150 und +150 ein.


                                <br>

                                <div class="alert alert-danger mt-2">
                                    Bei JavaScript ist das maximal zulässige Datum übrigens der 13.09.275760. Dies führt bei Werten darüber (kann man nur per Hand setzen) in dem man
                                    die Pfeiltasten benutzt, dazu, dass ein Wert als Valide angezeigt wird. Siehe dazu auch Bug <a href="https://github.com/BurosystemhausSchafer/orthor/issues/183">#183</a>
                                </div>


                            </div>
                            <div class="col-3">
                                <a href="javascript:void(0);" class="set-date-sample" data-fields="date_standard,date_reasonable">01.01.0001</a><br>
                                <a href="javascript:void(0);" class="set-date-sample-special" data-fields="date_standard,date_reasonable">31.12.275760</a><br>
                                <a href="javascript:void(0);" class="set-date-sample-special-2" data-fields="date_standard,date_reasonable">13.09.205760</a><br>
                                <a href="javascript:void(0);" class="set-date-sample" data-fields="date_standard,date_reasonable">31.12.9999</a><br>
                                <a href="javascript:void(0);" class="set-date-sample" data-fields="date_standard,date_reasonable">15.10.1960</a><br>
                                <a href="javascript:void(0);" class="set-date-sample" data-fields="date_standard,date_reasonable">13.02.2062</a><br>
                            </div>
                            <div class="col-3">
                                <div class="form-group form-floating">
                                    <input type="date" name="date_standard" class="form-control editable" placeholder="Datum" autocomplete="off">
                                    <label>Standard Datum</label>
                                </div>
                                <div class="form-group form-floating">
                                    <input type="date" name="date_reasonable" class="form-control editable fv-date" placeholder="Datum" autocomplete="off">
                                    <label>Sinnvolles Datum (.fv-date)</label>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-6">
                                <strong>.fv-date-past</strong><br>
                                Setzt auf <code>.fv-date</code> auf, aber erlaubt nur Daten in der Vergangenheit. Der heutige Tag zählt <strong>nicht</strong> dazu.
                                Mit der Klasse <code>.fv-date-current</code> kann man aber noch den aktuellen Tag mit dazu holen.
                            </div>
                            <div class="col-3">
                                <a href="javascript:void(0);" class="set-date-sample" data-fields="date_past,date_past_current">10.10.2020</a> (Gültig)<br>
                                <a href="javascript:void(0);" class="set-date-sample" data-fields="date_past,date_past_current">Heute</a> (Teilweise)<br>
                                <a href="javascript:void(0);" class="set-date-sample" data-fields="date_past,date_past_current">-1</a> (Gültig)<br>
                                <a href="javascript:void(0);" class="set-date-sample" data-fields="date_past,date_past_current">+100</a> (Ungültig)<br>
                            </div>
                            <div class="col-3">
                                <div class="form-group form-floating">
                                    <input type="date" name="date_past" class="form-control fv-date-past editable" placeholder="Datum" autocomplete="off">
                                    <label>Vergangenes Datum (.fv-past-date)</label>
                                </div>
                                <div class="form-group form-floating">
                                    <input type="date" name="date_past_current" class="form-control fv-date-past fv-date-current editable" placeholder="Datum" autocomplete="off">
                                    <label>mit - fv-date-current</label>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-6">
                                <strong>.fv-date-future</strong><br>
                                Setzt auf <code>.fv-date</code> auf, aber erlaubt nur Daten in der Zukunft. Der heutige Tag zählt <strong>nicht</strong> dazu.
                                Mit der Klasse <code>.fv-date-current</code> kann man aber noch den aktuellen Tag mit dazu holen.
                            </div>
                            <div class="col-3">
                                <a href="javascript:void(0);" class="set-date-sample" data-fields="date_future,date_future_current">+100</a> (Gültig)<br>
                                <a href="javascript:void(0);" class="set-date-sample" data-fields="date_future,date_future_current">Heute</a> (Teilweise)<br>
                                <a href="javascript:void(0);" class="set-date-sample" data-fields="date_future,date_future_current">+1</a> (Gültig)<br>
                                <a href="javascript:void(0);" class="set-date-sample" data-fields="date_future,date_future_current">10.10.2020</a> (Ungültig)<br>
                            </div>
                            <div class="col-3">
                                <div class="form-group form-floating">
                                    <input type="date" name="date_future" class="form-control fv-date-future editable" placeholder="Datum" autocomplete="off">
                                    <label>Zukunft Datum (.fv-date-future)</label>
                                </div>
                                <div class="form-group form-floating">
                                    <input type="date" name="date_future_current" class="form-control fv-date-future fv-date-current editable" placeholder="Datum" autocomplete="off">
                                    <label>mit - fv-date-current</label>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-6">
                                <strong>.fv-date-current</strong><br>
                                Ist für sich alleine sinnfrei und deshalb nicht programmiert. Kann nur in Kombination mit <code>.fv-date-past</code> oder <code>.fv-date-future</code> genutzt werden.
                            </div>
                        </div>


                        <hr>


                        <div class="row">
                            <div class="col-6">
                                <strong>.fv-plz</strong><br>
                                FormValidation.io hat bereits einen <a target="_blank" href="https://formvalidation.io/guide/validators/zip-code/">zipCode-Validator</a>.
                                Dieser braucht aber als Pflichtfeld einen Country Code. Nun muss man immer umständlich das Land auswählen. Da Orthor eine Liste der Länder schon mitbringt,
                                können wir diese automatisch verknüpfen. Dazu müssen wir der Klasse <code>.fv-plz</code> nur den Namen des Inputs geben, aus dem es sich das Land ziehen soll.
                                Das weitere Handling übernimmt dann der AutoValidator.<br><br>



                                <pre><code class="language-html ctc"><!-- Input für das Land -->
<input name="laender" ...>
                                    
<!-- Input für die PLZ -->                                
<input class="... fv-plz" data-country="laender" ...></code></pre>

                            </div>
                            <div class="offset-3 col-3">
                                <div class="form-group form-floating">
                                    <select class="form-select init-quickselect editable" name="laender" placeholder="Länder">

                                    </select>
                                    <label>Länder</label>
                                </div>
                                <div class="form-group form-floating">
                                    <input type="text" name="date-future" class="form-control fv-plz editable" placeholder="PLZ" autocomplete="off">
                                    <label>PLZ</label>
                                </div>
                            </div>
                        </div>


                        <br><br>
                        <button class="btn btn-primary">Submit</button>
                        <button id="test-reset" class="btn btn-danger" type="button">Reset</button>
                        <button id="test-load" class="btn btn-secondary" type="button">Load</button>


                    </form>


                </div>
            </div>
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {
        var form = new Form('#test');




        form.initValidation();

        var result = form.inValidationList('test');
        console.log(result);



        form.on('submit', function() {
            app.notify.success.fire("Erfolgreich", "Submit");
        });


        $('#test-load').on('click', function() {
            form.load('load-test', 'form-handle-test-backend');
        });

        $('#test-reset').on('click', function() {
            form.reset(0);
        });


        // Beispiel Funktion
        $('.set-date-sample').on('click', function() {




            var value = moment($(this).text(), 'DD.MM.YYYY', true);

            if (!value.isValid()) {
                value = moment().add($(this).text(), 'days');
            }




            var fields = $(this).data('fields').split(',');

            console.log(fields);

            $.each(fields, function(index, fieldname) {
                var el = form.container.find('input[name=' + fieldname + ']');

                el.val(value.format('YYYY-MM-DD'));

                if (form.inValidationList(fieldname)) {
                    form.fvInstanz.revalidateField(fieldname);
                }



            });


            console.log(value.format('YYYY-MM-DD'));
        });

        $('.set-date-sample-special').on('click', function() {
            form.container.find('input[name=date_standard]').val('275760-12-31');
            form.container.find('input[name=date_reasonable]').val('275760-12-31');
            form.fvInstanz.revalidateField('date_reasonable');
        });

        $('.set-date-sample-special-2').on('click', function() {
            form.container.find('input[name=date_standard]').val('275759-09-13');
            form.container.find('input[name=date_reasonable]').val('275759-09-13');
            form.fvInstanz.revalidateField('date_reasonable');
        });




    });
</script>

</html>