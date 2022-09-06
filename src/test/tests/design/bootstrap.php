<?php include('01_init.php'); 

    $_page = [
        'title' => 'Bootstrap'
    ];

?>

<!doctype html>
<html lang="de">

<head>
    <title>bootstrap</title>
    <?php include('02_header.php'); ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Stylesheet einfügen -->
    <link rel="stylesheet" href="../dist/orthor.css">

    <!-- Font Awesome
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    
    <!-- Highlight Js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/github-dark.min.css" integrity="sha512-rO+olRTkcf304DQBxSWxln8JXCzTHlKnIdnMUwYvQa9/Jd4cQaNkItIUj6Z4nvW1dqK0SKXLbn9h4KwZTNtAyw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>Hello, world!</title>
</head>

<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <h4><i class="fa-solid fa-exclamation-circle"></i>Bootstrap</h4>
                    <h6 class="subtext">Hier finden Sie Bootstrap Features.</h6>
                    <p>Weitere Informationen und die Dokumentation findet man auf <a href="https://getbootstrap.com/">https://getbootstrap.com/</a>.</p>
                
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>Standard Bootstrap Spinner.</p>
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>Standard Badges von Bootstrap 5. Das sind einfache Buttons, die umgestellt wurden.</p>
                            <button type="button" class="btn btn-primary position-relative">
                                Profile
                                <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary">
                                Notifications <span class="badge bg-secondary">4</span>
                            </button>
                            <button type="button" class="btn btn-primary position-relative">
                                Inbox
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    99+
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>Eine Benachrichtungsbutton, welcher mit Hilfe von Bootstrap Funktion getriggert werden kann.</p>
                            <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

                            <div class="position-fixed  end-0 p-3" style="z-index: 11">
                                <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                        <!-- <img src="..." class="rounded me-2" alt="..."> -->
                                        <strong class="me-auto">Bootstrap</strong>
                                        <small>11 mins ago</small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        Hello, world! This is a toast message.
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js">//Toast Funktion
$('.toast').toast('show');
                            </code></pre>
                        </div>
                    </div>

                    

                    
                    
                </div>
            </div>


            <div class='card'>
                <div class='card-body'>
                    <h4><i class="fa-solid fa-exclamation-circle"></i> BootstrapTables</h4>
                    <h6 class="subtext">Ein Plugin zum weg kopieren von fertigen Tabellen.</h6>
                    <p>Weitere Informationen und die Dokumentation findet man auf <a href="https://getbootstrap.com/docs/5.0/content/tables/">https://getbootstrap.com/docs/5.0/content/tables/</a>.</p>
            
                    <hr>
                    <!-- <p>Die Bootstrap Tabellen sind Standard Tabellen die man mit <mark><xmp>table - Tag</xmp></mark> öffnen kann. Man muss bestimmte <mark>Klassen</mark> mitgeben, die das Ganze dann stylen.</p> -->
                   
                    <div class="row">
                        <div class="col-md-6">
                            <p>Standard Tabelle bei der <mark>class="table"</mark>mitgegeben werden kann.</p>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td colspan="2">Larry the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="hljs language-html ctc"> <!-- Klasse die mitgegeben werden muss -->
<table class="table"></table></code></pre>
                        </div>
                    </div>
                    

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p>Tabellen bei den eine Klasse mitgegeben werden kann, für bestimmtes Styling.</p>
                            <table class="table" id="testTabelle" >
                        
                                <thead>
                                    <tr>
                                        <th scope="col"><i class="fa-solid fa-check-double"></i></th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Vorname</th>
                                        <th scope="col">Nachname</th>
                                        <th scope="col">Straße</th>
                                        <th scope="col">PLZ</th>
                                        <th scope="col">Telelfon</th>
                                        <th scope="col">E-Mail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th><i class="fa-regular fa-circle"></i></th>
                                        <th scope="row">1</th>
                                        <td>Peter</td>
                                        <td>Otto</td>
                                        <td>OtTostr. 2</td>
                                        <td>12345</td>
                                        <td>0661 12345</td>
                                        <td>Otto@web.de</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa-regular fa-circle"></i></th>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa-regular fa-circle"></i></th>
                                        <th scope="row">3</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa-regular fa-circle"></i></th>
                                        <th scope="row">4</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa-regular fa-circle"></i></th>
                                        <th scope="row">5</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa-regular fa-circle"></i></th>
                                        <th scope="row">5678</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        <td>@mdo</td>
                                        <td>@mdo</td>
                                        <td>peter@web.de</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <pre><code  class="hljs language-html ctc"><!-- Beispiel zu rechts -->
<table class="table table-striped table-hover table-bordered"> </table></code></pre>

                        </div>
                    </div>

                    
                        
            
                </div>
            </div>


            

            
            
            

        </div>

    </div>

    
</body>
<?php include('04_scripts.php'); ?>



<script>

    // TODO: Auslagern aber wohin. Man brauch es nicht auf jeder Seite neu laden. Nur hier auf dieser Seite
    $(document).ready(function() {


        var bootstrap = {

            init: function() {
                bootstrap.addListeners();
                bootstrap.initDataTable();
            },

            addListeners: function() {
                

                $('#liveToastBtn').on('click', function() {
                    $('.toast').toast('show');
                    
                });
            },

            initDataTable: function() {
                var table = $('#testTabelle').DataTable({ 
                    keys: true,
                    select: true,
                    buttons: [
                        {
                            //Select Ganze Zeile
                            text: 'Select all',
                            action: function () {
                                table.rows().select();
                            }
                        },
                        {
                            //Deselect ganze Zeile
                            text: 'Select none',
                            action: function () {
                                table.rows().deselect();
                            }
                        }
                    ]
                });
            }

        }
        bootstrap.init();
    
      
        
    });

   
</script>


</html>