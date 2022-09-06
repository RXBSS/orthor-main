# Template - Getting started

Das Template hat eine `install.cmd` die einfach ausgeführt werden kann. 

Damit alles funktioniert muss man die [Entwicklungsumgebung](entwicklung-umgebung.md) hergestellt haben. 
Nachdem hinzufügen muss man dann noch die [Anteilung Repository](entwicklung-repository.md) abarbeiten.

Zudem müssen noch folgenden Dateien angepasst werden:
- Die `readme.md` anpassen. Hier sollte die Beschreibung angepasst werden.
- Die `package.json` anpassen. Hier sollten Name, Version etc. angepasst werden.
- Die `gulpfile.js` anpassen. Hier muss der Name des Systems angepasst werden.
- Einstellungen unter `src/config.json` anpassen.
- Die Version setzen `src/VERSION`.
- Die `.htaccess` ggf. anpassen.
- Jetzt muss noch mit `orthor db install` die Datenbank erstellt werden. 


In den meisten Fällen ist es dann auch sinnig aus der Datei `orthor/src/includes/03_orthor_navigation.php` alles in die `src/includes/03_navigation.php` einzufügen. 
Die Navigation wird meistens komplett individuell gestaltet. Die Navigation ist aber so ausgelegt, dass Sie beliebig angepasst werden kann. 

Die Login, Registrierung, etc. sind ebenfalls Seiten, die kopiert werden müssen, da diese selber angepasst werden können