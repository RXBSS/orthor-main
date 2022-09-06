<?php include('01_init.php'); 

    $_page = [
        'title' => 'Chart'
    ];

?>
<!doctype html>

<!-- Head -->

<head>
    <title>chart</title>
    <?php include('02_header.php'); ?>

</head>


<!-- Body -->

<body>
    <?php include('03_navigation.php'); ?>

    <div class="wrapper">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <h4><i class="fa-solid fa-exclamation-circle"></i> Charts</h4>
                    <h6 class="subtext">Ein Plugin für das Erstellen und Nutzen von charts.</h6>
                    <p>Weitere Informationen und die Dokumentation findet man auf <a href="https://www.chartjs.org/">https://www.chartjs.org/</a>.</p>

                    

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="BarChart" width="100" height="100"></canvas>
                        </div>
                        <div class="col-md-6">
                        <pre ><code class="hljs language-html ctc"><!-- Canav mit id -->
<canvas id="BarChart" width="100" height="100"></canvas></code></pre>

                        <pre><code  class="hljs language-js ctc">//Code zum erstellen einer Chart wie links
var ctx = $('#BarChart');

var BarChart =  {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
}

var myChart1 = new Chart(ctx, BarChart);</code></pre>
                        </div>
                    </div>

                    <br>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="LineChart" width="100" height="100"></canvas>
                        </div>
                        <div class="col-md-6">
                            <pre><code  class="hljs language-html ctc"><!-- Canav mit id -->
<canvas id="LineChart" width="100" height="100"></canvas></code></pre>

                        <pre><code  class="hljs language-js ctc">//Beispiel zwei (Chart links)
var ctx2 = $('#LineChart');
var LineChart =  {

    //Art der Linie
    type: 'line',
    data: {

        //Beschreibungen der X Achse
        labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '...'],
        datasets: [{

            //Legende
            label: 'Work',

            fill: {
                target: 'origin',
                above: 'rgba(122, 185, 41, 0.48)',   
                below: 'rgb(0, 0, 255)'
            },
            
            //Setzt die Punkte 
            data: [20, 40, 40, 60, 40, 60, 40, 60, 40,30,30,30,50,80,120],

            //einzelne Farben der Punkte 
            backgroundColor: [
                'rgb(122, 185, 41)'
            ],
            borderColor: [
                'rgb(122, 185, 41)'
            ],
            borderWidth: 1
        },

        
        ]
    },
    //Y Achse
    options: {
        scales: {
            y: {
                display: true,
                beginAtZero: true
            }
        },
        suggestedMax: 200
    }
    
    
}

var myChart2 = new Chart(ctx2, LineChart);
                        </code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</body>

<?php include('04_scripts.php'); ?>

<!-- CDN charts.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {

        //Include erst Setup

        //Monate die auf der X Achse stehen
    


        // Bar Chart
        // -------------------------------------------------------------
        // -------------------------------------------------------------
        // -------------------------------------------------------------

        var ctx = $('#BarChart');
        

         

        var BarChart =  {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        }

        var myChart1 = new Chart(ctx, BarChart);


        // Line Chart
        // -------------------------------------------------------------
        // -------------------------------------------------------------
        // -------------------------------------------------------------

        var ctx2 = $('#LineChart');
        var LineChart =  {

            //Art der Linie
            type: 'line',
            data: {

                //Beschreibungen der X Achse
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '...'],
                datasets: [{

                    //Legende
                    label: 'Work',

                    fill: {
                        target: 'origin',
                        above: 'rgba(122, 185, 41, 0.48)',   
                        below: 'rgb(0, 0, 255)'
                    },
                    
                    //Setzt die Punkte 
                    data: [20, 40, 40, 60, 55, 60, 65, 75, 40,30,30,30,50,80,120],

                    //einzelne Farben der Punkte 
                    backgroundColor: [
                        'rgb(122, 185, 41)'
                    ],
                    borderColor: [
                        'rgb(122, 185, 41)'
                    ],
                    borderWidth: 1
                },

                
                ]
            },
            //Y Achse
            options: {
                scales: {
                    y: {
                        display: true,
                        beginAtZero: true
                    }
                },
                suggestedMax: 200
            }
            
            
        }

        var myChart2 = new Chart(ctx2, LineChart);

    });

</script>

</html>