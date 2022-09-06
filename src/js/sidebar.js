class Sidebar {

    constructor(config) {

        var me = this;

        // Settings
        me.settings = $.extend({}, {
            name: 'sidebar-' + moment().format('x'),
            width: 300,
            noClose: false,
            clickToClose: false, 
            actionButton: false
        }, config);

        // Sidebar erstellen
        me.container = $('body').find('#' + me.settings.name);

        // Wenn der Container noch nicht existiert
        if (!me.container.length) {

            // Neues Tempalte erstellen
            var html = me.createTemplate();

            // In den Body hinzufügen
            $('body').append(html);

            // Container anpassen
            me.container = $('body').find('#' + me.settings.name);
        }

        // CSS anpassen
        me.container.css({
            'width': me.settings.width + 'px',
            'margin-right': '-' + me.settings.width + 'px',
            'display': 'none'
        });

        // Event Listner
        me.addListner();
    }

    createTemplate() {

        var me = this;

        // Standard HTML
        var html = '<aside id="' + me.settings.name + '" class="sidebar sidebar-right">';

        if (!me.settings.noClose) {
            html += '<div class="sidebar-actions">' +
                '<a class="action-item btn-close-sidebar" href="javascript:void(0);"><i class="fa-solid fa-times"></i></a>' +
                '</div>';

        }
        html += '<div class="sidebar-inner">' +

            '</div>' +
            '</aside>';

        return html;
    }

    // Event Listner
    addListner() {

        var me = this;

        // Schhließen
        me.container.on('click', '.btn-close-sidebar', function () {
            me.close();
        });

        if (me.settings.clickToClose) {

            // Schhließen
            $(window).on('click', function (e) {

                if (!$(e.target).is('#' + me.settings.name) && !$(e.target).closest('#' + me.settings.name).length && me.isOpen()) {
                    me.close();
                }
            });
        }

        // Wenn ein Action Button verknüpft ist
        if(me.settings.actionButton) {

            // Klick
            me.settings.actionButton.on('click', function() {
                me.toggle();
            });
        }


    }

    /**
     * Event Listner
     * 
     */
    on(event, cb) {
        var me = this;
        me.container.on(event, cb);
    }

    isOpen() {
        var me = this;
        return (me.container.css('marginRight') == "0px") ? true : false;
    }
    
    toggle() {
        var me = this;

        if(me.isOpen()) {
            me.close();
        } else {
            me.open();
        }
    }

    // Sidebar öfnen
    open() {

        var me = this;

        // Inital anzeigen
        me.container.show();

        // Alle offenen Sidebars ausblenden
        $('body').find('.sidebar.sidebar-right').each(function (index, value) {

            // Wenn es nicht die ID ist
            if ($(this).attr('id') != me.name && $(this).css('marginRight') == "0px") {

                // Prüfen ob noch andere Sidebars geöffnet sind
                $(this).css('margin-right', '-' + $(this).css('width'));
            }
        });

        // Prüfen ob noch andere Sidebars geöffnet sind
        me.container.css('margin-right', '0px');

        // Open
        me.container.trigger('open', []);
    }

    // Sidebar schließen
    close() {

        var me = this;

        // Prüfen ob noch andere Sidebars geöffnet sind
        me.container.css('margin-right', '-' + me.settings.width + 'px');

        // Open
        me.container.trigger('open', []);
    }

    setHtml(html) {
        var me = this;
        me.container.find('.sidebar-inner').html(html);
    }

    setLoading() {
        var me = this;
        me.setHtml('<div class="sidebar-loader"><i class="fa-solid fa-circle-notch fa-3x fa-spin"></i></div>');
    }

    getEl() {
        var me = this;
        return me.container.find('.sidebar-inner');
    }

}