<?php
    $isLoggedIn = (isset($_SESSION['user']) && isset($_SESSION['user']['isLoggedIn'])) ? true : false;
?>

<!-- Container für den Login Bereich -->
<div class="current-user <?php echo ($isLoggedIn) ? "is-logged-in" : "not-logged-in"; ?> mb-3 d-flex align-items-center">

    <!-- User Icon -->
    <div class="user-icon">
        <?php             
            echo ($isLoggedIn)  ? '<i class="fa-solid fa-user fa-2x"></i>' : '<i class="fa-solid fa-exclamation-triangle fa-2x"></i>';
        ?>
    </div>

    <!-- Text -->
    <div class="user-text">
        <?php

            // Prüfen ob ein Benutzer angemeldet ist!
            if($isLoggedIn) {
                
                echo "<strong>".$_SESSION['user']['vorname']." ".$_SESSION['user']['nachname']."</strong><br>".$_SESSION['user']['email'];

            // Wenn nicht
            } else {
                echo "Nicht angemeldet!";
            }   


        ?>
    </div>

</div>