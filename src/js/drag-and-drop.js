
/**
 * Hilfsklasse für Drag & Drop
 */
class DragAndDrop {

    // Erstellen
    constructor(el, opts) {

        var me = this;

        // Element normalisieren
        me.el = (el instanceof jQuery) ? el : $(el);

        // Optionen
        opts = opts || {};

        // Standard Werte
        me.s = $.extend({}, {
            autofill: true,
            allowed: '*',
            forbidden: [],
            multiple: true,
            handle: false,
            task: false,
            limit: 41943039,
            limitFile: false
        }, opts);

        // Init
        me.init();
    }


    init() {

        var me = this;

        // Allowed prüfen und normalisieren
        if (!Array.isArray(me.s.allowed) && me.s.allowed != '*') {
            throw new Error("Fehlerhafte Option bei Allowed File Types. Muss * oder ein Array sein!");
        } else {
            me.s.allowed = (me.s.allowed == '*') ? '*' : me.s.allowed.map(filetype => String(filetype).toLowerCase());
        }

        // Forbidden prüfen und Normalisieren
        if (!Array.isArray(me.s.forbidden)) {
            throw new Error("Fehlerhafte Konfiguration bei Forbidden Files Types. Muss ein Array sein");
        } else {
            me.s.forbidden = me.s.forbidden.map(filetype => String(filetype).toLowerCase());
        }


        // Auto Fill
        if (me.s.autofill) {
            me.autofill();
        }

        // Append File
        me.appendFile();

        // Add Listner
        me.addListner();
    }

    addListner() {

        var me = this;

        // Standardmäßig die Events unterdrücken
        me.el.on('drag dragstart dragend dragover dragenter dragleave drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
        })

            // Drag-Enter
            .on('dragover dragenter', function () {
                me.el.addClass('is-dragover');
            })

            // Drag-Leave
            .on('dragleave dragend drop', function () {
                me.el.removeClass('is-dragover');
            })

            // Drop Event
            .on('drop', function (e) {
                me.dropped(e);
            })

            // Click
            .on('click', function (e) {

                // Verhindern, dass es eine Endlosschleife gibt
                if (e.target != me.el.find('input[name=file_upload]').get(0)) {
                    me.el.find('input[name=file_upload]').trigger('click');
                }

            });

