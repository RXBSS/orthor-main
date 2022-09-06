<?php include('01_init.php');

$_page = [
    'title' => "Timeline"
];

?>
<!doctype html>

<head>
    <?php include('02_header.php'); ?>

    <style>
        @keyframes animation_blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.4;
            }

            100% {
                opacity: 1;
            }
        }

        .bubble-custom .tl-icon {
            color: purple;
            opacity: 0.5;
        }

        .bubble-custom .tl-date .datum {
            color: purple;
            opacity: 0.5;
        }

        .bubble-custom .tl-circle:after {
            background: purple !important;
            border-color: purple !important;
            border-radius: 0px !important;
        }

        .bubble-custom .tl-content-main-bubble {
            color: white !important;
            font-size: 20px !important;
            text-shadow: 2px 2px #ff0000;
            border-radius: 0px;
            border: 2px solid yellow;
            background: linear-gradient(to left top, rgb(255, 0, 0), rgb(255, 191, 0), rgb(128, 255, 0), rgb(0, 255, 64), rgb(0, 255, 255), rgb(0, 64, 255), rgb(128, 0, 255), rgb(255, 0, 191), rgb(255, 0, 0)) !important;
        }

        .bubble-custom .tl-content-main-bubble span {
            animation-name: animation_blink;
            animation-timing-function: ease-in;
            animation-duration: 0.7s;
            animation-iteration-count: infinite;
        }
    </style>
</head>

<body>
    <?php include('03_navigation.php'); ?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fa-solid fa-clock'></i> Timeline</h4>
                    <h6 class='subtext'>Die Timeline ist eine Eigenprogrammierung zum Darstellen von Ereignissabläufen</h6>

                    <p>
                        Die Timeline wird zunächst mit einem <code>new Timeline('selector')</code> erstellt.
                        Anschließend muss man die Daten integrieren. Dies kann man mit der Funktion <code>setData([{...}])</code>,
                        mit <code>timeline.data = [{...}]</code> oder via Ajax machen. Das Objekt, dass die Timeline erwartet ist immer gleich aufgebaut.
                    </p>


                    <div class="row">
                        <div class="col-md-6">
                            <div id="timeline-ex1"></div>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-javascript ctc">// Beispiel Datensatz
var dataSet = [
...
{
    'timestamp': '2021-05-06 10:20:00',
    'icon': 'fa fa-check',
    'content': 'Das ist der Inhalt'
    'subcontent': 'Das ist oben drüber'
},
...
];

// Erstellen
var timeline = new Timeline('#timeline');

// Daten setzen
timeline.setData(dataSet);

