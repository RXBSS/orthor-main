<?php include('01_init.php');

$_page = [
    'title' => 'Forms'
];

?>

<!doctype html>
<html lang="de">

<head>
    <?php include('02_header.php'); ?>
</head>

<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">

                    <h4><i class="fa-solid fa-exclamation-circle"></i> Forms</h4>
                    <h6 class="subtext">Hier finden Sie ein Standard Formular.</h6>
                    <p class="mb-3">Weitere Informationen und die Dokumentation findet man auf <a href="https://getbootstrap.com/">https://getbootstrap.com/</a>.</p>


                    <div class="row">
                        <div class="col-md-3">


                            <!-- Example -->
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="Floating Text">
                                <label>Floating Text</label>
                            </div>

                            <div class="form-floating">
                                <input type="email" class="form-control" placeholder="Floating Mail">
                                <label>Floating E-Mail</label>
                            </div>

                            <div class="form-floating">
                                <input type="password" class="form-control" placeholder="Floating Password">
                                <label>Floating Password</label>
                            </div>

                            <div class="form-floating">
                                <input type="date" class="form-control" placeholder="Floating Date">
                                <label>Floating Date</label>
                            </div>

                            <div class="form-floating">
                                <input type="time" class="form-control" placeholder="Floating Time">
                                <label>Floating Time</label>
                            </div>

                            <div class="form-floating">
                                <select class="form-select" placeholder="Floating Select">
                                    <option>Bitte wählen</option>
                                    <option>Wert 1</option>
                                    <option>Wert 2</option>
                                    <option>Wert 3</option>
                                </select>
                                <label>Select</label>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Floating Textarea"></textarea>
                                <label>Floating Textarea</label>
                            </div>

                        </div>

                        <div class="col-md-3">

                            <!-- Example -->
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="Floating Text" value="Ich bin Text">
                                <label>Floating Text mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <input type="email" class="form-control" placeholder="Floating Mail" value="Ich bin eine Mail">
                                <label>Floating E-Mail mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <input type="password" class="form-control" placeholder="Floating Password" value="IchbineinPasswort">
                                <label>Floating Password mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <input type="date" class="form-control" placeholder="Floating Date" value="2021-08-02">
                                <label>Floating Date mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <input type="time" class="form-control" placeholder="Floating Time" value="10:50">
                                <label>Floating Time mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <select class="form-select" placeholder="Floating Select">
                                    <option value="Wert 1">Wert 1</option>
                                    <option value="Wert 2">Wert 2</option>
                                    <option value="Wert 3" selected>Wert 3</option>
                                </select>
                                <label>Select mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Floating Textarea">Ich bin ein Text in einer Textarea</textarea>
                                <label>Floating Textarea mit Wert</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <pre>
<code class="hljs language-html ctc"><!-- Input -->
<div class="form-floating">
    <input type="text" class="form-control" id="example-floating-text" placeholder="Floating Text" value="Ich bin Text">
    <label for="example-floating-text">Floating Text mit Wert</label>
</div></code>
</pre>

                            <pre>
<code class="hljs language-html ctc"><!-- Select -->
<div class="form-floating">
    <select class="form-control" id="example-floating-select" placeholder="Floating Select">
        <option value="Wert 1">Wert 1</option>
    </select>
    <label for="example-floating-time">Select mit Wert</label>
</div></code>
</pre>

                            <pre>
<code class="hljs language-html ctc"><!-- Textarea -->
<div class="form-floating">
    <textarea class="form-control"id="example-floating-textarea" placeholder="Floating Textarea">Ich bin ein Text in einer Textarea</textarea>
    <label for="example-floating-textarea">Floating Textarea mit Wert</label>
