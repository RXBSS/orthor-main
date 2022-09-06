<?php include('01_init.php');

$_page = [
    'title' => "Summernote"
];

?>
<!doctype html>

<head>
    <?php include('02_header.php'); ?>

    <style>

    </style>

</head>



<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <h4><i class="fa-solid fa-exclamation-circle"></i> Summernote</h4>
                    <h6 class="subtext">Das ist ein Plugin für das erstellen von einer fertig gestylten Textarea namens SummerNote.</h6>
                    <p>Mehr Informationen unter <a href="https://summernote.org/">https://summernote.org/</a></p>


                    <div class="row">
                        <div class="col-md-6">
                            <form>
                                <textarea name="" class="summernote" cols="30" rows="10"></textarea>
                                <br>
                                <button id="summerNodeButton" class="btn btn-primary">Abschicken</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="hljs language-html ctc"><div class="summernote"></div></code></pre>
                            <pre><code class="hljs ctc">$('.summernote').summernote({  
    height: 300,                 
    minHeight: null,             
    maxHeight: null,  
    focus: true,
    lang: 'de-DE',

    // Callbacks
    callbacks: {
        onPaste: function() {
            app.notify.success.fire("Erfolgreich","Erfolgreich reinkopiert");
        }
    }

});</code></pre>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-check"></i> Summernote und Form Validation</h4>
                    <h6 class="subtext">Man kann Summernote auch in die FormValidation mit einbauen.</h6>


                    <div class="row">
                        <div class="col-xl-6">
                            <form id="summernote-testform">

                                <div class="form-group form-floating mb-3">
                                    <input type="text" name="title" class="form-control editable" placeholder="Titel" value="Titel" required>
                                    <label>Titel</label>
                                </div>

                                <div class="form-group form-summernote">
                                    <textarea class="editable" name="smform" cols="30" rows="10" required></textarea>
                                </div>

                                <br>
                                <button class="btn btn-primary mb-3">Abschicken</button>
                                <button type="button" class="btn btn-danger mb-3" id="btn-reset">Reset</button>
                                <button type="button" class="btn btn-secondary mb-3" id="btn-load">Load</button>
                                <button type="button" class="btn btn-secondary mb-3" id="btn-set-readonly">Set Readonly</button>
                                <button type="button" class="btn btn-secondary mb-3" id="btn-unset-readonly">Unset Readonly</button>
                                <button type="button" class="btn btn-secondary mb-3" id="btn-set-data">Set Data</button>
                                <button type="button" class="btn btn-secondary mb-3" id="btn-test1">Test</button>
                            </form>
                        </div>
                        <div class="col-xl-6">

                            <nav>
                                <div class="nav nav-tabs" id="tab-nav-name">
                                    <button class="nav-link" id="tab-nav-name-1" data-bs-toggle="tab" data-bs-target="#tab-content-name-1" type="button">Doku</button>
                                    <button class="nav-link active" id="tab-nav-name-2" data-bs-toggle="tab" data-bs-target="#tab-content-name-2" type="button">Bilder</button>
                                </div>
                            </nav>
                            <br>
                            <div class="tab-content" id="tab-content-name">
                                <div class="tab-pane" id="tab-content-name-1">
                                    <strong>HTML</strong>

                                    <pre><code class="language-html" id="sampleCode"></code></pre>
                                    <strong>Initalisieren von Summernote </strong>
                                    <p style="font-size: 13px;"><strong style="color: red;">!! WICHTIG !! </strong> Summernote muss vor der Form Initialisiert werden das sonst die Form das me.initSummernote() im Form Handler nicht findet</p>
                                    <pre><code class="hljs language-js ctc">$('textarea[name=myname]').summernote({
height: 300,
lang: 'de-DE',
});</code></pre>
                                    <strong>Initalisieren der Form</strong>
                                    <pre><code class="hljs language-js ctc">// Form Initalisieren
var form = new Form('#form');

