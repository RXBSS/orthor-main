<?php include('01_init.php');

$_page = [
    'title' => "Form Creator",
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
                    <h4 class="card-title"><i class="fa-solid fa-plus"></i> Form Creator</h4>
                    <h6 class="subtext">Mit Hilfe des Form-Creators kann mann dynamische Forms über JavaScript hinzufügen</h6>

                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                Die Funktionen zum Erstellen fangen alle mit <code>create</code> an und erstellen das HTML Grundgerüst der jeweiligen Form.
                                Mit jeder Funktion können Standard-Einstellungen übergeben werden. Wenn man eine dynamische Form erstellt, hat man aber öfter die gleichen Einstellungen.
                                Deshalb kann man die Standard-Werte schon beim Erstellen der Klasse anpassen.


                            </p>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">// Default Optionen der Klasse
var fc = new FormCreator();

fc.createInput('name','Label','value', {
    // Hier die Optionen für das Feld
});
</code></pre>
                            <pre><code class="language-js ctc">// Geänderte Default Optionen für die Klasse
var myDefaultOptions = {
    floating: false,
    label: false
};

var fc = new FormCreator(myDefaultOptions);

fc.createInput('name','Label','value', {
    // Hier die Optionen für das Feld
});
</code></pre>


                        </div>
                    </div>



                </div>
            </div>



            <div class="card">
                <div class="card-body">

                    <h4 class="card-title"><i class="fa-solid fa-plus"></i> Create-Funktionen</h4>

                    <div class="mt-3">
                        <p>
                            <strong>Einstellungen</strong><br>
                            Die meisten Einstellungen gelten global. Sollte sich in einer Funktion eine Einstellung ander verhalten, ist dies entsprechend in der Funktion dokumentiert.
                        </p>


                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Standard</th>
                                    <th>Beschreibung</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>id</code></td>
                                    <td><code>false</code></td>
                                    <td>Die ID des Elements</td>
                                </tr>
                                <tr>
                                    <td><code>showLabel</code></td>
                                    <td><code>true</code></td>
                                    <td>Entscheidet ob das Label angezeigt wird oder nicht</td>
                                </tr>
                                <tr>
                                    <td><code>required</code></td>
                                    <td><code>false</code></td>
                                    <td>Gibt an ob das required-Attribut gesetzt wird oder nicht</td>
                                </tr>
                                <tr>
                                    <td><code>readonly</code></td>
                                    <td><code>false</code></td>
                                    <td>Gibt an ob das Feld auslesbar ist. Bei manchen wird Readonly und bei machen disabled gesetzt</td>
                                </tr>
                                <tr class="bg-warning">
                                    <td><code>tooltip</code></td>
                                    <td><code>false</code></td>
                                    <td>Wenn aktiv, kann hier ein Tooltip übergeben werden. Aktuell noch nicht programmiert!</td>
                                </tr>
                                <tr>
                                    <td><code>placeholder</code></td>
                                    <td><code>true</code></td>
                                    <td>Gibt an ob der Placeholder angezeigt werden soll. Hier kann auch der Text übergeben werden. Achtung: Bei Floating Form gibt es keinen Placeholder. Dieser ist ja automatisch das Label.</td>
                                </tr>
                                <tr>
                                    <td><code>editable</code></td>
                                    <td><code>true</code></td>
                                    <td>Entscheidet ob die Klasse editable mit übergeben werden soll</td>
                                </tr>
                                <tr>
                                    <td><code>class</code></td>
                                    <td><code>[]</code></td>
                                    <td>Ein Array an Klasse, die in das Objekt eingefügt werden. Diese werden nicht gemergt!</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>createInput</strong><br>
                                Diese Klasse dient zum Erstellen aller textbasierten Input-Felder. Diese haben jeweils noch Ihre eigene Funktion.
                                Man kann entweder diese Funktion aufrufen und den Parameter <code>type</code> mit übergeben, oder man ruft die einzelnen Funktionen auf.

                            <ul>
                                <li>Text = <code>createText</code></li>
                                <li>Password = <code>createPassword</code></li>
                                <li>Mail = <code>createMail</code></li>
                                <li>Date = <code>createDate</code></li>
                                <li>Time = <code>createTime</code></li>
                            </ul>
                            </p>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-1-1"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Beispiel für Text
fc.createInput('text','example1', 'Beispiel 1');</code></pre>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-1-2"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Beispiel für Date
fc.createInput('date','example2', 'Beispiel 2');</code></pre>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>



                    <!-- Beispiele - Input Text -->
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>createText</strong><br>
                                Erstellt ein einfaches Textfeld
                            </p>
                        </div>
                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-2-1"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Beispiel ohne Value
fc.createText('example1', 'Beispiel 1');</code></pre>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-1">
                                <div class="col-md-6">
                                    <div id="example-2-2"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Beispiel mit Value
fc.createText('example1', 'Beispiel 2', 'Mein Wert');</code></pre>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-1">
                                <div class="col-md-6">
                                    <div id="example-2-3"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Beispiel mit Optionen
fc.createText('example1', 'Beispiel 3', null, {
    floating: false,
    placeholder: false
});</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Beispiele - Input Email -->
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>createMail</strong><br>
                                Erstellt ein einfaches E-Mail Feld
                            </p>
                        </div>
                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-3-1"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Einfaches Beispiel
fc.createMail('example1', 'Beispiel 1');</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Beispiele - Input Password -->
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>createPassword</strong><br>
                                Erstellt ein einfaches Password Feld
                            </p>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-4-1"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Einfaches Beispiel
fc.createPassword('example1', 'Beispiel 1');</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Beispiele - Input Date -->
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>createDate</strong><br>
                                Erstellt ein einfaches Datums Feld
                            </p>
                        </div>
                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-5-1"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Einfaches Beispiel
fc.createDate('example1', 'Beispiel 1');</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Beispiele - Input Time -->
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>createTime</strong><br>
                                Erstellt ein einfaches Zeit Feld
                            </p>
                        </div>
                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-6-1"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Einfaches Beispiel
fc.createTime('example1', 'Beispiel 1');</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Beispiele - Input Time -->
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>createSelect</strong><br>
                                Erstellt ein Select Feld
                            </p>

                            <p>
                                Hier muss man als Argument noch die Werte hinzufügen, die zur Auswahl stehen, mitgeben.<br><br>
                                Man kann entweder ein Array mit Strings übergeben, dann wird Sowohl Text als auch Wert als ein solcher gesetzt:<br>
                                <code>['Wert A', 'Wert B', ...]</code><br>
                                <br>
                                Oder man übergibt ein Array mit Objekten:<br>
                                <code>[{value: 'A', text: 'Value A'}, {...}, ...]</code><br>
                            </p>
                            <br>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Standard</th>
                                        <th>Beschreibung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>mutli</code></td>
                                        <td><code>false</code></td>
                                        <td>Ob es ein Multi-Select wird</td>
                                    </tr>
                                    <tr>
                                        <td><code>standard</code></td>
                                        <td><code>true</code></td>
                                        <td>
                                            Bei false = Kein Default Wert<br>
                                            Bei True = Default Wert "Bitte wähle" ohne Value<br>
                                            Kann auch ein Objekt sein:<br>
                                            <code>
                                                {text: "Standard", value: "50"}
                                            </code>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-7-1"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Einfaches Beispiel
fc.createSelect('example1', 'Beispiel 1');</code></pre>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-7-2"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Komplexeres Beispiel - Wert vorausgewählt
var selected = 2;

fc.createSelect('example2', 'Beispiel 2', [
    {value: 1, text: 'Wert 1'},
    {value: 2, text: 'Wert 2'},
    {value: 3, text: 'Wert 3'}
], selected, {
    // Eigener Standardwert
    standard: {value: 'a', text: '-- Custom Standard'}      
})</code></pre>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-7-3"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Standard Werte
var values = ['Wert A', 'Wert B', 'Wert C'];

// Mit Multi
fc.createSelect('example1', 'Beispiel 3', values, null, {
    standard: false,
    multi: true
})
                                    </code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Beispiele - Checkbox -->
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>createCheckbox</strong><br>
                                Erstellt eine einfache Checkbox.
                            </p>

                            <p>
                                Als Wert übergibt man entweder einen Boolean oder ein Objekt in dem <code>text</code> und <code>checked</code> definiert sind.
                                Wenn ein Boolean übergeben wird, ist der Text anschließend "Aktiviert". Wenn man keinen Wert übergeben will, dann muss man einen Emtpy String übergeben.
                            </p>
                        
                            <p>
                                <code>showLabel</code> blendet hier auch das Label aus. Wenn <code>false</code> dann wird das Label automatisch als Beschreibungstext neben 
                                die Checkbox gesetzt. Dieser kann sonst nur über den Wert gesetzt werden.
                            </p>

                            <br><br>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Standard</th>
                                        <th>Beschreibung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><code>switch</code></td>
                                        <td><code>false</code></td>
                                        <td>
                                            Ob es eine Standard Checkbox sein soll oder ein Switch
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-8-1"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Einfaches Beispiel
fc.createCheckbox('example1', 'Beispiel 1');</code></pre>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-8-2"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Beispiel mit Checked
fc.createCheckbox('example2', 'Beispiel 2', true);</code></pre>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-8-3"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Beispiel mit Custom Text
fc.createCheckbox('example3', 'Beispiel 3', {
    text: 'Ein Beispiel text',
    checked: true
})</code></pre>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="example-8-4"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <pre><code class="language-js ctc">// Beispiel ohne Label
fc.createCheckbox('example4', 'Beispiel 4', true, {
    showLabel: false
})</code></pre>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="example-8-5"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <pre><code class="language-js ctc">// Beispiel ohne Label
fc.createCheckbox('example4', 'Beispiel 4', true, {
    switch: true
})</code></pre>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="example-8-6"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <pre><code class="language-js ctc">// Beispiel ohne Label
fc.createCheckbox('example4', 'Beispiel 6', {
    text: 'Hallo Welt'
    checked: false
});</code></pre>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="example-8-7"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <pre><code class="language-js ctc">// Beispiel ohne Label
fc.createCheckbox('example87', 'Beispiel 7', {
    text: '&lti class="fa-solid fa-wand-sparkles">&lt/i> Mit Icon'
})</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Beispiele - Switch -->
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>createSwitch</strong><br>
                                Erstellt eine einfache Switch. Dabei wird nichts weiter gemacht, als das Option-Flag switch auf `true` gesetzt.
                            </p>
                        </div>
                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-9-1"></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Einfaches Beispiel
fc.createSwitch('example1', 'Beispiel 1');</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <!-- Beispiele - Radio -->
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>createRadio</strong><br>
                                Erstellt eine einfache Radio
                            </p>
                        </div>
                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-10-1"><em>Todo</em></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Einfaches Beispiel
fc.createRadio('example1', 'Beispiel 1');</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- Beispiele - Radio -->
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <strong>createTextarea</strong><br>
                                Erstellt eine einfache Textarea
                            </p>
                        </div>
                        <div class="col-md-8">

                            <div class="row">
                                <div class="col-md-6">
                                    <div id="example-11-1"><em>Todo</em></div>
                                </div>
                                <div class="col-md-6">
                                    <pre><code class="language-js ctc">// Einfaches Beispiel
fc.createTextarea('example1', 'Beispiel 1');</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MOCKUP GENERATOR
            ######################################## -->


            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-wand-sparkles"></i> Mockup Generator</h4>
                    <h6 class="subtext">Mit diesem kleinen Tool, kann man sich den HTML Quellcode für ein Feld zusammenstellen</h6>

                    <form id="mockup-generator">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="name" class="form-control editable" placeholder="Name" autocomplete="off" value="name">
                                            <label>Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="label" class="form-control editable" placeholder="Name" autocomplete="off" value="Label">
                                            <label>Label</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-floating">
                                            <input type="text" name="value" class="form-control editable" placeholder="Wert" autocomplete="off" value="">
                                            <label>Values</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-floating">
                                            <select class="form-select editable" name="function" placeholder="Element" style="height: 250px;" multiple>
                                                <option value="createText" selected>Text</option>
                                                <option value="createMail">Mail</option>
                                                <option value="createPassword">Passwort</option>
                                                <option value="createDate">Datum</option>
                                                <option value="createTime">Time</option>
                                                <option value="createSelect">Select</option>
                                                <option value="createCheckbox">Checkbox</option>
                                                <option value="createSwitch">Switch</option>
                                                <option value="createRadio">Radio</option>
                                                <option value="createTextarea">Textarea</option>
                                            </select>
                                            <label>Element</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group form-floating-check">
                                            <label class="form-label">Optionen</label>
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input editable" id="generator-1" name="showLabel" value="1" checked />
                                                <label class="form-check-label" for="generator-1">Zeige Label (showLabel)</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input editable" id="generator-2" name="required" value="1" />
                                                <label class="form-check-label" for="generator-2">Validierung (required)</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input editable" id="generator-2-2" name="readonly" value="1" />
                                                <label class="form-check-label" for="generator-2-2">Read-Only (readonly)</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input editable" id="generator-3" name="tooltip" value="1" disabled />
                                                <label class="form-check-label" for="generator-3">Tooltip (tooltip)</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input editable" id="generator-4" name="floating" value="1" checked />
                                                <label class="form-check-label" for="generator-4">Floating (floating)</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input editable" id="generator-5" name="placeholder" value="1" checked />
                                                <label class="form-check-label" for="generator-5">Placeholder (placeholder)</label>
                                            </div>

                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input editable" id="generator-6" name="editable" value="1" checked />
                                                <label class="form-check-label" for="generator-6">Editable (editable)</label>
                                            </div>
                                        </div>


                                        <!--

                                        <em>Nur bei Select</em>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input editable" id="generator-7" name="mutli" value="1" />
                                            <label class="form-check-label" for="generator-7">Multi (multi)</label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input editable" id="generator-8" name="standard" value="1" checked />
                                            <label class="form-check-label" for="generator-8">Standard-Wert (standard)</label>
                                        </div>
-->
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-primary">Erstellen</button>
                                    <button id="form-reset" type="button" class="btn btn-danger">Reset</button>
                                </div>


                            </div>

                            <div class="col-md-6">
                                <strong>Beispiel</strong>
                                <div id="generator-sample">
                                    <em>Noch nichts generiert</em>
                                </div>
                                <hr>
                                <strong>Code</strong>
                                <pre><code class="language-html ctc" id="generator-code">// Noch nichts generiert</code></pre>
                            </div>


                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {

        // Form Creator
        var fc = new FormCreator();

        // Input
        // ###############################################

        writeExample('1-1', fc.createInput('text', 'example1', 'Beispiel 1'));
        writeExample('1-2', fc.createInput('date', 'example2', 'Beispiel 2'));

        // Text 
        // ###############################################

        writeExample('2-1', fc.createText('example1', 'Beispiel 1'));

        writeExample('2-2', fc.createText('example1', 'Beispiel 2', 'Mein Wert'));

        writeExample('2-3', fc.createText('example1', 'Beispiel 3', null, {
            floating: false,
            placeholder: false
        }));

        // Weiter Input Felder 
        // ###############################################

        writeExample('3-1', fc.createMail('example1', 'Beispiel 1'));
        writeExample('4-1', fc.createPassword('example1', 'Beispiel 1'));
        writeExample('5-1', fc.createDate('example1', 'Beispiel 1'));
        writeExample('6-1', fc.createTime('example1', 'Beispiel 1'));

        // Select Felder 
        // ###############################################
        writeExample('7-1', fc.createSelect('example1', 'Beispiel 1', ['Wert A', 'Wert B', 'Wert C']));
        writeExample('7-2', fc.createSelect('example2', 'Beispiel 2', [{
                value: 1,
                text: 'Wert 1'
            },
            {
                value: 2,
                text: 'Wert 2'
            },
            {
                value: 3,
                text: 'Wert 3'
            }
        ], 2, {
            standard: {
                value: 'a',
                text: '-- Custom Standard'
            }
        }));

        writeExample('7-3', fc.createSelect('example1', 'Beispiel 3', ['Wert A', 'Wert B', 'Wert C'], null, {
            standard: false,
            multi: true
        }));

        // Checkbox
        writeExample('8-1', fc.createCheckbox('example81', 'Beispiel 1'));
        writeExample('8-2', fc.createCheckbox('example82', 'Beispiel 2', true));
        writeExample('8-3', fc.createCheckbox('example83', 'Beispiel 3', {
            text: 'Ein Beispiel text',
            checked: true
        }));
        writeExample('8-4', fc.createCheckbox('example84', 'Beispiel 4', true, {
            showLabel: false
        }));
        writeExample('8-5', fc.createCheckbox('example85', 'Beispiel 5', true, {
            switch: true
        }));
        writeExample('8-6', fc.createCheckbox('example86', 'Beispiel 6', {
            text: ''
        }));
        writeExample('8-7', fc.createCheckbox('example87', 'Beispiel 7', {
            text: '<i class="fa-solid fa-wand-sparkles"></i> Mit Icon'
        }));

        // Switch
        writeExample('9-1', fc.createSwitch('example91', 'Beispiel 1'));



        // Generator 
        var form = new Form('#mockup-generator');


        form.on('submit', function() {
            var data = form.getData();

            // Nur eine, obwohl Multi
            var func = data.function[0].value;

            var name = data.name || "name";
            var label = data.label || "Label";
            var value = data.value || "";

            // Optionen 
            var opts = {
                showLabel: data.showLabel.checked,
                required: data.required.checked,
                readonly: data.readonly.checked,
                tooltip: data.tooltip.checked,
                placeholder: data.placeholder.checked,
                editable: data.editable.checked,
            };

            // Alle Text-Inputs
            if (['createText', 'createMail', 'createPassword', 'createDate', 'createTime'].indexOf(func) >= 0) {

                // Funktion ausführen
                result = fc[func](name, label, value, opts);

            } else {

                // 
                result = fc[func](name, label, value, null, opts);
            }


            // Daten schreiben
            $('#generator-sample').html(result);
            $('#generator-code').empty().text(result);

            // Highlight
            hljs.highlightElement($('#generator-code').get(0));

            // Kopierbar machen
            $('#generator-code').copyToClipboard({
                buttonText: 'Kopieren',
                themeClass: 'theme-orthor',
                callback: function() {
                    app.notify.success.fire("Kopiert", "Der Text wurde in die Zwischenablage kopiert");
                }
            });

            // Notify
            app.notify.success.fire("Erstellt", "Das Layout wurde erstellt");

        });

        $('#form-reset').on('click', function() {
            form.reset(0);
            $('#generator-sample').empty();
            $('#generator-code').empty();
        });

    });




    // Schreiben
    function writeExample(key, html) {
        $('#example-' + key).html(html);
    }
</script>

</html>