# Dateistruktur & Namen
Hier wird die Datei-Struktur und die Namen der verschiendenen Komponenten erklärt.

```
.
├── .vscode                 # Alle VS-Code Themen z.B. Snippets
├── backup                  # Standardmäßig leer, hier werden die Backups gespeichert
├── dist                    # Hier landet das fertige Produkt
├── docs                    # Die Dokumentation
├── git_hooks               # Ordner für Git Hooks
├── manual_modules          # Alle JavaScript Module, die nicht über NPM bezogen werden (können)
├── node_modules            # Alle JavaScript Module, die über NPM bezogen werden
├── src                     # Der Hauptordner in dem die Entwicklung liegt
│   ├── api                     # Die API (PHP-Skripte)
│   ├── handle                  # Skripte für die Kommunikation zwischen JS (Ajax) & API
│   ├── includes                # Grundfunktionen auf jeder Seite (Siehe <a href="###Includes">Includes</a>)
│   ├── js                      # Das komplette JavaScript
│   └── modules                 # Ordner für Module
│       ├── picklist                # Alle Picklisten
│       └── quickselect             # Alle Quickselects
│   ├── pages                   # Alle Dateien werden automatisch in Dist eingefügt
│   ├── plugins                 # Alle <a href="###Plugins">Plugins</a>
│       └── <em>Name</em>           # Name des Plugins (Ordner). Für die Struktur darunter bitte bei <a href="###Plugins">Plugins</a> schauen.
│   ├── scss                    # Alle Stylesheets als SCSS
│   └── sql                     # Die <a href="###SQL-Skripte">SQL-Skripte</a>
│       ├── cmd                     # Spezieller Ordner zum ausführen von Skripten
│       ├── demo                    # Alle SQL Skripte um eine Demo zu erstellen
│       ├── install                 # Alle SQL Skripte um das System zu installieren
│       └── update                  # Alle SQL Skripte um das System zu updaten  
│   └── templates               # Hier werden die <a href="###Templates">Templates</a> verwaltet
│       ├── picklist                # Template für Picklisten
│       ├── plugins                 # Template für Plugins
│       └── quickselect             # Template für Quickselect
│   ├── test                    # Hier werden alle Skripte für den Test verwaltet
│   ├── .htaccess               # Die <a href="###htaccess">.htaccess</a>
│   ├── config.json             # Die <a href="###Konfigurationsdatei">Konfigurationsdatei</a>
│   └── VERSION                 # Hier liegt das VERSIONS-File drin. Dort steht einfach nur die Version, mehr nicht
├── test                    # Hier wird ein vollständiges Testsystem von Gulp erstellt
├── vendor                  # Hier werden die Dateien von Composer abgelegt
├── .gitignore              # In dieser Datei stehen alle Dateien und Verzeichnisse die von Git ignoriert werden sollen
├── .gitignore              # In dieser Datei stehen alle Dateien und Verzeichnisse die von Git ignoriert werden sollen
└── ...
```

### Includes
Die Includes PHP-Dateien, die auf jeder Seite eingebunden werden. Dabei stellt Orthor einmal Includes bereit, die von den Custom-Includes aufgerufen werden können.
Im Standard ergibt sich dadurch folgender Baum im Distributionsordner: 

```
.
├── dist
│   ├── 01_init_orthor.php
│   ├── 02_header_orthor.php
│   ├── 03_navigation_orthor.php
│   ├── 04_scripts_orthor.php
│   ├── ---
│   ├── 01_nav_title.php
│   ├── 02_nav_actions.php
│   ├── 03_nav_breadcrumbs.php
│   ├── 04_nav_user_login.php
│   ├── 05_nav_default_nav.php
│   └── 06_nav_version.php
├── 01_init.php
├── 02_header.php
├── 03_navigation.php
├── 04_scripts_orthor.php
└── ...
```

In einem Template werden dann nur die Custom 01-04 eingebunden. Diese wiederrum verweisen auf die jeweiligen Parts aus der Orthor Datei. 
Die Navigation stellt hier eine kleine Ausnahme dar. Da man hier in der Regel keinen Standard definieren kann, kann man entweder die komplette Navigation, 
nur einzelne Module oder eben gar nichts.


Aufruf in der Datei
```
.
├── 01_init.php
│   └── 01_init_orthor.php
├── ...                             # Seitenabhänige Programmierung nach Init
├── 02_header.php
│   └── 02_header_orthor.php
├── ...                             # Seitenabhänige Programmierung nach Header
├── 03_navigation.php
│   └── 03_navigation_orthor.php
|       ├── 01_nav_title.php
|       ├── 02_nav_actions.php
|       ├── 03_nav_breadcrumbs.php
|       ├── 04_nav_user_login.php
|       ├── 05_nav_default_nav.php
|       └── 06_nav_version.php
├── ...                             # Der Inhalt der Seite
├── 04_scripts.php
│   └── 04_scripts_orthor.php
├── ...                             # Seitenabhänige Programmierung nach Skripten (Siehe auch <a href="###Pagelevel">Pagelevel</a>)
```


