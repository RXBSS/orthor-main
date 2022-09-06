<?php include('01_init.php');

$_page = [
    'title' => "Get Selected",
    'breadcrumbs' => ["<a href='pickliste'><i class=\"fas fa-list\"></i> Pickliste</a>"]
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



            <div class="d-flex ">
                <button class="btn btn-primary btn-example flex-fill m-2" data-example="1">getSelectedSingle</button>
                <button class="btn btn-primary btn-example flex-fill m-2" data-example="2">getSelectedLength</button>
                <button class="btn btn-primary btn-example flex-fill m-2" data-example="3">getSelectedSingleColumn(2)</button>
                <button class="btn btn-primary btn-example flex-fill m-2" data-example="4">getSelectedColumn(2)</button>
                <button class="btn btn-primary btn-example flex-fill m-2" data-example="5">getSelectedIndex</button>
                <button class="btn btn-danger btn-example flex-fill m-2" data-example="6">Reset</button>
            </div>

            <br>



            <div class="row">
                <div class="col-6">
                    <pre id="result-1" style="border: 2px solid #DDD; background: #fff; padding: 5px;"><em>Noch nicht zum anzeigen. Bitte einen der Button klicken!</em></pre>
                </div>
                <div class="col-6">
                    <pre id="result-2" style="border: 2px solid #DDD; background: #fff; padding: 5px;"><em>Noch nicht zum anzeigen. Bitte einen der Button klicken!</em></pre>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div id="pickliste-1"></div>

                </div>
                <div class="col-md-6">
                    <div id="pickliste-2"></div>
                </div>
            </div>



        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {

        var list1 = new Picklist("#pickliste-1", "example", {
            type: 'single-picklist',
            dataTableOptions: {
                pageLength: 10
            },
            addHandleButtons: true
        });

        var list2 = new Picklist("#pickliste-2", "example", {
            type: 'multi-picklist',
            dataTableOptions: {
                pageLength: 10
            },
            addHandleButtons: true
        });




        $('.btn-example').on('click', function() {
            var ex = $(this).data('example');

            switch (ex) {
                case 1:
                    writeToPre(1, list1.getSelectedSingle(), 'getSelectedSingle()');
                    writeToPre(2, list2.getSelectedSingle(), 'getSelectedSingle()');
                    break;

                case 2:
                    writeToPre(1, list1.getSelectedLength(), 'getSelectedLength()');
                    writeToPre(2, list2.getSelectedLength(), 'getSelectedLength()');
                    break;

                case 3:
                    writeToPre(1, list1.getSelectedSingleColumn(2), 'getSelectedSingleColumn(2)');
                    writeToPre(2, list2.getSelectedSingleColumn(2), 'getSelectedSingleColumn(2)');
                    break;

                case 4:
                    writeToPre(1, list1.getSelectedColumn(2), 'getSelectedColumn(2)');
                    writeToPre(2, list2.getSelectedColumn(2), 'getSelectedColumn(2)');
                    break;

                case 5:
                    writeToPre(1, list1.getSelectedIndex(), 'getSelectedIndex()');
                    writeToPre(2, list2.getSelectedIndex(), 'getSelectedIndex()');
                    break;

                case 6:
                    list1.reset();
                    list2.reset();
                    $('#result-1, #result-2').html('<em>Noch nicht zum anzeigen. Bitte einen der Button klicken!</em>');
                    break;
            }
        });

        // 
        function writeToPre(id, content, befehl) {

            console.log('Liste ' + id + ', Befehl: ' + befehl);
            console.log(content);

            content = (content === true) ? 'true' : ((content === false) ? 'false' : content);
            content = (typeof content == 'object') ? JSON.stringify(content, null, 4) : content;

            $('#result-' + id).html(content);
        }



    });
</script>

</html>