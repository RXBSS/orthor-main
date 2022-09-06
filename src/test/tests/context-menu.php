<?php include('01_init.php');

$_page = [
    'title' => "<i class=\"fas fa-mouse\"></i> Kontext Menü"
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
                    <h4 class="card-title"><i class="fa-solid fa-mouse"></i> Kontext-Menü</h4>
                    <h6 class="subtext">
                        Als Kontext-Menü wird das Fenster bezeichnet, dass man mit einem Rechtsklick angezeigt bekommt.
                        Mit Hilfe dieser Klasse kann man das Standard-Kontext-Menü überschreiben und ein eigenes Kontext-Menü generieren.
                    </h6>

                    <p>
                        Wichtig an der Stelle ist, wie und wo das Kontext-Menü her kommt. Dabei wird ja eine Grundlage in Form von HTML benötigt.<br>
                        Grundsätzlich beruht das Kontext-Menü auf den <a href="https://getbootstrap.com/docs/5.0/components/dropdowns/">Dropdowns von Bootstrap</a>.
                    </p>


                    <hr>

                    Demo (Rechtsklick in die Box)
                    <div id="test-context" style="height: 100px; width: 300px; background: #eee; border: 1px solid #DDD;">

                        <!-- Dropdown Menü -->
                        <ul class="dropdown-menu context-menu">
                            <li><a class="dropdown-item" href="javascript:void(0);" data-action="open"><i class="fa-solid fa-external-link-alt"></i> Öffnen</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" data-action="bearbeiten"><i class="fa-solid fa-edit"></i> Bearbeiten</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" data-action="entfernen"><i class="fa-solid fa-trash"></i> Entfernen</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);" data-action="neu"><i class="fa-solid fa-plus"></i> Neu Erstellen</a></li>
                        </ul>


                    </div>

                    <hr>

                    <br>
                    <div class="row">
                        <div class="col-md-2">

                            <strong>Hell<br><br></strong>

                            <!-- Dropdown Menü -->
                            <ul class="dropdown-menu context-menu show">
                                <li><a class="dropdown-item" href="javascript:void(0);" data-action="open"><i class="fa-solid fa-external-link-alt"></i> Öffnen</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" data-action="bearbeiten"><i class="fa-solid fa-edit"></i> Bearbeiten</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" data-action="entfernen"><i class="fa-solid fa-trash"></i> Entfernen</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);" data-action="neu"><i class="fa-solid fa-plus"></i> Neu Erstellen</a></li>
                            </ul>
                        </div>
                        <div class="col-md-2">

                            <strong>Dunkel<br>(.dropdown-menu-dark)</strong>

                            <!-- Dropdown Menü -->
                            <ul class="dropdown-menu dropdown-menu-dark context-menu show">
                                <li><a class="dropdown-item" href="javascript:void(0);" data-action="open"><i class="fa-solid fa-external-link-alt"></i> Öffnen</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" data-action="bearbeiten"><i class="fa-solid fa-edit"></i> Bearbeiten</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" data-action="entfernen"><i class="fa-solid fa-trash"></i> Entfernen</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);" data-action="neu"><i class="fa-solid fa-plus"></i> Neu Erstellen</a></li>
                            </ul>
                        </div>
                        <div class="col-md-8">
                            <pre><code class="language-html ctc"><!-- Dropdown Menü -->
<ul class="dropdown-menu context-menu">
    <li><a class="dropdown-item" href="javascript:void(0);" data-action="open"><i class="fa-solid fa-external-link-alt"></i> Öffnen</a></li>
    <li><a class="dropdown-item" href="javascript:void(0);" data-action="bearbeiten"><i class="fa-solid fa-edit"></i> Bearbeiten</a></li>
    <li><a class="dropdown-item" href="javascript:void(0);" data-action="entfernen"><i class="fa-solid fa-trash"></i> Entfernen</a></li>
    <li>
        <hr class="dropdown-divider">
    </li>
    <li><a class="dropdown-item" href="javascript:void(0);" data-action="neu"><i class="fa-solid fa-plus"></i> Neu Erstellen</a></li>
