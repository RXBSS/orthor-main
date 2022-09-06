/**
 * Gleicht Automatisch die Höhe an
 * 
 * 
 */
class CardSizer {

    // 
    constructor(array) {

        var me = this;

        me.active = false;

        // Parameter prüfen
        me.checkParams(array);

        // Einmalig zu Beginn ausführen
        me.equalize();

        // Event Listner hinzufügen
        me.addListner();

    }

    // Parameter prüfen
    checkParams(array) {

        var me = this;

        // Wenn nicht mindestens zwei Cards angegeben wurden
        if (array.length < 2) {
            throw new Error("Es müssen mindestens zwei Elemente angegeben werden");
        }

        // Elemente
        me.elements = [];

        // Schliefe 
        for (var i = 0; i < array.length; i++) {

            var temp = $(array[i]);

            // Prüfen ob das Element gefunden wird
            if (temp.length) {

                if (temp.hasClass('card') || temp.hasClass('alert')) {

                    // Element hinzufügen
                    me.elements.push(temp);

                } else {
                    throw new Error("Das Element >" + array[i] + "< ist keine .card oder alert!");
                }

            } else {
                throw new Error("Das Element >" + array[i] + "< existiert nicht!");
            }
        }
    }

    // Event Listner hinzufügen
    addListner() {

        var me = this;

        var timeout = false;

        $(window).on('resize', function () {

            clearTimeout(timeout);

            timeout = setTimeout(function () {
                me.equalize();
            }, 100);
        });

        // Observer abspeichern
        me.observer = [];

        $.each(me.elements, function (index, el) {
            me.observer.push(me.startObservation(el));
        });
    }


    startObservation(el) {

        var me = this;

        // The node to be monitored
        var target = el[0];

        // Create an observer instance
        var observer = new MutationObserver(function (mutations) {
            
            // Nur Equalizen, wenn dies nicht selbst getriggert wurde
            if(!me.active) {
                me.equalize();
            }
           
        });

        // Pass in the target node, as well as the observer options
        observer.observe(target, {
            attributes: true,
            childList: true,
            characterData: true,
            subtree: true
        });

        // Rückgabe des Observers
        return observer;
    }



    equalize() {

        var me = this;

        // Verhindern, dass eine Endlosschliefe entsteht
        me.active = true;

        var data = me.getElementsData();

        // Schleife durch alle Elemente
        $.each(data.elements, function (index, value) {

            // Prüfen ob das Element verändert werden muss
            var sizeResult = me.checkSize(value.parent);
    
            if (sizeResult && index != data.largest) {

                // Höhe auf die gleiche Höhe setzen wie das größte Element
                value.el.css({ minHeight: data.elements[data.largest].height });
            }
        });

        // Ein kleines Delay einbauen
        setTimeout(function() {
            me.active = false;
        }, 1);   
    }


    // Holt die Daten aller Elemente
    getElementsData() {

        var me = this;

        // Daten
        var data = {
            largest: false,
            elements: {}
        };

        var prev = 0;

        $.each(me.elements, function (index, el) {

            // Reset der Höhe
            el.css({ minHeight: 'auto' });

            // In das Objekt schreiben
            data.elements[index] = {
                el: el,
                height: me.getElementData(el),
                parent: me.analyzeParent(el)
            }

    
            // Das größte Element abspeichern
            if (data.elements[index].height > prev) {
                prev = data.elements[index].height;
                data.largest = index;
            }
        });

        return data;
    }

    // 
    getElementData(el) {

        var me = this;

        // Höhe auslesen
        return el.height();
    }

    // 
    analyzeParent(el) {
        
        var classes = el.parent().attr('class').split(' ');


        var regex = new RegExp(/^col-(xl|lg|sm|xs)-[1-9]{1}[0-2]{0,1}$/g);

        var result = false;

        $.each(classes, function(index, value) {
            
            value = value.toLowerCase();
            
            if(regex.test(value)) {
                result = value.substr(4,2);
                return false;
            }
        });

        return result;
    }

    // 
    checkSize(size) {

        var breite = $(window).width();

        var compare = {
            sm: 576,
            md: 768,
            lg: 992,
            xl: 1200,
            xxl: 1400
        }

        return (breite < compare[size]) ? false : true;
    }


}

