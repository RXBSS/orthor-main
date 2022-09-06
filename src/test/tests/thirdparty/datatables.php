<?php include('01_init.php');

$_page = [
    'title' => 'Datatables'
];

?>
<!doctype html>

<!-- Head -->
<head>
    <title>Datatables</title>
    <?php include('02_header.php'); ?>

</head>


<!-- Body -->

<body>
    <?php include('03_navigation.php'); ?>

    <div class="wrapper">
        <div class="container-fluid">


            <div class="alert alert-danger">
                <strong><i class="fa-solid fa-fire"></i> Heads up!</strong> DataTables kann zwar auch so verwendet werden. In der Regel sollte aber die <a href="pickliste.php" class="alert-link">Pickliste</a> zum Einsatz kommen!
            </div>
        
            <div class="card">
                <div class="card-body">

                    <h4><i class="fa-solid fa-exclamation-circle"></i> Datatables</h4>
                    <h6 class="subtext">Ein Plugin zum Erstellen von Tabellen in einem gesondertem Format</h6>
                    <p>Weitere Informationen und die Dokumentation findet man auf <a href="https://datatables.net/">https://datatables.net/</a>.</p>
                    <hr>

                    <table class="table">
                        <tr>
                            <td><code>DataTables erstellen</code></td>
                            <td>
                                Zunächst wird immer eine Tabelle gebraucht die aufgerufen werden kann, z.b. 
                                <pre><code class="hljs language-html ctc">  <table id="example1" class="table table-striped table-sm"></table> </code></pre>
                            </td>
                        </tr>
                        <tr>
                            <td><code>Datatables Aufruf</code></td>
                            <td>
                                Nachdem erstellen der Tabelle muss diese mit der <strong><i>.DataTable()-Funktion</i></strong> per ID oder Klasse angesprochen und aufgerufen werden. <br>
                                Hier ein Beispiel für die erste Tabelle die auf der Seite zu sehen ist:
                                <pre><code class="hljs language-js ctc"> $('#example1').DataTable({
    ajax: "datatables-sample.json",
    language: {
        url: '../dist/js/locales/de_de.json'
    }
});</code></pre>    
                                Es können verschiedene Optionen mitgegeben werden, die man unter <a href="https://datatables.net/">https://datatables.net/</a> finden kann.
                            </td>
                        </tr>
                    </table>

                    <hr>

                    <div class="row">
                        <div class="col">
                            
                        

                        <br>
                            <table id="example1" class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Büro</th>
                                        <th>Alter</th>
                                        <th>Start Datum</th>
                                        <th>Bezahlung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>





            <div class="card">
                <div class="card-body">
                     <div class="row">
                        <div class="col-md-6">

                            <table id="example2" class="table table-striped table-hover table-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Büro</th>
                                        <th>Alter</th>
                                        <th>Start Datum</th>
                                        <th>Bezahlung</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <pre class="hljs language-js ctc"><code> $('#example2').DataTable({
    select: true,
    keys: true,
    ajax: "datatables-sample.json",
    language: {
        url: '../dist/js/locales/de_de.json'
    }
});</code></pre>
                    
                        </div>
                    </div>
                    
                </div>
            </div>
            

        </div>

    </div>


</body>

<?php include('04_scripts.php'); ?>
<script>
    

    $(document).ready(function() {
        $('#example1').DataTable({
            ajax: "datatables-sample.json",
            language: {
                url: '../dist/js/locales/de_de.json'
            }
        });

        $('#example2').DataTable({
            select: true,
            keys: true,
            ajax: "datatables-sample.json",
            language: {
                url: '../dist/js/locales/de_de.json'
            }
        });


    });


</script>

</html>