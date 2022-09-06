/**
 * App Assign für Select 2
 * 
 */
var appAssignSelect2 = {

    /**
     * Standard Aufruf für die Select 2 Funktionen
     */
    initSelect2: function () {

        var me = this;

        // Fokus Search on Open
        // Das ist eine Zwischenlösung --> Siehe https://github.com/select2/select2/issues/5993
        $(document).on('select2:open', () => {
            let allFound = document.querySelectorAll('.select2-container--open .select2-search__field');
            allFound[allFound.length - 1].focus();
        });


        me.initSelect2User();
        me.initSelect2Laender();
    },

    // Select 2 User initalisieren
    initSelect2User: function () {

        $('.select-user').each(function () {

            // Select 2 mit Ajax Funktion
            $(this).select2({
                ajax: {
                    url: 'modules/quickselect/user.php',
                    dataType: 'json'
                }
            });

            var newOption = new Option("Bitte wählen", 0, true, true);

            $(this).append(newOption);

        });
    },

    // Select 2 User initalisieren
    initSelect2Laender: function () {
        
        
        $('.select-laender').each(function () {

            // Select 2 mit Ajax Funktion
            $(this).select2({
                ajax: {
                    url: 'modules/quickselect/laender.php',
                    dataType: 'json'
                }
            });

            var newOption = new Option("Bitte wählen", 0, true, true);

            $(this).append(newOption);
        });
    }


}