// Write Data
timeline.render();
</code></pre>
                        </div>
                    </div>

                </div>
            </div>

            <strong><i class="fa-solid fa-arrow-down"></i> Timeline außerhalb einer Card</strong>
            <div id="timeline-ex2" class="mb-5"></div>



            <div class="card mb-5">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-paintbrush"></i> Style der Timeline</h4>
                    <h6 class="subtext">
                        Mit Hilfe des Attributes <code>class</code> kann man der Bubble verschiendene Klassen mitgeben. Es gibt verschiedene vordefinierte Klasse.
                        Diese können genutzt werden um die einzelnene Bereiche anzupassen. Zur Verfügung stehen: <code>dot-xxx</code>, <code>icon-xxx</code>, <code>blubble-xxx</code>
                    </h6>


                    <div class="row">
                        <div class="col-md-6">
                            <div id="timeline-style-0"></div>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-javascript ctc">[{
    'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
    'icon': 'fa-solid fa-exclamation-triangle',
    'class': 'dot-warning icon-warning bubble-warning',
    'content': 'Das ist eine Warnung'
}, {
    'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
    'class': 'date-none dot-none bubble-label bubble-primary bubble-tight',
    'content': '<i class="fa-solid fa-check"></i> Das hast du toll gemacht!'
}, {
    'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
    'class': 'bubble-silent bubble-tight dot-secondary',
    'content': '<i class="fa-solid fa-user-ninja"></i> Ich bin ein Ninja'
}, {
    'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
    'icon': 'fa-solid fa-text-height',
    'content': 'Das ist <strong>bubble-scroll-sm</strong><br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
    'class': 'bubble-scroll-sm'
},{
    'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
    'icon': 'fa-solid fa-wand-magic-sparkles',
    'content': '<span>Das ist Custom</span>',
    'class': 'bubble-custom'
}];</code></pre>
                        </div>
                    </div>





                    <hr>


                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-style-1"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>dot-xxx</strong><br>
                            <ul>
                                <li>.dot-primary</li>
                                <li>.dot-secondary</li>
                                <li>.dot-success</li>
                                <li>.dot-warning</li>
                                <li>.dot-danger</li>
                                <li>.dot-info</li>
                                <li>.dot-light</li>
                                <li>.dot-dark</li>
                            </ul>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-style-2"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>icon-xxx</strong><br>
                            <ul>
                                <li>.icon-primary</li>
                                <li>.icon-secondary</li>
                                <li>.icon-success</li>
                                <li>.icon-warning</li>
                                <li>.icon-danger</li>
                                <li>.icon-info</li>
                                <li>.icon-light</li>
                                <li>.icon-dark</li>
                            </ul>
                        </div>
                        <div class="col-md-4">




                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-style-3"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>bubble-xxx</strong><br>
                            <ul>
                                <li>.bubble-primary</li>
                                <li>.bubble-secondary</li>
                                <li>.bubble-success</li>
                                <li>.bubble-warning</li>
                                <li>.bubble-danger</li>
                                <li>.bubble-info</li>
                                <li>.bubble-light</li>
                                <li>.bubble-dark</li>
                            </ul>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-style-4"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>.bubble-tight</strong><br>
                            Im Normalfall ist die Blase immer so groß, wie das Datum. Mit der Klasse <code>.bubble.tight</code> kann man dies verhindern.
                            Dann sollte man allerdings nicht mehr <code>subcontent</code> nutzen.
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-style-5"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>.bubble-label</strong><br>
                            Wandelt die Bubble in ein Label um (Breiter Rand). Kann natürlich mit allen Klassen kombiniert werden.<br>

                            Insbesondere sollte hier immer die Klasse <code>.bubble-tight</code> angewendet werden, sonst sieht es komisch aus.<br>
                            Ein Desingvorschlag wäre hier auch das Icon in das Label zu verschieben. Dazu einfach das Icon frei lassen und in den Content übernehmen.
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-style-6"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>.bubble-silent</strong><br>
                            Kann zum Beispiel für Ereignisse verwendet werden.
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-style-7"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>.XXX-none</strong><br>
                            Mit der none-Klasse kann man verschiedene Dinge ausblenden.

                            <ul>
                                <li>
                                    <strong> .date-none</strong>
                                </li>
                                <li>
                                    <strong>.dot-none</strong>
                                </li>
                                <li>
                                    <strong>.icon-none</strong><br>(kann auch erreicht werden, wenn man Icon nicht übergibt)
                                </li>
                                <li>
                                    <strong> .bubble-none</strong>
                                </li>
                            </ul>


                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-style-8"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>.bubble-scroll</strong><br>
                            In diesem Beispiel wird der Bubble eine Scrollbar hinzugefügt.

                            <ul>
                                <li>bubble-scroll</li>
                                <li>bubble-scroll-sm</li>
                                <li>bubble-scroll-lg</li>
                            </ul>
                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-style-8a"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>.bubble-collapse</strong><br>
                            Damit soll die Bubble auf eine bestimmte größe beschränkt werden. Durch anklicken der Bubble kann man diese dann voll öffnen.
                            <div class="alert alert-soft-warning">Ist geplant, benötigt aber vermutlich JavaScript.</div>


                        </div>
                        <div class="col-md-4">

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-style-9"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>Eigene Klasse</strong><br>
                            Man kann natürlich auch einfach eigene Klassen vergeben.
                            Wichtig ist, dass man hier die richtige Klasse nutzt, ansonsten muss man mit !important überschreiben.

                            Im Beispiel rechts mit <code>.my-custom</code>
                        </div>
                        <div class="col-md-4">
                            CSS zum Überschreiben der Standard Styles
                            <pre><code class="language-css ctc">ul.timeline > li.my-custom .tl-content .tl-icon {...}

