

/**
 * Todo Initalisieren
 */
class ToDo {

    constructor() {

        var me = this;

        // Neuen Action Button erstellen
        me.actionButton = new Notification({
            icon: 'fas fa-check',
            color: 'success',
            blink: true
        });

        // Neue Sidebar erstellen
        me.sidebar = new Sidebar({
            width: 370,
            clickToClose: true,
            noClose: true,

            // Action Button mit Sidebar verlinken
            actionButton: me.actionButton
        });

        // Render
        me.render();

    }

    initContextMenu() {

        var me = this;

        var el = me.sidebar.container.find('#todo-list');

        me.contextMenu = new ContextMenu(el, {
            theme: 'dark',
            childSelectorClass: 'list-group-item',
            html: [ {
                icon: 'fas fa-check-double',
                text: 'Erledigt markieren',
                action: 'erledigt'
            },{
                icon: 'fas fa-external-link-alt',
                text: 'Anzeigen'
            },'hr', {
                icon: 'fas fa-history',
                text: 'Zurückstellen'
            }, {
                icon: 'fas fa-user-friends',
                text: 'Abgeben'
            }, {
                icon: 'fas fa-people-arrows',
                text: 'Deligieren'
            }]
        });

        // 
        me.contextMenu.on('action', function(e, context, action, child) {

            // ID
            var id = child.data('todo-id');

            // Action
            me.action(action, id);
        });

    }


    render() {

        var me = this;

        // Setze Loading
        me.sidebar.setLoading();

        // Simple Request
        app.simpleRequest("get", "todos-handle", null, function (response) {

            // Überschrift
            var html = '<h3><i class="fa-solid fa-check"></i> To-Do\'s</h3>';
                    
            // Response
            if(response.data.length > 0) {

                html += '<ul id="todo-list" class="list-group">';

                // For Each
                $.each(response.data, function(key, value) {


                    html += '<a href="javascript:void(0);" data-todo-id="' + value.id + '" class="list-group-item list-group-item-action">' +
                    '<div class="d-flex w-100 justify-content-between">' +
                    '<h5 class="mb-1">' + ((value.icon) ? '<i class="' + value.icon + '"></i> ' : '') + value.titel + '</h5>' +
                    '<small class="text-muted">3 days ago</small>' +
                    '</div>' + '<p class="mb-1">' + value.text + '</p>' +
                    // '<small class="text-muted">And some muted small print.</small>' +
                    '</a>';

                }); 

                html += '</ul>';

            } else {
                html += "<br><br><br><center><i class='fas fa-check-double fa-3x' style='color: #AAA;'></i><br><em style='color: #AAA;'><br>Keine aktuellen Aufgaben</em></center><br><br><br>";
            }

            html += '<br><center><a href="todos">Alle Aufgaben anzeigen</a></center>';

            // Setzte Context Menü
            me.sidebar.setHtml(html);


            if(response.data.length > 0) {

                // Context-Menü
                me.initContextMenu();

            }
        });
    }

    action(action, id) {

        var me = this;

        // Wenn erledigt
        if(action == 'erledigt') {
            me.setComplete(id);
        }

    }

    // 
    setComplete(id) {

        var me = this;

        me.sidebar.setLoading();

        // Remove
        app.simpleRequest("set-complete", "todos-handle", id, function(response) {
            me.render();
        });
    }





}