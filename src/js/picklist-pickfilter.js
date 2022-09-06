class PickFilter {

    /**
     * Der Konstruktor aktzeptier mehrere Varianten
     */
    constructor(param1, param2, param3, param4) {

        var me = this;

        if(typeof window.randomCounter == 'undefined') {
            window.randomCounter = 0;
        }

        // Random Counter
        window.randomCounter++;

        // Prüfen das der erste Parameter vergeben ist
        if (typeof param1 == 'undefined') {
            throw new Error("Der erste Parameter muss angegeben werden!");
        }

        // Defaults setzen
        me.id = moment().format('x') + window.randomCounter;
        me.isFilterObj = true;
        me.column = false;  // Kann eine Number, String oder Array sein
        me.filter = false;  // Können ein oder mehrere Filter-Objekte sein
        me.value = "";   // Kann ein String sein
        me.logic = 'AND';   // Möglich: AND, OR
        me.type = '=';      // Möglich: = , != , > , < ,  >= , <=, IN, x%, %%, %x, 'startWith', 'endswith', 'equals', 'contains', 'like'

        // mit Object Initalisieren
        if (typeof param1 == 'object' && !Array.isArray(param1)) {

            // Prüfungen
            if (!param1.column && !param1.filter) {
                throw new Error("Es muss entweder Column oder Filter vergeben sein!");
            }

            // Standardwerte
            me.column = param1.column || me.column;
            me.filter = param1.filter || me.filter;
            me.value = (typeof param1.value != 'undefined') ? param1.value : me.value;
            me.logic = param1.logic || me.logic;
            me.type = param1.type || me.type;

            // Mit Variablen initalisieren
        } else {

            // Wenn es ein Array ist, dann den ersten Wert prüfen. Ansonsten den kompletten Wert prüfen
            var result = (Array.isArray(param1)) ? me.checkIfisFilterObj(param1[0]) : me.checkIfisFilterObj(param1);

            if (result) {
                me.filter = param1;
                me.logic = param2 || me.logic;
                me.value = false;
            } else {
                me.column = param1;
                me.value = (typeof param2 != 'undefined') ? param2 : me.value;
                me.logic = param4 || me.logic;
            }

            me.type = param3 || me.type;
        }

        // Normalisieren
        me.type = me.checkAndNormalizeType(me.type);
        me.logic = me.checkLogic(me.logic);

        // Bei Type und In
        if (me.type == 'in' && !Array.isArray(me.value)) {
            throw new Error("Bei type=in muss in jedem Fall ein Array als Value übergeben werden!");
        }
    }


    getTypes(asArray) {

        var me = this;

        asArray = asArray || false;

        // Erlaubte Typen
        var allowedType = {
            "=": "ist gleich",
            "!=": "ist nicht gleich",
            ">": "ist größer als",
            "<": "ist kleiner als",
            ">=": "ist größer gleich",
            "<=": "ist kleiner gleich",
            "in": "ist einer von",
            ".*": "beginnt mit",
            "*": "enthält",
            "*.": "endet mit",
            "startwith": "beginnt mit",
            "endswith": "endet mit",
            "equals": "ist gleich",
            "contains": "enthält"
        };

        // Rückgabe
        return (asArray) ? Object.keys(allowedType) : allowedType;

    }


    checkAndNormalizeType(input) {

        var me = this;

        // Erlaubte Typen
        var allowedType = me.getTypes(true);

        input = input.toLowerCase();

        // Wenn der Logic Operator nicht gefunden wurde
        if (allowedType.indexOf(input) < 0) {
            throw new Error("Es wurde ein ungültiger Type benutzt >" + input + "<");
        }

        // Normalisieren - Texte umwandeln
        return input.replace("startwith", "x%").replace("endswith", "%x").replace("equals", "=").replace("contains", "%%");
    }

    // 
    checkLogic(input) {

        var allowedLogic = ["AND", "OR"];

        input = input.toUpperCase();

        // Wenn der Logic Operator nicht gefunden wurde
        if (allowedLogic.indexOf(input) < 0) {
            throw new Error("Es wurde ein ungültiger Logik-Operator benutzt >" + input + "<");
        }

        // Rückgabe
        return input;
    }

    // Filter Objekt prüfen
    checkIfisFilterObj(input) {

        // Prüfen, dass es ein Objekt ist der entsprechende Wert gesetzt ist
        return (typeof input == 'object' && typeof input.isFilterObj != 'undefined' && input.isFilterObj === true) ? true : false;
    }

    // Filter to Text
    toText(list) {

        var me = this;

        // 
        if (me.filter !== false) {

            // Als Array
            var filterArray = (Array.isArray(me.filter)) ? me.filter : [me.filter];

            // 
            var html = [];

            // Alle Filter-Objekte durchgehen
            $.each(filterArray, function (key, subclass) {
                html.push(subclass.toText(list));
            });

            // Rückgabe
            return html.join("<br>");

            // 
        } else {

            var columns = (Array.isArray(me.column)) ? me.column : [me.column];

            // 
            var html = [];

            // Alle Filter-Objekte durchgehen
            $.each(columns, function (key, column) {

                // Feld mit der ID auslesen
                var field = list.getField(column);

                // Standard
                var fieldText = field.title;
                var connectText = me.typeToWord(me.type);
                var valueText = me.value;

                // Sonderfälle abfangen
                if(field.format == "yes-no") {
                    var ja = (field['format-config'] && field['format-config'][0]) ? field['format-config'][0] : "Ja";
                    var nein = (field['format-config'] && field['format-config'][1]) ? field['format-config'][1] : "Nein";
                    connectText = "ist gleich";
                    valueText = ((valueText == 1) ? ja : nein);
                }

                if(Array.isArray(valueText)) {

                    if(field.format == "betrag") {
                        $.each(valueText, function(index, subValue) {
                            valueText[index] = app.formatter.formatWaehrung(subValue);
                        });
                    }

                    // Value Text setzen
                    valueText = me.value.join(' | ');
                    
                } else {
                    if(field.format == "betrag") {
                        valueText = app.formatter.formatWaehrung(valueText);
                    }
                }

                html.push("<strong>" + fieldText + "</strong> " + connectText + " <strong>" + valueText + "</strong>");
            });

            // Rückgabe
            return html.join("<br>");
        }
    }

    /**
     * 
     */
    typeToWord(type) {

        var me = this;

        // Typen holen
        var types = me.getTypes();

        // Rückgabe
        return (types[type]) ? types[type] : "mit dem Filter";
    }


}