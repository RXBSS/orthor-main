/**
 * Notification
 * 
 * Als Notfications werden die Dinge im oberen rechten Bereich angezeigt
 * 
 * 
 */
class Notification {

    // 
    constructor(settings) {

        var me = this;

        // Einstellungen mergen
        me.settings = $.extend({}, {
            container: false,
            parent: '.navbar-action-container',
            icon: false,
            color: false,
            blink: false,
            disabled: false
        }, settings);

        // Eltern Element
        me.parent = $(me.settings.parent);

        // Wenn das Parent Element nicht gefunden wurde
        if (!me.parent.length) {
            throw new Error("Das Eltern-Element wurde nicht gefunden!");
        }



        // Prüfen ob der Container schon existiert
        if (me.settings.container && $(me.settings.container).length) {
            me.createFromHtml();

            // Wenn er noch nicht existiert
        } else {
            me.createFromSettings();
        }
    }

    /**
     * Diese Funktion wird genutzt, wenn der Container bereits existiert
     * 
     */
    createFromHtml() {

        // TODO: Hier soll ein via PHP/HTML ersteller Container initalisiert werden!

    }

    /**
     * Wenn der Container nicht existiert
     */
    createFromSettings() {

        var me = this;

        // Wenn kein Icon angegeben wurde!
        if (!me.settings.icon) {
            throw new Error("Es muss ein Icon angegeben werden!");
        }

        // Prüfen ob eine ID mitgebene wurde
        me.settings.container = me.settings.container || 'notification-' + moment().format('x');

        // HTML
        var html = '<!-- Dynamisch erstellte Notification -->' +
            '<a href="javascript: void(0);" id="' + me.settings.container + '" class="navbar-action-icon">' +
            '   <i class="fa-solid fa-info-circle"></i>' +
            '</a>';

        // Anhängen
        me.parent.prepend(html);

        // Container finden
        me.container = me.parent.find('#' + me.settings.container);

        // Render
        me.render();

    }

    // Render
    render() {

        var me = this;

        // Icon
        if (!me.container.find('i').hasClass(me.settings.icon)) {
            me.container.find('i').removeClass().addClass(me.settings.icon);
        }

        // Mögliche Farben
        var possibleColors = ['success', 'warning', 'danger', 'info', 'light', 'dark'];


        // Wenn die Farbe gesetzt ist
        if (me.settings.color) {

            if (possibleColors.indexOf(me.settings.color) >= 0) {

                // Alle Farben entfernen
                $.each(possibleColors, function (index, value) {
                    me.container.removeClass('action-' + value);
                });

                // Action Signal hinzufügen
                me.container.addClass('action-signal action-' + me.settings.color);

                // Blink-Einstellungen
                if (me.settings.blink == 'fast') {
                    me.container.removeClass('action-static').addClass('action-fast');
                } else if (me.settings.blink === true || me.settings.blink == 'true' || me.settings.blink == 'slow') {
                    me.container.removeClass('action-static action-fast');
                } else {
                    me.container.removeClass('action-fast').addClass('action-static');
                }


                // Wenn die Farbe nicht gefunden wurde
            } else {
                throw new Error("Die gewählte Farbe ist unbekannt");
            }

            // Wenn nicht, dann action-signal entferenn
        } else {

            // Alle Farben entfernen
            $.each(possibleColors, function (index, value) {
                me.container.removeClass('action-' + value);
            });

            // Action Signal entfernen
            me.container.removeClass('action-signal');
        }

        if(me.settings.disabled) {
            me.container.prop('disabled',true);
        } else {
            me.container.prop('disabled',false);
        }
    }
    

    // Remove
    destroy() {
        var me = this;

        // Remove HTML 
        me.container.remove();

        // TODO: Zerstört nicht wirklich die Klasse!
    }


    hide() {
        this.container.hide();
    }

    show() {
        this.container.show();
    }

    /**
     * Status setzen
     * 
     * 
     * @param {Object} [keyValue={}] Key Value Pair der Einstellungen
     * 
     */
    change(keyValue) {

        var me = this;

        $.each(keyValue, function (index, value) {

            // Prüfen, ob es sich um eine gültige Einstellung handelt
            if (['icon', 'color', 'blink', 'disabled'].indexOf(index) >= 0) {

                // Wert
                me.settings[index] = value;
            }
        });

        me.render();

    }


    /**
 * Event Listner
 * 
 */
    on(event, cb) {
        var me = this;
        me.container.on(event, cb);
    }
}