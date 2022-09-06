class Quickselect {

    constructor(name, s) {

        var me = this;

        // Default
        if (name == 'default') {
            me.default = true;

            // Auf Fehler prüfen

            if (!s.selector) {
                throw "Wenn bei Quickselect Default angegeben ist, dann braucht es immer einen Selector";
            }

            if (!s.table) {
                throw "Wenn bei Quickselect Default angegbene ist, dann muss immer auch die Table definiert sein!";
            }

            if (!s.fields) {
                throw "Wenn bei Quickselect Default angegbene ist, dann muss immer auch die Fields definiert sein!";
            }

        } else {
            me.default = false;
        }


        // Container definieren
        me.name = name;
        me.container = (s.selector) ? $(s.selector) : $('select[name="' + name + '"]');
        me.defaultText = s.defaultText || 'Bitte wählen';
        me.defaultValue = s.defaultValue || '';
        me.dropdownParent = s.dropdownParent || ((me.container.closest('form').length) ? me.container.closest('form') : false);
        me.onlyId = s.onlyId || false;
        me.closeOnSelect = s.closeOnSelect;

        // Nur Werte die Bei Default benötigt werden
        me.table = s.table || false;
        me.fields = s.fields || false;
        me.primary = s.primary || false;
        me.schema = s.schema || false;

        // Angebundene Suche
        me.connectedSearch = s.connectedSearch || false;

        // Filter initalisieren
        me.filter = false;

        if (!me.container.length) {
            console.error('Der Container wurde nicht gefunden.');
        }

        me.init();
    }



    /**
     * Initalisieren
     */
    init() {

        var me = this;

        // Wenn es nicht definiert ist
        if (typeof me.closeOnSelect == 'undefined') {
            me.closeOnSelect = !me.container.prop('multiple');
        }

        me.urlForRequest = (me.default) ? 'quickselect-handle.php' : 'modules/quickselect/' + me.name + '.php';

        // Select 2 erstellen
        me.instanz = me.container.select2({
            debug: true,
            dropdownParent: me.dropdownParent,
            dropdownAutoWidth: true,
            width: '100%',
            closeOnSelect: me.closeOnSelect,
            ajax: {
                url: me.urlForRequest,
                dataType: 'json',
                data: function (params) {

                    // Filter mit übergeben
                    params.filter = me.filter;

                    // Für Default
                    params.table = me.table;
                    params.fields = me.fields;
                    params.primary = me.primary;
                    params.schema = me.schema;

                    // Rückgabe
                    return params;
                },
                success: function (data) {

                    // Nur beim Filtern den Text anpassen
                    if (me.filter) {

                        // Leider etwas unschön, aber nicht anders möglich
                        setTimeout(function () {

                            var message = (me.filter.message) ? me.filter.message : ((me.filter.name) ? 'Bitte füllen Sie zunächst ' + me.filter.name + ' aus.' : 'Dieses Feld wird von einem anderen Feld gefiltert.');

                            $('body').find('.select2-results__message').html(message);
                        }, 1);
                    }
                },
                error: function (jqXHR, a, errorThrown) {
                    if (errorThrown !== 'abort') {
                        app.alert.debugError("Fehler beim Quickselect", errorThrown, jqXHR.responseText);
                    }
                }
            },
            language: 'de',

            // Sorgt dafür das der Content als HTML interpretiert wird!
            escapeMarkup: function (markup) {
                return markup;
            },
        });



        // Bitte wählen anhängen
        var chooseOption = new Option(me.defaultText, me.defaultValue, false, false);

        // Hinzufügen
        me.container.append(chooseOption).trigger('change');

        // Event Listner hinzufügen
        me.addEventListner();

        // Init qs-button
        me.initQsButtons();
    }

    initQsButtons() {

        var me = this;

        var parent = me.container.closest('.qs-buttons');

        // Wenn es QS-Buttons gibt
        if (parent.length) {

            // Finde jeden Action Buttons
            parent.find('[data-action]').each(function () {

                $(this).on('click', function () {

                    var el = $(this);
                    var action = el.data('action');
                    var validate = el.data('validate');
                    var value = me.val();

                    // QS-Buttons validieren
                    me.validateQsButtons(validate, value, function (isValid, value) {

                        // Wenn es Valide ist
                        if (isValid) {

                            // Action
                            me.container.trigger('action', [action, value, el, me]);
                        }
                    });
                });
            });
        }
    }

    validateQsButtons(validate, value, callback) {

        var me = this;

        if (validate) {

            var isValid = false;

            switch (validate) {
                case 'filled':

                    // Wenn ein Wert vorhanden ist
                    if (value && (Array.isArray(value) == false || (Array.isArray(value) && value.length > 0))) {
                        isValid = true;
                    } else {
                        app.notify.error.fire("Fehler", "Bitte tragen Sie eine Wert ein!");
                    }

                    break;

                case 'notfilled':
                    if (value && (Array.isArray(value) == false || (Array.isArray(value) && value.length > 0))) {
                        app.notify.error.fire("Fehler", "Bitte löschen Sie zunächst alle Werte!");
                    } else {
                        isValid = true;
                    }

                    break;

                case 'single':

                    // Wenn es mindestens einen Wert gibt 
                    if (value && (Array.isArray(value) == false || (Array.isArray(value) && value.length > 0))) {

                        // Wenn es mehr als einen Wert gibt
                        if (Array.isArray(value) && value.length > 1) {

                            me.getChooseHtml(value, function (html) {

                                // Ergebnis
                                var result = false;

                                app.alert.question.fire({
                                    title: "Bitte wählen Sie eine der Optionen",
                                    html: html,
                                    preConfirm: function () {
                                        result = $('body').find('.swal-quickselect-auswahl-radio:checked').val();
                                    }
                                }).then(function (response) {

                                    // Wenn es Ok ist, dann noch den Wert auslesen
                                    if (response.isConfirmed) {
                                        callback(true, result);
                                    }
                                });
                            });

                            // Sorgt dafür, dass noch keine Action getriggert wird
                            isValid = false;

                            // wenn es nur einen Wert gibt
                        } else {
                            isValid = true;
                        }

                        // Wenn es keinen Wert gibt
                    } else {
                        app.notify.error.fire("Fehler", "Bitte tragen Sie eine Wert ein!");
                    }

                    break;

                case 'multiple':

                    if (value && Array.isArray(value) && value.length > 1) {
                        isValid = true;
                    } else {
                        app.notify.error.fire("Fehler", "Bitte tragen Sie mehr als einen Wert ein!");
                    }

                    break;

                default:
                    isValid = true
                    break;
            }

            callback(isValid, value);

            // Wenn es nichts zu validieren gibt!
        } else {
            callback(true);
        }
    }


    getChooseHtml(value, callback) {

        var me = this;

        $.ajax({
            type: 'POST',
            url: me.urlForRequest,
            dataType: 'json',
            success: function (data) {

                // HTML Grundgerüst bauen
                var html = "<div style='text-align:left;padding: 5px;'>";

                // Ergebnis
                var result = {};

                // Schleife durch alle 
                $.each(data.results, function (respIndex, respData) {

                    // Index auslesen
                    var idx = value.indexOf(respData.id);

                    // Index in das Objekt schreiben
                    if (idx >= 0) {
                        result[idx] = respData;
                    }
                });


                // Ergebnisse durchgehen
                $.each(result, function (index, subvalue) {

                    // HTML Generieren
                    html += '' +
                        '<div class="form-radio">' +
                        '<input type="radio" class="form-check-input swal-quickselect-auswahl-radio" id="auswahl-' + subvalue.id + '" name="auswahl" value="' + subvalue.id + '" ' + ((index == 0) ? 'checked' : '') + ' />' +
                        '<label class="form-check-label" for="auswahl-' + subvalue.id + '">&nbsp;&nbsp;' + subvalue.text + '</label>' +
                        '</div>';
                });

                html += "</div>";

                callback(html);
            },
            error: function (jqXHR, a, errorThrown) {
                console.log('-- Fehler');
            }

        });
    }


    on(event, cb) {
        var me = this;
        me.container.on(event, cb);
    }

    // Quickselect Daten setzen
    setData(value, text) {

        var me = this;

        // Daten sezten
        me.setDataNoTrigger(value, text, function (hasChange) {
            
            // triggern
            if (hasChange) {
                me.container.trigger('change');
            }
        });


    }

    setDataNoTrigger(value, text, cb) {

        var me = this;

        var doAppend = true;

        // 
        text = text || false;
        cb = cb || false;

        // Text nachladen
        if (!text) {

            // Wird geladen
            me.setDataNoTrigger(value, "wird geladen...");

            // Lädt den Text nach
            me.loadText(value, function(text) {
                me.setDataNoTrigger(value, text, cb);
            });

        } else {

            // Man kann theoretisch Skriptgesteuert einen Wert zweimal setzen, z.B. wenn sich nur der Text ändern. 
            // Das funktioniert allesdings nur bei Multiple. Deshalb sucht man hier und prüft ob die ID schon verhanden ist
            // falls ja, ersetzt man nur den Text, falls nein, wird das ganz normale Append angesteuert
            if (me.container.prop('multiple')) {

                // Prüfen ob der Wert nicht schon vorhanden ist!
                me.container.next('.select2.select2-container').find('.select2-selection__choice').each(function () {

                    var el = $(this).find('.select2-selection__choice__display');

                    // Dispaly ID
                    var displayId = el.attr('id');

                    // Abschneiden der ID
                    var elId = displayId.split(/container-choice-.{4}-/g)[1];

                    // Löschen des containers
                    if (value == elId) {
                        el.html(text);
                        doAppend = false;
                    }
                });
            }

            if (doAppend) {
                me.container.append(new Option(text, value, true, true))
            }

            if(typeof cb == 'function') {
                cb(doAppend);
            }
           
        }
    }

    loadText(value, cb) {

        var me = this;

        // Ajax Request
        $.ajax({
            type: 'GET',
            url: me.urlForRequest,
            dataType: 'json',
            data: {
                filter: me.filter,
                table: me.table,
                fields: me.fields,
                primary: me.primary,
                schema: me.schema,
                
                // Resolve
                resolveId: value
            },
            success: function (data) {
                cb(data.results[0].text);
            },
            error: function () {
                console.log("Error");
            }
        });
    }

    val() {
        var me = this;
        return me.container.val();
    }

    // Reset durchführen
    reset(noTrigger) {
        var me = this;

        noTrigger = noTrigger || false;

        // Wenn es Multiple ist
        if (me.container.prop('multiple')) {

            // Wenn es kein Multiple ist
            me.container.val(null).empty();

        } else {
            // No Trigger
            if (noTrigger) {

                // Default Daten ohne Trigger
                me.setDataNoTrigger(me.defaultValue, me.defaultText);

            } else {

                // Default Daten setzen
                me.setData(me.defaultValue, me.defaultText);
            }
        }
    }


    addEventListner() {

        var me = this;

        if (me.onlyId) {
            me.on('change', function () {
                var value = me.val();
                me.setDataNoTrigger(value, value);
            });
        }

        // Press Button
        hotkeys('f5', function (event, handler) {

            // Prüfen ob es geöffnet ist
            var findOpen = me.container.parent().find('.select2-container--open');

            if (findOpen.length && me.connectedSearch) {
                event.preventDefault();
                me.connectedSearch.open();
            }
        });

    }


    // Link
    link(otherList, field, name) {

        var me = this;

        // Wenn ich mich welchsel muss in der anderen Liste etwas passieren!
        me.on('change', function () {

            // Filter setzen!
            otherList.setFilter(field, me.container.val(), name);

        });

        // In der anderen Liste einen Filter setzen
        otherList.setFilter(field, "", name);

    }

    // Setzt einen Filter
    setFilter(field, value, name, message) {

        var me = this;

        name = name || false;

        // Nur zurücksetzen, wenn es auch einen Wert gibt
        if (me.container.val()) {

            // Clear Value
            me.reset();
        }

        // Filter setzen
        me.filter = {
            field: field,
            name: name,
            value: value,
            message: message
        };
    }

    // Filter löschen
    clearFilter() {
        var me = this;
        me.filter = false;
    }


}