ul.timeline > li.my-custom .tl-content .tl-date {...}

ul.timeline > li.my-custom .tl-content .tl-circle:after {...}

ul.timeline > li.my-custom .tl-content .tl-content-main-bubble {...}
</code></pre>

                        </div>
                    </div>
                </div>
            </div>

            <div class='card'>
                <div class='card-body'>
                    <h4><i class='fa-solid fa-book'></i> Dokumentation</h4>
                    <h6 class='subtext'>Hier eine Erklärung zu den verschiednen Optionen</h6>

                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-doku-1"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>dateFormat</strong> <code>Option</code><br>
                            Die Option ist Standardmäßig <code>DD.MM.YYYY</code>.
                            Hier kann jeder beliebige Zeitstempel aus <a href="https://momentjs.com/docs/#/parsing/string-format/">moment.js</a> angegeben werden.
                            Alternativ kann man auch <code>'text'</code> angeben. Dann wird das Datum automatisch in eine String umgewandelt.
                            Zum Beispiel: gestern, morgen, vor 1 Woche, ...
                            Es kann auch <code>false</code> angegeben werden. Dann wird kein Datum mit ausgegeben.
                        </div>
                        <div class="col-md-4">
                            <pre><code class="language-javascript ctc">// Erstellen
var timeline = new Timeline('#timeline', {
    dateFormat: 'YYYY-MM-DD'
});</code></pre>
                            <pre><code class="language-javascript ctc">// Erstellen
var timeline = new Timeline('#timeline', {
    dateFormat: 'text'
});</code></pre>
                            <pre><code class="language-javascript ctc">// Erstellen
var timeline = new Timeline('#timeline', {
    dateFormat: false
});</code></pre>
                        </div>
                    </div>






                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-doku-4"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>timeFormat</strong> <code>Option</code><br>
                            Die Option ist Standardmäßig <code>HH:mm</code>.
                            Hier kann jeder beliebige Zeitstempel aus <a href="https://momentjs.com/docs/#/parsing/string-format/">moment.js</a> angegeben werden.
                            Es kann auch <code>false</code> angegeben werden. Dann wird keine mit ausgegeben.
                            Bei <code>dateFormat: 'text'</code> wird dieser Parameter ignoriert.
                        </div>
                        <div class="col-md-4">
                            <pre><code class="language-javascript ctc">// Erstellen
var timeline = new Timeline('#timeline', {
    timeFormat: 'HH:mm:ss'
});</code></pre>
                            <pre>
<pre><code class="language-javascript ctc">// Erstellen
var timeline = new Timeline('#timeline', {
    timeFormat: false
});</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-doku-5"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>showZeroTime</strong> <code>Option</code><br>
                            Die Option ist Standardmäßig <code>false</code>. Dies bewirkt, dass bei einem Zeitstempel mit 00:00:00 automatisch die Zeit ausgeblendet wird.
                            So kann man auch einen Mix aus genauen und ungenauen Zeiten darstellen ohne nervige Nullen dabei zu haben.
                            Bei true werden die Nullen trotzdem ausgegeben.

                        </div>
                        <div class="col-md-4">
                            <pre><code class="language-javascript ctc">// Erstellen
var timeline = new Timeline('#timeline', {
    showZeroTime: true
});</code></pre>
                            <pre>
<pre><code class="language-javascript ctc">// Erstellen
var timeline = new Timeline('#timeline', {
    showZeroTime: false // Default
});</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-doku-6"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>parseFormat</strong> <code>Option</code><br>
                            Bei dieser Option kann man angeben, wie der Zeitstempel geparst werden soll.
                            Im Standard wird der Zeitstempel einfach an moment übergeben. Im Regelfall ist das auch ausreichend.
                        </div>
                        <div class="col-md-4">
                            <pre><code class="language-javascript">// Datensatz mit deutscher Zeit
