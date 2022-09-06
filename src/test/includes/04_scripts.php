<?php include('includes/04_scripts_orthor.php');

/**
 * Includes für alle Skripte
 */

?>

<!-- Highlight JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/highlight.min.js" integrity="sha512-z+/WWfyD5tccCukM4VvONpEtLmbAm5LDu7eKiyMQJ9m7OfPEDL7gENyDRL3Yfe8XAuGsS2fS4xSMnl6d30kqGQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>

$(document).ready(function() {
        
    // Code escapen
    $('code').each(function() {
        var that = $(this);
    
        if(that.hasClass('language-html')) {
            var html = that.html().trim();
            that.empty();
            that.text(html);
        }
    });

    hljs.highlightAll();

    // Nur ausführen, wenn es die Copy to Clipboard Klasse gibt
    if($('.ctc').length) {
        $('.ctc').copyToClipboard({
            buttonText: 'Kopieren',
            themeClass: 'theme-orthor',
            callback: function() {
                app.notify.success.fire("Kopiert","Der Text wurde in die Zwischenablage kopiert");
            }
        });
    }
});


</script>