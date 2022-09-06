<?php include('01_init.php');

$_page = [
    'title' => "CopyForms"
];

?>
<!doctype html>

<head>
    <?php include('02_header.php'); ?>


    <style>

    </style>
</head>

<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper" id="copyForms">
        <div class="container-fluid">
            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fas fa-info-circle'></i> Forms zum Kopieren</h4>

                    <h6 class='subtext'>Hier findest du eine Seite wo alle Formkomponenten aufgelistet sind die man alle wegkopieren kann.</h6>
                    <p class="mb-3">Weitere Informationen und die Dokumentation findet man auf <a href="https://getbootstrap.com/">https://getbootstrap.com/</a>.</p>

                    <hr>


                    <div class="row">
                        <div class="col">
                            <div class="form-group form-floating">
                                <input type="text" class="form-control" placeholder="Floating Text">
                                <label>Floating Text</label>
                            </div>

                        </div>

                        <div class="col">
                            <pre><code class="hljs language-html ctc"><div class="form-group form-floating">
    <input type="text" class="form-control" placeholder="Floating Text">
    <label>Floating Text</label>
</div>
</code></pre>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group form-floating">
                                <input type="email" class="form-control" placeholder="Floating Mail">
                                <label>Floating E-Mail</label>
                            </div>
                        </div>
                        <div class="col">
                            <pre><code class="hljs language-html ctc"><div class="form-group form-floating">
    <input type="email" class="form-control" placeholder="Floating Mail">
    <label >Floating E-Mail</label>
</div>
</code></pre>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group form-floating">
                                <input type="password" class="form-control" placeholder="Floating Password">
                                <label>Floating Password</label>
                            </div>
                        </div>
                        <div class="col">
                            <pre><code class="hljs language-html ctc"><div class="form-group form-floating">
    <input type="password" class="form-control" placeholder="Floating Password">
    <label >Floating Password</label>
</div>
</code></pre>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group form-floating">
                                <input type="date" class="form-control" placeholder="Floating Date">
                                <label>Floating Date</label>
                            </div>
                        </div>
                        <div class="col">
                            <pre><code class="hljs language-html ctc"><div class="form-group form-floating">
    <input type="date" class="form-control"  placeholder="Floating Date">
    <label >Floating Date</label>
</div>
</code></pre>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group form-floating">
                                <input type="time" class="form-control" placeholder="Floating Time">
                                <label>Floating Time</label>
                            </div>
                        </div>
                        <div class="col">
                            <pre><code class="hljs language-html ctc"> <div class="form-group form-floating">
    <input type="time" class="form-control" placeholder="Floating Time">
    <label >Floating Time</label>
</div>
</code></pre>

                        </div>
                    </div>


                    <!-- Hier kommt irgendwo Style mit -->
                    <div class="row">
                        <div class="col">
                            <div class="form-group form-floating">
                                <textarea class="form-control" placeholder="Floating Textarea"></textarea>
                                <label>Floating Textarea</label>
                            </div>
                        </div>
                        <div class="col">
                            <pre><code class="hljs language-html ctc"><xmp> 
    <div class="form-group form-floating">
        <textarea class="form-control" placeholder="Floating Textarea"></textarea>
        <label>Floating Textarea</label>
    </div>
</xmp>
                        </code></pre>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group form-floating">
                                <select class="form-select" placeholder="Floating Select">
                                    <option>Bitte wählen</option>
                                    <option>Wert 1</option>
                                    <option>Wert 2</option>
                                    <option>Wert 3</option>
                                </select>
                                <label>Select</label>
                            </div>
                        </div>
                        <div class="col">
                            <pre><code class="hljs language-html ctc"><div class="form-group form-floating">
    <select class="form-select" placeholder="Floating Select">
        <option>Bitte wählen</option>
        <option>Wert 1</option>
        <option>Wert 2</option>
        <option>Wert 3</option>
    </select>
    <label>Select</label>
</div>
</code></pre>

                        </div>
                    </div>




                    <div class="row">
                        <div class="col">
                            <div class="form-group form-floating">
                                <select class="form-select init-select2" placeholder="Floating Select">
                                    <option value="Wert 1">Wert 1</option>
                                    <option value="Wert 2">Wert 2</option>
                                    <option value="Wert 3" selected>Wert 3</option>
                                </select>
                                <label>Select 2</label>
                            </div>
                        </div>

                        <div class="col">
                            <pre><code class="hljs language-html ctc"><!-- Form Klasse muss mit dem Constructor (Container) Initialisiert werden  -->
