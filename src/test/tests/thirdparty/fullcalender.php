<?php include('01_init.php');

$_page = [
    'title' => 'FullCalender'
];

?>
<!doctype html>
<html lang="de">

<!-- Head -->

<head>
    <title>Fullcalendar</title>
    <?php include('02_header.php'); ?>

</head>
<!-- FullCalender CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css">

<!-- FullCalender CSS Scheduler-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.9.0/main.min.css">

<!-- FullCalender CSS TimeLine -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/timeline@5.9.0/main.min.css">


<!-- Body -->

<body>
    <?php include('03_navigation.php'); ?>

    <div class="wrapper">
        <div class="container-fluid">


            <div class="alert alert-info">
                <strong>Todo</strong><br>
                - Kalender durchstylen<br>
                - Optionen hinzufügen (Tages, Monats, Jahr, Agenda)<br>
                - Scheduler einbinden<br>
                - Events hinzufügen
            </div>

            <!-- ----------------------------------------- -->
            <!-- Decscription -->
            <!-- ----------------------------------------- -->
            <div class='card'>
                <div class='card-body'>
                    <h4><i class="fa-solid fa-exclamation-circle"></i> Full Calender</h4>
                    <h6 class="subtext">Ein Plugin für das Erstellen und Nutzen des FullCalender.</h6>
                    <p>Weitere Informationen und die Dokumentation findet man auf <a href="https://fullcalendar.io/">https://fullcalendar.io/</a>.</p>

                    <hr>

                    <div class="row">
                        <div class="col">
                            <div class='card'>
                                <div class='card-body'>
                                    <h4><i class='fas fa-check'></i> <a href="#fullcalenderNr1">FullCalender Anleitung</a> </h4>
                            
                                    <h6 class='subtext'>Schritt für Schritt Anleitung.</h6>

                                    <table class="table">
                                        <tr>
                                            <td><code>FullCalender Aufruf</code></td>
                                            <td>
                                                Es muss ledigliche eine div mit einer id oder class definiert werden <pre><code class="hljs language-html ctc"><div class="fullCalender"></div></code></pre>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>Klassen Aufruf</code></td>
                                            <td>
                                                Mit der id oder class im constructor kann die Klasse <strong><i>FullCalendarCard</i></strong> wie folgt aufgerufen werden:
                                                <pre><code class="hljs language-js ctc">var fullCalender = new FullCalendarCard('#test', {});</code></pre>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>Default- und UserSettings</code></td>
                                            <td>
                                                Initialiert man keine eigenen Settings, werden automatisch <strong><i>DefaultSettings</i></strong> mit dem Aufruf der Klasse mitgegeben. <br>
                                                Optional kann man im constructor als zweiten Parameter <strong><i>UserSettings</i></strong> mitgeben, z.B. wie folgt:
                                                <pre><code class="hljs language-js ctc">var fullCalender = new FullCalendarCard('#test', {
    locale: 'fr'
});</code></pre>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><code>icon</code></td>
                                            <td>
                                                Zusätzlich kann im constructor als <strong>dritter Parameter</strong>  Custom Settings übergeben werden. <br>
                                                Aktuell gibt es nur das Setting <strong><i>icon</i></strong>, aber dies kann ggf. erweitert werden.
                                                <strong><i>Default des icons ist true</i></strong>. Dort werden vordefinierte Icons geladen. Nebenbei kann man auch eigene icons definieren. 
                                                Diese werden einfach mit angefügt<br>
                                                Falls man <strong><i>icon: false</i></strong> setzt, können nur eigene Icons definiert werden, z.B. wie folgt:
                                                <pre><code class="hljs language-js ctc">var fullCalender = new FullCalendarCard('.cc-FullCalenderExample', { }, {
    icon: false
});</code></pre>
                                                <i class="fa-solid fa-exclamation-triangle fa-2x" style="color:red;"></i> <strong>Die Custom Icons <u>MÜSSEN</u> in der class actions sein</strong> z.B.
                                                <pre><code class="hljs language-html ctc"><div class="actions"><!-- HIER DIE ICONS --></div></code></pre>
                                             </td>
                                        </tr>
                                    </table>
                                
                            
                                </div>
                            </div>
                        </div>
                    </div>
            
            
            
                </div>
            </div>

            <!-- ----------------------------------------- -->
            <!-- Modal für Event -->
            <!-- ----------------------------------------- -->
            <div class="modal" id="fullCalenderModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Modal body text goes here.</p>
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control editable" placeholder="Bezeichnung">
                                <label>Bezeichnung</label>
                            </div>
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control editable" placeholder="Bezeichnung">
                                <label>Bezeichnung</label>
                            </div>
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </div>
            </div>

            <!-- ----------------------------------------- -->
            <!-- Kalender NR. 1 -->
            <!-- ----------------------------------------- -->
            <div class="row">
                <div class="col-md-6">
                    <div class="cc-FullCalenderExample"></div>

                </div>
                <div class="col-md-6">
                    <div class='card'>
                        <div class='card-body'>
                            <pre><code class="hljs language-js ctc">//DefaultSettings
