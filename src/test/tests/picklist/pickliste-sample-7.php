<?php include('01_init.php');

if (isset($_POST['task'])) {




    if ($_POST['task'] == 'set-test') {

        $req = new Request([
            'example_id' => 7,
            'filter_id' => 30000
        ]);

        $req->insert("example_disable", [['t', 'example_id'], ['t', 'filter_id']]);

        $req->echoAnswer();
    } else if ($_POST['task'] == 'remove-test') {

        $req = new Request();
        $query = "DELETE FROM `example_disable` WHERE `example_id` = '7' AND `filter_id` = '30000'";
        $req->deleteQuery($query);
        $req->echoAnswer();
    }


    die();
}



$_page = [
    'title' => "Disabled",
    'breadcrumbs' => ["<a href='pickliste'><i class=\"fas fa-list\"></i> Pickliste</a>"]
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
                    <h4 class="card-title"><i class="fa-solid fa-ban"></i> Disabled</h4>
                    <h6 class="subtext">Zusatz-Funktion zum Ausblenden von Rows</h6>


                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                Der Pickliste kann ein Parameter names <strong>disabled</strong> übergeben werden.
                                Dieser Parameter sorgt dafür, dass Zeilen in der Tabelle nicht mehr auswählbar sind.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Option</th>
                                        <th>Typ</th>
                                        <th>Default</th>
                                        <th>Erklärung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>Boolean</code></td>
                                        <td><code>Boolean</code></td>
                                        <td>false</td>
                                        <td>Wird false übergeben, passiert nichts weiter</td>
                                    </tr>
                                    <tr>
                                        <td><code>Array</code></td>
                                        <td><code>Array</code></td>
                                        <td>false</td>
                                        <td>Wird der Parameter als Array übergeben</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>field</td>
                                        <td><code>String</code></td>
                                        <td>'id'</td>
                                        <td>Hier kann der Feldname oder der Index angegeben werden. Auf dieses Feld wird der Filter angewendet.</td>
                                    </tr>
                                    <tr>
                                        <td>icon</td>
                                        <td><code>String</code></td>
                                        <td>false</td>
                                        <td>Wird nichts übergeben, dann wird das Standard-Icon benutzt. Wird hier ein Icon übergeben, wird dieses bei
                                            den Disabled Rows angezeigt
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>data</td>
                                        <td><code>Array</code></td>
                                        <td>[]</td>
                                        <td>Die Daten, die gefiltert werden sollen. Sollte zusätzlich Query mitangegeben werden, werden diese überschrieben!</td>
                                    </tr>
                                    <tr>
                                        <td>query</td>
                                        <td><code>Object</code></td>
                                        <td>false</td>
                                        <td>
                                            Das Objekt zum Auslesen der Daten aus der Datenbank:<br>
                                            <strong>table</strong> = Die Tabelle die ausgelesen werden soll<br>
                                            <strong>field</strong> = Das Feld das ausgelesen werden soll<br>
                                            <strong>filter</strong> = Die Filter die gesetzt werden sollen<br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>query</td>
                                        <td><code>String</code></td>
                                        <td>false</td>
                                        <td>
                                            Wird der Parameter als String übergeben, dann wird diese Query zum Filtern genutzt
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>



                </div>
            </div>





            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">

                            <strong>Einfacher Filter mit Array</strong><br>

                            <p>
                                Übergabe der Daten als einfaches Array
                            </p>

                            <pre><code class="language-js ctc">var picklist = new Picklist("#example", 'example', {
    type: 'multi-picklist',
    disabled: [5, 6, 7]
});</code></pre>

                            <br>
                            <button class="btn btn-primary btn-test-1">Get Selected</button>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div id="example-picklist-1"></div>
                </div>
            </div>


            <hr>

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">

                            <strong>Filter mit Objekt</strong><br>

                            <p>
                                Übergabe der Daten als Objekt. Hier können dann noch weitere Parameter, wie zum Beispiel das Icon mitgegeben werden.
                            </p>

                            <pre><code class="language-js ctc">var picklist = new Picklist("#example", 'example', {
    type: 'multi-picklist',
    disabled: {
        data: [5, 6, 7],
        icon: '&lti class="fa-solid fa-check-double text-primary">&lt/i>'
    },
});</code></pre>

                            <br>
                            <button class="btn btn-primary btn-test-2">Get Selected</button>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div id="example-picklist-2"></div>
                </div>
            </div>


            <hr>


            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">

                            <strong>Filter auf anderes Feld</strong><br>

                            <p>
                                Hier wird ein Feldname mitgegeben auf den der Filter übertragen wird
                            </p>

                            <pre><code class="language-js ctc">var picklist = new Picklist("#example", 'example', {
    type: 'multi-picklist',
    disabled: {
        field: 'name',
        data: ['Titel C','Titel D', 'Titel E'],
        icon: '&lti class="fa-solid fa-skull text-danger">&lt/i>'
    },
});</code></pre>

                            <br>
                            <button class="btn btn-primary btn-test-3">Get Selected</button>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div id="example-picklist-3"></div>
                </div>
            </div>


            <hr>


            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">

                            <strong>Filter aus der Datenbank</strong><br>

                            <p>
                                Man kann den Filter auch aus der Datenbank beziehen. Siehe Beispiel-Datenbank <strong>example_disable</strong>
                            </p>

                            <pre><code class="language-js ctc">var picklist = new Picklist("#example", 'example', {
    type: 'multi-picklist',
    disabled: {
        query: {
            table: 'example_disable',
            field: 'example_id',
            filter: {
                filter_id: '30000'
            }
        },
        icon: '&lti class="fa-solid fa-check-double text-primary">&lt/i>'
    }
});</code></pre>

                            <hr>
                            <p>
                                Die Query zum auslesen wird nur zu Beginn ausgeführt. Man kann aber durch aufrufen verschiedener Funktionen das ganze Refreshen
                            </p>

                            <div class="mb-3">
                                <button class="btn btn-secondary" id="btn-test-7">No. 7 hinzufügen</button>
                                <button class="btn btn-danger" id="btn-test-8">No. 7 löschen</button>
                                <button class="btn btn-success" id="btn-test-9">Refresh</button>
                            </div>


                            <pre><code class="language-js ctc">// Bei einem Refresh wird die Query erneut ausgeführt
picklist.refresh();</code></pre>

                            <hr>

                            <p>
                                Man kann auch die Query verändern. Dazu gibt es die Funktion <strong>updateDisabled</strong>. Dabei reicht es, nur die veränderten
                                Werte anzugeben. Diese werden mit den vorherigen Werte gemergt.
                            </p>
                            <pre><code class="language-js ctc">// Filter-Objekt Teile die gemergt werden sollen
var query = {
    filter: {
        example_id: 20000
    }
}    

// Update Disabeld
picklist.updateDisabled(query);</code></pre>


                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        <br>
                                        In diesem Beispiel wurde die ID der zu filternden Objekte an das Change Event der Radios gekoppelt.
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <form id="filter-form">
                                        <div class="form-group form-floating-radio">
                                            <label class="form-label">Auswahl</label>
                                            <div class="form-radio">
                                                <input type="radio" class="form-check-input editable" id="auswahl-1" name="auswahl" value="10000" />
                                                <label class="form-check-label" for="auswahl-1">10000</label>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" class="form-check-input editable" id="auswahl-2" name="auswahl" value="20000" />
                                                <label class="form-check-label" for="auswahl-2">20000</label>
                                            </div>
                                            <div class="form-radio">
                                                <input type="radio" class="form-check-input editable" id="auswahl-3" name="auswahl" value="30000" />
                                                <label class="form-check-label" for="auswahl-3">30000</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>


                <div class="col-6">
                    <div id="example-picklist-4"></div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">

                            <strong>Query als String</strong><br>

                            <p>
                                Es kann sein, dass man eine komplexere Query angeben möchte. Dann kann man dies natürlich ebenfalls tun.
                                Dann übergibt man die Query als String.
                            </p>

                            <pre><code class="language-js ctc">var picklist = new Picklist("#example", 'example', {
    type: 'multi-picklist',
    disabled: {
        query: "SELECT `example_id` FROM `example_disable` WHERE `id` > 7"
    }
});</code></pre>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div id="example-picklist-5"></div>
                </div>
            </div>


            <hr>

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">

                            <strong>Funktioniert auch bei Nicht-Select Listen</strong><br>

                            <p>
                                Man kann die Funktion auch bei "Nicht-Select" Listen nutzen, da ist die Auswirkung dann allerdings nur optisch
                            </p>

                            <pre><code class="language-js ctc">var picklist = new Picklist("#example", 'example', {
    type: 'simple',
    disabled: [5, 6, 7]
});</code></pre>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div id="example-picklist-6"></div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {


        // Beispiel 1

        var picklist1 = new Picklist("#example-picklist-1", 'example', {
            type: 'multi-picklist',
            disabled: [5, 6, 7],
            pageLength: 10
        });

        // 
        $('.btn-test-1').on('click', function() {
            var selected = picklist1.getSelected();
            console.log(selected);
        });

        // --------------------

        var picklist2 = new Picklist("#example-picklist-2", 'example', {
            type: 'multi-picklist',
            disabled: {
                fieldName: 'id',
                data: [5, 6, 7],
                icon: '<i class="fa-solid fa-check-double text-primary"></i>'
            },
            pageLength: 10
        });


        $('.btn-test-2').on('click', function() {
            var selected = picklist1.getSelected();
            console.log(selected);
        });


        // ---

        var picklist3 = new Picklist("#example-picklist-3", 'example', {
            type: 'multi-picklist',
            disabled: {
                field: 'name',
                data: ['Titel C', 'Titel D', 'Titel E'],
                icon: '<i class="fa-solid fa-skull text-danger"></i>'
            },
            pageLength: 10
        });

        // ---

        var picklist4 = new Picklist("#example-picklist-4", 'example', {
            type: 'multi-picklist',
            disabled: {
                query: {
                    table: 'example_disable',
                    field: 'example_id',
                    filter: {
                        filter_id: '30000'
                    }
                },
                icon: '<i class="fa-solid fa-check-double text-primary"></i>'
            },
            pageLength: 20
        });

        $('#btn-test-7').on('click', function() {
            app.simpleRequest("set-test", "pickliste-sample-7", null, function(response) {
                console.log(response);
                app.notify.success.fire("Erfolgreich", "Der Wert wurde in die Datenbank eingefügt. Jetzt muss Refresh gedrückt werden");
            });
        });

        $('#btn-test-8').on('click', function() {
            app.simpleRequest("remove-test", "pickliste-sample-7", null, function(response) {
                console.log(response);
                app.notify.success.fire("Erfolgreich", "Der Wert wurde aus der Datenbank gelöscht. Jetzt muss Refresh gedrückt werden");
            });
        });

        $('#btn-test-9').on('click', function() {
            picklist4.refresh();
        });

        var form = new Form('#filter-form');

        form.on('change', function() {

            var data = form.getData();

            app.notify.success.fire("Radio geändert", "Der Wert wurde angepasst");

            picklist4.updateDisabled({
                filter: {
                    filter_id: data['auswahl']
                }
            })

        });

        // ----------------------


        var picklist5 = new Picklist("#example-picklist-5", 'example', {
            type: 'multi-picklist',
            disabled: {
                query: "SELECT `example_id` FROM `example_disable` WHERE `id` > 7"
            },
            pageLength: 10
        });

        // ----------------------

        var picklist6 = new Picklist("#example-picklist-6", 'example', {
            type: 'simple',
            disabled: [5, 6, 7],
            pageLength: 10
        });



    });
</script>

</html>