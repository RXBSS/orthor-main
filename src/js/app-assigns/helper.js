/**
 * App Assign für Helper 
 * 
 * Dabei handelt es sich um diverse Hilfsfunktionen
 * 
 */
var appAssignHelper = {

    /**
     * Gibt die Parameter der URL zurück.
     * 
     * Hash und Query sind jeweils `false` falls nichts angegeben ist
     * Wenn kein Port in der URL ist, dann wird Standardmäßig Port 80 genommen
     * 
     *  {
     *      complete: "http://localhost:3000/orthor/test/datatables.php?test=asddsa&test2=sdaassadads#asdda"
     *      current: "datatables.php",
     *      hash: "asdda",
     *      host: "localhost:3000",
     *      hostname: "localhost",
     *      path: ["orthor", "test"],
     *      port: "3000",
     *      protocol: "http",
     *      query: {
     *          test: "asddsa",
     *          test2: "sdaassadads"
     *      }
     *  }
     * 
     * @returns {Object} Gibt eine Objekt mit allen wichtigen Daten zurück
     *  
     * 
     */
    getUrlData() {

        // String 
        var string = window.location.href;
        var s1 = string.split('//');
        var s2 = s1[1].split('/');
        var host = s2.shift();

        // Wenn es die Angabe eines Ports gibt
        if (host.includes(':')) {
            var s3 = host.split(':');
            var hostname = s3[0];
            var port = s3[1];

            // Ohne Port, wird der Standard gesetzt
        } else {
            var hostname = host;
            var port = 80;
        }

        // Current
        var current = s2.pop();
        var path = s2;

        // Wenn es eine # gibt, dann diese Abschneiden 
        if (current.includes('#')) {
            var s4 = current.split('#');
            current = s4[0];
            var hash = s4[1];
        }

        // Wenn es GET Variablen gibt
        if (current.includes('?')) {
            var s5 = current.split('?');
            var s6 = s5[1].split('&');

            current = s5[0];

            var query = {};

            for (var i = 0; i < s6.length; i++) {
                var temp = s6[i].split('=');
                query[temp[0]] = temp[1];
            }
        }

        // Fertiges Objekt
        var obj = {
            complete: string,
            protocol: s1[0].split(':').join(''),
            host: host,
            port: port,
            hostname: hostname,
            path: path,
            current: current,
            hash: hash || false,
            query: query || false
        };

        return obj;
    },

    /**
     * Gibt die ID in der URL zurück
     */
    getUrlId() {
        var me = this;

        var data = me.getUrlData();

        var id = (data.query && typeof data.query.id != 'undefined') ? parseInt(data.query.id) : false;

        return (id > 0) ? id : false;
    },

    getAndCheckUrlId(redirectTo, message) {
       
        var me = this;

        var id = me.getUrlId();

        if(!id) {

            redirectTo = redirectTo || 'index';
            message = message || 'Es konnte keine eindeutige Nummer gefunden werden. Bitte kontaktieren Sie den Administrator. Sie werden automatisch weitergeleitet!'
            
            // 
            me.alert.error.fire("Fehler", message).then(function () {
                app.redirect(redirectTo);
            });

        }
        
        return id;
    },

    parseGermanNumber(number) {

        console.warn('DEPRECATED: Bitte die Klasse Formatter benutzen! Funktion wird demnächst entfernt!');

        return app.formatter.formatJsFloat(number);
    }


}