</ul></code></pre>

                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-sign-in-alt"></i> Einfügen / Erstellen</h4>

                    <p>
                        Hier beschriebene die Verschiedenen Methoden um ein Kontext-Menü einzufügen. Dabei wird in einer Bestimmten Reihenfolge geprüft, nach welcher Methode initalisiert wird.
                        Als erstes wird geprüft ob die Variable HTML gesetzt ist. Wenn ja, wird per JavaScript initalisiert.<br>
                        Falls nein, wird geprüft, ob der <strong>contextSelector</strong> gesetzt ist. Falls ja, wird das DIV gesucht, dass hier angegeben wurde. <br>
                        Wenn beide Variablen nicht gesetzt sind, dann wird im DIV geprüft.<br>

                        Sollte ein Fehler beim initalisieren passieren, dann wird eine Exception geworfen!


                    </p>


                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-code"></i> Einfügen via Eingebettet</h4>

                            <strong>HTML</strong>
                            <pre><code class="language-html ctc"><!-- Einfügen via HTML -->
<div id="parent">
    ...

    <!-- Dropdown Menü -->
    <ul class="dropdown-menu context-menu">
        ...
    </ul>   
</div></code></pre>

                            <strong>JavaScript</strong>
                            <pre><code class="language-js ctc">var c = new ContextMenu('#parent');</code></pre>


                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-code"></i> Einfügen via Externem HTML</h4>

                            <strong>HTML</strong>
                            <pre><code class="language-html ctc"><!-- Einfügen via HTML -->
<div id="parent">
    ...  
</div>

<!-- Dropdown Menü -->
<ul id="dropdown" class="dropdown-menu context-menu">
    ...
</ul> 
</code></pre>

                            <strong>JavaScript</strong>
                            <pre><code class="language-js ctc">var c = new ContextMenu('#parent', {
    contextSelector: '#dropdown'
});</code></pre>


                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fa-solid fa-code"></i> Einfügen via JS</h4>
                            <strong>JavaScript (Text)</strong>
                            <pre><code class="language-js ctc">var c = new ContextMenu('#parent', 

    // Als String
    html:   '&lt;ul id="some" class="dropdown-menu context-menu"&gt;' + 
                '...' + 
            '&lt;/ul&gt;',

    contextSelector: '#some' // Muss dem Selector des HTML String entsprechen

});</code></pre>

                            <strong>JavaScript (Array)</strong>
                            <pre><code class="language-js ctc">var c = new ContextMenu('#parent', {

    // Als Array
    html: [{
            icon: 'fas fa-check', // Icon oder false
            title: 'OK', // Text
            action: 'ok' // Action 
        }, {
            ...
        }, 'hr', { // hr als String = Devider
            ...
        }]

});</code></pre>


                        </div>
                    </div>



                </div>
            </div>


            <hr>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fa-solid fa-code"></i> API</h4>
                    <h6 class="subtext">Weitere Dokumentation der API.
                    </h6>

                    <br><br>
                    <hr>

                    <div class="row">
                        <div class="col-md-6">

                            Events (pick und action)

                            <div id="test-context-event" style="height: 100px; width: 300px; background: #eee; border: 1px solid #DDD;">

                                <!-- Dropdown Menü -->
                                <ul class="dropdown-menu context-menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);" data-action="myaction"><i class="fa-solid fa-bell"></i> Mit Action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="fa-solid fa-bell-slash"></i> Ohne Action</a></li>
                                </ul>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <pre><code class="language-js ctc">context.on('pick', function(container, pickedEl) {
    ...
});</code></pre>

                            <pre><code class="language-js ctc">d.on('action', function(container, pickedEl, action) {
    ... 
});</code></pre>
                            

                        </div>
                    </div>
                    <hr>

<div class="row">
    <div class="col-md-6">

        <strong>childSelectorClass</strong><br>




    </div>
    <div class="col-md-6">
        <pre><code class="language-js ctc">context.on('pick', function(container, pickedEl) {
...
});</code></pre>

        <pre><code class="language-js ctc">d.on('action', function(container, pickedEl, action) {
... 
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

        // Kontext-Menü
        var c = new ContextMenu('#test-context');


        c.on('pick', function(e, El) {
            console.log(El);
        });

        c.on('action', function(e, El, action) {
            console.log(El);
            console.log(action);
        });

        // Kontext-Menü
        var d = new ContextMenu('#test-context-event');


        d.on('pick', function(e, El) {
            console.log('Pick');
        });

        d.on('action', function(e, El, action) {
            console.log('Action >' + action + '<');
        });



    });
</script>

</html>