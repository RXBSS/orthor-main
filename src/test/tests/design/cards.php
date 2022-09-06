<?php include('01_init.php');

$_page = [
    'title' => 'Cards'
];

?>
<!doctype html>

<!-- Head -->

<head>
    <title>Cards</title>
    <?php include('02_header.php'); ?>

</head>


<!-- Body -->

<body>
    <?php include('03_navigation.php'); ?>



    <div class="wrapper">
        <div class="container-fluid">

            <div class='card'>
                <div class='card-body'>
                    <h4 class="card-title"><i class="fa-solid fa-exclamation-circle"></i> Cards</h4>
                    <h6 class="subtext">Hier sind Cards von Bootstrap, die direkt kopiert werden können.</h6>
                    <p>Weitere Informationen und die Dokumentation findet man auf <a href="https://getbootstrap.com/">https://getbootstrap.com/</a>.</p>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4>Überschrift der Karte</h4>
                                    <h6 class="subtext">Das ist ein Subtext oder eine Erklärung der Karte</h6>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-center">
                                <div class="card-header">
                                    Featured
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Special title treatment</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                                <div class="card-footer text-muted">
                                    2 days ago
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">

                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-header bg-primary">Header</div>
                        <div class="card-body">
                            <h5 class="card-title">Primary card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <pre><code class="hljs language-html ctc"><!-- Beispiel zu links -->
<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
    <div class="card-header bg-primary">Header</div>
    <div class="card-body">
        ...
    </div>
</div></code></pre>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <div class="card border-primary mt-2 mb-3" style="max-width: 18rem;">
                        <div class="card-header">Header</div>
                        <div class="card-body text-primary">
                            <h5 class="card-title">Primary card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <pre><code class="hljs language-html ctc"><!-- Beispiel zu links -->
<div class="card border-primary mt-2 mb-3" style="max-width: 18rem;">
    <div class="card-header">Header</div>
    <div class="card-body text-primary">
        ...
    </div>
</div></code></pre>
                </div>

            </div>





            <hr>

            <div class="row">
                <div class="col-md-6">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" id="modal_button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Launch static backdrop modal
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Understood</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <pre><code class="hljs language-html ctc"><!-- Beipiel zu rechts -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>
                            </code></pre>
                </div>
            </div>

            <hr>

            <!-- 
                        Karte mit ToolTip -----


                        ------------------
                     -->
            <div class="row">
                <div class="col-md-6">
                    <br>
                    <div class="card">
                        <div class="card-body">

                            <div class="actions">
                                <a class="action-item" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Swim"><i class="fa-solid fa-swimming-pool"></i></a>
                                <a class="action-item" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Baby"><i class="fa-solid fa-ship"></i></a>
                                <a class="action-item" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Swim"><i class="fa-solid fa-water"></i></a>
                                <a class="action-item" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Baby"><i class="fa-solid fa-life-ring"></i></a>
                            </div>


                            <h4><i class="fa-solid fa-swimmer"></i> Swim Baby Swim...</h4>
                            <h6 class="subtext">Bikini mermaid princess on the beach, Attracting all the sharks in her reach, Swim baby swim for your life, Sharks are on your back</h6>

                            <p>
                                I am a little useless jellyfish,
                                I have no power I have no wish,
                                But if I could swim with her,
                                I could get over the sharks for her,
                                Sting of a jellyfish,
                                May have a lucky strike,
                                You know how I cherish,
                                To have a mighty spike,
                                Sneak up from behind the sharks,
                                With my toxic sting,
                                Scream of agony sparks,
                                Hear me sing :)
                                I am a little hopeless starfish,
                                I am far from being stylish,
                                Swim baby swim for your life baby swim,
                                Jellyfish is on your back baby swim,
                                I am a little useless oyster,
                                You know how much I want to assist her,
                                Swim baby swim for your life baby swim,
                                Starfish is on your back baby swim.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <pre><code  class="hljs language-html ctc"><!-- HTML Code -->
<div class="card" >
    <div class="card-body" style="border: 1px solid #333;">
        <div class="actions">
            <a class="action-item" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Swim"><i class="fa-solid fa-swimming-pool"></i></a>
            <a class="action-item" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Baby"><i class="fa-solid fa-ship"></i></a>
            <a class="action-item" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Swim"><i class="fa-solid fa-water"></i></a>
            <a class="action-item" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Baby"><i class="fa-solid fa-life-ring"></i></a>
        </div>
    </div>
</div></code></pre>
                    <pre><code  class="hljs ctc">//Tooltip Funktion
