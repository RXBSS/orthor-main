    // Includes
const Odb = require('./manual_modules/orthor/orthor.db.js');
const OTemp = require('./manual_modules/orthor/orthor.template.js');
const commandLineArgs = require('command-line-args');


// Entferne das Initale Command
var arg = process.argv.splice(2,1);

var db = new Odb();

// Argumente
try {

    // Defaul Commands
    var defaultCmd = [
        {name: 'config', alias: 'c', type: String}
    ];

    // Commands
    switch(arg[0]) {

        // Backup
        case 'db':

            // Bei DB muss es immer auch noch ein drittes Command geben!
            arg = process.argv.splice(2,1);

            // Datenbank
            switch(arg[0]) {

                case 'backup': 

                    // Commands
                    var commands = [
                        {name: 'name', alias: 'n', type: String, defaultValue: 'backup'}            
                    ];

                    // Optionen
                    var options = commandLineArgs(defaultCmd.concat(commands));

                    console.log('--> Backup');

                    // Datenbank initalisieren
                    db.init(options, function () {
                        db.backup(options.name, function () {
                            console.log('--> Task Complete');
                        });
                    });

                    break;


                case 'install': 
                   
                    // Commands
                    var commands = [
                        {name: 'level', alias: 'l', type: Number, defaultValue: '4'}            
                    ];

                    // Optionen
                    var options = commandLineArgs(defaultCmd.concat(commands));

                    console.log('--> Create Database');

                    // Datenbank initalisieren
                    db.init(options, function () {

                        // Datenbank löschen
                        db.install(options.level, function () {
                            console.log('--> Task Complete');
                        });

                    });

                    break;

                // Datenbank updaten
                case 'update':

                    console.log('--> Update Database');

                    // Datenbank initalisieren
                    db.init(commandLineArgs(defaultCmd), function () {

                        // Datenbank löschen
                        db.updateAll(function () {
                            console.log('--> Task Complete');
                        });

                    });

                    break;

                // Datenbank löschen
                case 'delete': 

                    console.log('--> Delete Database');

                    // Datenbank initalisieren
                    db.init(commandLineArgs(defaultCmd), function () {

                        // Datenbank löschen
                        db.delete(function () {
                            console.log('--> Task Complete');
                        });
                    });

                    break;

                // Reset durchführen
                case 'reset': 

                    // Commands
                    var commands = [
                        {name: 'level', alias: 'l', type: Number, defaultValue: '4'}            
                    ];

                    // Optionen
                    var options = commandLineArgs(defaultCmd.concat(commands));

                    console.log('--> Reset Database');

                    // Datenbank initalisieren
                    db.init(options, function () {

                        // Datenbank löschen
                        db.reset(options.level, function () {
                            console.log('--> Task Complete');
                        });
                        
                    });

                    break;

                default: 
                    console.log('Beim db Befehl muss immer auch ein zweites Argument mitgegeben werden!');
                    break;
            }

            break;

         // Deploy
         case 'template': 
            
            // Bei DB muss es immer auch noch ein drittes Command geben!
            arg = process.argv.splice(2,1);

            // Datenbank
            switch(arg[0]) {

                case 'list': 
                    console.log('--> Zeit die Templates an, die gefunden wurden!');
                    OTemp.list();
                    break;

                // Ausgabe der Fehlermeldung
                default: 
                    if(!arg[0]) {
                        console.log('Bitte geben Sie ein weiteres Argument mit!');
                    } else {
                    
                        // Commands
                        var commands = [
                            {name: 'name', alias: 'n', type: String, defaultValue: 'new'},
                            {name: 'overwrite', alias: 'o', type: Boolean, defaultValue: false}
                        ];

                        // Optionen
                        var options = commandLineArgs(defaultCmd.concat(commands));

                        OTemp.generate(arg[0], options);
                    }
                    break;

            }

            break;

        // Deploy
        case 'deploy': 
            
            console.log('--> Deploy Task');
            console.log('> Check Config for Deploy Config');
            console.log('> Try to Deploy with these Settings');
            console.log('> Connect to FTP');
            console.log('> Connect with Shell');
            console.log('--> Task Not Defined Yet');

            break;

        // Delete
        case 'clone': 
            
            console.log('--> Clone the database from productive Enviroment');
            console.log('> Connect with Shell');
            console.log('> Execute Backup');
            console.log('> Download Backup');
            console.log('> Include Backup');
            console.log('--> Task Not Defined Yet');

            break;

        // Delete
        case 'help': 
            
            console.log('--> Hier erhalten Sie Hilfe');
            console.log('--> Task Not Defined Yet');
            
            break;

        default: 
            console.log('Keinen Parameter angebenen. Prüfe Sie mit help die Möglichkeiten')
            break;
    }

} catch(ex) {
    
    console.log('--> Es ist ein Fehler aufgetreten');
    console.log('--> ' + ex);
}



/*

    // Start Funktion
    start: function () {

        // 
        orthor.execCmd("git pull", function () {

            // 
            orthor.execCmd("npm install", function () {

                //  
                orthor.execCmd("composer install", function () {
                    console.log('-----  FINISH!');
                });
            });
        });


    },

    // Help Funktion
    help: function () {
        console.log('Naja, hier gibt es auch nicht viel mehr.');
        console.log('RTFM! -> orthor.md');
        console.log('https://github.com/BurosystemhausSchafer/orthor/blob/dev/orthor.md');
    }
}

*/