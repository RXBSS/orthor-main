/**
 * Checkbox Connect
 * 
 * 
 */
 class cbConnect {

    // Construcktor
    constructor(container, options) {

        // Event Listner
        var me = this;

        // Container
        me.container = $(container);

        // Container prüfen
        if (!me.container.length) {
            throw new Error("Container wurde nicht gefunden!");
        }

        // DEPRECATED Warning
        console.warn('DEPRECATED: Bitte zu Activation Checkbox wechseln');

        // Settings erweitern 
        me.settings = $.extend({}, {
            checkCb: false,
            uncheckCb: false,
            fieldClass: false,
            reverse: false,
            form: false
        }, options);


        // Inital ausführen
        me.execute();

        // Click Event abfangen
        me.container.on('click change', function () {
            me.execute();
        });
    }

    // Checked zurückgeben
    getChecked() {

        var me = this;

        // Is Checked
        var isChecked = me.container.prop('checked');

        // Umdrehen, wenn Reverse aktiv ist
        if (me.settings.reverse) {
            isChecked = (isChecked) ? false : true;
        }

        // zurückgeben
        return isChecked;
    }


    // Execute Functions
    execute() {

        var me = this;

        // Prüfen ob die Checkbox gecheckt ist
        var isChecked = me.getChecked();

        // Wenn es eine Klasse für Felder gibt
        if (me.settings.fieldClass) {
            me.handleFieldClass(isChecked);
        }

        // Wenn Sie gecheckt ist
        if (isChecked) {

            // Prüfen ob es einen Callback gibt
            if (typeof me.settings.checkCb == 'function') {
                me.settings.checkCb();
            }

            // Wenn Sie nicht gecheckt ist
        } else {

            // Prüfen ob es einen Callback gibt
            if (typeof me.settings.uncheckCb == 'function') {
                me.settings.uncheckCb();
            }
        }
    }

    // verwaltet die Field Klassen
    handleFieldClass(isChecked) {

        var me = this;
        var withValidation = false;

        // Prüfen ob es eine Form gibt
        if (!me.settings.form) {
            throw new Error("Es wurde kein Form Handler angegeben!");
        }

        // Prüfen in welche Richtigung
        isChecked = me.getChecked();

        // Wenn es die Form gibt, und wenn die FormValidation aktiv ist 
        if(me.settings.form && me.settings.form.fvInstanz) {
            withValidation = true;
            var valFields = me.settings.form.fvInstanz.getFields();
        }
            
        // Alle Felder durchgehen
        me.settings.form.container.find(me.settings.fieldClass).each(function () {

            // Standard Werte setzen
            var name = $(this).attr('name');
            var needValidationSet = false;
            
            // Prüfen ob es sich bei dem Element um ein Input handelt, dass editierbar ist
            if(withValidation && $(this).hasClass('editable') && typeof valFields[name] != 'undefined') {   
                needValidationSet = true;
            }

            // Enable and Show
            if(isChecked) {
                
                // Wenn es eine From Group ist
                if($(this).hasClass('editable')) {
                    $(this).closest('.form-group').show();

                // Falls nicht
                } else {
                    $(this).show();
                }

                // Validierung setzen
                if(needValidationSet) {
                    me.settings.form.fvInstanz.enableValidator(name);
                }

            // Disable an Hide
            } else {

                // Wenn es eine From Group ist
                if($(this).hasClass('editable')) {
                    $(this).closest('.form-group').hide();
                
                // Falls nicht
                } else {
                    $(this).hide();
                }

                // Validierung setzen
                if(needValidationSet) {
                    me.settings.form.fvInstanz.disableValidator(name);
                }
            }
        });
    }

    // Uncheck
    uncheck() {
        var me = this;
        me.container.prop('checked', false);
        me.execute();
    }

    // Check
    check() {
        var me = this;
        me.container.prop('checked', true);
        me.execute();
    }

}