<div class="form-group form-floating">
    <select class="form-select init-select2" placeholder="Floating Select">
        <option value="Wert 1">Wert 1</option>
        <option value="Wert 2">Wert 2</option>
        <option value="Wert 3" selected>Wert 3</option>
    </select>
    <label>Select 2</label>
</div>
</code></pre>
                            <pre><code class="hljs language-javascript ctc">//Example
var copyForms = new Form(constructor);

</code></pre>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col">

                            <div class="row">
                                <div class="col">
                                    <div class="form-group form-floating label-info">
                                        <input type="text" class="form-control" placeholder="Floating Text">
                                        <label>Lable Info</label>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="form-group form-floating label-success">
                                        <input type="text" class="form-control" placeholder="Floating Text">
                                        <label>Lable Success</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group form-floating label-warning">
                                        <input type="text" class="form-control" placeholder="Floating Text">
                                        <label>Lable Warning</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group form-floating label-danger">
                                        <input type="text" class="form-control" placeholder="Floating Text">
                                        <label>Lable Danger</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col">
                            <pre><code class="hljs language-html ctc"><div class="form-group form-floating label-info">
    <input type="text" class="form-control" placeholder="Floating Text">
    <label>Floating Text</label>
</div>
</code></pre>



                        </div>
                    </div>
                </div>
            </div>

            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fas fa-info-circle'></i> Radios & Checkboxen</h4>

                    <h6 class='subtext'>Hier findet man Radios & Checkboxen zum Kopieren</h6>
                    <hr>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Mehrfachauswahl / Linebreak</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="cb-1-1" name="cb" value="1" />
                                    <label class="form-check-label" for="cb-1-1">Wert 1</label>
                                </div>
                            </div>

                        </div>

                        <div class="col">
                            <pre><code class="hljs language-html ctc"><div class="form-group">
    <label class="form-label">Mehrfachauswahl / Linebreak</label>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="cb-1-1" name="cb" value="1" />
        <label class="form-check-label" for="cb-1-1">Wert 1</label>
    </div>
</div>
</code></pre>

                        </div>
                    </div>



                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Mehrfachauswahl / Linebreak</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="cb-2-1" name="cbmehrfach[]" value="1" />
                                    <label class="form-check-label" for="cb-2-1">Wert 1</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="cb-2-2" name="cbmehrfach[]" value="2" />
                                    <label class="form-check-label" for="cb-2-2">Wert 2</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="cb-2-3" name="cbmehrfach[]" value="3" />
                                    <label class="form-check-label" for="cb-2-3">Wert 3</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="cb-2-4" name="cbmehrfach[]" value="4" />
                                    <label class="form-check-label" for="cb-2-4">Wert 4</label>
                                </div>
                            </div>

                        </div>

                        <div class="col">
                            <pre><code class="hljs language-html ctc"><div class="form-group">
    <label class="form-label">Mehrfachauswahl / Linebreak</label>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="cb-1-1" name="cbmehrfach[]" value="1" />
        <label class="form-check-label" for="cb-1-1">Wert 1</label>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="cb-1-2" name="cbmehrfach[]" value="2" />
        <label class="form-check-label" for="cb-1-2">Wert 2</label>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="cb-1-3" name="cbmehrfach[]" value="3" />
        <label class="form-check-label" for="cb-1-3">Wert 3</label>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="cb-1-4" name="cbmehrfach[]" value="4" />
        <label class="form-check-label" for="cb-1-4">Wert 4</label>
    </div>
</div>
</code></pre>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Checkbox Inline</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="cb-3-1" name="cbmehrfachinline[]" value="option1">
                                    <label class="form-check-label" for="cb-3-1">Wert 1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="cb-3-2" name="cbmehrfachinline[]" value="option2">
                                    <label class="form-check-label" for="cb-3-2">Wert 1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="cb-3-3" name="cbmehrfachinline[]" value="option3" disabled>
                                    <label class="form-check-label" for="cb-3-3">Wert 3</label>
                                </div>
                            </div>

                        </div>

                        <div class="col">
                            <pre><code class="hljs language-html ctc"><div class="form-group">
    <label class="form-label">Checkbox Inline</label>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="cb-4-1" name="cbmehrfachinline[]" value="option1">
        <label class="form-check-label" for="cb-4-1">Wert 1</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="cb-4-2" name="cbmehrfachinline[]" value="option2">
        <label class="form-check-label" for="cb-4-2">Wert 1</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" id="cb-4-3" name="cbmehrfachinline[]" value="option3" disabled>
        <label class="form-check-label" for="cb-4-3">Wert 3</label>
    </div>
