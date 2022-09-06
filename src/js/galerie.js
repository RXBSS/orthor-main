class Galerie {

    constructor(el, data, opts) {

        var me = this;

        // Element normalisieren
        me.el = (el instanceof jQuery) ? el : $(el);

        data = data || false;
        
        if(!data) {
            throw new Error("Es muss eine Datenquelle angegeben werden!");
        }

        // Daten
        me.data = data;

        // Optionen
        opts = opts || {};

        // Standard Werte
        me.s = $.extend({}, {
            row: 'row',
            column: 'col-md-3 mb-3 d-flex align-items-center',
            item: 'galerie-item',
            image: 'img-fluid',
            fancybox: true
        }, opts);



        // Init
        me.init();
    }

    init() {
        var me = this;
        me.build();
    }

    /**
     * Daten aus der Datenbank ziehen
     */
    getData(callback) {

        var me = this;

        // Wenn es ein Array ist
        if(Array.isArray(me.data)) {

            // Daten direkt übergeben
            callback(me.data);            


        // Wenn es ein Ajax Request werden soll
        } else if(typeof me.data == 'object' && me.data.file) {

            // Task
            var task = (me.data.task) ? me.data.task : false;

            // Wenn es keinen Task gibt
            app.simpleRequest(task, me.data.file, null, function(response) {       
            
                // 
                callback(response.data);
            });

        // Else
        } else {
            throw "Keine Datenquelle angegeben";
        }       
    }


    /**
     * 
     * 
     */
    build() {

        var me = this;

        // Daten sammeln
        me.getData(function (array) {

            var html = '';
            
            if(array.length > 0) {

    
                html += '<div class="' + me.s.row + '">';

                // Erstellen der Columns
                $.each(array, function (index, value) {

                    // Reihe öffnen
                    html += '<div class="' + me.s.column + '">';

                    // Mit Fancybox
                    if (me.s.fancybox) {
                        html += '<a class="' + me.s.item + ' ' + ((value.class) ? value.class : "") + '" href="' + value.imageUrl + '"  data-fancybox="gallery" data-caption="' + ((value.name) ? value.name : 'Bild #' + (index + 1)) + '">';
                        html += '<img class="' + me.s.image + '" src="' + ((value.thumbUrl) ? value.thumbUrl : value.imageUrl) + '">'
                        html += '</a>';

                    // Ohne Fancybox
                    } else {
                        html += '<div class="' + me.s.item + '">';
                        html += '<img class="' + me.s.image + '" src="' + ((value.thumbUrl) ? value.thumbUrl : value.imageUrl) + '">'
                        html += '</div>';
                    }
                    
                    // Reihe schließen               
                    html += '</div>';
                });

                html += '</div>';

            } else {
                html += "<center><em>Keine Bilder in der Galerie</em></center>";
            }

            // HTML 
            me.el.html(html);
        });

    }

    refresh() {
        var me = this;
        me.build();
    }

    reload() {
        this.refresh();
    }



}