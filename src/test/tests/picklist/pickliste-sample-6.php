<?php include('01_init.php');

$_page = [
    'title' => "Auto Deselect",
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
            <div class="row">
                <div class="col-6">
                    <div id="example-picklist-1"></div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">Selection<div class="event event-1-1">0</div></div>
                                <div class="col-3">Selected<div class="event event-1-2">0</div></div>
                                <div class="col-3">Deselected<div class="event event-1-3">0</div></div>
                                <div class="col-3">Values<div class="event event-1-4">0</div></div>
                            </div>                    
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div id="example-picklist-2"></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">Selection<div class="event event-2-1">0</div></div>
                                <div class="col-3">Selected<div class="event event-2-2">0</div></div>
                                <div class="col-3">Deselected<div class="event event-2-3">0</div></div>
                                <div class="col-3">Values<div class="event event-2-4">0</div></div>
                            </div>    
                               
                        </div>
                    </div>
                </div>
            </div>

            <button id="reset" class="btn btn-primary">Reset Counter</button>             
            <button id="test-1" class="btn btn-primary">Select Row 5</button>             
            <button id="test-2" class="btn btn-primary">Deselect Row 5</button>             

        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {


        // Picklist Modal
        var picklist1 = new Picklist("#example-picklist-1", 'example', {
            type: 'multi-picklist',
            autoDeselect: false,
            pageLength: 10
        });

        var picklist2 = new Picklist("#example-picklist-2", 'example', {
            type: 'multi-picklist',
            autoDeselect: true,
            pageLength: 10
        });

        picklist1.on('selection', function() {
            func(1,1);
        });

        picklist1.on('selected', function() {
            func(1,2);
        });

        picklist1.on('deselected', function() {
            func(1,3);
        });

        picklist2.on('selection', function() {
            func(2,1);
        });

        picklist2.on('selected', function() {
            func(2,2);
        });

        picklist2.on('deselected', function() {
            func(2,3);
        });

        $('#reset').on('click', function() {
            $('.event').html(0);
        });

        $('#test-1').on('click', function() {
            picklist2.selectRow(5);
        });

        $('#test-2').on('click', function() {
            picklist2.deselectRow(5);
        });

        function func(a,b) {
            var el = $('.event-' + a + '-' + b);
            el.html(parseInt(el.html()) + 1);
            
            if(a == 1 && b == 1) {
                var len = picklist1.getSelectedLength();
                $('.event-1-4').html(len);

            } else if(a == 2 && b == 1) {
                var len = picklist2.getSelectedLength();
                $('.event-2-4').html(len);
            }

        }


    });
</script>

</html>