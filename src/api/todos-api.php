<?php


class ToDo {

    
    public $table = "_todos";

    // Constructor
    function __construct() {




    }

    // Neues ToDo erstellen
    function new($data) {

        // Validieren 
        $req = new Request($data);


        



    }

    // Get Todos
    function get() {

    }

    // Get Todos for User
    function getOpenUser($userId) {

        // Neuer Request
        $req = new Request();

        $query = "SELECT * FROM `".$this->table."` WHERE user_id = '".$userId."' AND erledigt = 0";

        // Multiple
        $req->getMultiQuery($query, true);

        return $req->answer();
    }

    public function setComplete($id) {
       
        // Neuer Request
        $req = new Request([
            'erledigt' => 1,
            'erledigt_zeitstempel' => date('Y-m-d H:i:s')
        ]);

        // 
        $process = [
            ['t', 'erledigt'],
            ['dt', 'erledigt_zeitstempel']
        ];

        // Multiple
        $req->update($this->table, $process, "WHERE `id` = '".$id."'");

        // RÜckgabe
        return $req->answer();
    }


}

?>