        // 
        me.el.find('input[name=file_upload]').on('change', function (e) {
            me.dialog(e);
        });

    }

    /**
     * Fügt Automatisch den HTML Code ein
     */
    autofill() {
        var me = this;

        // 
        var autofillText = (me.s.autofill === true) ? ((me.s.multiple) ? 'Datei/en' : 'Eine Datei') + ' hochladen' : me.s.autofill;


        me.el.html('<div class="p-3" style="text-align:center;"><i class="fa-solid fa-arrow-up-from-bracket"></i> ' + autofillText + '</div>');

    }

    appendFile() {
        var me = this;

        // Appen
        me.el.append('<input type="file" name="file_upload" style="display: none;" ' + ((me.s.multiple) ? 'multiple' : '') + ' />');
    }


    dialog(e) {

        var me = this;

        // Files
        me.exec(me.el.find('input[name=file_upload]')[0].files);
    }

    /**
     * Drop
     */
    dropped(e) {

        var me = this;

        // Files
        me.exec(e.originalEvent.dataTransfer.files);


        console.log(e.originalEvent.dataTransfer.files);

    }

    validate(files, callback) {

        var me = this;

        var bulkSize = 0;

        // Prüfen, dass mindestenes eine Datei vorhanden ist
        if (files.length > 0) {

            // Prüfen ob Single oder Multi und entsprechend Validieren
            if (me.s.multiple || (me.s.multiple === false && files.length == 1)) {

                var validFileType = true;
                var validFileSize = true;

                // Schleife durch alle Dateien
                $.each(files, function (index, file) {

                    bulkSize = bulkSize + file.size;

                    if (!me.validateFiletype(file.extension)) {
                        validFileType = false;
                    }

                    if (me.s.limitFile !== false && me.s.limitFile < file.size) {
                        validFileSize = false;
                    }

                });

                // Limit
                if(me.s.limit === false || me.s.limit > bulkSize) {
                    if (validFileType) {
                        if (validFileSize) {

                            // Validierung erfolgreich
                            callback(true);
                        } else {
                            callback(false, 'Die Datei überschreitet die Maximale Größe');
                        }
                    } else {
                        callback(false, 'Es wurde ein nicht erlaubter Dateityp ausgewählt');
                    }
                } else {
                    callback(false, 'Die Gesamtgröße des Uploads wurde überschritten');
                }

            } else {
                callback(false, 'Es darf nur eine Datei abgelegt werden');
            }

            // 
        } else {
            callback(false, 'Es wurden keine Dateien angegeben');
        }
    }


    /**
     * Validate
     */
    validateFiletype(filetype) {

        var me = this;

        if (!filetype) {
            throw new Error("Zum Validieren muss ein Filetype angegeben werden!");
        }

        // Lowercase
        filetype = String(filetype).toLowerCase();

        // Valide
        var valid = false;

        // Wenn alle erlaubt sind
        if (me.s.allowed == '*') {


            // Ist Valide
            if (me.s.forbidden.indexOf(filetype) == -1) {
                valid = true;
            }

            // Wenn es eine Einschränkung gibt
        } else {

            // Ist Valide
            if (me.s.allowed.indexOf(filetype) >= 0 && me.s.forbidden.indexOf(filetype) == -1) {
                valid = true;
            }
        }

        // Rückgabe
        return valid;
    }

    /**
     * Hier kommen die beiden Funktionen (dropped & XXX) zusammen
     * Die Datei wird dann hochgeladen, falls gewünscht oder der entsprechende Callback wird ausgeführt
     * 
     * Das File Objekt ist dabei identisch
     * 
     * 
     */
    exec(files) {

        var me = this;

        // 
        $.each(files, function (index, values) {
            var filenameArray = values.name.split('.');
            var ext = filenameArray.pop();

            files[index].plainname = filenameArray.join('.'),
                files[index].extension = ext.toLowerCase(),
                files[index].lastModifiedMoment = moment(values.lastModified, 'x', true).format('YYYY-MM-DD HH:mm:ss');
        });

        me.validate(files, function (isValid, message) {

            // Wenn es Valide ist
            if (isValid) {

                // if Upload

                // Wenn es hochgeladen werden soll
                if (me.s.handle) {

                    me.upload(files);

                }

                // Callback 
                // me.el.trigger('');


                // Wenn es nicht Valide ist
            } else {
                app.notify.error.fire("Fehler", message);
            }
        });
    }


    // Upload
    upload(files) {

        var me = this;

        // Ajax Data
        var formData = new FormData();

        var additionalFileInfo = {};


        // 
        $.each(files, function (i, file) {

            // File Data hinzufügen
            formData.append('upload_' + i, file);

            // Addittional File Info
            additionalFileInfo[file.name] = file.lastModifiedMoment;
        });


        // Task anfügen
        formData.append('task', me.s.task);

        // Zusätzliche Infos anfügen
        formData.append('additionalFileInfo', JSON.stringify(additionalFileInfo));

        // Upload Id
        var uploadId = me.initStatus();
        var fLength = files.length;

        // Ajax
        $.ajax({
            url: me.s.handle,
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {

                var xhr = new window.XMLHttpRequest();

                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;

                        // Prozent ausrechnen
                        percentComplete = parseInt(percentComplete * 100);

                        me.handleStatus(uploadId, fLength, 'progress', percentComplete);
                    }
                }, false);

                return xhr;
            },
            success: function (response) {

                // Wenn die Antwort mit einem Success zurück kommt
                if (response.success) {

                    // Event
                    me.el.trigger('upload', [true]);
                    me.el.trigger('upload-success');

                } else {
                    me.handleStatus(uploadId, fLength, 'error');
                    me.errorCallback();
                }

                me.handleStatus(uploadId, fLength, 'success');
            },
            error: function () {
                me.handleStatus(uploadId, fLength, 'error');
                me.errorCallback();
            }
        });
    }


    // Status initalisieren
    initStatus() {

        var me = this

        // Container erstellen, falls dieser noch nicht existiert
        var c = $('body').find('#upload-status');

        if (!c.length) {
            $('body').append('<div id="upload-status"></div>');
            c = $('body').find('#upload-status');
        }

        // Upload einfügen
        var uploadId = moment().format('x');

        // Upload wird gestartet
        c.append('<div id="upload-' + uploadId + '" class="upload-status-item">Upload wird gestartet</div>');

        // Upload Id
        return uploadId;
    }

    // 
    handleStatus(uploadId, files, status, percentage) {

        var me = this;

        var c = $('body').find('#upload-status');
        var el = c.find('#upload-' + uploadId);

        // 
        if (status == 'progress') {
            el.html(percentage + " % | " + ((files > 1) ? files + ' Dateien werden hochgeladen' : '1 Datei wird hochgeladen'));
        } else if (status == 'success') {
            el.addClass('bg-success');
            el.html('<i class="fa-solid fa-check-double"></i> ' + ((files > 1) ? 'Hochladen von ' + files + ' Dateien war erfolgreich' : 'Hochladen von 1 Datei war erfolgreich'));

            setTimeout(function () {
                el.remove();
            }, 5000);

        } else if (status == 'error') {
            el.addClass('bg-error');
            el.html('<i class="fa-solid fa-xmark"></i> ' + ((files > 1) ? 'Hochladen von ' + files + ' Dateien ist fehlgeschlagen' : 'Hochladen von 1 Datei ist fehlgeschlagen'));
        }


    }


    errorCallback() {

        var me = this;


        // Event
        me.el.trigger('upload', [false]);
        me.el.trigger('upload-error');
    }



    // Proxy für das Jquery Element
    on(event, cb) {
        var me = this;
        me.el.on(event, cb);
    }


}