var element = $('[data-bs-toggle="tooltip"]').each(function() {
    new bootstrap.Tooltip($(this)[0]);
});</code></pre>

                </div>

            </div>


            <hr>


            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-success">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fa-solid fa-check"></i> Karte mit Warnung</h4>
                                    <h6 class="subtext">Dazu muss die Klasse <code>.card-success</code> hinzugefügt werden</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-danger">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fa-solid fa-xmark"></i> Karte mit Warnung</h4>
                                    <h6 class="subtext">Dazu muss die Klasse <code>.card-danger</code> hinzugefügt werden</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-warning">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fa-solid fa-triangle-exclamation"></i> Karte mit Warnung</h4>
                                    <h6 class="subtext">Dazu muss die Klasse <code>.card-warning</code> hinzugefügt werden</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fa-solid fa-circle-info"></i> Karte mit Info</h4>
                                    <h6 class="subtext">Dazu muss die Klasse <code>.card-info</code> hinzugefügt werden</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <pre><code class="language-html ctc"><!-- success, danger, warning, info -->s
<div class="card card-xxxxxx"> 
    <div class="card-body">
        <h4 class="card-title"><i class="fa-solid icon"></i> Headline</h4>
        <h6 class="subtext">Subheadline</h6>
    </div>
</div>
</code></pre>
                </div>
            </div>







            <hr>
            <h4>Card in Card</h4>
            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fas fa-check'></i> Meine Karte</h4>
                    <h6 class='subtext'>Text unter der ersten Karte</h6>

                    <div class="row">
                        <div class="col-md-6">
                            <div class='card'>
                                <div class='card-body'>
                                    <p>
                                        Inhalt der Subkarte
                                    </p>

                                    <div class="form-floating">
                                        <input type="text" name="name" class="form-control editable" placeholder="Bezeichnung">
                                        <label>Bezeichnung</label>
                                    </div>

                                    <div class="form-group form-floating">
                                        <textarea class="form-control" placeholder="Floating Textarea"></textarea>
                                        <label>Textare</label>
                                    </div>

                                    <div class="form-group form-floating">
                                        <select class="form-select init-select2" placeholder="Floating Select">
                                            <option value="option">Wert 1</option>
                                            <option value="option">Wert 2</option>
                                            <option value="option">Wert 3</option>
                                        </select>
                                        <label>label</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class='card'>
                                <div class='card-body'>
                                    <h4><i class='fas fa-times'></i> Meine Subkarte</h4>
                                    <h6 class='subtext'>Text unter der Subkarte</h6>

                                    <p>
                                        Inhalt der Subkarte
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>



            <hr>


            <div class="card">
                <div class="card-body">
                    <h4><i class="fa-regular fa-id-card"></i> Aktivierbare Karte</h4>
                    <h6 class="subtext">Aktivierbare Karten</h6>


                    <br>
                    <br>

                    Ist umgezogen und jetzt unter <a href="activation-card">Activation Card</a> zu finden!

                </div>
            </div>


            <div class="mb-5 mt-3">
                <hr>
            </div>




            <div class="row">
                <div class="col-md-6">
                    <h4>Karten mit gleicher Höhe</h4>
                    <p>
                        Design-technisch kann es manchmal sinnvoll sein, dass zwei oder mehr Karten nebeneinander immer die gleiche Höhe behalten.
                        Dazu gibt es die Klasse namens <code>CardSizer</code>

                    </p>
                </div>
                <div class="col-md-6">
                    <pre><code class="language-js ctc">new CardSizer(['#card1','#card2']);</code></pre>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-6">
                    <button class="btn btn-primary btn-add-text" data-id="1"><i class="fa-solid fa-plus"></i> Text hinzufügen</button>
                    <button class="btn btn-danger btn-remove-text" data-id="1"><i class="fa-solid fa-trash"></i> Text entfernen</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary btn-add-text" data-id="2"><i class="fa-solid fa-plus"></i> Text hinzufügen</button>
                    <button class="btn btn-danger btn-remove-text" data-id="2"><i class="fa-solid fa-trash"></i> Text entfernen</button>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6 test">
                    <div class="card" id="card-1">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-check"></i> Box 1</h4>
                            <h6 class="subtext">Der Subtext zu Box 1</h6>

                            <p>
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                            </p>
                            <div class="dynamic-text"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">



                    <div class="card" id="card-2">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-check"></i> Box 1</h4>
                            <h6 class="subtext">Der Subtext zu Box 1</h6>
                            <p>
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam.
                            </p>
                            <div class="dynamic-text"></div>
                        </div>
                    </div>
                </div>
            </div>

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


</body>



<?php include('04_scripts.php'); ?>

<script>
    $(document).ready(function() {


        var sizer = new CardSizer(['#card-1', '#card-2']);

        $('.btn-add-text').on('click', function() {
            $('#card-' + $(this).data('id') + ' .dynamic-text').append('Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam. ');
        });

        $('.btn-remove-text').on('click', function() {
            $('#card-' + $(this).data('id') + ' .dynamic-text').html('');
        });


    });
</script>

</html>