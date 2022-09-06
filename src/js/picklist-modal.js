/**
 * Erweiterung der Pickliste durch ein Modal 
 * Hier kommen ein paar Themen dazu, die beachten werden müssen.
 * 
 * 
 * - Viele der Standard-Einstellungen werden noch einmal überschrieben, da Sie im Kontext des Modals nicht so viel Sinn machen, bzw. angepasst werden müssen
 * - Dazu gibt es spezielle Merge Funktionen
 * - Es gibt keinen Container, dieser wird dynamisch am Ende der Seite erstellt
 * - Es gibt mehrere Funktionen und Optionen die nur beim Modal zur Verfügung stehen
 * - - Quick Select, Open, Close, ....
 * 
 * 
 * 
 * 
 */
class PicklistModal extends Picklist {

    // Constructor
    constructor(name, s) {

        // Constuctor aus der alten Klasse auswählen
        super(false, name, s);


    }

    /**
     * Init Funktion überschreiben, da hier zunächst der Container für das Modal erstellt werden muss
     * 
     */
    init(container, name, s) {

        var me = this;

        // Container erstellen
        me.modalId = 'modal-' + me.id;

        // Erstelle das Modal 
        $('body').append('<div class="modal dt-modal" id="' + me.modalId + '" tabindex="-1"></div>');

        // Container überschreiben
        container = '#' + me.modalId;

        // Default initalisieren
        me.initDefault(container, name, s);
    }

    /**
     * Template Erstellen
     */
    createTemplateFromConfig() {

        var me = this;

        var html = '';

        html +=

            // Beginn Modal
            '<div class="modal-dialog modal-xl">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<h5 class="modal-title"></h5>' +
            '<div class="dt-modal-actions"></div>' +
            '</div>' +
            '<div class="modal-body">' +

            // Filter
            '<div class="dt-filter">' + me.generateFilterHtml() + '</div>' +

            // Beginn der Tabelle
            '<div class="table-responsive">' +
            '<table class="table table-hover">' +
            '<thead class="thead-default">' +
            '<tr>' +
            '<th><i class="fa-solid fa-check-double"></i></th>';

        $.each(me.configFile.fields, function (index, value) {
            html += "<th>" + value.title + "</th>";
        });

        html += '</tr>' +
            '</thead>' +
            '</table>' +

            // Modal
            '</div>' +
            '</div>' +
            '<div class="modal-footer d-flex justify-content-between">' +
            '<div class="pagination-container"></div>' +
            '<div class="dt-buttons">' +

            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';

        return html;
    }

    initCompleteInternal() {

        var me = this;

        // Pagination an anderen Platz setzen
        me.container.find('.dataTables_paginate').appendTo(me.container.find('.pagination-container'));

        // Modal Instanz erstellen
        me.modal = new bootstrap.Modal(document.getElementById(me.modalId), {
            keyboard: false
        });

        // Title anoassen
        me.container.find('.modal-title').html((me.settings.showTitle) ? me.settings.title : "");



        // Oberen Buttons hinzufügen
        // me.container.find('.dt-modal-actions').html('<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-modal-close"></i></button>');   

        me.setModalButtons();

        // Standard Themen während des Initalisierens
        // ######################
        me.initCompleteDefault();



        // Zusätzlichen Schließen Button hinzufügen
        me.container.find('.dt-modal-actions').append('<a class="action-item dt-action btn-dt-close" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Text"><i class="fa-solid fa-times"></i></a>');




    }

    /**
     * Modal öffnen
     */
    open(callback, waitFor) {

        var me = this;

        // Variable um zu prüfen ob vor dem Laden geklickt wurde
        callback = callback || false;
        waitFor = waitFor || false;

        if (me.modal) {

            // Modal öffnen 
            me.modal.show();

            // Modal Callback
            me.modalCallback = callback;

            // Wenn das Modal noch nicht bereit ist
        } else {

            // 100 ms warten
            setTimeout(function () {
                me.open(callback, true);
            }, 100);
        }
    }


    /**
     * Modal schließen
     */
    close() {
        var me = this;
        me.modal.hide();

        if (me.modalCallback && typeof me.modalCallback == 'function') {
            me.modalCallback('close');
        }
    }

