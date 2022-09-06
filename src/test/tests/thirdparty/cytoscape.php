<?php include('01_init.php');

$_page = [
    'title' => "Cytoscape"
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
                    <h4 class="card-title"><i class="fa-solid fa-project-diagram"></i> Cytoscape</h4>
                    <h6 class="subtext">Ein Plugin zum Visualisieren Verbindungen und Beziehungen.</h6>

                    <p>Cytoscape ist nicht über die Vendor eingebetten, wenn man es benötigt, dann muss man es über
                        <code>js/optionals/cytoscape.min.js</code> hinzufügen.
                    </p>


                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div id="example-chart-1" style="height: 400px; border: 1px solid black;"></div>
                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc"> var cy = cytoscape({
    container: $('#example-chart-1').get(0),
    elements: {
        nodes: [{
                data: {
                    id: 'a'
                },
                style: {
                    'background-color': 'red'
                }
            },
            {
                data: {
                    id: 'b'
                }
            }
        ],
        edges: [{
            data: {
                id: 'ab',
                source: 'a',
                target: 'b'
            }
        }]
    },
    layout: {
        name: 'grid',
        rows: 1
    },
    style: [{
        selector: 'node',
        style: {
            'label': 'data(id)'
        }
    }]
});</code></pre>
                        </div>
                    </div>
                </div>
            </div>


            <h3>Fertiges Beispiel</h3>


            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="actions"><a class="action-item" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Zurücksetzen"><i class="fa-solid fa-undo-alt"></i></a></div>
                            <h4 class="card-title"><i class="fa-solid fa-project-diagram"></i> Weiter Artikel</h4>

                            <div class="cytoscape" id="example-chart-2"></div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
</body>

<?php include('04_scripts.php'); ?>

<script src="js/optionals/cytoscape.min.js"></script>

<script>
    $(document).on('app:ready', function() {


        var ex2 = cytoscape({
            container: $('#example-chart-2').get(0),


            elements: [{
                    group: 'nodes',
                    data: {
                        id: 'n1',
                        parent: 'in Modell',
                    },
                    style: {
                        'background-color': 'red'
                    }
                },

                { // node n2
                    data: {
                        id: 'n2'
                    },
                    renderedPosition: {
                        x: 200,
                        y: 200
                    } // can alternatively specify position in rendered on-screen pixels
                },

                {
                    data: {
                        id: 'n3',
                        parent: 'in Modell'
                    },
                    position: {
                        x: 123,
                        y: 234
                    }
                },

                { // node nparent
                    data: {
                        id: 'in Modell'
                    }
                },

                { // edge e1
                    data: {
                        id: 'e1',
                        // inferred as an edge because `source` and `target` are specified:
                        source: 'n1', // the source node id (edge comes from this node)
                        target: 'n2' // the target node id (edge goes to this node)
                        // (`source` and `target` can be effectively changed by `eles.move()`)
                    },

                    pannable: true // whether dragging on the edge causes panning
                },
                {
                    data: {
                        id: 'ar-src'
                    }
                },
                {
                    data: {
                        id: 'ar-tgt'
                    }
                },
                {
                    data: {
                        source: 'ar-src',
                        target: 'ar-tgt',
                        label: 'autorotate (move my nodes)'
                    },
                    classes: 'autorotate'
                },
            ],
            layout: {
                name: 'grid',
                rows: 1
            },
            style: [{
                selector: 'node',
                style: {
                    'label': 'data(id)'
                }
            }]
        });



        var cy = cytoscape({
            container: $('#example-chart-1').get(0),
            elements: {
                nodes: [{
                        data: {
                            id: 'a'
                        },
                        style: {
                            'background-color': 'red'
                        }
                    },
                    {
                        data: {
                            id: 'b'
                        }
                    }
                ],
                edges: [{
                    data: {
                        id: 'ab',
                        source: 'a',
                        target: 'b'
                    }
                }]
            },
            layout: {
                name: 'grid',
                rows: 1
            },
            style: [{
                selector: 'node',
                style: {
                    'label': 'data(id)'
                }
            }]
        });
    });
</script>

</html>