/**
 * App Assign für Select 2
 * 
 */
var appAssignNavigation = {

    // Navigation initalisieren
    initNavigation() {

        var me = this;

        // Event Listner für die Navigation
        me.addEventListenerNavigation();

        // Markiere die aktuelle Seite
        me.markCurrentPage();

        // Resize Navigation je nach Seitengröße
        me.resizeNavigation(true);

    },

    /**
     * Event Listner für Navigation
     */
    addEventListenerNavigation() {

        var me = this;

        // Wenn die Navigation ein Autoclose hat
        $('.nav-autoclose').on('click', '[data-bs-toggle="collapse"]', function () {
            me.closeOpenDropdownsInNavigation($(this));
        });

        // Resize des Fensters
        $(window).on('resize', $.debounce(function () {
            me.resizeNavigation();
        }, 50));

        // Wenn Sidebar Toggle gedrückt wird
        $('.sidebar-toggler').on('click', function () {
            if ($('body').hasClass('closed-sidebar')) {
                me.showNav();
            } else {
                me.hideNav();
            }
        });


    },

    /**
     * Schließt alle anderen geöffneten Dropdowns
     * - Zunächst wird geprüft, ob es sich bei dem Click um ein öffnen handelt
     * - Falls ja, dann wird die übergeordnete Liste gesucht
     * - In der übergeordneten Liste werden alle Elemente gesucht, die aktuell offen sind
     * - Da die .show Klasse erst nach der Animation hinzugefügt wird, muss hier das aktuelle Element nicht ausgeschlossen werden
     * - Anschließend wird mit der Bootstrap Methode das Element geschlossen 
     * 
     */
    closeOpenDropdownsInNavigation(el) {

        // Nur wenn das Dokument geschlossen wird
        if (!el.hasClass('collapsed')) {

            // Suche nach der übergeordneten Liste und dort in alle geöffnenten collapse
            el.closest('ul').find('.collapse.show').each(function () {

                // Schließe alle geöffneten Collapse
                bootstrap.Collapse.getInstance($(this).get(0)).hide();
            });

        }
    },

    /**
     * Öffnet die Navigation und markiert die Seite an der entsprechenden Stelle
     */
    markCurrentPage() {

        var me = this;

      
        // Wenn 
        var page = $('body').data('page');

        // Wenn im Body eine Page steht
        if(page) {
            me.findAndMarkNavigationElement(page);
        } else {
            // Url Daten erhalten
            var urlData = me.getUrlData();

            // Mit Hilfe der URL
            me.findAndMarkNavigationElement(urlData.current);
        }
    },


    /**
     * 
     * @param {*} name 
     * @returns {Boolean} Gibt true oder false zurück ob das Element gefunden wurde
     */ 
    findAndMarkNavigationElement(name) {

        var me = this;

        var el = $('.sidebar').find('a[href="' + name + '"]');

        if (el.length) {    

            // Aktiv Klasse hinzufügen
            el.addClass('active');

            var parentEl = el.closest('.collapse');

            // Prüfen ob es ein Eltern-Element gibt, dass aufgeklappt werden muss
            if (parentEl.closest('.collapse').length) {

                // Bootstrap
                new bootstrap.Collapse(parentEl.closest('.collapse').get(0));

                var grandParentEl = parentEl.closest('.collapse');

                if (grandParentEl.closest('.collapse').length) {
                    new bootstrap.Collapse(grandParentEl.closest('.collapse').get(0));
                }
            }
        }

        return (el.length) ? true : false;
    },


    /**
     * Navigation ein- und Ausblenden je nach Größe
     */
    resizeNavigation(isInit) {

        var me = this;


        // Animationen hinzufügen!
        if (isInit) {
            setTimeout(function () {
                $('body').addClass('with-transition');
            }, 500);
        }

        var initVal = localStorage.getItem('navgation');

        if (isInit && initVal) {

            if (initVal == 'hide') {
                me.hideNav();
            } else {
                me.showNav();
            }

        } else {

            if ($(window).width() < 992) {
                me.hideNav();
            } else {
                me.showNav();
            }
        }
    },

    // 
    showNav() {
        $('body').removeClass('closed-sidebar');
        $('.sidebar-toggler').removeClass('fa-rotate-180');
        $(window).trigger('dt-resize');

        // Save Position
        localStorage.setItem('navgation', 'show');

    },

    // 
    hideNav() {

        $('body').addClass('closed-sidebar');
        $('.sidebar-toggler').addClass('fa-rotate-180');
        $(window).trigger('dt-resize');

        localStorage.setItem('navgation', 'hide');
    }



}