var dataSet = [{
    'timestamp': '01.03.2021',
    'icon': 'fa fa-check',
    'content': 'Das ist der Inhalt'
}, {
    'timestamp': '01.07.2021',
    'icon': 'fa fa-truck',
    'content': 'Das ist mehr Inhalt'
}];
                                
// Erstellen
var timeline = new Timeline('#timeline', {
    parseFormat: 'DD.MM.YYYY'
});</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-doku-6"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>interval</strong> <code>Option</code><br>
                            Diese Option gibt an, ob die Zeitleiste in diesem Interval aktualisiert wird!
                            Achtung. Das meint nicht, dass die Daten z.B. per Ajax neu geladen werden.
                            Die Funktion dient eigentlich hauptsächlich um den Text aktuell zu halten, den man unter <code>dateFormat</code>
                            aktivieren kann. Deshalb wird diese Option auch (wenn Sie nicht überschrieben wird) automatisch aktiviert
                            sobald man <code>dateFormat: 'text'</code> einstellt. Dann wird nämlich <code>interval: 60</code> gesetzt.
                        </div>
                        <div class="col-md-4">
                            <pre><code class="language-javascript ctc">// Erstellen
var timeline = new Timeline('#timeline', {
    interval: 60
});</code></pre>
                            <pre><code class="language-javascript ctc">// Erstellen
var timeline = new Timeline('#timeline', {
    interval: false // Default
});</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-doku-7"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>select</strong> <code>Event</code><br>
                            Es gibt ein Select Event. Dies gibt bei einem Klick die jeweiligen Daten des Elements zurück.
                            Diese haben die Struktur wie bei setData. Zusätzlich enthalten Sie noch einen moment Objekt des Zeitstempels.
                        </div>
                        <div class="col-md-4">
                            <pre><code class="language-javascript ctc">// Erstellen
var timeline = new Timeline('#timeline');

timeline.on('select', function(el, data) {
    console.log(data);
})</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-doku-8" class="tl-future"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>.tl-future</strong> <code>Style</code><br>
                            Wenn man die CSS Klasse <code>.tl-future</code> mit in den Container setzt, dann wird alles was in der Zukunft stattfindet mit einer anderen Opacity angegeben.
                            <br>
                            So kann man auf den ersten Blick besser erkennen, was bereits passiert ist und was nicht. Man kann beim Timestamp übrigens auf false angeben.
                            Dieser wird dann automatisch als Zukunft bewertet, auch wenn kein Datum und Uhrzeit ausgegeben wird.
                        </div>
                        <div class="col-md-4">
                            <pre><code class="language-html ctc"><!-- Container mit der Klasse -->
