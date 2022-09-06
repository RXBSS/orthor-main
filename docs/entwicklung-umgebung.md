# Entwicklungsumgebung
Für die Entwicklungsumgebung müssen diverse Programme installiert und angepasst werden. 
Im folgenden sind die Schritte zum Herstellen der Entwicklungsumgebung angegeben.

---

### XAMPP (Apache, PHP, MySQL, phpMyAdmin)
XAMPP ist eine zusammenstellung von mehreren Webkomponenten. Theoretisch könnten diese auch einzeln installiert werden. Mit XAMPP ist dies aber wesentlich schneller erledigt. Beim Herunterladen sollte man daraf achten, dass die Version 8 von PHP genutzt wird.


#### Installation
1. Download von https://www.apachefriends.org/de/index.html
2. Ausführen des Installers
3. Bei der Auswahl der Komponenten nur Apache, PHP, MySQL, phpMyAdmin anwählen.
![image](https://user-images.githubusercontent.com/14318498/126295068-bd9a23f9-53e2-498e-b4a0-5a616b41bedb.png)

4. <em></em> Optional: Kann man die beiden Module als Dienst installieren. Dazu das Control Center mit Rechtsklick als Administrator öffnen und vorne auf die beiden Haken setzen. Das hat den Vorteil, dass man nicht jedes Mal manuell im Control Center die Funktionen starten muss.
![image](https://user-images.githubusercontent.com/14318498/126347607-aed6fe6c-804b-4bc5-9a34-80f17ee6ce4e.png)


#### Anpassungen an der PHP .ini
Bestimmte Funktionen benötigten für die Bildbearbeitung das Plugin GD von PHP (https://www.php.net/manual/de/book.image.php). 
Dies ist standardmäßig mitinstalliert, aber in der php.ini auskommentiert.
1. Öffnen die Datei `C:\xampp\php\php.ini`
2. Suche nach `extension=gd`
3. In der Zeile `;extension=gd` den Kommentar entfernen `extension=gd`
4. Apache neu starten

#### Umgebungsvariablen setzen
Damit man PHP und MySQL von überall in der CMD aufrufen kann, muss man diese in den Umgebungsvariablen hinzufügen. 

1. Windows Einstellungen öffnen
2. Info anwählen
3. Erweiterte Systemeigenschaften
4. Umgebungsvariablen
5. Bei Systemvariablen Path auswählen
6. Bearbeiten Klicken
7. Die Umgebungsvariablen hinzufügen:

`C:\xampp\mysql\bin`
`C:\xampp\php`

Nach der Aufnahme der Pfade in die Umgebungsvariable muss VS Code und jede Command Promp die offen war neu gestartet werden, damit es funktioniert.

---

### Git
Damit Git einwandfrei funktioniert muss über die Kommandozeile die Credentials hinzugefügt werden.

```
git config --global user.email "you@example.com"
git config --global user.name "Your Name"
git config --global credential.helper store
```

---

### Visual Studio Code
Wird für die Entwicklung empfohlen. Zudem sollten die folgenden Extension für eine leichtete Entwicklung installiert sein:

- Add jsdoc comments
- Apache Conf
- Format HTML in PHP
- Git Graph
- GitHub Pull Request and Issues
- Mark Jump
- PHP Intelephense
- SCSS Formatter
- XML Format

Es empfiehlt sich außerdem als Standard-Konsole die CMD zu nutzen. 
Dies kann man über den folgenden Konfigurations-Eintrag setzen:

`"terminal.integrated.defaultProfile.windows": "Command Prompt"`

Für Git sollte man außerdem noch folgende Einstellungen setzen:
`"git.autofetch": true,`
`"git.enableSmartCommit": true,`

---

### NodeJS und NPM
Die aktuelleste Version des LTS (Long Term Support) von NodeJS installieren: https://nodejs.dev/

---

### Composer
Bei Composer handelte sich ähnlich wie NPM um ein Tool zum verwalten von Dependencies.
Allerdings ist Composer für PHP gedacht.

Bei der Installation gibt man den Pfad zur PHP-Datei unter `C:\xampp\php` an. 
Dies macht der Composer aber standardmäßig von alleine.

https://getcomposer.org/

---

### Gulp
Ist ein Programm zu automatischen Verarbeiten von Dateien. 
Dies muss man per NPM global installieren.

`npm install gulp-cli -g`

---

Nun kann man starten und Repositorys hinzufügen. Siehe dazu die [Anteilung Repository hinzufügen](entwicklung-repository.md)
