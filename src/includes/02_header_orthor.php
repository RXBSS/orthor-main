<?php
/**
 * Meta Daten und Stylesheets 
 */
?>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo strip_tags($_page['title']); ?></title>

<!-- Vendor Stylesheet einfügen -->
<link rel="stylesheet" href="css/vendor.css">

<!-- Stylesheet einfügen -->
<link rel="stylesheet" href="css/orthor.css">

<?php

// Der Name des Page Level CSS Files
$php_base_name = basename($_SERVER['PHP_SELF']);
$pagelevel_css_name = (str_contains($php_base_name, '.php')) ? str_replace(".php", ".css", $php_base_name) : $php_base_name . ".css";

// Prüfen ob es eine Page Level CSS Datei gibt
if (is_file("css/pagelevel/" . $pagelevel_css_name)) {
    echo '
        <!-- Page Level CSS File -->
        <link rel="stylesheet" href="css/pagelevel/' . $pagelevel_css_name . '">
    ';
}


?>