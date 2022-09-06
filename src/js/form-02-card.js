// Klasse für eine Card
class CardForm extends Form {

    /**
     * Erstellt eine Form in einer Card
     * 
     * @param {String} container Der Selector der Form
     * @param {String} [card=false] Der Selector der Card. Wenn keine angegeben wird, dann wird die nächste übergeordnete genommen.
     * @param {Boolean} [debug=false] Ob Debug aktiv ist oder nicht 
     */
    constructor(container, opts) {

        // Constructor aus der ersten Funktion ausrufen
        super(container, opts);
    }


    init() {

		var me = this;

        me.log('Card - Init');
		
        // Card herausfinden
        me.container = (me.cardSelector) ? $(me.cardSelector) : me.container.closest('.card');

		// Default initalisieren
        me.initDefault();

        // Action suchen
        me.actions = me.container.children('.card-body').children('.actions');

        // Action Container anlegen, falls es nicht exisitert
        if (me.actions.length == 0) {
            me.container.children('.card-body').prepend('<div class="actions"></div>');
            me.actions = me.container.children('.card-body').children('.actions');
        }

        // Streifen an der Karte hinzufügen
        me.container.addClass('card-form');

        // Buttons hinzufügen
        me.actions.append(
            '<a class="action-item btn-form-loading" href="javascript:void(0);" style="display:none;"><i class="fa-solid fa-circle-notch fa-spin"></i></a>' +
            '<a class="action-item btn-form-edit" href="javascript:void(0);"><i class="fa-solid fa-edit"></i></a>' +
            '<a class="action-item btn-form-discard" href="javascript:void(0);" style="display:none;"><i class="fa-solid fa-times"></i></a>' +
            '<a class="action-item btn-form-save" href="javascript:void(0);" style="display:none";><i class="fa-solid fa-save"></i></a>'
        );

        // Standardmäßig auf Read Only setzen
        me.setReadonly(true);

        me.container.trigger('initComplete');

	}


    /**
     * Die Event-Listener die es nur bei der Card gibt
     */
    addEventListner() {

        var me = this;

        me.defaultAddEventListener();

        me.log('Card - Add Event Listners');

        // Edit
        me.container.on('click', '.btn-form-edit', function () {
            me.enable();
        });

        me.container.on('click', '.btn-form-discard', function () {
            me.discard();
        });
    }

    saving() {

        var me = this;


        me.log('Card - Saving');

        // Buttons ein- und Ausblenden
        me.actions.find('.btn-form-edit').hide();
        me.actions.find('.btn-form-discard').hide();
        me.actions.find('.btn-form-save').hide();
        me.actions.find('.btn-form-loading').show();

        me.setStatusGui('saving');

        // 
        me.defaultSaving();
    }


    saved(error) {

        var me = this;

        me.log('Card - Saved >' + error + '<');

        // Buttons ein- und Ausblenden
        me.actions.find('.btn-form-loading').hide();

        if(error) {
            
            me.setReadonly(false);

            // Edit Button wieder einblenden
            me.actions.find('.btn-form-discard').show();
            me.actions.find('.btn-form-save').show();

        } else {

            // Edit Button wieder einblenden
            me.actions.find('.btn-form-edit').show();
        }

        me.setStatusGui(((error) ? "error" : "saved"), "border 200ms ease-out");


        // Zeige wieder den grauen Rahmen an
        setTimeout(function () {

            me.setStatusGui("default", "border 200ms ease-out");

            // FormValidatoin zurücksetzen
            me.reset(2);

        }, 1000);


        // 
        me.defaultSaved();
    }

    // Laden
    load(task, file, data, callbackSuccess, callbackError) {
		
        var me = this;
		
        // Buttons ein- und Ausblenden
        me.actions.find('.btn-form-edit').hide();
        me.actions.find('.btn-form-discard').hide();
        me.actions.find('.btn-form-save').hide();
        me.actions.find('.btn-form-loading').show();

		me.defaultLoad(task, file, data, callbackSuccess, callbackError);
	}

    // Laden fertig
    loadFinished() {

		var me = this;

        me.actions.find('.btn-form-loading').hide();
        
        // Buttons ein- und Ausblenden
        me.actions.find('.btn-form-edit').show();
        me.actions.find('.btn-form-discard').hide();
        me.actions.find('.btn-form-save').hide();
	}

    /**
     * Enable Form
     * 
     */
    enable() {

        var me = this;

        me.log('Card - Enable');

        // Streifen einfärben
        me.setStatusGui("enable");

        // Buttons ein- und Ausblenden
        me.actions.find('.btn-form-edit').hide();
        me.actions.find('.btn-form-discard').show();
        me.actions.find('.btn-form-save').show();

        // Fokus First Field
        me.container.find('input').each(function () {
            if ($(this).attr('type') != 'hidden') {
                $(this).focus();
                return false;
            }
        });

        // Readonly setzen
        me.setReadonly(false);

        
        me.container.trigger('enable');

    }


    discard() {

        var me = this;

        me.log('Card - Discard');

        // Set Read Only to False
        me.setReadonly(true);

        // Streifen einfärben
        me.setStatusGui("default", "border 200ms ease-out");

        // Buttons ein- und Ausblenden
        me.actions.find('.btn-form-edit').show();
        me.actions.find('.btn-form-discard').hide();
        me.actions.find('.btn-form-save').hide();

        // 
        me.reset(0);

        // Wenn es einen Callback für das Ende Event gibt
        me.container.trigger('discard');
        me.container.trigger('end', [false]);

    }

    // Setze die Farben (momentan nur bei den Karten)
    setStatusGui(status, transition) {

        var me = this;

        me.log('Card - Set Status GUI');

        // Status Array
        var colors = {
            saving: "#f1c40f",
            saved: "#7AB929",
            error: "#e67e22",
            default: "#aaa",
            enable: "#e74c3c"
        };

        me.container.css("transition", "none").css("transition", (transition) ? transition : "none").css("border-color", colors[status]);
    }
}