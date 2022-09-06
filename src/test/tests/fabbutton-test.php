<?php


function getExampleFAB($info) {

    $class = "";
    $icon = '<i class="fa-solid fa-plus"></i>';
    $data = "";

    if($info == 'rotate') {
        $class = "fab-rotate";
        $icon = '<i class="fa-solid fa-angle-up"></i>';
    } else if($info == 'switch') {
        $icon = '<i class="fa-solid fa-info-circle"></i>';
        $class = "fab-switch";
        $data = 'data-switch="fas fa-times"';
    }


    $html = '

    <!-- Large Example -->
    <div class="fab-container" style="right: 520px;">
        <button class="btn btn-light btn-sm fab-children"><i class="fa-solid fa-user-ninja"></i></button>
        <button class="btn btn-light btn-sm fab-children"><i class="fa-solid fa-cart-shopping"></i></button>
        <button class="btn btn-light btn-sm fab-children"><i class="fa-solid fa-database"></i></button>
        <button class="btn btn-light btn-sm fab-children"><i class="fa-solid fa-xmark"></i></button>
        <button class="btn btn-light btn-sm fab-children"><i class="fa-solid fa-user-secret"></i></button>
        <button class="btn btn-light btn-sm fab-children"><i class="fa-solid fa-user-secret"></i></button>
        <button class="btn btn-light btn-sm fab-children"><i class="fa-solid fa-users"></i></button>
        <button class="btn btn-light fab-parent '.$class.'" '.$data.'>'.$icon.'</button>
    </div>

    <!-- Secondary -->
    <div class="fab-container" style="right: 120px;">
        <button class="btn btn-secondary btn-sm fab-children"><i class="fa-solid fa-angle-up"></i></button>
        <button class="btn btn-secondary btn-sm fab-children"><i class="fa-solid fa-angle-up"></i></button>
        <button class="btn btn-secondary btn-sm fab-children"><i class="fa-solid fa-angle-up"></i></button>
        <button class="btn btn-secondary fab-parent '.$class.'" '.$data.'>'.$icon.'</button>
    </div>

    <!-- Working Example -->
    <div class="fab-container" style="right: 420px;">
        <button class="btn btn-info btn-sm fab-children"><i class="fa-solid fa-user-ninja"></i></button>
        <button class="btn btn-info btn-sm fab-children"><i class="fa-solid fa-user-secret"></i></button>
        <button class="btn btn-info btn-sm fab-children"><i class="fa-solid fa-users"></i></button>
        <button class="btn btn-info fab-parent '.$class.'" '.$data.'>'.$icon.'</button>
    </div>

    <!-- Working Example -->
    <div class="fab-container" style="right: 320px;">
        <button class="btn btn-warning fab-children"><i class="fa-solid fa-cart-shopping"></i></button>
        <button class="btn btn-warning fab-children"><i class="fa-solid fa-database"></i></button>
        <button class="btn btn-warning fab-children"><i class="fa-solid fa-xmark"></i></button>
        <button class="btn btn-warning fab-children"><i class="fa-solid fa-user-ninja"></i></button>
        <button class="btn btn-warning fab-children"><i class="fa-solid fa-user-secret"></i></button>
        <button class="btn btn-warning fab-children"><i class="fa-solid fa-users"></i></button>
        <button class="btn btn-warning fab-parent '.$class.'" '.$data.'>'.$icon.'</button>
    </div>

    <!-- Working Example -->
    <div class="fab-container" style="right: 220px;">
        <button class="btn btn-danger btn-sm fab-children"><i class="fa-solid fa-user-ninja"></i></button>
        <button class="btn btn-danger btn-sm fab-children"><i class="fa-solid fa-user-secret"></i></button>
        <button class="btn btn-danger btn-sm fab-children"><i class="fa-solid fa-users"></i></button>
        <button class="btn btn-danger fab-parent '.$class.'" '.$data.'>'.$icon.'</button>
    </div>    

    <!-- Simple -->
    <div class="fab-container">
        <button class="btn btn-primary btn-sm fab-children"><i class="fa-solid fa-angle-up"></i></button>
        <button class="btn btn-primary btn-sm fab-children"><i class="fa-solid fa-angle-up"></i></button>
        <button class="btn btn-primary btn-sm fab-children"><i class="fa-solid fa-angle-up"></i></button>
        <button class="btn btn-primary fab-parent '.$class.'" '.$data.'>'.$icon.'</button>
    </div>


   

    ';

    return $html;
}
