/**
 * War eine Überlegung, bisher unterscheiden sich die Klassen
 * aber noch zu sehr voneinander. 
 * 
 * Ggf. macht es Sinn diese noch einmal komplett neu zu schreiben. 
 * Vorerst funktioniert es aber so.
 * 
 * 
 * 
 */
class Activation {


    // Erstellen
    constructor(el, list, form, debug) {

        var me = this;

        me.el = el || false;
        me.list = list || false;
        me.debug = debug || false;

        // Wenn kein Element angegeben wurde
        if(!me.el) {
            throw new Error("Es wurde kein Element zum Auslesen angegeben");
        }

        // Prüfen ob ein jQuery Selector angegeben wurde
        me.el = (me.el instanceof jQuery) ? me.el : $(me.el);

        // Form
        if (!me.el.length) {
            throw new Error("Es wurde ein Element angegeben, aber das Element wurde nicht auf der Seite gefunden!");
        }

        // Elemente prüfen
        if (!me.list) {
            throw new Error("Es wurden keine Elemente angegeben");
        } else {

            // Normalisieren
            me.normalizeToObject();
        }

        // Form
        me.form = form || false;

        me.lastData = me.getValue();
        
        // Action durchführen
        me.action(true);
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
                me.action(false, true);
            });
        }

    }

    /**
     * Hier wird das Elementen-Objekt eingegeben und zurück kommt ein fertiges Element, mit dem man arbeiten kann
     * Gibt ein Objekt zurück, dass je nach Werten ein- und ausblendet
     * 
     */
    normalizeToObject() {

        var me = this;

        me.log('Normalize');

        // Neue Liste erstellen
        var list = [];

        // Wenn eine Funktion angegeben wurde
        if (typeof me.list != 'function') {

            me.log('- Element List ist keine Funktion');

            // Normalisieren
            me.list = (typeof me.list == 'string' || me.list instanceof jQuery) ? [{ el: me.list }] : me.list;

            // Schleife
            $.each(me.list, function (index, value) {

                me.log('- Schleife für jedes Element');

                // Element definieren
                if (me.list.el instanceof jQuery === false) {
                    me.list[index].el = $(value.el);
                }

                // Fehler werfen wenn das Element nicht gefunden wurde
                if (!me.list[index].el.length) {
                    throw new Error("Ein Element konnten nicht gefunden werden");
                }

                // Values 
                me.list[index].values = me.list[index].values || false;
                me.list[index].reverse = me.list[index].reverse || false;
                me.list[index].child = (me.list[index].child) ? ((Array.isArray(me.list[index].child)) ? me.list[index].child : [me.list[index].child]) : false;

                // Log
                me.log('- Anzahl der Sub-Elemente >' + me.list[index].el.length + '<');

                // Feststellen ob es mehrere sind
                me.list[index].el.each(function () {

                    // Sub Element
                    var subEl = $(this);

                    // Data Attribute 
                    var values = subEl.data('values');
                    var reverse = subEl.data('reverse');

                    list.push({
                        el: subEl,
                        values: (typeof values == 'undefined') ? me.list[index].values : String(values).split(','),
                        reverse: (typeof reverse == 'undefined') ? me.list[index].reverse : reverse,
                        child: me.list[index].child
                    });
                });
            });

            // 
            me.log('- Neue Liste');
            me.log(list);

            // Element Liste überschreiben
            me.list = list;

            // 
        } else {
            me.log('- Element List ist eine Funktion');
        }
    }


    /**
     * Diese Funktion muss überschrieben werden. 
     * 
     * @return {Any} Den Wert mit dem in {@link #actionItem} geprüft werden soll
     */
    getValue() {
        throw new Error("Diese Funktion muss überschrieben werden!");
    }

    /**
     * In der Action Funkiton wird festgestellt, was ein- und ausgeblendet werden soll
     * Dabei wird eine Liste erstellt, die an die perform Funktion übergeben wird
     * 
     * @param {*} isInit Wenn das Event von Init kam
     * @param {*} isInit Wenn das Event von einem Form Event kam
     */
    action(isInit, isForm) {

        var me = this;

        me.log('Action');

        // Is Init
        isInit = isInit || false;
        isForm = isForm || false;

        // Prüfen ob die Checkbox gesetzt ist
        var value = me.getValue();

        // Wenn es sich um eine Funktion handelt
        if (typeof me.list == 'function') {

            // Wenn es sich um eine Funktion handelt
            me.list(me.el, value, isInit);

        } else {

            // Liste
            var list = [];

            // Alle Elemente durchgenen
            $.each(me.list, function (index, listItem) {

                // Ergebnis
                list.push(me.actionItem(value, listItem));

            });

            // Ein- und Ausblenden
            me.perform(list);
        }

        var hasChange = false;

        if(me.lastData != me.getValue()) {
            me.lastData = me.getValue();
            hasChange = true;
        }

        // Trigger
        me.el.trigger('callback', [value, isInit, isForm, hasChange]);
    }

    /**
     * Diese Funktion wird überschrieben und muss das folgende zurückgeben: 
     *  
     * 
     *      return {
     *          el: listItem.el,
     *          show: show
     *      };
     * 
     * @param {*} value Der Wert, der in der {@link #getValue} Funktion übergeben wird
     * @param {Object} listItem Der jeweilige List Item Wert mit den `el`, `values`, `reverese`
     * @return {Object} Ein Objekt, dass später in {@link #action} zu einem Array zusammengefasst an die Funktion {@link #perform} übergeben wird
     */
    actionItem(value, listItem) {
        throw new Error("Diese Funktion muss überschrieben werden!");
    }



    /**
     * Blendet anhand einer Liste ein- und aus
     * 
     *      var list = [
     *          {el: jQueryEl, show: true}
     *          {el: jQueryEl, show: false}
     *      ];
     *
     *  
     */
    perform(list) {

        var me = this;

        me.log('Perform');

        // Form Elements
        $.each(list, function (index, value) {

            // Ein- und Ausblenden
            if (list[index].show) {
                list[index].el.show();
            } else {
                list[index].el.hide();
            }

            // Validierung aktivieren
            if (me.form && me.form.hasValidation) {

                // Felder auslesen
                var fields = me.getFields(list[index].el);

                // Schleife durch alle Felder
                $.each(fields, function (key, name) {
                    if (list[index].show) {
                        me.form.fvInstanz.enableValidator(name);
                    } else {
                        me.form.fvInstanz.disableValidator(name);
                    }
                });
            }


            // Child Validation ausführen
            if (list[index].child && list[index].show) {
                $.each(list[index].child, function(key, child) {
                    
                    if(child instanceof ActivationCheckbox) {
                        child.action();
                    } else {
                        child.el.setChecked(child.checked);
                    }
                });
            }

        });
    }


    // Event Listner für das Element
    on(e, f) {
        var me = this;
        me.el.on(e, f);
    }

    /**
     * Diese Funktion sucht alle Input Felder in den Divs 
     * Dabei wird geprüft ob Sie zur Form gehören und von der Validierung betroffen sind!
     * 
     */
    getFields(el) {

        var me = this;

        var fields = [];

        // Ausgabe der Felder
        var formFields = me.form.getFields(true);
        var formValFields = me.form.fvInstanz.getFields();

        // Wenn es eine Klasse ist
        el.each(function () {
            var sEl = $(this);

            // Finden
            sEl.find(me.form.fields.join(',')).each(function () {

                var name = $(this).attr('name');

                // Prüfen, dass das Element auch in der Form und FormValidation ist!
                if (formFields.indexOf(name) >= 0 && typeof formValFields[name] != 'undefined') {
                    fields.push(name);
                }
            });
        });

        // Rückgabe
        return fields;
    }

    setChecked(checked, noEvent) {
        var me = this;

        noEvent = noEvent || false;

        // Status setzen
        me.el.prop('checked', checked);

        if (!noEvent) {

            // Aktion ausführen
            me.action(false, false);
        }

    }

    /**
     * Log Funktion
     * Man kann im Constructor das ganze auf Debug stellen
     * 
     * 
     * @param {Any} message Was geloggt werden soll. 
     */
    log(message) {
        var me = this;
        if (me.debug) {
            console.log(message);
        }
    }
}