</div></code>
</pre>
                        </div>
                    </div>



                    <!--       <div class="row">
                        <div class="col-md-6">

                            <p>Es muss lediglich ein input mit type file eingebaut werden und dann kann man eine Datei auswählen</p>
                            <p>Das Button Browse ist versteckt durch input[type="file"] als hidden</p>
                            <div class="mb-3">
                                <label for="formFile" class="form-file-input draw-btn">Wählen Sie eine Datei</label>
                                <input class="" type="file"  name="file-input-form" id="formFile">
                            </div>

                        </div>
                    </div> -->
                </div>
            </div>

            <div class="card">
                <div class="card-body">

                    <h4><i class="fa-solid fa-exclamation-circle"></i> Forms</h4>
                    <h6 class="subtext">Hier finden Sie ein Standard Formular.</h6>
                    <p class="mb-3">Weitere Informationen und die Dokumentation findet man auf <a href="https://getbootstrap.com/">https://getbootstrap.com/</a>.</p>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="Floating Text" readonly>
                                <label>Floating Text</label>
                            </div>

                            <div class="form-floating">
                                <input type="email" class="form-control" placeholder="Floating Mail" readonly>
                                <label>Floating E-Mail</label>
                            </div>

                            <div class="form-floating">
                                <input type="password" class="form-control" placeholder="Floating Password" readonly>
                                <label>Floating Password</label>
                            </div>

                            <div class="form-floating">
                                <input type="date" class="form-control" placeholder="Floating Date" readonly>
                                <label>Floating Date</label>
                            </div>

                            <div class="form-floating">
                                <input type="time" class="form-control" placeholder="Floating Time" readonly>
                                <label>Floating Time</label>
                            </div>

                            <div class="form-floating">
                                <select class="form-select" placeholder="Floating Select" readonly>
                                    <option>Bitte wählen</option>
                                    <option>Wert 1</option>
                                    <option>Wert 2</option>
                                    <option>Wert 3</option>
                                </select>
                                <label>Select</label>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Floating Textarea" readonly></textarea>
                                <label>Floating Textarea</label>
                            </div>
                        </div>


                        <!-- GEFÜLLT! -->
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="Floating Text" value="Ich bin Text" readonly>
                                <label>Floating Text mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <input type="email" class="form-control" placeholder="Floating Mail" value="Ich bin eine Mail" readonly>
                                <label>Floating E-Mail mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <input type="password" class="form-control" placeholder="Floating Password" value="IchbineinPasswort" readonly>
                                <label>Floating Password mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <input type="date" class="form-control" placeholder="Floating Date" value="2021-08-02" readonly>
                                <label>Floating Date mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <input type="time" class="form-control" placeholder="Floating Time" value="10:50" readonly>
                                <label>Floating Time mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <select class="form-select" placeholder="Floating Select" readonly>
                                    <option value="Wert 1">Wert 1</option>
                                    <option value="Wert 2">Wert 2</option>
                                    <option value="Wert 3" selected>Wert 3</option>
                                </select>
                                <label>Select mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Floating Textarea" readonly>Ich bin ein Text in einer Textarea</textarea>
                                <label>Floating Textarea mit Wert</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="Floating Text" disabled>
                                <label>Floating Text</label>
                            </div>

                            <div class="form-floating">
                                <input type="email" class="form-control" placeholder="Floating Mail" disabled>
                                <label>Floating E-Mail</label>
                            </div>

                            <div class="form-floating">
                                <input type="password" class="form-control" placeholder="Floating Password" disabled>
                                <label>Floating Password</label>
                            </div>

                            <div class="form-floating">
                                <input type="date" class="form-control" placeholder="Floating Date" disabled>
                                <label>Floating Date</label>
                            </div>

                            <div class="form-floating">
                                <input type="time" class="form-control" placeholder="Floating Time" disabled>
                                <label>Floating Time</label>
                            </div>

                            <div class="form-floating">
                                <select class="form-select" placeholder="Floating Select" disabled>
                                    <option>Bitte wählen</option>
                                    <option>Wert 1</option>
                                    <option>Wert 2</option>
                                    <option>Wert 3</option>
                                </select>
                                <label>Select</label>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Floating Textarea" disabled></textarea>
                                <label>Floating Textarea</label>
                            </div>
                        </div>


                        <!-- GEFÜLLT! -->
                        <div class="col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="Floating Text" value="Ich bin Text" disabled>
                                <label>Floating Text mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <input type="email" class="form-control" placeholder="Floating Mail" value="Ich bin eine Mail" disabled>
                                <label>Floating E-Mail mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <input type="password" class="form-control" placeholder="Floating Password" value="IchbineinPasswort" disabled>
                                <label>Floating Password mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <input type="date" class="form-control" placeholder="Floating Date" value="2021-08-02" disabled>
                                <label>Floating Date mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <input type="time" class="form-control" placeholder="Floating Time" value="10:50" disabled>
                                <label>Floating Time mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <select class="form-select" placeholder="Floating Select" disabled>
                                    <option value="Wert 1">Wert 1</option>
                                    <option value="Wert 2">Wert 2</option>
                                    <option value="Wert 3" selected>Wert 3</option>
                                </select>
                                <label>Select mit Wert</label>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Floating Textarea" disabled>Ich bin ein Text in einer Textarea</textarea>
                                <label>Floating Textarea mit Wert</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='card'>
                <div class='card-body'>

                    <h4><i class="fa-solid fa-exclamation-circle"></i> Checks & Radios</h4>
                    <h6 class="subtext">Hier finden Sie ein Checkboxen und Radios.</h6>

                    <div class="row">
                        <div class="col-md-6">
                            <p>Das sind standard Checkboxen</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault"> Default checkbox </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked"> Checked checkbox</label>
                            </div>

                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>Das sind Disabled Checkboxen</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDisabled" disabled>
                                <label class="form-check-label" for="flexCheckDisabled">Disabled checkbox</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedDisabled" checked disabled>
                                <label class="form-check-label" for="flexCheckCheckedDisabled">Disabled checked checkbox</label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>Das sind Standard Radios</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1"> Default radio</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2"> Default checked radio</label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>Das sind disabled Radios</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" disabled>
                                <label class="form-check-label" for="flexRadioDisabled"> Disabled radio</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioCheckedDisabled" checked disabled>
                                <label class="form-check-label" for="flexRadioCheckedDisabled">Disabled checked radio</label>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>Das sind checkbox als Switches dargestellt</p>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDisabled" disabled>
                                <label class="form-check-label" for="flexSwitchCheckDisabled">Disabled switch checkbox input</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckCheckedDisabled" checked disabled>
                                <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Disabled checked switch checkbox input</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class='card'>
                <div class='card-body'>

                    <h4><i class="fa-solid fa-exclamation-circle"></i> Range</h4>
                    <h6 class="subtext">Hier finden Sie einen Strahl den man Custom anpassen kann. <br> Hier muss als input-type <mark>"range"</mark> mitgegeben werden.</h6>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>Eine Standard Range.</p>
                            <label for="customRange1" class="form-label">Example range</label>
                            <input type="range" class="form-range" id="customRange1">
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>

                    <hr>


                    <div class="row">
                        <div class="col-md-6">
                            <p>Disables Range </p>
                            <label for="disabledRange" class="form-label">Disabled range</label>
                            <input type="range" class="form-range" id="disabledRange" disabled>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>Man kann auch <mark>Min</mark> und <mark>Max</mark> Werte mitgeben.</p>
                            <label for="customRange2" class="form-label">Example range</label>
                            <input type="range" class="form-range" min="0" max="5" id="customRange2">
                        </div>
                    </div>


                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>Man kann auch die Schreitweite als Attribut <mark>step</mark> mitgeben. Hier sind es <mark>step="0.5"</mark> </p>
                            <label for="customRange3" class="form-label">Example range</label>
                            <input type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3">
                        </div>
                    </div>




                </div>
            </div>
            <div class='card' id="mypad">
                <div class='card-body'>
                    <h4><i class='fas fa-exclamation-circle'></i> Signature Pad</h4>

                    <hr>

                    <div class="row">
                        <div class="col">
                            <ol>
                                <li>ID vergeben</li>
                                <li>Klasse aufrufen und ID als parameter mitgeben. <br> In der Klasse wird das Canvas gesucht, gefunden und als SigPad erstellt</li>
                            </ol>
                        </div>
                    </div>

                    <hr>

                    <h6 class='subtext'>Hier ist ein Beispiel Unterschriftenfeld.</h6>

                    <div class="row">
                        <div class="col-md-6">


                            <canvas id="signaturePad" width=400 height=200 style="border: 1px solid black;"></canvas>


                            <br>

                            <div>
                                <button class="btn btn-primary sig-save">Speichern</button>
                                <button class="btn btn-light sig-clear">Löschen</button>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <h5>1.</h5>
                            <pre><code class="hljs language-html ctc"><!-- HTML Code -->
        
