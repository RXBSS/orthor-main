/**
 * Klasse zum Formatieren von Werten
 * 
 * 
 * 
 * 
 * 
 */
class Formatter {

    allFormat() {

        var me = this;

        // Erste Formatierung direkt nach dem Laden
        $('body').find('input[data-format]').each(function() {
            me.formatElement($(this));
        });

        // Formatieren nach Focus Out
        $('body').on('focusout', 'input[data-format]', function() {
            me.formatElement($(this));
        });

        // Nach Form Input
        $('body').find('input[data-format]').each(function() {
            
            var el = $(this);
            
            // Wenn etwas über ein Form Load gesetzt wurde
            el.on('form-input', function() {

                // Wenn es ein Währungsformatter ist
                if(el.val() && el.data('format') == 'Waehrung') {
                    var newValue = el.val().split(',').join('.').split('.').join(',');
                    el.val(newValue);
                }

                // Formatieren
                me.formatElement($(this));
            });
        });
    }

    

    // Formatieren
    formatElement(el, withFormat, withValue) {

        var me = this;

        // 
        var formatter = withFormat || el.data('format');

        // Erster Buchstabe muss bei Formatten immer groß sein
        formatter = formatter.substr(0,1).toUpperCase() + formatter.substr(1);

        if (typeof me['format' + formatter] == 'function') {

            // Wert
            var value = withValue || el.val();

            // Element übergeben
            var result = me['format' + formatter](value);

            // Wert schreiben
            el.val(result);

            // Wenn der Formatter nicht gefunden wurde
        } else {
            console.warn('Ungültiger Formatter gewählt! Formatter: ' + formatter + ", Element: ", el);
        }
    }

    formatElements(array, formatter) {

        var me = this;

        $.each(array, function () {
            me.formatElement(array, formatter);
        });
    }


    // Formatieren
    format(value, formatter) {

        var me = this;

        var result = value;

        // Prüfen ob es Formatter gibt
        if (typeof me['format' + formatter] == 'function') {
            result = me['format' + formatter](value);
        } else {
            console.warn('Ungültiger Formatter gewählt!');
        }

        return result;
    }

    /**
     * Alias für Währung
     */
    formatBetrag(value) {
        var me = this;
        return me.formatWaehrung(value);
    }

    // Formatieren
    formatWaehrung(value) {

        var me = this;

        var result = value;

        // Splitten
        var jsVal = me.formatJsFloatWithNaN(value);

        // Wenn es gültig ist!
        if (!isNaN(jsVal)) {
            result = me.formatAutoFloat(value, 2, 6);
        }

        return result;
    }

    formatJsFloat(value) {

        var me = this;


        var float = me.formatJsFloatWithNaN(value);

        return (isNaN(float)) ? value : float;
    }

    formatJsFloatWithNaN(value) {

        if (typeof value == 'number') {
            return value;
        } else {
            return parseFloat(String(value).trim().split('.').join('').split(',').join('.'));
        }
    }

    formatAutoFloat(value, nachkomma, maximal) {

        var me = this;
        var jsVal = me.formatJsFloatWithNaN(value);

        var result = value;

        nachkomma = (nachkomma || nachkomma === 0 || nachkomma === "0") ? nachkomma : 2;
        maximal =  (maximal || maximal === 0 || maximal === "0") ? maximal : 6;

        if (!isNaN(jsVal)) {

            var anzNachkomma = String(jsVal).split('.')[1];

            // Währung mit mehreren Nachkommastellen
            if (typeof anzNachkomma != 'undefined' && anzNachkomma.length > nachkomma) {
                result = new Intl.NumberFormat('de-DE', {
                    minimumFractionDigits: nachkomma,
                    maximumFractionDigits: maximal
                }).format(jsVal);
            } else {
                result = new Intl.NumberFormat('de-DE', {
                    minimumFractionDigits: nachkomma,
                    maximumFractionDigits: nachkomma
                }).format(jsVal);
            }
        }

        return result;
    }


    // Telefon formatieren
    formatTelefon(value) {

        var me = this;

        var result = value;

        // Init Phone Lib
        var phoneUtil = libphonenumber.PhoneNumberUtil.getInstance();

        // Input
        try {

            // Raw Input
            var rawInput = phoneUtil.parseAndKeepRawInput(value, 'DE');

            // Nach internationalesm Format ausgeben
            result = phoneUtil.format(rawInput, libphonenumber.PhoneNumberFormat.INTERNATIONAL);


            // Ausgabe
        } catch (ex) {
            // Keine gültige Nummer angegeben!
        }

        // Output
        return result;
    }

    formatUppercase(value) {
        return value.toUpperCase();
    }

    formatLowercase(value) {
        return value.toLowerCase();
    }

    formatStrasse(value) {
        return value.replace('str.', 'straße').replace('Str.', 'Straße');
    }


    formatWebsite(value) {

        // RegExy
        var https = new RegExp("^(http|https)://");
        var www = new RegExp("^www.");

        return value.replace(https, '').replace(www, '');
    }

    formatLink(value) {


        var https = new RegExp("^(http|https)://");

        var results = value.match(https);



        return ((results && results.length > 0) ? "" : "https://") + value;
    }

    formatMac(value) {

        var result = value;

        var temp = String(value).split(":").join('').split("-").join("");

        if (temp.length === 12) {
            result = temp.toUpperCase().match(/.{1,2}/g).join('-');
        }

        return result;
    }

    /**
     * Format Block
     */
    formatBlock(value) {
        var me = this;

        // Trimmen
        return (value) ? String(me.formatTrim(value)).match(/.{1,4}/g).join(' ') : "";
    }

    /**
    * Format Block
    */
    formatTrim(value) {
        return String(value).trim().split(' ').join('');
    }


    formatTime(value) {

        // Formatieren der Zeit, je nach Länge
        if(value.length == 2) {
            value = "00:" + value;
        } else if(value.length == 3) {
            value = "0" + value.substr(0,1) + ":" + value.substr(1,2);
        } else if(value.length == 4) {
            value = value.substr(0,2) + ":" + value.substr(2,2);
        } else if(value.length == 6) {
            value = value.substr(0,2) + ":" + value.substr(2,2) + ":" + value.substr(4,2);
        }

        // valide Zeit prüfen?
        // TODO: Nur anpassen, wenn es eine valide Zeit ist?
        // TODO: Umrechnen (z.B. 90 Min) in 1:30?

        return value;
    }

    formatDate(value) {

    }




}