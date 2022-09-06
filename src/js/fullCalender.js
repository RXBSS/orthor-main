/**
 * Das ist ein Klasse zur der Automatischen Erstellung von einem FullCalender in einer Card
 * 
 * 
 * ## getSettings
 * Defaultsettings -> wenn keine Settings angegeben werden werden diese übernommen
 * UserSettings -> wenn Settings über dem constructor angegeben werden dann werden diese gemergt und übernommen
 * 
 * 
 * ## Events
 * Random -> zeigt Random Views des Kalenders an
 * View -> verschiedene Views können ausgewählt werden
 * Refresh -> neu Laden
 * Today -> zeigt die aktuelle Woche, Tag,..
 * Prev -> geht eine Woche, Tag,... zurück
 * Next -> geht eine Woche, Tag,... nach vorne
 */

class FullCalendarCard {


    constructor(el, s, option) {

        var me = this;

        // Container
        me.container = $(el);

        // Prüfen ob der Container gefunden wird
        if(me.container.length > 0) {

            me.objSettings = option || {}; // Einstellungen die mit übergeben werden

            // Wenn es Settings gibt
            if(me.objSettings) {
                // DOM
                var html = '<div class="card">' + 
                    '<div class="card-body">' +
                        me.toolbar() +
                        '<div class="card-title"><h4><i class="fa-solid fa-calendar-alt"></i> <span class="cc-current"></span></h4 ></div>' +
                        '<div class="cc-calender"></div>' + 
                    '</div>' +
                '</div>';
            }

            // Rückgabe Toolbar an containter angehängt
            me.container.html(html);      

            // Settings abgleichen
            me.settings = me.getSettings(s); 
            
            // FullCalender init
            me.fc = new FullCalendar.Calendar(me.container.find('.cc-calender').get(0), me.settings);

            // Bootstrap Tooltip Initialisieren
            $('[data-bs-toggle="tooltip"]').each(function() {
                new bootstrap.Tooltip($(this)[0]);
            });

            // Rendering des FullCalender (native)
            me.fc.render();

            // EvenListener
            me.addEventlistener();

        // Fehlermeldung
        } else {
            throw new Error("Container ist nicht definiert");
        }

    }

    // CalendeSetting (ERWEITERBAR)
    getFullCalenderSettings() {
        var me = this;

        //Standards
        var defaults = {
            icon: true,                 // Icons
            card: true                  // Card ist immer angezeigt   
        };

        // Merge defautlts mit Übergabe 
        return $.extend({}, defaults, me.objSettings);
    }

    // Settings Abgleichen
    getSettings(userSettings) {

        // Defaultsettings wenn nichts angeben ist
        var defaultSettings = {
            headerToolbar: false,

            //Format
            initialView: 'timeGridWeek',
            locale: 'de',

            // Header Datumsanzeige
            datesSet: function(info) {
                var start = moment(info.start).format('DD.MM.YYYY');
                var ende = moment(info.end).format('DD.MM.YYYY');

                $('.cc-current').html((['listDay', 'dayGridDay', 'timeGridDay'].indexOf(info.view.type) >= 0) ? start : start + " - " + ende);
            },

            //Remove Scrollbar
            height:'auto',

            //Maximale Zeit die angezeigt werden soll
            slotMinTime: '06:00:00',
            slotMaxTime: '20:00:00',

            // Arbeitszeit
            businessHours: {
                daysOfWeek: [1, 2, 3, 4, 5],
                startTime: '07:00',
                endTime: '16:30',
            },

            // Linie zwischen den Zeilen
            expandRows: true,

            // Events können sich überlappen
            eventOverlap: true,

            selectable: true
        }

        // Merge DefaultSettings mit den UserSettings die mitgegeben werden
        return $.extend({}, defaultSettings, userSettings);
    }

    // EventListener
    addEventlistener() {

        var me = this;

        // Random ()
        me.container.on('click', '.cc-random-view', function() {
            var views = [false, 'listDay', 'listWeek', 'listMonth', 'dayGridDay', 'dayGridWeek', 'dayGridMonth', 'timeGridDay', 'timeGridWeek'];
            var random = Math.floor(Math.random() * 8) + 1;
            me.fc.changeView(views[random]);
        });

        // 
        me.container.on('click', '.cc-btn-change-view', function() {
            var view = $(this).data('view');
            me.fc.changeView(view);
        });

        // Next
        me.container.on('click', '.cc-btn-next', function() {
            me.fc.next();
        });

        // Prev
        me.container.on('click', '.cc-btn-prev', function() {
            me.fc.prev();
        });

        // Today
        me.container.on('click', '.cc-btn-today', function() {
            me.fc.today();
        });

        // Refresh
        me.container.on('click', '.cc-btn-refresh', function() {
            me.fc.refetchEvents();
            app.notify.info.fire("Neu geladen", "Die Events wurden neu gelanden!");
        });

    }

    toolbar() {
        var me = this;

        // Prüft ob es actions gibt
        me.actions = me.container.find('.actions');

        var getFullCalenderSettings = me.getFullCalenderSettings();

        // HTML generieren
        var html = '<div class="actions" style="z-index: 999;">';

            // Default Icons werden geladen
            if(getFullCalenderSettings.icon) {

                // Wenn es eigene Actions gibt (+ User Icons)
                if(me.actions.length) {
                    html += me.actions.prepend().html();
                } 

                html += 
                    '<a class="action-item fc-icons" href="javascript:void(0);" id="dropdownMenu2" data-bs-toggle="dropdown" data-bs-placement="top"><i class="fa-solid fa-eye"></i></a>' +
                    '<ul class="dropdown-menu" aria-labelledby="dropdownMenu2" style="inset: 0px auto auto -30px;">' + 
                        '<li><button class="dropdown-item cc-btn-change-view" data-view="listDay" type="button">Liste Tag</button></li>' + 
                        '<li><button class="dropdown-item cc-btn-change-view" data-view="listWeek" type="button">Liste Woche</button></li>'+
                        '<li><button class="dropdown-item cc-btn-change-view" data-view="listMonth" type="button">Liste Monat</button></li>'+
                        '<li><button class="dropdown-item cc-btn-change-view" data-view="dayGridDay" type="button">Kacheln Tag</button></li>'+
                        '<li><button class="dropdown-item cc-btn-change-view" data-view="dayGridWeek" type="button">Kacheln Woche</button></li>'+
                        '<li><button class="dropdown-item cc-btn-change-view" data-view="dayGridMonth" type="button">Kacheln Monat</button></li>'+
                        '<li><button class="dropdown-item cc-btn-change-view" data-view="timeGridDay" type="button">Zeit Tag</button></li>'+
                        '<li><button class="dropdown-item cc-btn-change-view" data-view="timeGridWeek" type="button">Zeit Woche</button></li>'+
                    '</ul>' +
                    '<a class="action-item cc-btn-refresh fc-icons" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Neu Laden"><i class="fa-solid fa-sync"></i></a>'+
                    '<a class="action-item cc-btn-today fc-icons" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Heute"><i class="fa-solid fa-calendar-day"></i></a>'+
                    '<a class="action-item cc-btn-prev fc-icons" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Vorheriger Tag"><i class="fa-solid fa-angle-left"></i></a>'+
                    '<a class="action-item cc-btn-next fc-icons" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Nächste Tag"><i class="fa-solid fa-angle-right"></i></a>';
                        
            // Eigene Icons werden geladen (Nur User Icons)
            } else {

                // Wenn es eigene Actions gibt
                if(me.actions.length) {
                    html += me.actions.prepend().html();
                } 
                            
            }
        html += '</div>';
    
        return html;
    }
}