<div class='card' id="myPad">
    <div class='card-body'>

        <canvas id="signaturePad" width=400 height=200 style="border: 1px solid black;"></canvas>
    </div>
</div>

<div>
    <button class="btn btn-primary sig-save">Speichern</button>
    <button class="btn btn-light sig-clear">Löschen</button>
</div></code></pre>
                            <h5>2.</h5>
                            <pre><code class="hljs ctc">// Init Signature Pad   
var signaturePad = new Signature('#mypad');

</code></pre>

                        </div>
                    </div>






                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-indent"></i> Alignment Tests</h4>
                    <h6 class="subtext">Hier soll festgestellt werden, dass die verschiedenen Inputs auch sauber nebeneinander passen.</h6>


                    <form id="test-form">

                        <div class="row">
                            <div class="col-2">
                                <div class="form-group form-floating">
                                    <input type="text" name="name" class="form-control editable" placeholder="Bezeichnung">
                                    <label>Bezeichnung</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group form-floating">
                                    <select class="form-select init-quickselect editable" name="laender" placeholder="label" required>
                                        <option value="">bitte wählen</option>
                                    </select>
                                    <label>label</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group form-floating">
                                    <select class="form-select init-quickselect editable" name="laender" placeholder="label" multiple>
                                        <option value="">bitte wählen</option>
                                    </select>
                                    <label>label</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group form-floating">
                                    <input type="text" name="name" class="form-control editable" placeholder="Bezeichnung">
                                    <label>Bezeichnung</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group form-floating-check">
                                    <label class="form-label">Checkbox Inline</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="id-1" name="name_1" value="1" />
                                        <label class="form-check-label" for="id">Wert</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group form-floating-check">
                                    <label class="form-label">Radio Inline</label>
                                    <div class="form-radio form-check-inline">
                                        <input class="form-check-input" type="radio" id="cb-5-1" name="cbradioinline" value="option1">
                                        <label class="form-check-label" for="cb-5-1">Wert 1</label>
                                    </div>
                                    <div class="form-radio form-check-inline">
                                        <input class="form-check-input" type="radio" id="cb-5-2" name="cbradioinline" value="option2">
                                        <label class="form-check-label" for="cb-5-2">Wert 2</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                </div>
            </div>
        </div>

    </div>

</body>
<?php include('04_scripts.php'); ?>

<!-- SignaturePad Include -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

<script>
    $(document).ready(function() {

        // Init Signature Pad
        var signaturePad = new Signature('#mypad');

        var form = new Form('#test-form');

    });
</script>

</html>