// Form Validation aktivieren
form.initValidation();</code></pre>
                                </div>
                                <div class="tab-pane show active" id="tab-content-name-2">

                                    <i class="fa-solid fa-folder-open"></i> summernote-demo
                                    <div id="mini-explorer"></div>
                                    <br>
                                    <i class="fa-solid fa-database"></i> Text
                                    <pre id="html-text"></pre>
                                </div>
                            </div>



                        </div>
                    </div>


                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-user"></i> Summernote Events</h4>
                    <h6 class="subtext">Integration von Eingaben</h6>


                    <div class="row">
                        <div class="col-md-6">
                            <textarea id="summernote-marker" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include("04_scripts.php"); ?>


<script>
    $(document).ready(function() {

        /**
         * FormValidation
         */


        var form;


        // Summernote initalisieren
        $('textarea[name=smform]').summernote({
            height: 300,
            lang: 'de-DE',
        });

        // Summernote und Form
        form = new Form('#summernote-testform', {
            debug: true
        });

        // Init Validation
        form.initValidation();

        // Submit
        form.on('submit', function() {

            // Speichern
            form.save("save", "summernote-test-ajax", function(response) {

                $('#html-text').text(JSON.stringify(response.data, null, 2));
                miniExplorer();
                form.reset(1);


            }, function(response, b, c) {
                console.log(b);
            });
        });

        // Reset Button
        $('#btn-reset').on('click', function() {
            form.reset(1);
        });

        // Read Only
        $('#btn-load').on('click', function() {
            form.load("load", "summernote-test-ajax", "", function() {
                app.notify.success.fire("Erfolgreich", "Die Form wurde geladen!");

            });
        });


        // Read Only
        $('#btn-set-readonly').on('click', function() {
            form.setReadonly(true);
        });

        // Unset Read Only
        $('#btn-unset-readonly').on('click', function() {
            form.setReadonly(false);
        });

        // Set Data
        $('#btn-set-data').on('click', function() {
            form.setData({
                smform: 'Mein Test'
            }, false, true);
        });

        // $('#mini-explorer-delete').on('click', function() {
        //     app.simpleRequest("mini-explorer-delete", "summernote-test-ajax", null, function(response) {
        //         miniExplorer();
        //     });
        // });

        miniExplorer();

        function miniExplorer() {
            app.simpleRequest("mini-explorer", "summernote-test-ajax", null, function(response) {

                var html = "";

                $.each(response.data, function(index, value) {
                    html += "&nbsp;&nbsp;<i class=\"fa-solid fa-arrow-turn-up fa-rotate-90\"></i>&nbsp; " + value + "<br>";
                });

                $('#mini-explorer').html(html);
            });
        }






        // ---------------






        var summerNote = {

            textarea: false,

            init: function() {

                summerNote.textarea = $('.summernote');
                summerNote.initSummerNote();
                summerNote.addListeners();
                summerNote.initSummerNoteCheckox();

            },

            addListeners: function() {

                // Just for Fun
                $('#summerNodeButton').on('click', function(e) {
                    e.preventDefault();
                    if (summerNote.textarea.val()) {
                        app.notify.success.fire("Erfolgreich", "Ihr Ticket wurde erfolgreich gespeichert!");
                        summerNote.textarea.summernote('reset');
                    } else {
                        app.alert.error.fire('Fehler', 'Das Textfeld muss gefüllt sein!');
                    }
                });
            },

            initSummerNote: function() {
                summerNote.textarea.summernote({
                    height: 300,
                    minHeight: null,
                    maxHeight: null,
                    focus: true,
                    lang: 'de-DE',

                    // Callbacks
                    callbacks: {
                        onPaste: function() {
                            app.notify.success.fire("Erfolgreich", "Erfolgreich reinkopiert");
                        }
                    }

                });
            },

            initSummerNoteCheckox: function() {

                if (!$('.note-modal-content .note-modal-body .checkbox').find('input[type="checkbox"]').hasClass("form-check-input")) {

                    // Checkbox wird gesucht und Klasse von Bootratrap angehängt
                    var checkbox = $('.note-modal-content .note-modal-body .checkbox').find('input[type="checkbox"]').addClass("form-check-input");

                    // Das nächste nähere div bekomme die Bootrap Klasse angehängt
                    checkbox.closest('div').addClass('form-check');


                    //Bild einfügen Button bekommt Bootstrap Klasse
                    $('.note-modal-content .note-modal-body').find('input[type="file"]').addClass("form-control");


                }
            }

        }


        summerNote.init();




        // Workaround 
        $('#sampleCode').empty().text('<div class="form-group form-summernote">\n\t<textarea name="myname" data-fv-notempty="true"></textarea>\n</div>')

        // Highlight
        hljs.highlightElement($('#sampleCode').get(0));

        // Kopierbar machen
        $('#sampleCode').copyToClipboard({
            buttonText: 'Kopieren',
            themeClass: 'theme-orthor',
            callback: function() {
                app.notify.success.fire("Kopiert", "Der Text wurde in die Zwischenablage kopiert");
            }
        });






        // Summernote initalisieren
        $('#summernote-marker').summernote({
            height: 300,
            lang: 'de-DE',
            toolbar: []
        }).on('summernote.change', function(customEvent, contents, $editable) {

            const rng = $('#summernote-marker').summernote('editor.getLastRange');

            // Content als Text
            var contentAsText = $(contents).text().trim();

            // Wenn das letze ein @ ist
            if (contentAsText.substr(contentAsText.length - 1) == '@') {
                createResult(rng);
            }
        });


        // Globales Objekt
        var global = false;

        // 
        var array = ["Tobias Pitzer", "Fabian Hamacher", "Leandro Schäfer", "Yusuf Gördück"];




        function extractThings() {

            // Range auslesen
            var range = $('#summernote-marker').summernote('getLastRange');


            // Wenn Return gedrückt wurde
            if (range.ec.length < range.eo) {
                console.log('Pressed Return');
            } else {





                var selection = $('#summernote-marker').find(".note-editable").prop('selectionEnd');

                // console.log(selection);


                // Range Object
                var newRng = range.getWordsMatchRange(/@/i)

                if (newRng) {

                    if (!global) {
                        global = true;
                    }


                    $('#summernote-marker').find('.note-editable').blur();

                    createResult();

                    console.log(newRng.toString()) // '@Peter Pan'
                }
            }
        }


        function search() {

        }

        function createResult(range) {

            $('#summernote-marker').parent().find('.note-editable').blur();

            $('#summernote-marker').parent().find('#test-hover').remove();

            var html = '' +
                '<div id="test-hover" style="position:absolute;left: 0px; top: 0px; height: 100%; width: 100%; background: white; backdrop-filter: blur(2px);padding: 20px;" >' +
                '<div class="form-group form-floating">' +
                '<select id="search" class="form-select init-select2 editable" name="name" placeholder="label">' +
                '<option value="">Bitte wählen</option>' +
                '</select>' +
                '<label>Land auswählen</label>' +
                '</div>' +
                '</div>';



            // 
            $('#summernote-marker').next().append(html);
            // $('#summernote-marker').parent().find('#test-hover #search').focus();

            var select2 = $('#summernote-marker').parent().find('#test-hover #search').select2({
                ajax: {
                    url: 'summernote-test-ajax.php',
                    dataType: 'json',
                    data: function(params) {
                        return params;
                    },
                    success: function(data) {
                        console.log('TEST');
                    },
                    error: function(jqXHR, a, errorThrown) {
                        if (errorThrown !== 'abort') {
                            app.alert.debugError("Fehler beim Quickselect", errorThrown, jqXHR.responseText);
                        }
                    }
                },
                language: 'de'
            });

            $('#summernote-marker').parent().find('#test-hover #search').select2("open");

            select2.on('change', function() {



                var value = $(this).val();
                var text = $('option:selected', this).text()

                console.log(text);

                console.log(range);
                range.eo = range.eo + 1;
                range.so = range.so + 1;

                if (value != 99999) {
                    range.pasteHTML(text);

                    range.ec.length = range.ec.length + text.length;
                    range.eo = range.eo + text.length;
                    range.so = range.so + text.length;

                }

                range.select();


                $('#summernote-marker').parent().find('#test-hover').remove();
            });
        }






    });
</script>


</html>