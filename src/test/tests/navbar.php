<?php include('01_init.php');

// Gibt es auf jeder Seite
$_page = [
    'title' => "Navigation"
];

?>
<!doctype html>

<!-- Head -->

<head>
    <?php include('02_header.php'); ?>


    <style>


    </style>


</head>


<!-- Body -->

<body class="">
    <?php include('03_navigation.php'); ?>

    <div class="wrapper">
        <div class="container-fluid">



            <div class="card">
                <div class="card-body">



                    <!-- Example -->
                    <nav class="navbar navbar-dark bg-dark mb-3">
                        <div class="container-fluid justify-content-start align-items-center">

                            <!-- Navbar Title -->
                            <div id="navbar-banner" class="navbar-brand">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;" width="50px" height="50px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                            <circle cx="30" cy="50" fill="#7ab929" r="20">
                                                <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="-0.7246376811594202s"></animate>
                                            </circle>
                                            <circle cx="70" cy="50" fill="#ffffff" r="20">
                                                <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="0s"></animate>
                                            </circle>
                                            <circle cx="30" cy="50" fill="#7ab929" r="20">
                                                <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="-0.7246376811594202s"></animate>
                                                <animate attributeName="fill-opacity" values="0;0;1;1" calcMode="discrete" keyTimes="0;0.499;0.5;1" dur="1.4492753623188404s" repeatCount="indefinite"></animate>
                                            </circle>
                                        </svg>
                                    </div>

                                    <div>
                                        <strong>ORTHOR</strong>
                                    </div>


                                </div>
                            </div>

                            <!-- Navbar Title -->
                            <div class="navbar-text">
                                <h4>
                                    Titel der Seite
                                </h4>
                            </div>

                            <!-- Container für die Actions -->
                            <div class="navbar-action-container d-flex">
                                <a href="javascript: void(0);" class="navbar-action-icon">
                                    <i class="fa-solid fa-exclamation-circle"></i>
                                </a>
                            </div>
                        </div>
                    </nav>




                    <div class="row">
                        <div class="col">
                            <h4>Navigation</h4>
                            <p>Die Navigation besteht aus drei Teilen:</p>
                            <ul>
                                <li>Dem Bereich für das Logo</li>
                                <li>Dem Seiten Titel</li>
                                <li>Einem Bereich für die Action Items</li>
                            </ul>

                        </div>
                        <div class="col">
                            <pre><code class="hljs language-html ctc"><nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid justify-content-start align-items-center">
        
        <!-- Navbar Logo -->
        <div id="navbar-banner" class="navbar-brand">
            Logo
        </div>

        <!-- Navbar Title -->
        <div class="navbar-text">
            <h4>
                Titel der Seite
            </h4>
        </div>

        <!-- Container fuer die Actions -->
        <div class="navbar-action-container d-flex">
            <a href="javascript: void(0);" class="navbar-action-icon">
                <i class="fa-solid fa-exclamation-circle"></i>
            </a>
        </div>
    </div>
</nav></code></pre>
                        </div>
                    </div>



                </div>
            </div>





            <div class="card">
                <div class="card-body">

                    <div class="alert alert-danger">
                        Wird mittlerweile von der Klasse <a class="alert-link" href="notifications">Notifications</a> dargestellt.
                        Aus Performance-Gründe sollte das ganze aber auch parallel via PHP funktionieren (?)

                    </div>



                    <div class="row mb-3">
                        <div class="col">
                            <h4>Action Signal</h4>


                            <p>
                                Bei den Action Items kann man auch ein Action Signal mit hinzufügen. Dabei fängt dort eine Lampe an zu blinken.
                                Die Lampe kann in den Verschiedenen Farben blinken.
                            </p>
                            <ul>
                                <li>.action-signal</li>
                                <li>.action-signal .action-success</li>
                                <li>.action-signal .action-warning</li>
                                <li>.action-signal .action-danger</li>
                                <li>.action-signal .action-info</li>
                                <li>.action-signal .action-light</li>
                                <li>.action-signal .action-dark</li>
                            </ul>

                            <p>
                                Mit den Klassen <code>.action-static</code> und <code>.action-fast</code> kann man auch das Verhalten des blinkens steuern

                            </p>

                        </div>
                        <div class="col">
                            <pre><code class="hljs language-html ctc"><!-- Normal -->
<a href="javascript: void(0);" class="navbar-action-icon action-signal">
    <i class="fa-solid fa-exclamation-circle"></i>
</a></code></pre>

                            <pre><code class="hljs language-html ctc"><!-- Mit Farbe -->
<a href="javascript: void(0);" class="navbar-action-icon action-signal action-success">
    <i class="fa-solid fa-exclamation-circle"></i>
</a></code></pre>

                            <pre><code class="hljs language-html ctc"><!-- Mit Farbe und Statisch -->
<a href="javascript: void(0);" class="navbar-action-icon action-signal action-success action-static">
    <i class="fa-solid fa-exclamation-circle"></i>
</a></code></pre>

                            <pre><code class="hljs language-html ctc"><!-- Mit Farbe und Schnell -->
