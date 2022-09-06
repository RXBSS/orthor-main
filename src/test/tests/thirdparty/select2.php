<?php include('01_init.php');

$_page = [
    'title' => 'Select2'
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


            <div class="card" id="initNeueForm">
                <div class="card-body">
                    <h4><i class="fa-solid fa-exclamation-circle"></i> Select 2</h4>
                    <h6 class="subtext">Ein Plugin zum Erstellen von Select.</h6>
                    <p>Weitere Informationen und die Dokumentation findet man auf <a href="https://select2.org/">https://select2.org/</a>.</p>


                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>
                                <p class="mb-3">Standard Selecter von Bootstrap</p>
                            </strong>

                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td><code>Select Aufruf</code></td>
                                    <td>
                                        Ein einfaches Standard Select. Diese findet man auch unter <a href="https://getbootstrap.com/docs/5.0/forms/select/">https://getbootstrap.com/docs/5.0/forms/select/</a>
                                        <pre><code class="hljs language-html ctc"><select class="form-select" aria-label="Default select example"><option selected>Open this select menu</option></select></code></pre>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br>
                    <hr>


                    <div class="row">
                        <div class="col-md-6">
                            <strong>
                                <p class="mb-3">Standard Select2</p>
                            </strong>

                            <select class="form-select js-example-basic-single init-select2" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <td><code>Select2 Aufruf</code></td>
                                    <td>
                                        Für eine einfaches Select2 kann einfach die Klasse als attribut <strong><i>class='init-select2'</i></strong> wie folgt mitgegeben werden:
                                        <pre><code class="hljs language-html ctc"><select class="form-select js-example-basic-single init-select2" aria-label="Default select example"></select></code></pre>
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>Init Form Klasse</code></td>
                                    <td>
                                        Damit alle Forms-Inputs, Selects,.. ins Leben gerufen werden können, wie select2 in dem Beispiel, muss die Klasse <strong>Form</strong> aufgerufen werden.
                                        Die Klasse muss sich auf eine Form-ID oder -Klasse beziehen.
                                        <strong>Wie folgt:</strong>
                                        <pre><code class="hljs language-js ctc">var form = new Form('#initNeueForm');</code></pre>
                                    </td>
                                </tr>
                                <tr>
                                    <td><code>erweiterte Select2 </code></td>
                                    <td>
                                        Falls eine einfaches Select2 nicht ausreicht kann man jederzeit ein eigenes Select2 mit mehr Optionen erstellen.
                                        <strong><i>z.B.</i></strong>
                                        <pre><code class="hljs language-js ctc">$('.js-data-example-ajax').select2({
    ajax: {
        url: 'https://api.github.com/search/repositories',
        dataType: 'json'
        // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
    }
});
                                        </code></pre>
                                        Weiter informatioen oder Optionen findet man unter <a href="https://select2.org/">https://select2.org/</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>
                                <p class="mb-3">Multiple Selecter von Select 2</p>
                            </strong>

                            <select class="js-example-basic-multiple form-select init-select2" name="states[]" multiple="multiple">
                                <option value="AL">Alabama</option>
                                <option value="WY">Wyoming</option>
                                <option value="AL">Alabama</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="hljs language-html ctc">
<select class="js-example-basic-multiple form-select init-select2" name="states[]" multiple="multiple"></select>
 </code></pre>
                        </div>


                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-3">
                                <strong>Multiple Selecter von Select 2 - mit ganzer Zeile </strong><br>
                                Dazu das ganze nur in einen Container mit der Klasse <code>.form-select2-multi-column</code> einfügen
                            </p>    





                            <div class="form-group form-select2-multi-column">
                                <select class="js-example-basic-multiple form-select init-select2" name="states[]" multiple="multiple">
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                </select>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <pre><code class="hljs language-html ctc">
                            <div class="form-group form-select2-multi-column">
 </code></pre>
                        </div>


                    </div>
                </div>


            </div>
            <div class='card'>
                <div class='card-body'>

                    <h4>Vergleich in einer Zeile</h4>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Static</label>
                                <select class="form-select" name="sselect" placeholder="Floating Select">
                                    <option value="">Bitte wählen</option>
                                    <option value="1">Wert 1</option>
                                    <option value="2">Wert 2</option>
                                    <option value="3">Wert 3</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Select 2</label>
                                <select class="form-select example-select2 init-select2" name="select2" placeholder="Floating Select">
                                    <option value="">Bitte wählen</option>
                                    <?php

                                    $i = 1;

                                    while ($i < 100) {
                                        echo '<option value="' . $i . '">Wert ' . $i . '</option>';
                                        $i++;
                                    }
                                    ?>
                                </select>

                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-select" placeholder="Floating Select">
                                    <option value="Wert 1">Wert 1</option>
                                    <option value="Wert 2">Wert 2</option>
                                    <option value="Wert 3" selected>Wert 3</option>
                                </select>
                                <label>Floating</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-select example-select2 init-select2" placeholder="Floating Select">
                                    <option value="Wert 1">Wert 1</option>
                                    <option value="Wert 2">Wert 2</option>
                                    <option value="Wert 3" selected>Wert 3</option>
                                </select>
                                <label>Select 2</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Default Selects -->
            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fas fa-cogs'></i> Default Select</h4>
                    <h6 class='subtext'>Es gibt schon fertige Default Selects. Diese kann man dann nach belieben in sein Formular einbinden. Diese wurden über sog. <a href="quickselect.php">Quickselect</a> eingebaut.</h6>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select select-user"></select>
                                <label>Benutzer</label>
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select select-laender"></select>
                                <label>Länder</label>
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                </div>
            </div>

            <div style="height: 500px;"></div>



        </div>


</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).ready(function() {
        var form = new Form('#initNeueForm');
    });
</script>

</html>