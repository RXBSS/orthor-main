/**
 * Kalkulationsverbund
 * 
 * 
 * 
 * 
 */
var Kalkulationsverbund = class {


    constructor(container, form) {


        var me = this;

        // Init
        container = container || false;
        me.form = form || false;

        if (!container) {
            throw "Es muss ein Container angeben werden";
        }

        if (container instanceof $) {
            me.container = container;
        } else {
            me.container = $(container);
        }

        if (!me.container.length) {
            throw "Der Container wurde nicht gefunden!";
        }

        me.result = {};

        // All Fields
        me.fields = {

            menge: {},
            richtung: {
                value: 'ektovk'
            },

            // EK
            ek: {},
            ek_gesamt: {},

            // VK
            vk: {},
            vk_inkl_rabatt: {},

            // Rabatt
            rabatt_aktiv: {},
            rabatt_prozent: {},
            rabatt_wert: {},

            netto_gesamt: {},
            netto_inkl_rabatt_gesamt: {},
            rabatt_wert_gesamt: {},

            // Steuern 
            steuer_satz: {},
            steuer_wert: {},
            steuer_wert_inkl_rabatt: {},
            steuer_wert_gesamt: {},
            steuer_wert_inkl_rabatt_gesamt: {},
            brutto: {},
            brutto_inkl_rabatt: {},
            brutto_gesamt: {},
            brutto_inkl_rabatt_gesamt: {},

            marge: {},
            marge_gesamt: {},
            marge_prozent: {},
            marge_wert_inkl_rabatt: {},
            marge_prozent_inkl_rabatt: {},
            marge_inkl_rabatt_gesamt: {},

        };

        // Wenn es eine Form gibt
        if (me.form) {
            me.form.on('load', function () {
                me.reInit();
            });
        }

        // Initalisieren
        me.initalize();
    }

    initalize() {

        var me = this;

        $.each(me.fields, function (index, field) {
            if (!field.value) {
                me.fields[index].value = 0;
            }
        });

        // History Löschen
        me.clearHistory();

        // Alle Felder einlesen
        me.readFields();

        // Felder Werte einlesen
        me.readFieldValues();

        // Formatieren aller Werte
        me.formatOnly();
    }

    /**
     * Initalisiert neu?
     */
    reInit() {
        var me = this;

        $.each(me.fields, function (index, field) {
            if (!field.value) {
                me.fields[index].value = 0;
            }
        });

        // History Löschen
        me.clearHistory();

        // Felder Werte einlesen
        me.readFieldValues();

        // Formatieren aller Werte
        me.formatOnly();

        // Marge 
        me.calc_marge_from_ekvk(me, history);

        // Calculieren
        me.calc_steuer_satz(me, history);

        // Schreiben
        me.write();

    }


    // Read Field Values
    readFieldValues() {

        var me = this;

        // Schleife durch alle Felder
        $.each(me.fields, function (index, value) {
            if (me.fields[index].selector) {
                me.fields[index].value = me.getValue(index);
            }
        });



    }

    // Alle Felder einlesen
    readFields() {

        var me = this;

        me.container.find('input').each(function () {

            var el = $(this);

            if (el.data('role')) {

                var role = el.data('role');

                // Rolle festlegen
                me.fields[role] = {
                    selector: el
                };

                if (el.attr('type') == 'text') {

                    // On Focus Out Event
                    el.on('focusout', function () {
                        me.triggerElement(role, 'input');
                    });

                } else if (el.attr('type') == 'checkbox' || el.attr('type') == 'radio') {

                    el.on('change', function () {
                        me.triggerElement(role, 'checkbox');
                    });

                }
            }
        });

        // 
        me.container.find('[data-role=richtung]').on('click', function () {

            if (me.fields.richtung.value == 'ektovk') {
                me.fields.richtung.value = 'vktoek';
                $(this).removeClass('bg-secondary').addClass('bg-info').html('VK <i class="fa-solid fa-angle-right"></i> EK');
            } else {
                me.fields.richtung.value = 'ektovk';
                $(this).removeClass('bg-info').addClass('bg-secondary').html('EK <i class="fa-solid fa-angle-right"></i> VK');

            }
        });

    }


    triggerElement(role, type) {

        var me = this;

        me.calculate(role);
    }

    // Berechnen 
    calculate(role) {

        var me = this;

        me.result = {};

        // Feld Werte einlesen
        me.readFieldValues();

        // Historie auslesen
        var history = me.getHistory('marge');

        // Normalisieren
        me.result[role] = me.fields[role].value;

        if (typeof me['calc_' + role] == 'function') {
            me['calc_' + role](me, history);
        }

        // Schreiben
        me.write();
    }


    // MARK: Berechnungen

    /**
     * Calc Funktionen
     */

    calc_vk(me, history) {

        // Wenn der EK definiert ist
        if (me.fields['ek'].value) {

            me.set('marge', me.fields['vk'].value - me.fields['ek'].value);
            me.set('marge_prozent', me.prozentVonWerten(me.fields['ek'].value, me.fields['vk'].value, true));
        }

        me.set('brutto', me.fields['vk'].value * me.prozentZuFaktor(me.fields['steuer_satz'].value));
        me.set('steuer_wert', me.fields['brutto'].value - me.fields['vk'].value);

        if (me.fields['rabatt_aktiv'].value) {

            me.set('vk_inkl_rabatt', me.fields['vk'].value - me.fields['rabatt_wert'].value);
            me.set('rabatt_prozent', me.prozentVonWerten(me.fields['rabatt_wert'].value, me.fields['vk'].value));

            // Wenn der EK gesetzt ist
            if (me.fields['ek'].value) {
                me.set('marge_wert_inkl_rabatt', me.fields['vk_inkl_rabatt'].value - me.fields['ek'].value);
                me.set('marge_prozent_inkl_rabatt', me.prozentVonWerten(me.fields['ek'].value, me.fields['vk_inkl_rabatt'].value, true));
            }
        }

        // Menge Berechnen
        me.calc_menge(me, history);

    }

    calc_ek(me, history) {


        if (me.fields['vk'].value) {

            me.set('marge', me.fields['vk'].value - me.fields['ek'].value);
            me.set('marge_prozent', me.prozentVonWerten(me.fields['ek'].value, me.fields['vk'].value, true));


            if (me.fields['rabatt_aktiv'].value) {
                me.set('marge_wert_inkl_rabatt', me.fields['vk_inkl_rabatt'].value - me.fields['ek'].value);
                me.set('marge_prozent_inkl_rabatt', me.prozentVonWerten(me.fields['ek'].value, me.fields['vk_inkl_rabatt'].value, true));
            }
        }

        me.calc_menge(me, history);
    }

    // Marge
    calc_marge(me, history) {


        // Wenn der EK defniert ist
        if (me.fields['richtung'].value == 'ektovk') {
            me.set('vk', me.fields['ek'].value + me.fields['marge'].value);
            me.set('marge_prozent', me.prozentVonWerten(me.fields['ek'].value, me.fields['vk'].value, true));
        }

        if (me.fields['richtung'].value == 'vktoek') {
            me.set('ek', me.fields['vk'].value - me.fields['marge'].value);
            me.set('marge_prozent', me.prozentVonWerten(me.fields['ek'].value, me.fields['vk'].value, true));
        }

    }

    calc_marge_from_ekvk(me, history) {

        if (me.fields['ek'].value && me.fields['vk'].value) {
            me.set('marge_prozent', me.prozentVonWerten(me.fields['ek'].value, me.fields['vk'].value, true));
            me.set('marge', me.fields['vk'].value - me.fields['ek'].value);
        }
    }


    calc_marge_prozent(me, history) {

        // Wenn der EK defniert ist
        if (me.fields['ek'].value) {

            // Marge Prozent errechnens
            var margeProzent = me.prozentZuFaktor(me.fields['marge_prozent'].value);

            me.set('vk', (margeProzent == 0) ? me.fields['ek'].value : me.fields['ek'].value * margeProzent);
            me.set('marge', me.fields['vk'].value - me.fields['ek'].value);
        }
    }

    calc_steuer_satz(me, history) {

        if (me.fields['vk'].value) {
            me.set('brutto', me.fields['vk'].value * me.prozentZuFaktor(me.fields['steuer_satz'].value));
            me.set('steuer_wert', me.fields['brutto'].value - me.fields['vk'].value);
        }

        if (me.fields['vk_inkl_rabatt'].value) {
            me.set('brutto_inkl_rabatt', me.fields['vk_inkl_rabatt'].value * me.prozentZuFaktor(me.fields['steuer_satz'].value));
            me.set('steuer_wert_inkl_rabatt', me.fields['brutto_inkl_rabatt'].value - me.fields['vk'].value);
        }


        me.calc_menge(me, history);
    }


    calc_rabatt_wert(me, history) {

        if (me.fields['rabatt_aktiv'].value && me.fields['vk'].value) {

            me.set('vk_inkl_rabatt', me.fields['vk'].value - me.fields['rabatt_wert'].value);
            me.set('rabatt_prozent', me.prozentVonWerten(me.fields['vk'].value, me.fields['rabatt_wert'].value));

            // Wenn der EK gesetzt ist
            if (me.fields['ek'].value) {

                me.set('marge_wert_inkl_rabatt', me.fields['vk_inkl_rabatt'].value - me.fields['ek'].value);
                me.set('marge_prozent_inkl_rabatt', me.prozentVonWerten(me.fields['ek'].value, me.fields['vk_inkl_rabatt'].value, true));
            }

            me.calc_menge(me, history);
        }

    }

    calc_rabatt_prozent(me, history) {

        console.log('-- Calc Rabatt Prozent');

        if (me.fields['rabatt_aktiv'].value) {

            me.set('vk_inkl_rabatt', me.fields['vk'].value - (me.fields['vk'].value * me.prozentZuFaktor(me.fields['rabatt_prozent'].value, false) - me.fields['rabatt_wert'].value));
            me.set('rabatt_wert', me.fields['vk'].value - me.fields['vk_inkl_rabatt'].value);


            // Wenn der EK gesetzt ist
            if (me.fields['ek'].value) {

                me.set('marge_wert_inkl_rabatt', me.fields['vk_inkl_rabatt'].value - me.fields['ek'].value);
                me.set('marge_prozent_inkl_rabatt', me.prozentVonWerten(me.fields['ek'].value, me.fields['vk_inkl_rabatt'].value, true));
            }
        }
    }

    calc_rabatt_aktiv(me, history) {

        if (!me.fields['rabatt_aktiv'].value) {

            me.set('marge_wert_inkl_rabatt', me.fields['marge'].value);
            me.set('marge_prozent_inkl_rabatt', me.fields['marge_prozent'].value);

        } else {

            me.set('rabatt_prozent', 0);
            me.set('rabatt_wert', 0);

            // Wenn der EK gesetzt ist
            if (me.fields['ek'].value && me.fields['vk'].value) {
                me.set('vk_inkl_rabatt', me.fields['vk'].value);
                me.set('marge_wert_inkl_rabatt', me.fields['vk_inkl_rabatt'].value - me.fields['ek'].value);
                me.set('marge_prozent_inkl_rabatt', me.prozentVonWerten(me.fields['ek'].value, me.fields['vk_inkl_rabatt'].value, true));
            }


        }
    }

    calc_marge_prozent_inkl_rabatt(me, history) {

    }

    calc_marge_wert_inkl_rabatt(me, history) {

        // Wenn der EK defniert ist
        if (me.fields['ek'].value) {
            me.set('vk_inkl_rabatt', me.fields['ek'].value + me.fields['marge'].value);
            me.set('marge_prozent', me.prozentVonWerten(me.fields['ek'].value, me.fields['vk_inkl_rabatt'].value, true));
        }
    }

    calc_richtung(me, history) {
        // console.log(me);
    }


    /**
    * Menge berechnen
    */
    calc_menge(me, history) {

        var menge = (me.fields['menge'].value) ? me.fields['menge'].value : 1;

        me.set('ek_gesamt', menge * me.fields['ek'].value);
        me.set('netto_gesamt', menge * me.fields['vk'].value);
        me.set('marge_gesamt', menge * me.fields['marge'].value);
        me.set('steuer_wert_gesamt', menge * me.fields['steuer_wert'].value);
        me.set('brutto_gesamt', menge * me.fields['brutto'].value);

        if (me.fields['marge_wert_inkl_rabatt'].value) {
            me.set('rabatt_wert_gesamt', menge * me.fields['rabatt_wert'].value);
            me.set('marge_inkl_rabatt_gesamt', menge * me.fields['marge_wert_inkl_rabatt'].value);
            me.set('netto_inkl_rabatt_gesamt', menge * me.fields['vk_inkl_rabatt'].value);
            me.set('steuer_wert_inkl_rabatt_gesamt', menge * me.fields['steuer_wert_inkl_rabatt'].value);
            me.set('brutto_inkl_rabatt_gesamt', menge * me.fields['brutto_inkl_rabatt'].value);
        }
    }


    set(role, value) {
        var me = this;

        // Direkt in das Objekt schreiben, damit weitergerechnet werden kann
        me.fields[role].value = value;

        // In das Result Objekt schreiben
        me.result[role] = value;

    }


    /**
     * Mengen Berechnet
     */
    calculateMenge() {

        var me = this;

        var menge = me.getValue('menge');
        var vk = me.getValue('vk');

        // Ergebnis
        me.result['netto_gesamt'] = menge * vk;
    }


    // MARK: Helper


    write() {

        var me = this;

        // Schleife durch alle Felder
        $.each(me.result, function (index, value) {

            // 
            if (me.fields[index].selector) {
                if (index.includes('menge')) {
                    me.fields[index].selector.val(app.formatter.formatAutoFloat(value, 0, 0));
                } else if (index.includes('rabatt_aktiv')) {
                    me.fields[index].selector.prop('checked', value);
                } else if (index.includes('prozent')) {
                    me.fields[index].selector.val(app.formatter.formatAutoFloat(value, 0, 1));
                } else {
                    me.fields[index].selector.val(app.formatter.formatAutoFloat(value, 2, 2));
                }
            }

            // Wert im Objekt hinterlegen

            me.fields[index].value = value;


        });

        // Tritter Event
        me.container.trigger('change');

    }

    /**
     * Nur die gefüllten Felder formatieren
     */
    formatOnly() {

        var me = this;

        // Schleife
        $.each(me.fields, function (index, data) {

            if (me.fields[index].selector) {

                // Wenn es eine Menge ist
                if (index.includes('menge')) {
                    me.fields[index].selector.val(app.formatter.formatAutoFloat(data.value, 0, 0));
                } else if (index.includes('rabatt_aktiv')) {
                    me.fields[index].selector.prop('checked', data.value);
                } else if (index.includes('prozent')) {
                    me.fields[index].selector.val(app.formatter.formatAutoFloat(data.value, 0, 1));
                } else {
                    me.fields[index].selector.val(app.formatter.formatAutoFloat(data.value, 2, 2));
                }
            }
        });
    }

    getValue(name) {

        var me = this;

        var value = 0;

        if (name == 'richtung') {

            value = me.container.find('input[data-role=' + name + ']:checked').val();

        } else if (name == 'rabatt_aktiv') {

            value = me.fields[name].selector.prop('checked');

        } else if (me.hasVal(name)) {

            // Zahl auslesen und Parsen
            value = app.formatter.formatJsFloat(String(me.fields[name].selector.val()).trim());
        }

        // Rückgabe
        return value;
    }

    /**
    * Prüft ob ein Wert eingetragen ist
    * Dabei zählt 0 auch als Wert
    * 
    */
    hasVal(name) {

        var me = this;
        var result = false;

        if (me.fields[name]) {

            // Wert auslesen
            var value = String(me.fields[name].selector.val()).trim();

            // Wert parsen
            if (value !== '') {
                result = true;
            }
        }

        // Wert prüfen
        return result;
    }


    /**
     * Historie auslesen
     * @param {String} [name=false] Der Name des Feldes vom dem die Historie angesteuert wurde!
     */
    getHistory(area, name) {

        name = name || false;

        var me = this;

        // Ergebnis initiern
        var result = false

        // Wenn es überhaupt eine Historie gibt
        if (me.history[area].length > 0) {

            // Historie in ein separates Objekt überführen
            var tempHistory = me.history[area];

            // Array als Reverse ausgeben
            tempHistory.reverse();

            // Durch die Historie loopen
            for (var i = 0; i < tempHistory.length; i++) {

                // Wenn eine Historie gefunden wurde die nicht der gleiche Wert ist
                if (tempHistory[i] != name) {
                    result = tempHistory[i];
                    break;
                }
            }

        }

        // Ergebnis zurückgeben
        return result;
    }


    /**
     * Write History
     */
    writeHistory(area, name) {
        var me = this;

        me.history[area].push(name);
    }

    /**
     * Clear History
     */

    clearHistory() {
        var me = this;

        // 
        me.history = {
            marge: [],
            rabatt: []
        };
    }

    /**
     * Prozent zu Faktor
     * @param {Number} wert Der Wert als Prozent
     * @param {Boolean} add Faktor addieren oder abziehen 
     * 
     * wert = 20 %
     */
    prozentZuFaktor(wert, add = true) {

        var me = this;

        // Faktor zu addieren
        if (add) {

            // Faktor errechnen 
            var faktor = (wert > 0) ? wert / 100 + 1 : 0;

            // Faktor zum abziehen?
        } else {
            var faktor = (wert > 0) ? wert / 100 : 0;
        }

        // Rückgabe des Faktors
        return faktor;
    }

    /**
     * Prozent von Werten errechen
     * 
     * @param {Number} grundwert Der erste Wert
     * @param {Number} prozentwert Der zweite Wert
     * @param {Number} lower Wenn der Wert angegeben ist, werden 100 abgezogen
     * @returns {Number} Das Ergebnis als Prozent Wert
     * 
     */
    prozentVonWerten(grundwert, prozentwert, lower) {

        lower = lower || false;

        // Rechnen
        var prozent = (prozentwert > 0 && grundwert > 0) ? (prozentwert * 100) / grundwert : 0;

        if (lower) {
            prozent = prozent - 100;
        }

        return prozent;
    }

    on(event, cb) {
        var me = this;
        me.container.on(event, cb);
    }


}