<a href="javascript: void(0);" class="navbar-action-icon action-signal action-success action-fast">
    <i class="fa-solid fa-exclamation-circle"></i>
</a></code></pre>




                        </div>
                    </div>


                    <!-- Example -->
                    <nav class="navbar navbar-dark bg-dark mb-3">
                        <div class="container-fluid justify-content-start align-items-center">

                            <!-- Navbar Title -->
                            <div id="navbar-banner" class="navbar-brand">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;" width="50px" height="50px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                            <circle cx="30" cy="50" fill="#7ab929" r="20">
                                                <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="-0.7246376811594202s"></animate>
                                            </circle>
                                            <circle cx="70" cy="50" fill="#ffffff" r="20">
                                                <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="0s"></animate>
                                            </circle>
                                            <circle cx="30" cy="50" fill="#7ab929" r="20">
                                                <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="-0.7246376811594202s"></animate>
                                                <animate attributeName="fill-opacity" values="0;0;1;1" calcMode="discrete" keyTimes="0;0.499;0.5;1" dur="1.4492753623188404s" repeatCount="indefinite"></animate>
                                            </circle>
                                        </svg>
                                    </div>

                                    <div>
                                        <strong>ORTHOR</strong>
                                    </div>


                                </div>
                            </div>

                            <!-- Navbar Title -->
                            <div class="navbar-text">
                                <h4>
                                    Blinkendes Signal
                                </h4>
                            </div>

                            <!-- Container für die Actions -->
                            <div class="navbar-action-container d-flex">
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal">
                                    <i class="fa-solid fa-battery-quarter"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-success">
                                    <i class="fa-solid fa-battery-quarter"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-warning">
                                    <i class="fa-solid fa-battery-quarter"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-danger">
                                    <i class="fa-solid fa-battery-quarter"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-info">
                                    <i class="fa-solid fa-battery-quarter"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-light">
                                    <i class="fa-solid fa-battery-quarter"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-dark">
                                    <i class="fa-solid fa-battery-quarter"></i>
                                </a>
                            </div>
                        </div>
                    </nav>



                    <!-- Example -->
                    <nav class="navbar navbar-dark bg-dark mb-3">
                        <div class="container-fluid justify-content-start align-items-center">

                            <!-- Navbar Title -->
                            <div id="navbar-banner" class="navbar-brand">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;" width="50px" height="50px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                            <circle cx="30" cy="50" fill="#7ab929" r="20">
                                                <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="-0.7246376811594202s"></animate>
                                            </circle>
                                            <circle cx="70" cy="50" fill="#ffffff" r="20">
                                                <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="0s"></animate>
                                            </circle>
                                            <circle cx="30" cy="50" fill="#7ab929" r="20">
                                                <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="-0.7246376811594202s"></animate>
                                                <animate attributeName="fill-opacity" values="0;0;1;1" calcMode="discrete" keyTimes="0;0.499;0.5;1" dur="1.4492753623188404s" repeatCount="indefinite"></animate>
                                            </circle>
                                        </svg>
                                    </div>

                                    <div>
                                        <strong>ORTHOR</strong>
                                    </div>


                                </div>
                            </div>

                            <!-- Navbar Title -->
                            <div class="navbar-text">
                                <h4>
                                    Statisches Signal
                                </h4>
                            </div>

                            <!-- Container für die Actions -->
                            <div class="navbar-action-container d-flex">
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-static">
                                    <i class="fa-solid fa-battery-full"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-success action-static">
                                    <i class="fa-solid fa-battery-full"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-warning action-static">
                                    <i class="fa-solid fa-battery-full"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-danger action-static">
                                    <i class="fa-solid fa-battery-full"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-info action-static">
                                    <i class="fa-solid fa-battery-full"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-light action-static">
                                    <i class="fa-solid fa-battery-full"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-dark action-static">
                                    <i class="fa-solid fa-battery-full"></i>
                                </a>
                            </div>
                        </div>
                    </nav>

                    <!-- Example -->
                    <nav class="navbar navbar-dark bg-dark">
                        <div class="container-fluid justify-content-start align-items-center">

                            <!-- Navbar Title -->
                            <div id="navbar-banner" class="navbar-brand">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;" width="50px" height="50px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                            <circle cx="30" cy="50" fill="#7ab929" r="20">
                                                <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="-0.7246376811594202s"></animate>
                                            </circle>
                                            <circle cx="70" cy="50" fill="#ffffff" r="20">
                                                <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="0s"></animate>
                                            </circle>
                                            <circle cx="30" cy="50" fill="#7ab929" r="20">
                                                <animate attributeName="cx" repeatCount="indefinite" dur="1.4492753623188404s" keyTimes="0;0.5;1" values="30;70;30" begin="-0.7246376811594202s"></animate>
                                                <animate attributeName="fill-opacity" values="0;0;1;1" calcMode="discrete" keyTimes="0;0.499;0.5;1" dur="1.4492753623188404s" repeatCount="indefinite"></animate>
                                            </circle>
                                        </svg>
                                    </div>

                                    <div>
                                        <strong>ORTHOR</strong>
                                    </div>


                                </div>
                            </div>

                            <!-- Navbar Title -->
                            <div class="navbar-text">
                                <h4>
                                    Schnell Blinkend
                                </h4>
                            </div>

                            <!-- Container für die Actions -->
                            <div class="navbar-action-container d-flex">
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-fast">
                                    <i class="fa-solid fa-battery-empty"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-success action-fast">
                                    <i class="fa-solid fa-battery-empty"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-warning action-fast">
                                    <i class="fa-solid fa-battery-empty"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-danger action-fast">
                                    <i class="fa-solid fa-battery-empty"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-info action-fast">
                                    <i class="fa-solid fa-battery-empty"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-light action-fast">
                                    <i class="fa-solid fa-battery-empty"></i>
                                </a>
                                <a href="javascript: void(0);" class="navbar-action-icon action-signal action-dark action-fast">
                                    <i class="fa-solid fa-battery-empty"></i>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-indent"></i> Tabs</h4>
                    <h6 class="subtext">Die Tabs von Bootstrap werden eigentlich 1 zu 1 übernommen. Hier sollte auf jeden Fall die <code>.fade</code> Klasse entfernt werden.</h6>


                    <hr>

                    <div class="row">
                        <div class="col-6">
                            <nav>
                                <div class="nav nav-tabs" id="tab-nav-example1">
                                    <button class="nav-link active" id="tab-nav-example2-1" data-bs-toggle="tab" data-bs-target="#tab-content-example2-1" type="button">Tab 1</button>
                                    <button class="nav-link" id="tab-nav-example2-2" data-bs-toggle="tab" data-bs-target="#tab-content-example2-2" type="button">Tab 2</button>
                                    <button class="nav-link" id="tab-nav-example2-3" data-bs-toggle="tab" data-bs-target="#tab-content-example2-3" type="button">Tab 3</button>
                                    <button class="nav-link" id="tab-nav-example2-4" data-bs-toggle="tab" data-bs-target="#tab-content-example2-4" type="button">Tab 4</button>
                                    <button class="nav-link" id="tab-nav-example2-5" data-bs-toggle="tab" data-bs-target="#tab-content-example2-5" type="button">Tab 5</button>
                                </div>
                            </nav>
                            <br>
                            <div class="tab-content" id="tab-content-example1">
                                <div class="tab-pane show active" id="tab-content-example2-1">
                                    Tab 1
                                </div>
                                <div class="tab-pane" id="tab-content-example2-2">
                                    Tab 2
                                </div>
                                <div class="tab-pane" id="tab-content-example2-3">
                                    Tab 3
                                </div>
                                <div class="tab-pane" id="tab-content-example2-4">
                                    Tab 4
                                </div>
                                <div class="tab-pane" id="tab-content-example2-5">
                                    Tab 5
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-html ctc"><!-- Zentriert -->
<div class="nav nav-tabs">
...
</div></code></pre>
                        </div>
                    </div>


                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <nav>
                                <div class="nav nav-tabs justify-content-between" id="tab-nav-example1">
                                    <button class="nav-link active" id="tab-nav-example1-1" data-bs-toggle="tab" data-bs-target="#tab-content-example1-1" type="button">Tab 1</button>
                                    <button class="nav-link" id="tab-nav-example1-2" data-bs-toggle="tab" data-bs-target="#tab-content-example1-2" type="button">Tab 2</button>
                                    <button class="nav-link" id="tab-nav-example1-3" data-bs-toggle="tab" data-bs-target="#tab-content-example1-3" type="button">Tab 3</button>
                                    <button class="nav-link" id="tab-nav-example1-4" data-bs-toggle="tab" data-bs-target="#tab-content-example1-4" type="button">Tab 4</button>
                                    <button class="nav-link" id="tab-nav-example1-5" data-bs-toggle="tab" data-bs-target="#tab-content-example1-5" type="button">Tab 5</button>
                                </div>
                            </nav>
                            <br>
                            <div class="tab-content" id="tab-content-example1">
                                <div class="tab-pane show active" id="tab-content-example1-1">
                                    Tab 1
                                </div>
                                <div class="tab-pane" id="tab-content-example1-2">
                                    Tab 2
                                </div>
                                <div class="tab-pane" id="tab-content-example1-3">
                                    Tab 3
                                </div>
                                <div class="tab-pane" id="tab-content-example1-4">
                                    Tab 4
                                </div>
                                <div class="tab-pane" id="tab-content-example1-5">
                                    Tab 5
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-html ctc"><!-- Zentriert -->
<div class="nav nav-tabs justify-content-between">
...
</div></code></pre>
                        </div>
                    </div>







                </div>
            </div>


        </div>
    </div>



</body>

<?php include('04_scripts.php'); ?>

<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/highlight.min.js" integrity="sha512-z+/WWfyD5tccCukM4VvONpEtLmbAm5LDu7eKiyMQJ9m7OfPEDL7gENyDRL3Yfe8XAuGsS2fS4xSMnl6d30kqGQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

<script>
    $(document).ready(function() {



        


    


    });
</script>

</html>