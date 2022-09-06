<?php include('01_init.php');

$_page = [
    'title' => "Sub-Form",
    'breadcrumbs' => ['<a href="form-handler">Form Handler</a>']
];

?>
<!doctype html>

<head>
    <?php include('02_header.php'); ?>


    <style>
        .sub {
            background: #eee;
            border: 2px solid red;
            padding: 20px;
        }
    </style>

</head>

<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-check"></i> Sub-Form</h4>
                    <h6 class="subtext">Dabei handelt es sich um das Konzept zum Verschachteln von mehreren Formen</h6>




                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                Gebraucht wird dies in erster Linie für Picklist und deren Filter. Allerdings kann es später auch noch weitere Anwendungsfäller geben.
                                Solange wird aber erstmal nur das entwickelt was für den Anwendungsfall Picklist und Filter zwangsläufig benötigt wird.
                            </p>
                            <p>
                                Auf der rechten Seite sieht man das benötigte HTML. Eigentlich gibt folgende wichtige Dinge zu beachten:
                            </p>
                            <ul>
                                <li>
                                    Die Sub-Form muss die Klasse <code>.sub-form</code> erhalten.
                                </li>
                                <li>
                                    Die Sub-Form muss zwangsläufig eine ID haben!
                                </li>
                                <li>
                                    Die Form darf nicht als &lt;form&gt; angegeben werden, sondern muss als &lt;div&gt; angegeben werden. Zwei Form Elemente in verschachelt ist nicht zulässig. (siehe <a href="https://html.spec.whatwg.org/multipage/forms.html#the-form-element">hier</a> - Flow content, but with no form element descendants.)
                                </li>
                                <li>
                                    Namen dürfen doppelt vorkommen. Dies wird über die Programmierung abgefangen.
                                </li>
                                <li>
                                    Forms können somit in beliebige tiefe verschachtelt werden.
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-html ctc"><!-- Eltern Form -->
<form id="parent">
                                        
    <!-- Inputs zur Eltern Form -->
    <input type="text" name="test" value="zu Parent">
    <input type="text" name="foo" value="zu Parent">

    <!-- Kind Form -->
    <div id="child" class="sub-form">

        <!-- Inputs zur Kind Form -->
        <input type="text" name="test" value="zu Child">
        <input type="text" name="baa" value="zu Child">
    </div>