<div id="timeline" class="tl-future"></div>
                        </code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-doku-8" class="tl-future"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>setData</strong> <code>Methode</code><br>
                            Erwartet ein Array mit Objekten. Der Timestamp darf false und das Icon leer sein.
                        </div>
                        <div class="col-md-4">
                            <pre><code class="language-javascript ctc">timeline.setData([{
    'timestamp': false,
    'icon': 'fa-solid fa-star',
    'content': 'Feedback einholen'
}, {
    'timestamp': '2021-05-12',
    'icon': 'fa-solid fa-phone',
    'content': 'Nachfragen beim Kunden'
}]);</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-doku-9"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>addData</strong> <code>Methode</code><br>
                            <p>
                                Fügt einen oder mehrere Datensätze an. Kann ein Array mit Objekten oder ein einzelnes Objekt sein.
                            </p>
                            <button id="btn-example-9-add-single" class="btn btn-primary mb-2">Datensatz hinzufügen</button><br>
                            <button id="btn-example-9-add-multi" class="btn btn-primary mb-2">Mehrere Datensätze hinzufügen</button><br>
                            <button id="btn-example-9-reset" class="btn btn-secondary">Reset</button>
                        </div>
                        <div class="col-md-4">
                            <pre><code class="language-javascript ctc">timeline.addData([{
    'timestamp': '2021-09-13',
    'icon': 'fa-solid fa-star',
    'content': 'Feedback einholen'
}]);</code></pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="timeline-doku-10"></div>
                        </div>
                        <div class="col-md-4">
                            <strong>setDataFromAjax</strong> <code>Methode</code><br>
                            <p>
                                Holt die Daten von einem JSON via Ajax. Der erste Parameter ist ein Objekt in dem auf jeden Fall die URL angegeben sein muss.
                                Der zweite ist ein Callback, wenn die Daten abgerufen wurden.
                                <br>
                                Beim Callback wird die Instanz mit übergeben
                            </p>
                        </div>
                        <div class="col-md-4">
                            <pre><code class="language-javascript ctc">timeline.setDataFromAjax({
    url: 'link/to/file.php', // oder .json
    data: {
        // Zusätzliche Daten (PHP)
    }
}, function(tm) {
    tm.render();
});</code></pre>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>
<script>
    $(document).on('app:ready', function() {

        // Datensatz
        var dataSet = [{
            'timestamp': moment().add(4, 'weeks').add(876, 'minutes').format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'content': 'Feedback einholen'
        }, {
            'timestamp': moment().add(1, 'days').add(50, 'minutes').format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-phone',
            'content': 'Nachfragen beim Kunden',
            'subcontent': '<i class="fa-solid fa-user"></i> Tobias Pitzer'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-truck',
            'content': 'Lieferung der Ware'
        }, {
            'timestamp': moment().subtract(1, 'days').subtract(140, 'minutes').format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-shopping-cart',
            'content': 'Bestellung des Kunden'
        }];


        var timeline1 = new Timeline('#timeline-ex1');

        // Daten setzen
        timeline1.setData(dataSet);

        // Write Data
        timeline1.render();

        timeline1.on('select', function(el, data) {

            console.log(data);
            app.notify.info.fire("Icon: <i class='" + data.icon + "'></i> Zeit: " + data.moment.format('DD.MM.YYYY HH:mm'), "Der Text: " + data.content);
        });

        var timeline2 = new Timeline('#timeline-ex2');

        // Daten setzen
        timeline2.setData(dataSet);

        // Write Data
        timeline2.render();




        // Doku 1
        new Timeline('#timeline-doku-1', {
            dateFormat: 'text'
        }).setData(dataSet).render();

        new Timeline('#timeline-doku-4', {
            timeFormat: 'HH:mm:ss'
        }).setData(dataSet).render();


        // Doku 1
        new Timeline('#timeline-doku-5').setData([{
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-truck',
            'content': 'Zeitstempel mit Werten'
        }, {
            'timestamp': moment().format('YYYY-MM-DD 00:00:00'),
            'icon': 'fa-solid fa-truck',
            'content': 'Zeitstempel mit 00:00:00'
        }]).render();

        new Timeline('#timeline-doku-6', {
            parseFormat: 'DD.MM.YYYY'
        }).setData([{
            'timestamp': '01.03.2021',
            'icon': 'fa-solid fa-check',
            'content': 'Das ist der Inhalt'
        }, {
            'timestamp': '01.07.2021',
            'icon': 'fa-solid fa-truck',
            'content': 'Das ist mehr Inhalt'
        }]).render();


        var timeline7 = new Timeline('#timeline-doku-7', {
            timeFormat: 'HH:mm:ss'
        }).setData(dataSet).render();

        timeline7.on('select', function(el, data) {

            console.log(data);
            app.notify.info.fire("Icon: <i class='" + data.icon + "'></i> Zeit: " + data.moment.format('DD.MM.YYYY HH:mm'), "Der Text: " + data.content);
        });

        // Doku 1
        new Timeline('#timeline-doku-8').setData([{
            'timestamp': false,
            'icon': 'fa-solid fa-star',
            'content': 'Feedback einholen'
        }, {
            'timestamp': moment().add(1, 'days').add(50, 'minutes').format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-phone',
            'content': 'Nachfragen beim Kunden'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-truck',
            'content': 'Lieferung der Ware'
        }, {
            'timestamp': moment().subtract(1, 'days').subtract(140, 'minutes').format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-shopping-cart',
            'content': 'Bestellung des Kunden'
        }]).render();

        // Doku 1
        var timeline9 = new Timeline('#timeline-doku-9', {
            timeFormat: 'HH:mm:ss'
        }).setData(dataSet).render();


        $('#btn-example-9-add-single').on('click', function() {
            timeline9.addData({
                'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-plus',
                'content': 'Neues Timeline Event'
            });
            timeline9.render();
        });

        $('#btn-example-9-add-multi').on('click', function() {
            timeline9.addData([{
                'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-award',
                'content': 'Mehrere auf Einmal 1/2'
            }, {
                'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-bullhorn',
                'content': 'Mehrere auf Einmal 2/2'
            }]).render();
        });

        var old = dataSet;

        $('#btn-example-9-reset').on('click', function() {
            timeline9.setData([{
                'timestamp': moment().add(4, 'weeks').add(876, 'minutes').format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-star',
                'content': 'Feedback einholen'
            }, {
                'timestamp': moment().add(1, 'days').add(50, 'minutes').format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-phone',
                'content': 'Nachfragen beim Kunden'
            }, {
                'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-truck',
                'content': 'Lieferung der Ware',
            }, {
                'timestamp': moment().subtract(1, 'days').subtract(140, 'minutes').format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-shopping-cart',
                'content': 'Bestellung des Kunden'
            }]).render();
        });

        // Doku 1
        var timeline10 = new Timeline('#timeline-doku-10', {
            timeFormat: false
        }).setDataFromAjax({
            url: 'timeline.json'
        }, function(tm) {
            tm.render();
        });


        // Doku 1
        var ts0 = new Timeline('#timeline-style-0', {
            timeFormat: false
        });

        ts0.setData([{
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-exclamation-triangle',
            'class': 'dot-warning icon-warning bubble-warning',
            'content': 'Das ist eine Warnung'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'class': 'date-none dot-none bubble-label bubble-primary bubble-tight',
            'content': '<i class="fa-solid fa-check"></i> Das hast du toll gemacht!'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'class': 'bubble-silent bubble-tight dot-secondary',
            'content': '<i class="fa-solid fa-user-ninja"></i> Ich bin ein Ninja'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-text-height',
            'content': 'Das ist <strong>bubble-scroll-sm</strong><br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
            'class': 'bubble-scroll-sm'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-wand-magic-sparkles',
            'content': '<span>Das ist Custom</span>',
            'class': 'bubble-custom'
        }]).render();

        // Doku 1
        var ts1 = new Timeline('#timeline-style-1', {
            timeFormat: false
        });

        ts1.setData([{
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'dot-primary',
            'content': 'Primary Dot'
        }, {
            'timestamp': moment().add(1, 'days').add(50, 'minutes').format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'dot-secondary',
            'content': 'Secondary Dot'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'dot-primary',
            'content': 'Success Dot'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'dot-warning',
            'content': 'Warning Dot'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'dot-danger',
            'content': 'Danger Dot'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'dot-info',
            'content': 'Info Dot'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'dot-light',
            'content': 'Light Dot'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'dot-dark',
            'content': 'Dark Dot'
        }]).render();


        // Doku 2
        var ts2 = new Timeline('#timeline-style-2', {
            timeFormat: false
        });

        ts2.setData([{
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'icon-primary',
            'content': 'Primary Icon'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'icon-secondary',
            'content': 'Secondary Icon'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'icon-primary',
            'content': 'Success Icon'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'icon-warning',
            'content': 'Warning Icon'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'icon-danger',
            'content': 'Danger Icon'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'icon-info',
            'content': 'Info Icon'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'icon-light',
            'content': 'Light Icon'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'icon-dark',
            'content': 'Dark Icon'
        }]).render();

        // Doku 3
        var ts3 = new Timeline('#timeline-style-3', {
            timeFormat: false
        });

        ts3.setData([{
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'bubble-primary',
            'content': 'Primary Bubble'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'bubble-secondary',
            'content': 'Secondary Bubble'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'bubble-primary',
            'content': 'Success Bubble'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'bubble-warning',
            'content': 'Warning Bubble'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'bubble-danger',
            'content': 'Danger Bubble'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'bubble-info',
            'content': 'Info Bubble'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'bubble-light',
            'content': 'Light Bubble'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'bubble-dark',
            'content': 'Dark Bubble'
        }]).render();

        // Doku 4
        var ts4 = new Timeline('#timeline-style-4');

        ts4.setData([{
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'content': 'Ohne der Wert Bubble Tight'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'bubble-tight',
            'content': 'Ohne der Wert Bubble Tight'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'content': 'Ohne der Wert Bubble Tight'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'bubble-tight',
            'content': 'Mit Wert und Subcontent',
            'subcontent': 'Hier der Subcontent'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'content': 'Ohne der Wert Bubble Tight'
        }]).render();

        // Doku 5
        var ts5 = new Timeline('#timeline-style-5');

        ts5.setData([{
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'bubble-label bubble-tight',
            'content': 'Label mit der Tight Klasse'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'class': 'bubble-label',
            'content': 'Label ohne die Tight Klasse'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'class': 'bubble-label bubble-tight',
            'content': '<i class="fa-solid fa-star"></i> Icon in Bubble'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'class': 'bubble-label bubble-tight bubble-danger',
            'content': '<i class="fa-solid fa-xmark"></i> mit noch mehr Klassen'
        }]).render();

        // Doku 6
        var ts6 = new Timeline('#timeline-style-6', {
            timeFormat: false
        });

        ts6.setData([{
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'content': 'Normale Bubble'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': '',
            'content': '<i class="fa-solid fa-check-double"></i> Das ist eine Siltent Bubble',
            'class': 'bubble-silent'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'content': 'Normale Bubble'
        }]).render();

        // Doku 7
        var ts7 = new Timeline('#timeline-style-7', {
            timeFormat: false
        });

        ts7.setData([{
                'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-star',
                'class': 'date-none',
                'content': 'Normale Bubble'
            }, {
                'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-star',
                'class': 'dot-none',
                'content': 'Normale Bubble'
            }, {
                'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-star',
                'class': 'icon-none',
                'content': 'Normale Bubble'
            }, {
                'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-star',
                'class': 'bubble-none',
                'content': 'Normale Bubble'
            },
            {
                'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-star',
                'class': 'date-none dot-none icon-none',
                'content': 'Komination, also außer Bubble'
            }
        ]).render();

        // Doku 8
        var ts8 = new Timeline('#timeline-style-8', {
            timeFormat: false
        });

        ts8.setData([{
                'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-text-height',
                'content': 'Das ist <strong>bubble-scroll</strong><br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                'class': 'bubble-scroll'
            },
            {
                'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-text-height',
                'content': 'Das ist <strong>bubble-scroll-sm</strong><br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                'class': 'bubble-scroll-sm'
            },
            {
                'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
                'icon': 'fa-solid fa-text-height',
                'content': 'Das ist <strong>bubble-scroll-lg</strong><br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                'class': 'bubble-scroll-lg'
            }
        ]).render();

        // // Doku 8
        // var ts8a = new Timeline('#timeline-style-8a', {
        //     timeFormat: false
        // });

        // ts8a.setData([{
        //         'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
        //         'icon': '<i class="fa-solid fa-text-height"></i>',
        //         'content': '<div id="accordion"><button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Link zum Ein- und Ausklappen</button><div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</div></div>',
        //     }
        // ]).render();    

        // Doku 9
        var ts9 = new Timeline('#timeline-style-9', {
            timeFormat: false
        });

        ts9.setData([{
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'content': 'Normale Bubble'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-wand-magic-sparkles',
            'content': '<span>Das ist Custom</span>',
            'class': 'bubble-custom'
        }, {
            'timestamp': moment().format('YYYY-MM-DD HH:mm:ss'),
            'icon': 'fa-solid fa-star',
            'content': 'Normale Bubble'
        }]).render();

    });
</script>

</html>