### Templates
🔴 <em>Ist noch nicht programmiert</em><br>
Mit Hilfe von Templates kann man relativ einfach neue Module und Seiten erstellen. 
Dazu ruft man einfach `orthor template xxxx` auf. Das Modul wird dann an die entsprechende Stelle erstellt


### SQL-Skripte
Die Pflege der Datenbank ist ein entscheidenes Thema. Wir unterscheiden dabei in vier Kategorien:
cmd, demo, install und update. So sind auch die Ordner aufgeteilt. 
Hier liegen dann die entsprechenden Skripte drin. 

```
.
├── sql
│   ├── cmd
│   └── demo
│       ├── demo_table.sql
│       └── ...
│   └── install
│       ├── _user.sql
│       └── ...
│   └── update  
│       ├── 0.0.1.sql
│       └── ...
```

Der cmd Ordner ist zu vernachlässigen. Dieser wird nur für die ausführen der Skripte benutzt. 
Das Ausführen der Skripte funktioniert über `orthor db <befehl>`

Bei den Befehlen install und reset kann man ein Level mitgeben. 
1 = nur Datenbank
2 = Datenbank + Install Skripte
3 = Datenbank + Install + Update Skripte
4 = Datenbank + Install + Update + Demo Skripte


### Konfigurationsdatei
In der Konfigurationsdatei werden alle wichtigen Dinge abgespeichert die für das System entscheidend sind. 
So zum Beispiel die Datenbank-Konfiguration, E-Mail Server, etc.


### Plugins
🔴 <em>Ist noch nicht programmiert</em><br>
Mit den Plugins soll erreicht werden, dass man beim Deployen auswählen kann, ob ein solches Plugin deployed werden soll oder nicht. 
Dies sollte in einer Deploy-Config mit angegeben werden!
Der Plugin-Ordner ist im Prinzip ein Miniatur Source Ordner. 

```
.
├── plugins
│   ├── beispiel                    # Name des Plugins
│       └── modules                     # Die Module werden automatisch in den entsprechenden Ordner eingefügt
│           ├── picklist            
│           └── quickselect
│       ├── beispiel.php                
│       ├── beispiel.js            
│       ├── beispiel.css
│       ├── beispiel-api.php
│       ├── beispiel-details.php
│       ├── beispiel-details.js
│       └── ...
```


### Pagelevel
Als Pagelevel wird eine Programmierung von Gulp bezeichnet, die automatisch die Dateien in dem Ordner `pages` und in dem Ordner `plugins` verwaltet.
Dabei konzentriert Sie sich auf Datei bzw. Ordner Namen: 


Die Module werden automatisch in den entsprechendne Ordner unter `dist/modules` verschoben.
```
.
├── modules                   
│   ├── picklist 
│       └── ...           
│   └── quickselect
│       └── ...    
```

Die Dateien werden automatisch auf Grund ihres Namens / Dateityps verschoben.
```
.
├── pagename.php            # wird nach `dist` verschoben.
├── pagename.css            # .css Dateien werden nach `dist/css/pagelevel` verschoben.
├── pagename.js             # .js Dateien werden nach `dist/js/pagelevel` verschoben.
├── pagename-handle.php     # .php Dateien mit -handle.php werden nach `dist` verschoben.
└── pagename-api.php        # .php Dateien mit -api.php werden nach `dist/api` verschoben.
```


### htaccess
Die .htaccess Datei verhindert den Zugriff auf diverse Datei-Sturkturen. 
Diese wird nicht automatisch von Orthor mit übernommen und sollte für jeden Fall selber eingerichtet werden. 
Dabei kann die .htaccess Datei von Orthor natürlich als Vorlage dienen. 

Mit Hilfe der .htaccess Datei kann man diverse Ziele erreichen: 
- Direkten Zugriff auf Dateien / Verzeichnisse sperren
- 404 Fehler und Standard-Index-Seiten hinzufügen
- Weiterleitungen
- .php in Aufrufen entfernen

Beispiel um einen Ordner mit Berechtigung zu versehen
`RedirectMatch 403 /data/.*$`

Beispiel um eine Datei mit Berechtigung zu versehen
`RedirectMatch 403 /config.json`

Die Dokumente können dann trotzdem noch über PHP aufgerufen werden. 
Dazu baut man sich dann einen einfachen Proxy. 
Der Benutzer greift auf ein PHP Skript zu, dass öffentlich ist. 
Dieses PHP Skript wiederum greift prüft zunächst, ob der Benutzer überhaupt die Berechtigung hat auf das geforderte Dokument zuzugreifen. 
Sofern er die Berechtigung hat, gibt das PHP Skript den Inhalt der Datei wieder (nicht den Pfad)
 
Dazu gibt es in PHP eine `@readfile` Funktion