    setButtonsFrame() {
        var me = this;
        me.buttonFrame = me.container.find('.dt-modal-actions');
    }

    // Die zusätzlichen Button
    setModalButtons() {

        var me = this;

        // Buttons hinzufügen
        me.container.find('.dt-buttons').append('<button type="button" class="btn btn-secondary btn-dt-close" aria-label="Close">Schließen</button>');

        // Auswahl Button

        if (me.settings.select === true || me.settings.select === 'single') {
            me.container.find('.dt-buttons').append('<button type="button" class="btn btn-primary btn-dt-submit" ' + ((me.settings.submitButton) ? '' : 'style="display:none;"') + ' disabled>Auswählen</button>');
        } else if (me.settings.select === 'multi') {
            me.container.find('.dt-buttons').append('<button type="button" class="btn btn-primary btn-dt-submit" ' + ((me.settings.submitButton) ? '' : 'style="display:none;"') + ' disabled>0 Auswählen</button>');
        }


    }

    addListner() {

        var me = this;

        me.addListnerDefault();

        // Event Listner für den Search Fokus anhängen
        me.container.on('shown.bs.modal', function (event) {

            // Suche Fokussieren, wenn die Einstellung hinterlegt ist!
            if (me.settings.searchFocus) {
                me.focusSearch();
            }

            // Columns neu anordnen, wg der Breite
            me.redraw();

        });

        // Modal schließen
        me.container.on('click', '.btn-dt-close', function () {
            me.close();
        });

        // Wenn jemand den Submit Button bestätigt!
        me.container.on('click', '.btn-dt-submit', function () {
            me.pick();
        });


    }

    setSelected(isSelected) {

        var me = this;

        // Standard Select
        me.setSelectedDefault(isSelected);

        // Beim einer Single Picklist				
        if (me.settings.select === true || me.settings.select === 'single') {

            if (me.selected === false) {
                me.container.find('.btn-dt-submit').prop('disabled', true);
            } else {
                me.container.find('.btn-dt-submit').prop('disabled', false);

                // Wenn etwas gewählt wurde
                if (me.settings.quickPick) {
                    me.pick();
                    me.resetSelected();
                }
            }

            // Bei einer Multi Picklist
        } else {

            var keys = Object.keys(me.selected);

            if (keys.length > 0) {
                me.container.find('.btn-dt-submit').prop('disabled', false).html(keys.length + ' Auswählen');
            } else {
                me.container.find('.btn-dt-submit').prop('disabled', true).html('0 Auswählen');
            }
        }

    }

    pick(data) {

        var me = this;

        // Default Pick
        me.pickDefault(data);

        if (me.modalCallback && typeof me.modalCallback == 'function') {
            me.modalCallback('pick', me.selected);
        }

        // Schließem
        me.modal.hide();

        // Reset
        me.reset();
    }


    /**
     * EINSTELLUNGEN
     * // MARK: Einstellungen
     * 
     * 
     * #######################################################
     * 
     */
    /**
     * Einstellungen die überschrieben werden vom Modal
     * 
     * @param {Object} defaults Einstellungen die als Standard getroffen wurden
     * @returns 
     */
    mergeModalDefaultSettings(defaults) {

        defaults.title = "Liste";
        defaults.showTitle = true,
            defaults.card = false;
        defaults.description = false;
        defaults.quickPick = false;

        return defaults;
    }

    /**
     * Einstellungen die überschrieben werden vom Modal
     * 
     * @param {Object} defaults Einstellungen die als Standard getroffen wurden
     * @returns 
     */
    mergeModalDtDefaultSettings(defaults) {

        defaults.pageLength = 15;
        defaults.lengthMenu = [[15, 50, 100], ['15 Zeilen', '50 Zeilen', '100 Zeilen']];

        return defaults;
    }

    /**
     * Typen Einstellungen (single-picklist, ....)
     */
    mergeModalTypeSettings(defaults, type) {

        var me = this;
        me.log('----> Merge Modal Type Settings', 1);

        if (type == 'single-picklist') {
            defaults.title = "Liste zum Auswählen";
        }

        // Überschreibt, dass es beim Modals keine Beschreibung gibt!
        defaults.description = false;

        // Log
        me.log(defaults);

        return defaults;
    }



}


