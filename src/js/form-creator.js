class FormCreator {

    /**
     * Im Constructor können Default Settins mitgegeben werden
     */
    constructor(settings) {

        var me = this;

        // Wenn der Benutzer die Master-Einstellungen überschrieben will
        settings = settings || {};

        // Default Settings holen
        me.s = $.extend({}, me.getDefaultSettings(), settings);
    }


    /**
     * Gibt die Standardeinstellungen zurück
     * @returns {Object} Objekt mit Standardeinstellungen
     */
    getDefaultSettings() {
        var me = this;

        // Rückgabe
        return {
            id: false,
            showLabel: true,
            required: false,
            readonly: false,
            tooltip: false,
            floating: true,
            placeholder: true,
            editable: true,
            class: [],

            // nur bei Select
            mutli: false,
            standard: true,

            // Nur bei Choose Elementen
            inline: false,

            // Nur bei Checkbox
            switch: false
        };
    }

    /**
     * Standard-Einstellungen mit den Feld-Einstellungen mergen
     * @param {Object} opts Objekt mit den Feld-Einstellungen
     * @returns {Object} Verschmolzene Einstellungen
     */
    mergeSettings(opts) {
        var me = this;
        opts = opts || {};
        return $.extend({}, me.s, opts);
    }



    /**
     * Erstellt eine Text-Input Feld
     * 
     * @param {String} name Name des Input Fields
     * @param {String} label Name des Labels
     * @param {String} value Name des Value Fields
     * @param {Object} opts Zu#stzliche Optionen
     * @returns {String} HTML des gewünschten Form-Elements
     */
    createInput(type, name, label, value, opts) {

        // Standard in jeder Funktion
        var me = this;
        var s = me.mergeSettings(opts);

        // Initalisieren
        label = label || name[0].toUpperCase() + name.slice(1);
        value = value || "";
        type = type || "text";

        // HTML erstellen    
        var html = '' +

            '<div class="form-group ' + ((s.floating) ? "form-floating" : "") + '">\n' +

            // Label wenn nicht Floating
            ((s.showLabel && !s.floating) ? '\t<label>' + label + '</label>\n' : "") +

            // Input
            '\t<input type="' + type + '" name="' + name + '" value="' + value + '" class="' + ('form-control ' + ((s.editable) ? 'editable' : '') + ' ' + s.class.join('')).trim() + '"' +

            // ID
            ((s.id) ? ' id="' + s.id + '"' : '') +

            // Placeholder
            ((s.placeholder) ? ' placeholder="' + ((s.placeholder === true) ? label : s.placeholder) + '"' : '') +

            // Readonly & Required
            ((s.readonly || s.required) ? ' ' : '') + (((s.readonly) ? 'readonly' : '') + ' ' + ((s.required) ? 'required' : '')).trim() +

            ' />\n' +

            // Label wenn Floating
            ((s.showLabel && s.floating) ? '\t<label>' + label + '</label>\n' : "") +

            '</div>';


        return html;
    }


    createText(name, label, value, opts) {
        var me = this;
        return me.createInput('text', name, label, value, opts);
    }

    createMail(name, label, value, opts) {
        var me = this;
        return me.createInput('mail', name, label, value, opts);
    }

    createPassword(name, label, value, opts) {
        var me = this;
        return me.createInput('password', name, label, value, opts);
    }

    createDate(name, label, value, opts) {
        var me = this;
        return me.createInput('date', name, label, value, opts);
    }

    createTime(name, label, value, opts) {
        var me = this;
        return me.createInput('time', name, label, value, opts);
    }

    createSelect(name, label, values, value, opts) {

        // Standard in jeder Funktion
        var me = this;
        var s = me.mergeSettings(opts);

        // Initalisieren
        label = label || name[0].toUpperCase() + name.slice(1);
        values = values || [];
        value = value || "";

        // HTML
        var html = '' +

            // Frame
            '<div class="form-group ' + ((s.floating) ? "form-floating" : "") + '">\n' +

            // Label wenn nicht Floating
            ((s.showLabel && !s.floating) ? '\t<label>' + label + '</label>\n' : "") +

            // Select
            '\t<select name="' + name + '" class="' + ('form-select ' + ((s.editable) ? 'editable' : '') + ' ' + s.class.join('')).trim() + '"' +

            // Placeholder
            ((s.placeholder) ? ' placeholder="' + ((s.placeholder === true) ? label : s.placeholder) + '"' : '') +

            // ID
            ((s.id) ? ' id="' + s.id + '"' : '') +

            // Multiple & Readonly & Required
            ((s.multi || s.readonly || s.required) ? ' ' : '') + (((s.multi) ? "multiple" : "") + ' ' + ((s.readonly) ? 'readonly' : '') + ' ' + ((s.required) ? 'required' : '')).trim() +

            ' />\n' +

            // Standard Wert
            ((s.standard) ? ((s.standard === true) ? '\t\t<option value="">Bitte wählen</option>\n' : '\t\t<option value="' + s.standard.value + '">' + s.standard.text + '</option>\n') : "");

        for (var i = 0; i < values.length; i++) {
            var sub = values[i];

            // Standard-Werte
            var selectValue = (typeof sub == 'object') ? sub.value : sub;
            var selectText = (typeof sub == 'object') ? sub.text : sub;

            // HTML hinzufügen
            html += '\t\t<option value="' + selectValue + '" ' + ((value && value == selectValue) ? 'selected' : '') + '>' + selectText + '</option>\n';
        }

        html += '\t</select>\n' +

            // Label wenn Floating
            ((s.showLabel && s.floating) ? '\t<label>' + label + '</label>\n' : "") +

            '</div>';


        return html;
    }



    /**
     * 
     */
    createCheckbox(name, label, value, opts) {

        // Standard in jeder Funktion
        var me = this;
        var s = me.mergeSettings(opts);

        value = value || false;

        // ID -  Wenn keine vorhanden ist, wird automatisch eine ID generiert
        var id = (s.id) ? s.id : 'cb-' + s.name;

        // Wenn beim Wert "nur" true angegeben wurde
        var sublabel = (s.showLabel === false) ? label : ((value === true || value === false) ? 'Aktivieren' : value.text);
        var checked = (value === true || value === false) ? value : value.checked;

        // HTML
        var html = '' + 

            '<div class="form-group form-floating-check">\n' + 

            // Label wenn nicht Floating
            ((s.showLabel) ? '\t<label class="form-label">' + label + '</label>\n' : "") +       

            // Choose Element
            me.createChooseElement(((s.switch) ? 'switch' : 'check'), name, id, sublabel, 1, checked, s) + 

            '</div>';

        return html;


    }

    createSwitch(name, label, value, opts) {   
        var me = this;
        opts = opts || {};
        opts.switch = true;
        return this.createCheckbox(name, label, value, opts);
    }

    createRadio(name, label, values, value, opts) {

        // Standard in jeder Funktion
        var me = this;
        var s = me.mergeSettings(opts);

        return "<em>Todo</em>";
    }

    /**
     * Erstellt anhand der Optionen ein Auswahl-Element
     * Wird von createCheckbox, createRadio, createSwitch, ... genutzt
     * @param {String} type Kann check, switch oder Radio sein
     * @param {String} id Ist hier ein Pflichtfeld auf Grund der Label-Problematik
     * @param {String} name Name des Inputs
     * @param {String} label Hier ist das Label neben der ID gemeint
     * @param {String} value Der Wert
     * @param {Object} opts Diverse Optionen
     * 
     */
    createChooseElement(type, name, id, label, value, checked, s) {

        // Types festlegen
        var typeClasses = {
            check: 'form-check',
            switch: 'form-check form-switch',
            radio: 'form-radio',
        };

        if (typeof typeClasses[type] == 'undefined') {
            throw new Error("Ungültiger Typ wurde ausgewählt");
        }


        // HTML Mockup
        var html = '' +

            '\t<div class="' + typeClasses[type] + ((s.inline) ? ' form-check-inline' : '') + '">\n' +

            // Input Element
            '\t\t<input type="' + ((type == 'check' || type == 'switch') ? 'checkbox' : 'radio') + '"' +

            // ID und Name sind Pflichtfelder!
            ' name="' + name + '" id="' + id + '"' +

            // Klassen
            ' class="' + ('form-check-input ' + ((s.editable) ? 'editable' : '') + ' ' + s.class.join('')).trim() + '"' +

            // Value
            ' value="' + value + '"' + 

            // Multiple & Readonly & Required
            ((checked || s.readonly || s.required) ? ' ' : '') + (((checked) ? "checked" : "") + ' ' + ((s.readonly) ? 'readonly' : '') + ' ' + ((s.required) ? 'required' : '')).trim() +

            ' />\n' +

            // Label
            '\t\t<label class="form-check-label" for="' + id + '">' + label + '</label>\n' +

            '\t</div>\n';

        return html;
    }


    createTextarea(name, value, opts) {
        
        // Standard in jeder Funktion
        var me = this;
        var s = me.mergeSettings(opts);


        /*
        <div class="form-group form-floating">
            <textarea class="form-control editable" name="name" placeholder="Bezeichnung"></textarea>
            <label>Bezeichnung</label>
        </div>
        */

        return "<em>Todo</em>";
    }





}