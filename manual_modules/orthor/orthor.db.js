const mysql = require('mysql');
const fs = require('fs');
const cp = require("child_process");
const moment = require("moment");




/**
 * TODO: 
 * 
 * 1. Die Unterscheidung zwischen Produktiv System und Testsystem bzw. lokalem System und System z.B. bei Ionos muss noch hergestellt werden
 * 2. SSH Verbindung aufbauen
 * 3. mysqldump unabhänig von XAMPP
 * 
 * 
 * 
 * 
 * 
 */



module.exports = class {


    // Konfiguration
    constructor() {
        console.log();
        //console.log('******* DB OTHOR HANDLER ********');
    }

    /**
     * Initialisieren
     */
    init(settings, callback) {

        var me = this; 
        
        me.settings = settings;
        me.root = "./";

        // Wenn kein expliziter Config File gesetzt ist
        if(!me.settings.config) { 

            // Probieren eine übergeordnete Config auszulesen
            try {

                // Setting File festlegen
                me.settings.config = "./../src/config.json";
                
                // Probieren die Datei auszulesen. Sollte Sie nicht gefunden werden, dann greift die Catch Ex
                fs.readFileSync("./../src/config.json");
                
                me.root = "./../";

                console.log('> Übergeordnetes System, nehme dessen Settings File');

            // Wenn es fehlschlägt, dann den Standard-Config File setzen
            } catch(ex) {
                console.log('> Kein übergeordnetes System, nehme Orthor Settings File');
                me.settings.config = "./src/config.json";
            }

        // 
        } else {
            console.log('> Es wurde ein Settings File mit angegeben!');
        }

        // Read Config File
        me.readConfigFile(settings.config, function () {
            callback();
        });
    }

    /**
     * Konfigurationsdatei einlesen
     */
    readConfigFile(file, cb) {

        var me = this;

        console.log('> Read Config File');

        // List die Datei ein
        fs.readFile(file, 'utf8', function (error, data) {
            if (error) throw error;

            // Daten parsen
            me.config = JSON.parse(data);

            cb();
        });
    }


    /**
     * Backup der Datenbank
     * 
     * @param {*} name 
     */
    backup(name, callback) {

        var me = this;

        require = require || false;

        // Prüfen ob die Datenbank existiert
        me.checkIfDatabaseExists(function (exists) {

            // Wenn die Datenbank exisitert
            if (exists) {

                // Default Name, falls keiner angegeben ist
                name = name || 'backup';
                
                // Dreifach Unterstriche Verbieten, da diese später für die Erkennung des Datums notwendig sind!
                name = name.split('___').join('_') + '_' + moment().format('YYYY_MM_DD___HH_mm_ss') + '.sql';

                // Log
                console.log('> Create Backup >' + name + '<');

                // Command
                var cmd = me.getMysqlHead(false, 'mysqldump') + ' > ' + me.root + 'backup/' + name;
                
                me.runCommand(cmd, function() {

                    // Succcess Meldung
                    console.log('> Database Backup Complete');

                    // Callback
                    callback();

                });

            // Wenn die Datenbank gar nicht existiert!
            } else {

                // Succcess Meldung
                console.log('> Skipped Database Backup. Database does not exist');

                // Callback
                callback();
            }

        });

    }

    /**
     * This will only work locally
     * // TODO: Alte Backups aufräumen
     */
    clearBackups(days) {
        // Last 10 days




    }


    /**
     * Reset ausführen
     */
    reset(level, callback) {
        var me = this;
        level = level || 4;

        console.log('> Reset');

        me.delete(function() {
            me.install(level, function() {
                console.log('> Finish Reset');
            });
        });

    }

    /**
     * Installation durchführen
     */
    install(level, callback) {

        var me = this;

        level = level || 4;

        console.log('> Install Level >' + level + '<');

        me.backup('install_backup', function() {

            me.checkAndCreateDatabase(function () {

                // INSTALL
                // *******
                if(level > 1) {

                    console.log('> Insert all Tables');

                    var folder = me.root.split("/").join("\\") + "src\\sql\\install\\";

                    // INSTALL
                    // *******
                    me.execQueryFolder(folder, function () {
        
                        console.log('> Finished inserting all Tables');

                        // UPDATE
                        // ******
                        if(level > 2) {

                            // Update auf alle Tabellen
                            me.updateAll(false, function() {

                                // DEMO
                                // ******
                                if(level > 3) {
                                    me.demoData(false, function() {
                                        callback();
                                    });
                                } else {
                                    console.log('Finished Install');
                                }
                            });
                        
                        // Wenn die Installation fertig ist
                        } else {
                            console.log('Finished Install');
                            callback();
                        }                            
                    });
      
                } else {
                    console.log('Finished Install');
                    callback(); 
                }                
            });
        });
    }

    // Proxy für Backup
    optionalBackup(withbackup, name, callback) {
        
        var me = this;

        if(withbackup) {
            me.backup(name, function() {
                callback();
            });
        } else {
            callback();
        }
    }


    update() {

    }

    updateAll(withBackup, callback) {

        var me = this;
        var folder = me.root.split("/").join("\\") + "\\src\\sql\\update\\";

        console.log('> Update all Tables');

        // Query Ordner Updaten
        me.optionalBackup(withBackup, 'update_all_backup', function() {
            me.execQueryFolder(folder, function () {
                console.log('> Finished Updating all Tables');
                callback();
            });
        });
    }

    execQueryFolder(folder, callback) {

        var me = this;

        // Windows or Linux
        me.createSingleQueryFile(folder, function(data) {

            // Wenn es Daten gibt
            if(data) {

                var cmd = me.getMysqlHead() + ' <'  + folder + "..\\cmd\\all_files.sql";
                
                me.runCommand(cmd, function (data) {
                    callback();
                });

            // Wenn es keine Daten gibt
            } else {
                callback();
            }
        });
    }


    /**
     * Demo Daten einfügen
     */
    demoData(withBackup, callback) {

        var me = this;
        var folder = me.root.split("/").join("\\") + "\\src\\sql\\demo\\";

        console.log('> Insert Demo Data');

        // Query Ordner Updaten
        me.optionalBackup(withBackup, 'demo_data_backup', function() {
            me.execQueryFolder(folder, function () {
                console.log('> Finished Inserting Demo Data');
                callback();
            });
        });
    }



    /**
    * 
    */
    delete(callback) {

        var me = this;

        console.log('> Drop Database');

        me.checkIfDatabaseExists(function(exist) {

            // Wenn die Datenbank existiert
            if(exist) {

                // Backup erstellen
                me.backup('delete_backup', function() {

                    var query = "DROP DATABASE `" + me.config.db.name + "`";

                    // TODO: Produktivumgebung! vorher dreimal prüfen
                    me.runQuery(query, function (data) {

                        console.log('> Drop Database Complete');

                        callback();
                    }, true);
                });

            } else {
                throw "Datenbank ist nicht vorhanden!";
            }
        });
    }

    createSingleQueryFile(folder, callback) {

        var me = this;

        console.log('> Create Single Query File');

        // Prüfen ob es Windows ist
        var isWindows = (typeof me.config.server != 'undefined' && typeof me.config.server.os != 'undefined' && me.config.server.os == 'linux') ? false : true;


        var chcmd = 'dir /b "' + folder + '" | find ".sql"';
        
        
        cp.exec(chcmd, { 'encoding': 'UTF-8' }, (error, stdout, stderr) => {

            if(stdout.toString()) {


                // On Windows
                // TODO: This must be read from the config
                if (isWindows) {

                    var cmd = "copy /b " + folder + "*.sql " + folder + "..\\cmd\\all_files.sql";

                    // On Linux
                } else {

                    var cmd = "cat " + folder + "*.sql  > .all_files.sql";

                }

                // In eine Try Exception packen. Wenn keine Daten da sind, dann schlägt Copy nämlich fehl!
                

                me.runCommand(cmd, function (data) {

                    console.log('> Finished creating Single Query File');

                    callback(true);
                })

            } else {

                console.log('> No Data for Query File Found');
                callback(false);
            }

        }); 



    }



    // Prüft ob die Datenbank exisitert
    checkIfDatabaseExists(callback) {

        var me = this;

        // console.log('> Check if DB exists');

        // Query
        var query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" + me.config.db.name + "'";

        // Query ausführen
        me.runQuery(query, function (data) {

            if (data) {
                // console.log('> Die Datenbank existiert');
                callback(true);
            } else {
                // console.log('> Die Datenbank existiert nicht');
                callback(false);
            }

            // Sorgt dafür, dass diese Query nicht auf die Datenbank ausgeführt wird!
        }, true);
    }

    /**
     * 
     */
    createDatabase(callback) {

        var me = this;

        console.log('> Check if DB exists');

        // Datenbank erstellen
        var query = "CREATE DATABASE `" + me.config.db.name + "`";

        me.runQuery(query, function (data) {

            console.log('> Die Datenbank wurde erstellt');

            callback();
        }, true);
    }

    /**
     * Datenbank prüfen und ggf. erstellen
     * 
     * @param {*} callback 
     */
    checkAndCreateDatabase(callback) {

        var me = this;

        console.log('> Check Database and Create if not exists');

        me.checkIfDatabaseExists(function (result) {

            // Löschen
            if (!result) {
                me.createDatabase(function () {
                    callback();
                });

                // Löschen
            } else {
                callback();
            }
        });
    }


    connectSsh() {


        // 'mysqldump ' + me.config.db.name + ' --no-tablespaces --host ' + me.config.db.url + ' --user ' + me.config.db.user + ' --password=' + me.config.db.password + ' > temp.sql';


    }

    /**
     * Kommando ausführen
     * 
     * Hier muss geprüft werden ob das ganze via SSH oder via direkt per Node ausgeführt werden kann. 
     * Dies hängt davon ab, ob es sich um eine lokel oder externe Verbindung handelt
     *
     * 
     * 
     */
    runCommand(cmd, callback) {

        // This will be run either in local Command Line or Remote Server!
        // TODO: !!!


        // Ausführen
        cp.exec(cmd, { 'encoding': 'UTF-8' }, (error, stdout, stderr) => {

    
            // Prüfen ob ein Fehler aufgetreten ist
            if (error) {
                console.error(`exec error: ${error}`);
                console.log('> Command didn\'t work. If you are working locally please ensure to have >C:\\xampp\\mysql\\bin< in your Path variable!');
                throw "Es ist ein Fehler im Command aufgetreten";
            }

            // Rückgabe
            callback(stdout.toString().trim());
        });


    }

    getMysqlHead(noDb, cmd) {

        var me = this;
        noDb = noDb || false;
        cmd = cmd || 'mysql';

        return cmd + ' ' + ((noDb) ? '' : me.config.db.name) + ' --host ' + me.config.db.url + ' --user ' + me.config.db.user + ' ' + ((me.config.db.password) ? '--password=\'' + me.config.db.password + '\'' : '') + ' --default-character-set=utf8mb4';
    }


    runQuery(query, callback, noDb) {

        var me = this;

        // Command 
        var cmd = me.getMysqlHead(noDb) + ' -e "' + query + '" -B';

        // Command
        me.runCommand(cmd, function (data) {

            // Ergebnis
            var returnResult = false;

            // Prüfen ob es ein Datenbank Ergebnis gibt
            if (data) {

                // Splitten
                var s = data.split('\r\n');

                // Leeres Array als Ergebnis
                returnResult = [];

                // lle Keys loopen
                for (var key in s) {
                    var l = s[key].split('\t');

                    // Erste Zeile sind immer die Keys
                    if (key == 0) {
                        var keys = l;

                        // Ab dann kommen nur noch Daten
                    } else {

                        var temp = {}

                        for (var i = 0; i < l.length; i++) {
                            temp[keys[i]] = l[i];
                        }

                        // Temporäre Ergebnisse in die Tabelle setzen
                        returnResult.push(temp);
                    }

                }

                // Darf eigentlich nicht vorkommen
                returnResult = (returnResult.length > 0) ? returnResult : false
            }

            // Callback
            callback(returnResult);
        });
    }



};