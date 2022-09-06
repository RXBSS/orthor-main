/**
 * 
 */
class ActivationMulti extends Activation {

    /**
   * 
   */
    getValue() {

        var me = this;

        me.log('Get Value');

        // Value
        var value = [];

        // Wenn es mehr als einer ist, dann handelt es sich um Radios
        if (me.el.length > 1) {

            me.log('- Eingabe erfolgt über Radio/Checkbox');


            // Alle Radios durchgehen und nur angewählte hinzufügen
            me.el.each(function () {

                if ($(this).prop('checked')) {

                    var readValue = $(this).val().split(',');

                    $.each(readValue, function (index, readValuePos) {
                        value.push(readValuePos);
                    });
                }
            });

        } else {

            me.log('- Eingabe erfolgt über Select');

            // Multi Select
            if (me.el.prop('multiple')) {

                var readValue = me.el.val();

                $.each(readValue, function(index, subValue) {
                    $.each(subValue.split(','), function(index, subSubValue) {
                        value.push(subSubValue);
                    });                    
                });
            
            // Single Select
            } else {
                var readValue = me.el.val().split(',');

                $.each(readValue, function (index, readValuePos) {
                    value.push(readValuePos);
                });
            }
        }

        return (typeof value == 'undefined') ? "" : value;
    }

    // Action Item
    actionItem(value, listItem) {

        var me = this;

        // Normalisieren
        value = (Array.isArray(value)) ? value : [value];

        // Initalisieren mit False
        var isIndexOf = false;

        // Wenn Daten im Array vorhanden sind
        if (value.length > 0) {
            $.each(value, function (index, arrayVal) {
                if (listItem.values && listItem.values.indexOf(arrayVal) >= 0) {
                    isIndexOf = true;
                }
            });
        }

        // Anzeigen und ausblenden
        var show = ((!listItem.reverse && !isIndexOf) || (listItem.reverse && isIndexOf)) ? false : true;

        // Rückgabe
        return {
            el: listItem.el,
            show: show
        };
    }
}

