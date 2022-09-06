class ActivationInput {

    // Erstellen
    constructor(el, formElements, form) {

        var me = this;

        me.el = $(el) || false;

        // Form
        if (!me.el || !me.el.length) {
            throw new Error("Es wurde kein Element angegeben");
        }

        me.formElements = formElements || false;

        if (!me.formElements) {
            throw new Error("Es muss auch ein Form Element angegeben werden!");
        }

        // Normalisieren
        me.formElements = (Array.isArray(me.formElements)) ? me.formElements : [me.formElements];

        // Form
        me.form = form || false;

        me.action();
        me.addListner();

    }

    // Event Listner hinzufügen
    addListner() {

        var me = this;

        me.el.on('click', function () {
            me.action();
        });

        if (me.form) {

            // Sorgt dafür, dass das Action Event getriggert wird
            me.form.on('setData', function (el) {
                me.action();
            });
        }

    }


    // Action ausführen
    action() {

        var me = this;


        // 
        var isChecked = me.el.prop('checked');

        // Form Elements
        $.each(me.formElements, function (index, value) {

            // TODO: Dieser Teile sollte in das Init verlegt werden!

            // Einstellungen
            var settings = {
                el: false,  
                reverse: false,
                selector: false,
                text: false,
                keep: false,
                noBackup: false
            };

            // Wenn es ein jQuery Objekt ist
            if (value instanceof jQuery) {
                settings.el = value;

                // Wenn es ein String ist
            } else if (typeof value == 'string') {
                settings.selector = value;

                // Wenn es ein Objekt ist
            } else {
                settings = $.extend({}, settings, value);
            }

            var el = (settings.el) ? settings.el : ((me.form) ? me.form.container.find(settings.selector) : $('body').find(settings.selector));

            // Wenn das Element nicht gefunden wird, wird eine Warnung ausgegeben. Sonst erstmal nichts
            if (!el.length) {
                console.warn("Ein Element konnte nicht gefunden werden!");

            } else {

                // Hier muss noch das Readonly der Form beachtet werden?
                el.prop('disabled', (settings.reverse) ? isChecked : !isChecked);

                // Werte Anpassen
                if ((!settings.reverse && isChecked) || (settings.reverse && !isChecked)) {

                    if (el.data('backup')) {
                        el.val(el.data('backup'));
                    }

                    if (me.form && me.form.inValidationList(el.attr('name'))) {
                        me.form.fvInstanz.enableValidator(el.attr('name'));
                    }

                } else {

                    if (!settings.keep) {

                        // Backup speichern
                        if (!settings.noBackup) {
                            el.data('backup', el.val());
                        }

                        // Text
                        if (settings.text) {
                            el.val(settings.text);
                        } else {
                            el.val('');
                        }
                    }

                    if (me.form && me.form.inValidationList(el.attr('name'))) {
                        me.form.fvInstanz.disableValidator(el.attr('name'));
                    }

                }
            }
        });
    }


}