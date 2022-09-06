<?php include('01_init.php');

$_page = [
    'title' => "Template"
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
            <pre>
            <?php

            $test = [
                "draw" => 1,
                "columns" => [

                    "0" => [

                        "data" => 0,
                        "name" => "", "",
                        "searchable" => false,
                        "orderable" => false,
                        "search" => [

                            "value" => "", "",
                            "regex" => false
                        ]

                    ],

                    "1" => [

                        "data" => 1,
                        "name" => "",
                        "searchable" => true,
                        "orderable" => true,
                        "search" => [

                            "value" => "",
                            "regex" => false,
                        ]

                    ],

                    "2" => [

                        "data" => 2,
                        "name" => "",
                        "searchable" => true,
                        "orderable" => true,
                        "search" => [

                            "value" => "",
                            "regex" => false
                        ]

                    ],

                    "3" => [

                        "data" => 3,
                        "name" => "",
                        "searchable" => true,
                        "orderable" => true,
                        "search" => [

                            "value" => "",
                            "regex" => false
                        ]

                    ],

                    "4" => [

                        "data" => 4,
                        "name" => "",
                        "searchable" => true,
                        "orderable" => true,
                        "search" => [

                            "value" => "",
                            "regex" => false
                        ]

                    ],

                    "5" => [

                        "data" => 5,
                        "name" => "",
                        "searchable" => true,
                        "orderable" => true,
                        "search" => [

                            "value" => "",
                            "regex" => false
                        ]

                    ],

                    "6" => [

                        "data" => 6,
                        "name" => "",
                        "searchable" => true,
                        "orderable" => true,
                        "search" => [

                            "value" => "",
                            "regex" => false
                        ]

                    ],

                    "7" => [

                        "data" => 7,
                        "name" => "",
                        "searchable" => true,
                        "orderable" => true,
                        "search" => [

                            "value" => "",
                            "regex" => false
                        ]

                    ]

                ],

                "order" => [

                    "0" => [

                        "column" => 11,
                        "dir" => "asc"
                    ]

                ],

                "start" => 0,
                "length" => 19,
                "search" => [

                    "value" => "Titel A",
                    "regex" => false
                ],

                "_" => 1630330294251
            ];




            class TestDt extends Dt {
                public function editSpecialColumn($a, $b, $c) {
  

                    switch($b) {
                        case "special": 
                            $value = date('Y-m-D');
                            break;
                    }

                    return $value;
                }
            }


            // Get Variable übergeben
            $dt = new TestDt($test , "example");
            
            // Verarbeiten
            $dt->process();

            print_r($dt->data);


            // Output
            $dt->output();


            ?>
            </pre>
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {
        // Do Something
    });
</script>

</html>