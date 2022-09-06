/**
 * In dieser Datei werden die kompletten Filter Layouts abgespeichert, da es sonst für die Klasse zu groß wäre
 * 
 * 
 * 
 */

var picklistFilterHtml = {

    debounceInput: false,

    // Rückgabe
    getFilterFormat(value) {
        return (value.filter === true) ? ((value.format) ? value.format : "text") : ((value.filter.type) ? value.filter.type : "text");
    },


    // Filter
    getFilterHtml(list, key, value) {

        // Me
        var me = this;

        // Wenn keine Formatierung angebgen wurden
        var filterFormat = me.getFilterFormat(value);

        // HTML initalisieren
        var html = "";

        // Filter anhand des Formats zuweisen
        switch (filterFormat) {

            case "text":
                html = me.getTextFilter(key, value);
                break;

            case "yes-no":
                html = me.getYesNoFilter(key, value);
                break;

            case "betrag":
                html = me.getBetragFilter(key, value);
                break;

            case "quickselect":
                html = me.getQuickselectFilter(key, value);
                break;



        }


        // Rückgabe
        return html;
    },


    /**
     * Text Filter
     */
    getTextFilter(key, value) {

        var html = '' +
            '<div class="col-lg-3 col-md-6 mb-2">' +
            '<div class="form-group form-gray">' + 
            '<label class="form-label">' + value.title + '</label>' +
            '<div class="input-group mb-3">' +
            '<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">.*</button>' +
            '<ul class="dropdown-menu dropdown-menu-dark dropdown-filter-menu">' +
            '<li><a class="dropdown-item active" data-symbol=".*" href="javascript:void(0);">Beginnt mit</a></li>' +
            '<li><a class="dropdown-item" data-symbol="*." href="javascript:void(0);">Endet mit</a></li>' +
            '<li><a class="dropdown-item" data-symbol="*" href="javascript:void(0);">Enthält</a></li>' +
            '<li><a class="dropdown-item" data-symbol="=" href="javascript:void(0);">Ist Gleich</a></li>' +
            '<li><a class="dropdown-item" data-symbol="!=" href="javascript:void(0);">Ist Nicht Gleich</a></li>' +
            '<li><a class="dropdown-item" data-symbol="*;*" href="javascript:void(0);">Einer Von</a></li>' +
            '<li><hr class="dropdown-divider"></li>' +
            '<li><a class="dropdown-item" data-symbol="!" href="javascript:void(0);">Ist Leer</a></li>' +
            '</ul>' +
            '<input type="text" name="' + key + '"  data-symbol=".*" data-index="' + value.index + '" class="form-control input-filter-check" placeholder="Beginnt mit">' +
            '</div>' +
            '</div>' +
            '</div>';

        return html;
    },

    /**
     * Ja/Nein Filter
     */
    getYesNoFilter(key, value) {

        // Format Config 
        var formatConfig = value['format-config'] || false;

        // Ja und Nein Definieren
        var yes = (formatConfig && formatConfig[0]) ? formatConfig[0] : "Ja";
        var no = (formatConfig && formatConfig[1]) ? formatConfig[1] : "Nein";

        // HTML generieren
        var html = '' +
            '<div class="col-lg-2 col-md-6 mb-2">' +
            '<div class="form-group form-gray">' + 
            '<label class="form-label">' + value.title + '</label><br>' +
            '<div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">' +
            '<input type="checkbox" class="btn-check btn-filter-check" data-button="1" name="' + key + '-1" id="btn-filter-check-' + key + '-1" autocomplete="off" value="1">' +
            '<label class="btn btn-outline-secondary" for="btn-filter-check-' + key + '-1">' + yes + '</label>' +
            '<input type="checkbox" class="btn-check btn-filter-check" data-button="2" name="' + key + '-2" id="btn-filter-check-' + key + '-2" autocomplete="off" value="2">' +
            '<label class="btn btn-outline-secondary" for="btn-filter-check-' + key + '-2">' + no + '</label>' +
            '</div>' +
            '</div>' +
            '</div>';

        // Rückgabe
        return html;
    },

    /**
    * Ja/Nein Filter
    */
    getBetragFilter(key, value) {

        var html = '' +
            '<div class="col-lg-3 col-md-6 mb-2">' +
            '<div class="form-group form-gray">' + 
            '<label class="form-label">' + value.title + '</label>' +
            '<div class="input-group mb-3">' +
            '<button class="btn btn-secondary  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">.*</button>' +
            '<ul class="dropdown-menu dropdown-menu-dark dropdown-filter-menu">' +
            '<li><a class="dropdown-item active" data-symbol=".*" href="javascript:void(0);">Beginnt mit</a></li>' +
            '<li><a class="dropdown-item" data-symbol="*." href="javascript:void(0);">Endet mit</a></li>' +
            '<li><a class="dropdown-item" data-symbol="*" href="javascript:void(0);">Enthält</a></li>' +
            '<li><a class="dropdown-item" data-symbol="=" href="javascript:void(0);">Ist Gleich</a></li>' +
            '<li><a class="dropdown-item" data-symbol="!=" href="javascript:void(0);">Ist Nicht Gleich</a></li>' +
            '<li><a class="dropdown-item" data-symbol="*;*" href="javascript:void(0);">Einer Von</a></li>' +
            '<li><hr class="dropdown-divider"></li>' +
            '<li><a class="dropdown-item" data-symbol=">" href="javascript:void(0);">Größer als</a></li>' +
            '<li><a class="dropdown-item" data-symbol="<" href="javascript:void(0);">Kleiner als</a></li>' +
            '<li><a class="dropdown-item" data-symbol=">=" href="javascript:void(0);">Größer gleich</a></li>' +
            '<li><a class="dropdown-item" data-symbol="<=" href="javascript:void(0);">Kleiner gleich</a></li>' +
            '<li><hr class="dropdown-divider"></li>' +
            '<li><a class="dropdown-item" data-symbol="!" href="javascript:void(0);">Ist Leer</a></li>' +
            '</ul>' +
            '<input type="text" name="' + key + '" data-symbol=".*" data-index="' + value.index + '" class="form-control input-filter-check" placeholder="Beginnt mit">' +
            '</div>' +
            '</div>' +
            '</div>';

        // Rückgabe
        return html;
    },

    /**
     * Quickselect Filter!
     */
    getQuickselectFilter(key, value, index) {

        // Der Quickselect Filter!
        var html = '' +
            '<div class="col-lg-3 col-md-6 mb-2">' +
            '<div class="form-group form-gray form-floating">' +
            '<select class="form-select init-quickselect editable" id="quickselect-' + key + '" name="' + key + '" data-qs-name="' + value.filter['qs-name'] + '" placeholder="' + value.title + '">' +
            '<option value="">bitte wählen</option>' +
            '</select>' +
            '<label>' + value.title + '</label>' +
            '</div>' +
            '</div>';



        return html;

    },


    initForm(list) {

        // Container
        var formContainer = $('body').find('#form-' + list.id);


        if (formContainer.length) {

            // 
            list.filterForm = new Form(formContainer);
        }
    },


    /**
     * Event Listner hinzufügen
     */
    addListener(list) {

        var me = this;

        // Event Listner
        list.container.on('click', '.dropdown-filter-menu .dropdown-item', function () {
            me.onDropdownChange(list, $(this));
        });

        // Checkbox
        list.container.on('click', '.btn-filter-check', function () {
            me.onCheckboxClick(list, $(this));
        });

        // Container
        list.container.on('keyup input', '.input-filter-check', function () {
            me.onTextInput(list, $(this));
        });

        $.each(list.filterForm.qs, function (index, qs) {
            qs.on('change', function () {
                me.applyFilter(list);
            });
        });
    },


    /**
     * Wenn das Dropdown geändert wird!
     * 
     */
    onDropdownChange(list, el) {

        var me = this;

        var symbol = el.data('symbol');
        var text = el.text();

        el.closest('.dropdown-menu').find('.dropdown-item').removeClass('active');
        el.addClass('active');

        // Symbol in den Button und das Input Feld schreiben
        el.closest('.input-group').find('button').html(symbol);
        el.closest('.input-group').find('input').data('symbol', symbol).attr('placeholder', text);

        // Nur sezten, wenn es einen Wert gibt
        if (el.closest('.input-group').find('input').val()) {

            // Filter hinzufügen
            me.applyFilter(list);
        }
    },

    /**
     * 
     */
    onCheckboxClick(list, el) {

        var me = this;

        var otherEl = el.closest('.btn-group').find('.btn-filter-check[data-button="' + ((el.data('button') == 1) ? 2 : 1) + '"]');

        // Wenn beide gecheckt wäre
        if (el.prop('checked') && otherEl.prop('checked')) {
            otherEl.prop('checked', false);
        }



        // Filter hinzufügen
        me.applyFilter(list);
    },

    // Text Input
    onTextInput(list, el) {

        var me = this;

        clearTimeout(me.debounceInput);

        me.debounceInput = setTimeout(function () {

            // Apply
            me.applyFilter(list);

        }, 300);
    },


    // Apply Filter
    applyFilter(list) {

        var me = this;


        // Formdaten
        var formData = list.filterForm.getData();

        // Ergebnisse
        var resultArray = [];

        // Schliefe laufen lassen
        $.each(list.settings.fields, function (key, value) {

            // 
            result = false;

            // Wenn es ein Filter-Wert ist
            if (value.filter) {

                // Wenn keine Formatierung angebgen wurden
                var filterFormat = me.getFilterFormat(value);

                // Filter anhand des Formats zuweisen
                switch (filterFormat) {

                    case "text":
                        result = me.applyText(list, formData, key, value);
                        break;

                    case "yes-no":
                        result = me.applyYesNo(formData, key, value);
                        break;

                    case "betrag":
                        result = me.applyBetrag(list, formData, key, value);
                        break;

                    case "quickselect":
                        result = me.applyQuickselect(formData, key, value);
                        break;

                }

                // Wenn es ein Ergebnis gibt!
                if (result) {
                    resultArray.push(result);
                }
            }
        });

        // Ansonsten nichts tun!
        if (resultArray.length > 0) {

            // ********************************************************************************
            // Die einzelnen Apply Funktionen können drei Werte zurückgeben:
            // `false`, `true` oder ein Picklist Filter
            // Bei `false` passiert nicht
            // Bei `true` wurde ein Button geklickt und ein Filter geändert, aber ohne Wert
            // Bei einem Filter Objekt wird das ganze Filter Objekt übergeben
            // 
            // Für den Fall, dass nur true zurückgegeben wurde muss der Filter resettet werden. 
            // Sobald ein Picklist Objekt dabei ist, ist dies nicht mehr der Fall
            // ********************************************************************************

            var plainFilters = [];

            // OnlyTrue
            var onlyTrue = true;

            $.each(resultArray, function (key, value) {
                if (value !== true) {
                    plainFilters.push(value);
                    onlyTrue = false;
                }
            });


            // Filter zurücksetzen
            if (onlyTrue) {

                // Mit Soft Reset
                list.resetFilter(true);

                // Filter durchführen
            } else {


                // Liste
                list.setFilter(new PickFilter(plainFilters, "AND"), true);
            }
        }

    },

    getElement(list, key) {
        var me = this;
        var el = list.container.find('.dt-filter input[name="' + key + '"]');
        return el;
    },

    /**
     * Liest das entsprechende Symbol neben dem Input aus
     */
    getElementSymbol(list, key) {
        var me = this;
        var el = me.getElement(list, key);
        return el.data('symbol').replace("*;*", "in");

    },

    applyText(list, formData, key, value) {

        var me = this;
        var result = true;


        var symbol = me.getElementSymbol(list, key);

        // TODO: Spezielle Anhabung der Symbole IS NULL, ....

        // Wenn Daten vorhanden sind
        if (formData[key]) {

            var inputValue = formData[key];

            if (symbol == 'in') {
                inputValue = inputValue.split(";");
            }

            // Ergebnis
            result = new PickFilter(value.index, inputValue, symbol);
        }


        return result;
    },

    applyBetrag(list, formData, key, value) {

        var me = this;

        var result = true;

        var symbol = me.getElementSymbol(list, key);

        var formatter = new Formatter();

        // TODO: Spezielle Anhabung der Symbole IS NULL, ....

        // Wenn Daten vorhanden sind
        if (formData[key]) {

            var inputValue = formData[key];

            if (symbol == 'in') {
                inputValue = inputValue.split(";");

                $.each(inputValue, function (key, inputSubValue) {
                    inputValue[key] = app.formatter.formatJsFloatWithNaN(inputSubValue);
                });

            } else {
                inputValue = app.formatter.formatJsFloatWithNaN(inputValue);
            }

            // Ergebnis
            result = new PickFilter(value.index, inputValue, symbol);
        }

        return result;
    },



    applyYesNo(formData, key, value) {

        var selected = "";

        var value1 = formData[key + '-1'].checked;
        var value2 = formData[key + '-2'].checked;

        // Wenn einer der beiden gesetzt ist
        if (value1 || value2) {
            result = new PickFilter(value.index, ((value1) ? 1 : 0));

            // Hier muss der Filter zurückgesetzt werden!
        } else {
            result = true;
        }

        return result;
    },



    // 
    applyQuickselect(formData, key, value) {

        var result = false;

        // Wenn 
        if (formData[key] && formData[key].value) {

            // Ergebnis
            result = new PickFilter(value.index, formData[key].text);
        }

        return result;
    },



    /**
     * Filter Gui anhand des Filters setzen!
     */
    resetFilterGui(list, soft) {

        var me = this;

        // Schliefe laufen lassen
        $.each(list.settings.fields, function (key, value) {

            // Wenn es ein Filter-Wert ist
            if (value.filter) {

                // Wenn keine Formatierung angebgen wurden
                var filterFormat = me.getFilterFormat(value);

                // Filter anhand des Formats zuweisen
                switch (filterFormat) {

                    case "text":
                        me.resetTextGui(list, key, soft);
                        break;

                    case "yes-no":
                        me.resetYesNoGui(list, key, soft);
                        break;

                    case "betrag":
                        me.resetBetragGui(list, key, soft);
                        break;

                    case "quickselect":
                        me.resetQuickselectGui(list, key, soft);
                        break;

                }
            }
        });
    },

    // Gui
    resetTextGui(list, key, soft) {
        var me = this;
        var el = me.getElement(list, key);
        el.val('')

        // Bei einem Soft Reset wird nur das Input Feld geleert
        if (!soft) {
            el.attr('placeholder', 'Beginnt mit').data('symbol', '.*');
            el.closest('.input-group').find('.dropdown-item').removeClass('active');
            el.closest('.input-group').find('.dropdown-item[data-symbol=".*"]').addClass('active');
            el.closest('.input-group').find('button').html('.*');
        }
    },

    resetBetragGui(list, key, soft) {
        var me = this;
        me.resetTextGui(list, key, soft);
    },

    resetYesNoGui(list, key, soft) {
        var me = this;
        var cb1 = me.getElement(list, key + '-1');
        var cb2 = me.getElement(list, key + '-2');
        cb1.prop('checked', false);
        cb2.prop('checked', false);
    },

    resetQuickselectGui(list, key, soft) {
        var me = this;
        list.filterForm.qs[key].reset(true);
    }

}