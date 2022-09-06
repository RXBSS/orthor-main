<!-- Vendor Scripts -->
<script src="js/vendor.min.js"></script>

<!-- Orthor Scripts -->
<script src="js/orthor.js"></script>

<!-- Page Level JavaScript (falls vorhanden) -->
<?php

// Page Level JavaScript Name
$php_base_name = basename($_SERVER['PHP_SELF']);
$pagelevel_js_name = (str_contains($php_base_name, '.php')) ? str_replace(".php", ".js", $php_base_name) : $php_base_name . ".js";

// Page Level JavaScript
if (is_file('js/pagelevel/' . $pagelevel_js_name)) {
    echo '<script src="js/pagelevel/' . $pagelevel_js_name . '"></script>';
}

?>

<script>
    // Document Ready abwarten
    $(document).ready(function() {

        // App initalisieren
        app.init();
    });
</script>