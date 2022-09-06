<?php 

$_system_id = 1;

include('includes/01_init_orthor.php');

// App Initalisieren
$app = new App();

// Array
$_navigation = [
    'Native Produkte' => [
        'icon' => 'fas fa-feather',
        'links' => [
            ['description', 'Info', 'fas fa-info-circle'],
            ['app', 'App', 'fas fa-ghost'],
            ['buttons', 'Buttons', 'fas fa-mouse'],
            ['cards', 'Cards', 'fas fa-columns'],
            ['navbar', 'Navigation', 'fas fa-bars'],
            ['form', 'Form', 'fas fa-file-alt'],
            ['copyforms', 'Form 2', 'fas fa-file-alt'],
            ['texte', 'Texte/ Überschriften', 'fas fa-font'],
            ['template', 'Template', 'fas fa-copy'],
            ['configuration', 'Konfiguration', 'fas fa-cogs'],
            ['alert', 'Alert', 'fa-solid fa-circle-exclamation']
        ]
    ],
    'Third-Party' => [
        'icon' => 'fas fa-democrat',
        'links' => [
            ['select2', 'Select2', 'fas fa-search'],
            ['sweetalert', 'Sweet Alert', 'fas fa-exclamation-triangle'],
            ['datatables', 'Datatables', 'fas fa-table'],
            ['fullcalender', 'FullCalendar', 'fas fa-calendar-alt'],
            ['formvalidation', 'FormValidation', 'fas fa-check'],
            ['chart', 'Chart', 'fas fa-chart-bar'],
            ['bootstrap', 'Bootstrap', 'fab fa-bootstrap'],
            ['hotkeys', 'HotKeys', 'fas fa-key'],
            ['http://localhost/phpmyadmin', 'phpMyAdmin', 'fas fa-database', '_blank'],
            ['summernote', 'SummerNote', 'fas fa-pencil-alt']
        ]
    ],
    'Eigenentwicklungen' => [
        'icon' => 'fa fa-code',
        'links' => [
           
            ['pickliste', 'Pickliste', 'fas fa-list'],
            ['form-handler', 'Form Handler', 'fas fa-columns'],
            ['fabbutton', 'FAB Button', 'fas fa-swatchbook'],
            ['quickselect', 'Quickselect', 'fas fa-fighter-jet'],
            ['timeline', 'Timeline', 'fas fa-clock'],
            ['request', 'Request', 'far fa-lightbulb'],
            ['formatter', 'Formatter', 'fas fa-paragraph'],       
            ['sidebar', 'Sidebar', 'fas fa-bars'],      
            ['notifications', 'Notifications', 'fas fa-bullhorn'],
            ['todos', 'Todos', 'fas fa-check'],
            ['context-menu', 'Kontext-Menü', 'fas fa-mouse'],  
            ['activation', 'Activation', 'fas fa-toggle-on'],    
            ['file-upload', 'Drag and Drop', 'fas fa-upload'],
            ['kalkulationsverbund', 'Kalkulations-Verbund', 'fas fa-calculator']        
        ]
    ],
    'Beispiele' => [
        'icon' => 'fa fa-vial',
        'links' => [
            ['login', 'Login', 'fas fa-sign-in-alt'],
            ['user-doku', 'User', 'fas fa-user'],
            ['laender', 'Länder', 'fas fa-globe-europe'],
            ['example-list', 'Beispiele', 'fas fa-vial'],
        ]
    ],
    'Multidimensional' => [
        'icon' => 'fas fa-caret-square-down',
        'links' => [
            ['#', 'Direkte Seite 1', 'fas fa-arrow-down'],
            ['#', 'Direkte Seite 2', 'fas fa-arrow-down'],
            'Punkt mit Unterseiten' => [
                'icon' => 'fa fa-bezier-curve',
                'links'=> [
                    ['unterseite', 'Unterseite', 'fas fa-arrow-down'],
                    ['#', 'Seite 2', 'fas fa-arrow-down']
                ]
            ],
            ['#', 'Direkte Seite 3', 'fas fa-arrow-down'],
            'Punkt mit Mehr Unterseiten' => [
                'icon' => 'fa fa-bezier-curve',
                'links'=> [
                    ['#', 'Seite 1', 'fas fa-arrow-down'],
                    ['#', 'Seite 2', 'fas fa-arrow-down']
                ]
            ],
            ['#', 'Direkte Seite 4', 'fas fa-arrow-down'],
        ]
    ]
];
