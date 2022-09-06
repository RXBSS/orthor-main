<?php

/**
 * Breadcrumbs
 */


// Breadcrumbs Defaults setzen (PHP 8)
$_page = $_page ?? [];
$_page['no-breadcrumbs'] = $_page['no-breadcrumbs'] ?? false;
$_page['breadcrumbs'] = $_page['breadcrumbs'] ?? [];
$_page['title'] = $_page['title'] ?? "Neue Seite";


?>

<!-- Breamcrumbs -->
<div class="breadcrumbs">

<?php

// Wenn das Flag "no-breadcrumbs" true ist, dann werden keine Breadcrums angezeigt
if(!$_page['no-breadcrumbs']) {

    // Ausgabe des ersten Knotens
    echo '<a href="index.php">'.$_SESSION['___settings']['system']['name'].'</a>';

    // Pürfen ob es Breadcrumbs gibt
    if (!empty($_page['breadcrumbs'])) {
        echo '<i class="divider fas fa-angle-right"></i>';
        echo implode('<i class="divider fas fa-angle-right"></i>', $_page['breadcrumbs']);
    }

    // Titel der Seite ausgeben
    if ($_page['title']) {
        echo '<i class="divider fas fa-angle-right"></i>' . $_page['title'];
    }
}

?>
</div>