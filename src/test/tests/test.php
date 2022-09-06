<?php include('01_init.php');

$_page = [
    'title' => "Test"
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
                    <h4 class="card-title"><i class="fa-solid fa-icon"></i> Test</h4>

                    <h6 class="subtext">Test</h6>
                    <div class="tl-debug">

                        <ul class="timeline">
                            <!-- <li class="is-future" data-json="">
                            <div class="timeline-inner d-flex">

                                <span class="icon"><i class="fa-solid fa-star"></i></span>

                                fasdfadfasd<br>
                                forward_static_callasfa<br>
                                sdsaasdf
                                </span>
                                <span class="pre-inhalt" style="display:block;margin-top: 10px;"><span>Test<br>Test</span></span>
                            </div>
                        </li> -->
                            <li class="is-future">

                                <div class="tl-content">
                                    <div class="tl-content-pre">Pre</div>
                                    <div class="tl-content-main">

                                        <div class="d-flex flex-row">
                                            <div class="tl-date">12.31.2311<br>10:23</div>
                                            <div class="tl-circle"></div>
                                            <div class="tl-icon"><i class="fa-solid fa-star"></i></div>


                                            <div class="tl-content-main-bubble">Feedback<br>einholenjasfasd</div>
                                        </div>
                                    </div>
                                    <div class="tl-content-sub">Sub</div>
                                </div>
                                <!--
                            
                            <span class="datum dual-line"></span>
-->


                            </li>
                            <li class="is-future">

                                <div class="tl-content">
                                    <div class="tl-content-pre">Pre</div>
                                    <div class="tl-content-main">
                                        <div class="d-flex flex-row">
                                            <div class="tl-date"><span>in 4<br>Wochen</span></div>
                                            <div class="tl-circle"></div>
                                            <div class="tl-icon"><i class="fa-solid fa-star"></i></div>


                                            <div class="tl-content-main-bubble">Feedback</div>
                                        </div>
                                    </div>
                                    <div class="tl-content-sub">Sub</div>
                                </div>
                                <!--
                            
                            <span class="datum dual-line"></span>
-->


                            </li>


                            <li class="is-future">

                                <div class="tl-content">
                                    <div class="tl-content-main">
                                        <div class="d-flex flex-row">

                                            <div class="tl-date">Heute</div>

                                            <div class="tl-circle"></div>
                                            <div class="tl-icon"><i class="fa-solid fa-star"></i></div>



                                            <div class="tl-content-main-bubble">Feedback<br>einholenjasfasd</div>
                                        </div>
                                    </div>
                                </div>
                                <!--
                            
                            <span class="datum dual-line"></span>
-->


                            </li>
                            <!-- <li class="is-future">

                            <span class="icon"><i class="fa-solid fa-star"></i></span>
                            <span class="datum dual-line">in 4<br>Wochen</span>

                            <div class="inhalt d-flex flex-column">
                                <div>Feedback einholenjasfasd</div>
                                <div class="main">
                                    <span style="position:absolute; margin-left: -40px;">Test</span>
                                    <span style="position:absolute; margin-left: -40px;"><i class="fa-solid fa-star"></i></span>
                                    <span >Feedback einholenjasfasd<br>Lorem Ipsum</span>
                                </div>
                                <div>Feedback einholenjasfasd</div>
                            </div>
                        </li>
                        <li class="is-past" data-json="{&quot;timestamp&quot;:&quot;2022-03-08 08:27:40&quot;,&quot;icon&quot;:&quot;fas fa-shopping-cart&quot;,&quot;content&quot;:&quot;Bestellung des Kunden&quot;,&quot;precontent&quot;:&quot;Hallo Welt&quot;}">
                            <div class="timeline-inner"><span class="datum dual-line">Gestern<br>08:27</span><span class="icon"><i class="fa-solid fa-shopping-cart"></i></span><span class="inhalt"><span>Bestellung des Kunden</span></span><span class="pre-inhalt"><span>undefined</span></span></div>
                        </li> -->
                        </ul>
                    </div>



                </div>
            </div>



        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {
        // Do Something


        var form = new Form('#myform');

    });
</script>

</html>