</div>
</code></pre>

                        </div>
                    </div>




                    <div class="row">
                        <div class="col">
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck1">Checkbox 1</label>

                                <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck2">Checkbox 2</label>

                                <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck3">Checkbox 3</label>
                            </div>

                        </div>

                        <div class="col">
                            <pre><code class="hljs language-html ctc"><div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
    <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
    <label class="btn btn-outline-primary" for="btncheck1">Checkbox 1</label>

    <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
    <label class="btn btn-outline-primary" for="btncheck2">Checkbox 2</label>

    <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
    <label class="btn btn-outline-primary" for="btncheck3">Checkbox 3</label>
</div>
</code></pre>

                        </div>
                    </div>

                    <hr>


                    <div class="row">
                        <div class="col">
                            <div class="form-group form-floating-check">
                                <label class="form-label">Switch</label>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="id" name="id" value="1" />
                                    <label class="form-check-label" for="id">Wert</label>
                                </div>
                            </div>
                            <br>






                        </div>

                        <div class="col-6">
                            <pre><code class="hljs language-html ctc">
<div class="form-group form-floating-check">
    <label class="form-label">Switch</label>
    <div class="form-check form-switch">
        <input type="checkbox" class="form-check-input editable" id="id" name="id" value="1" />
        <label class="form-check-label" for="id">Wert</label>
    </div>
</div>
</code></pre>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                            $i = 1;
                            foreach (['danger', 'warning', 'info'] as $value) {

                                echo '
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group form-floating-check">
                                                    <label class="form-label">' . ucFirst($value) . '</label>
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input color-' . $value . '" id="cb-sw-2-' . $i . '" name="id" value="1" />
                                                        <label class="form-check-label" for="cb-sw-2-1">' . ucFirst($value) . '</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group form-floating-check">
                                                    <label class="form-label">' . ucFirst($value) . ' (Checked)</label>
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input color-' . $value . '" id="cb-sw-2-' . $i . '" name="id" value="1" checked />
                                                        <label class="form-check-label" for="cb-sw-2-2">' . ucFirst($value) . '</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';

                                $i++;
                            }
                            ?>

                        </div>
                        <div class="col-lg-6">
                            <pre><code class="language-html ctc"><div class="form-group form-floating-check">
    <label class="form-label">Danger (Checked)</label>
    <div class="form-check form-switch">
        <input type="checkbox" class="form-check-input color-danger" id="cb-sw-2-1" name="id" value="1" checked="">
        <label class="form-check-label" for="cb-sw-2-2">Danger</label>
    </div>
</div></code></pre>

                        </div>
                    </div>

                    <br>
                    <hr>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Mögen Sie Checkboxen (Bitte wählen)</label>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input" id="cb-4-1" name="cbradioline" value="1" checked />
                                    <label class="form-check-label" for="cb-4-1">JA</label>
                                </div>
                            </div>

                        </div>

                        <div class="col">
                            <pre><code class="hljs language-html ctc"><div class="form-group">
    <label class="form-label">Radio Linebreak</label>
    <div class="form-radio">
        <input type="radio" class="form-check-input" id="cb-4-1" name="cbradioline" value="1" />
        <label class="form-check-label" for="cb-4-1">Wert 1</label>
    </div>
</div>
</code></pre>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Radio Linebreak</label>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input" id="cb-4-1" name="cbradioline" value="1" />
                                    <label class="form-check-label" for="cb-4-1">Wert 1</label>
                                </div>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input" id="cb-4-2" name="cbradioline" value="2" />
                                    <label class="form-check-label" for="cb-4-2">Wert 2</label>
                                </div>
                                <div class="form-radio">
                                    <input type="radio" class="form-check-input" id="cb-4-3" name="cbradioline" value="3" />
                                    <label class="form-check-label" for="cb-4-3">Wert 3</label>
                                </div>
                            </div>

                        </div>

                        <div class="col">
                            <pre><code class="hljs language-html ctc"><div class="form-group">
    <label class="form-label">Radio Linebreak</label>
    <div class="form-radio">
        <input type="radio" class="form-check-input" id="cb-4-1" name="cbradioline" value="1" />
        <label class="form-check-label" for="cb-4-1">Wert 1</label>
    </div>
    <div class="form-radio">
        <input type="radio" class="form-check-input" id="cb-4-2" name="cbradioline" value="2" />
        <label class="form-check-label" for="cb-4-2">Wert 2</label>
    </div>
    <div class="form-radio">
        <input type="radio" class="form-check-input" id="cb-4-3" name="cbradioline" value="3" />
        <label class="form-check-label" for="cb-4-3">Wert 3</label>
    </div>
