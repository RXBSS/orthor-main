<?php include('01_init.php');

$_page = [
    'title' => "Pickliste Filter",
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



            



            <button class="btn btn-primary" id="test">Externer Filter</button>
            <br>
            <br>


            <div id="pickliste"></div>



            



        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {


        var pickliste = new Picklist("#pickliste", "example", {
            debug: false,

            /*
            dataTableOptions: {
                order: [[5, "asc"]]
            }
            */

            // fixFilter: new PickFilter(2, "Titel K"),

            pageLength: 10,
            order: [[5, "asc"],[2, "asc"]],
            showFilterOnStart: true
        }); 

    
        pickliste.on('ajax', function(el, response) {

        });
   
    


        // 
        $('#test').on('click', function() {


            var filter1 = new PickFilter('id', 8, "=");

            console.log(filter1);


            // Set Filter
            pickliste.setFilter(filter1);

            // 
            app.notify.success.fire("Erfolgreich", "Ihre Aktion wurde erfolgreich angepasst");
        });




    });
</script>

</html>