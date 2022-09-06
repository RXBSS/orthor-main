<?php include('01_init.php');

// 
sleep(3);


// Saving
if ($_POST['task'] == 'save') {

    // 
    $success = ($_POST['additional']['example'] == 1) ? true : false;

    // 
    if ($_POST['additional']['example'] == 3) {
        echo "Hier würde die PHP Fehlermeldung stehen!";
        die();
    }

    // Ausgabe
    echo json_encode([
        'success' => $success,
        'message' => 'Herzlichen Glühstrumpf',
        'error' => 'Es gab das und das Problem.',
        'log' => $_POST
    ]);


    // Loading
} else if ($_POST['task'] == 'load') {

    $sampleData = [
        "stext" => "",
        "semail" => "weisser-zauberer@hotmail.com",
        "spassword" => "halbingskraut",
        "sdate" => "1705-03-23",
        "stime" => "19:34",
        "sselect" => 2,
        "sselectmulti" => [
            4,
            [
                "value" => 5,
                "text" => "Wert 5"
            ],
            6
        ],
        "stextarea" => "One Ring to bring them all and in the darkness bind them In the Land of Mordor where the Shadows lie",

        "ftext" => "Bilbo Baggins",
        "femail" => "bilbo.baggins@master-of-the-ring.org",
        "fpassword" => "Hobbingen!23",
        "fdate" => "2065-08-23",
        "ftime" => "04:22",
        "fselect" => [
            "value" => 1,
            "text" => "Wert 1"
        ],
        "fselectmulti" => false,
        "ftextarea" => "In a hole in the ground there lived a hobbit. \n Not a nasty, dirty, wet hole, filled with the ends of worms and an oozy smell, nor yet a dry, bare, sandy hole with nothing in it to sit down on or to eat: it was a hobbit-hole, and that means comfort.",
        
        // Checkboxen
        "cbeinfach" => true,
        "cbradioinline" => "option2",
        "cbradioline" => 1,
        "cbswitch" => true,
        "cbmehrfach[]" => [1],
        "cbmehrfachinline[]" => ['option2'],

        // Button Radio / Checkbox
        "checkedbutton1" => false,
        "checkedbutton2" => true,
        "checkedbutton3" => false,

        "radiobutton" => 2,

        // Range
        "range" => 55,

        // Select2 
        "select21" => [
            "value" => 3,
            "text" => "Wert 3"
        ],
        "select22" => 1,
        "select2multi" => [1, 2],

        "quickselect" => [[
            "value" => "DE",
            "text" => "Deutschland"
        ], [
            "value" => "AT",
            "text" => "Österreich"
        ]],

        "quickselect2" => [
            "value" => "4",
            "text" => "Leandro Schäfer"
        ],

        "summernote" => "Dieser Text kam über die Load Funktion",

        "betrag" =>  2302,
        "meter" => 50,

        "color" => "rgb(255,0,255)"

    ];


    $success = true;

    // Ausgabe
    echo json_encode([
        'success' => $success,
        'data' => $sampleData
    ]);
} else if ($_POST['task'] == 'load-test') {

    $success = true;

    $sampleData = [
        "test1" => [
            "value" => "DE",
            "text" => "Deutschland"
        ],
        "test2 " => [
            "value" => "1",
            "text" => "Tobias Pitzer"
        ]
    ];


    // Ausgabe
    echo json_encode([
        'success' => $success,
        'data' => $sampleData
    ]);
}
