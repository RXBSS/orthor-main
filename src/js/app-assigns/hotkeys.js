/**
 * App Assign für Sweet Alert 
 * 
 */
var appAssignHotkeys = {

    /**
     * Hier werden alle Hotkeys initalisiert
     */
    initHotkeys: function () {

        // Hotkeys Filter hinzufügen
        hotkeys.filter = function (event) {
            return true;
        }

        // Alle Hotkeys initalisieren
        app.initHotkeyCurrentDateAndTime();

    },

    /**
     * Hotkey für STRG + D in Datum- und Zeitfeldern eingefügt
     */
    initHotkeyCurrentDateAndTime: function () {

        // Hotkey STRG + D
        hotkeys('ctrl+d', function (event, handler) {

            // Input Tag und Type auslesen
            var tagName = (event.target || event.srcElement).tagName;
            var type = (event.target || event.srcElement).type;

            // Wenn es sich um ein Input handelt
            if (tagName == 'INPUT' && type == 'date') {
                app.notify.info.fire('Tastenkombination', 'Es wird das aktuelle Datum eingefügt');
                $(event.target).val(moment().format('YYYY-MM-DD')).trigger('revalidate').trigger('change');
                event.preventDefault();
            }

            // Wenn es sich um ein Input handelt
            if (tagName == 'INPUT' && type == 'time') {
                app.notify.info.fire('Tastenkombination', 'Es wird die aktuelle Zeit eingefügt');
                $(event.target).val(moment().format('HH:mm')).trigger('revalidate').trigger('change');
                event.preventDefault();
            }
        });


        hotkeys('ctrl+backspace', function (event, handler) {

            // Input Tag und Type auslesen
            var tagName = (event.target || event.srcElement).tagName;
            var type = (event.target || event.srcElement).type;

            // Wenn es sich um ein Input handelt
            if (tagName == 'INPUT' && (type == 'date' || type == 'time')) {
                app.notify.info.fire('Tastenkombination', 'Das Feld wurde geleert');
                $(event.target).val('').trigger('revalidate').trigger('change');
                event.preventDefault();
            }

        });

        hotkeys('ctrl+del', function (event, handler) {

            // Input Tag und Type auslesen
            var tagName = (event.target || event.srcElement).tagName;
            var type = (event.target || event.srcElement).type;

            // Wenn es sich um ein Input handelt
            if (tagName == 'INPUT') {
                app.notify.info.fire('Tastenkombination', 'Das Feld wurde geleert');
                $(event.target).val('').trigger('revalidate').trigger('change');
                event.preventDefault();
            }
        });

        $('body').on('keypress', 'input[type=date]', function (e) {

            var value = moment($(this).val(), 'YYYY-MM-DD', true);

            var interval = (app.keys.shift) ? 'months' : 'days';

            // Wenn es Plus ist
            if (e.key == '+' || (e.key == '*' && app.keys.shift)) {

                if(!$(this).val()) {
                    $(this).val(moment().add(1, interval).format('YYYY-MM-DD')).trigger('revalidate').trigger('change');
                } else if(value.isValid()) {
                    $(this).val(value.add(1, interval).format('YYYY-MM-DD')).trigger('revalidate').trigger('change');
                }

            // Wenn es Minus ist
            } else if (e.key == '-' || (e.key == '_' && app.keys.shift)) {
                if(!$(this).val()) {
                    $(this).val(moment().subtract(1, interval).format('YYYY-MM-DD')).trigger('revalidate').trigger('change');
                } else if(value.isValid()) {
                    $(this).val(value.subtract(1, interval).format('YYYY-MM-DD')).trigger('revalidate').trigger('change');
                }
            }
        });

        $('body').on('keypress', 'input[type=time]', function (e) {

            var value = moment($(this).val(), 'HH:mm', true);
            var interval = (app.keys.shift) ? 'hours' : 'minutes';

            // Wenn es Plus ist 
            if (e.key == '+' || (e.key == '*' && app.keys.shift)) {

                if(!$(this).val()) {
                    $(this).val(moment().add(1, interval).format('HH:mm')).trigger('revalidate').trigger('change');
                } else if(value.isValid()) {
                    $(this).val(value.add(1, interval).format('HH:mm')).trigger('revalidate').trigger('change');
                }

            // Wenn es Minus ist
            } else if (e.key == '-' || (e.key == '_' && app.keys.shift)) {
                if(!$(this).val()) {
                    $(this).val(moment().subtract(1, interval).format('HH:mm')).trigger('revalidate').trigger('change');
                } else if(value.isValid()) {
                    $(this).val(value.subtract(1, interval).format('HH:mm')).trigger('revalidate').trigger('change');
                }
            }
        });
    }



}