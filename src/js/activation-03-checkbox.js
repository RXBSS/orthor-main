/**
 * 
 * Activation Checkbox
 * 
 */
class ActivationCheckbox extends Activation {

    /* 
    * Hier wird ist die Funktion um den Wert zurückzugeben
    */
    getValue() {

        var me = this;
        return me.el.prop('checked');
    }


    /**
     * Action Item 
     * Hier wird entschieden, wann ein- und ausgeblendet werden soll
     * 
     */
    actionItem(value, listItem) {

        // Me
        var me = this;

        // Wenn angezeigt werden soll oder nicht
        var show = ((!listItem.reverse && !value) || (listItem.reverse && value)) ? false : true;

        // Rückgabe
        return {
            el: listItem.el,
            show: show,
            child: listItem.child
        };
    }

   
}

