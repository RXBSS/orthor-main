<?php include('01_init.php');

$_page = [
    'title' => "Form Sample 4",
    'breadcrumbs' => ['<a href="form-handler">Form Handler</a>']
];

?>
<!doctype html>

<head>
    <?php include('02_header.php'); ?>
</head>

<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="container-fluid">


            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-plus-minus"></i> Beispiel einer dynamischen Form</h4>
                    <h6 class="subtext">In dieser Form kann N Werte einfügen. In vielen Fällen ist es aber sinnvoller eine Pickliste einzusetzen</h6>
                    <br>
                    <ul>
                        <li>Laden / Reset von Daten geht nocht nicht</li>
                        <li>Programmierung muss noch verbessert werden</li>
                        <li>Würde nicht mit mehreren Feldern funktionieren</li>
                        <li>Funktioniert aktuell nur mit Input</li>
                        <li>Label und Name werden noch nicht dynamisch generiert</li>
                        <li>Es gibt noch keine Dubletten-Prüfung</li>
                    </ul>
                    <br>
                    <div class="row">
                        <div class="col-md-6">

                            <form id="form-test">
                                <div id="dynamic-form">

                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary">Speichern</button>
                                    <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Reset</button>
                                    <button type="button" class="btn btn-secondary btn-add-line"><i class="fa-solid fa-plus"></i> Weitere Zeile</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    var test = {

        init() {

            var me = this;

            // Container der dynamischen Form
            me.c = $('#dynamic-form');

            // Form Initalisieren
            me.initForm();

            // Form Creator
            me.fc = new FormCreator();

            // Event Listner
            me.addListner();

            // Laden
            me.load();

        },

        initForm() {

            var me = this;

            // Form
            me.form = new Form('#form-test');

            // Validiation initalisieren
            me.form.initValidation();
        },


        addListner() {

            var me = this;

            // Weitere Zeile hinzufügen
            me.form.container.on('click', '.btn-add-line', function() {
                me.addElement();
            });

            // Löschen der Zeile
            me.c.on('click','.btn-remove-line', function() {
                var el = $(this);
                me.removeElement(el);
            });

            // Index
            me.c.on('focusout','input',function() {
                var el = $(this);
                var lastEl = me.c.find('.line:nth-child(' + me.c.find('.line').length + ')').find('input');
                if(el.get(0) == lastEl.get(0) && $(this).val()) {
                    me.addElement();
                }
            });


        },

        // Laden
        load() {

            var me = this;

            // Wenn schon Daten da sind
            var el = me.createElement();
            me.c.append(el);
        },

        addElement() {
            var me = this;

            // validieren

            // Nur ein neues Element erstellen, wenn das davor gefüllt ist?
            var lastEl = me.c.find('.line:nth-child(' + me.c.find('.line').length + ')').find('input');

            console.log(lastEl);

            if(lastEl.val()) {
                var el = me.createElement();
                me.c.append(el);
                
                
                var lastEl = me.c.find('.line:nth-child(' + me.c.find('.line').length + ')').find('input');
                lastEl.focus();

            } else {
                app.notify.error.fire("Fehler","Bitte füllen Sie die letzte Zeile aus, bevor Sie eine weitere hinzufügen");
            }
        },




        createElement() {

            var me = this;

          
            // Element
            var el = '' +
                '<div class="line d-flex">' +
                '<div class="flex-grow-1">' +
                    me.fc.createInput('name-1', 'Beispiel 1') +
                '</div>' +
                '<div class="flex-grow-0" style="padding-top: 32px;padding-left: 10px;"><a class="btn-remove-line text-danger" tabindex="-1" href="javascript:void(0);"><i class="fa-solid fa-xmark"></i></a></div>' +
                '</div>';

            return el;
        },

        removeElement(el) {
            var me = this;
            
            if(me.c.find('.line').length > 1) {
                var line = el.closest('.line');
                line.remove();
            }
        }

    




    }

    $(document).on('app:ready', function() {
        test.init();
    });
</script>

</html>