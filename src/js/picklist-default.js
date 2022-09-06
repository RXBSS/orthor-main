/**
 * PICKLISTE
 * 
 * 
 * Die Initalisierung geht wie folgt von statten: 
 * 
 * - Zunächst wird die Einstellungsdatei geladen
 * - Im Anschluss werden alle Einstellungen gemerget
 * - - Dabei gilt die folgende Hirachie Script Einstellungen überschreiben Config Datei Einstellungen überschreiben Default Einstellungen
 * 
 * 
 */
var Picklist = class {

    // Constructor
    constructor(container, name, s) {

        var me = this;

        // 
        me.isRedraw = false;

        // Session initalisieren
        me.initSession();

        // Initalisieren
        me.init(container, name, s);
    }


    /**
     * Initalisieren
     */
    init(container, name, s) {

        // Default initalisieren
        this.initDefault(container, name, s);
    }

    /**
     * Default Init
     * 
     * @param {*} container 
     * @param {*} name 
     * @param {*} s 
     */
    initDefault(container, name, s) {

        var me = this;

        me.debug = (s) ? ((s.debug) ? true : false) : false;

        // Validieren, dass der Container existiert
        if (!container) {
            throw new Error("Es wurde kein Container angegeben!");
        }

        // Validieren, dass der Name mitgegeben wurde
        if (!name) {
            throw new Error("Es wurde kein Name angegeben! >" + container + "<");
        }

        // Prüfen ob der Container existiert
        if ($(container).length > 0) {

            // Container
            me.container = $(container);
            me.name = name;
            me.objSettings = s || {};        // Die Einstellungen die mit übergeben wurden!
            me.searchIsFocus = false;
            me.searchIsFocusTimeout;
            me.isRedraw = false;
            me.isReady = false;
            me.isReadonly = false;
            me.isSettingRows = false,

                me.log('---------------------------------------------------------------');
            me.log(' ######  EINSTELLUNGEN')


            // Daten laden 
            me.loadData(function () {

                // Einstellungen migrieren
                me.mergeSettings(function () {

                    // HTML Template dynamisch erstellen
                    me.templateHtml = me.createTemplateFromConfig();

                    // Set Data
                    me.writeTemplate();

                    // DataTables starten
                    me.buildDataTables();

                    // Filter Initalisieren
                    me.initializeFilter();

                });
            });
        } else {
            throw new Error("Der Container wurde nicht gefunden >" + container + "<");
        }
    }

    /**
     * Hier wird das Objekt erstellt
     * Davor müssen noch einige Dinge erledigt werden, diese sind in der Funktion Prepare
     * Danach müssen alle Event Listner hinzugefügt werden diese sind unter addEventListner
     * 
     * 
     * 
     */
    buildDataTables() {

        var me = this;

        // Weiter vorbereiten
        me.prepare();

        // DataTables Objekt
        me.DataTable = me.container.find('table.table').DataTable(me.dataTableOptions);

        // Event Listner hinzufügen - dazu muss aber auf jeden Fall das DataTables Objekt bestehen
        me.addListner();

        // -- An dieser Stelle geht es dann mit dem initCompleteDefault (bzw. internal) Event weiter
        // -- Hier wird nämlich zunächst DataTables erstmal geladen

    }


    prepare() {

        var me = this;





    }

    /**
     * Wird beim Modal überschreiben
     */
    initCompleteInternal() {
        var me = this;

        // Init Complete
        me.initCompleteDefault();

        // Suche Fokussieren
        if (me.settings.searchFocus) {
            me.focusSearch();
        }

    }


    /**
     * Nach dem Laden
     */
    initCompleteDefault() {

        var me = this;

        // Setze Scroll X dauerhaft!
        me.container.find('.dataTables_scrollBody').css({
            'overflow-x': 'scroll'
        });

        // Nur wenn Autoresize auf False steht (default)
        if (me.settings.autoresize === false) {
            me.container.find('.dataTables_scrollBody').css({
                'min-height': me.container.find('.dataTables_scrollBody').height() + 3
            });
        }

        // In separate Funktion ausgelagert, damit diese vom Modal überschrieben werden kann
        me.setButtonsFrame();
        me.setButtons();

        // Set Tooltips
        me.setTableHeadTooltips();

        // 
        if (me.settings.showFilterOnStart) {
            me.container.find('.dt-filter').show();
        }

        if (me.container.find('.dataTables_info').length) {
            me.container.find('.dataTables_info').text(me.container.find('.dataTables_info').text().split(",").join("."));
        }

        // Filter hinzufügen
        me.applyFilter();

        // Start Filter = Filter
        me.settings.startFilter = me.settings.filter;


        me.isReady = true;

        me.container.trigger('initComplete');

    }

    /**
     * Funktion zum Warten bis die Pickliste bereit ist
     * @param {Function} callback 
     */
    waitForReady(callback, time) {

        var me = this;

        time = time || 100;

        // is Ready
        if (me.isReady) {
            callback();
        } else {
            setTimeout(function () {
                me.waitForReady(callback);
            }, time);
        }
    }


    /**
     * Fokkusiert die Suche
     */
    focusSearch() {

        var me = this;

        // Fokussieren nach dem Suchen
        if (me.settings.search) {
            me.container.find('.dataTables_filter input').focus();
            me.searchIsFocus = true;

            clearInterval(me.searchIsFocusTimeout);
        }

    }

    /**
     * Richtet die Columns neu an
     */
    redraw() {
        var me = this;

        // Für die Zeit Redraw setzen
        me.isRedraw = true;
        me.DataTable.columns.adjust().draw();

    }

    setButtonsFrame() {

        var me = this;


        // Buttons als Card hinzufügen
        // TODO: Muss noch über eine Einstellung gesetzt werden
        if (1 == 2) {

            me.container.find('.card-body').prepend('<div class="actions"></div>');
            me.buttonFrame = me.container.find('.card-body .actions');

            // Standard Buttons
        } else {

            // Buttons hinzufügen
            me.container.find('.dataTables__top').append('<div class="dataTables_buttons"></div>');
            me.buttonFrame = me.container.find('.dataTables__top .dataTables_buttons');
        }
    }

    /**
     * Hier werden die Buttons gesetzt
     * Es gibt Standard-Buttons und Custom Buttons. 
     * Die Custom Buttons können über addButtons als Array hinzugefügt werden!
     * 
     * Die Standard Button haben 10, 20, 30 als Position
     * So hat man die Möglichkeit davor und danch Buttons einzufügen
     * 
     * Beispiel:    15 = Zwischen undo und refrehs
     *              0-9 = Wäre vor den Buttons
     *              30-x = Wäre nach den Buttons
     * 
     * Es können auch mehrere Buttons die gleiche ID haben. 
     * Dann zählt in dem Falle die Reihenfolge, wie Sie zum Array hinzugefügt werden. 
     * Die Standard-Buttons kommen dabei immer als erstes
     * 
     * Es wird eine Konfigurations zusammengestellt: 
     * 
     * 
     *      // Beispiel Konfiguration
     *      {
     *          action: "myaction",                 // Wird in das data-action="" Attribute geschrieben
     *          class: "myclass",                   // Wird als zusätzliche Klasse angegeben
     *          icon: "fas fa-angellist",           // Das FontAwesome Icon
     *          tooltip: "My Tooltip",              // Der Tooltip, der beim Hover angezeigt wird
     *          pos: 15                             // Die Button Position 
     *          readonly: true                      // Ob der Button Readonly gesetzt werden soll, wenn die Tabelle Readonly gesetzt wird
     *      }
     */
    setButtons() {

        var me = this;

        // Init Button HTML
        var btnHtml = "";

        // Default Config
        var buttonConfig = [];

        // Standard Buttons
        if (me.settings.buttons) {

            // Wenn der Undo Button dazu soll
            if (me.settings.buttons.undo) {
                buttonConfig.push({
                    action: "undo",
                    icon: "fas fa-undo",
                    tooltip: "Zurücksetzen",
                    pos: 10
                });
            }

            // Wenn der Undo Button dazu soll
            if (me.settings.buttons.refresh) {
                buttonConfig.push({
                    action: "refresh",
                    icon: "fas fa-sync-alt",
                    tooltip: "Aktualisieren",
                    pos: 20
                });
            }

            // Wenn der Undo Button dazu soll
            if (me.settings.buttons.filter) {
                buttonConfig.push({
                    action: "filter",
                    icon: "fas fa-filter",
                    tooltip: "Filtern",
                    pos: 30
                });
            }
        }

        // Default Handle Buttons
        // Eine Option um das Erstelle, Bearbeiten und Entfernen zu vereinfachen
        if (me.settings.addHandleButtons) {
            buttonConfig = buttonConfig.concat([{
                action: 'add',
                icon: 'fas fa-plus',
                pos: 1,
                show: 'onDeselected',
                readonly: true
            }, {
                action: 'delete',
                icon: 'fas fa-trash',
                pos: 2,
                show: 'onSelected',
                readonly: true
            }, {
                action: 'edit',
                icon: 'fas fa-edit',
                pos: 3,
                show: 'onSingleSelected',
                readonly: true
            }]);
        }


        // Wenn es noch zusätzliche Buttons gibt
        if (typeof me.settings.addButtons != 'undefined' && Array.isArray(me.settings.addButtons) && me.settings.addButtons.length > 0) {
            buttonConfig = buttonConfig.concat(me.settings.addButtons);
        }

        // Sortieren
        buttonConfig.sort((a, b) => (a.pos > b.pos) ? 1 : ((b.pos > a.pos) ? -1 : 0));

        var hasTooltips = false;

        // Array mit Config durchgehen und hinzufügen
        $.each(buttonConfig, function (index, value) {

            value.readonly = value.readonly || false;

            // Das HTML Gerüst für den Button erstellen
            btnHtml += '<a class="action-item dt-action ' + ((value.class) ? value.class : '') + ' ' + ((value.show) ? value.show : '') + ' ' + ((value.readonly) ? 'dt-react-to-readonly' : '') +
                '" ' + ((value.action) ? 'data-action="' + value.action + '"' : '') +
                ' href="javascript:void(0);" ' + ((value.show == 'onSelected' || value.show == 'onSingleSelected') ? ' style="display:none;" ' : '') + ((value.tooltip) ? 'data-bs-toggle="tooltip" data-bs-placement="top" title="' + value.tooltip + '"' : '') + '><i class="' + value.icon + '"></i></a>';

            // Wenn mind. es einen Tooltip gibt
            if (value.tooltip) {
                hasTooltips = true;
            }

        });

        // HTML schreiben
        me.buttonFrame.html(btnHtml);

        // Tooltip Aktivieren
        if (hasTooltips) {

            // Tooltips erstellen
            me.buttonFrame.find('[data-bs-toggle="tooltip"]').each(function () {
                new bootstrap.Tooltip($(this).get(0));
            });
        }
    }


    /**
     * Setzt die Tooltips für den Tabellenkopf als Popup
     * 
     */
    setTableHeadTooltips() {

        // Init
        var me = this;
        var index = (me.settings.select) ? 2 : 1;

        // Gehe die Konfiguration durch
        $.each(me.settings.fields, function (key, value) {

            // Bei Hidden Fields den Index nicht hochzählen
            if (typeof value.hidden == 'undefined' || value.hidden === false) {

                // Prüfen ob es einen Tooltip gibt und ob das Feld überhaupt angezeigt wird
                if (typeof value.tooltip != 'undefined') {

                    // Element
                    var el = me.container.find('thead tr th:nth-child(' + index + ')');

                    // Prüfen ob das Element existiert
                    if (el.length) {

                        // Text in den Title schreiben
                        el.attr('title', value.tooltip);

                        // Tooltip hinzufügen
                        new bootstrap.Tooltip(el.get(0));
                    }
                }

                index++;
            }
        });
    }


    /**
     * Event Listner
     * #######################################################
     * Ab hier folgenden Alle Event Listener
     * // MARK: EVENT LISTENERS
     * 
     * 
     * - Action Buttons
     * - DataTables Events
     */
    addListner() {
        var me = this;

        me.addListnerDefault();
    }

    addListnerDefault() {

        var me = this;

        // Event Listner
        me.onActionButtonClicked();

        // Wenn man während des Suchens auf Enter drückt
        me.onDataTableProcessing();

        // Wenn man während des Sucahens auf Enter drückt
        me.onSearchFocusKeyPress();

        // Search Focus out
        me.onSearchFocusOut();

        // On Key
        me.onKey();

        // On Key
        me.dblClick();

        // Beim anwählen
        me.onSelect();

        // Beim Abwählen
        me.onDeselect();

        // Beim Blättern und Laden der Seite
        me.onDraw();

        // Bei einem Fehler
        me.onError();

        // Beim Löschen eines Filters
        me.onFilterClear();

        // Window Resize
        $(window).on('resize', $.debounce(function () {
            me.redraw();
        }, 50));

        // Redraw
        $(window).on('dt-resize', $.debounce(function () {
            me.redraw();
        }, 50));

        // Wird benötigt um verschiedene Events zu unterdrücken
        me.DataTable.on('draw', function () {
            me.isRedraw = false;
        });
    }

    // Proxy für das Jquery Element
    on(event, cb) {
        var me = this;
        me.container.on(event, cb);
    }

    /**
     * Wenn der Action Button geklickt wurde
     */
    onActionButtonClicked() {

        var me = this;

        // Event Listner für Buttons
        me.container.on('click', '.dt-action', function () {

            // Nur wenn die Tabelle nicht disabled ist
            if(!$(this).hasClass('dt-action-readonly')) {

                var action = $(this).data('action');

                switch (action) {

                    case 'undo':
                        me.reset(me.searchIsFocus);
                        break;

                    case 'refresh':
                        me.refresh();
                        break;

                    case 'filter':

                        me.container.find('.dt-filter').toggle();
                        break;

                }

                // Action
                me.container.trigger('action', [action, $(this)]);
            }
        });
    }

    /**
     * Während DataTables verarbeitet wird
     */
    onDataTableProcessing() {

        var me = this;

        // On DataTables 
        me.DataTable.on('processing.dt', function (e, settings, processing) {
            if (processing) {
                me.container.find('.dataTables_filter').addClass('dt-processing');
                me.container.find('[data-action="refresh"] i').addClass('fa-spin');
            } else {
                me.container.find('.dataTables_filter').removeClass('dt-processing');
                me.container.find('[data-action="refresh"] i').removeClass('fa-spin');
            }

            // On Loading Event
            me.container.trigger('loading', [processing]);
        });
    }

    /**
     * Wenn man während des Suchens auf Enter drückt
     */
    onSearchFocusKeyPress() {

        var me = this;

        // Suche Enter drücken
        if (me.settings.search && me.settings.keys) {

            // Wenn man Enter drückt während man in der Suchleiste ist
            me.container.find('.dataTables_filter input').on('keypress', function (e) {

                // Enter Key oder bei runter drücken
                // TODO: e.which 40 funkioniert noch nicht, da das Event nicht weitergegeben wird. Dies liegt aber an DataTables
                if (e.which == 13 || e.which == 40) {

                    // Erste Reihe, Erste Spalte
                    var element = me.container.find('table tr:first-child td:first-child');

                    // Fokus der Zeile
                    me.DataTable.cell(element).focus();

                    // Blur
                    me.container.find('.dataTables_filter input').blur();

                    // Letzen Key abspeichern
                    window.picklistSession[me.id].lastKey = e.which;

                    // Bei allen anderen Keys
                } else {

                    window.picklistSession[me.id].lastKey = e.which;
                    window.picklistSession[me.id].focusOnDraw = false;
                }
            });

            // Onetime Draw Event
            me.DataTable.on('draw', function () {

                if (window.picklistSession[me.id].focusOnDraw == false && window.picklistSession[me.id].lastKey == 13) {

                    // Erste Reihe, Erste Spalte
                    var element = me.container.find('table tr:first-child td:first-child');

                    // Fokus der Zeile
                    me.DataTable.cell(element).focus();
                }

                window.picklistSession[me.id].focusOnDraw = true;
            });
        }
    }

    onSearchFocusOut() {

        var me = this;

        me.container.find('.dataTables_filter input').on('focus', function (e) {
            me.searchIsFocus = true;
        });

        me.container.find('.dataTables_filter input').on('blur', function (e) {

            // Mit Timeout, damit das Click Event abgewartet wird
            me.searchIsFocusTimeout = setTimeout(function () {
                me.searchIsFocus = false;
            }, 100);
        });
    }


    // Beim Key Event
    onKey() {

        var me = this;

        me.DataTable.on('key', function (e, datatable, key, cell, originalEvent) {

            // Enter
            if (key == 13) {

                // Wenn Select aktiviert ist
                if (me.dataTableOptions.select) {

                    // quickPick
                    if ((me.settings.select === true || me.settings.select === 'single') && me.quickPick && me.asModal) {

                        // Reihe markieren
                        me.DataTable.row(cell.index().row).select();

                        me.pick();

                    } else {
                        if (me.DataTable.rows({ selected: true })[0].indexOf(cell.index().row) >= 0) {

                            // Reihe nicht mehr markieren
                            me.DataTable.row(cell.index().row).deselect();

                        } else {

                            // Reihe markieren
                            me.DataTable.row(cell.index().row).select();
                        }
                    }

                    // Wenn Select nicht ausgewählt ist
                } else {
                    var data = me.DataTable.row(cell.index().row).data();
                    me.pick(data);
                }
            }

            // Esc Key
            if (key == 27 && me.settings.search) {
                me.container.find('.dataTables_filter input[type=search]').focus();
            }

            if (key == 38 && me.settings.search) {

                if (cell.index().row == 0 && datatable.page.info().page == 0) {
                    me.DataTable.cell.blur();
                    me.container.find('.dataTables_filter input[type=search]').focus();
                }
            }

            // Wenn einfügen gedrückt wurde
            if (key == 45) {
                me.container.trigger('key-insert');
            }

            // Wenn entfernen gedrückt wurde
            if (key == 46) {
                me.container.trigger('key-delete', [me.selected]);
            }

            // Bei jedem Keypress
            me.container.trigger('key', [key, cell]);

        });
    }

    onSelect() {

        var me = this;

        // Nur wenn Select überhaupt aktiv ist
        if (me.settings.select) {

            // False or Empty Object
            me.selected = (me.settings.select === true || me.settings.select === 'single') ? false : {};

            // On Select
            me.DataTable.on('select', function (e, dt, type, indexes) {

                if ($(me.DataTable.row(indexes[0]).node()).hasClass('disabled') || $(me.DataTable.row(indexes[0]).node()).hasClass('readonly')) {
                    $(me.DataTable.row(indexes[0]).node()).removeClass('selected');
                    return false;
                } else {

                    // GUI - Setze die Checkbox in der vorderen Spalte
                    me.DataTable.cell(indexes, 0).data((me.settings.select === true || me.settings.select === 'single') ? '<i class="fa-solid fa-check" style="color:#7ab929"></i>' : '<i class="fa-solid fa-check" style="color:#7ab929"></i>');

                    // Je nachdem ob das Event getriggert werden muss
                    // oder nur die GUI angepasst
                    if (!me.isSettingRows) {

                        // Row
                        var row = me.DataTable.rows(indexes).data()[0];

                        // Wenn es Single Select ist
                        if (me.settings.select === true || me.settings.select === 'single') {
                            me.selected = row;


                            // Wenn es Multi Select ist
                        } else {


                            // Ohne Auto Deselect
                            // Drücken ohne was - markieren
                            // Drücken Shift - Funktioniert nur wenn nur eins markiert ist - Von bis Markieren
                            // Drücken STRG - Verhalten wie mit Auto Deselect 

                            // Mit Auto Deselect
                            // Drücken ohne was - nur dieses eine markieren
                            // Drücken mit Shift - Funktioniert nur wenn nur eins markiert ist - Von bis Markieren
                            // Drücken mit STRG - verhalten wie ohne Auto Deseclt

                            // Modus festlegen
                            var length = me.getSelectedLength();
                            var autoDeselect = me.settings.autoDeselect;

                            // Wenn es mehr als einen Datensatz gibt
                            if (length > 0) {

                                // Modus festlegen
                                var mode = (app.keys.shift) ? 'shift' : (((app.keys.ctrl && autoDeselect) || (app.keys.ctrl === false && autoDeselect == false)) ? 'multi' : 'single');

                                // Fehlermeldung
                                if (app.keys.shift && length > 1) {
                                    // app.notify.error.fire("Fehler beim Auswählen", "Eine Auswahl über Shift ist nur möglich, wenn Sie maximal eine Zeile markiert haben.");
                                }

                                // Modus ausführen
                                switch (mode) {

                                    case 'single':

                                        // Verhindern, dass Events gesetzt werden
                                        me.isSettingRows = true;

                                        // Jede Datenreihe durchgehen
                                        me.DataTable.rows().every(function (rowIdx, tableLoop, rowLoop) {
                                            if (indexes.indexOf(rowIdx) < 0) {
                                                me.DataTable.rows(rowIdx).deselect();
                                            }
                                        });

                                        // Weitermachen
                                        me.isSettingRows = false;

                                        // Selected Objekt leeren
                                        me.selected = {};

                                        // Wieder setzen
                                        me.selected[row[1]] = row;

                                        break;

                                    case 'shift':

                                        // Verhindern, dass Events gesetzt werden
                                        me.isSettingRows = true;

                                        // Ausgewählt
                                        var selected = me.getSelectedIndex();

                                        // Min und Max herausfinden
                                        var min = selected.shift();
                                        var max = selected.pop();

                                        // Selected Objekt leeren
                                        me.selected = {};

                                        // Row Data
                                        var rowData = me.DataTable.rows().data();

                                        // Jede Datenreihe durchgehen
                                        me.DataTable.rows().every(function (rowIdx, tableLoop, rowLoop) {

                                            // Prüfen ob die Zeile in dem Bereich liegt
                                            if (rowIdx >= min && rowIdx <= max) {

                                                // Wenn es nicht disabled ist
                                                if (!$(me.DataTable.row(rowIdx).node()).hasClass('disabled')) {

                                                    // Zeile anwählen
                                                    me.DataTable.rows(rowIdx).select();

                                                    // Daten in die Zeile aufnehmen
                                                    me.selected[rowData[rowIdx][1]] = rowData[rowIdx];
                                                }
                                            }
                                        });

                                        // Weitermachen
                                        me.isSettingRows = false;

                                        break;

                                    case 'multi':
                                        me.selected[row[1]] = row;
                                        break;
                                }

                                // Wenn bisher nur ein Datensatz angewählt wurde
                            } else {
                                me.selected[row[1]] = row;
                            }
                        }

                        // Set Selected
                        me.setSelected(true);
                    }
                }
            });
        }
    }



    onDeselect() {

        var me = this;

        // Nur wenn Select überhaupt aktiv ist
        if (me.settings.select) {

            // On Select
            me.DataTable.on('deselect', function (e, dt, type, indexes) {


                if ($(me.DataTable.row(indexes[0]).node()).hasClass('disabled') || $(me.DataTable.row(indexes[0]).node()).hasClass('readonly')) {
                    $(me.DataTable.row(indexes[0]).node()).removeClass('selected');
                    return false;
                } else {


                    // Setze die Checkbox
                    me.DataTable.cell(indexes, 0).data(me.getSelectionIcon());

                    // Wenn ein Event getriggert werden soll!
                    if (!me.isSettingRows) {


                        // Wenn es Single Select ist
                        if (me.settings.select === true || me.settings.select === 'single') {
                            me.selected = false;

                            // Bei Multi
                        } else {


                            // Modus festlegen
                            var autoDeselect = me.settings.autoDeselect;

                            var mode = (app.keys.shift) ? 'shift' : (((app.keys.ctrl && autoDeselect) || (app.keys.ctrl === false && autoDeselect == false)) ? 'multi' : 'single');


                            // Modus ausführen
                            switch (mode) {

                                case 'single':

                                    me.isSettingRows = true;

                                    // Jede Datenreihe durchgehen
                                    me.DataTable.rows().every(function (rowIdx, tableLoop, rowLoop) {
                                        me.DataTable.rows(rowIdx).deselect();
                                    });

                                    me.isSettingRows = false;

                                    // Daten zurücksetzen
                                    me.selected = {};

                                    break;

                                case 'shift':

                                    // Verhindern, dass Events gesetzt werden
                                    me.isSettingRows = true;

                                    // Ausgewählt
                                    var selected = me.getSelectedIndex();

                                    // Min und Max herausfinden
                                    var min = selected.shift();
                                    var max = indexes[0];

                                    // Selected Objekt leeren
                                    me.selected = {};

                                    // Row Data
                                    var rowData = me.DataTable.rows().data();

                                    // Jede Datenreihe durchgehen
                                    me.DataTable.rows().every(function (rowIdx, tableLoop, rowLoop) {

                                        // Prüfen ob die Zeile in dem Bereich liegt
                                        if (rowIdx >= min && rowIdx <= max) {

                                            // Wenn es nicht disabled ist
                                            if (!$(me.DataTable.row(rowIdx).node()).hasClass('disabled')) {

                                                // Zeile anwählen
                                                me.DataTable.rows(rowIdx).select();

                                                // Daten in die Zeile aufnehmen
                                                me.selected[rowData[rowIdx][1]] = rowData[rowIdx];

                                            }

                                        } else {
                                            me.DataTable.rows(rowIdx).deselect();
                                        }
                                    });

                                    // Weitermachen
                                    me.isSettingRows = false;
                                    break;

                                case 'multi':
                                    // Row
                                    var row = me.DataTable.rows(indexes).data()[0];

                                    delete me.selected[row[1]];
                                    break;
                            }
                        }

                        // Set Selected
                        me.setSelected();
                    }
                }
            });
        }
    }

    /**
     * Beim erstellen der Seite, also auch beim Blättern
     */
    onDraw() {

        var me = this;



        // On Draw
        me.DataTable.on('draw', function () {

            // Jede Reihe durchgehen
            me.DataTable.rows().every(function (rowIdx, tableLoop, rowLoop) {

                var data = this.data();

                var isDisabled = false;

                // 
                if (me.settings.disabled != false) {
                    if (me.settings.disabled.data.indexOf(data[me.settings.disabled.fieldIndex]) >= 0) {
                        isDisabled = true;
                    }
                }   


                if(me.isReadonly) {
                    $(this.node()).addClass('readonly');
                }


                // Disabled
                if (isDisabled) {

                    // 
                    $(this.node()).addClass('disabled');

                    // Wenn das Icon angepasst werden soll
                    if (me.settings.disabled.icon && me.settings.select) {
                        $(this.node()).find('td:first-child').html(me.settings.disabled.icon);
                    }                    


                } else if (me.settings.select == 'multi') {

                    // Draw Event - Damit beim Blätter oder sortieren die entsprechenden Daten noch vorhanden sind
                    if (me.settings.select) {

                        me.isSettingRows = true;

                        // Prüfen ob die ID in dem Objekt ist
                        if (typeof me.selected[data[1]] != 'undefined') {
                            me.DataTable.rows(rowIdx).select();
                        }

                        me.isSettingRows = false;

                    }

                    // Bei Single
                } else {

                    if (me.settings.select) {

                        // Prüfen ob die ID = ID is
                        if (me.selected[1] == data[1]) {
                            me.DataTable.rows(rowIdx).select();
                        }
                    }
                }
            });

            me.container.trigger('draw', []);
        });
    }

    /**
     * Bei einem Fehler
     */
    onError() {

        var me = this;

        // Wenn DataTable ein Fehler wirft
        me.DataTable.on('error.dt', function (e, settings, techNote, message) {
            app.alert.debugError('Fehler in der Pickliste', message, settings.jqXHR.responseText);
        });
    }


    onFilterClear() {

        var me = this;

        me.container.on('click', '.filter-clear', function () {
            me.resetFilter();
        });

    }

    /**
     * Double Click
     */
    dblClick() {
        var me = this;

        // Wenn Select 
        if (!me.settings.select) {

            // 
            me.DataTable.on('dblclick', 'tbody tr', function () {
                var data = me.DataTable.row(this).data();
                me.pick(data);
            });
        }
    }


    /**
     * Abwählen, falls etwas angewählt it
     */
    deselect() {
        var me = this;

        // Prüfen ob etwas ausgewählt wurde
        if (me.DataTable.rows({ selected: true }).length > 0) {

            // Wenn ja deselecten
            me.DataTable.row().deselect();
        }
    }

    /**
     * Triggert nur das Pick an
     */
    pick(data) {

        var me = this;
        me.pickDefault(data);
    }

    pickDefault(data) {
        var me = this;

        // 
        data = (typeof data == 'undefined') ? me.selected : data;

        // Event Triggern
        me.container.trigger('pick', [data]);
    }


    /**
     * Zurücksetzen
     */
    reset(searchFocus) {

        var me = this;
        me.resetDefault(searchFocus);
    }


    resetDefault(searchFocus) {

        var me = this;


        searchFocus = searchFocus || false;

        // Das Suchelement
        var searchEl = me.container.find('.dataTables_filter input[type=search]');

        // Reset des Inputs
        searchEl.val('').trigger('input');

        // Reset Selected
        me.resetSelected();

        // Filter zurücksetzen
        me.resetFilter();

        if (searchFocus) {
            me.focusSearch();
        }
    }


    /**
     * Alles was mit Selected zu tun hat
     * 
     * @param {*} isSelected 
     */


    // Setzt das Auswahl Feld
    setSelected(isSelected) {

        var me = this;

        // Set Selected
        me.setSelectedDefault(isSelected);
    }

    setSelectedDefault(isSelected) {

        var me = this;

        if (((me.settings.select === true || me.settings.select === 'single') && me.selected) || (me.settings.select === 'multi' && Object.keys(me.selected).length > 0)) {

            if (me.settings.select === 'multi' && Object.keys(me.selected).length > 1) {

                me.container.find('.dt-action.onDeselected').hide();
                me.container.find('.dt-action.onSingleSelected').hide();
                me.container.find('.dt-action.onSelected').show();


                $('body').find('.dt-' + me.id + '-onDeselected').hide();
                $('body').find('.dt-' + me.id + '-onSingleSelected').hide();
                $('body').find('.dt-' + me.id + '-onSelected').show();

            } else {
                me.container.find('.dt-action.onDeselected').hide();
                me.container.find('.dt-action.onSelected').show();
                me.container.find('.dt-action.onSingleSelected').show();

                $('body').find('.dt-' + me.id + '-onDeselected').hide();
                $('body').find('.dt-' + me.id + '-onSelected').show();
                $('body').find('.dt-' + me.id + '-onSingleSelected').show();
            }

        } else {
            me.container.find('.dt-action.onDeselected').show();
            me.container.find('.dt-action.onSelected').hide();
            me.container.find('.dt-action.onSingleSelected').hide();

            $('body').find('.dt-' + me.id + '-onDeselected').show();
            $('body').find('.dt-' + me.id + '-onSelected').hide();
            $('body').find('.dt-' + me.id + '-onSingleSelected').hide();
        }

        // Select Trigger immer, außer bei redraw
        if (!me.isRedraw) {

            // Trigger Select
            me.container.trigger(((isSelected) ? 'selected' : 'deselected'), [me.selected]);
            me.container.trigger('selection', [me.selected, isSelected]);

        }
    }

    /**
     * Get Selected
     * @returns 
     */

    getSelected() {
        var me = this;
        return me.selected;
    }

    /**
     * Zum normalisieren von Multi und Single Select gedacht.
     * 
     * 
     * @returns {Array|Boolean} Gibt immer ein Array oder Boolean zurück
     */
    getSelectedSingle() {

        var me = this;

        // Ergebnis
        var result = false;

        // Prüfen ob etwas gewählt ist
        if (((me.settings.select === true || me.settings.select === 'single') && me.selected) || (me.settings.select === 'multi' && Object.keys(me.selected).length > 0)) {

            // Wenn es Multi ist
            if (me.settings.select === 'multi') {

                // Wenn es genau einen Datensatz gibt
                if (Object.keys(me.selected).length === 1) {
                    return me.selected[Object.keys(me.selected)[0]];
                }

                // Wenn es Single ist, dann das Ergebnis zurückgeben
            } else {
                result = me.selected;
            }
        }

        return result;

    }

    /**
     * Gibt die Anzahl der Selectierten Reihen zurück
     */
    getSelectedLength() {

        var me = this;

        // Anzahl der Selectierten Datensätze zurückgeben
        if ((me.settings.select === true || me.settings.select === 'single') && me.selected) {
            return 1;
        } else if (me.settings.select === 'multi' && Object.keys(me.selected).length > 0) {
            return Object.keys(me.selected).length;
        } else {
            return 0;
        }
    }

    getSelectedSingleColumn(column) {

        var me = this;
        var result = me.getSelectedSingle();

        // Wenn es einen Wert gibt
        if (result) {

            column = me.getColumnIndex(column);

            // Rückgabe des Wertes
            result = result[column];
        }

        // Rückgabe
        return result;
    }

    getSelectedColumn(column) {

        var me = this;

        var result = [];

        // Spalte auflösen, falls es ein Name ist
        column = me.getColumnIndex(column);

        if ((me.settings.select === true || me.settings.select === 'single') && me.selected) {
            result.push(me.selected[column]);
        } else if (me.settings.select === 'multi' && Object.keys(me.selected).length > 0) {
            $.each(me.selected, function (index, value) {
                result.push(value[column]);
            });
        }

        // Rückgabe
        return (result.length > 0) ? result : false;
    }

    getSelectedIndex() {
        var me = this;
        return me.DataTable.rows({ selected: true })[0];
    }


    getColumnIndex(column) {

        var me = this;

        // Index
        var index = column;

        // Prüfen ob die Spalte als ID angegeben wurde
        if (isNaN(column)) {

            // Wenn es den Feld-Namen nicht gibt
            if (typeof me.settings.fields[column] == 'undefined') {
                throw new Error("Der Name der Spalte wurde nicht gefunden!");
            }

            // Index festlegen
            index = me.settings.fields[column].index;
        }

        return index;
    }



    // Setzt alle ausgewählten Zeilen zurück
    resetSelected() {

        var me = this;

        // Alle auf der aktuellen Seite auf "Deselect" setzen
        me.DataTable.rows().deselect();

        // Bei jeder Zeile den Reset durchführen
        me.DataTable.rows().every(function (rowIdx, tableLoop, rowLoop) {

            // Jede Zelle neu setzen
            me.DataTable.cell(rowIdx, 0).data(me.getSelectionIcon());
        });

        // Selected auf 0 setzen
        me.selected = (me.settings.select === true || me.settings.select === 'single') ? false : {};

        // Set Selected
        me.setSelected();

    }

    /**
     * 
     */
    selectRow(row) {
        var me = this;
        me.DataTable.rows(row).select();
    }


    /**
     * 
     */
    getSelectionIcon() {
        var me = this;
        return (me.settings.select === true || me.settings.select === 'single') ? '<i class="fa-regular fa-circle"></i>' : ((me.settings.autoDeselect === true) ? '<i class="fa-regular fa-square"></i>' : '<i class="fa-solid fa-square"></i>')
    }


    /**
     * 
     */
    forceSelectRow(row) {
        var me = this;
        me.resetSelected();
        me.selectRow(row);
    }

    /**
     * 
     */
    deselectRow(row, noEvent) {
        var me = this;
        me.DataTable.rows(row).deselect();
    }

    getRowData(row) {
        var me = this;
        return me.DataTable.rows(row).data()[0];
    }

    getRowCount() {
        var me = this;
        return me.DataTable.rows()[0].length;
    }


    /**
     * HIER FINDET SICH ALLES WAS MIT DEN EINSTELLUNGEN ZU TUN HAT
     * ***********************************************************
     */


    /**
    * Einstellungen migrieren
    * // MARK: SETTINGS
    * 
    */
    mergeSettings(callback) {

        var me = this;


        me.log('----> Merge Settings', 1);

        // Standard Einstellungen
        var defaultSettings = me.getDefaultSettings();

        me.log('-- Default Settings', 1);
        me.log(defaultSettings);

        // Der Type muss vorher gemergt werden!
        var type = (me.objSettings.type) ? me.objSettings.type : ((me.configFile.type) ? me.configFile.type : defaultSettings.type);


        // Hier werden die Einstellungen gemerged, die sich aus dem Type ergeben
        // Wenn es sich zum Beispiel um eine Pickliste handelt, dann werden andere Dinge aktiviert im Standard
        defaultSettings = me.typeSettingsToDefaultSettings(defaultSettings, type);


        // ---------------------------------------------
        // Konfigurationsdateien

        // Hier wird geprüft ob es eine zweite Einstellungsdatei gibt
        // Bei der Second Config kann man zwischen Overwrite und Extend wählen
        me.getSecondConfig(function (secondConfig) {

            me.log('-- Prüfen welche Config-Datei/en und mit welchem Modus', 1);

            // Hier wird die finale Config aus den beiden Dateien hineingeschrieben
            var finalConfigFileResult;

            // Wenn es ein zweite Config-Datei gibt
            if (me.objSettings.config) {

                // Wenn der Overwrite Modus gewählt wurde!
                // Dann überschreibt die zweite Config-Datei die erste komplett
                if (me.objSettings.config.mode == 'overwrite') {

                    me.log('-- Overwrite mit zweiter Config Datei', 1);

                    // OVERWRITE
                    finalConfigFileResult = secondConfig;

                    // Wenn Merge gewählt wurde. Dann hat die Second Config über die First Config Prio
                } else {

                    me.log('-- Merge mit zweiter Config Datei', 1);

                    // MERGE - DEEP!
                    finalConfigFileResult = $.extend(true, {}, me.configFile, secondConfig);

                }

                // Nur die erste Konfig Datei nutzen!
            } else {

                me.log('-- Ohne zweite Config Datei', 1);

                finalConfigFileResult = me.configFile;
            }

            me.log(finalConfigFileResult);

            // ----------------------------------------
            // Final Merge

            me.log('-- Final Merge', 1);

            // Hier werden die Einstellungen aus der Config Datei und aus dem Objekt gemergt
            var settings = $.extend(true, {}, defaultSettings, finalConfigFileResult, me.objSettings);

            me.log(settings);

            // Konfig File anwenden
            me.settings = settings;

            // Jedem Feld seine ID zuordnen
            var i = 1;

            $.each(me.settings.fields, function (key, value) {
                me.settings.fields[key].index = i;
                i++;
            });

            // Disabled Settings mergen
            me.mergeDisabledSettings(function () {

                // DataTables Instanz schreiben
                me.mainSettingsToDatatables();

                // Log
                me.log('---------------------------------------------------------------');

                // Callback
                callback();

            });
        });
    }


    /**
     * Bearbeitet die Disabled Settings
     * @param {*} callback 
     */
    mergeDisabledSettings(callback) {

        var me = this;

        // Disabled
        if (me.settings.disabled != false) {

            // Internal Use
            var disabled = {
                fieldName: (typeof me.settings.disabled.field != 'undefined') ? me.settings.disabled.field : 'id',
                fieldIndex: false,
                icon: (typeof me.settings.disabled.icon != 'undefined') ? me.settings.disabled.icon : false,
                data: (typeof me.settings.disabled.data != 'undefined') ? me.settings.disabled.data : me.settings.disabled,
                query: (typeof me.settings.disabled.query != 'undefined') ? me.settings.disabled.query : false
            };

            // Daten zu einem String konvertieren
            disabled.data = (Array.isArray(disabled.data)) ? disabled.data.map(String) : [];

            // Spalte ermitteln
            disabled.fieldIndex = me.getColumnIndex(disabled.fieldName);

            // Einstellungen
            me.settings.disabled = disabled;

            // 
            if (me.settings.disabled.query) {
                me.getDisabledQueryData(function () {
                    callback();
                });
            } else {
                callback();
            }

        } else {
            callback();
        }
    }

    /**
     * 
     */
    getDisabledQueryData(callback) {

        // 
        var me = this;

        // Wenn die Daten vorhanden sind
        if (me.settings.disabled && me.settings.disabled.query) {

            app.simpleRequest("picklist-disabled", "public-handle", me.settings.disabled.query, function (response) {

                // Daten aktualisieren
                me.settings.disabled.data = response.data;

                callback();
            });
        } else {
            callback();
        }
    }


    updateDisabled(query) {
        var me = this;

        if (query) {

            // Wenn es ein Objekt ist
            if (typeof query == 'object') {

                // Einstellungen überschreiben
                me.settings.disabled.query = $.extend({}, me.settings.disabled.query, query);

                // Wenn es ein String ist
            } else {
                me.settings.disabled.query = query
            }

            console.log(me.settings.disabled.query);

            me.refresh();

        } else {
            throw new Error("Ungültige Daten übergeben");
        }
    }




    /**
     * Pre Merge
     * $.exentend führt standarmäßig nur einen Merge auf erster Ebene aus. 
     * Dies würde dann dazu führen, dass zum Beispiel die Felder immer überschrieben werden. 
     * Diese Verhalten ist aber eher Kontra-Produktiv. Grade bei den Felder will man auch ein Merge verhalten und kein Overwrite
     * 
     * Einzige Ausnahme ist die Second-Config. 
     * Hier kann man explizit angeben ob gemergt werden soll oder überschrieben werden soll! 
     * 
     * 
     * 
     */

    /*
    preMerge(defaults, config, secondConfig, objConfig) {
    
        var me = this;
    
        me.log('----> Pre Merge Settings', 1);
    
        var preMergeKeys = ['fields', 'joins'];
    
    
        for (var i = 0; i < preMergeKeys.length; i++) {
    
            // Initalisieren
            defaults[preMergeKeys[i]] = defaults[preMergeKeys[i]] || {};
            config[preMergeKeys[i]] = config[preMergeKeys[i]] || {};
            secondConfig[preMergeKeys[i]] = secondConfig[preMergeKeys[i]] || {};
            objConfig[preMergeKeys[i]] = objConfig[preMergeKeys[i]] || {};
    
            // Felder erweitern
            objConfig[preMergeKeys[i]] = $.extend({}, defaults[preMergeKeys[i]], config[preMergeKeys[i]], secondConfig[preMergeKeys[i]], objConfig[preMergeKeys[i]]);
        }
    
        me.log('-- Ergebnis des Premerge der Felder', 1);
        me.log(objConfig.fields);
    
        // Rückgabe
        return {
            defaults: defaults,
            config: config,
            secondConfig: secondConfig,
            objConfig: objConfig
        };
    }
    
    
    */


    /**
     * Es gibt die Möglichkeit, dass es zwei Config-Files gibt
     * 
     * 
     */
    getSecondConfig(callback) {

        var me = this;

        me.log('----> Second Config', 1);

        // Zweite Config
        var secondConfig = {};


        // Prüfen ob die Second Config überhaupt benötigt wird
        if (typeof me.objSettings.config != 'undefined') {

            // Second Config File
            var temp = {
                file: (typeof me.objSettings.config == 'object') ? me.objSettings.config.file : me.objSettings.config,
                mode: (typeof me.objSettings.config.mode != 'undefined') ? me.objSettings.config.mode : 'overwrite'
            };

            // Normalisieren der Werte
            me.objSettings.config = temp;

            me.log('-- Second Config File >' + me.objSettings.config.file + '<', 1);

            // Second Config laden
            me.loadFile(me.objSettings.config.file, function (success, json) {

                // Wenn es erfolgreich war
                if (success && typeof json == 'object') {
                    me.log('-- Zweite Configuration erfolgreich geladen', 1);
                    me.log(json);

                    // Zweite Config
                    secondConfig = json;

                } else {
                    me.objSettings.config = false;
                    console.warn('Fehler beim Laden der zweite Configuration!');
                }


                // In beiden Fällen den Callback ausführen
                callback(secondConfig);
            });

        } else {

            me.log('-- No Second Config', 1);

            me.objSettings.config = false;

            // 
            callback(secondConfig);
        }


    }



    /**
     * Handelt es sich zum Beispiel um eine Pickliste, dann werden andere Dinge gemergt.
     * 
     */
    typeSettingsToDefaultSettings(settings, type) {

        var me = this;

        me.log('----> Merge Default Settings and Type Settings >' + type + '<', 1);

        // Anpassungen für Single Picklist & Anpassungen für Multi Pickliste
        if (type == 'single-picklist' || type == 'multi-picklist') {

            // Anpassungen
            settings.description = false;

            // Select aktivieren
            settings.select = (type == 'single-picklist') ? 'single' : 'multi';

            // Anpassungen für Simple
        } else if (type == 'simple') {

            settings.search = false;
            settings.buttons = false;
            settings.description = false;
            settings.lengthMenu = false;

        }

        // Log der Einstellungen
        me.log(settings);

        // Wenn es eine Funktion zum Mergen der Settings gibt
        if (typeof me.mergeModalTypeSettings == 'function') {
            settings = me.mergeModalTypeSettings(settings, type);
        }

        return settings;
    }



    /**
     * Hier werden nur die Einstellungen verarbeitet, die aus den Haupteinstellungen nach DataTables geschrieben werden müssen
     * 
     */
    mainSettingsToDatatables() {

        var me = this;

        me.log('----> Schreibe Settings in die DataTables Default Settings', 1);

        // Settings kürzen
        var s = me.settings;

        // Standard Einstellungen von DataTables
        var defaultDtSettings = me.getDtDefaultSettings();

        // ELEMENTE
        // ******************
        var dtDom = '';

        if (s.search || s.lengthMenu || s.buttons) {
            dtDom += '<"dataTables__top"';
            dtDom += (s.search) ? 'f' : '';                         // Suche
            dtDom += (s.lengthMenu && s.pagination) ? 'l' : '';     // Length Menu
            dtDom += (s.buttons) ? 'B' : '';                        // Buttons
            dtDom += '>';
        }

        dtDom += 't<"row"';

        // Beginn der unteren Hälfte
        dtDom += (s.description) ? '<"col"i>' : '';              // Beschreibung (Seiten und Filter)
        dtDom += (s.pagination) ? '<"col"p>' : '';               // Pagination
        dtDom += (s.description && s.pagination) ? '<"col">' : '';
        dtDom += '>';

        // Length Menu
        if (Array.isArray(s.lengthMenu)) {
            defaultDtSettings.lengthMenu = s.lengthMenu;
        }

        // Wenn das Pagination dabei ist
        if (!s.pagination) {
            defaultDtSettings.pageLength = 100000000000;
        } else {

            // Page Length
            if (s.pageLength) {
                defaultDtSettings.pageLength = s.pageLength;
            }

            if (s.pageLength && s.lengthMenu && defaultDtSettings.lengthMenu[0].indexOf(s.pageLength) < 0) {
                defaultDtSettings.lengthMenu[0] = [s.pageLength].concat(defaultDtSettings.lengthMenu[0]);
                defaultDtSettings.lengthMenu[1] = [s.pageLength + ' Zeilen'].concat(defaultDtSettings.lengthMenu[1]);
            }
        }

        // Standard DOM Ansicht
        defaultDtSettings.dom = dtDom;

        // KEYS
        // ******************
        defaultDtSettings.keys = s.keys;

        // SELECT 
        // ******************
        if (s.select) {

            // Einstellungen für den Select Type
            defaultDtSettings.select = {
                style: (s.select === true) ? 'single' : s.select
            }

            // Anpassungen der Column definitions
            defaultDtSettings.columnDefs[0].visible = true;
        }

        // ORDER
        // *****************
        if (s.order) {

            // Order
            var order;

            // Normalisieren
            if (typeof s.order == 'number' || typeof s.order == 'string') {
                order = [[s.order, 'asc']];


            } else {
                order = s.order;
            }

            me.log('############');
            me.log(order);

            defaultDtSettings.order = order;
        }

        // Ajax DataTables
        defaultDtSettings.ajax = {

            // Url festlegen
            url: 'modules/picklist/' + me.name + '/process.php',

            // Data als Funktion
            data: function (d) {

                // Second Config
                d.secondConfig = me.settings.config;

                // Felder
                d.fields = me.objSettings.fields;

                // Checkbox Abfragen
                d.checkbox = me.getSelectionIcon();

                // Additional Data
                d.additional = me.settings.data;

                // Wenn es sich um eine Funktion handelt, dann die Funktion ausführen
                if (me.settings.data) {

                    // Bugfix
                    if (typeof me.settings.data == 'function') {
                        d.additional = me.settings.data();
                    } else {
                        d.additional = me.settings.data;
                    }
                }

                // Filter
                d.filter = {
                    fixed: me.settings.fixFilter,
                    columns: me.settings.filter
                };

                // Rückgabe
                return d;
            },

            // Data Src
            dataSrc: function (json) {

                me.log('-- AJAX Call Complete', 2)
                me.log(json);

                me.container.trigger('ajax', [json]);

                return json.data;
            }

        }

        // Init Complete
        defaultDtSettings.initComplete = function (settings, json) {
            me.container.trigger('dtInitComplete');
            me.initCompleteInternal();
        }

        // Deaktivieren des Alert Errors
        $.fn.dataTable.ext.errMode = 'none';


        // COLUMN DEFINITIONS
        // ******************

        // Arrays initalisieren
        var index = 1;
        var hidden = [], searchable = [], sortable = [], classes = [];

        $.each(me.settings.fields, function (key, value) {

            // Hidden Fields
            if (value.hidden === true) {
                hidden.push(index);
            }

            // Nicht durchsuchbare Felder
            if ((typeof value.searchable != 'undefined' && value.searchable === false) || value.type == 'special') {
                searchable.push(index);
            }

            // 
            if ((typeof value.sortable != 'undefined' && value.sortable === false) || value.type == 'special') {
                sortable.push(index);
            }


            // 
            if (typeof value['class'] != 'undefined' && value['class'] !== false) {
                classes.push({
                    targets: [index],
                    className: value['class']
                });
            }

            index++;
        });

        // Column Definitions hinzufügen
        if (hidden.length > 0) {
            defaultDtSettings.columnDefs.push({
                targets: hidden,
                visible: false
            });
        }

        if (searchable.length > 0) {
            defaultDtSettings.columnDefs.push({
                targets: searchable,
                searchable: false
            });
        }

        if (sortable.length > 0) {
            defaultDtSettings.columnDefs.push({
                targets: sortable,
                orderable: false
            });
        }

        // Klassen anfügen
        if (classes.length > 0) {
            defaultDtSettings.columnDefs = defaultDtSettings.columnDefs.concat(classes);
        }

        // DataTable Options
        me.dataTableOptions = defaultDtSettings;

        // DataTable Options
        if (me.settings.dataTableOptions) {
            me.log('--- DataTables Options aus den Settings mit übernehmen', 1);
            me.dataTableOptions = $.extend(true, {}, me.dataTableOptions, me.settings.dataTableOptions);
            me.log(me.dataTableOptions);
        }
    }

    /**
     * Mit dieser Funktion können spalten ein- und ausgeblendet werden
     * 
     * @param {String|Number|Array} ids Wenn es ein String ist, dann wird in der Config nach dem Index gesucht, bei einer Nummer, wird direkt der Index genommen
     * @param {Boolean} visible 
     */
    colVisible(id, visible) {
        var me = this;
        id = (Array.isArray(id)) ? id : [id];

        for (var i = 0; i < id.length; i++) {

            // Wenn es kein Nummerischer Wert ist
            if (isNaN(id[i])) {

                // Felder
                if (me.settings.fields[id[i]]) {
                    id[i] = me.settings.fields[id[i]].index;
                } else {
                    throw new Error("Das Feld >" + id[i] + "< konnte nicht gefunden werden und kann deshalb nicht ein- oder ausgeblendet werden!");
                }

                // Wenn es ein Nummerischer Wert ist
            } else {
                id[i] = parseInt(id[i]);
            }


            me.DataTable.column(id[i]).visible(visible);
        }
    }

    /**
     * Gibt die Standard-Einstellungen zurück 
     */
    getDefaultSettings() {

        var me = this;

        // Die Werte wenn kein Einstellungen mitgegeben werden würden
        var defaults = {

            debug: false,                       // Debug
            type: 'single-list',                // Listentyp
            autoDeselect: true,
            title: "Eine Liste",                       // Titel
            showTitle: false,
            card: true,                         // Bestimmt ob um das Template noch eine Card gelegt wird
            search: true,                       // Gibt vor, ob die Suche Standardmäig angezeigt wird
            searchFocus: true,                  // Wenn true wird nach erstellen automatisch das Suchfenster fokusiert
            keys: true,                         // Steuerung der Tabelle über Tastatur
            select: false,                      // Ob ein oder mehre Reihen ausgewählt werden können
            selectRow: false,                   // Select Row

            autoresize: false,

            disabled: false,                    // Ob etwas disabled ist

            description: true,                  // Beschreibung (Suchergebnisse)
            lengthMenu: true,                   // Beschreibung (Anzahl der Ergebnisse)
            pagination: true,                   // Beschreibung (Seitenanzahl)
            pageLength: false,                  // Page Length

            // DataTables Options ist leer
            dataTableOptions: {},

            // Buttons
            buttons: {
                undo: true,
                refresh: true,
                filter: true
            },

            // Standardmäßig gibt es keine zusätzlichen Daten
            data: {},

            // Handle Buttons
            addHandleButtons: false,            // Die Zusätzlichen Buttons zum Handlen von Daten
            submitButton: true,

            // ----- Alles was zusätzliche Filter sind

            startFilter: {},                    // Wenn beim Start filter gesetzt werden, dann werden diese hier abgespeichert
            filter: {},
            fixFilter: {},

            // Ob mit offenem Filter gestartet werden soll
            showFilterOnStart: false,




        }

        // Wenn es eine Funktion zum Mergen der Settings gibt
        if (typeof me.mergeModalDefaultSettings == 'function') {
            defaults = me.mergeModalDefaultSettings(defaults);
        }


        // Einstellungen
        return defaults;

    }

    // Alias für Refresh
    reload(clearSelect) {
        var me = this;
        me.refresh(clearSelect);
    }

    refresh(clearSelect) {
        var me = this;

        clearSelect = clearSelect || false;

        // Refesh
        me.getDisabledQueryData(function () {

            // Setzt Selected zurück
            if (clearSelect) {
                me.resetSelected();
            }

            // Neu Laden
            me.DataTable.ajax.reload();
        });


    }



    /**
     * 
     * Gibt die Default Einstellungen zurück
     * 
     * @returns 
     */
    getDtDefaultSettings() {

        var me = this;

        me.log('----> Get DataTable Default Settings', 1);



        // Die Werte wenn kein Einstellungen mitgegeben werden würden
        var dataTableOptions = {

            serverSide: true,           // Aktiviert das Server-Side-Processing (Performance)
            autoWidth: false,           // Automatische Breite anpassen
            scrollX: true,

            // Standard ColumDefinitions
            columnDefs: [

                // Die erste Zeile sollte immer eine leere Zeile für die Pickliste
                {
                    targets: 0,
                    orderable: false,
                    searchable: false,
                    visible: false

                    // Die zweite Zeile ist in der Regel immer die ID
                    // Keine Einstelleungen nötig
                }, {
                    targets: 1
                }
            ],


            // Standard Längen Menü - Sollte bei Modals noch angepasst werden
            pageLength: 20,
            lengthMenu: [[20, 50, 100], ['20 Zeilen', '50 Zeilen', '100 Zeilen']],

            // Sprachpaket - Standard erstmal nur Deutsch
            language: {
                "decimal": "",
                "emptyTable": "Keine Daten",
                "info": "Zeige _START_ bis _END_ von _TOTAL_ Einträgen",
                "infoEmpty": "Zeige 0 bis 0 von 0 Einträgen",
                "infoFiltered": "(gefiltert von _MAX_ Einträgen)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Zeige _MENU_ Einträge",
                "loadingRecords": "Lädt...",
                "processing": "Verarbeitet...",
                "search": "Suche:",
                "zeroRecords": "Keine Suchergebnisse",
                "paginate": {
                    "first": "Erste",
                    "last": "Letzte",
                    "next": "Nächste",
                    "previous": "Vorherige"
                },
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "select": {
                    "rows": ". %d Zeilen ausgewählt"
                }
            }
        };


        var defaultOrder = (Object.keys(me.settings.fields).length > 1) ? 2 : 1;

        // Standard sortierung nach Feld Wert 2,
        // Falls diese nicht definert ist, dann Wert 1 nehmen
        dataTableOptions.order = [[defaultOrder, "asc"]];


        // Die dritte Zeile sollte immer der Primärwert sein
        // Allerdings nur, wenn diese auch Vorhanden ist
        if (defaultOrder > 1) {

            dataTableOptions.columnDefs.push({
                targets: 2,
                responsivePriority: 1
            });

        }


        // Wenn es eine Funktion zum Mergen der Settings gibt
        if (typeof me.mergeModalDtDefaultSettings == 'function') {
            dataTableOptions = me.mergeModalDtDefaultSettings(dataTableOptions);
        }

        me.log(dataTableOptions);


        return dataTableOptions;
    }


    /**
     * Hier wird eine Session für die Pickliste initalisiert. 
     * Das hat den Vorteil, dass jede Session eine eindeutige ID hat und theoretisch mehrere offen ein können
     * 
     */
    initSession() {

        var me = this;

        // ID erstellen
        me.id = "picklist-" + moment().format('x') + String(Math.random()).replace('.', '');

        // Session Erstellen, falls noch keine Vorhanden ist
        if (!window.picklistSession) {
            window.picklistSession = {};
        }

        // Session initalisieren
        window.picklistSession[me.id] = {
            focusOnDraw: false,
            currentKey: false,
            currentRow: false
        };
    }


    // MARK: TEMPLATE UND LOADING

    /**
     * Lädt die Konfiguration
     */
    loadData(callback) {

        var me = this;

        me.log('----> Load Config File', 1)

        // Konfigurationsdatei laden
        me.loadFile('config.json', function (success, json) {

            // Wenn das Template erkannt wurde
            if (success && typeof json == 'object') {

                me.log(json);

                // Konfiguration
                me.configFile = json;

                // Callback
                callback();

                // Fehlermeldung werfen
            } else {
                throw new Error("Es wurde keine Konfigurationsdatei gefunden oder die Datei ist Fehlerhaft! Der Name muss >config.json< heißen und es muss ein Valides JSON sein.");
            }
        });

    }



    /**
     * Erstellt aus der Config-Datei das Template
     * 
     */
    createTemplateFromConfig() {

        var me = this;

        var html = '';

        // Wenn es als Karte geladen werden soll
        if (me.settings.card) {
            html += '<div class="card">' +
                '<div class="card-body">';
        }

        // Title 
        if (me.settings.showTitle) {
            html += '<h4 class="card-title">' + me.settings.title + '</h4>';
        }

        html += '<div class="dt-filter">' + me.generateFilterHtml() + '</div>';


        html +=
            '<div >' +
            '<table class="table table-hover">' +
            '<thead class="thead-default">' +
            '<tr>' +
            '<th><i class="fa-solid fa-check-double"></i></th>';

        $.each(me.settings.fields, function (index, value) {
            html += "<th>" + ((typeof value.title == 'undefined') ? 'title_missing' : value.title) + "</th>";
        });


        html += '</tr>' +
            '</thead>' +
            '</table>' +
            '</div>'

        if (me.settings.card) {
            html += '</div>' +
                '</div>';
        }


        return html;
    }





    /**
     * Einfache Funktion zum laden der Inhalte eines Files
     * 
     * @param {Function} callback Wird getriggert, wenn die Datei gelanden wurde
     */
    loadFile(file, callback) {

        var me = this;

        // Per Ajax die Daten laden
        $.ajax({
            type: 'POST',
            url: 'modules/picklist/' + me.name + '/' + file,
            success: function (data) {
                callback(true, data);
            },
            error: function () {
                callback(false);
            }
        });
    }

    /**
     * Das Template in HTML schreiben!
     */
    writeTemplate() {

        var me = this;

        // HTML schreiben!
        me.container.html(me.templateHtml);

    }

    /**
     * Log Funktion nur bei Debug
     * 
     */
    log(content, color) {

        var me = this;
        color = color || false;

        // Debug?
        if (me.debug) {

            if (color && typeof content == 'string') {

                // Farbe
                var colors = [
                    '',
                    '#f1c40f',
                    '#9b59b6',
                ];


                console.log('%c ' + content, 'color: ' + colors[color]);

            } else {
                console.log(content);
            }
        }

    }




    /**
     * FILTER 
     * 
     */

    /**
     * 
     */
    getFilter() {

        /*
        // Gibt alle gesetzten Filter zurück
        me.DataTable.columns().every( function (index, value) {
            me.DataTable.column(index).search('');
        });
        */
    }

    // Filter hinzufügen
    setFilter(filterObj, noGui) {

        var me = this;

        // Ob die Gui noch gesetzt werden muss
        noGui = noGui || false;

        // HIER SOLLTE NOCH GEPRÜFT WERDEN, OB SICH DER FILTER VOM AKTUELLEN FILTER UNTERSCHEIDET!
        // FALLS NEIN, DANN SOLLTE NICHTS PASSIEREN UM PERFORMANCE ZU SPAREN

        // Prüfen
        if (!filterObj instanceof PickFilter) {
            throw new Error("Hier muss ein FilterObject übergeben werden!");
        }

        // Das Filter Objekt
        me.settings.filter = filterObj;

        // Filter hinzufügen
        me.applyFilter();

        // Wenn Set Filter von außen angesteuert wurde
        // dann muss die GUI zurückgesetzt werden. 
        // Dies passiert automatisch. Nur wenn man dies explizit nicht möchte, dann gibt man dies an.
        if (!noGui) {

            // Filter GUI setzen
            picklistFilterHtml.resetFilterGui(me);
        }
    }



    /**
    * Filter zurücksetzen
    */
    resetFilter(soft) {

        var me = this;

        soft = soft || false;

        console.log('-- Reset Filter');
        console.log(me.settings.startFilter);

        // Start Filter setzen!
        me.settings.filter = me.settings.startFilter;

        // Gui Zurücksetzen
        picklistFilterHtml.resetFilterGui(me, soft);

        // 
        me.container.trigger('reset-filter', [soft]);

        // Reset Filter?
        me.applyFilter();
    }

    applyFilter() {

        var me = this;

        // Wenn das Objekt 
        if (!$.isEmptyObject(me.settings.filter)) {

            // In den Text schreiben
            var resultText = me.settings.filter.toText(me);

            // HTML des Filters neu generieren!
            me.container.find('.filter-result').html(resultText + '<br><a class="filter-clear text-danger" href="javascript:void(0);"><i class="fa-solid fa-trash"></i> Filter löschen</i> ');

            // Filter Symbol Rot einfärben
            me.container.find('.dataTables_buttons [data-action="filter"]').addClass('text-danger');


            // Filter to Text
        } else {

            // Filter Symbol Rot zurücknehmen
            me.container.find('.dataTables_buttons [data-action="filter"]').removeClass('text-danger');

            // HTML des Filters neu generieren!
            me.container.find('.filter-result').html('<em>Die Tabelle wird aktuell nicht gefiltert.</em>');
        }

        // Tabelle zeichnen
        me.DataTable.draw();
    }


    /**
    * HTML für den Filter
    * 
    */
    generateFilterHtml() {

        var me = this;
        var index = 0;

        // Hier kommt das HTML der Filter dazu
        var subHtml = [];

        // Jedes Feld durchgehen
        $.each(me.settings.fields, function (key, value) {

            // Wenn der Filter gesetzt ist
            if (value.filter) {

                // Get Filter Html
                subHtml.push(picklistFilterHtml.getFilterHtml(me, key, value, index));
            }

            index++;
        });

        if (subHtml.length == 0) {
            subHtml.push("<div class=\"col-12\">Es stehen bei dieser Tabelle keine Filter zur Auswahl!</div>");
        }

        // Zusammenführen
        var newHtml =
            '<div id="form-' + me.id + '" class="sub-form" autocomplete="off">' +
            '<div class="row">' + subHtml.join('') + '</div>' +
            '</div>' +
            '<div class="filter-result">' +
            '<em>Die Tabelle wird aktuell nicht gefiltert.</em>' +
            '</div>';

        return newHtml;
    }

    initializeFilter() {

        var me = this;

        // Form initalisieren
        picklistFilterHtml.initForm(me);

        // Event Listner hinzufügen
        picklistFilterHtml.addListener(me);
    }

    /**
     * 
     * @param {String|Number} index Kann ein String oder eine Nummer sein
     */
    getField(index) {

        var me = this;
        var result = false;

        // Ob über den Namen oder den Index gesucht werden soll
        var searchByIndex = (isNaN(parseInt(index))) ? false : parseInt(index);

        $.each(me.settings.fields, function (key, value) {

            if (searchByIndex) {
                if (value.index == index) {
                    result = value;
                    return false;
                }
            } else {
                if (key == index) {
                    result = value;
                    return false;
                }
            }


        });

        return result;
    }

    /**
     * 
     */
    setReadonly(readonly) {

        var me = this;
        
        me.log('Set Readonly >' + readonly + '<');

        me.isReadonly = readonly;   

        // Buttons
        if(me.isReadonly) {
            me.container.find('.dt-react-to-readonly').addClass('dt-action-readonly');
        } else {
            me.container.find('.dt-react-to-readonly').removeClass('dt-action-readonly');
        }
    
        // Draw
        me.refresh();
    }

}

