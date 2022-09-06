/**
 * 
 * @param {*} parent selector der beim Klassenaufruf mitgegebn werden soll
 * 
 * 
 * Eine Signature Klasse die verschieden Funktionen mit sich bring
 * 
 * ## Events
 * clear -> löscht den Inhalt des Canvas
 * save -> speichert den Inhalt als URL
 */



var Signature = class {
    // Selector ist ein eindeutiger Selector
    constructor(parent) {
        
        var me = this;
        parent = $(parent);
      
        var canvas = parent.find('canvas').get(0);       
        me.signaturePad = new SignaturePad(canvas);
      
        me.addListner(parent);
      
    }
    
    addListner(parent) {
    
        var me = this;
    
        parent.on('click', '.sig-clear', function() {
            me.signaturePad.clear();
        });
        
        parent.on('click', '.sig-save', function() {
            var data = me.getSignaturePadVal()

            console.log(data);

        });
    }

    getSignaturePadVal() {

        var me = this;

        var data = me.signaturePad.toDataURL('image/png');

        return data;

    }
}