var fullCalender = new FullCalendarCard('.cc-FullCalenderExample');</code></pre>
                            <pre><code class="hljs language-js ctc">// UserSettings
var fullCalender = new FullCalendarCard('.cc-FullCalenderExample', {
    events: [
        {
            id: 'neuesEvent',
            title: 'Zeit',
            start:  moment().format('YYYY-MM-DD') + 'T08:00:00',
            end:  moment().format('YYYY-MM-DD') + 'T16:30:00',
            color: 'black'
        }
    ],
})</code></pre>

                    
                        </div>
                    </div>
              
                </div>
            </div>
            




           


            <!-- ----------------------------------------- -->
            <!-- Kalender NR. 2 -->
            <!-- ----------------------------------------- -->
            <hr class="mt-5 mb-5">

           

            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fas fa-check'></i> Kalender-Card</h4>
            
                    <h6 class='subtext'>Dabei sollte es sich um einen Kalender handeln der direkt in einer Card aufgerufen wird.</h6>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <!-- Kalender Card -->
                    <div class='card card-calendar' id="calender-card-id">
                        <div class='card-body'>
                            <div class="card-title" id="fullcalenderNr1">FullCalender Nr. 2</div>

                            
                                <!-- Action Items -->
                                <div class="actions">

                                    <a class="action-item cc-random-view" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Random View"><i class="fa-solid fa-hotdog"></i></a>
                                    <a class="action-item" href="javascript:void(0);" id="dropdownMenu2" data-bs-toggle="dropdown" data-bs-placement="top"><i class="fa-solid fa-eye"></i></a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <li><button class="dropdown-item cc-btn-change-view" data-view="listDay" type="button">Liste Tag</button></li>
                                        <li><button class="dropdown-item cc-btn-change-view" data-view="listWeek" type="button">Liste Woche</button></li>
                                        <li><button class="dropdown-item cc-btn-change-view" data-view="listMonth" type="button">Liste Monat</button></li>
                                        <li><button class="dropdown-item cc-btn-change-view" data-view="dayGridDay" type="button">Kacheln Tag</button></li>
                                        <li><button class="dropdown-item cc-btn-change-view" data-view="dayGridWeek" type="button">Kacheln Woche</button></li>
                                        <li><button class="dropdown-item cc-btn-change-view" data-view="dayGridMonth" type="button">Kacheln Monat</button></li>
                                        <li><button class="dropdown-item cc-btn-change-view" data-view="timeGridDay" type="button">Zeit Tag</button></li>
                                        <li><button class="dropdown-item cc-btn-change-view" data-view="timeGridWeek" type="button">Zeit Woche</button></li>
                                    </ul>
                                    <a class="action-item cc-btn-refresh" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Neu Laden"><i class="fa-solid fa-sync"></i></a>
                                    <a class="action-item cc-btn-today" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Heute"><i class="fa-solid fa-calendar-day"></i></a>
                                    <a class="action-item cc-btn-prev" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Vorheriger Tag"><i class="fa-solid fa-angle-left"></i></a>
                                    <a class="action-item cc-btn-next" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Nächste Tag"><i class="fa-solid fa-angle-right"></i></a>
                                </div>
                                <h4><i class="fa-solid fa-calendar-alt"></i> <span class="cc-current"></span></h4>

                                <div class='cc-calendar'> </div>

                            </div>
                        </div>
                    </div> 
                

                </div>
            </div>

           


            

        </div>

    </div>


