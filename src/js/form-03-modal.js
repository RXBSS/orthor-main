// Klasse für ein Modal
class ModalForm extends Form {
    
    // Constructor
    constructor(container, debug) { 
        super(container, debug);
	}

    /**
     * Init Funktion überschreiben
     */
    init() {

        var me = this;

        // Form Container anpassen
        me.container = me.container.closest('.modal');

        // Default Init
        me.initDefault();

        me.log('Modal - Init');

        // Modal Instanz
        me.modal = new bootstrap.Modal(me.container.get(0), {
            keyboard: false,
            backdrop: 'static'
        });


        // Actions
        me.actions = me.container.find('.modal-header .actions');	
        
        // Buttons hinzufügen
        me.actions.append(
            '<a class="action-item btn-schliessen" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Text"><i class="fa-solid fa-times"></i></a>'
        );

        // Fuß hinzufügen
        me.container.find('.modal-footer').append(
            '<button type="button" class="btn btn-secondary btn-schliessen">Schließen</button>' + 
            '<button class="btn btn-success btn-form-save">Speichern</button>' 
        );

        me.container.trigger('initComplete');
    }

    // Event Listner hinzufügen
    addEventListner() {

        var me = this;

        // Default Event Listner hinzufügen
        me.defaultAddEventListener();

        me.log('Modal - Add Event Listner');

        // Button zum schließen
        me.container.on('click', '.btn-schliessen', function() {
            me.close();
        });

        // Button zum Speichern
        me.container.on('click', '.btn-form-save', function() {
            // me.modal.hide();
        });


    }

    // Laden
    load(task, file, data, callbackSuccess, callbackError) {
            
        var me = this;

        // Full Loader
        // 

        me.defaultLoad(task, file, data, callbackSuccess, callbackError);
    }

    // Laden fertig
    loadFinished() {
        
        var me = this;

        // Finished
        // 
    }

    // Laden und öffnen
    loadAndOpen(task, file, data, callbackSuccess, callbackError) {

        var me = this;

        app.alert.loader.fire();

        // Callback
        me.load(task, file, data, function(data) {

            // Öffnen
            me.open();

            app.alert.loader.close();

            // Callback
            if(typeof callbackSuccess == 'function') {
                callbackSuccess(data);
                
            }

        }, callbackError);
    }

    /**
     * Modal öffnen
     */
    open() {
        
        var me = this;

        // Zurücksetzen
        me.reset(2);

        // Modal anzeigen
        me.modal.show();
    }

    /**
     * Close
     */
    close() {

        var me = this;

        if(!me.isSaving) {

            // Modal schließen
            me.modal.hide();

            // Zurücksetzen
            me.reset(0);
        
        // Während des Speicherns darf nicht geschlossen werden!
        } else {
            // Optional eine Meldung
        }
    }

    saved(error) {

		var me = this;

        // Modal zurücksetzen
        if(!error) {
            me.modal.hide();
        }

		// 
		me.defaultSaved(error);

		// Read Only auf False setzen
		me.setReadonly(false);
	}
}