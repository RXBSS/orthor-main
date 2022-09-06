const fs = require('fs');
const fse = require('fs-extra');
/**
 * Zum Verarbeiten von Templates gedacht
 * 
 * 
 * 
 */
module.exports = {

    scan() {

        var me = this;


        console.log('> Scanne Ordner')

        var result1 = me.scanDir("./../src/templates");

        if (result1) {
            console.log('> Template Ordner gefunden!');
        } else {
            console.log('> Keine lokalen Templates gefunden');
        }

        var result2 = me.scanDir("./src/templates");

        if (result2) {
            console.log('> Orthor Template Ordner gefunden!');
        } else {
            console.log('> Keine Orthor Templates gefunden');
        }

        var result = {};
        var hasResult = false;

        // Result 2 - Orthor
        if (result2) {
            for (var item in result2) {
                result[item] = result2[item];
            }
            hasResult = true;
        }

        // Result 1 - Überschreibt Orthor falls vorhanden!
        if (result1) {
            for (var item in result1) {
                result[item] = result1[item];
            }
            hasResult = true;
        }

        // Rückgabe
        return (hasResult) ? result : false;
    },

    scanDir(dir) {

        var me = this;

        // Init
        var result = false;

        // Standard Template Ordner
        if (me.isDir(dir)) {

            result = {};


            var subfolders = fs.readdirSync(dir);
            var i = 0;

            // Schleife durch die Ergebnisse
            for (var item in subfolders) {

                if (me.isDir(dir + "/" + subfolders[item])) {

                    // JSON lesen
                    result[subfolders[item]] = {
                        path: dir + "/" + subfolders[item],
                        json: me.getConfig(dir + "/" + subfolders[item])
                    };

                    i++;
                }
            }

            // Result auf False setzen, wenn es keine Ordner gibt
            if (i == 0) {
                result = false;
            }
        }

        return result;
    },

    getConfig(path) {

        var me = this;
        var result = {};

        var file = path + "/config.json";

        if (me.isFile(file)) {

            result = JSON.parse(fs.readFileSync(file));
        }

        return result;
    },

    isDir(path) {
        return fs.existsSync(path) && fs.lstatSync(path).isDirectory();
    },

    isFile(path) {
        return fs.existsSync(path) && fs.lstatSync(path).isFile();
    },



    // Die Templates müssten überall angezeigt werden
    list() {

        var me = this;

        // Ergebnis des Scans
        var result = me.scan();

        console.log();
        console.log('> Verfügbare Templates');

        // Schleife
        for (var item in result) {

            console.log('└── ' + item + '  --->  ' + result[item].path);

        }

        console.log();

    },

    generate(name, options) {

        var me = this;

        // Name
        console.log('> 🤪 Generate Template >' + name + '<');

        // Ergebnis des Scans
        var result = me.scan();

        // Prüfen ob Defined ist
        if (typeof result[name] != 'undefined') {

            console.log('> Template gefunden!');

            var c = result[name].json;

            var subdir = (me.isDir('./../src') ? "./../" : "./" );

            // Name des neuen
            options.name = (options.name == 'new' && typeof c.name != 'undefined') ? c.name : options.name;

            fs.readdirSync(result[name].path).forEach((entry) => {
                
                // Config.json ausschließen
                if(entry != 'config.json') {

                    // Quelle und Ziel festlegen
                    var src = result[name].path + "/" + entry;
                    var dest = subdir + c.dest + "/" + entry.split('~~name~~').join(options.name);
                

                    // Wenn es ein Verzeichnis ist
                    if(me.isDir(src)) {    
                        if(!me.isDir(dest) || options.overwrite) {      
                            me.path = [];             
                            fse.copySync(src, dest);
                            console.log('> Kopiere Verzeichnis');
                        } else {
                            console.log("🚨 Das Verzeichnis existiert schon!");
                            throw "Fehler beim Kopieren"
                        }
                    // Wenn es eine Datei ist
                    } else if(me.isFile(src)) {
                        if (!me.isFile(dest) || options.overwrite) {
                            fs.copyFileSync(src, dest);
                            console.log('> Kopiere Datei');
                        } else {
                            console.log("🚨 Die Datei existiert schon!");
                            throw "Fehler beim Kopieren";
                        }
                    }
                }
            });


            console.log('> Vollständig kopiert!');

            // Dateien verarbeiten
            if(typeof c.files != 'undefined' && c.files.length > 0) {
                
                console.log('> Weitere Dateien verarbeiten');

                c.files.forEach((entry) => {
                    console.log('> Verarbeite: ' + entry);
                    fs.renameSync(subdir + c.dest + "/" + options.name + "/" + entry, subdir + c.dest + "/" + options.name + "/" + entry.split("~~name~~").join(options.name));
                });

                console.log('> Dateien wurden verarbeitet!');
            }

        } else {
            console.log('🚨 Das Template wurde nicht gefunden.');
            console.log('> Probiere orthor template list');
        }
    }
}