</form></code></pre>
                        </div>
                    </div>




                    <p>
                        Wie oben bereits erwähnt werden noch nicht alle Funktionen unterstützt. Hier die unterstützen Funktionen:

                    </p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-1">Unterstützt</th>
                                <th>Funktion</th>
                                <th>Weitere Infos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><i class="fa-solid fa-check text-primary"></i></td>
                                <th>constructor</th>
                                <td></td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-check text-primary"></i></td>
                                <th>getData</th>
                                <td>Bisher nur Input und Quickselect getestet</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-check text-primary"></i></td>
                                <th>setData</th>
                                <td>Bisher nur Input und Quickselect getestet</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-check text-primary"></i></td>
                                <th>reset</th>
                                <td>Nur Modus 0 und 1</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-times text-danger"></i></td>
                                <th>submitButton</th>
                                <td>Hier löst der Submit Button der Sub-Form immer die Main-Form aus!</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-question-circle text-danger"></i></td>
                                <th>initValidation</th>
                                <td>Wird vermutlich nur mit übergabe der Felder funktionieren</td>
                            </tr>
                            <tr>
                                <td><i class="fa-solid fa-question-circle text-danger"></i></td>
                                <th>...</th>
                                <td>...</td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>




            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <strong>Das ist die Form</strong>
                            <form id="parent-form">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-floating">
                                            <input type="text" name="name" class="form-control editable" placeholder="Test" autocomplete="off" value="Value aus 1">
                                            <label>Test</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-floating">
                                            <input type="text" name="diff1" class="form-control editable" placeholder="Diff" autocomplete="off" value="Value aus 1">
                                            <label>Diff</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-floating">
                                            <select class="form-select init-quickselect editable" name="laender" placeholder="Länder">
                                                <option value="">bitte wählen</option>
                                            </select>
                                            <label>Länder</label>
                                        </div>
                                    </div>
                                </div>






                                <br>

                                <!-- Absenden -->
                                <button class="btn btn-primary">Submit</button>
                                <button type="button" id="btn-ex-1" class="btn btn-secondary">Get Data</button>
                                <button type="button" id="btn-ex-4" class="btn btn-secondary">Set Data</button>
                                <button type="button" id="btn-ex-7" class="btn btn-danger">Reset</button>



                                <div id="child-form" class="sub sub-form mb-3 mt-3">

                                    <strong>Das ist die Sub Form</strong>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-floating">
                                                <input type="text" name="name" class="form-control editable" placeholder="Test" autocomplete="off" value="Value aus 2">
                                                <label>Test 2</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-floating">
                                                <input type="text" name="diff2" class="form-control editable" placeholder="Diff" autocomplete="off" value="Value aus 2">
                                                <label>Diff 2</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-floating">
                                                <select class="form-select init-quickselect editable" name="laender" placeholder="Länder">
                                                    <option value="">bitte wählen</option>
                                                </select>
                                                <label>Länder</label>
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <!-- Absenden -->
                                    <button class="btn btn-primary">Submit</button>
                                    <button type="button" id="btn-ex-2" class="btn btn-secondary">Get Data</button>
                                    <button type="button" id="btn-ex-5" class="btn btn-secondary">Set Data</button>
                                    <button type="button" id="btn-ex-8" class="btn btn-danger">Reset</button>


                                    <div id="child2-form" class="sub sub-form mb-3 mt-3">

                                        <strong>Das ist die Sub-Sub Form</strong>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-floating">
                                                    <input type="text" name="name" class="form-control editable" placeholder="Test" autocomplete="off" value="Value aus 3">
                                                    <label>Test 3</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-floating">
                                                    <input type="text" name="diff3" class="form-control editable" placeholder="Diff" autocomplete="off" value="Value aus 3">
                                                    <label>Diff 3</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-floating">
                                                    <select class="form-select init-quickselect editable" name="laender" placeholder="Länder">
                                                        <option value="">bitte wählen</option>
                                                    </select>
                                                    <label>Länder</label>
                                                </div>
                                            </div>
                                        </div>

                                        <br>

                                        <!-- Absenden -->
                                        <button class="btn btn-primary">Submit</button>
                                        <button type="button" id="btn-ex-3" class="btn btn-secondary">Get Data</button>
                                        <button type="button" id="btn-ex-6" class="btn btn-secondary">Set Data</button>
                                        <button type="button" id="btn-ex-9" class="btn btn-danger">Reset</button>

                                    </div>

                                </div>




                            </form>



                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="mb-3">
                        <h5>Form</h5>
                        <div id="parent-result"><em>nothing yet</em></div>
                    </div>
                    <div class="mb-3">
                        <h5>Sub Form</h5>
                        <div id="child-result"><em>nothing yet</em></div>
                    </div>
                    <div class="mb-3">
                        <h5>Sub-Sub Form</h5>
                        <div id="child2-result"><em>nothing yet</em></div>
                    </div>
                </div>
            </div>



            </di>
        </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {

        var parent = new Form('#parent-form', {
            debug: true
        });
        var child = new Form('#child-form', {
            debug: true
        });
        var child2 = new Form('#child2-form', {
            debug: true
        });


        parent.on('submit', function() {
            showData('submit', 'parent', parent.getData());
        });

        child.on('submit', function() {
            showData('submit', 'child', child.getData());
        });

        child2.on('submit', function() {
            showData('submit', 'child2', child.getData());
        });

        $('#btn-ex-1').on('click', function() {
            showData('get', 'parent', parent.getData());
            console.log(parent.getData());
        });

        $('#btn-ex-2').on('click', function() {
            showData('get', 'child', child.getData());
            console.log(child.getData());
        });

        $('#btn-ex-3').on('click', function() {
            showData('get', 'child2', child2.getData());
            console.log(child2.getData());
        });

        $('#btn-ex-4').on('click', function() {
            var d = {
                name: 'Neu aus 1',
                diff1: 'Neu aus 1',
                laender: {"value":"KM","text":"Komoren"}
            }
            parent.setData(d);
            showData('set', 'parent', d);
        });

        $('#btn-ex-5').on('click', function() {
            var d = {
                name: 'Neu aus 2',
                diff2: 'Neu aus 2',
                laender:{"value":"UG","text":"Uganda"}
            };
            child.setData(d);
            showData('set', 'child', d);
        });

        $('#btn-ex-6').on('click', function() {
            var d = {
                name: 'Neu aus 3',
                diff3: 'Neu aus 3',
                laender: {"value":"EH","text":"Westsahara"}
            };

            child2.setData(d);
            showData('set', 'child2', d);
        });


        $('#btn-ex-7').on('click', function() {
            showData('reset', 'parent', {});
            parent.reset(1);
        });

        $('#btn-ex-8').on('click', function() {
            showData('reset', 'child', {});
            child.reset(1);
        });

        $('#btn-ex-9').on('click', function() {
            showData('reset', 'child2', {});
            child2.reset(1);
        });

        console.log(parent);
    });

   


    function showData(befehl, area, data) {
        $('#' + area + '-result').html(befehl + ' - ' + moment().format('HH:mm:ss'));
        $('#' + area + '-result').append("<pre>" + JSON.stringify(data, 2) + "</pre>");
    }
</script>

</html>