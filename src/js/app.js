/**
 * Das ist die App Klasse. 
 * Hier sind fast alle JavaScript Funktionen vorhanden. 
 * 
 * Damit es übersichtlicher ist, werden die Optionen über `Object.assing` hinzugefügt. 
 * Diese müssen in dem Ordner app-assigns liegen, da dieser vorher eingebettet wird. 
 * 
 * Alle Skripte sollten mit dem Prefix `var appAssign` anfangen:
 * Zum Beispiel var appAssignSweetAlert
 * 
 * 
 * 
 */
var app = {

    //Variable SignaturPad-ID
    signatureCanvas: $('#signatureCanvas'),



    // Init 
    init: function () {

        console.log('Init Orthor');

        // AddListeners
        app.addListener();

        // Init Key Listner
        app.initKeyListner();

        // Autogrow initalisieren
        app.initAutosize();

        // Hotkeys initalisieren
        app.initHotkeys();

        // Tooltip Initalisieren
        app.initTooltips();

        // Init Fab Buttons
        app.initFabButtons();

        // Initalisiert die Navigation
        app.initNavigation();

        // Init Select 2
        app.initSelect2();

        // Init Formatter
        app.initFormatter();

        // Init Loader
        app.wrapperLoader.init();

        // Trigger App Ready Event
        $(document).trigger('app:ready');
    },

    /**
     * Fügt alle Event-Listener hinzu
     */
    addListener: function () {

        var me = this;

        /**
         * Standard Event zum Verlinken
         * Wenn der Link mit einem Unterstrich beginnt, dann soll es in einem neuen Tab aufgerufen werden
         * 
         */
        $('body').on('click', '[data-redirect]', function () {

            // Redirect
            var redirect = $(this).data('redirect');

            if (redirect) {

                // Wenn ein neues Fenster geöffnet werden soll
                if (redirect.substr(0, 1) == '_') {

                    // Weiterleiten
                    window.open(redirect.substr(1), '_blank');

                } else {
                    app.redirect(redirect);
                }
            }
        });

        /**
         * Dies sorgt dafür, dass bei einem Tab-Wechsel die Picklisten neu ausgerichtet werden
         */
         $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function () {
            if ($($(this).data('bs-target')).find('.dataTables_wrapper').length) {
                $(window).trigger('dt-resize');
            }
        });


       
    },

    /**
     * Event Listner für gedrückte Tasten
     * Damit lassen sich Klick und Tastendrücke abfangen
     * 
     */
    initKeyListner: function () {

        var me = this;

        // Keys definieren
        me.keys = {
            ctrl: false,
            alt: false,
            shift: false
        }

        $(window).on('keydown', function (evt) {
            if (evt.which == 16) { me.keys.shift = true; }
            if (evt.which == 17) { me.keys.ctrl = true; }
            if (evt.which == 18) { me.keys.alt = true; }
        }).on('keyup', function (evt) {
            if (evt.which == 16) { me.keys.shift = false; }
            if (evt.which == 17) { me.keys.ctrl = false; }
            if (evt.which == 18) { me.keys.alt = false; }
        
        // Wenn man das Fenster verlässt, dann 
        }).on('blur', function() {
            me.keys.shift = false;
            me.keys.ctrl = false;
            me.keys.alt = false;
        });
    },



    /**
     * Fügt automatisch Autosize zu Textareas hinzu.
     * Wenn man dies nicht haben will, muss man die Klasse `.no-autosize` zu der Textarea hinzufügen.
     * Siehe autosize.min.js in den Vendors
     */
    initAutosize: function () {

        // Prüfe alle Textareas
        $('textarea').each(function () {
            if (!$(this).hasClass('no-autosize')) {
                autosize($(this));
            }
        });
    },


    /**
     * Bootstrap Toolstips initalisieren
     */
    initTooltips: function () {
        $('[data-bs-toggle="tooltip"]').each(function () {
            new bootstrap.Tooltip($(this)[0]);
        });
    },

    /**
     * Formatierer
     * Siehe formatter.js
     */
    initFormatter() {

        var me = this;

        // Formatter zur App hinzufügen, dann braucht dieser nicht jedes Mal initalisiert werden!
        me.formatter = new Formatter();

        // Alle Formatierungen starten!
        me.formatter.allFormat();
    },

    /**
     * Weiterleiten an eine Bestimmte URL. 
     * Öffnen automatisch den Spinner 
     * @param {String} url 
     */
    redirect: function (url) {

        // Loader öffnen
        app.alert.loader.fire();

        // Weiterleiten
        window.location.href = url;
    },

    /**
     * Simple AJAX Request
     * 
     * 
     * @param {String} task Der Task, der an die Handle übergeben wird
     * @param {String} url Die URL die AJAX anspricht
     * @param {Object} [data={}] Die Daten die übergeben werden sollen
     * @param {Function} [cbSuccess] Der Success Task
     * @param {Function} [cbError] Der Error Callback
     * @param {Function} [cbServerError] Der Server Error Callback
     */
    simpleRequest: function (task, url, data, cbSuccess, cbError, cbServerError) {

        // Input generalisieren
        data = data || {};
        cbSuccess = (typeof cbSuccess == 'function') ? cbSuccess : false;
        cbError = (typeof cbError == 'function') ? cbError : false;
        cbServerError = (typeof cbServerError == 'function') ? cbServerError : false;

        // Ajax
        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: url,
            data: {
                data: data,
                task: task
            },

            // Erfolgreichmeldung
            success: function (data) {


                // Hat wirklich geklappt
                if (data.success) {

                    if (cbSuccess) {
                        
                        var result = cbSuccess(data);

                        // Rückgabe
                        if (result) {
                            app.notify.success.fire("Erfolgreich", (result === true) ? "Ihre Aktion wurde erfolgreich ausgeführt" : result);
                        }

                    } else {
                        app.notify.success.fire("Erfolgreich", "Ihre Aktion wurde erfolgreich angepasst");
                    }
                } else {
                    
                    if (cbError) {
                        
                        var result = cbError(data);

                        if (result) {
                            app.notify.error.fire("Fehler", (result === true) ? ((data.error) ? data.error : "Die Aktion wurde nicht vollständig ausgeführt") : result);
                        }

                    } else {
                        app.notify.error.fire("Fehler", (data.error) ? data.error : "Die Aktion wurde nicht vollständig ausgeführt");
                        console.log(data);
                    }
                }
            },

            // Errormeldung
            error: function (error, b, errorThrown) {
                
                if (cbServerError) {
                    cbServerError(error, b, errorThrown);
                } else {
                    app.alert.debugError("Fehler im Request", errorThrown, error.responseText);
                    console.log(error, b, errorThrown);
                }
            }
        });
    },


    /**
     * 
     * @returns {String} Gibt einen SVG HTML String zurück
     */
    getLoaderSvg(size) {

        size = size || 200;

        // Loader
        return '<svg svg xmlns="http://www.w3.org/2000/svg" xmlns: xlink="http://www.w3.org/1999/xlink" style="margin: auto; display: block; shape-rendering: auto;" width="' + size + 'px" height="' + size + 'px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" ><circle cx="84" cy="50" r="10" fill="#7ab929"> <animate attributeName="r" repeatCount="indefinite" dur="0.25s" calcMode="spline" keyTimes="0;1" values="10;0" keySplines="0 0.5 0.5 1" begin="0s"/> <animate attributeName="fill" repeatCount="indefinite" dur="1s" calcMode="discrete" keyTimes="0;0.25;0.5;0.75;1" values="#7ab929;#649822;#000000;#333333;#7ab929" begin="0s"/></circle><circle cx="16" cy="50" r="10" fill="#7ab929"> <animate attributeName="r" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="0s"/> <animate attributeName="cx" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="0s"/></circle><circle cx="50" cy="50" r="10" fill="#333333"> <animate attributeName="r" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.25s"/> <animate attributeName="cx" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.25s"/></circle><circle cx="84" cy="50" r="10" fill="#000000"> <animate attributeName="r" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.5s"/> <animate attributeName="cx" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.5s"/></circle><circle cx="16" cy="50" r="10" fill="#649822"> <animate attributeName="r" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="0;0;10;10;10" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.75s"/> <animate attributeName="cx" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.25;0.5;0.75;1" values="16;16;16;50;84" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.75s"/></circle></svg>';

    },

    // WrapperLoader
    wrapperLoader: {

        // Beim initalisieren
        init() {
            var me = this;

            me.loader = app.getLoaderSvg();

            if ($('body').find('.wrapper').hasClass('loading')) {
                $('body').find('.wrapper').append('<div class="loader-content">' + me.loader + '</div>');
            }
        },

        // Start
        start() {
            var me = this;
            $('body').find('.wrapper').addClass('loading');
            $('body').find('.wrapper').append('<div class="loader-content">' + me.loader + '</div>');
        },

        // Stop
        stop() {
            $('body').find('.wrapper').removeClass('loading');
            $('body').find('.wrapper .loader-content').remove();
        }
    },

    /**
     * Funktion um auf alle Picklisten zu warten 
     */
    waitForPicklists(picklistArray, callback, i) {

        var me = this;

        // Wenn der iterator nicht definiert ist
        if (typeof i == 'undefined') {
            i = picklistArray.length;
        }

        i--;

        if (typeof picklistArray[i] != 'undefined') {
            picklistArray[i].waitForReady(function () {
                if (i > 0) {
                    me.waitForPicklists(picklistArray, callback, i);
                } else {
                    callback();
                }
            });
        } else {
            callback();
        }
    }



}

// Assign Modules
app = Object.assign(app, appAssignSweetAlert);
app = Object.assign(app, appAssignHotkeys);
app = Object.assign(app, appAssignSelect2);
app = Object.assign(app, appAssignNavigation);
app = Object.assign(app, appAssignHelper);
app = Object.assign(app, appAssignFab);
