/**
 * Karte aktivieren
 * 
 * 
 */
class ActivationCard {

    constructor(el, checkCondition) {

        var me = this;

        me.container = $(el);
        me.form = false;
        me.formFields = false;

        // Prüfen wird das der Container gefunden wird
        if (!me.container.length) {
            throw new Error("Activation Card - Container ist nicht definiert");
        }

        // Überschreiben der Funktion
        me.checkCondition = checkCondition || false;

        // Element
        me.findElement();

        // Beim Initalisieren ausführen
        me.action();

        // Event Listner hinzufügen
        me.addEventListner();
    }

    // 
    addEventListner() {

        var me = this;

        // Wenn auf das Element geklickt wurde
        me.el.on('click', function (e) {
            me.update();
        });
    }

    // Parent Element
    findElement() {

        var me = this;

        // Find by New Class
        me.el = me.findChildElement('.card-activate-switch');

        // Prüfen ob der Button festgelegt wurde
        if (!me.el) {

            // Alte Klasse festlegen
            me.el = me.findChildElement('.ca-activate-button');

            if (!me.el) {
                throw new Error("Keine Activation Button festgelegt!");
            } else {
                console.warn('Deprecated. Bitte die Klasse .ca-activate-button zu .card-activate-switch ändern');
            }
        }
    }

    findChildElement(className) {

        var me = this;
        var el = false;

        // Suchen nach allen Klassen
        // Hier können mehrere gefunden werden, wenn es mehrere Karten in einer Karte gibt
        me.container.find(className).each(function () {
            if ($(this).closest('.card').is(me.container)) {
                el = $(this);
            }
        });

        return el;
    }

    findChildElements(className) {

        var me = this;
        var els = [];

        // Suchen nach allen Klassen
        // Hier können mehrere gefunden werden, wenn es mehrere Karten in einer Karte gibt
        me.container.find(className).each(function () {
            if ($(this).closest('.card').is(me.container)) {
                els.push($(this));
            }
        });

        return els;
    }


    update() {

        var me = this;

        // Prüfen wie der aktuelle Zustand der Checkbox ist
        var isChecked = me.el.prop('checked');

        // Variable um später zu entscheiden ob das setzen der Checkbox verhindert werden soll
        var giveFeedback = false;

        // Wenn eine Prüfung der Kondition erfolgen soll
        if (me.checkCondition && typeof me.checkCondition == 'function') {

            // Prüft die Condition (Asynchron und Synchron)
            me.checkCondition(isChecked, function (setCheckboxTo) {

                // Checkbox setzen - Das hat keine Auswirkung bei Syncrhon
                me.el.prop('checked', setCheckboxTo);

                // Feedback für Synchrone Funktionen - Das hat keine Auswirkung bei Asyncrhon
                giveFeedback = ((!setCheckboxTo && !isChecked) || (setCheckboxTo && isChecked)) ? true : false;
            });

            // Nur die Aktion ausführen
        } else {

            // Action
            me.action();
        }


        // Prüfen ob das setzen der Checkbox verhindert werden soll
        if (!giveFeedback) {

            // Verhindern, dass gesetzt wird!
            return giveFeedback;
        }
    }

    // 
    addForm(form, fields) {

        var me = this;


        // Wenn es kein gültiges Form Objekt ist
        if (!form instanceof Form && !form instanceof CardForm && !form instanceof ModalForm) {
            throw new Error("Kein gültiges Form Objekt");
        }

        me.form = form;

        // Felder initalisieren
        fields = fields || [];

        // Is Readonly
        me.el.prop('disabled', form.isReadonly);

        // Form Fields
        me.formFields = fields;

        me.handleForm();

        // Event Listner
        form.on('readonly', function (el, isReadonly) {
            me.el.prop('disabled', isReadonly);
        });

        // Sorgt dafür, dass das Action Event getriggert wird
        form.on('setData', function (el) {
            me.action();
        });
    }


    handleForm() {

        var me = this;

        if (me.formFields && me.form) {

            var isChecked = me.el.prop('checked');

            // Für alle Felder!
            $.each(me.formFields, function (index, name) {

                var field = me.container.find('[name=' + name + ']');
                var mode = field.data('mode') || 0;


                // Wenn die Checkbox gesetzt ist
                if ((isChecked && field.hasClass('card-input-checked')) || (!isChecked && field.hasClass('card-input-unchecked'))) {
                    if (me.form.hasValidation) {
                        me.form.fvInstanz.enableValidator(name);
                    }
                } else if ((isChecked && field.hasClass('card-input-unchecked')) || (!isChecked && field.hasClass('card-input-checked'))) {
                    if (me.form.hasValidation) {
                        me.form.fvInstanz.disableValidator(name);
                    }

                    // Wenn der Modus auch Clear ist
                    if (mode == 1) {
                        me.form.clearField(name);
                    }
                }
            });

        }
    }



    /**
     * Wird ausgeführt 
     */
    action() {
        var me = this;
        me.defaultAction();
    }

    /**
     * Default Aktion
     * Blendet ein- und aus
     */
    defaultAction() {


        var me = this;

        $.each(function () {

        });

        var checkedEl = me.findChildElements('.card-body-checked');
        var uncheckedEl = me.findChildElements('.card-body-unchecked');


        if (checkedEl.length > 0) {
            $.each(checkedEl, function() {
                $(this).hide();
            });            
        }

        if (uncheckedEl.length > 0) {
            $.each(uncheckedEl, function() {
                $(this).hide();
            });
        }

        // Je nach Status setzen
        if (me.el.prop('checked')) {
            if (checkedEl.length > 0) {
                $.each(checkedEl, function() {
                    $(this).show();
                });            
            }
        } else {
            if (uncheckedEl.length > 0) {
                $.each(uncheckedEl, function() {
                    $(this).show();
                });
            }
        }


        if(me.container.find('.dataTables_wrapper').length) {
            $(window).trigger('dt-resize');
        }

        // Wenn eine Pickliste enthalten ist


        // Form Handlen
        me.handleForm();
    }


    getValue() {
        return this.container.find('.ca-activate-button').prop('checked');
    }
    
    activate() {
        this.container.find('.ca-activate-button').prop('checked', true);
    }

    deactivate() {
        this.container.find('.ca-activate-button').prop('checked', false);
    }
}