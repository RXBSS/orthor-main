In diesem Beitrag wird beschrieben, wie man die verschiedenen Module aktualisiert und was dabei zu beachten ist.
Grundsätzlich ist es zu aufwendig XAMPP selbst zu aktualisieren, man kann es aber auch so machen. 
Im Prinzip reicht es aber auch die diversen Komponenten zu aktualisieren


### phpMyAdmin
1. Aktuelle Version von https://www.phpmyadmin.net/ herunterladen
2. Den Ordner `C:\xampp\phpMyAdmin` in `C:\xampp\phpMyAdmin-old` umbenennnen
3. Den Inhalt der neuen phpMyAdmin in einen neuen Ordner mit dem alten Namen `C:\xampp\phpMyAdmin` kopieren
4. Die Datei `config.inc.php` aus dem `-old` Ordner kopieren
5. Apache2.4 und mysql neu starten
6. phpMyAdmin sollte jetzt aktualisiert sein

### nodeJS
1. Aktuelle Version von https://nodejs.org/en/ herunterladen (LTS Version)
2. Setup ausführen

### npm
1. In der Console den Befehl `npm install -g npm@latest` ausführen 

### PHP
<strong style="color:red;">AKTUELL BITTE NICHT MACHEN!</strong>
1. Download der aktuellesten Version von https://windows.php.net/download#php-8.1 (Current Stable)
2. Es gibt mehrere Varianten: Jeweils `x64` oder `x86` und `Non Thread Sage` oder `Thread Safe`
3. XAMPP ist grundsätzlich `x64` und `Thread Safe` dies und die aktuelle Version findet man über den Befehl `phpinfo()` heraus.
4. Für die Installation den Ordner `C:\xampp\php` in `C:\xampp\php-old` umbenennnen
5. Den Inhalt des neuen PHP in einen neuen Ordner mit dem alten Namen `C:\xampp\php` kopieren
.. Hat noch nicht funktioniert. hier müssen noch mehrere Dinge angepasst werden. Teste ich bei gelegenheit

### MySQL
<strong style="color:red;">AKTUELL BITTE NICHT MACHEN!</strong>


### Git
1. Download von der Website https://git-scm.com/download/win
2. Darauf achten, dass die gleiche Version genommen wird (32 / 64) bit
3. Installationsassistenten durchlaufen lassen

### VSCode
<em>Führt automatisch Updates durch</em>