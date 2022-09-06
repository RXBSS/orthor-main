class Timeline {

    constructor(el, s) {

        var me = this;

        me.container = $(el);

        // Prüfen, dass der Container existiert
        if (!me.container.length) {
            console.error('Der Container wurde nicht gefunden');
        }

        me.interval = false;

        // Settings
        me.settings = $.extend({}, {
            dateFormat: 'DD.MM.YYYY',
            timeFormat: 'HH:mm',
            debug: false,
            showZeroTime: false,
            parseFormat: false,
            interval: false
        }, s);

        // Wenn das Datum als Text angegeben wurde, dann wird automatisch aktualisiert
        if(me.settings.dateFormat == 'text' && typeof s.interval == 'undefined') {
            me.settings.interval = 60;
        }


        // Daten initalisieren
        me.data = [];

        me.addListner();
    }

    addListner() {
        var me = this;

        // Click
        me.container.on('click', 'li', function() {

            // Daten auslesen
            var data = JSON.parse(window.atob($(this).data('json')));

            // Als Moment Objekt konvertieren
            data.moment = (data.timestamp) ? ((me.settings.parseFormat) ? moment(data.timestamp, me.settings.parseFormat, true) : moment(data.timestamp)) : false;

            // Event feuern
            me.container.trigger('select', [data]);
        });
    }

    on(event, cb) {
        var me = this;
        me.container.on(event, cb);
    }

    // Daten setzen
    setData(dataSet) {
        var me = this;
        me.data = dataSet;
        return me;
    }

    setDataFromAjax(opts, callback) {

        var me = this;

        var sendData = opts.data || {};

        $.ajax({
            type: 'POST',
            url: opts.url,
            dataType: 'json',
            data: sendData,
            success: function(result) {
       
                me.data = result['data'];

                // Wenn es einen Callback gibt
                if(typeof callback == 'function') {
                    callback(me);
                }
            },
            error: function() {
                throw new Error("Fehler beim Verarbeiten der Ajax Datei");
            }
        });
    }

    // Add Data
    addData(add) {

        var me = this;

        
        if(typeof add == 'object') {

            // Wenn es ein Object ist, dann dieses Objekt in das Array einfügen
            if (Array.isArray(add)) {
                
                me.data = add.concat(me.data);
            
            // Wenn es ein Array ist
            } else {

                var temp = me.data;

                temp.unshift(add);

                me.data = temp;
            }   
            
            
        } else {
            // Könnte man noch machen
            console.warn('Datentyp nicht unterstützt. Bitte Array mit Objekten oder ein einzelnes Objekt angeben');
        }

        return me;
    }

    render() {

        var me = this;

        // Wenn es Daten gibt
        if(me.data.length > 0) {

            // HTML generieren
            var html = "<ul class='timeline'>";

            // Jedes Element bearbeiten
            $.each(me.data, function (index, value) {

                if(value.timestamp) {
                    var timestamp = me.parseDate(value.timestamp);
                }   

                var temp = Object.create(value);
                temp.content = "";

                html += "<li class='" + ((value.class) ? value.class : '') + " "+ ((timestamp > moment() || !value.timestamp) ? 'tl-is-future' : 'tl-is-past') + "' data-json='" + window.btoa(JSON.stringify(temp)) + "'>";
                html += '<div class="tl-content">';
                
                // Wenn es Pre-Content gibt
                if(value.precontent) {
                    html += '<div class="tl-content-pre">' + value.precontent + '</div>';
                }

                // Main
                html += '<div class="tl-content-main">';
                html += '<div class="d-flex flex-row">';
                html += '<div class="tl-date">' + ((value.timestamp) ? me.renderDate(value.timestamp) : "<br>") + '</div>';
                html += '<div class="tl-circle"></div>';
                html += '<div class="tl-icon">' + ((value.icon) ? '<i class=\'' + value.icon + '\'></i>' : '') + '</div>';
                html += '<div class="tl-content-main-bubble">' + value.content + '</div>';
                html += '</div>';
                html += '</div>';

                // Wenn es SubContent gibt
                if(value.subcontent) {
                    html += '<div class="tl-content-sub">' + value.subcontent + '</div>';
                }

                html += '</div>';
                html += '</li>';
            });

            html += "</ul>";

            me.container.html(html);

        // Fehlermeldung, keine Daten
        } else {
            throw new Error("Es wurden keine Daten angegeben!");
        }

        // Sorgt dafür, dass alle X Sekunden die Liste aktualisiert wird
        // Dies macht nur Sinn, wenn Text angegeben ist
        if(!me.interval && me.settings.interval) {

            // Set Timeout
            me.interval = setInterval(function() {
                me.render();

            },1000 * me.settings.interval);
        }

        return me;
    }

    parseDate(timestamp) {
        var me = this;
        return (me.settings.parseFormat) ? moment(timestamp,me.settings.parseFormat, true) : moment(timestamp);
    }

    renderDate(timestamp) {
        
        // Init
        var me = this;
        var html = "";
        
        // Zeitstempel parsen
        var m = me.parseDate(timestamp);

        // Wenn es ein valider Zeitstempel ist
        if(m.isValid()) {

            // Content
            var content = [];

            // Wenn es als Text formatiert werden soll
            if(me.settings.dateFormat == 'text') {
               
                content = me.dateToText(m);

            // Wenn es kein Text ist
            } else  {

                // Prüfen ob es ein Datum gibt
                if(me.settings.dateFormat) {            
                    content.push(m.format(me.settings.dateFormat));
                }

                // Prüfen ob es mit Zeit angegeben werden soll
                if(me.settings.timeFormat) {

                    if(!(m.format('HH:mm:ss.SSS') == '00:00:00.000' && me.settings.showZeroTime === false) || me.settings.dateFormat === false) {
                        content.push(m.format(me.settings.timeFormat));
                    }
                }
            }

            // HTML übergeben
            html = "<span class='datum " + ((content.length > 1) ? "dual-line": "") + "'>" + content.join("<br>") + "</span>";

        } else {
            html = "<span class='datum'></span>";
        }
        
        
        return html;
    }



    /**
     * Was eine Funktion :)
     */
    dateToText(m) {

        var jetzt = moment();
        var d = m.diff(jetzt);

        // Auf Sekunden
        d = (d == 0 || (d <= 1000 && d >= -1000)) ? 0 : Math.floor(d / 1000);


        var content = false;

        // Differenz zum Tag ausmachen
        var zuMorgen = moment(jetzt.format('YYYY-MM-DD 23:59:59')).diff(jetzt);
        var zuGestern = moment(jetzt.format('YYYY-MM-DD 00:00:00')).diff(jetzt);
        
        // Runden
        zuMorgen = (zuMorgen != 0) ? Math.floor(zuMorgen / 1000 / 60 / 60) : 0;
        zuGestern = (zuGestern != 0) ? Math.abs(Math.floor(zuGestern / 1000 / 60 / 60)) : 0;

        // Jetzt
        if(d == 0) {

            content = ['Jetzt'];

        // Zukunft
        } else if(d > 0) {

            if(d < 60) {
                content = ['in wenigen','Sekunden'];
            } else if(d < 600) {
                content = ['in wenigen','Minuten'];
            } else if(d < 3600) {
                content = ['in ' + Math.floor(d / 60), 'Minuten'];
            } else if(d < 86400) {       
                if(zuMorgen < Math.floor(d / 60 / 60)) {
                    content = ['Morgen', m.format('HH:mm')];
                } else {
                    content = ['in ' + Math.floor(d / 60 / 60), 'Stunden'];
                }

            // Ab hier nur noch mit dem 0 Uhr Zeitstempel arbeiten
            } else {

                d = moment(m.format('YYYY-MM-DD 00:00:00')).diff(moment(moment().format('YYYY-MM-DD 00:00:00'))) / 1000 / 60 / 60 / 24;

                if(d <= 1) {
                    content = ['Morgen',m.format('HH:mm')];
                } else if(d <= 2) {
                    content = ['Über-','morgen'];
                } else if(d < 14) {
                    content = ['in ' + d, 'Tagen'];
                } else {

                    var weeks = Math.floor(d / 7);

                    // Wochen
                    if(weeks < 8) {

                        content = ['in ' + weeks, 'Wochen'];
                      
                    // Monate
                    } else {

                        // Durchschnittliche Tage im Monat
                        var months = Math.floor(d / 30.437);

                        if(months < 12) {
                            content = ['In ' + months, 'Monaten'];
                        } else {

                            var years = Math.ceil(d / 365);

                            if(years <= 1) {
                                content = ['Mehr als', 'ein Jahr'];
                            } else {
                                content = ['In  ' + years, 'Jahren'];
                            }
                        }
                    }
                }                
            }

        // Vergangenheit
        } else {

            // Minus entfernen
            d = Math.abs(d);

            if(d < 60) {
                content = ['vor wenigen','Sek.'];
            } else if(d < 600) {
                content = ['vor wenigen','Min.'];
            } else if(d < 3600) {
                content = ['vor ' + Math.floor(d / 60), 'Min.'];
            } else if(d < 86400) {    
                
                if(zuGestern < Math.floor(d / 60 / 60)) {
                    content = ['Gestern', m.format('HH:mm')];
                } else {
                    content = ['vor ' + Math.floor(d / 60 / 60), 'Std.'];
                }

            // Ab hier nur noch mit dem 0 Uhr Zeitstempel arbeiten
            } else {

                d = Math.abs(moment(m.format('YYYY-MM-DD 00:00:00')).diff(moment(moment().format('YYYY-MM-DD 00:00:00'))) / 1000 / 60 / 60 / 24);

                if(d <= 1) {
                    content = ['Gestern',m.format('HH:mm')];
                } else if(d <= 2) {
                    content = ['Vor-','gestern'];
                } else if(d < 14) {
                    content = ['vor ' + d, 'Tagen'];
                } else {

                    var weeks = Math.floor(d / 7);

                    // Wochen
                    if(weeks < 8) {

                        content = ['vor ' + weeks, 'Wochen'];
                      
                    // Monate
                    } else {

                        // Durchschnittliche Tage im Monat
                        var months = Math.floor(d / 30.437);

                        if(months < 12) {
                            content = ['vor ' + months, 'Monaten'];
                        } else {

                            var years = Math.floor(d / 365);

                            if(years <= 1) {
                                content = ['vor über', 'einem Jahr'];
                            } else {
                                content = ['vor  ' + years, 'Jahren'];
                            }
                        }
                    }
                }                
            }
        }
        
        // Rückgabe
        return content;
    }

}