</div>
</code></pre>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Radio Inline</label><br>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input" type="radio" id="cb-5-1" name="cbradioinline" value="option1">
                                    <label class="form-check-label" for="cb-5-1">Wert 1</label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input" type="radio" id="cb-5-2" name="cbradioinline" value="option2">
                                    <label class="form-check-label" for="cb-5-2">Wert 1</label>
                                </div>
                                <div class="form-radio form-check-inline">
                                    <input class="form-check-input" type="radio" id="cb-5-3" name="cbradioinline" value="option3" disabled>
                                    <label class="form-check-label" for="cb-5-3">Wert 3</label>
                                </div>
                            </div>

                        </div>

                        <div class="col">
                            <pre><code class="hljs language-html ctc"><div class="form-group">
    <label class="form-label">Radio Inline</label><br>
    <div class="form-radio form-check-inline">
        <input class="form-check-input" type="radio" id="cb-5-1" name="cbradioinline" value="option1">
        <label class="form-check-label" for="cb-5-1">Wert 1</label>
    </div>
    <div class="form-radio form-check-inline">
        <input class="form-check-input" type="radio" id="cb-5-2" name="cbradioinline" value="option2">
        <label class="form-check-label" for="cb-5-2">Wert 1</label>
    </div>
    <div class="form-radio form-check-inline">
        <input class="form-check-input" type="radio" id="cb-5-3" name="cbradioinline" value="option3" disabled>
        <label class="form-check-label" for="cb-5-3">Wert 3</label>
    </div>
</div>
</code></pre>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio2">Radio 2</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio3">Radio 3</label>
                            </div>

                        </div>

                        <div class="col">
                            <pre><code class="hljs language-html ctc"><div class="btn-group" role="group" aria-label="Basic radio toggle button group">
    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
    <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>

    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
    <label class="btn btn-outline-primary" for="btnradio2">Radio 2</label>

    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
    <label class="btn btn-outline-primary" for="btnradio3">Radio 3</label>
</div>
</code></pre>
                        </div>
                    </div>


                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-slider">
                                <label for="customRange1" class="form-label">Standard</label>
                                <input type="range" class="form-range" id="customRange1">
                            </div>

                            <div class="form-group form-slider">
                                <label for="customRange2" class="form-label">.slider-danger</label>
                                <input type="range" class="form-range slider-danger" id="customRange2">
                            </div>

                            <div class="form-group form-slider">
                                <label for="customRange3" class="form-label">.slider-warning</label>
                                <input type="range" class="form-range slider-warning" id="customRange3">
                            </div>

                            <div class="form-group form-slider">
                                <label for="customRange4" class="form-label">.slider-success</label>
                                <input type="range" class="form-range slider-success" id="customRange4">
                            </div>

                            <div class="form-group form-slider">
                                <label for="customRange5" class="form-label">.slider-info</label>
                                <input type="range" class="form-range slider-info" id="customRange5">
                            </div>

                            <div class="form-group form-slider">
                                <label for="customRange6" class="form-label">.slider-secondary</label>
                                <input type="range" class="form-range slider-secondary" id="customRangez">
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                    <hr>




                    <!-- File Input -->
                    <div class="row">
                        <p>Wähle mit der accept Attribut die passenden MIME Type zum Hochladen</p>
                        <div class="col-md-6 file-input-container">
                            <div class="file-input-wrap">
                                <input type="file" class="file-input" accept="image/png" name="customFileInput">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <pre>
                                <code class="hljs language-html ctc">
<div class="form-group form-floating">
    <div class="custom-file">
        <input type="file" class="file-input" id="customFile" accept="image/png" name="customFileInput">
        <label class="file-input-btn" for="customFile">Choose file</label>
    </div>
</div>
                                </code>
                            </pre>

                        </div>

                    </div>
                    <!-- File Input -->


                </div>
            </div>
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {
        // var copyForms = new Form('#copyForms');
    });
</script>

</html>