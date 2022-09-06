<?php include('01_init.php');

// Gibt es auf jeder Seite
$_page = [
    'title' => "Formvalidation"
];

// Einstellungen
// User Login


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


            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fas fa-check'></i> Formvalidation</h4>
                    <h6 class="subtext">Hier wird das Plugin von <a href="https://formvalidation.io/">formvalidation.io</a> benutzt!</h6>

                    <p>
                        Hier wird nur das Standard-Plugin behandelt. Es gibt eine eigene Form-Klasse. Dieser findet man <a href="form-handler.php">hier</a>.
                    </p>

                    <form id="example-1">


                        <div class="row">
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label class="form-label">Static Text</label>
                                    <input type="text" class="form-control" name="stext" />
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Static E-Mail</label>
                                    <input type="email" class="form-control" name="semail" />
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Static Password</label>
                                    <input type="password" class="form-control" name="spassword" />
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Static Date</label>
                                    <input type="date" class="form-control" name="sdate" />
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Static Time</label>
                                    <input type="time" class="form-control" name="stime" />
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Static Select</label>
                                    <select class="form-select" name="sselect" placeholder="Floating Select">
                                        <option value="">Bitte wählen</option>
                                        <option value="1">Wert 1</option>
                                        <option value="2">Wert 2</option>
                                        <option value="3">Wert 3</option>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label class="form-label">Static Label</label>
                                    <textarea class="form-control" name="stextarea" placeholder="Static Textarea"></textarea>
                                </div>




                            </div>
                            <div class="col-md-3">

                                <div class="form-floating form-group">
                                    <input type="text" name="ftext" class="form-control" placeholder="Floating Text">
                                    <label>Floating Text</label>
                                </div>

                                <div class="form-floating form-group">
                                    <input type="email" name="femail" class="form-control" placeholder="Floating Mail">
                                    <label>Floating E-Mail</label>
                                </div>

                                <div class="form-floating form-group">
                                    <input type="password" name="fpassword" class="form-control" placeholder="Floating Password">
                                    <label>Floating Password</label>
                                </div>

                                <div class="form-floating form-group">
                                    <input type="date" name="fdate" class="form-control" placeholder="Floating Date">
                                    <label>Floating Date</label>
                                </div>

                                <div class="form-floating form-group">
                                    <input type="time" name="ftime" class="form-control" placeholder="Floating Time">
                                    <label>Floating Time</label>
                                </div>

                                <div class="form-floating form-group">
                                    <select class="form-select" name="fselect" placeholder="Floating Select">
                                        <option value="">Bitte wählen</option>
                                        <option value="1">Wert 1</option>
                                        <option value="2">Wert 2</option>
                                        <option value="3">Wert 3</option>
                                    </select>
                                    <label>Select</label>
                                </div>

                                <div class="form-floating form-group">
                                    <textarea class="form-control" name="ftextarea" placeholder="Floating Textarea"></textarea>
                                    <label>Floating Textarea</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
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

                                <div class="form-group">
                                    <label class="form-label">Einfach Auswahl</label>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="cb-2-1" name="cbeinfach" value="1" />
                                        <label class="form-check-label" for="cb-2-1">Wert 1</label>
                                    </div>
                                </div>

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
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary">Senden</button>
                            <button id="example-reset-soft" type="button" class="btn btn-secondary">Soft Reset</button>
                            <button id="example-reset-hard" type="button" class="btn btn-secondary">Hard Reset</button>
                        </div>
                    </form>



                </div>
            </div>


            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fas fa-check'></i> FormValidation ohne Objekt</h4>


                    <form id="example-2">
                        <div class="form-floating form-group">
                            <input type="text" name="ex999" class="form-control"  placeholder="Test" required>
                            <label>Test</label>
                        </div>
                        <div class="form-floating form-group">
                            <input type="text" name="ex998" class="form-control" placeholder="Test">
                            <label>Test</label>
                        </div>
                        <button class="btn btn-primary">Senden</button>
                        <button type="button" class="btn btn-secondary">Reset</button>
                    </form>

                </div>
            </div>

        </div>
    </div>


</body>

<?php include('04_scripts.php'); ?>

<script>
    // On Document Ready
    $(document).ready(function() {

        // FormValidation
        var fv2 = FormValidation.formValidation(
            $('#example-2')[0], {
                fields: {

                    // Static Labels
                    ex998: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                },
                plugins: {
                    declarative: new FormValidation.plugins.Declarative({
                        html5Input: true,
                    }),
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.form-group',
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    icon: new FormValidation.plugins.Icon({
                        valid: 'fa fa-check',
                        invalid: 'fa fa-times',
                        validating: 'fa fa-refresh'
                    }),
                }
            }
        );

        // FormValidation
        var fv = FormValidation.formValidation(
            $('#example-1')[0], {
                fields: {

                    // Static Labels
                    stext: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    semail: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    spassword: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    sdate: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    stime: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    sselect: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    stextarea: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },


                    // Floating Labels
                    ftext: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    femail: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    fpassword: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    fdate: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    ftime: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    fselect: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    ftextarea: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },

                    // Checkbox

                    'cbmehrfach[]': {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    cbeinfach: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    'cbmehrfachinline[]': {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    cbradioline: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                    cbradioinline: {
                        validators: {
                            notEmpty: {
                                message: 'Das Feld wird benötigt!'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.form-group',
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    icon: new FormValidation.plugins.Icon({
                        valid: 'fa fa-check',
                        invalid: 'fa fa-times',
                        validating: 'fa fa-refresh'
                    }),
                },
            }
        );

        $('#example-reset-soft').on('click', function() {
            fv.resetForm(false);
        });
        $('#example-reset-hard').on('click', function() {
            fv.resetForm(true);
        });

    });
</script>




</html>