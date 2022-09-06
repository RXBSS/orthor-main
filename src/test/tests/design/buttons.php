<?php include('01_init.php');

$_page = [
    'title' => "Buttons"
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

            <div class="alert alert-info">
                <strong>ToDo</strong><br>
                - Button Light sieht noch nicht so gut aus!

            </div>

           


            <div class="card">
                <div class="card-body">
                    <h4><i class="fa-solid fa-exclamation-circle"></i> Buttons</h4>
                    <h6 class="subtext">Hier finden Sie Buttons.</h6>
                    <p>Weitere Informationen und die Dokumentation findet man auf <a href="https://getbootstrap.com/">https://getbootstrap.com/</a>.</p>
                
                    <div class="row">
                        <div class="col">
                            <h6><b>Normale Buttons</b></h6>
                            <button class="btn btn-primary">Test</button>
                            <button class="btn btn-secondary">Test</button>
                            <button class="btn btn-dark">Test</button>
                            <button class="btn btn-light">Test</button>
                            <button class="btn btn-success">Test</button>
                            <button class="btn btn-danger">Test</button>
                            <button class="btn btn-warning">Test</button>
                            <button class="btn btn-info">Test</button>
                          
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h6><b>Buttons mit Icon</b></h6>
                            <button class="btn btn-primary"><i class="fa-solid fa-envelope"></i> Test</button>
                            <button class="btn btn-secondary"><i class="fa-solid fa-envelope"></i> Test</button>
                            <button class="btn btn-dark"><i class="fa-solid fa-envelope"></i> Test</button>
                            <button class="btn btn-light"><i class="fa-solid fa-envelope"></i> Test</button>
                            <button class="btn btn-success"><i class="fa-solid fa-envelope"></i> Test</button>
                            <button class="btn btn-danger"><i class="fa-solid fa-envelope"></i> Test</button>
                            <button class="btn btn-warning"><i class="fa-solid fa-envelope"></i> Test</button>
                            <button class="btn btn-info"><i class="fa-solid fa-envelope"></i> Test</button>
                           
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h6><b>Disabled</b></h6>
                            <button class="btn btn-primary" disabled>Test</button>
                            <button class="btn btn-secondary" disabled>Test</button>
                            <button class="btn btn-dark" disabled>Test</button>
                            <button class="btn btn-light" disabled>Test</button>
                            <button class="btn btn-success" disabled>Test</button>
                            <button class="btn btn-danger" disabled>Test</button>
                            <button class="btn btn-warning" disabled>Test</button>
                            <button class="btn btn-info" disabled>Test</button>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h6><b>Readonly</b></h6>
                            <button class="btn btn-primary" readonly>Test</button>
                            <button class="btn btn-secondary" readonly>Test</button>
                            <button class="btn btn-dark" readonly>Test</button>
                            <button class="btn btn-light" readonly>Test</button>
                            <button class="btn btn-success" readonly>Test</button>
                            <button class="btn btn-danger" readonly>Test</button>
                            <button class="btn btn-warning" readonly>Test</button>
                            <button class="btn btn-info" readonly>Test</button>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h6><b>Outline Button</b></h6>
                            <button type="button" class="btn btn-outline-primary">Primary</button>
                            <button type="button" class="btn btn-outline-secondary">Secondary</button>
                            <button type="button" class="btn btn-outline-success">Success</button>
                            <button type="button" class="btn btn-outline-danger">Danger</button>
                            <button type="button" class="btn btn-outline-warning">Warning</button>
                            <button type="button" class="btn btn-outline-info">Info</button>
                            <button type="button" class="btn btn-outline-light">Light</button>
                            <button type="button" class="btn btn-outline-dark">Dark</button>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h6><b>Button Checkbox</b></h6>
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck1">Checkbox 1</label>

                                <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck2">Checkbox 2</label>

                                <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck3">Checkbox 3</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h6><b>Button Radios</b></h6>
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="btnradio1">Radio 1</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio2">Radio 2</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btnradio3">Radio 3</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h6><b>Button Dropdowns</b></h6>
                            <div class="bd-example">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Primary</button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                                    </ul>
                                </div><!-- /btn-group -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Secondary</button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                                    </ul>
                                </div><!-- /btn-group -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Success</button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                                    </ul>
                                </div><!-- /btn-group -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Info</button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                                    </ul>
                                </div><!-- /btn-group -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Warning</button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                                    </ul>
                                </div><!-- /btn-group -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Danger</button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                                    </ul>
                                </div><!-- /btn-group -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<?php include('04_scripts.php'); ?>
</html>