</body>



<?php include('04_scripts.php'); ?>


<!-- CDN FullCalender -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/locales-all.min.js"></script>

<!-- CDN FullCalender Scheduler -->
<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.9.0/main.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.9.0/locales-all.min.js"></script> -->

<!-- CDN FullCalender TimeLine -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timeline@5.9.0/main.global.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timeline@5.9.0/main.min.js"></script> -->

<script>




    $(document).ready(function() {

        // $(function () {
        //     $('[data-bs-toggle="tooltip"]').tooltip()
        // });

        // Parent ist
        var el = $('#calender-card-id');


        var cardCalender = new FullCalendar.Calendar(el.find('.cc-calendar').get(0), {
            headerToolbar: false,
            locale: 'de',
            datesSet: function(info) {

                var start = moment(info.start).format('DD.MM.YYYY');
                var ende = moment(info.end).format('DD.MM.YYYY');

                $('.cc-current').html((['listDay', 'dayGridDay', 'timeGridDay'].indexOf(info.view.type) >= 0) ? start : start + " - " + ende);
            },

            events: [{
                id: '1',
                title: 'Heute Event',
                start: moment().format('YYYY-MM-DD'),
                color: 'red'
            },{
                id: '2',
                title: 'Letzte Woche',
                start: moment().subtract(7,'days').format('YYYY-MM-DD'),
            },{
                id: '3',
                title: 'Morgen Event',
                start: moment().add(1, 'days').format('YYYY-MM-DD'),
                color: 'green'
            }]
        });

        cardCalender.render();


        el.on('click', '.cc-random-view', function() {
            var views = [false, 'listDay', 'listWeek', 'listMonth', 'dayGridDay', 'dayGridWeek', 'dayGridMonth', 'timeGridDay', 'timeGridWeek'];
            var random = Math.floor(Math.random() * 8) + 1;
            cardCalender.changeView(views[random]);
        });

        el.on('click', '.cc-btn-change-view', function() {
            var view = $(this).data('view');
            cardCalender.changeView(view);
        });

        el.on('click', '.cc-btn-next', function() {
            cardCalender.next();
        });
        el.on('click', '.cc-btn-prev', function() {
            cardCalender.prev();
        });
        el.on('click', '.cc-btn-today', function() {
            cardCalender.today();
        });
        el.on('click', '.cc-btn-refresh', function() {
            cardCalender.refetchEvents();
            app.notify.info.fire("Neu geladen", "Die Events wurden neu gelanden!");
        });



        // -------------------------------------------------------------------------------------------------
        // -------------------------------------------------------------------------------------------------
        // -------------------------------------------------------------------------------------------------






        // Init Modal
        var modalFullCalender = new ModalForm('#fullCalenderModal');

        var fullCalender = new FullCalendarCard('.cc-FullCalenderExample', {
            events: [
                {
                    id: 'neuesEvent',
                    title: 'Zeit',
                    start:  moment().format('YYYY-MM-DD') + 'T08:00:00',
                    end:  moment().format('YYYY-MM-DD') + 'T16:30:00',
                    color: 'black'
                }
            ],
        });

        // Just for Fun
        $('.fc-timegrid-event-harness').on('click', function() {

            modalFullCalender.open();

        });


    
       

    });
</script>

</html>