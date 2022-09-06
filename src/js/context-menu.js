/**
 * Erstellt ein Context-Menü für ein DIV. 
 * 
 * 
 * 
 */
class ContextMenu {

    /**
     * Erstellen des Context-Menüs
     * 
     * @param {String} selector Der CSS Selector für den Bereich, in dem das Context-Menü erscheinen soll
     * @param {Object} options Diverse Optionen die angegeben werden können
     */
    constructor(selector, options) {

        var me = this;

        me.container = $(selector);

        if (!me.container.length) {
            throw new Error("Container wurde nicht gefunden!");
        }

        // Einstellungen
        me.settings = $.extend({}, {
            childSelectorClass: false,
            html: false,
            contextSelector: false,
            theme: false
        }, options);

        // Child Element
        me.child = false;

        // Popup HTML normalisieren
        me.getPopUp();

        // Event Listner hinzufügen
        me.addListner();

        // Context Menü Theme
        me.setTheme();

    }

    // On Right Click
    addListner() {

        var me = this;

        // Container
        me.container.on('contextmenu', function (e) {

            // Nur wenn die Option angegeben ist
            if(me.settings.childSelectorClass) {
                $.each(e.originalEvent.path, function(index, value) {
                    if($(value).hasClass(me.settings.childSelectorClass)) {
                        me.child = $(value);
                    }
                });
            }

            e.preventDefault();
            me.open(e.pageX, e.pageY);
        });

        // Bei einem Klick überall hin
        $(window).on('click', function (e) {

            // Bei einem Klick überall hin außer auf das PopUp
            if (!$(e.target).is(me.popup) && !$(e.target).closest('.context-menu').is(me.popup)) {
                me.close();
            }
        });

        // Dropdown Item
        me.popup.on('click', '.dropdown-item', function() {

            var element = $(this);
            
            me.container.trigger('pick', [element, me.child]);

            var action = element.data('action');

            // Event Listner
            if(action) {
                me.container.trigger('action', [element, action, me.child]);
            }


            me.close();
            
            return false;
        });
    }


    on(event, cb) {
        var me = this;
        me.container.on(event, cb);
    }

    getPopUp() {

        var me = this;


        // Initalisieren via JavaScript
        if(me.settings.html) {

            // Wenn es ein Objekt ist
            if(typeof me.settings.html == 'object') {

                me.settings.contextSelector = me.settings.contextSelector || 'context-' + moment().format('x');

                var build = '<ul id="' + me.settings.contextSelector + '" class=\"dropdown-menu context-menu">';

                // Generate HTML
                $.each(me.settings.html, function(index, value) {
                    if(value == 'hr') {
                        build += '<li><hr class="dropdown-divider"></li>';
                    } else {
                        build += '<li><a class="dropdown-item" href="javascript:void(0);" ' + ((value.action) ? 'data-action="' + value.action + '"' : '') + '>'; 
                        build += ((value.icon) ? '<i class="' + value.icon + '"></i>' : '');
                        build += ((value.text) ? value.text : '');
                        build += '</a></li>';
                    }
                }); 

                build += '</ul>';


                me.settings.contextSelector = '#' + me.settings.contextSelector;

                $(build).appendTo('body');

                me.popup = $('body').find(me.settings.contextSelector);

            // Wenn es ein String ist
            } else {

                // 
                if(!me.settings.contextSelector) {
                    throw new Error("Es wurde kein Context Selector mitgegeben.");
                }

        
                $(me.settings.html).appendTo('body');
                me.popup = $('body').find(me.settings.contextSelector);

                

            }   

        // Externer Container
        } else if(me.settings.contextSelector) {

            if($(me.settings.contextSelector).length) {
                
                me.popup = $(me.settings.contextSelector);
                me.popup.detach().appendTo('body');

            } else {
                throw new Error("Context Selector nicht gefunden!");
            }


        // Über die Vorlage
        } else if (me.container.find('.context-menu').length) {

            // Context Menü
            me.popup = me.container.find('.context-menu');
            me.popup.detach().appendTo('body');

            // Dynamisch generieren
        } else {
            throw new Error("Kein Dropdown gefunden!");
        }

        if(!me.popup.length) {
            throw new Error("PopUp wurde nicht richtig definiert!");
        }


    }


    // 
    open(x, y) {

        var me = this;

        x = x || false;
        y = y || false;

        // Sollte dies überhaupt möglich / notwendig sein?
        if (!x || !y) {
            // TODO: Hier muss noch die Maus-Position ermittelt werden?
        }

        me.popup.css({
            top: y,
            left: x
        });

        // Anzeigen
        me.popup.addClass('show');

    }

    close() {
        var me = this;
        me.popup.removeClass('show');
    }

    setTheme() {
        var me = this;


        // Prüfen ob das Dunkle Theme gesetzt werden soll
        if(me.settings.theme) {
            if(me.settings.theme == 'dark') {
                me.popup.addClass('dropdown-menu-dark');
            } else {
                me.popup.removeClass('dropdown-menu-dark');
            }
        }
    }

}